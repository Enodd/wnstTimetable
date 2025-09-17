<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends generated\Group
{
    public function tree(): BelongsTo
    {
        return $this->belongsTo(ConductorTree::class, 'id_group_tree');
    }

    public function setGroups(): HasMany
    {
        return $this->hasMany(SetGroup::class, 'id_group');
    }

    public function getDescription(): string
    {
        return $this->shortcut;
    }
}
