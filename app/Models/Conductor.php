<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conductor extends generated\Conductor
{
    public function tree(): BelongsTo
    {
        return $this->belongsTo(ConductorTree::class, 'id_cond_tree');
    }

    public function setCond()
    {
        return $this->hasMany(SetCond::class, 'id_cond');
    }

    public function getDescription(): string
    {
        return "$this->title $this->surname $this->name";
    }

    public function getFullTitle()
    {
        return "$this->title $this->name $this->surname";
    }
}
