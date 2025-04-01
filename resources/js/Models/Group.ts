export interface GroupTree {
  idGroupTree: number;
  name: string;
  parent: number;
  subGroups: GroupTree[];
}