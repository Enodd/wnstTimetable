@props([
    'eventsByGroup', 'visibleDays', 'groupCount', 'groupsMeta',
    'startHour', 'endHour', 'slotsPerHour',
])

@php
    $hourColumnWidth = 16;
    $eventColumnWidth = 176;
    $tableWidth = $hourColumnWidth + count($visibleDays) * $groupCount * $eventColumnWidth;
    $skip = [];
    use helpers\ColorHelper;
@endphp

<div class="timetable-table-wrap">
    <table class="timetable-table" style="min-width: {{ $tableWidth }}px">
        <colgroup>
            <col class="timetable-hour-column">
            @foreach ($visibleDays as $dayIndex => $dayName)
                @for ($groupIndex = 0; $groupIndex < $groupCount; $groupIndex++)
                    @php
                        echo '<col class="timetable-event-column" />'
                    @endphp
                @endfor
            @endforeach
        </colgroup>
        <thead>
            <tr class="timetable-table-header">
                <th rowspan="2" class="timetable-hour-heading">Godz.</th>
                @foreach ($visibleDays as $dayIndex => $dayName)
                    <th colspan="{{ $groupCount }}" class="timetable-day-heading">
                        {{ $dayName }}
                    </th>
                @endforeach
            </tr>
            <tr class="timetable-table-header">
                @foreach ($visibleDays as $dayIndex => $dayName)
                    @for ($groupIndex = 0; $groupIndex < $groupCount; $groupIndex++)
                        @php
                            $groupMeta = $groupsMeta instanceof \Illuminate\Support\Collection
                                ? $groupsMeta->get($groupIndex)
                                : ($groupsMeta[$groupIndex] ?? null);
                        @endphp
                        <th class="timetable-group-heading">
                            {{ $groupMeta['shortcut'] ?? ($groupCount > 1 ? 'Gr. ' . ($groupIndex + 1) : 'Plan') }}
                        </th>
                    @endfor
                @endforeach
            </tr>
        </thead>
        <tbody>
            @for ($hour = $startHour; $hour < $endHour; $hour++)
                @for ($quarter = 0; $quarter < $slotsPerHour; $quarter++)
                    @php $rowIndex = ($hour - $startHour) * $slotsPerHour + $quarter; @endphp
                    <tr class="timetable-slot-row {{ $quarter === 0 ? 'is-hour-start' : '' }}">
                        @if ($quarter === 0)
                            <td rowspan="{{ $slotsPerHour }}" class="timetable-hour-cell">
                                {{ sprintf('%02d:00', $hour) }}<br><span class="timetable-hour-separator">—</span><br>{{ sprintf('%02d:00', $hour + 1) }}
                            </td>
                        @endif

                        @foreach ($visibleDays as $dayIndex => $dayName)
                            @for ($groupIndex = 0; $groupIndex < $groupCount; $groupIndex++)
                                @php
                                    $baseId = 33 + ($dayIndex - 1) * 96;
                                    $cellId = $baseId + $rowIndex;
                                    if (isset($skip[$groupIndex][$dayIndex][$cellId])) continue;
                                    $events = $eventsByGroup[$groupIndex][$cellId] ?? [];
                                @endphp

                                @if (count($events) > 0)
                                    @php
                                        $maxDuration = collect($events)->max(fn ($event) => $event['time']['dur']);
                                        $multipleEvents = count($events) > 1;
                                    @endphp
                                    <td rowspan="{{ $maxDuration }}" class="timetable-event-cell">
                                        <div class="timetable-event-stack {{ $multipleEvents ? 'has-overlap' : '' }}">
                                            @foreach ($events as $event)
                                                @php
                                                    $borderColor = '#' . ColorHelper::bgrIntToHex($event['color'] ?? 0);
                                                    $isEven = (int) $event['time']['idWeek'] !== 0 && (int) $event['time']['idWeek'] % 2 === 0;
                                                @endphp
                                                <div class="timetable-event" style="--event-accent: {{ $borderColor }}" tabindex="0">
                                                    <div class="timetable-event-shortcut">
                                                        {{ $event['course']['shortcut'] }}
                                                        @if ($multipleEvents)
                                                            <span class="timetable-event-parity">({{ $isEven ? 'TP' : 'TN' }})</span>
                                                        @endif
                                                    </div>
                                                    <div class="timetable-event-name">{{ $event['course']['name'] }}</div>
                                                    <div class="timetable-event-type">{{ $event['course']['type'] }}</div>
                                                    <x-timetable-room-label :locations="$event['room_locations'] ?? []" />
                                                    @if (!empty($event['group_labels']))
                                                        <div class="timetable-event-detail">
                                                            Grupy: {{ implode(', ', $event['group_labels']) }}
                                                        </div>
                                                    @endif
                                                    @if (!empty($event['conductor_labels']))
                                                        <div class="timetable-event-detail">
                                                            Prowadzący: {{ implode(', ', $event['conductor_labels']) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    @php
                                        for ($offset = 1; $offset < $maxDuration; $offset++) {
                                            $skip[$groupIndex][$dayIndex][$baseId + $rowIndex + $offset] = true;
                                        }
                                    @endphp
                                @else
                                    <td class="timetable-empty-cell"></td>
                                @endif
                            @endfor
                        @endforeach
                    </tr>
                @endfor
            @endfor
        </tbody>
    </table>
</div>
