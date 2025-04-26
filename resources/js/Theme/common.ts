import { CSSObject, Palette } from "@mui/material";

export const drawerStyles: CSSObject = {
  background: "#fff",
  border: "2px solid",
  color: "#000",
  padding: "4px",
};

export const siteBackground = (palette: Palette): CSSObject => ({
  backgroundColor: palette.primary.contrastText,
  backgroundImage: `linear-gradient(${palette.primary.light} 1.7000000000000002px, transparent 1.7000000000000002px),
   linear-gradient(to right, ${palette.primary.light} 1.7000000000000002px, ${palette.primary.contrastText} 1.7000000000000002px)`,
  backgroundSize: "29px 29px",
});
