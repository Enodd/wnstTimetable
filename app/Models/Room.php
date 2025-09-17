<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends generated\Room
{
    public function tree(): BelongsTo
    {
        return $this->belongsTo(RoomTree::class, 'id_room_tree');
    }
    public function getDescription(): string
    {
        return $this->nr_room;
    }
}
