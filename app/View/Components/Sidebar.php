<?php

namespace App\View\Components;

use App\Models\ConductorTree;
use App\Models\GroupTree;
use App\Models\RoomTree;
use App\Models\TablesLastModified;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public array $groups;
    public array $conductors;
    public array $rooms;
    public string $lastUpdate;

    public function __construct()
    {
        $this->groups = $this->getGroups();
        $this->conductors = $this->getConductors();
        $this->rooms = $this->getRooms();
        $this->lastUpdate = $this->getLastUpdate();
    }

    private function getGroups(): array
    {
        $groups = GroupTree::with('groups')
            ->where('parent', ['='], 0)
            ->orderBy('name')
            ->get();

        return $groups->map->toNestedArray()->toArray();
    }

    private function getConductors(): array
    {
        $trees = ConductorTree::with('conductors')
            ->where('parent', ['='], 0)
            ->orderBy('name')
            ->get();

        return $trees->map->toNestedArray()->toArray();
    }

    private function getRooms(): array
    {
        $rooms = RoomTree::with('rooms')
            ->where('parent', 0)
            ->orderBy('name')
            ->get();
        return $rooms
            ->map
            ->toNestedArray()
            ->toArray();
    }

    private function getLastUpdate(): string
    {
        $lastUpdate = TablesLastModified::query()
            ->select('dtLastModified')
            ->orderBy('dtLastModified', 'desc')
            ->limit(1)
            ->first();
        return $lastUpdate->dtLastModified;
    }

    public function render(): View|Closure|string
    {
        return view('components.sidebar', [
            'conductors' => $this->conductors,
            'rooms' => $this->rooms,
            'groups' => $this->groups,
            'lastUpdate' => $this->lastUpdate
        ]);
    }
}
