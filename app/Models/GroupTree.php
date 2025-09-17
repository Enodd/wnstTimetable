<?php

namespace App\Models;

use App\Models\generated\GroupTree as BaseGroupTree;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupTree extends BaseGroupTree
{
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'id_group_tree');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(GroupTree::class, 'parent', 'id_group_tree');
    }

    public function children(): HasMany
    {
        return $this->hasMany(GroupTree::class, 'parent', 'id_group_tree');
    }

    public function toNestedArray(): array
    {
        return [
            'id_group_tree' => $this->id_group_tree,
            'name' => $this->name,
            'groups' => $this->groups->map(fn($g) => [
                'id' => $g->id,
                'shortcut' => $g->shortcut,
                'semester' => $g->semester,
                'description' => $g->getDescription(),
            ])->toArray(),
            'children' => $this->children->map->toNestedArray()->toArray(),
        ];
    }
}
