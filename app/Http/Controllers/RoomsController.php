<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Conductor;
use Illuminate\Support\Facades\DB;
use App\Models\ConductorTree;

class RoomsController extends Controller 
{
    public function index(): array {
        $results = DB::table('room_tree')
            ->leftJoin('rooms', 'room_tree.id_room_tree', '=', 'rooms.id_room_tree')
            ->select(
                'room_tree.id_room_tree',
                'room_tree.name as tree_name',
                'room_tree.parent',
                'rooms.id as room_id',
                'rooms.nr_room as room_nr',
                'rooms.capacity',
                'rooms.comment',
                'rooms.type'
            )
            ->get();

        $rooms = [];
        foreach ($results as $row) {
            $id = $row->id_room_tree;
            if (!isset($rooms[$id])) {
                $rooms[$id] = [
                    'id_room_tree' => $row->id_room_tree,
                    'name' => $row->tree_name,
                    'parent' => $row->parent,
                    'rooms' => [],
                    'children' => []
                ];
            }
            if ($row->room_id) {
                $rooms[$id]['rooms'][] = [
                    'id' => $row->room_id,
                    'room_nr' => $row->room_nr,
                    'capacity' => $row->capacity,
                    'comment' => $row->comment,
                    'type' => $row->type
                ];
            }
        }

        $finalRooms = [];
        foreach ($rooms as $id => &$room) {
            if($room['parent'] && isset($rooms[$room['parent']])) {
                $rooms[$room['parent']]['children'][] = &$room;
            } else {
                $finalRooms[] = &$room;
            }
        }

        $this->sortRooms($finalRooms);
        return $finalRooms;
    }

    private function sortRooms(&$rooms): void
    {
        usort($rooms, function ($a, $b) {
            return $a['name'] <=> $b['name'];
        });

        foreach ($rooms as &$room) {
            usort($room['rooms'], function ($a, $b) {
                return $a['room_nr'] <=> $b['room_nr'];
            });

            if (!empty($room['children'])) {
                $this->sortRooms($room['children']);

                usort($room['children'], function ($a, $b) {
                    return $a['name'] <=> $b['name'];
                });
            }
        }
    }
}