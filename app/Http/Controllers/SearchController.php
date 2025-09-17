<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Group;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = strtolower($request->input('search', ''));
        $shouldFetchGroups = $request->boolean('groups');
        $shouldFetchConductors = $request->boolean('conductors');
        $shouldFetchRooms = $request->boolean('rooms');
        $results = collect();

        if ($shouldFetchGroups) {
            $groups = Group::where(DB::raw('LOWER(name)'), 'like', '%' . $search . '%')
                ->orderBy('name')
                ->get()
                ->map(fn($group) => $group->getDescription())
                ->toArray();
            $results = $results->merge($groups);
        }
        if ($shouldFetchConductors) {
            $conductors = Conductor::where(DB::raw('LOWER(name)'), 'like', '%' . $search . '%')
                ->orWhere(DB::raw('LOWER(surname)'), 'like', '%' . $search . '%')
                ->orderBy('surname')
                ->get()
                ->map(fn($conductor) => $conductor->getDescription())
                ->toArray();
            $results = $results->merge($conductors);
        }
        if ($shouldFetchRooms) {
            $rooms = Room::where(DB::raw('LOWER(nr_room)'), 'like', '%' . $search . '%')
                ->orderBy('nr_room')
                ->get()
                ->map(fn($room) => $room->getDescription())
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

        return view('search', ['results' => $paginator]);
    }
}
