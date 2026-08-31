@props([
    'timetables',
    'headerMeta' => [],
    'nesting' => null,
    'groupsMeta' => collect(),
    'filters' => [],
])

@php
    $dayNames = [
        1 => 'Poniedziałek',
        2 => 'Wtorek',
        3 => 'Środa',
        4 => 'Czwartek',
        5 => 'Piątek',
        6 => 'Sobota',
        7 => 'Niedziela',
    ];
    $startHour = 8;
    $configuredEndHour = 21;
    $slotsPerHour = 4;
    $eventsByGroup = [];
    $locationLegend = [];
    $activeDays = array_fill_keys(range(1, 5), true);
    $maxRowIndex = null;

    foreach ($timetables as $groupIndex => $timetable) {
        foreach ($timetable as $event) {
            $start = (int) $event['time']['start'];
            $duration = (int) $event['time']['dur'];
            $dayIndex = intdiv($start - 33, 96) + 1;
            $dayLocal = ($start - 33) % 96;
            $eventsByGroup[$groupIndex][$start][] = $event;

            foreach ($event['room_locations'] ?? [] as $location) {
                $locationKey = ($location['room'] ?? '') . '|' . ($location['address'] ?? '');
                $locationLegend[$locationKey] = $location;
            }

            $activeDays[$dayIndex] = true;
            $maxRowIndex = max($maxRowIndex ?? 0, $dayLocal + $duration);
        }
    }

    $visibleDays = array_filter(
        $dayNames,
        fn ($dayName, $dayIndex) => isset($activeDays[$dayIndex]),
        ARRAY_FILTER_USE_BOTH,
    );
    $groupCount = count($timetables);
    $locationLegend = array_values($locationLegend);
    $endHour = $maxRowIndex === null
        ? $configuredEndHour
        : min($configuredEndHour, $startHour + (int) ceil($maxRowIndex / $slotsPerHour) + 1);
    $endHour = $endHour > $startHour ? $endHour : $configuredEndHour;
    $filterLabel = match ($filters['mode'] ?? null) {
        'semester' => 'Cały semestr',
        'parity' => ($filters['parity'] ?? null) === 'even' ? 'Tygodnie parzyste' : 'Tygodnie nieparzyste',
        default => 'Wybrany tydzień',
    };
@endphp

<section
    x-data="{
        selectedDay: 'all',
        filtersOpen: false,
        visibleDays: @js(array_map('intval', array_keys($visibleDays))),
        init() {
            if (!window.matchMedia('(max-width: 767px)').matches) {
                return;
            }

            const browserDay = new Date().getDay();
            const today = browserDay === 0 ? 7 : browserDay;
            const weekendWithoutClasses = today >= 6 && !this.visibleDays.includes(today);

            this.selectedDay = weekendWithoutClasses ? 'all' : today;
        },
    }"
    class="timetable"
>
    <header class="timetable-panel timetable-panel--floating">
        @if ($nesting)
            <p class="timetable-kicker">{{ $nesting }}</p>
        @endif

        <div class="timetable-heading-row">
            <h1 class="visually-hidden">
                Plan zajęć{{ isset($headerMeta['subject']) ? ' — ' . $headerMeta['subject'] : '' }}
            </h1>

            <div class="timetable-header-badges" aria-label="Informacje o planie">

                @if (!empty($headerMeta['subject']))
                    <span class="timetable-header-badge timetable-header-badge--subject">
                        {{ $headerMeta['subject'] }}
                    </span>
                @endif
                <span class="timetable-header-badge">
                    <svg viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <path d="M6 2v2m8-2v2M3.5 7h13M5 3.5h10a1.5 1.5 0 0 1 1.5 1.5v11A1.5 1.5 0 0 1 15 17.5H5A1.5 1.5 0 0 1 3.5 16V5A1.5 1.5 0 0 1 5 3.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    {{ $filterLabel }}
                </span>
                @if (!empty($headerMeta['week']))
                    <span class="timetable-header-badge">Tydzień {{ $headerMeta['week'] }}</span>
                @endif

                @if (!empty($headerMeta['year']))
                    <span class="timetable-header-badge">Rok {{ $headerMeta['year'] }}</span>
                @endif

            </div>

            <div class="timetable-heading-actions">
                <button
                    type="button"
                    @click="filtersOpen = !filtersOpen"
                    :aria-expanded="filtersOpen"
                    aria-controls="timetable-filters"
                    :class="filtersOpen && 'is-active'"
                    class="timetable-header-action"
                >
                    Filtry
                    <svg
                        class="button-icon"
                        :class="filtersOpen && 'is-rotated'"
                        viewBox="0 0 20 20"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path d="m6 8 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <x-timetable-favorite-toggle />
            </div>
        </div>

        <div
            id="timetable-filters"
            x-show="filtersOpen"
            x-collapse
            x-cloak
            class="timetable-filter-panel"
        >
            <nav class="day-switcher day-switcher--filters" aria-label="Wybór dnia">
                <button type="button" @click="selectedDay = 'all'"
                        :class="selectedDay === 'all' ? 'is-selected' : 'is-idle'"
                        class="day-switcher-button">
                    Cały tydzień
                </button>
                @foreach ($visibleDays as $dayIndex => $dayName)
                    <button type="button" @click="selectedDay = {{ $dayIndex }}"
                            :class="selectedDay === {{ $dayIndex }} ? 'is-selected' : 'is-idle'"
                            class="day-switcher-button">
                        {{ mb_substr($dayName, 0, 3) }}
                    </button>
                @endforeach
            </nav>

            <x-timetable-header :filters="$filters" />
        </div>
    </header>

    <div x-show="selectedDay === 'all'" x-cloak>
        <x-timetable-week-grid
            :events-by-group="$eventsByGroup"
            :visible-days="$visibleDays"
            :group-count="$groupCount"
            :groups-meta="$groupsMeta"
            :start-hour="$startHour"
            :end-hour="$endHour"
            :slots-per-hour="$slotsPerHour"
        />
    </div>

    <div x-show="selectedDay !== 'all'" x-cloak>
        <x-timetable-day-grid
            :events-by-group="$eventsByGroup"
            :visible-days="$visibleDays"
            :group-count="$groupCount"
            :groups-meta="$groupsMeta"
            :start-hour="$startHour"
            :end-hour="$endHour"
            :slots-per-hour="$slotsPerHour"
        />
    </div>

    <x-timetable-location-legend :locations="$locationLegend" />
</section>
