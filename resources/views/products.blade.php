<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Koleksi Produk TYP Herbal — TYP Herbal Drink</title>

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

        $products = [
            [
                'name_line_1' => 'Kunyit Asam',
                'name_line_2' => 'Royal',
                'benefit' => 'Daily Detox & Antioksidan',
                'category' => 'Daily Detox',
                'volume' => '250 ml',
                'price' => 'Rp 15.000',
            ],
            [
                'name_line_1' => 'Beras Kencur',
                'name_line_2' => 'Creamy',
                'benefit' => 'Stamina & Pegal Linu',
                'category' => 'Stamina',
                'volume' => '250 ml',
                'price' => 'Rp 16.000',
            ],
            [
                'name_line_1' => 'Temulawak',
                'name_line_2' => 'Honey',
                'benefit' => 'Imunitas & Pencernaan',
                'category' => 'Immunity Boots',
                'volume' => '500 ml',
                'price' => 'Rp 25.000',
            ],
            [
                'name_line_1' => 'Red Ginger Shot',
                'name_line_2' => null,
                'benefit' => 'Hangat Tubuh & Metabolisme',
                'category' => 'Immunity Boots',
                'volume' => '250 ml',
                'price' => 'Rp 18.000',
            ],
        ];
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
                        class="text-[#5c5953] hover:text-[#1e1e1c] font-medium px-4 py-2 rounded-full transition"
                    >
                        Home
                    </a>
                    <a
                        href="{{ route('products') }}"
                        class="bg-[#e3ece6] text-[#1f5135] font-bold px-5 py-2 rounded-full transition"
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

            <!-- Back Link -->
            <div class="mt-6 px-1">
                <a
                    href="{{ route('beranda') }}"
                    class="inline-flex items-center gap-2 text-xs font-bold text-[#2b6346] hover:text-[#1e4631] transition"
                >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span>Kembali ke Home</span>
                </a>
            </div>

            <!-- Page Heading & Count -->
            <div class="mt-5 px-1">
                <p class="text-[10.5px] font-bold uppercase tracking-[0.06em] text-[#24583c]">
                    RIMPANG PILIHAN. RACIKAN JUJUR.
                </p>
                <h1 class="font-display text-3xl sm:text-[42px] font-bold text-[#1e1e1c] tracking-tight leading-tight mt-1.5">
                    Koleksi Produk TYP Herbal
                </h1>
                <div class="mt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <p class="text-xs sm:text-[13.5px] text-[#7c766d]">
                        Temukan kebaikan yang paling dekat dengan kebutuhan harianmu.
                    </p>
                    <p class="text-xs text-[#8c867c]">
                        <span id="racikan-count" class="font-semibold text-[#5c5852]">4 racikan</span> alami tersedia
                    </p>
                </div>
            </div>

            <!-- Main Content Area: Sidebar Filter + 4 Product Cards -->
            <div class="mt-6 flex flex-col lg:flex-row gap-6 items-start">
                <!-- Left Filter & Info Sidebar -->
                <aside class="w-full lg:w-[215px] shrink-0">
                    <!-- Filter Title -->
                    <div class="flex items-center gap-2 text-xs font-bold text-[#1e1e1c] mb-3 px-1">
                        <svg class="w-3.5 h-3.5 text-[#24583c]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" y1="21" x2="4" y2="14"></line>
                            <line x1="4" y1="10" x2="4" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12" y2="3"></line>
                            <line x1="20" y1="21" x2="20" y2="16"></line>
                            <line x1="20" y1="12" x2="20" y2="3"></line>
                            <line x1="1" y1="14" x2="7" y2="14"></line>
                            <line x1="9" y1="8" x2="15" y2="8"></line>
                            <line x1="17" y1="16" x2="23" y2="16"></line>
                        </svg>
                        <span>Pilih manfaat</span>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="space-y-1">
                        <button
                            type="button"
                            data-filter="all"
                            onclick="filterProducts('all')"
                            class="benefit-filter-btn w-full bg-[#2b6346] text-white font-semibold text-xs px-4 py-3 rounded-xl flex items-center justify-between transition cursor-pointer"
                        >
                            <span>Semua</span>
                            <svg class="filter-check w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </button>

                        <button
                            type="button"
                            data-filter="Daily Detox"
                            onclick="filterProducts('Daily Detox')"
                            class="benefit-filter-btn w-full text-left text-[#5c5852] hover:bg-[#efeae0] hover:text-[#1e1e1c] font-medium text-xs px-4 py-3 rounded-xl flex items-center justify-between transition cursor-pointer"
                        >
                            <span>Daily Detox</span>
                            <svg class="filter-check w-3.5 h-3.5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </button>

                        <button
                            type="button"
                            data-filter="Immunity Boots"
                            onclick="filterProducts('Immunity Boots')"
                            class="benefit-filter-btn w-full text-left text-[#5c5852] hover:bg-[#efeae0] hover:text-[#1e1e1c] font-medium text-xs px-4 py-3 rounded-xl flex items-center justify-between transition cursor-pointer"
                        >
                            <span>Immunity Boots</span>
                            <svg class="filter-check w-3.5 h-3.5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </button>

                        <button
                            type="button"
                            data-filter="Stamina"
                            onclick="filterProducts('Stamina')"
                            class="benefit-filter-btn w-full text-left text-[#5c5852] hover:bg-[#efeae0] hover:text-[#1e1e1c] font-medium text-xs px-4 py-3 rounded-xl flex items-center justify-between transition cursor-pointer"
                        >
                            <span>Stamina</span>
                            <svg class="filter-check w-3.5 h-3.5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-[#e8e2d7] my-5"></div>

                    <!-- Cold Storage Info Box -->
                    <div class="bg-[#e7efe9] border border-[#dce6df] rounded-2xl p-4">
                        <div class="text-[#2b6346] mb-2.5">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="12" y1="2" x2="12" y2="22"></line>
                                <path d="m20 16-4-4 4-4"></path>
                                <path d="m4 8 4 4-4 4"></path>
                                <path d="m16 4-4 4-4-4"></path>
                                <path d="m8 20 4-4 4 4"></path>
                            </svg>
                        </div>
                        <h3 class="font-display text-[17px] font-bold text-[#24583c] leading-snug">
                            Segar, bukan<br>serba instan.
                        </h3>
                        <p class="text-[11px] text-[#6d7c72] leading-relaxed mt-2">
                            Simpan dingin pada 4&deg;C. Kenali kesegaran racikan lewat catatan batch TYP.
                        </p>
                    </div>
                </aside>

                <!-- Right Product Cards Grid -->
                <div id="products-grid" class="flex-1 w-full grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    @foreach ($products as $product)
                        <article
                            data-category="{{ $product['category'] }}"
                            class="product-card bg-white rounded-[20px] border border-[#ebe6dc] overflow-hidden flex flex-col justify-between shadow-[0_1px_4px_rgba(0,0,0,0.02)] hover:border-[#d5cfc2] transition"
                        >
                            <!-- Top Media Slot (Empty image area + Volume Badge at top-right) -->
                            <div class="relative h-[245px] w-full bg-[#f5f0e6]/60">
                                <span class="absolute top-3.5 right-3.5 bg-white text-[#2c2a27] text-[10.5px] font-bold px-3 py-1 rounded-full shadow-xs">
                                    {{ $product['volume'] }}
                                </span>
                            </div>

                            <!-- Bottom Card Details -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h2 class="font-display text-[21px] font-bold text-[#1e1e1c] leading-[1.22] min-h-[52px]">
                                        {{ $product['name_line_1'] }}
                                        @if ($product['name_line_2'])
                                            <br>{{ $product['name_line_2'] }}
                                        @endif
                                    </h2>
                                    <p class="text-[11.5px] text-[#8c867c] mt-2">
                                        {{ $product['benefit'] }}
                                    </p>
                                </div>

                                <div class="mt-5">
                                    <p class="text-[15px] font-bold text-[#24583c]">
                                        {{ $product['price'] }}
                                    </p>

                                    <a
                                        href="#detail-produk"
                                        class="mt-3.5 w-full rounded-full border border-[#3b694f] text-[#1e3a2a] hover:bg-[#2b6346] hover:text-white text-xs font-semibold py-2.5 px-4 inline-flex items-center justify-center gap-2 transition"
                                    >
                                        <span>Lihat Isi Produk</span>
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="7" y1="17" x2="17" y2="7"></line>
                                            <polyline points="7 7 17 7 17 17"></polyline>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <footer class="mt-14 pt-4 border-t border-[#e8e2d7] flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px]">
            <div class="text-[#8c867c]">&copy; 2026 TYP Herbal Drink</div>
            <div class="text-[#8c867c]">Setiap racikan memiliki komposisi dan karakter tersendiri.</div>
            <div class="font-bold uppercase tracking-[0.05em] text-[#24583c]">BERAKAR DI INDONESIA</div>
        </footer>
    </div>

    <script>
        function filterProducts(category) {
            const buttons = document.querySelectorAll('.benefit-filter-btn');
            const cards = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            buttons.forEach(btn => {
                const isMatch = btn.getAttribute('data-filter') === category;
                const checkIcon = btn.querySelector('.filter-check');

                if (isMatch) {
                    btn.className = 'benefit-filter-btn w-full bg-[#2b6346] text-white font-semibold text-xs px-4 py-3 rounded-xl flex items-center justify-between transition cursor-pointer';
                    if (checkIcon) checkIcon.classList.remove('hidden');
                } else {
                    btn.className = 'benefit-filter-btn w-full text-left text-[#5c5852] hover:bg-[#efeae0] hover:text-[#1e1e1c] font-medium text-xs px-4 py-3 rounded-xl flex items-center justify-between transition cursor-pointer';
                    if (checkIcon) checkIcon.classList.add('hidden');
                }
            });

            cards.forEach(card => {
                const cardCat = card.getAttribute('data-category');
                if (category === 'all' || cardCat === category) {
                    card.classList.remove('hidden');
                    card.classList.add('flex');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                    card.classList.remove('flex');
                }
            });

            const countEl = document.getElementById('racikan-count');
            if (countEl) {
                countEl.textContent = `${visibleCount} racikan`;
            }
        }
    </script>
</body>
</html>
