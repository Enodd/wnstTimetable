import { drawerStyles } from "@/Theme/common";
import { Components, CssVarsTheme, Theme } from "@mui/material";

/*
 * background-color: #ffffff;
opacity: 0.8;
background-image:  linear-gradient(#007eff 1.7000000000000002px, transparent 1.7000000000000002px), linear-gradient(to right, #007eff 1.7000000000000002px, #ffffff 1.7000000000000002px);
background-size: 34px 34px; 
 */

const componentOverrides: Components<
  Omit<Theme, "components" | "palette"> & CssVarsTheme
> = {
  MuiCssBaseline: {
    styleOverrides: (theme) => ({
      "html, body": {
        ...theme.site.background,
        minHeight: "100vh",
      },
      "*": { scrollbarColor: "transparent", appearance: "none" },
      "*::-webkit-scrollbar": {
        width: ".5rem",
        background: "rgba(0,0,0,0)",
      },
      "*::-webkit-scrollbar-corner": { background: "#0000" },
      "*::-webkit-scrollbar-thumb": {
        borderRadius: theme.spacing(2),
        background: theme.palette.primary.dark,
      },
    }),
  },
  MuiCard: { styleOverrides: { root: { ...drawerStyles } } },
  MuiButton: {
    variants: [
      {
        props: { variant: "outlined" },
        style: { borderWidth: "2px" },
      },
    ],
  },
  // MuiAccordion: {
  //   variants: [
  //     {
  //       props: { variant: "elevation" },
  //       style: {
  //         padding: 1,
  //         borderWidth: "1px",
  //         borderColor: palette.primary.dark,
  //         borderRadius: 5,
  //         backdropFilter: "blur(0px)",
  //         "&.Mui-expanded": { margin: 0 },
  //       },
  //     },
  //   ],
  // },
  // MuiAccordionDetails: { styleOverrides: { root: { paddingY: 0 } } },
};

export default componentOverrides;
