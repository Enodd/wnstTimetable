@props(['title'])

<div x-data="{ open: false }">
        <button
            @click="open = !open"
            class="accordion-button"
        >
            <svg :class="open ? 'is-rotated' : ''"
                 class="accordion-icon"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="accordion-title">{{ $title }}</span>
        </button>

        <div x-show="open" x-collapse class="accordion-content">
            {{ $slot }}
        </div>
</div>
