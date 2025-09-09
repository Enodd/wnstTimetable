<?php

namespace App\Models;

use App\Models\generated\GroupTree as BaseGroupTree;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function children(): HasMany {
        return $this->hasMany(GroupTree::class, 'parent', 'id_group_tree');
    }

    public function toNestedArray(): array
    {
        return [
            'id_group_tree' => $this->id_group_tree,
            'name' => $this->name,
            'parent' => $this->parent,
            'groups' => $this->groups->map(fn($g) => [
                'id' => $g->id,
                'name' => $g->name,
                'semester' => $g->semester,
            ])->toArray(),
            'children' => $this->children->map->toNestedArray()->toArray(),
        ];
    }
}
