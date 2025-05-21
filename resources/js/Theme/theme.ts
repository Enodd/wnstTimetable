import { drawerStyles, siteBackground } from '@/Theme/common';
import componentOverrides from '@/Theme/component-overrides';
import { darkPalette, palette } from '@/Theme/palette';
import typography from '@/Theme/typography';
import { createTheme, CSSObject } from '@mui/material';

declare module '@mui/material/styles' {
  interface Theme {
    drawer: { width: number; styles: CSSObject };
    site: { background: CSSObject };
  }

  interface ThemeOptions extends Partial<Theme> {
    drawer: { width: number; styles: CSSObject };
    site: { background: CSSObject };
  }
}

const buildTheme = (darkMode: boolean = false) => {
  const currentPalette = darkMode ? darkPalette : palette;

  return createTheme({
    components: componentOverrides(currentPalette),
    typography: typography(currentPalette),
    palette: currentPalette,
    drawer: {
      width: 350,
      styles: drawerStyles(currentPalette),
    },
    site: { background: siteBackground(currentPalette) },
  });
};

export default buildTheme;
