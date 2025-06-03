<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller {
    public static function query(Request $request): array
    {
        $searchQuote = $request->input('q');
        if (empty($searchQuote)) {
            return [];
        }
        $omitConductors = (bool)$request->input('conductors');
        $omitRooms = (bool)$request->input('conductors');
        $omitGroups = (bool)$request->input('groups');
        $conductors = !$omitConductors ? self::getConductors($searchQuote) : [];
        $rooms = !$omitRooms ? self::getRooms($searchQuote) : [];
        $groups = !$omitGroups ? self::getGroups($searchQuote) : [];

        return array_merge($conductors, $rooms, $groups);
    }

    private static function getConductors(string $query): array
    {
        $conductors = DB::table('conductors')
            ->select('name', 'surname', 'title', 'shortcut')
            ->where(DB::raw('LOWER(name)'), 'like', '%' . $query . '%')
            ->orWhere(DB::raw('LOWER(surname)'), 'like', '%' . $query . '%')
            ->get()
            ->toArray();
        $parsedConductors = [];
        foreach ($conductors as $conductor) {
            $parsedConductors[] = [
                'name' => $conductor->title . ' ' . $conductor->name.' '.$conductor->surname,
                'href' => 'conductors/'. strtolower($conductor->shortcut),
            ];
        }
        return $parsedConductors;
    }

    private static function getRooms(string $query): array
    {
        $rooms = DB::table('rooms')
            ->select('nr_room as roomNr')
            ->where(DB::raw('LOWER(nr_room)'), 'like', '%' . $query . '%')
            ->get()
            ->toArray();

        $parsedRooms = [];
        foreach ($rooms as $room) {
            $parsedRooms[] = [
                'name' => $room->roomNr,
                'href' => 'rooms/'. strtolower($room->roomNr),
            ];
        }
        return $parsedRooms;
    }
    private static function getGroups(string $query): array
    {
        $groups = DB::table('groups')
            ->select( 'shortcut')
            ->where(DB::raw('LOWER(shortcut)'), 'like', '%' . $query . '%')
            ->get()
            ->toArray();
        $parsedGroups = [];
        foreach ($groups as $group) {
            $parsedGroups[] = [
                'name' => $group->shortcut,
                'href' => 'groups/'. strtolower($group->shortcut),
            ];
        }
        return $parsedGroups;
    }
}