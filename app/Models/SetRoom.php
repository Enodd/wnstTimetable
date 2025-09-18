<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SetRoom extends generated\SetRoom
{
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'id_room');
    }

    public function course(): HasOne
    {
        return $this->hasOne(Course::class, 'id', 'id');
    }

    public function time(): HasOne
    {
        return $this->hasOne(Time::class, 'idEvent', 'id');
    }
}
