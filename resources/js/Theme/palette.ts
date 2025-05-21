import createPalette from '@mui/material/styles/createPalette';

declare module '@mui/material/styles' {
  interface Palette {
    extraColors?: {
      primaryDarkest: string;
    };
  }

  interface PaletteOptions {
    extraColors?: {
      primaryDarkest: string;
    };
  }
}

const palette = createPalette({
  primary: {
    light: '#A1C6EB',
    main: '#3568CC',
    dark: '#002E5A',
  },
  secondary: {
    light: '#ffffff',
    main: '#f0f0f0',
    dark: '#a0a0a0',
  },
  extraColors: { primaryDarkest: '#011635' },
  background: { default: '#ffffff' }
});

const darkPalette = createPalette({
  secondary: {
    light: '#A1C6EB',
    main: '#3568CC',
    dark: '#002E5A',
  },
  primary: {
    light: '#ffffff',
    main: '#f0f0f0',
    dark: '#a0a0a0',
  },
  extraColors: { primaryDarkest: '#011635' },
  background: { default: '#30303c' }
});

export { darkPalette, palette };
