<?php

namespace App\Models;

use App\Models\generated\CondTree;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConductorTree extends CondTree
{

    public function conductors(): HasMany
    {
        return $this
            ->hasMany(Conductor::class, 'id_cond_tree')
            ->orderBy('surname');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ConductorTree::class, 'parent', 'id_cond_tree');
    }

    public function children(): HasMany
    {
        return $this
            ->hasMany(ConductorTree::class, 'parent', 'id_cond_tree')
            ->orderBy('name');
    }

    public function toNestedArray(): array
    {
        return [
            'id_cond_tree' => $this->id_cond_tree,
            'name' => $this->name,
            'conductors' => $this->conductors->map(fn($c) => [
                'id' => $c->id,
                'name' => $c->name,
                'surname' => $c->surname,
                'title' => $c->title,
                'room' => $c->room,
                'shortcut' => $c->shortcut,
                'description' => $c->getDescription(),
            ])->toArray(),
            'children' => $this->children->map->toNestedArray()->toArray(),
        ];
    }

}
