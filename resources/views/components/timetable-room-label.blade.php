@props(['locations' => []])

@php
    $rooms = collect($locations)
        ->pluck('room')
        ->filter()
        ->unique()
        ->values();
@endphp

@if ($rooms->isNotEmpty())
    <div class="timetable-event-room">
        Sala: {{ $rooms->implode(', ') }}
    </div>
@endif
