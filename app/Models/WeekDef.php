<?php

namespace App\Models;

class WeekDef extends generated\Weekdef
{
    public function week()
    {
        return $this->belongsToMany(
            Week::class,
            'weekweekdef',
            'idWeekDef',
            'idWeek',
        );
    }
}
