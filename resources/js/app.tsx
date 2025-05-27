/* eslint-disable react/react-in-jsx-scope */
import { SidebarProvider } from '@/Providers/SidebarProvider';
import '../css/app.css';
import './bootstrap';

import theme from '@/Theme/theme';
import { createInertiaApp } from '@inertiajs/react';
import { CssBaseline, ThemeProvider } from '@mui/material';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
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
    const client = new QueryClient();
    const prefersDarkTheme = window.matchMedia(
      '(prefers-color-scheme: dark)'
    ).matches;
    const appTheme = theme(prefersDarkTheme);

    root.render(
      <QueryClientProvider client={client}>
        <ThemeProvider theme={appTheme}>
          <CssBaseline/>
          <SidebarProvider>
            <App {...props} />
          </SidebarProvider>
        </ThemeProvider>
      </QueryClientProvider>
    );
  },
  progress: { color: '#4B5563' },
});
