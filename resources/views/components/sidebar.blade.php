@php
    /**
    * @var array $groups;
    * @var array $conductors;
    * @var array $rooms;
    */
@endphp

@props(['conductors', 'rooms', 'groups', 'lastUpdate'])

<div
    x-data="offcanvasSidebar"
    @keydown.escape.window="$store.sidebar.close()"
    class="sidebar-shell"
>
    <div
        x-show="$store.sidebar.open"
        x-transition:enter="sidebar-fade-enter"
        x-transition:enter-start="sidebar-fade-hidden"
        x-transition:enter-end="sidebar-fade-visible"
        x-transition:leave="sidebar-fade-leave"
        x-transition:leave-start="sidebar-fade-visible"
        x-transition:leave-end="sidebar-fade-hidden"
        x-cloak
        @click="$store.sidebar.close()"
        class="sidebar-backdrop"
        aria-hidden="true"
    ></div>

    <header
        id="mobile-sidebar"
        x-ref="panel"
        x-show="true"
        x-transition:enter="sidebar-slide-enter"
        x-transition:leave="sidebar-slide-leave"
        :class="$store.sidebar.open ? 'is-open' : 'is-closed'"
        @keydown.tab="trapFocus($event)"
        class="sidebar"
        role="dialog"
        aria-modal="true"
        aria-label="Menu boczne"
        :aria-hidden="(!$store.sidebar.open && window.innerWidth < 768).toString()"
        :aria-expanded="$store.sidebar.open.toString()"
    >
        <button
            type="button"
            x-ref="closeButton"
            @click="$store.sidebar.close()"
            class="sidebar-close"
            aria-label="Zamknij menu"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <nav class="sidebar-brand">
            <a href="/" class="sidebar-home-link">
                <div class="sidebar-logo">
                    <img src="/us_logo_white.png" alt="logo uniwersytetu śląskiego" width="90%" class="sidebar-logo-image"/>
                </div>
            </a>
            <div>
                <p class="sidebar-update">
                    Ostatnia aktualizacja bazy: <br/>
                    {{ $lastUpdate }}
                </p>
            </div>
        </nav>

        <section class="sidebar-content" x-data="{ activeTab: 'groups' }">
            <div class="sidebar-tabs">
                <button
                    class="sidebar-tab"
                    :class="activeTab === 'groups' ? 'is-selected' : 'is-idle'"
                    @click="activeTab = 'groups'"
                >
                    Grupy
                </button>
                <button
                    class="sidebar-tab"
                    :class="activeTab === 'conductors' ? 'is-selected' : 'is-idle'"
                    @click="activeTab = 'conductors'"
                >
                    Prowadzący
                </button>
                <button
                    class="sidebar-tab"
                    :class="activeTab === 'rooms' ? 'is-selected' : 'is-idle'"
                    @click="activeTab = 'rooms'"
                >
                    Sale
                </button>
            </div>

            <div class="sidebar-list">
                <div x-show="activeTab === 'conductors'">
                    {{ view('partials.sidebar.conductors', ['conductors' => $conductors]) }}
                </div>
                <div x-show="activeTab === 'groups'">
                    {{ view('partials.sidebar.groups', ['groups' => $groups]) }}
                </div>
                <div x-show="activeTab === 'rooms'">
                    {{ view('partials.sidebar.rooms', ['rooms' => $rooms]) }}
                </div>
            </div>
        </section>

        <footer class="sidebar-accessibility" aria-labelledby="accessibility-title">
            <p id="accessibility-title" class="sidebar-accessibility-title">Dostępność</p>

            <div class="sidebar-accessibility-controls">
                <button
                    type="button"
                    class="accessibility-toggle"
                    :class="$store.accessibility.highContrast ? 'is-active' : 'is-inactive'"
                    :aria-pressed="$store.accessibility.highContrast.toString()"
                    :aria-label="$store.accessibility.highContrast ? 'Wyłącz wysoki kontrast' : 'Włącz wysoki kontrast'"
                    @click="$store.accessibility.toggleHighContrast()"
                    title="Wysoki kontrast"
                >
                    <svg
                        class="accessibility-toggle-icon lucide lucide-contrast"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 18a6 6 0 0 0 0-12v12z" />
                    </svg>
                    <span
                        class="visually-hidden"
                        x-text="$store.accessibility.highContrast ? 'Wysoki kontrast włączony' : 'Wysoki kontrast wyłączony'"
                    >Wysoki kontrast wyłączony</span>
                    <span class="accessibility-toggle-indicator" aria-hidden="true"></span>
                </button>

                <button
                    type="button"
                    class="accessibility-toggle"
                    :class="$store.accessibility.largeText ? 'is-active' : 'is-inactive'"
                    :aria-pressed="$store.accessibility.largeText.toString()"
                    :aria-label="$store.accessibility.largeText ? 'Wyłącz powiększony tekst' : 'Włącz powiększony tekst'"
                    @click="$store.accessibility.toggleLargeText()"
                    title="Powiększony tekst"
                >
                    <svg
                        class="accessibility-toggle-icon lucide lucide-a-large-small"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M21 14h-5" />
                        <path d="M16 16v-3.5a2.5 2.5 0 0 1 5 0V16" />
                        <path d="M4.5 13h6" />
                        <path d="m3 16 4.5-9 4.5 9" />
                    </svg>
                    <span
                        class="visually-hidden"
                        x-text="$store.accessibility.largeText ? 'Powiększony tekst włączony' : 'Powiększony tekst wyłączony'"
                    >Powiększony tekst wyłączony</span>
                    <span class="accessibility-toggle-indicator" aria-hidden="true"></span>
                </button>
            </div>
        </footer>
    </header>
</div>
