@props(['timetable'])

@extends('layouts.app')
@section("content")
    @php
        $days = [
            1 => 'Poniedziałek',
            2 => 'Wtorek',
            3 => 'Środa',
            4 => 'Czwartek',
            5 => 'Piątek',
            6 => 'Sobota',
            7 => 'Niedziela',
        ];

        // Time labels (13 rows = 13 hours)
        $times = [
            '08:00 - 09:00',
            '09:00 - 10:00',
            '10:00 - 11:00',
            '11:00 - 12:00',
            '12:00 - 13:00',
            '13:00 - 14:00',
            '14:00 - 15:00',
            '15:00 - 16:00',
            '16:00 - 17:00',
            '17:00 - 18:00',
            '18:00 - 19:00',
            '19:00 - 20:00',
            '20:00 - 21:00',
        ];

        // Build lookup: [cellId] => event
        $eventsById = [];
        foreach ($timetable as $event) {
            $eventsById[$event->start] = $event;
        }

        // Track cells already occupied by rowspan
        $skip = [];
    @endphp

    <table class="table-fixed border-collapse border border-gray-400 w-full text-xs text-center">
        <thead>
        <tr>
            <th class="border border-gray-400 w-20">Godz.</th>
            @foreach ($days as $day)
                <th class="border border-gray-400">{{ $day }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($times as $rowIndex => $timeLabel)
            <tr>
                <td class="border border-gray-400 font-semibold">{{ $timeLabel }}</td>

                @foreach ($days as $dayIndex => $dayName)
                    @php
                        // Each hour slot = 4 cells, starting at base ID
                        $baseId = 33 + ($dayIndex - 1) * 96; // Monday starts at 33
                        $cellId = $baseId + $rowIndex * 4;

                        // Skip if already covered by rowspan
                        if (isset($skip[$dayIndex][$cellId])) {
                            continue;
                        }

                        $event = $eventsById[$cellId] ?? null;
                    @endphp

                    @if ($event)
                        <td class="border border-gray-400 align-top bg-blue-200"
                            rowspan="{{ $event->dur }}">
                            <div class="p-1 text-left">
                                <div class="font-bold">{{ $event->course->shortcut }}</div>
                                <div>{{ $event->course->name }}</div>
                                <div class="italic text-gray-700">{{ $event->course->type }}</div>
                            </div>
                        </td>

                        @php
                            // Mark covered cells as skipped
                            for ($i = 1; $i < $event->dur; $i++) {
                                $skip[$dayIndex][$cellId + $i] = true;
                            }
                        @endphp
                    @else
                        <td class="border border-gray-200"></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
