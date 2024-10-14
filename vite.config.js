import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

// trate multiple files from js
function gtFilesFromDir(dir, fileType) {
    const files = fs.readdirSync(dir);
    return files
        .filter((file) => path.extname(file) === fileType)
        .map((file) => path.join(dir, file));
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                // 'resources/js/app.js',
                // Import all js files from Admin
                ...gtFilesFromDir('resources/js', '.js'),
            ],
            refresh: true,
        }),
    ],
});
