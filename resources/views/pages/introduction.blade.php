<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Introduction — Mengenal TYP Herbal Drink</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via Vite or CDN -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        html, body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #faf8f4;
            color: #1e1e1c;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            overflow-x: hidden;
        }
        .font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }
    </style>
</head>
<body class="min-h-dvh flex flex-col bg-[#faf8f4] text-[#1e1e1c] antialiased selection:bg-[#2b6346] selection:text-white">

    @php
        $currentUser = session('auth_user');
        $fullName = $currentUser['name'] ?? 'Rinaldi Mulya Putra';
        $shortName = explode(' ', trim($fullName))[0] ?: 'Rinaldi';
    @endphp

    <!-- Main Page Container (Responsive across all Windows & Mac desktop resolutions) -->
    <div class="flex-1 w-full max-w-[1320px] mx-auto px-5 sm:px-8 lg:px-10 py-4 xl:py-5 flex flex-col justify-between">
        <div>
            <!-- Floating Pill Header Navbar -->
            <header class="w-full bg-white rounded-full border border-[#ebe6dc] px-6 sm:px-8 py-2.5 xl:py-3 flex items-center justify-between shadow-[0_2px_12px_rgba(0,0,0,0.02)]">
                <!-- Left: Logo from public/image/image.png -->
                <a href="{{ route('home') }}" class="inline-flex items-center focus:outline-none">
                    <img
                        src="{{ asset('image/image.png') }}"
                        alt="TYP Herbal Drink"
                        class="h-10 sm:h-11 xl:h-12 w-auto object-contain mix-blend-multiply -ml-1"
                    >
                </a>

                <!-- Center: Navigation Links -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-3 text-xs">
                    <a
                        href="{{ route('introduction') }}"
                        class="bg-[#e3ece6] text-[#1f5135] font-bold px-5 py-2 rounded-full transition"
                    >
                        Introduction
                    </a>
                    <a
                        href="{{ route('beranda') }}"
                        class="text-[#5c5953] hover:text-[#1e1e1c] font-medium px-4 py-2 rounded-full transition"
                    >
                        Home
                    </a>
                    <a
                        href="{{ route('products') }}"
                        class="text-[#5c5953] hover:text-[#1e1e1c] font-medium px-4 py-2 rounded-full transition"
                    >
                        Products
                    </a>
                    <a
                        href="#orders"
                        class="text-[#5c5953] hover:text-[#1e1e1c] font-medium px-4 py-2 rounded-full transition"
                    >
                        Orders
                    </a>
                </nav>

                <!-- Right: User Profile & Bag Icon -->
                <div class="flex items-center gap-3.5">
                    <div class="relative group">
                        <button type="button" class="inline-flex items-center gap-2 text-xs font-medium text-[#3b3935] hover:text-[#1e1e1c] py-1 cursor-pointer focus:outline-none">
                            <svg class="w-4 h-4 text-[#4a4843]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>{{ $shortName }}</span>
                            <svg class="w-3.5 h-3.5 text-[#7a766e]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                    </div>

                    <div class="h-4 w-px bg-[#e5dfd3]"></div>

                    <button type="button" aria-label="Keranjang" class="text-[#3b3935] hover:text-[#24583c] p-1 transition cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Hero Card: Mengenal TYP / Herbal Drink -->
            <section class="mt-4 xl:mt-5 rounded-[26px] bg-[#e7efe9] border border-[#dce6df] overflow-hidden grid grid-cols-1 lg:grid-cols-12 items-stretch">
                <!-- Left Column: Copy & CTA -->
                <div class="lg:col-span-6 p-6 sm:p-8 lg:px-10 lg:py-8 xl:px-11 xl:py-9 flex flex-col justify-between">
                    <div>
                        <p class="text-[10.5px] font-bold uppercase tracking-[0.12em] text-[#24583c]">
                            MENGENAL TYP / HERBAL DRINK
                        </p>

                        <h1 class="font-display text-[clamp(1.9rem,3vw,2.75rem)] font-bold text-[#1e4830] leading-[1.14] tracking-tight mt-3.5">
                            Berakar dari alam,<br>
                            hadir untuk<br>
                            ritual baikmu.
                        </h1>

                        <p class="text-xs sm:text-[13px] text-[#5c6e63] leading-[1.68] mt-3.5 max-w-[435px]">
                            Jamu adalah cerita tentang rempah, rasa, dan kebiasaan baik yang diwariskan lintas generasi. TYP menghadirkan semangat itu dalam minuman herbal yang dekat dengan keseharianmu.
                        </p>

                        <!-- CTA Button -> Langsung menuju ke halaman Home (Beranda) -->
                        <div class="mt-5 xl:mt-6">
                            <a
                                href="{{ route('beranda') }}"
                                class="inline-flex items-center gap-2.5 rounded-full bg-[#2b6346] hover:bg-[#225038] text-white text-xs font-semibold px-6 py-3 transition shadow-xs"
                            >
                                <span>Temukan jamu pilihanmu</span>
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                    <polyline points="7 7 17 7 17 17"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-[#24583c] mt-6">
                        RIMPANG &bull; REMPAH &bull; CERITA NUSANTARA
                    </p>
                </div>

                <!-- Right Column: Image 7.jpg sized proportionally across all Windows/Mac desktop browsers -->
                <div class="lg:col-span-6 relative h-[310px] sm:h-[360px] lg:h-[clamp(320px,46vh,410px)]">
                    <div class="relative w-full h-full overflow-hidden rounded-tl-[80px] sm:rounded-tl-[115px] rounded-bl-[24px] rounded-r-[24px]">
                        <img
                            src="{{ asset('image/7.jpg') }}"
                            alt="Koleksi Botol Jamu TYP Herbal Drink"
                            class="absolute inset-0 w-full h-full object-cover object-[center_54%]"
                        >

                        <!-- Top-Right Pill Badge -->
                        <div class="absolute top-4 right-5 bg-white/95 backdrop-blur-xs text-[#1e1e1c] text-[9.5px] font-bold uppercase tracking-[0.04em] px-5 py-2 rounded-full shadow-md">
                            DIINSPIRASI TRADISI LOKAL
                        </div>

                        <!-- Bottom Dark Green Caption Overlay -->
                        <div class="absolute bottom-3.5 left-3.5 right-3.5 bg-[#18432c]/90 backdrop-blur-[2px] text-white rounded-2xl px-5 py-3 shadow-lg">
                            <h2 class="font-display text-lg sm:text-[20px] xl:text-[21px] font-bold text-white leading-snug">
                                Satu botol, banyak cerita alam.
                            </h2>
                            <p class="text-[11.5px] text-[#d3e4da] mt-0.5">
                                Hangatnya rempah. Segarnya rasa. Akrab di setiap suasana.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section: Kenali Rasa Alam -->
            <section class="mt-6 xl:mt-7 px-1">
                <!-- Header Row -->
                <div class="pb-3 border-b border-[#e6e0d4] flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <p class="text-[10.5px] font-bold uppercase tracking-[0.11em] text-[#24583c]">
                        KENALI RASA ALAM
                    </p>
                    <p class="text-xs text-[#8c867c]">
                        Karakter sederhana, kekayaan rasa yang istimewa.
                    </p>
                </div>

                <!-- 3 Ingredients Columns -->
                <div class="pt-4 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-10">
                    <!-- 01 Kunyit -->
                    <div class="flex items-start gap-3.5">
                        <span class="text-xs font-bold text-[#b8894a] pt-1 shrink-0">01</span>
                        <div>
                            <h3 class="font-display text-lg sm:text-[21px] xl:text-[22px] font-bold text-[#1e1e1c] leading-tight">
                                Kunyit
                            </h3>
                            <p class="text-xs text-[#7c766d] leading-relaxed mt-1.5">
                                Rasa earthy yang khas, dengan warna keemasan alami yang mengingatkan pada jamu rumahan.
                            </p>
                        </div>
                    </div>

                    <!-- 02 Jahe -->
                    <div class="flex items-start gap-3.5">
                        <span class="text-xs font-bold text-[#b8894a] pt-1 shrink-0">02</span>
                        <div>
                            <h3 class="font-display text-lg sm:text-[21px] xl:text-[22px] font-bold text-[#1e1e1c] leading-tight">
                                Jahe
                            </h3>
                            <p class="text-xs text-[#7c766d] leading-relaxed mt-1.5">
                                Aroma rempah yang kuat dan sensasi hangat, pas untuk momen jeda yang menenangkan.
                            </p>
                        </div>
                    </div>

                    <!-- 03 Asam jawa -->
                    <div class="flex items-start gap-3.5">
                        <span class="text-xs font-bold text-[#b8894a] pt-1 shrink-0">03</span>
                        <div>
                            <h3 class="font-display text-lg sm:text-[21px] xl:text-[22px] font-bold text-[#1e1e1c] leading-tight">
                                Asam jawa
                            </h3>
                            <p class="text-xs text-[#7c766d] leading-relaxed mt-1.5">
                                Sentuhan asam yang segar untuk menyeimbangkan rasa dan membuat tiap teguk lebih hidup.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Bottom Footer -->
        <footer class="mt-6 xl:mt-8 pt-3.5 border-t border-[#e8e2d7] flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px]">
            <div class="text-[#8c867c]">&copy; 2026 TYP Herbal Drink</div>
            <div class="text-[#8c867c]">Kebaikan rimpang. Ritual yang berkelanjutan.</div>
            <div class="font-bold uppercase tracking-[0.05em] text-[#24583c]">BERAKAR DI INDONESIA</div>
        </footer>
    </div>

</body>
</html>
