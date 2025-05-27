import { useConductors } from '@/Hooks/useConductors';
import { useGroups } from '@/Hooks/useGroups';
import { Conductors } from '@/Models/Conductor';
import { GroupTree } from '@/Models/Group';
import React, { createContext, PropsWithChildren } from 'react';

interface SidebarProps {
  groups: GroupTree[];
  conductors: Conductors[];
}

export const SidebarContext = createContext<SidebarProps>({
  groups: [],
  conductors: [],
});

export const SidebarProvider: React.FC<PropsWithChildren> = ({ children }) => {
  const GroupTreeData = useGroups();
  const ConductorData = useConductors();

  return (
    <SidebarContext.Provider
      value={{
        groups: GroupTreeData.data ?? [],
        conductors: ConductorData.data ?? [],
      }}
    >
      {children}
    </SidebarContext.Provider>
  );
};
