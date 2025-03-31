<?php

namespace App\Models;

class Conductor
{
  private int $id;
  private string $name;
  private string $surname;
  private string $shortcut;
  private string $title;
  private int $room;
  private string $mail;

  public function __construct(
    int $id,
    string $name,
    string $surname,
    string $shortcut,
    string $title,
    int $room,
    string $mail,
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->surname = $surname;
    $this->shortcut = $shortcut;
    $this->title = $title;
    $this->room = $room;
    $this->mail = $mail;
  }
  public function getId()
  {
    return $this->id;
  }
  public function getName()
  {
    return $this->name;
  }
  public function getShortcut()
  {
    return $this->shortcut;
  }
  public function getSurname()
  {
    return $this->surname;
  }
  public function getTitle()
  {
    return $this->title;
  }
  public function getRoom()
  {
    return $this->room;
  }
  public function getMail()
  {
    return $this->mail;
  }
}
