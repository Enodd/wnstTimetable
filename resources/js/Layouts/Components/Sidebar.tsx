import React from 'react';
import { Box, Drawer, Stack, Tab, Tabs, Typography, useMediaQuery, useTheme } from '@mui/material';

interface SidebarProps {
  open: boolean;
}

const Sidebar: React.FC<SidebarProps> = (props: SidebarProps) => {
  const theme = useTheme();
  const isMdUp = useMediaQuery(theme.breakpoints.up('md'));
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
      <Stack height={'100%'}
        justifyContent={'space-between'}>
        <Stack alignItems={'center'}
          gap={1}>
          <Typography textAlign={'center'}
            variant='h1'>
            Wydział nauk ścisłych i technicznych
          </Typography>
          <Typography variant='h2'>Uniwersytet Śląski</Typography>
        </Stack>
        <Box>
          <Tabs>
            <Tab></Tab>
          </Tabs>
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
