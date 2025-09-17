@php
    /**
    * @var array $groups;
    * @var array $conductors;
    * @var array $rooms;
    */
@endphp

@props(['conductors', 'rooms', 'groups', 'lastUpdate'])

<header class="w-[400px] h-screen py-4 px-2 flex flex-col border-r border-r-blue-100">
    <nav class="flex flex-col h-full">
        <a href="/" class="decoration-none mb-2">
            <div class="w-[350px] aspect-[295/206]">
                <img src="/us_logo_white.png" alt="logo uniwersytetu śląskiego" width="90%" class="m-auto"/>
            </div>
            <h1 class="text-2xl text-center">
                {!! 'Wydział nauk ścisłych i&nbsp;technicznych' !!}
            </h1>
        </a>

        <section class="grow-2 flex flex-col gap-2 h-1/3 my-4" x-data="{activeTab: 'groups' }">
            <div class="flex justify-center gap-1">
                <button
                    class="w-fit py-1 px-2 border border-white rounded"
                    :class="activeTab === 'groups' ? 'bg-blue-900' : 'bg-blue-950'"
                    @click="activeTab = 'groups'"
                >
                    {{ 'Grupy' }}
                </button>
                <button
                    class="w-fit py-1 px-2 border border-white rounded"
                    :class="activeTab === 'conductors' ? 'bg-blue-900' : 'bg-blue-950'"
                    @click="activeTab = 'conductors'"
                >
                    {{ 'Prowadzący' }}
                </button>
                <button
                    class="w-fit py-1 px-2 border border-white rounded"
                    :class="activeTab === 'rooms' ? 'bg-blue-900' : 'bg-blue-950'"
                    @click="activeTab = 'rooms'"
                >
                    {{ 'Sale' }}
                </button>
            </div>
            <div class="grow-2 overflow-y-scroll">
                <div x-show="activeTab === 'conductors'" class="max-h-3/4">
                    {{ view('partials.sidebar.conductors', ['conductors' => $conductors]) }}
                </div>
                <div x-show="activeTab === 'groups'" class="max-h-3/4">
                    {{ view('partials.sidebar.groups', ['groups' => $groups]) }}
                </div>
                <div x-show="activeTab === 'rooms'" class="max-h-3/4">
                    {{ view('partials.sidebar.rooms', ['rooms' => $rooms]) }}
                </div>
            </div>
        </section>
        <nav>
            <p>
                Ostatnia aktualizacja bazy: <br/>
                {{ $lastUpdate }}
            </p>
        </nav>
</header>
