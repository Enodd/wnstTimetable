@props([
    'timetables',
    'title' => null,
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

    $eventsByDay = collect($dayNames)->mapWithKeys(fn ($dayName, $dayIndex) => [
        $dayIndex => collect(),
    ]);

    foreach ($timetables as $groupIndex => $timetable) {
        foreach ($timetable as $event) {
            $start = (int) $event['time']['start'];
            $duration = (int) $event['time']['dur'];
            $dayIndex = intdiv($start - 33, 96) + 1;
            $daySlot = ($start - 33) % 96;
            $startMinutes = 8 * 60 + $daySlot * 15;
            $endMinutes = $startMinutes + $duration * 15;

            $groupMeta = $groupsMeta instanceof \Illuminate\Support\Collection
                ? $groupsMeta->get($groupIndex)
                : ($groupsMeta[$groupIndex] ?? null);

            $eventsByDay[$dayIndex]->push([
                'event' => $event,
                'start' => sprintf('%02d:%02d', intdiv($startMinutes, 60), $startMinutes % 60),
                'end' => sprintf('%02d:%02d', intdiv($endMinutes, 60), $endMinutes % 60),
                'sort' => $startMinutes,
                'group' => $groupMeta['shortcut'] ?? (count($timetables) > 1 ? 'Grupa ' . ($groupIndex + 1) : null),
            ]);
        }
    }

    $hasWeekendEvents = $eventsByDay[6]->isNotEmpty() || $eventsByDay[7]->isNotEmpty();
    $visibleDays = $hasWeekendEvents ? $dayNames : array_slice($dayNames, 0, 5, true);
    $eventsByDay = $eventsByDay->map(fn ($events) => $events->sortBy('sort')->values());

    $filterLabel = match ($filters['mode'] ?? null) {
        'semester' => 'Cały semestr',
        'parity' => ($filters['parity'] ?? null) === 'even' ? 'Tygodnie parzyste' : 'Tygodnie nieparzyste',
        default => 'Wybrany tydzień',
    };
@endphp

<section
    x-data="{ selectedDay: 'all' }"
    class="timetable"
>
    <header class="timetable-panel">
        @if ($nesting)
            <p class="timetable-kicker">
                {{ $nesting }}
            </p>
        @endif

        <div class="timetable-heading-row timetable-heading-row--agenda">
            <div>
                <h1 class="timetable-title">
                    {!! $title ?? 'Plan zajęć' !!}
                </h1>
                <p class="timetable-subtitle">{{ $filterLabel }}</p>
            </div>

            <nav class="day-switcher" aria-label="Wybór dnia">
                <button
                    type="button"
                    @click="selectedDay = 'all'"
                    :class="selectedDay === 'all' ? 'is-selected' : 'is-idle'"
                    class="day-switcher-button"
                >
                    Cały tydzień
                </button>

                @foreach ($visibleDays as $dayIndex => $dayName)
                    <button
                        type="button"
                        @click="selectedDay = {{ $dayIndex }}"
                        :class="selectedDay === {{ $dayIndex }} ? 'is-selected' : 'is-idle'"
                        class="day-switcher-button"
                    >
                        {{ mb_substr($dayName, 0, 3) }}
                    </button>
                @endforeach
            </nav>
        </div>
    </header>

    <div
        class="agenda-grid"
        :class="selectedDay === 'all' ? 'is-week' : ''"
    >
        @foreach ($visibleDays as $dayIndex => $dayName)
            <article
                x-show="selectedDay === 'all' || selectedDay === {{ $dayIndex }}"
                x-transition.opacity.duration.150ms
                class="agenda-day"
            >
                <header class="agenda-day-header">
                    <h2 class="agenda-day-title">{{ $dayName }}</h2>
                    <span class="agenda-count">
                        {{ $eventsByDay[$dayIndex]->count() }}
                    </span>
                </header>

                <div class="agenda-events">
                    @forelse ($eventsByDay[$dayIndex] as $item)
                        @php
                            $event = $item['event'];
                            $accentColor = '#' . \helpers\ColorHelper::bgrIntToHex($event['color'] ?? 0);
                            $isEven = (int) $event['time']['idWeek'] !== 0
                                && (int) $event['time']['idWeek'] % 2 === 0;
                        @endphp

                        <div class="agenda-event">
                            <span
                                class="agenda-event-accent"
                                style="--event-accent: {{ $accentColor }}"
                                aria-hidden="true"
                            ></span>

                            <div class="agenda-event-meta">
                                <time class="agenda-event-time">
                                    {{ $item['start'] }}–{{ $item['end'] }}
                                </time>

                                <div class="agenda-badges">
                                    @if ($item['group'])
                                        <span class="agenda-badge">
                                            {{ $item['group'] }}
                                        </span>
                                    @endif

                                    @if (count($timetables) > 1 && (int) $event['time']['idWeek'] !== 0)
                                        <span class="agenda-badge agenda-badge--muted">
                                            {{ $isEven ? 'TP' : 'TN' }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <h3 class="agenda-event-title">
                                {{ $event['course']['shortcut'] }}
                            </h3>
                            <p class="agenda-event-name">
                                {{ $event['course']['name'] }}
                            </p>

                            @if ($event['course']['type'])
                                <p class="agenda-event-type">
                                    {{ $event['course']['type'] }}
                                </p>
                            @endif
                        </div>
                    @empty
                        <div class="agenda-empty">
                            <p class="agenda-empty-text">Brak zajęć</p>
                        </div>
                    @endforelse
                </div>
            </article>
        @endforeach
    </div>
</section>
