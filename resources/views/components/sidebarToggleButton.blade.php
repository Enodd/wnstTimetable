@props(['class' => ''])

<button
    type="button"
    x-data="sidebarToggleButton"
    @click="$store.sidebar.toggle()"
    :aria-expanded="$store.sidebar.open.toString()"
    aria-controls="mobile-sidebar"
    :aria-label="$store.sidebar.open ? 'Zamknij menu' : 'Otwórz menu'"
    {{ $attributes->merge(['class' => 'sidebar-toggle ' . $class]) }}
>
    <span class="visually-hidden" x-text="$store.sidebar.open ? 'Zamknij menu' : 'Otwórz menu'"></span>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="sidebar-toggle-icon lucide lucide-menu"
        aria-hidden="true"
    >
        <path d="M4 12h16" />
        <path d="M4 6h16" />
        <path d="M4 18h16" />
    </svg>
</button>
