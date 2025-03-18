import { drawerStyles } from '@/Theme/common';
import { Components, CssVarsTheme, Theme } from '@mui/material';

const componentOverrides: Components<
    Omit<Theme, 'components' | 'palette'> & CssVarsTheme
> = {
  MuiCssBaseline: {
    styleOverrides: (theme) => ({
      'html, body': {
        backgroundColor: '#152844',
        backgroundImage: `
          radial-gradient(circle at 200px 200px, #1270B0 0%, transparent 40%),
          radial-gradient(circle at calc(100vw - 200px) calc(100vh - 200px), #1270B0 0%, transparent 40%)
          `,
        backgroundRepeat: 'no-repeat',
        minHeight: '100vh'
      },
      '*': { scrollbarColor: 'transparent' },
      '*::-webkit-scrollbar': {
        width: '.5rem',
        background: '#0000',
      },
      '*::-webkit-scrollbar-thumb': {
        borderRadius: theme.spacing(2),
        background: theme.palette.primary.light,
      },
    }),
  },
  MuiCard: { styleOverrides: { root: { ...drawerStyles }}},
  MuiButton: {
    variants: [
      {
        props: { variant: 'outlined' },
        style: { borderWidth: '2px' },
      },
    ],
  },
};

export default componentOverrides;
