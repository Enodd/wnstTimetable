@props(['results'])
@extends('layouts.app')
@php
    $current = $results->currentPage();
    $last = $results->lastPage();
    $start = max($current - 2, 1);
    $end = min($current + 2, $last);

    if ($current <= 3) {
        $end = min(5, $last);
    }
    if ($current >= $last - 2) {
        $start = max($last - 4, 1);
    }
@endphp

@section('content')
    <div class="flex flex-col items-center w-auto mx-4 p-4 gap-2 border border-blue-100 rounded-lg">
        <p class="font-bold text-2xl mb-4">Results:</p>
        <div class="w-full md:max-w-md flex flex-col gap-1">
            @foreach($results as $result)
                <p>
                    {{ $loop->iteration + ($results->perPage() * ($current - 1)) . '. ' }}
                    {{ $result }}
                </p>
            @endforeach
        </div>
        <div class="flex flex-col items-center">
            <div class="flex justify-center mt-4 space-x-1">
                @if($current > 1)
                    <a href="{{ $results->url(1) }}"
                       class="px-3 py-1 border rounded hover:bg-blue-200 hover:text-black">&laquo;</a>
                @else
                    <span class="px-3 py-1 border rounded bg-blue-100 text-black">&laquo;</span>
                @endif

                @for($i = $start; $i <= $end; $i++)
                    @if($i == $current)
                        <span class="px-3 py-1 border rounded bg-blue-500 text-white">{{ $i }}</span>
                    @else
                        <a href="{{ $results->url($i) }}"
                           class="px-3 py-1 border rounded hover:bg-blue-200 hover:text-black">{{ $i }}</a>
                    @endif
                @endfor

                @if($current < $last)
                    <a href="{{ $results->url($last) }}"
                       class="px-3 py-1 border rounded hover:bg-blue-200 hover:text-black">&raquo;</a>
                @else
                    <span class="px-3 py-1 border rounded bg-gray-100 text-gray-400">&raquo;</span>
                @endif

                @if ($last > 5)
                    <form method="GET" action="{{ request()->url() }}" class="inline-flex items-center ml-4">
                        @foreach(request()->except('page') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <input
                            type="number"
                            name="page"
                            min="1"
                            max="{{ $last }}"
                            value="{{ $current }}"
                            class="w-16 px-2 py-1 border rounded text-center"
                        >
                        <button type="submit"
                                class="ml-1 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Go
                        </button>
                    </form>
                @endif
            </div>
            <p>
                Znaleziono wyników: {{ $results->total() }}
            </p>
            <p>
                Stron: {{ $last }}
            </p>
        </div>
    </div>
@endsection


