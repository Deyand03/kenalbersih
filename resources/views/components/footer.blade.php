<footer class="relative bg-gradient-to-br from-[#016B61] to-[#004d46] pt-32 pb-10 overflow-hidden text-white mt-auto">
    <!-- Wave Animation with Layered Effect -->
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none" style="height: 200px;">
        <svg class="absolute bottom-0 left-0 pb-10" style="width: 200%; height: 250px;" viewBox="0 0 2880 200" preserveAspectRatio="none">
            <defs>
                <linearGradient id="waveGradient1" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#E0F7F4;stop-opacity:0.3" />
                    <stop offset="100%" style="stop-color:#F1FCFF;stop-opacity:0.5" />
                </linearGradient>
                <linearGradient id="waveGradient2" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#C9F0EC;stop-opacity:0.5" />
                    <stop offset="100%" style="stop-color:#F1FCFF;stop-opacity:0.7" />
                </linearGradient>
                <linearGradient id="waveGradient3" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#F1FCFF;stop-opacity:0.9" />
                    <stop offset="100%" style="stop-color:#F1FCFF;stop-opacity:1" />
                </linearGradient>
            </defs>

            <!-- Layer 1 - Bottom Wave (Slow Movement) -->
            <path
                id="wave1"
                d="M0,140 Q240,180 480,140 T960,140 T1440,140 T1920,140 T2400,140 T2880,140 L2880,0 L0,0 Z"
                fill="url(#waveGradient1)">
            </path>

            <!-- Layer 2 - Middle Wave (Medium Speed) -->
            <path
                id="wave2"
                d="M0,100 Q288,130 576,100 T1152,100 T1728,100 T2304,100 T2880,100 L2880,0 L0,0 Z"
                fill="url(#waveGradient2)">
            </path>

            <!-- Layer 3 - Top Wave (Fast Movement) -->
            <path
                id="wave3"
                d="M0,70 Q360,100 720,70 T1440,70 T2160,70 T2880,70 L2880,0 L0,0 Z"
                fill="url(#waveGradient3)">
            </path>
        </svg>
    </div>

    <!-- Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- Branding -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-white/10 backdrop-blur-sm rounded-lg border border-white/20 transition-all duration-300 hover:bg-white/20 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-wide">KenalBersih</span>
                </div>
                <p class="text-emerald-100 max-w-sm text-sm leading-relaxed">
                    Sistem informasi pengelolaan sampah dan iuran warga yang transparan, modern, dan terintegrasi untuk
                    lingkungan yang lebih asri.
                </p>

                <!-- Social Icons -->
                <div class="flex gap-4 mt-6">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 2.3 5.6 2.3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-bold text-lg mb-4 text-emerald-50">Tautan Cepat</h3>
                <ul class="space-y-3 text-sm text-emerald-100/80">
                    <li><a href="{{ route('homepage') }}" class="hover:text-white hover:pl-2 transition-all duration-300 block">Beranda</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white hover:pl-2 transition-all duration-300 block">Tentang Kami</a></li>
                    <li><a href="{{ route('pengeluaran') }}" class="hover:text-white hover:pl-2 transition-all duration-300 block">Transparansi</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white hover:pl-2 transition-all duration-300 block">Login Pengurus</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="font-bold text-lg mb-4 text-emerald-50">Kontak Kami</h3>
                <ul class="space-y-4 text-sm text-emerald-100/80">
                    <li class="flex items-start gap-3 transition-all duration-300 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5 shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Mendalo Indah, Jambi Luar Kota, Muaro Jambi, Jambi</span>
                    </li>
                    <li class="flex items-center gap-3 transition-all duration-300 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>kenalbersih.vercel.app</span>
                    </li>
                    <li class="flex items-center gap-3 transition-all duration-300 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>+62 8120000000</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-emerald-200/60">
            <p>&copy; 2025 KenalBersih. All rights reserved.</p>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition-colors duration-300">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors duration-300">Terms of Service</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wave1 = document.getElementById('wave1');
            const wave2 = document.getElementById('wave2');
            const wave3 = document.getElementById('wave3');

            gsap.to(wave1, {
                x: '-50%',
                duration: 20,
                ease: "none",
                repeat: -1
            });

            gsap.to(wave2, {
                x: '-50%',
                duration: 15,
                ease: "none",
                repeat: -1
            });

            gsap.to(wave3, {
                x: '-50%',
                duration: 10,
                ease: "none",
                repeat: -1
            });

            // Vertical wave oscillation untuk efek naik-turun
            const tl1 = gsap.timeline({ repeat: -1, yoyo: true });
            tl1.to(wave1, {
                attr: {
                    d: "M0,120 Q240,160 480,120 T960,120 T1440,120 T1920,120 T2400,120 T2880,120 L2880,0 L0,0 Z"
                },
                duration: 3,
                ease: "sine.inOut"
            });

            const tl2 = gsap.timeline({ repeat: -1, yoyo: true, delay: 0.5 });
            tl2.to(wave2, {
                attr: {
                    d: "M0,80 Q288,110 576,80 T1152,80 T1728,80 T2304,80 T2880,80 L2880,0 L0,0 Z"
                },
                duration: 2.5,
                ease: "sine.inOut"
            });

            const tl3 = gsap.timeline({ repeat: -1, yoyo: true, delay: 1 });
            tl3.to(wave3, {
                attr: {
                    d: "M0,55 Q360,85 720,55 T1440,55 T2160,55 T2880,55 L2880,0 L0,0 Z"
                },
                duration: 2,
                ease: "sine.inOut"
            });
        });
    </script>

    <style>
        /* Smooth rendering optimization */
        #wave1, #wave2, #wave3 {
            will-change: transform;
            transform-origin: center bottom;
        }

        /* Remove animation for users who prefer reduced motion */
        @media (prefers-reduced-motion: reduce) {
            #wave1, #wave2, #wave3 {
                animation: none !important;
            }
        }
    </style>
</footer>
