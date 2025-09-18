<?php

namespace App\Models;

class Course extends generated\Course
{
    public function color()
    {
        return $this->hasMany(Color::class, 'name', 'type');
    }

    public function setGroups()
    {
        return $this->hasMany(SetGroup::class, 'id', 'id');
    }

    public function setConds()
    {
        return $this->hasMany(SetCond::class, 'id', 'id');
    }

    public function setRooms()
    {
        return $this->hasMany(SetRoom::class, 'id', 'id');
    }

    public function conductor(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Conductor::class, 'set_cond', 'id', 'id_cond');
    }

    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'set_rooms', 'id', 'id_room');
    }
}
