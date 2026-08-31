@props([
    'filters' => [],
])

<form
    x-data="{ filterMode: @js($filters['mode'] ?? 'week') }"
    method="GET"
    action="{{ url()->current() }}"
    class="timetable-filter-form"
>
    @if (request()->boolean('all'))
        <input type="hidden" name="all" value="1">
    @endif

    <label class="form-label">
        <span class="form-label-text">Zakres</span>
        <span class="form-control-wrap">
            <select
                x-model="filterMode"
                class="form-control"
            >
                <option value="week">Wybrany tydzień</option>
                <option value="parity">Parzystość tygodni</option>
                <option value="semester">Cały semestr</option>
            </select>
            <svg class="form-control-icon" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <path d="m6 8 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
    </label>

    <div>
        <template x-if="filterMode === 'week'">
            <label class="form-label">
                <span class="form-label-text">Tydzień</span>
                <span class="form-control-wrap">
                    <select
                        name="weekId"
                        required
                        class="form-control"
                    >
                        @foreach ($filters['weeks'] ?? [] as $week)
                            <option
                                value="{{ $week->idWeek }}"
                                @selected((int) ($filters['weekId'] ?? 0) === (int) $week->idWeek)
                            >
                                {{ $week->sDescript }}
                            </option>
                        @endforeach
                    </select>
                    <svg class="form-control-icon" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <path d="m6 8 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </label>
        </template>

        <template x-if="filterMode === 'parity'">
            <label class="form-label">
                <span class="form-label-text">Tygodnie</span>
                <span class="form-control-wrap">
                    <select
                        name="parity"
                        class="form-control"
                    >
                        <option value="even" @selected(($filters['parity'] ?? null) === 'even')>Parzyste</option>
                        <option value="odd" @selected(($filters['parity'] ?? null) === 'odd')>Nieparzyste</option>
                    </select>
                    <svg class="form-control-icon" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <path d="m6 8 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </label>
        </template>

        <template x-if="filterMode === 'semester'">
            <input type="hidden" name="semester" value="1">
        </template>
    </div>

    <label class="form-label">
        <span class="form-label-text">Sesja</span>
        <span class="form-control-wrap">
            <select
                name="session"
                class="form-control"
            >
                <option value="">Bez filtrowania</option>
                <option value="winter" @selected(($filters['session'] ?? null) === 'winter')>Zimowa</option>
                <option value="summer" @selected(($filters['session'] ?? null) === 'summer')>Letnia</option>
            </select>
            <svg class="form-control-icon" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <path d="m6 8 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
    </label>

    <button
        type="submit"
        class="timetable-filter-submit"
    >
        Zastosuj
    </button>
</form>
