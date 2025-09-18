<?php

namespace App\Models;

class Week extends generated\Week
{
    public function weekDef()
    {
        return $this->belongsToMany(
            WeekDef::class,
            'weekdef',
            'idWeek',
            'idWeekDef'
        );
    }
}
