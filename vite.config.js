// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // 1. Uncomment this

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',       // For Tailwind
                'resources/css/style.css',     // For your Green Design
                'resources/css/login-style.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(), // 2. Uncomment this
    ],
});