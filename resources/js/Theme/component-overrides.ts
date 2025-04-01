import { drawerStyles } from '@/Theme/common';
import palette from '@/Theme/palette';
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
        background: 'rgba(0,0,0,0)',
      },
      '*::-webkit-scrollbar-corner': { background: '#0000' },
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
  MuiAccordion: {
    variants: [
      {
        props: { variant: 'elevation' },
        style: {
          padding: 1,
          background: '#c1c1c111', 
          borderWidth: '1px',
          borderColor: palette.primary.dark,
          borderRadius: 5,
          backdropFilter: 'blur(4px)',
          '&.Mui-expanded': { margin:0 }
        }
      },
    ]
  },
  MuiAccordionDetails: { styleOverrides: { root: { paddingY: 0 }}}
};

export default componentOverrides;
