<?php

namespace App\Models;

class RoomTree 
{
  public int $idRoomTree;
  public string $name;
  public int $parent;
  public array $rooms;
  /** @var Room[] */
  public array $children;

  function __construct(int $idRoomTree, string $name, int $parent)
  {
      $this->idRoomTree = $idRoomTree;
      $this->name = $name;
      $this->parent = $parent;
      $this->children = [];
  }
}