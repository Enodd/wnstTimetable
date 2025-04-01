import { useGroups } from '@/Hooks/useGroups';
import { GroupTree } from '@/Models/Group';
import React, { createContext, PropsWithChildren } from 'react';

interface SidebarProps {
  groups: GroupTree[]
}

export const SidebarContext = createContext<SidebarProps>({ groups: [] });

export const SidebarProvider: React.FC<PropsWithChildren> = ({ children }) => {
  const GroupTreeData = useGroups();
  return <SidebarContext.Provider value={{ groups: GroupTreeData.data ?? [] }}>
    {children}
  </SidebarContext.Provider>;
};