import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/frontend-oneui.scss',
                'resources/sass/frontend.scss',
                'resources/sass/backend.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
