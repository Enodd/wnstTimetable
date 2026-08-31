<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Time extends generated\Time
{
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'idRoom');
    }
}
