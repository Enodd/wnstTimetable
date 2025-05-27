<?php

namespace App\Models;

class ConductorTree
{
  public int $idCondTree;
  public ?string $name;
  public int $parent;
  public ?array $subGroups;
  /** @var Conductor[] */
  public ?array $conductors;

  public function __construct(
    int $idCondTree,
    ?string $name,
    int $parent,
  ) {
    $this->idCondTree = $idCondTree;
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
      "idCondTree" => $this->idCondTree,
      "subGroups" => $this->subGroups
    ];
  }
}
