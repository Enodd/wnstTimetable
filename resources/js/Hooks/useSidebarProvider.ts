import { SidebarContext } from '@/Providers/SidebarProvider';
import { useContext } from 'react';

export const useSidebarProvider = () => {
  return useContext(SidebarContext);
};
