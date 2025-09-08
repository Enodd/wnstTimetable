<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conductor extends generated\Conductor
{
    public function tree(): BelongsTo
    {
        return $this->belongsTo(ConductorTree::class, 'id_cond_tree');
    }
}
