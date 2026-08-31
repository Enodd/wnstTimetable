<div class="timetable-search-debug">
    <x-cardHeader fullWidth>
        Filtry
    </x-cardHeader>
    <div>
        @foreach(\App\Models\WeekDef::with('week')->get()->unique(['idWeekDef'])->toArray() as $week)
            @dump($week)
        @endforeach
    </div>
</div>
