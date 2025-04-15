export interface Conductors {
  id_cond_tree: number;
  name:         string;
  parent:       number;
  conductors:   Conductor[];
  children:     Conductors[];
}

export interface Conductor {
  id:       number;
  name:     string;
  surname:  string;
  title:    string;
  room:     string;
  shortcut: string;
}