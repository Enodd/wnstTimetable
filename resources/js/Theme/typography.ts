import palette from '@/Theme/palette';
import createTypography from '@mui/material/styles/createTypography';

const typography = createTypography(palette, {
  allVariants: {
    color: '#ffffff',
    fontFamily: 'Mulish',
  },
  h6: { fontSize: '0.875rem', fontWeight: 'bold' },
  body1: { fontSize: '1rem' },
  h5: { fontSize: '1.125rem', fontWeight: 'bold'   },
  h4: { fontSize: '1.25rem', fontWeight: 'bold' },
  h3: { fontSize: '1.5rem', fontWeight: 'bold' },
  h2: { fontSize: '1.875rem', fontWeight: 'bold' },
  h1: { fontSize: '2.25rem', fontWeight: 'bold' },
});

export default typography;
