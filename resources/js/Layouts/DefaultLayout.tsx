import Sidebar from '@/Layouts/Components/Sidebar';
import {
  Box,
  IconButton,
  Stack,
  styled,
  useMediaQuery,
  useTheme
} from '@mui/material';
import React, {
  PropsWithChildren, useEffect, useState
} from 'react';
import { FaBars, FaTimes } from 'react-icons/fa';

interface MainLayoutProps {
  isOpen: boolean;
}

export const MainBody = styled(Stack)<MainLayoutProps>(({ theme, isOpen }) => ({
  minHeight: `calc(100vh - ${theme.spacing(1)})`,
  transition: theme.transitions.create(['margin', 'width'], {
    easing: theme.transitions.easing.sharp,
    duration: theme.transitions.duration.leavingScreen,
  }),
  ...(isOpen && {
    transition: theme.transitions.create(['margin', 'width'], {
      easing: theme.transitions.easing.easeOut,
      duration: theme.transitions.duration.enteringScreen,
    }),
    [theme.breakpoints.up('sm')]: {
      width: `calc(100% - ${theme.drawer.width}px - ${theme.spacing(2)})`,
      marginLeft: `calc(${theme.drawer.width}px + ${theme.spacing(2)})`,
      padding: theme.spacing(1) + ' ' + theme.spacing(2),
      paddingLeft: 0
    },
    [theme.breakpoints.down('sm')]: { width: '100%' },
  }),
}));

const DefaultLayout: React.FC<PropsWithChildren> = ({ children }) => {
  const theme = useTheme();
  const isMdDown = useMediaQuery(theme.breakpoints.down('md'));
  const [isSidebarOpen, setIsSidebarOpen] = useState<boolean>(!isMdDown);

  useEffect(() => {
    setIsSidebarOpen(!isMdDown);
  }, [isMdDown]);

  return (
    <Box>
      {isMdDown ? (
        <Stack
          direction={'row'}
          justifyContent={'flex-end'}
          mb={2}
          pt={2}
          px={2}
          sx={{
            position: 'sticky',
            top: 0,
            right: 0,
            zIndex: 1000,
          }}
        >
          <IconButton
            sx={{ color: '#000', background: '#fff' }}
            onClick={() => setIsSidebarOpen(true)}
          >
            {isSidebarOpen ? <FaTimes /> : <FaBars />}
          </IconButton>
        </Stack>
      ) : undefined}
      <Sidebar
        open={isSidebarOpen}
        onClose={() => setIsSidebarOpen(false)} />
      <MainBody isOpen={isSidebarOpen}>{children}</MainBody>
    </Box>
  );
};
export default DefaultLayout;
