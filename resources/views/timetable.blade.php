@extends('layouts.app')

@section('content')
    <x-timetable-grid
        :timetables="$timetables"
        :header-meta="$headerMeta"
        :nesting="$nesting"
        :groups-meta="$groupsMeta ?? collect()"
        :filters="$filters"
    />
@endsection
