@props(['locations' => []])

@if (count($locations) > 0)
    <section
        x-data="{ legendOpen: false }"
        class="timetable-location-legend"
        aria-labelledby="timetable-location-legend-title"
    >
        <h2>
            <button
                type="button"
                @click="legendOpen = !legendOpen"
                :aria-expanded="legendOpen"
                aria-controls="timetable-location-legend-content"
                class="timetable-location-legend-heading"
            >
                <span class="timetable-location-legend-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.75" />
                    </svg>
                </span>
                <span class="timetable-location-legend-copy">
                    <span id="timetable-location-legend-title" class="timetable-location-legend-title">
                        Lokalizacje sal
                    </span>
                    <span class="timetable-location-legend-subtitle">Adresy sal występujących w planie</span>
                </span>
                <svg
                    class="timetable-location-legend-chevron"
                    :class="legendOpen && 'is-open'"
                    viewBox="0 0 20 20"
                    fill="none"
                    aria-hidden="true"
                >
                    <path d="m6 8 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </h2>

        <div
            id="timetable-location-legend-content"
            x-show="legendOpen"
            x-collapse
            x-cloak
        >
            <ul class="timetable-location-legend-list">
                @foreach ($locations as $location)
                    <li class="timetable-location-legend-item">
                        <strong class="timetable-location-legend-room">Sala {{ $location['room'] }}</strong>
                        <span class="timetable-location-legend-address">{{ $location['address'] ?? 'Brak danych adresowych' }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
