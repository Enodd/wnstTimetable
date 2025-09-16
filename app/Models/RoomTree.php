<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomTree extends generated\RoomTree
{
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'id_room_tree');
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(RoomTree::class, 'parent', 'id_room_tree');
    }
    public function children(): HasMany {
        return $this->hasMany(RoomTree::class, 'parent', 'id_room_tree');
    }

    public function toNestedArray(): array
    {
        return [
            'id_room_tree' => $this->id_room_tree,
            'name' => $this->name,
            'parent' => $this->parent,
            'rooms' => $this->rooms->map(fn($room) => [
                'id' => $room->id,
                'nr_room' => $room->nr_room,
            ])->toArray(),
            'children' => $this->children->map->toNestedArray()->toArray()
        ];
    }
}
