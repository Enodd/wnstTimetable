import { drawerStyles, siteBackground } from '@/Theme/common';
import { Components, CssVarsTheme, Palette, Theme } from '@mui/material';

const componentOverrides = (
  palette: Palette
): Components<Omit<Theme, 'components' | 'palette'> & CssVarsTheme> => ({
  MuiCssBaseline: {
    styleOverrides: (theme) => ({
      'html, body': {
        ...theme.site.background,
        minHeight: '100vh',
      },
      '*': { scrollbarColor: 'transparent', appearance: 'none' },
      '*::-webkit-scrollbar': {
        width: '.5rem',
        background: 'rgba(0,0,0,0)',
      },
      '*::-webkit-scrollbar-corner': { background: '#0000' },
      '*::-webkit-scrollbar-thumb': {
        borderRadius: theme.spacing(2),
        background: theme.palette.primary.main,
      },
    }),
  },
  MuiCard: { styleOverrides: { root: { ...drawerStyles }}},
  // MuiButton: {
  //   variants: [
  //     {
  //       props: { variant: 'outlined' },
  //       style: { borderWidth: '2px' },
  //     },
  //   ],
  // },
  // MuiAccordion: {
  //   variants: [
  //     {
  //       props: { variant: 'outlined' },
  //       style: {
  //         padding: 0,
  //         height: 'fit-content',
  //         borderWidth: 1,
  //         borderColor: palette.primary.dark,
  //         background: siteBackground(palette).backgroundColor,
  //         borderRadius: 5,
  //         '&.Mui-expanded': { margin: 0 },
  //       },
  //     },
  //   ],
  // },
  // MuiAccordionSummary: {
  //   styleOverrides: {
  //     root: {
  //       '&.MuiAccordionSummary-root': {
  //         minHeight: 0,
  //         height: 'fit-content',
  //         span: { '&.Mui-expanded': { margin: '4px 0' }},
  //       },
  //       '*:not(svg)': {
  //         margin: 2,
  //         padding: 0,
  //       },
  //     },
  //   },
  // },
  // MuiAccordionDetails: { styleOverrides: { root: { padding: '4px' }}},
});

export default componentOverrides;
