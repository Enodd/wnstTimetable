@props(['timetable', 'nesting', 'title'])


@extends('layouts.app')
@section("content")
    <div class="flex flex-col gap-2 mb-4">
        <x-cardHeader size="xl">
            {{ $nesting }}
        </x-cardHeader>
        <x-cardHeader>
            {!! 'Plan zajęć - ' . $title !!}
        </x-cardHeader>
    </div>
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

        $startHour = 8;
        $endHour = 21;
        $slotsPerHour = 4;
        $slotMinutes = 15;
        $slotsPerDay = ($endHour - $startHour) * $slotsPerHour;

        $eventsById = [];
        foreach ($timetable as $event) {
            $eventsById[$event['time']['start']] = $event;
        }
        $activeDays = [];
        for($i = 1; $i<=5; $i++) {
            $activeDays[$i] = true;
        }
        foreach ($timetable as $event) {
            $dayIndex = intdiv($event['time']['start'] - 33, 96) + 1;
            $activeDays[$dayIndex] = true;
        }

        $days = array_filter($days, fn($label, $key) => isset($activeDays[$key]), ARRAY_FILTER_USE_BOTH);
        $skip = [];
    @endphp
    <table class="table-fixed border-collapse border border-gray-400 w-full text-xs text-center ">
        <thead>
        <tr>
            <th class="border border-gray-400 w-20">Godz.</th>
            @foreach ($days as $day)
                <th class="border border-gray-400">{{ $day }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @for($hour = $startHour; $hour < $endHour; $hour++)
            @for($q = 0; $q < $slotsPerHour; $q++)
                @php $rowIndex = ($hour - 8) * 4 + $q;
                @endphp
                <tr class="h-4">
                    @if($q === 0)
                        <td class="border border-gray-400 font-semibold max-h-4" rowspan="4">
                            {{ sprintf('%02d:00', $hour) }}
                            - {{ sprintf('%02d:00', $hour + 1) }}
                        </td>
                    @endif
                    @foreach($days as $dayIndex => $dayName)
                        @php
                            $baseId = 33 + ($dayIndex - 1) * 96;
                            $cellId = $baseId + $rowIndex;
                            if (isset($skip[$dayIndex][$cellId])){
                                continue;
                            }
                            $event = $eventsById[$cellId] ?? null;
                        @endphp
                        @if ($event)
                            <td class="border border-blue-200 align-top bg-blue-400 text-black max-h-4"
                                rowspan="{{ $event['time']['dur'] }}">
                                <div class="p-1 text-left">
                                    <div class="font-bold">{{ $event['course']['shortcut'] }}</div>
                                    <div>{{ $event['course']['name'] }}</div>
                                    <div>{{ $event['id'] }}</div>
                                    <div class="italic text-gray-700">{{ $event['course']['type'] }}</div>
                                </div>
                            </td>
                            @php
                                for ($i = 1; $i < $event['time']['dur']; $i++) {
                                    $nextRowId = $baseId + ($rowIndex + $i);
                                    $skip[$dayIndex][$nextRowId] = true;
                                }
                            @endphp
                        @else
                            <td class="border border-blue-200 max-h-4"></td>
                        @endif
                    @endforeach
                </tr>
            @endfor
        @endfor
        </tbody>
    </table>
@endsection
