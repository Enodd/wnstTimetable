<?php

namespace App\Models;

class Room {
    public int $id;
    public int $idRoomTree;
    public int $nrRoom;
    public int $capacity;
    public string $comment;
    public string $type;
    public function __construct(int $id, int $idRoomTree, int $nrRoom, int $capacity, string $comment, string $type) {
        $this->id = $id;
        $this->idRoomTree = $idRoomTree;
        $this->nrRoom = $nrRoom;
        $this->capacity = $capacity;
        $this->comment = $comment;
        $this->type = $type;
    }
}