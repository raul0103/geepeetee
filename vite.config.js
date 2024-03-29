import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.sass",
                "resources/js/app.js",
                "resources/js/pages/settings.js",
                "resources/js/pages/register.js",
            ],
            refresh: true,
        }),
    ],
});
