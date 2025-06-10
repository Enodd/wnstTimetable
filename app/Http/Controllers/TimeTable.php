<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeTable extends Controller
{
    /*
     * 1. Get conductor id
     * 2. Get assigned events -> set_cond
     * 3. Get times for that event id
     */
    static public function conductor($conductor): array
    {
        return DB::table('conductors')
            ->leftJoin('set_cond', 'conductors.id', '=', 'set_cond.id_cond')
            ->leftJoin('times', 'times.idEvent', '=', 'set_cond.id')
            ->leftJoin('courses', 'courses.id', '=', 'set_cond.id')
            ->select('times.start', 'times.dur', 'times.idWeek', 'courses.name', 'courses.shortcut', 'courses.type')
            ->where('conductors.shortcut', '=', $conductor)
            ->get()
            ->toArray();
    }
    static public function room($roomNr): array {
        return DB::table('rooms')
            ->leftJoin('set_rooms', 'rooms.id', '=', 'set_rooms.id_room')
            ->leftJoin('times', 'times.idEvent', '=', 'set_rooms.id')
            ->leftJoin('courses', 'courses.id', '=', 'set_rooms.id')
            ->select('times.start', 'times.dur', 'times.idWeek', 'courses.name', 'courses.shortcut', 'courses.type')
            ->where('rooms.nr_room', '=', $roomNr)
            ->get()
            ->toArray();
    }
    static public function group($groupShortcut): array {
        return DB::table('groups')
            ->leftJoin('set_groups', 'groups.id', '=', 'set_groups.id_group')
            ->leftJoin('times', 'times.idEvent', '=', 'set_groups.id')
            ->leftJoin('courses', 'courses.id', '=', 'set_groups.id')
            ->select('times.start', 'times.dur', 'times.idWeek', 'courses.name', 'courses.shortcut', 'courses.type')
            ->where('groups.shortcut', '=', $groupShortcut)
            ->get()
            ->toArray();
    }
}