/* eslint-disable react/react-in-jsx-scope */
import '../css/app.css';
import './bootstrap';

import theme from '@/Theme/theme';
import { createInertiaApp } from '@inertiajs/react';
import { CssBaseline, ThemeProvider } from '@mui/material';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.tsx`,
      import.meta.glob('./Pages/**/*.tsx')
    ),
  setup({ el, App, props }) {
    const root = createRoot(el);

    root.render(
      <ThemeProvider theme={theme}>
        <CssBaseline />
        <App {...props} />
      </ThemeProvider>
    );
  },
  progress: { color: '#4B5563' },
});
