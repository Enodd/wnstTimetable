<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Group;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string)$request->input('search', ''));
        $searchPattern = '%' . $search . '%';
        $hasTypeFilters = $request->hasAny(['groups', 'conductors', 'rooms']);
        $shouldFetchGroups = !$hasTypeFilters || $request->boolean('groups');
        $shouldFetchConductors = !$hasTypeFilters || $request->boolean('conductors');
        $shouldFetchRooms = !$hasTypeFilters || $request->boolean('rooms');
        $results = collect();

        if ($shouldFetchGroups) {
            $groups = Group::query()
                ->where(function (Builder $query) use ($searchPattern) {
                    $query
                        ->whereLike('name', $searchPattern, caseSensitive: false)
                        ->orWhereLike('shortcut', $searchPattern, caseSensitive: false)
                        ->orWhereHas('tree', fn(Builder $tree) => $this->whereTreeMatches(
                            $tree,
                            $searchPattern
                        ));
                })
                ->orderBy('name')
                ->get()
                ->map(fn($group) => [
                    'url' => 'timetable/groups/' . $group->id,
                    'value' => $group->getDescription(),
                    'type' => 'group',
                ])
                ->toArray();
            $results = $results->merge($groups);
        }
        if ($shouldFetchConductors) {
            $conductors = Conductor::query()
                ->where(function (Builder $query) use ($searchPattern) {
                    $query
                        ->whereLike('name', $searchPattern, caseSensitive: false)
                        ->orWhereLike('surname', $searchPattern, caseSensitive: false)
                        ->orWhereLike('shortcut', $searchPattern, caseSensitive: false)
                        ->orWhereLike('title', $searchPattern, caseSensitive: false)
                        ->orWhereLike('room', $searchPattern, caseSensitive: false)
                        ->orWhereHas('tree', fn(Builder $tree) => $this->whereTreeMatches(
                            $tree,
                            $searchPattern
                        ));
                })
                ->orderBy('surname')
                ->get()
                ->map(fn($conductor) => [
                    'url' => 'timetable/conductors/' . $conductor->id,
                    'value' => $conductor->getDescription(),
                    'type' => 'conductor',
                ])
                ->toArray();
            $results = $results->merge($conductors);
        }
        if ($shouldFetchRooms) {
            $rooms = Room::query()
                ->where(function (Builder $query) use ($searchPattern) {
                    $query
                        ->whereLike('nr_room', $searchPattern, caseSensitive: false)
                        ->orWhereHas('tree', fn(Builder $tree) => $this->whereTreeMatches(
                            $tree,
                            $searchPattern
                        ));
                })
                ->orderBy('nr_room')
                ->get()
                ->map(fn($room) => [
                    'url' => 'timetable/rooms/' . $room->nr_room,
                    'value' => $room->getDescription(),
                    'type' => 'room',
                ])
                ->toArray();
            $results = $results->merge($rooms);
        }

        $page = $request->input('page', 1);
        $perPage = 20;
        $offset = ($page - 1) * $perPage;

        $total = $results->count();
        $totalPages = ceil($total / $perPage);

        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $paginator = new LengthAwarePaginator(
            $results->slice($offset, $perPage)->values(),
            $total,
            $perPage,
            $page,
            [
                'url' => $request->url(),
                'path' => $request->path(),
                'query' => $request->query(),
            ]
        );

        return view('search', ['results' => $paginator, 'search' => $search]);
    }

    private function whereTreeMatches(Builder $tree, string $searchPattern): void
    {
        $tree
            ->whereLike('name', $searchPattern, caseSensitive: false)
            ->orWhereHas('parent', function (Builder $parent) use ($searchPattern) {
                $parent
                    ->whereLike('name', $searchPattern, caseSensitive: false)
                    ->orWhereHas('parent', function (Builder $grandparent) use ($searchPattern) {
                        $grandparent
                            ->whereLike('name', $searchPattern, caseSensitive: false)
                            ->orWhereHas(
                                'parent',
                                fn(Builder $ancestor) => $ancestor->whereLike(
                                    'name',
                                    $searchPattern,
                                    caseSensitive: false
                                )
                            );
                    });
            });
    }
}
