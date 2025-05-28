import { Link, styled } from '@mui/material';

export const SidebarLink = styled(Link)(function ({ theme }) {
  return {
    padding: `${theme.spacing(1)} ${theme.spacing(2.6)}`,
    color: theme.palette.primary.main,
    borderWidth: 0.25,
    borderRadius: 4,
    willChange: 'border-color',
    transition: '100ms ease-out',
    '&:hover': { borderColor: theme.palette.info.main }
  };
});
