import { CSSObject, Palette } from '@mui/material';

export const drawerStyles = (palette: Palette): CSSObject => ({
  background: palette.background.default,
  borderRight: '2px solid',
  color: '#fff',
  padding: '4px',
});

export const siteBackground = (palette: Palette): CSSObject => ({
  backgroundColor: palette.background.default,
  // backgroundImage: `linear-gradient(${palette.primary.light} 1.7000000000000002px,
  //  transparent 1.7000000000000002px),
  //  linear-gradient(to right, ${palette.primary.light} 1.7000000000000002px,
  //  ${palette.background.default} 1.7000000000000002px)`,
  // backgroundSize: '29px 29px',
});
