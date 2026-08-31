@props(['content'])

@extends("layouts.app")

@section('content')
    <div class="content-frame">
        <div class="plan-info">
            {!! $content !!}
        </div>
    </div>
@endsection
