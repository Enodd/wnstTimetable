@props(['favoriteTimetables' => collect()])

<div class="landing-search">
    <div x-data="{filters: false}" class="landing-search-panel">
        <h2 class="landing-search-title">
            Szukaj planu zajęć
        </h2>
        <form action="/search" class="landing-search-form">
            <div class="landing-search-control">
            <x-input
                name="search"
                placeholder="Szukaj"
                input-class="input-control--search"
            />
                <div @click="filters = !filters"
                     class="landing-search-filter-button">
                    <p class="landing-search-filter-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-funnel-icon lucide-funnel">
                            <path
                                d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"/>
                        </svg>
                    </p>
                </div>
            </div>
            <div x-show="filters === true"
                 x-transition:enter="search-options-enter"
                 x-transition:enter-start="search-options-hidden"
                 x-transition:enter-end="search-options-visible"
                 x-transition:leave="search-options-leave"
                 x-transition:leave-start="search-options-visible"
                 x-transition:leave-end="search-options-hidden"
                 class="landing-search-options">
                <x-input
                    label="Grupy"
                    name="groups"
                    type="checkbox"
                    checked
                    input-label-class="input-label--choice"
                    input-class="input-control--choice"
                />
                <x-input
                    label="Prowadzący"
                    name="conductors"
                    type="checkbox"
                    checked
                    input-label-class="input-label--choice"
                    input-class="input-control--choice"
                />
                <x-input
                    label="Sale"
                    name="rooms"
                    type="checkbox"
                    checked
                    input-label-class="input-label--choice"
                    input-class="input-control--choice"
                />
            </div>
            <button type="submit" class="button button--outline">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="lucide lucide-search-icon lucide-search">
                    <path d="m21 21-4.34-4.34"/>
                    <circle cx="11" cy="11" r="8"/>
                </svg>
            </button>
        </form>

        @if ($favoriteTimetables->isNotEmpty())
            <section class="landing-favorites" aria-labelledby="landing-favorites-title">
                <h3 id="landing-favorites-title" class="landing-favorites-title">
                    Twoje ulubione plany zajęć
                </h3>

                <ul class="landing-favorites-list">
                    @foreach ($favoriteTimetables as $favorite)
                        <li>
                            <a
                                href="{{ $favorite['url'] }}"
                                class="landing-favorite-link"
                            >{{ $favorite['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
    </div>
</div>
