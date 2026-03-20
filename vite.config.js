import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

const host = 'placeholder.test';

function detectTlsCerts() {
    // Laravel Herd
    const herdPath = path.resolve(process.env.HOME, `Library/Application Support/Herd/config/valet/Certificates/${host}.crt`);
    const herdKeyPath = path.resolve(process.env.HOME, `Library/Application Support/Herd/config/valet/Certificates/${host}.key`);
    if (fs.existsSync(herdPath)) {
        return { cert: herdPath, key: herdKeyPath };
    }

    // Laravel Valet
    const valetPath = path.resolve(process.env.HOME, `.config/valet/Certificates/${host}.crt`);
    const valetKeyPath = path.resolve(process.env.HOME, `.config/valet/Certificates/${host}.key`);
    if (fs.existsSync(valetPath)) {
        return { cert: valetPath, key: valetKeyPath };
    }

    return false;
}

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host,
        https: detectTlsCerts(),
        hmr: {
            host,
        },
    },
});
