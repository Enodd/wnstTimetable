import SidebarTabs from '@/Models/SidebarTabs';
import { Stack } from '@mui/material';
import React from 'react';

const SidebarTab: React.FC<{
  value: SidebarTabs,
  currentTab: SidebarTabs,
  view: React.ReactNode
}> = ({ value, currentTab, view }) => {

  if (currentTab != value) {
    return <></>;
  }

  return <Stack
    flexGrow={1}
    gap={0.75}
    my={2}>
    {view}
  </Stack>;
};

export default SidebarTab;