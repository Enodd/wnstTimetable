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
}
