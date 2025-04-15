<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Conductor;
use Illuminate\Support\Facades\DB;
use App\Models\ConductorTree;

class ConductorsTreeController extends Controller
{
  public function index(): array
  {
    $results = DB::table('cond_tree')
      ->leftJoin('conductors', 'cond_tree.id_cond_tree', '=', 'conductors.id_cond_tree')
      ->select(
        'cond_tree.id_cond_tree',
        'cond_tree.name as tree_name',
        'cond_tree.parent',
        'conductors.id as conductor_id',
        'conductors.name as conductor_name',
        'conductors.surname',
        'conductors.title',
        'conductors.room',
        'conductors.shortcut'
      )
      ->get();

    $conductors = [];
    /**
     * nesting all conductors within their corresponding parents
     */
    foreach ($results as $row) {
      $id = $row->id_cond_tree;

      if (!isset($conductors[$id])) {
        $conductors[$id] = [
          'id_cond_tree' => $id,
          'name' => $row->tree_name,
          'parent' => $row->parent,
          'conductors' => [],
          'children' => []
        ];
      }

      if ($row->conductor_id) {
        $conductors[$id]['conductors'][] = [
          'id' => $row->conductor_id,
          'name' => $row->conductor_name,
          'surname' => $row->surname,
          'title' => $row->title,
          'room' => $row->room,
          'shortcut' => $row->shortcut
        ];
      }
    }
    /**
     * This variable is nested structure of all conductors
     */
    $finalConductors = [];
    foreach ($conductors as $id => &$conductor) {
      if ($conductor['parent'] && isset($conductors[$conductor['parent']])) {
        $conductors[$conductor['parent']]['children'][] = &$conductor;
      } else {
        $finalConductors[] = &$conductor;
      }
    }

    $this->sortConductors($finalConductors);

    return $finalConductors;
  }

  private function sortConductors(&$conductors): void
  {
    usort($conductors, function ($a, $b) {
      return $a['name'] <=> $b['name'];
    });

    foreach ($conductors as &$conductor) {
      usort($conductor['conductors'], function ($a, $b) {
        return [$a['surname'], $a['name']] <=> [$b['surname'], $b['name']];
      });

      if (!empty($conductor['children'])) {
        $this->sortConductors($conductor['children']);

        usort($conductor['children'], function ($a, $b) {
          return $a['name'] <=> $b['name'];
        });
      }
    }
  }
}
