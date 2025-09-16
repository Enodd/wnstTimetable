@props(['rooms'])

@foreach($rooms as $room)
    <x-accordion :title="$room['name']">
        @if(count($room['children']) > 0)
            @foreach($room['children'] as $child)
                @include('sidebar.rooms', ['rooms' => [$child]])
            @endforeach
        @endif
        @if(count($room['rooms']) > 0)
            @foreach($room['rooms'] as $rm)
                <div class="w-full px-3 py-2 rounded">
                    {{ $rm['nr_room'] }}
                </div>
            @endforeach
        @endif
    </x-accordion>
@endforeach
