<?php

namespace App\Models;

class GroupTree
{
  public int $idGroupTree;
  public ?string $name;
  public int $parent;
  public ?array $subGroups;

  public function __construct(
    int $idGroupTree,
    ?string $name,
    int $parent,
  ) {
    $this->idGroupTree = $idGroupTree;
    $this->name = $name;
    $this->parent = $parent;
    $this->subGroups = [];
  }

  /**
   * Get group details as an associative array
   * 
   * @return array{id: int, name: ?string, idGroupTree: int, semester: int, shortcut: string, nrStud: int}
   */
  public function getValues(): array
  {
    return [
      "name" => $this->name,
      "idGroupTree" => $this->idGroupTree,
      "subGroups" => $this->subGroups
    ];
  }
  /** @param GroupTree[] $childrenGroup */
  public function addChildrenGroup($childrenGroup)
  {
    foreach ($childrenGroup as $cGroup) {
      array_push($this->subGroups, $cGroup);
    }
  }
}
