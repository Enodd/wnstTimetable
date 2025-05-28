export interface Rooms {
  id_room_tree: number
  name: string
  parent: number
  rooms: Room[]
  children: Rooms[]
}

export interface Room {
  id: number
  room_nr: string
  capacity: number
  comment: string
  type: string
}