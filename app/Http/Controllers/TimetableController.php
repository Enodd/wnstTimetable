<?php
namespace App\Http\Controllers;

use App\Models\Group;

class TimetableController extends Controller
{
    public function groups($groupId)
    {

        $groupData = Group::where('id', $groupId)
            ->with(['setGroups.course:id,name,shortcut,type', 'setGroups.time:idEvent,start,dur,idWeek'])
            ->first();
        return view('timetable.groups', ['timetable' => $groupData->setGroups]);
    }
}
