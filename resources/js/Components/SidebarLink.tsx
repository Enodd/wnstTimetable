import { Link, styled } from '@mui/material';

export const SidebarLink = styled(Link)(function ({ theme }) {
  return {
    padding: `${theme.spacing(1)} ${theme.spacing(2.6)}`,
    color: theme.palette.primary.main,
    borderWidth: 1,
    borderRadius: 4,
  };
});
