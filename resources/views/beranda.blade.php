<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Beranda Utama — TYP Herbal Drink</title>

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
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: #faf8f4;
            color: #1e1e1c;
        }
        .font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-[#faf8f4] text-[#1e1e1c] antialiased selection:bg-[#2b6346] selection:text-white">

    @php
        $currentUser = session('auth_user');
        $fullName = $currentUser['name'] ?? 'Rinaldi Mulya Putra';
        $shortName = explode(' ', trim($fullName))[0] ?: 'Rinaldi';
    @endphp

    <!-- Main Page Container -->
    <div class="flex-1 w-full max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 pt-5 pb-6 flex flex-col justify-between">
        <div>
            <!-- Floating Pill Header Navbar -->
            <header class="w-full bg-white rounded-full border border-[#ebe6dc] px-6 sm:px-8 py-3 flex items-center justify-between shadow-[0_2px_12px_rgba(0,0,0,0.02)]">
                <!-- Left: Logo from public/image/image.png -->
                <a href="{{ route('home') }}" class="inline-flex items-center focus:outline-none">
                    <img
                        src="{{ asset('image/image.png') }}"
                        alt="TYP Herbal Drink"
                        class="h-10 sm:h-12 w-auto object-contain mix-blend-multiply -ml-1"
                    >
                </a>

                <!-- Center: Navigation Links -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-3 text-xs">
                    <a
                        href="{{ route('home') }}"
                        class="text-[#5c5953] hover:text-[#1e1e1c] font-medium px-4 py-2 rounded-full transition"
                    >
                        Introduction
                    </a>
                    <a
                        href="{{ route('beranda') }}"
                        class="bg-[#e3ece6] text-[#1f5135] font-bold px-5 py-2 rounded-full transition"
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

            <!-- Greeting & Date Section -->
            <div class="mt-7 flex flex-col sm:flex-row sm:items-end justify-between gap-2 px-1">
                <div>
                    <h1 class="font-display text-2xl sm:text-[32px] font-bold text-[#1e1e1c] tracking-tight leading-tight">
                        Selamat Datang, {{ $shortName }}
                    </h1>
                    <p class="text-xs text-[#8c867c] mt-1">
                        {{ $fullName }} · Saatnya memulai ritual baikmu.
                    </p>
                </div>
                <div class="text-[10.5px] font-bold uppercase tracking-[0.06em] text-[#2b6346]">
                    SENIN, 26 OKTOBER 2026
                </div>
            </div>

            <!-- Main Featured Banner Card (Jamu image on the right omitted/left empty as requested) -->
            <section class="mt-5 rounded-[24px] overflow-hidden bg-[#e7efe9] border border-[#dce6df] grid grid-cols-1 lg:grid-cols-12 min-h-[250px]">
                <!-- Left Banner Text -->
                <div class="lg:col-span-7 p-7 sm:p-10 flex flex-col justify-center">
                    <p class="text-[10px] font-bold uppercase tracking-[0.06em] text-[#24583c]">
                        PILIHAN SEGAR MINGGU INI
                    </p>
                    <h2 class="font-display text-3xl sm:text-[38px] font-bold text-[#245b3e] leading-[1.18] tracking-tight mt-2.5 max-w-[480px]">
                        Paket Segar Imunitas &amp; Detoks Alami
                    </h2>
                    <p class="text-xs sm:text-[13.5px] text-[#55695d] mt-3.5">
                        Dua kebaikan rimpang untuk menemani hari yang penuh energi.
                    </p>
                    <div class="mt-4 flex items-center gap-2 flex-wrap text-[10.5px]">
                        <span class="font-bold uppercase tracking-[0.05em] text-[#24583c]">RIMPANG LOKAL</span>
                        <span class="text-[#6e7d73]">&bull; Diperas dingin, diracik sepenuh hati</span>
                    </div>
                </div>

                <!-- Right Area: Empty container (Gambar jamu dikosongkan sesuai instruksi) -->
                <div class="lg:col-span-5 min-h-[160px] lg:min-h-full"></div>
            </section>

            <!-- 3 Value Pillars Row -->
            <section class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-5 px-1">
                <!-- Pillar 1 -->
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-full bg-[#eaf1ec] text-[#2b6346] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 20h10"></path>
                            <path d="M10 20c5.5-2.5.8-6.4 3-10"></path>
                            <path d="M9.5 9.4c1.1.8 1.8 2.2 2.3 3.7-2 .4-3.5.4-4.8-.3-1.2-.6-2.3-1.9-3-4.2 2.8-.5 4.4 0 5.5.8z"></path>
                            <path d="M14.1 6a7 7 0 0 0-1.1 4c1.9-.1 3.3-.6 4.3-1.4 1-1 1.6-2.3 1.7-4.6-2.7.1-4 1-4.9 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#24583c]">100% Rimpang Lokal</h3>
                        <p class="text-[11px] text-[#8c867c] mt-0.5">Dipilih dari kekayaan tanah Nusantara.</p>
                    </div>
                </div>

                <!-- Pillar 2 -->
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-full bg-[#eaf1ec] text-[#2b6346] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"></path>
                            <path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#24583c]">Cold-Pressed Tanpa Pengawet</h3>
                        <p class="text-[11px] text-[#8c867c] mt-0.5">Diperas dingin, dijaga kebaikan alaminya.</p>
                    </div>
                </div>

                <!-- Pillar 3 -->
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-full bg-[#eaf1ec] text-[#2b6346] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 7V5a2 2 0 0 1 2-2h2"></path>
                            <path d="M17 3h2a2 2 0 0 1 2 2v2"></path>
                            <path d="M21 17v2a2 2 0 0 1-2 2h-2"></path>
                            <path d="M7 21H5a2 2 0 0 1-2-2v-2"></path>
                            <line x1="7" y1="12" x2="17" y2="12"></line>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#24583c]">Smart Batch Traceability</h3>
                        <p class="text-[11px] text-[#8c867c] mt-0.5">Kenali asal dan kesegaran setiap botol.</p>
                    </div>
                </div>
            </section>

            <!-- Product Section Header -->
            <section id="products" class="mt-8">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 px-1">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.06em] text-[#24583c]">
                            KEBAIKAN DALAM SETIAP BOTOL
                        </p>
                        <h2 class="font-display text-2xl sm:text-[30px] font-bold text-[#1e1e1c] tracking-tight leading-tight mt-1">
                            Pilihan dari alam
                        </h2>
                    </div>
                    <div>
                        <a
                            href="{{ route('products') }}"
                            class="inline-flex items-center gap-2.5 rounded-full bg-[#2b6346] hover:bg-[#23523a] text-white text-xs font-semibold px-6 py-3 transition shadow-xs"
                        >
                            <span>Jelajahi Konten Produk</span>
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 4 Product Cards Grid (Area gambar jamu dikosongkan sesuai permintaan) -->
                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="bg-white rounded-2xl border border-[#ece7dd] overflow-hidden flex min-h-[136px] shadow-[0_1px_3px_rgba(0,0,0,0.02)] hover:border-[#d5cfc2] transition">
                            <!-- Empty Left Image Slot (Dikosongkan tanpa gambar jamu) -->
                            <div class="w-[42%] shrink-0"></div>

                            <!-- Right Product Details -->
                            <div class="flex-1 p-4 flex flex-col justify-center">
                                <h3 class="font-display text-[17px] font-semibold text-[#1e1e1c] leading-snug">
                                    Kunyit Asam<br>Royal
                                </h3>
                                <p class="text-[11px] text-[#9a948a] mt-1">250 ml</p>
                                <p class="text-xs font-bold text-[#24583c] mt-1.5">Rp 15.000</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </section>
        </div>

        <!-- Floating Chat Helper & Bottom Footer -->
        <div class="mt-10">
            <!-- Floating "Butuh bantuan? Tanya Sapa" Widget aligned right -->
            <div class="flex items-center justify-end gap-3 mb-3">
                <div class="bg-white border border-[#ece7dd] shadow-sm rounded-2xl px-5 py-2.5 text-xs font-semibold text-[#2c2a27]">
                    Butuh bantuan? Tanya Sapa
                </div>
                <button
                    type="button"
                    aria-label="Tanya Sapa"
                    class="w-11 h-11 rounded-full bg-[#2b6346] hover:bg-[#23523a] text-white flex items-center justify-center shadow-md transition cursor-pointer"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        <line x1="9" y1="9" x2="15" y2="9"></line>
                        <line x1="9" y1="13" x2="13" y2="13"></line>
                    </svg>
                </button>
            </div>

            <!-- Footer Bar -->
            <footer class="pt-4 border-t border-[#e8e2d7] flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px]">
                <div class="text-[#8c867c]">&copy; 2026 TYP Herbal Drink</div>
                <div class="text-[#8c867c]">Kebaikan rimpang. Ritual yang berkelanjutan.</div>
                <div class="font-bold uppercase tracking-[0.05em] text-[#24583c]">BERAKAR DI INDONESIA</div>
            </footer>
        </div>
    </div>

</body>
</html>
