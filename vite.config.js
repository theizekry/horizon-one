import { defineConfig } from 'vite'

import laravel from 'laravel-vite-plugin';
import collectModuleAssetsPaths from './vite-module-loader.js';
import vue from '@vitejs/plugin-vue'
import path from "path";

async function getConfig() {
    return defineConfig(async ({mode}) => {

            const paths = [
                'resources/css/app.css',
                'resources/js/app.js',
            ];
            const allPaths = await collectModuleAssetsPaths(paths, 'Modules');
            return {
                server: {
                    host: '0.0.0.0',
                    hmr: {
                        host: 'app.horizon.one.node'
                    },
                    allowedHosts: ['app.horizon.one.node', 'localhost', '127.0.0.1']
                },
                plugins: [
                    laravel({
                        input: allPaths,
                        refresh: false,
                    }),
                    vue(),
                ],
                resolve: {
                    alias: {
                        "@": path.resolve(__dirname, ''),
                        "@dashboard": path.resolve(__dirname, 'Modules/Dashboard/resources/assets/vue'),
                        "@modules": path.resolve(__dirname, 'Modules'),
                        vue: 'vue/dist/vue.esm-bundler.js',
                    },
                },
            }
        }
    );
};


export default getConfig()
