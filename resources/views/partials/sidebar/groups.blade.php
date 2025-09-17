@props(['groups'])

@foreach($groups as $group)
    <x-accordion :title="$group['name']">
        @if(count($group['children']) > 0)
            @foreach($group['children'] as $child)
                @include('partials.sidebar.groups', ['groups' => [$child]])
            @endforeach
        @endif
        @if(count($group['groups']) > 0)
            @foreach($group['groups'] as $grp)
                <div class="w-full px-3 py-2 rounded text-white">
                    {{ $grp['description'] }}
                </div>
            @endforeach
        @endif
    </x-accordion>
@endforeach
