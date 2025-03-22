import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    
    build: {
        outDir: 'public/build',
        manifest: true,
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['vue', 'axios']
                }
            }
        },
        // Optimizaciones para producción
        minify: 'terser',
        chunkSizeWarningLimit: 1000,
        terserOptions: {
            compress: {
                drop_console: true, // Elimina console.logs
                drop_debugger: true
            }
        }
    }
});