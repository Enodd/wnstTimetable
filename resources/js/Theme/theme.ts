import { drawerStyles, siteBackground } from "@/Theme/common";
import componentOverrides from "@/Theme/component-overrides";
import palette from "@/Theme/palette";
import typography from "@/Theme/typography";
import { createTheme, CSSObject } from "@mui/material";

declare module "@mui/material/styles" {
  interface Theme {
    drawer: { width: number; styles: CSSObject };
    site: { background: CSSObject };
  }
  interface ThemeOptions extends Partial<Theme> {
    drawer: { width: number; styles: CSSObject };
    site: { background: CSSObject };
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
  site: {
    background: siteBackground(palette),
  },
});

export default theme;
