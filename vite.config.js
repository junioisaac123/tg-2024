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

function getFilesFromDirRecursive(dir) {
    const files = fs.readdirSync(dir, { withFileTypes: true });
    const result = [];
    for (const file of files) {
        if (file.isDirectory()) {
            result.push(...getFilesFromDirRecursive(path.join(dir, file.name)));
        } else {
            result.push(path.join(dir, file.name));
        }
    }
    return result;
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                // 'resources/js/app.js',
                // Import all js files from Admin
                ...getFilesFromDirRecursive('resources/js', '.js'),
            ],
            refresh: true,
        }),
    ],
});
