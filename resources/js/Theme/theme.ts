import { drawerStyles } from '@/Theme/common';
import componentOverrides from '@/Theme/component-overrides';
import palette from '@/Theme/palette';
import typography from '@/Theme/typography';
import { createTheme, CSSObject } from '@mui/material';

declare module '@mui/material/styles' {
  interface Theme {
    drawer: { width: number; styles: CSSObject };
  }
  interface ThemeOptions extends Partial<Theme> {
    drawer: { width: number; styles: CSSObject };
  }
}

const theme = createTheme({
  components: componentOverrides,
  typography,
  palette,
  drawer: {
    width: 350,
    styles: drawerStyles,
  },
});

export default theme;
