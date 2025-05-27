import { Palette } from '@mui/material';
import createTypography from '@mui/material/styles/createTypography';

const typography = (palette: Palette) =>
  createTypography(palette, {
    allVariants: {
      color: palette.secondary.contrastText,
      fontFamily: 'Mulish',
    },
    h1: {
      fontSize: '30px',
      fontWeight: 'bold',
    },
    h2: {
      fontSize: '24px',
      fontWeight: 'bold',
    },
    h3: { fontWeight: 'bold', fontSize: '20px' },
    h4: { fontWeight: 'bold', fontSize: '18px' },
    h5: { fontWeight: 'bold', fontSize: '16px' },
    h6: { fontWeight: 'bold', fontSize: '14px' },
    body1: { fontSize: '16px' },
    body2: { fontSize: '16px' },
  });

export default typography;
