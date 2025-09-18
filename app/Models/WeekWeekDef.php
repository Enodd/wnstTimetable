<?php

namespace App\Models;

class WeekWeekDef extends generated\Weekweekdef
{
    public function weekDef() {
        return $this->hasMany(WeekDef::class, 'idWeekDef', 'idWeekDef');
    }
    public function week() {
        return $this->hasMany(Week::class, 'idWeek', 'idWeek');
    }
}
