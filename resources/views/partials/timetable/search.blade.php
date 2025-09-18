<div class="my-4 border-[1px] border-blue-100 ">
    <x-cardHeader fullWidth>
        Filtry
    </x-cardHeader>
    <div>
        @foreach(\App\Models\WeekDef::with('week')->get()->unique(['idWeekDef'])->toArray() as $week)
            @dump($week)
        @endforeach
    </div>
</div>
