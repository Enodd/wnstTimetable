<?php

namespace App\Models;

use App\Models\generated\GroupTree as BaseGroupTree;

class GroupTree extends BaseGroupTree
{
    static function getAggregatedGroupTree(): array {
        $groups = self::all(['id_group_tree', 'name', 'parent'])->toArray();
        $parentsArray = array_filter($groups, fn($group) => $group->parent == 0);
        self::aggregateGroups($parentsArray, $groups);
        return $parentsArray;
    }

    /**
     * @param $parentsArray BaseGroupTree[]
     * @param $groupArray BaseGroupTree[]
     */
    static function aggregateGroups(array &$parentsArray, array $groupArray): void
    {
        foreach ($parentsArray as $parent) {
            $subGroups = array_filter($groupArray, function($group) use ($parent) {
                return $group->parent == $parent->id_group_tree;
            });
            self::aggregateGroups($subGroups, $groupArray);
            $parent['children'] = $subGroups;
        }
    }
}
