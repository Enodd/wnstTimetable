import { useConductors } from '@/Hooks/useConductors';
import { useGroups } from '@/Hooks/useGroups';
import { useRooms } from '@/Hooks/useRooms';
import { Conductors } from '@/Models/Conductor';
import { GroupTree } from '@/Models/Group';
import React, { createContext, PropsWithChildren } from 'react';
import { Rooms } from '@/Models/Room.ts';

interface SidebarProps {
  groups: GroupTree[];
  conductors: Conductors[];
  rooms: Rooms[];
}

export const SidebarContext = createContext<SidebarProps>({
  groups: [],
  conductors: [],
  rooms: [],
});

export const SidebarProvider: React.FC<PropsWithChildren> = ({ children }) => {
  const GroupTreeData = useGroups();
  const ConductorData = useConductors();
  const RoomsData = useRooms();

  return (
    <SidebarContext.Provider
      value={{
        groups: GroupTreeData.data ?? [],
        conductors: ConductorData.data ?? [],
        rooms: RoomsData.data ?? []
      }}
    >
      {children}
    </SidebarContext.Provider>
  );
};
