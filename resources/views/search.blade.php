@props(['results', 'search'])
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
    <section class="search-results" aria-labelledby="search-results-title">
        <header x-data="{ searchOpen: false }" class="search-results-header">
            <button
                type="button"
                @click="searchOpen = !searchOpen; if (searchOpen) $nextTick(() => $refs.searchInput.focus())"
                :aria-expanded="searchOpen"
                :aria-label="searchOpen ? 'Ukryj ponowne wyszukiwanie' : 'Wyszukaj ponownie'"
                :class="searchOpen && 'is-active'"
                aria-controls="search-results-refine"
                class="search-results-header-icon"
            >
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.75" />
                    <path d="m20 20-4-4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                </svg>
            </button>

            <div class="search-results-heading-copy">
                <h1 id="search-results-title" class="search-results-title">Wyniki wyszukiwania</h1>
                <p class="search-results-query">Dla zapytania „{{ $search }}”</p>
            </div>

            <span class="search-results-count">
                {{ $results->total() }} {{ $results->total() === 1 ? 'wynik' : 'wyników' }}
            </span>

            <div
                id="search-results-refine"
                x-show="searchOpen"
                x-collapse
                x-cloak
                class="search-results-refine"
            >
                <form method="GET" action="{{ url('/search') }}" class="search-results-refine-form">
                    <input type="hidden" name="groups" value="1">
                    <input type="hidden" name="conductors" value="1">
                    <input type="hidden" name="rooms" value="1">

                    <label for="search-results-input" class="visually-hidden">Nowa fraza wyszukiwania</label>
                    <span class="search-results-refine-control">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.75" />
                            <path d="m20 20-4-4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                        </svg>
                        <input
                            id="search-results-input"
                            x-ref="searchInput"
                            type="search"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Wpisz nową frazę"
                            class="search-results-refine-input"
                        >
                    </span>
                    <button type="submit" class="search-results-refine-submit">Szukaj</button>
                </form>
            </div>
        </header>

        @if ($results->count() > 0)
            <div class="search-results-panel">
                <ol class="search-results-list" start="{{ (($current - 1) * $results->perPage()) + 1 }}">
                    @foreach($results as $result)
                        @php
                            $typeLabel = match ($result['type'] ?? null) {
                                'group' => 'Grupa',
                                'conductor' => 'Prowadzący',
                                'room' => 'Sala',
                                default => 'Plan',
                            };
                        @endphp

                        <li class="search-result-item">
                            <a href="{{ $result['url'] }}" class="search-result-link">
                                <span class="search-result-index">
                                    {{ $loop->iteration + ($results->perPage() * ($current - 1)) }}
                                </span>
                                <span class="search-result-content">
                                    <span class="search-result-value">{{ $result['value'] }}</span>
                                    <span class="search-result-type">{{ $typeLabel }}</span>
                                </span>
                                <svg class="search-result-arrow" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                    <path d="m8 5 5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    @endforeach
                </ol>

                <footer class="pagination">
                    <nav class="pagination-list" aria-label="Strony wyników wyszukiwania">
                        @if($current > 1)
                            <a href="{{ $results->url(1) }}" class="pagination-item" aria-label="Pierwsza strona">&laquo;</a>
                        @else
                            <span class="pagination-item is-disabled" aria-hidden="true">&laquo;</span>
                        @endif

                        @for($i = $start; $i <= $end; $i++)
                            @if($i == $current)
                                <span class="pagination-item is-current" aria-current="page">{{ $i }}</span>
                            @else
                                <a href="{{ $results->url($i) }}" class="pagination-item" aria-label="Strona {{ $i }}">{{ $i }}</a>
                            @endif
                        @endfor

                        @if($current < $last)
                            <a href="{{ $results->url($last) }}" class="pagination-item" aria-label="Ostatnia strona">&raquo;</a>
                        @else
                            <span class="pagination-item is-disabled" aria-hidden="true">&raquo;</span>
                        @endif

                        @if ($last > 5)
                            <form method="GET" action="{{ request()->url() }}" class="pagination-jump">
                                @foreach(request()->except('page') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <label for="pagination-page" class="visually-hidden">Numer strony</label>
                                <input
                                    id="pagination-page"
                                    type="number"
                                    name="page"
                                    min="1"
                                    max="{{ $last }}"
                                    value="{{ $current }}"
                                    class="pagination-input"
                                >
                                <button type="submit" class="pagination-submit">Przejdź</button>
                            </form>
                        @endif
                    </nav>

                    <div class="pagination-summary">
                        <span>Strona {{ $current }} z {{ $last }}</span>
                        <span aria-hidden="true">•</span>
                        <span>{{ $results->total() }} wyników</span>
                    </div>
                </footer>
            </div>
        @else
            <div class="search-results-empty">
                <span class="search-results-empty-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.75" />
                        <path d="m20 20-4-4M8.5 11h5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                    </svg>
                </span>
                <h2>Brak pasujących wyników</h2>
                <p>Spróbuj zmienić wyszukiwaną frazę lub wybrane kategorie.</p>
                <a href="{{ url('/') }}" class="timetable-header-action">Wróć do wyszukiwarki</a>
            </div>
        @endif
    </section>
@endsection
