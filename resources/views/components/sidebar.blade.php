@php
    /**
    * @var array $groups;
    * @var array $conductors;
    * @var array $rooms;
    */
@endphp

@props(['conductors', 'rooms', 'groups'])

<header class="w-[350px] p-2 flex flex-col">
    <nav class="flex flex-col justify-center">
        <img src="" />
        <h1 class="text-3xl text-center">
            {!! __('Wydział nauk ścisłych i&nbsp;technicznych') !!}
        </h1>
        <h2 class="text-xl text-center">
            {{ __('Uniwersytet Śląski') }}
        </h2>
    </nav>
    <section class="grow-2" x-data="{activeTab: 'groups' }">
        <div>
            <button
                :class="activeTab === 'groups' ? 'bg-indigo-900' : 'bg-indigo-950'"
                @click="activeTab = 'groups'"
            >
                {{ __('Grupy') }}
            </button>
            <button
                :class="activeTab === 'conductors' ? 'bg-indigo-900' : 'bg-indigo-950'"
                @click="activeTab = 'conductors'"
            >
                {{ __('Prowadzący') }}
            </button>
            <button
                :class="activeTab === 'rooms' ? 'bg-indigo-900' : 'bg-indigo-950'"
                @click="activeTab = 'rooms'"
            >
                {{ __('Sale') }}
            </button>
        </div>
        <div x-show="activeTab === 'conductors'">
            {{ view('sidebar.conductors', ['conductors' => $conductors]) }}
        </div>
        <div x-show="activeTab === 'groups'">
            {{ view('sidebar.groups', ['groups' => $groups]) }}
        </div>
        <div x-show="activeTab === 'rooms'">
            {{ view('sidebar.rooms', ['rooms' => $rooms]) }}
        </div>

    </section>
    <nav>
        <p>Obsługa rezerwacji</p>
        <p>Info</p>
        <p>Pomoc</p>
        <p>Zaloguj się</p>
        <p>
            Ostatnia aktualizacja bazy: <br />
        </p>
    </nav>
</header>
