<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\ConductorTree;
use App\Models\Description;
use App\Models\Group;
use App\Models\GroupTree;
use App\Models\Room;
use App\Models\RoomTree;
use App\Models\Week;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function groups(Request $request, int $groupId)
    {
        $weekId = $request->query('weekId', null);
        $currentWeekId = $this->getCurrentWeek();
        $firstWeek = Week::query()->select('idWeek')->first();
        $weekLimit = (int)($weekId ?? $currentWeekId->idWeek ?? $firstWeek->idWeek);

        $groupData = Group::with([
            'setGroups.course',
            'setGroups.time:idEvent,start,dur,idWeek',
            'setGroups.course.color:name,color',
            'setGroups.course.conductor',
            'setGroups.course.room',
        ])->find($groupId);

        $parent = GroupTree::with('parent.parent')->where('id_group_tree', $groupData->id_group_tree)->first()->toArray();

        if ($parent) {
            if (isset($parent['parent']['parent'])) {
                $nesting = $parent['parent']['parent']['name'] . ' / ' . $parent['parent']['name'];
            } elseif (isset($parent['parent'])) {
                $nesting = $parent['parent']['name'];
            } else {
                $nesting = $parent['name'];
            }
        } else {
            $nesting = $groupData->getDescription();
        }

        $timetable = $groupData->setGroups->filter(function ($setGroup) use ($weekLimit, $firstWeek) {
            if ($setGroup->course->iNumberOfHours === 0) return true;
            $startWeek = $setGroup->time->idWeek === 0 ? $firstWeek->idWeek : $setGroup->time->idWeek;
            $durationWeeks = (int)ceil($setGroup->course->iNumberOfHours / ($setGroup->time->dur / 3));
            $endWeek = $startWeek + $durationWeeks - 1;
            return $weekLimit >= $startWeek && $weekLimit <= $endWeek;
        })->map(function ($setGroup) {
            $setGroup->course->color = $setGroup->course->color[0]['color'];
            return $setGroup;
        });

        return view('timetable', [
            'timetable' => $timetable,
            'nesting' => 'Grupy / ' . $nesting,
            'title' => $this->getTimetableTitle($groupData->shortcut, $currentWeekId ?? $firstWeek),
        ]);
    }

    private function getCurrentWeek()
    {
        $currentWeekId = Week::query()
            ->where('dtStart', '<=', now())
            ->whereRaw('DATE_ADD(dtStart, INTERVAL 6 DAY) >= ?', [now()])
            ->select(['idWeek', 'sDescript'])
            ->first();
        $firstWeek = Week::query()->select(['idWeek', 'sDescript'])->first();
        return $currentWeekId ?? $firstWeek;
    }

    private function getTimetableTitle($contentValue, $week)
    {
        $year = Description::query()->select(['year'])->first()->year;
        return $contentValue . ', tydzień ' . $week->sDescript . ', rok ' . $year;
    }

    public function rooms(Request $request, $roomNr)
    {
        $weekId = $request->query('weekId', null);
        $currentWeek = $this->getCurrentWeek();
        $roomData = Room::with([
            'setRooms.course:id,name,shortcut,type,iNumberOfHours',
            'setRooms.time:idEvent,start,dur,idWeek',
            'setRooms.course.color:name,color'
        ])->where('nr_room', $roomNr)->first();
        $firstWeek = Week::query()->select(['idWeek', 'sDescript'])->first();
        $weekLimit = (int)($weekId ?? $currentWeek->idWeek ?? $firstWeek->idWeek);

        $timetable = $roomData->setRooms->filter(function ($setRoom) use ($weekLimit, $firstWeek) {
            if ($setRoom->course->iNumberOfHours === 0) return true;
            $startWeek = $setRoom->time->idWeek === 0 ? $firstWeek->idWeek : $setRoom->time->idWeek;
            $durationWeeks = (int)ceil($setRoom->course->iNumberOfHours / ($setRoom->time->dur / 3));
            $endWeek = $startWeek + $durationWeeks - 1;
            return $weekLimit >= $startWeek && $weekLimit <= $endWeek;
        })->map(function ($setRoom) {
            $setRoom->course->color = $setRoom->course->color[0]['color'];
            return $setRoom;
        });

        $parent = RoomTree::with('parent.parent')->where('id_room_tree', $roomData->id_room_tree)->first()->toArray();
        if ($parent) {
            if (isset($parent['parent']['parent'])) {
                $nesting = $parent['parent']['parent']['name'] . ' / ' . $parent['parent']['name'];
            } elseif (isset($parent['parent'])) {
                $nesting = $parent['parent']['name'];
            } else {
                $nesting = $parent['name'];
            }
        } else {
            $nesting = $roomData->getDescription();
        }

        return view('timetable', [
            'timetable' => $timetable,
            'nesting' => 'Sale / ' . $nesting,
            'title' => $this->getTimetableTitle($roomNr, $currentWeek ?? $firstWeek),
        ]);
    }

    public function conductors(Request $request, int $conductorId)
    {
        $weekId = $request->query('weekId', null);
        $currentWeek = $this->getCurrentWeek();
        $condData = Conductor::with([
            'setCond.course:id,name,shortcut,type,iNumberOfHours',
            'setCond.time:idEvent,start,dur,idWeek',
            'setCond.course.color:name,color'
        ])->find($conductorId);
        $firstWeek = Week::query()->select(['idWeek', 'sDescript'])->first();
        $weekLimit = (int)($weekId ?? $currentWeek->idWeek ?? $firstWeek->idWeek);

        $timetable = $condData->setCond->filter(function ($setCond) use ($weekLimit, $firstWeek) {
            if ($setCond->course->iNumberOfHours === 0) return true;
            $startWeek = $setCond->time->idWeek === 0 ? $firstWeek->idWeek : $setCond->time->idWeek;
            $durationWeeks = (int)ceil($setCond->course->iNumberOfHours / ($setCond->time->dur / 3));
            $endWeek = $startWeek + $durationWeeks - 1;
            return $weekLimit >= $startWeek && $weekLimit <= $endWeek;
        })->map(function ($setCond) {
            $setCond->course->color = $setCond->course->color[0]['color'];
            return $setCond;
        });

        $parent = ConductorTree::with('parent.parent')->where('id_cond_tree', $condData->id_cond_tree)->first()->toArray();
        if ($parent) {
            if (isset($parent['parent'])) {
                $nesting = $parent['parent']['name'] . ' / ' . $parent['name'];
            } else {
                $nesting = $parent['name'];
            }
        } else {
            $nesting = $condData->getFullTitle();
        }

        return view('timetable', [
            'timetable' => $timetable,
            'nesting' => 'Prowadzący / ' . $nesting,
            'title' => $this->getTimetableTitle('<strong>' . $condData->getFullTitle() . '</strong>', $currentWeek ?? $firstWeek),
        ]);
    }
}
