<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\GroupTree;

class GroupTreeController extends Controller
{
  public function index()
  {
    $groups = DB::table('group_tree')->get(['id_group_tree', 'name', 'parent']);

    /** @var GroupTree[] */
    $groupArr = [];
    foreach ($groups as $group) {
      array_push($groupArr, new GroupTree($group->id_group_tree, $group->name, $group->parent));
    }

    $parentsArr = array_filter($groupArr, function ($group) {
      return $group->parent == 0;
    });

    $this->aggregateGroups($parentsArr, $groupArr);
    return $parentsArr;
  }

  /**
   * @param GroupTree[] $parentsArr
   * @param GroupTree[] $groupArr
   */
  public function aggregateGroups(&$parentsArr, $groupArr)
  {
    foreach ($parentsArr as $mainGroup) {
      $subGroups = array_filter($groupArr, function ($group) use ($mainGroup) {
        return $group->parent == $mainGroup->idGroupTree;
      });
      $this->aggregateGroups($subGroups, $groupArr);
      $mainGroup->addChildrenGroup($subGroups);
    }
  }
}
