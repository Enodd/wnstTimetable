@props(['conductors'])

@foreach($conductors as $conductor)
    <x-accordion :title="$conductor['name']">
        @if(count($conductor['children']) > 0)
            @foreach($conductor['children'] as $child)
                @include('sidebar.conductors', ['conductors' => [$child]])
            @endforeach
        @endif
        @if(count($conductor['conductors']) > 0)
            @foreach($conductor['conductors'] as $cond)
                <div class="w-full px-3 py-2 rounded">
                    {{ $cond['title'] . ' ' . $cond['surname'] . ' ' . $cond['name'] }}
                </div>
            @endforeach
        @endif
    </x-accordion>
@endforeach
