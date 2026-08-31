<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends generated\Room
{
    public function tree(): BelongsTo
    {
        return $this->belongsTo(RoomTree::class, 'id_room_tree');
    }
    public function setRooms()
    {
        return $this->hasMany(SetRoom::class, 'id_room');
    }
    public function getDescription(): string
    {
        return $this->nr_room;
    }

    public function getLocationLabel(): ?string
    {
        $segments = [];
        $node = $this->tree;

        for ($level = 0; $level < 3 && $node !== null; $level++) {
            $name = trim((string) $node->name);

            if ($name !== '') {
                array_unshift($segments, $name);
            }

            $node = $node->relationLoaded('parent')
                ? $node->getRelation('parent')
                : null;
        }

        $location = collect($segments)
            ->unique()
            ->implode(' / ');

        return $location !== '' ? $location : null;
    }
}
