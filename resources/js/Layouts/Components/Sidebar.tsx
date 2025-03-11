import React, { useState } from 'react';
import { Box, Drawer, Stack, Tab, Tabs, Typography, useMediaQuery, useTheme } from '@mui/material';

interface SidebarProps {
  open: boolean;
}

enum SidebarTabs {
  Groups,
  Teachers,
  Classes
}

const Sidebar: React.FC<SidebarProps> = (props: SidebarProps) => {
  const theme = useTheme();
  const isMdUp = useMediaQuery(theme.breakpoints.up('md'));
  const [activeTab, setActiveTab] = useState<SidebarTabs>(SidebarTabs.Groups);

  const tabStyles = {
    fontWeight: 'bold',
    color: '#c1c1c1',
    '&.Mui-selected': { color: theme.palette.primary.contrastText }
  };

  const handleTabChange = (event: React.SyntheticEvent, value: number) => {
    setActiveTab(value);
  };

  return (
    <Drawer
      open={props.open}
      variant={isMdUp ? 'persistent' : 'temporary'}
      sx={{
        '& .MuiDrawer-paper': {
          margin: theme.spacing(1),
          marginRight: 0,
          maxWidth: '350px',
          height: `calc(100vh - ${theme.spacing(2)})`,
          ...theme.drawer.styles,
          paddingY: theme.spacing(4),
        },
      }}
    >
      <Stack
        alignItems={'center'}
        height={'100%'}
        justifyContent={'space-between'}>
        <Stack alignItems={'center'}
          gap={0.5}>
          <Typography textAlign={'center'}
            variant='h3'>
            Wydział nauk ścisłych i&nbsp;technicznych
          </Typography>
          <Typography variant='h4'>Uniwersytet Śląski</Typography>
          <Typography variant='h5'>2024/2025</Typography>
          <Typography variant='body1'>semestr letni</Typography>
        </Stack>
        <Box flexGrow={5}>
          <Stack
            direction={'row'}>
            <Tabs
              indicatorColor='secondary'
              value={activeTab}
              onChange={handleTabChange}
            >
              <Tab
                label='Grupy'
                sx={tabStyles}
                value={SidebarTabs.Groups}
              />
              <Tab
                label={'Nauczyciele'}
                sx={tabStyles}
                value={SidebarTabs.Teachers}
              />
              <Tab
                label='Sale'
                sx={tabStyles}
                value={SidebarTabs.Classes}
              />
            </Tabs>
          </Stack>
        </Box>
        <Stack alignItems={'center'}>
          <Typography>Obsługa rezerwacji</Typography>
          <Typography>Info</Typography>
          <Typography>Pomoc</Typography>
          <Typography>Zaloguj się</Typography>
          <Typography mt={4}
            textAlign={'center'}>
            Ostatnia aktualizacja bazy: <br />{' '}
            {new Date().toLocaleDateString()}
          </Typography>
        </Stack>
      </Stack>
    </Drawer>
  );
};

export default Sidebar;
