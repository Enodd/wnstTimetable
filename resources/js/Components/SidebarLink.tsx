import { hoverBarAnimation } from '@/Theme/hoverBarAnimation';
import { styled, Link } from '@mui/material';

export const SidebarLink = styled(Link)(function ({ theme }) {
  return ({
    background: '#c1c1c111',
    backdropFilter: 'blur(4px)',
    padding: theme.spacing(1.75),
    color: theme.palette.primary.light,
    boxShadow: '0px 2px 3px ' + theme.palette.primary.light,
    borderRadius: 4,
    ...hoverBarAnimation(theme.palette.primary.light)
  });
});