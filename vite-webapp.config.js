import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "tailwindcss";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/webapp/app.scss', 'resources/js/webapp/app.js'],
            refresh: true,
            buildDirectory: "/webapp-assets",
        }),
    ],
    css: {
        postcss: {
            plugins: [
                tailwindcss({
                    config: "./tailwind-webapp.config.js",
                }),
            ],
        },
    },
});
