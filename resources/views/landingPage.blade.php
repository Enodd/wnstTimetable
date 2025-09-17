@props(['content'])

@extends('layouts.app')

<style>
    table a {
        color: var(--color-blue-400);
    }
</style>
@section('content')
    {!! $content !!}
@endsection
