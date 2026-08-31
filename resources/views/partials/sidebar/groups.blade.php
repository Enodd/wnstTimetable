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
                <div class="sidebar-tree-item">
                    <a href="{{'/timetable/groups/' . $grp['id']}}">
                        {{ $grp['description'] }}
                    </a>
                </div>
            @endforeach
        @endif
    </x-accordion>
@endforeach
