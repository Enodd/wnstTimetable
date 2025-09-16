<?php

namespace App\View\Components;

use App\Models\ConductorTree;
use App\Models\RoomTree;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use \App\Models\GroupTree;

class Sidebar extends Component
{
    public array $groups;
    public array $conductors;
    public array $rooms;

    public function __construct()
    {
        $this->groups = $this->getGroups();
        $this->conductors = $this->getConductors();
        $this->rooms = $this->getRooms();
    }

    private function getGroups(): array {
        $groups = GroupTree::with('groups')
            ->where('parent', ['='], 0)
            ->orderBy('name')
            ->get();

        return $groups->map->toNestedArray()->toArray();
    }

    private function getConductors(): array {
        $trees = ConductorTree::with('conductors')
            ->where('parent', ['='], 0)
            ->orderBy('name')
            ->get();

        return $trees->map->toNestedArray()->toArray();
    }

    private function getRooms(): array {
        $rooms = RoomTree::with('rooms')
            ->where('parent', 0)
            ->orderBy('name')
            ->get();
        return $rooms
            ->map
            ->toNestedArray()
            ->toArray();
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar', [
            'conductors' => $this->conductors,
            'rooms' => $this->rooms,
            'groups' => $this->groups,
        ]);
    }
}
