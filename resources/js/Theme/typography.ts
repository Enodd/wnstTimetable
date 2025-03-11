import palette from '@/Theme/palette';
import createTypography from '@mui/material/styles/createTypography';

const typography = createTypography(palette, {
  allVariants: {
    color: '#ffffff',
    fontFamily: 'Mulish',
  },
  h1: {
    fontSize: 'clamp(2rem, 1.7573rem + 0.7767vw, 3rem)',
    fontWeight: 'bold',
  },
  h2: {
    fontSize: 'clamp(1.5rem, 1.2573rem + 0.7767vw, 2.5rem)',
    fontWeight: 'bold',
  },
  h3: { fontWeight: 'bold' },
  h4: { fontWeight: 'bold' },
  h5: { fontWeight: 'bold' },
  h6: { fontWeight: 'bold' },
  body1: {},
  body2: {},
});

export default typography;
