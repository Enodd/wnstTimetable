<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SetGroup extends generated\SetGroup
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_group');
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
