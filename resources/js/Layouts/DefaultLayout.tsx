import Sidebar from '@/Layouts/Components/Sidebar';
import { Box, styled } from '@mui/material';
import React, { PropsWithChildren } from 'react';

interface MainLayoutProps {
  isOpen: boolean;
}

export const MainBody = styled(Box)<MainLayoutProps>(({ theme, isOpen }) => ({
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
      padding: theme.spacing(1)+' '+theme.spacing(2),
    },
    [theme.breakpoints.down('sm')]: { width: '100%' }
  }),
}));

const DefaultLayout: React.FC<PropsWithChildren> = ({ children }) => {
  return <>
    <Sidebar open={true} />
    <MainBody isOpen={true}>
      {children}
    </MainBody>
  </>;
};
export default DefaultLayout;