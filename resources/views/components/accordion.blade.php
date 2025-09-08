@props(['item'])

<div x-data="{ open: false }">
    @if(isset($item['children']))
        <!-- Accordion node -->
        <button
            @click="open = !open"
            class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-200"
        >
            <span>{{ $item['title'] }}</span>
            <svg :class="open ? 'rotate-90' : ''"
                 class="w-4 h-4 transition-transform"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1 border-l">
            @foreach($item['children'] as $child)
                <x-accordion :item="$child" />
            @endforeach
        </div>
    @else
        <a href="{{ isset($item['route']) ? route($item['route']) : '#' }}"
           class="block px-3 py-2 rounded hover:bg-gray-200">
            {{ $item['title'] }}
        </a>
    @endif
</div>
