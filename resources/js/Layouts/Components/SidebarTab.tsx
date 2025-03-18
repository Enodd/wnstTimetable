import SidebarTabs from '@/Models/SidebarTabs';
import { Stack } from '@mui/material';
import React from 'react';

const SidebarTab: React.FC<{ value: SidebarTabs, currentTab: SidebarTabs }> = ({ value, currentTab }) => {
  if (currentTab != value) {
    return <></>;
  }

  // TODO: dodać odpowiednie komponenty w zależności od logiki na bazie danych
  return <Stack>
    <div>{value}</div>
  </Stack>;
};

export default SidebarTab;