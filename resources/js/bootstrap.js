import axios from 'axios';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

document.addEventListener('alpine:init', () => {
    Alpine.store('accessibility', {
        highContrast: false,
        largeText: false,

        init() {
            this.highContrast = this.readPreference('accessibility.highContrast');
            this.largeText = this.readPreference('accessibility.largeText');
            this.apply();
        },

        readPreference(key) {
            try {
                return localStorage.getItem(key) === 'true';
            } catch (error) {
                return false;
            }
        },

        savePreference(key, value) {
            try {
                localStorage.setItem(key, value);
            } catch (error) {
                // The setting still works for the current page when storage is blocked.
            }
        },

        toggleHighContrast() {
            this.highContrast = !this.highContrast;
            this.savePreference('accessibility.highContrast', this.highContrast);
            this.apply();
        },

        toggleLargeText() {
            this.largeText = !this.largeText;
            this.savePreference('accessibility.largeText', this.largeText);
            this.apply();
        },

        apply() {
            document.documentElement.classList.toggle('theme-high-contrast', this.highContrast);
            document.documentElement.classList.toggle('theme-large-text', this.largeText);
        },
    });

    Alpine.store('sidebar', {
        open: false,
        toggle() {
            this.open = !this.open;
        },
        close() {
            this.open = false;
        },
    });

    Alpine.store('favoriteTimetables', {
        cookieName: 'favorite_timetables',
        maxItems: 10,
        items: [],
        notice: '',
        noticeTimeout: null,

        init() {
            this.items = this.read();
        },

        read() {
            try {
                const prefix = `${this.cookieName}=`;
                const cookie = document.cookie
                    .split('; ')
                    .find((item) => item.startsWith(prefix));

                if (!cookie) return [];

                const value = JSON.parse(decodeURIComponent(cookie.slice(prefix.length)));
                if (!Array.isArray(value)) return [];

                return [...new Set(value
                    .map((url) => this.normalizeUrl(url))
                    .filter(Boolean))]
                    .slice(0, this.maxItems);
            } catch (error) {
                return [];
            }
        },

        normalizeUrl(value) {
            if (typeof value !== 'string') return null;

            try {
                const url = new URL(value, window.location.origin);
                const isTimetable = /^\/timetable\/(groups|conductors|rooms)\/[^/]+\/?$/.test(url.pathname);

                if (url.origin !== window.location.origin || !isTimetable) return null;

                return `${url.pathname}${url.search}`;
            } catch (error) {
                return null;
            }
        },

        currentUrl() {
            return this.normalizeUrl(`${window.location.pathname}${window.location.search}`);
        },

        contains(url = this.currentUrl()) {
            return Boolean(url) && this.items.includes(url);
        },

        toggle(url = this.currentUrl()) {
            if (!url) return;

            if (this.contains(url)) {
                this.items = this.items.filter((item) => item !== url);
                this.save();
                this.clearNotice();
                return;
            }

            if (this.items.length >= this.maxItems) {
                this.showNotice('Możesz zapisać maksymalnie 10 ulubionych planów zajęć.');
                return;
            }

            this.items = [...this.items, url];
            this.save();
            this.clearNotice();
        },

        save() {
            const cookieOptions = `Path=/; SameSite=Lax${window.location.protocol === 'https:' ? '; Secure' : ''}`;

            if (this.items.length === 0) {
                document.cookie = `${this.cookieName}=; Max-Age=0; ${cookieOptions}`;
                return;
            }

            const value = encodeURIComponent(JSON.stringify(this.items.slice(0, this.maxItems)));
            document.cookie = `${this.cookieName}=${value}; Max-Age=31536000; ${cookieOptions}`;
        },

        showNotice(message) {
            this.notice = message;
            window.clearTimeout(this.noticeTimeout);
            this.noticeTimeout = window.setTimeout(() => this.clearNotice(), 5000);
        },

        clearNotice() {
            this.notice = '';
            window.clearTimeout(this.noticeTimeout);
            this.noticeTimeout = null;
        },
    });

    Alpine.data('offcanvasSidebar', () => ({
        init() {
            this.$watch('$store.sidebar.open', (open) => {
                document.body.classList.toggle('is-scroll-locked', open);
                if (open) {
                    this.$nextTick(() => this.$refs.closeButton.focus());
                }
            });
        },

        focusables() {
            return [...this.$refs.panel.querySelectorAll(
                'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])'
            )].filter((el) => el.offsetParent !== null);
        },

        trapFocus(event) {
            const focusable = this.focusables();
            if (focusable.length === 0) return;

            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
        },
    }));
    Alpine.data('sidebarToggleButton', () => ({}));
    Alpine.data('timetable', {
        view: 'week', // 'week' | 'day'
        selectedDay: 1,
        selectedGroups: [],
        toggleGroup(id) {
            this.selectedGroups.includes(id)
            ? this.selectedGroups = this.selectedGroups.filter((el) => el.id !== id)
                : this.selectedGroups.push(id)
        }
    })
});

window.Alpine = Alpine;
Alpine.plugin(collapse)
Alpine.start();
