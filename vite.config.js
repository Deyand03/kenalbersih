import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/admin.css',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/homepage.js',
                'resources/js/jadwal_admin.js',
                'resources/js/utility/chart_admin.js',
                'resources/js/utility/chart_homepage.js',
                'resources/js/utility/fetch_tahun.js',
                'resources/js/utility/iuran_rt.js',
                'resources/js/utility/jadwal_angkut.js',
                'resources/js/utility/laporan_pengeluaran.js',
                'resources/js/utility/navbar_iuran.js',
                'resources/js/utility/navbar_lapor_sampah.js',
                'resources/js/utility/profile.js',
            ],
            refresh: true,
        }),
    ],
})
