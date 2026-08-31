<div class="timetable-favorite-control">
    <button
        type="button"
        @click="$store.favoriteTimetables.toggle()"
        :aria-pressed="$store.favoriteTimetables.contains().toString()"
        :aria-label="$store.favoriteTimetables.contains() ? 'Usuń plan z ulubionych' : 'Dodaj plan do ulubionych'"
        :title="$store.favoriteTimetables.contains() ? 'Usuń z ulubionych' : 'Dodaj do ulubionych'"
        class="timetable-favorite-toggle"
    >
        <svg
            :class="$store.favoriteTimetables.contains() && 'is-active'"
            class="timetable-favorite-icon lucide lucide-heart"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true"
        >
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78a5.5 5.5 0 0 0 0-7.78z" />
        </svg>
    </button>

    <p
        x-show="$store.favoriteTimetables.notice"
        x-text="$store.favoriteTimetables.notice"
        x-transition.opacity
        x-cloak
        role="status"
        class="timetable-favorite-notice"
    ></p>
</div>
