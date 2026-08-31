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
use Illuminate\Support\Collection;

class TimetableController extends Controller
{
    public function groups(Request $request, int $id)
    {
        $showAll = $request->boolean('all');
        $filters = $this->resolveFilters($request);
        $groupIds = $request->route('groupIds')
            |> (fn($x) => explode(',', $x))
            |> (fn($y) => array_map('intval', $y));

        $groupsQuery = Group::with([
            'setGroups.course',
            'setGroups.times:idEvent,start,dur,idWeek,idRoom',
            'setGroups.times.room.tree.parent.parent',
            'setGroups.course.color:name,color',
            'setGroups.course.conductor',
            'setGroups.course.room.tree.parent.parent',
        ]);

        // TODO: Wyczaić jak oznaczona jest sesja w bazie danych

        $groups = $showAll
            ? $groupsQuery->where('groups.id_group_tree', $id)->orderBy('id')->get()
            : $groupsQuery->where('groups.id', $id)->get();

        if ($groups->isEmpty()) {
            abort(404);
        }

        $timetables = $groups
            ->map(fn($group) => $this->buildTimetable($group->setGroups, $filters, 'group'))
            ->values();

        $parentTreeId = $showAll ? $id : $groups->first()->id_group_tree;
        $parent = GroupTree::with('parent.parent')
            ->where('id_group_tree', $parentTreeId)
            ->first()
            ?->toArray();

        $nesting = null;
        $this->nestParent($parent ?? [], $groups->first(), $nesting);

        return view('timetable', [
            'timetables' => $timetables,
            'nesting' => 'Grupy / ' . $nesting,
            'groupsMeta' => $groups->map(fn($g) => ['id' => $g->id, 'shortcut' => $g->shortcut])->values(),
            'headerMeta' => $this->getTimetableHeaderMeta(
                $showAll ? $groups->pluck('shortcut')->implode(', ') : $groups->first()->shortcut,
                $filters['selectedWeek']
            ),
            'filters' => $filters,
        ]);
    }

    public function rooms(Request $request, $roomNr)
    {
        $filters = $this->resolveFilters($request);

        $roomData = Room::with([
            'tree.parent.parent',
            'setRooms.course:id,name,shortcut,type,iNumberOfHours',
            'setRooms.times:idEvent,start,dur,idWeek,idRoom',
            'setRooms.times.room.tree.parent.parent',
            'setRooms.course.color:name,color',
            'setRooms.course.groups:id,shortcut',
            'setRooms.course.conductor:id,name,surname,title',
            'setRooms.course.room.tree.parent.parent',
        ])->where('nr_room', $roomNr)->first();

        $timetables = collect([
            $this->buildTimetable($roomData->setRooms, $filters, 'room', $roomData),
        ]);

        $parent = RoomTree::with('parent.parent')
            ->where('id_room_tree', $roomData->id_room_tree)
            ->first()
            ?->toArray();

        $nesting = null;
        $this->nestParent($parent ?? [], $roomData, $nesting);

        return view('timetable', [
            'timetables' => $timetables,
            'nesting' => 'Sale / ' . $nesting,
            'headerMeta' => $this->getTimetableHeaderMeta($roomNr, $filters['selectedWeek']),
            'filters' => $filters,
        ]);
    }

    public function conductors(Request $request, int $conductorId)
    {
        $filters = $this->resolveFilters($request);

        $condData = Conductor::with([
            'setCond.course:id,name,shortcut,type,iNumberOfHours',
            'setCond.times:idEvent,start,dur,idWeek,idRoom',
            'setCond.times.room.tree.parent.parent',
            'setCond.course.color:name,color',
            'setCond.course.room:id,nr_room,id_room_tree',
            'setCond.course.room.tree.parent.parent',
        ])->find($conductorId);

        $timetables = collect([
            $this->buildTimetable($condData->setCond, $filters, 'conductor'),
        ]);

        $parent = ConductorTree::with('parent.parent')
            ->where('id_cond_tree', $condData->id_cond_tree)
            ->first()
            ?->toArray();

        if ($parent) {
            $nesting = isset($parent['parent'])
                ? $parent['parent']['name'] . ' / ' . $parent['name']
                : $parent['name'];
        } else {
            $nesting = $condData->getFullTitle();
        }

        return view('timetable', [
            'timetables' => $timetables,
            'nesting' => 'Prowadzący / ' . $nesting,
            'headerMeta' => $this->getTimetableHeaderMeta(
                $condData->getFullTitle(),
                $filters['selectedWeek']
            ),
            'filters' => $filters,
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

    private function getTimetableHeaderMeta(string $subject, $week): array
    {
        $year = Description::query()->select(['year'])->first()->year;

        return [
            'subject' => $subject,
            'week' => $week->sDescript,
            'year' => $year,
        ];
    }

    private function resolveFilters(Request $request): array
    {
        $currentWeek = $this->getCurrentWeek();
        $weeks = Week::query()
            ->select(['idWeek', 'sDescript'])
            ->orderBy('idWeek')
            ->get();
        $firstWeek = $weeks->first();
        $currentWeek = $currentWeek ?? $firstWeek;

        $wholeSem = $request->query('semester', null);
        $parity = $request->query('parity', null);
        $parity = in_array($parity, ['even', 'odd'], true) ? $parity : null;

        $requestedWeekId = $request->query('weekId', null);
        $selectedWeek = $weeks->firstWhere(
            'idWeek',
            (int)($requestedWeekId ?? $currentWeek->idWeek)
        ) ?? $currentWeek;
        $weekId = $selectedWeek->idWeek;
        $weekLimit = (int)$weekId;

        if ($wholeSem) {
            $mode = 'semester';
        } elseif ($parity !== null) {
            $mode = 'parity';
        } else {
            $mode = 'week';
        }

        $session = $request->query('session', null);
        $session = in_array($session, ['winter', 'summer'], true) ? $session : null;

        return [
            'mode' => $mode,
            'weekId' => $weekId ?? $currentWeek->idWeek,
            'weekLimit' => $weekLimit,
            'weeks' => $weeks,
            'firstWeek' => $firstWeek,
            'currentWeek' => $currentWeek,
            'selectedWeek' => $selectedWeek,
            'parity' => $parity,
            'session' => $session,
            'semester' => $wholeSem
        ];
    }

    private function nestParent(array $parent, Room | Group $objectData, &$nesting): void
    {
        if ($parent) {
            if (isset($parent['parent']['parent'])) {
                $nesting = $parent['parent']['parent']['name'] . ' / ' . $parent['parent']['name'];
            } elseif (isset($parent['parent'])) {
                $nesting = $parent['parent']['name'];
            } else {
                $nesting = $parent['name'];
            }
        } else {
            $nesting = $objectData->getDescription();
        }
    }

    private function buildTimetable(
        Collection $items,
        array $filters,
        string $context,
        ?Room $contextRoom = null
    ): Collection {
        return $items
            ->flatMap(fn($item) => $this->buildEventsForItem(
                $item,
                $filters,
                $context,
                $contextRoom
            ))
            ->values();
    }

    private function buildEventsForItem(
        $item,
        array $filters,
        string $context,
        ?Room $contextRoom
    ): Collection {
        return $this->resolveTimes($item, $filters)
            ->map(fn($time) => $this->buildTimetableEvent(
                $item,
                $time,
                $context,
                $contextRoom
            ))
            ->filter();
    }

    private function buildTimetableEvent(
        $item,
        $time,
        string $context,
        ?Room $contextRoom
    ): ?object {
        $event = clone $item;
        $event->setRelation('time', $time);
        $event->color = $event->course->color[0]['color'] ?? null;

        $timeRoom = $time->relationLoaded('room') ? $time->room : null;
        $assignedRooms = $this->resolveAssignedRooms($event->course->room);

        if ($this->isOutsideRoomContext($context, $contextRoom, $timeRoom, $assignedRooms)) {
            return null;
        }

        $rooms = $this->resolveEventRooms($timeRoom, $contextRoom, $assignedRooms);
        $event->room_locations = $this->formatRoomLocations($rooms);

        if ($context === 'room') {
            $this->addRoomContextLabels($event);
        }

        return $event;
    }

    private function isOutsideRoomContext(
        string $context,
        ?Room $contextRoom,
        ?Room $timeRoom,
        Collection $assignedRooms
    ): bool {
        if ($context !== 'room' || $contextRoom === null) {
            return false;
        }

        if ($timeRoom !== null) {
            return $timeRoom->id !== $contextRoom->id;
        }

        return !$assignedRooms->contains('id', $contextRoom->id);
    }

    private function resolveEventRooms(
        ?Room $timeRoom,
        ?Room $contextRoom,
        Collection $assignedRooms
    ): Collection {
        return match (true) {
            $timeRoom !== null => collect([$timeRoom]),
            $contextRoom !== null => collect([$contextRoom]),
            default => $assignedRooms,
        };
    }

    private function formatRoomLocations(Collection $rooms): array
    {
        return $rooms
            ->map(fn(Room $room) => [
                'room' => trim((string) $room->nr_room),
                'address' => $room->getLocationLabel(),
            ])
            ->filter(fn(array $location) => $location['room'] !== '' || $location['address'] !== null)
            ->unique(fn(array $location) => $location['room'] . '|' . $location['address'])
            ->values()
            ->all();
    }

    private function addRoomContextLabels(object $event): void
    {
        $event->group_labels = $event->course->groups
            ->pluck('shortcut')
            ->filter()
            ->unique()
            ->values()
            ->all();
        $event->conductor_labels = $event->course->conductor
            ->map(fn($conductor) => trim($conductor->getFullTitle()))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function resolveAssignedRooms(Collection $rooms): Collection
    {
        $rooms = $rooms
            ->unique('id')
            ->values();

        if ($rooms->count() <= 1) {
            return $rooms;
        }

        $latestModification = $rooms
            ->map(fn(Room $room) => (string) ($room->pivot?->dtLastModified ?? ''))
            ->filter()
            ->max();

        if ($latestModification === null) {
            return $rooms;
        }

        return $rooms
            ->filter(fn(Room $room) => (string) $room->pivot?->dtLastModified === $latestModification)
            ->values();
    }

    private function resolveTimes($item, array $filters): Collection
    {
        $times = $item->times
            ->filter(fn($time) => $time->start !== null && $time->dur !== null);

        if ($filters['mode'] === 'semester') {
            return $times;
        }

        if ($filters['mode'] === 'parity') {
            $parity = $filters['parity'] === 'even' ? 0 : 1;

            return $times
                ->filter(fn($time) => (int) $time->idWeek === 0
                    || (int) $time->idWeek % 2 === $parity)
                ->values();
        }

        $selectedWeekTimes = $times
            ->where('idWeek', (int) $filters['weekId'])
            ->values();

        if ($selectedWeekTimes->isNotEmpty()) {
            return $selectedWeekTimes;
        }

        return $times
            ->where('idWeek', 0)
                ->values();
    }
}
