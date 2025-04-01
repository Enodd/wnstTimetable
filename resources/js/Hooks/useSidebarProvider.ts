import { SidebarContext } from '@/Providers/SidebarProvider';
import { useContext } from 'react';

export const useSidebarProvider = () => {
  const data = useContext(SidebarContext);
  return data;
};
