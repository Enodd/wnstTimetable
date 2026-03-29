@props(['timetable', 'nesting', 'title'])

@extends('layouts.app')
@section("content")

    <style>
        .timetable-table {
            border-collapse: separate;
            border-spacing: 0;
        }
        .timetable-table thead th {
            position: sticky;
            top: 0;
            z-index: 10;
        }
        tr.slot-row:hover td:not(.event-td) {
            background-color: rgba(99, 102, 241, 0.04);
        }
    </style>

    <div class="timetable-wrap max-w-full px-2 pb-10">

        {{-- Header --}}
        <div class="mb-6 flex flex-col gap-1">
            <div class="text-xs font-medium tracking-widest text-indigo-400 uppercase">
                {{ $nesting }}
            </div>
            <h1 class="text-2xl font-semibold text-gray-100">
                {!! 'Plan zajęć — ' . $title !!}
            </h1>
            <div class="mt-1 h-px w-24 bg-gradient-to-r from-indigo-500 to-transparent"></div>
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

        {{-- Table --}}
        <div class="overflow-x-auto rounded-2xl border border-white/10 shadow-2xl shadow-black/40">
            <table class="timetable-table table-fixed w-full text-xs">
                <thead>
                <tr class="bg-gray-900 border-b border-white/10">
                    <th class="py-3 px-3 text-left text-gray-500 font-medium w-20 hour-label border-r border-white/10">
                        Godz.
                    </th>
                    @foreach ($days as $day)
                        <th class="py-3 px-2 text-center font-semibold text-gray-200 tracking-wide border-r border-white/10 last:border-r-0">
                            {{ $day }}
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @for($hour = $startHour; $hour < $endHour; $hour++)
                    @for($q = 0; $q < $slotsPerHour; $q++)
                        @php $rowIndex = ($hour - 8) * 4 + $q; @endphp
                        <tr class="slot-row h-4 {{ $q === 0 ? 'border-t border-white/10' : '' }}">

                            @if($q === 0)
                                <td class="hour-label border-r border-white/10 px-2 py-0 text-center align-middle
                                           text-gray-400 font-medium text-[10px] leading-tight bg-gray-900/60 whitespace-nowrap"
                                    rowspan="4">
                                    {{ sprintf('%02d:00', $hour) }}<br>
                                    <span class="text-gray-600">—</span><br>
                                    {{ sprintf('%02d:00', $hour + 1) }}
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
                                    <td class="event-td relative rounded-md border-r border-white/10 last:border-r-0 p-0"
                                        style="{{ \helpers\ColorHelper::generateGradient($event['course']['color']) }}"
                                        rowspan="{{ $event['time']['dur'] }}">
                                        <div class="absolute inset-0 h-full p-2 text-left rounded-sm mx-0.5"
                                        >
                                            <div class="font-bold text-inherit text-md leading-tight">
                                                {{ $event['course']['name'] }}
                                            </div>
                                            <x-conductorInformation :conductor="$event['course']['conductor']" />
                                            <div class="text-inherit/70 text-xs font-mono mt-0.5">
                                                {{ $event['id'] }}
                                            </div>
                                            <div class="text-inherit/60 text-xs italic mt-0.5">
                                                {{ $event['course']['type'] }}
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                        for ($i = 1; $i < $event['time']['dur']; $i++) {
                                            $nextRowId = $baseId + ($rowIndex + $i);
                                            $skip[$dayIndex][$nextRowId] = true;
                                        }
                                    @endphp
                                @else
                                    <td class="border-r border-white/10 last:border-r-0 bg-gray-900/30 {{ $q === 3 ? 'border-b border-white/5' : '' }}"></td>
                                @endif

                            @endforeach
                        </tr>
                    @endfor
                @endfor
                </tbody>
            </table>
        </div>
    </div>

@endsection
