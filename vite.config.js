import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

//importar vite.config.js ruta Bootstrap 5 https://innsotech.com/como-instalar-bootstrap-5-en-laravel-9-con-vite/
export default defineConfig({
    plugins: [
        laravel([
            'resources/js/app.js',
        ]),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});