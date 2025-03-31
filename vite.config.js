import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import process from 'node:process';

export default defineConfig({
  plugins: [
    laravel({
      input: 'resources/js/app.tsx',
      refresh: true,
    }),
    react(),
    tailwindcss()
  ],
  define: { 'import.meta.env.APP_URL': JSON.stringify(process.env.APP_URL) }
});
