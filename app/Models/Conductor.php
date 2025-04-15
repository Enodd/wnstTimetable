<?php

namespace App\Models;

class Conductor
{
  public int $id;
  public string $name;
  public string $surname;
  public string $shortcut;
  public string $title;
  public int $room;
  public string $mail;
  public int $id_cond_tree;

  public function __construct(
    int $id,
    string $name,
    string $surname,
    string $shortcut,
    string $title,
    int $room,
    string $mail,
    int $id_cond_tree
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->surname = $surname;
    $this->shortcut = $shortcut;
    $this->title = $title;
    $this->room = $room;
    $this->mail = $mail;
  }
}
