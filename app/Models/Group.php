<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends generated\Group
{
    public function tree(): BelongsTo
    {
        return $this->belongsTo(ConductorTree::class, 'id_group_tree');
    }

    public function getDescription(): string
    {
        return $this->shortcut;
    }
}
