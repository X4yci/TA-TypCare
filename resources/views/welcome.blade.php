<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TYP Herbal Drink — Warisan Jamu Nusantara untuk Ritual Sehat Modern</title>

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
            background-color: #f7f4ee;
            color: #1c2820;
        }
        .font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-[#f7f4ee] antialiased selection:bg-[#2b6346] selection:text-white">

    @php
        $currentUser = session('auth_user');
    @endphp

    <!-- Notification Banner for General User / Flash Notice -->
    @if (session('user_notice'))
        <div class="bg-[#fdf3e7] border-b border-[#f2d2b1] px-6 sm:px-10 lg:px-12 py-2.5 flex items-center justify-between gap-4 text-xs text-[#7c5e45]">
            <div class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-[#d86b43]"></span>
                <span class="font-medium">{{ session('user_notice') }}</span>
            </div>
            <a href="{{ route('logout') }}" class="font-semibold text-[#9c4221] hover:underline shrink-0">Ganti Akun</a>
        </div>
    @endif

    <!-- Top Header / Navbar -->
    <header class="w-full bg-[#f7f4ee] px-6 sm:px-10 lg:px-12 h-20 flex items-center justify-between border-b border-[#e8e2d7]">
        <!-- Left: Brand Logo from public/image/image.png -->
        <a href="{{ url('/') }}" class="inline-flex items-center focus:outline-none">
            <img
                src="{{ asset('image/image.png') }}"
                alt="TYP Herbal Drink"
                class="h-12 sm:h-14 w-auto object-contain mix-blend-multiply -ml-2"
            >
        </a>

        <!-- Center: Tagline -->
        <p class="hidden md:block text-[11px] font-semibold uppercase tracking-[0.06em] text-[#285a40]">
            BERAKAR LOKAL. TUMBUH BERSAMAMU.
        </p>

        <!-- Right: Masuk / Daftar Button or Active Session Info -->
        <div class="flex items-center gap-3">
            @if ($currentUser)
                <div class="hidden sm:flex flex-col text-right mr-1">
                    <span class="text-xs font-bold text-[#1e2620]">{{ $currentUser['name'] }}</span>
                    <span class="text-[10.5px] {{ ($currentUser['role'] ?? '') === 'admin' ? 'text-[#2b6346] font-semibold' : 'text-[#8c857b]' }}">
                        {{ $currentUser['role_label'] ?? 'Pengguna Umum' }} · {{ $currentUser['email'] }}
                    </span>
                </div>

                @if (($currentUser['role'] ?? '') === 'admin')
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center justify-center rounded-full bg-[#2b6346] px-5 py-2.5 text-xs font-semibold text-white hover:bg-[#23533a] transition duration-200"
                    >
                        Dashboard Admin
                    </a>
                @endif

                <a
                    href="{{ route('logout') }}"
                    class="inline-flex items-center justify-center rounded-full border border-[#2b6346] px-5 py-2.5 text-xs font-semibold text-[#23533a] hover:bg-[#2b6346] hover:text-white transition duration-200"
                >
                    Keluar
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    onclick="event.preventDefault(); openAuthModal('login');"
                    class="inline-flex items-center justify-center rounded-full border border-[#2b6346] px-6 py-2.5 text-xs font-semibold text-[#23533a] hover:bg-[#2b6346] hover:text-white transition duration-200 cursor-pointer"
                >
                    Masuk / Daftar
                </a>
            @endif
        </div>
    </header>

    <!-- Main Split Section -->
    <main class="flex-1 grid grid-cols-1 lg:grid-cols-12">
        <!-- Left Column: Deep Herbal Green Hero -->
        <section class="lg:col-span-6 bg-[#2b6346] text-white px-6 sm:px-12 lg:px-14 xl:px-16 py-14 lg:py-20 flex flex-col justify-center">
            <div class="max-w-[510px]">
                <!-- Eyebrow -->
                <p class="text-[11px] font-medium uppercase tracking-[0.08em] text-[#d5e5dc] mb-5">
                    DARI AKAR, UNTUK KESEHARIANMU
                </p>

                <!-- Hero Heading -->
                <h1 class="font-display text-4xl sm:text-5xl xl:text-[52px] font-bold text-white leading-[1.14] tracking-tight">
                    Warisan Jamu<br>
                    Nusantara untuk<br>
                    Ritual Sehat Modern
                </h1>

                <!-- Description -->
                <p class="text-[#d9e7df] text-sm sm:text-[15px] leading-[1.7] mt-6 max-w-[480px]">
                    Kami membawa kearifan jamu lebih dekat dengan harimu. Rimpang lokal, racikan jujur, dan kesegaran yang bisa kamu kenali dalam setiap botol.
                </p>

                <!-- CTA Button: Langsung masuk ke halaman Beranda tanpa perlu login -->
                <div class="mt-8">
                    <a
                        href="{{ route('beranda') }}"
                        class="inline-flex items-center gap-3 rounded-full bg-[#e07856] hover:bg-[#cf6846] text-[#1c1917] font-semibold text-[13.5px] px-7 py-3.5 transition duration-200 shadow-xs"
                    >
                        <span>Masuk ke Beranda Utama</span>
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </a>
                </div>

                <!-- Divider -->
                <div class="border-t border-white/20 mt-11 pt-7">
                    <!-- 3 Features Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Feature 1 -->
                        <div>
                            <div class="text-[#dfece4] mb-2.5">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 20h10"></path>
                                    <path d="M10 20c5.5-2.5.8-6.4 3-10"></path>
                                    <path d="M9.5 9.4c1.1.8 1.8 2.2 2.3 3.7-2 .4-3.5.4-4.8-.3-1.2-.6-2.3-1.9-3-4.2 2.8-.5 4.4 0 5.5.8z"></path>
                                    <path d="M14.1 6a7 7 0 0 0-1.1 4c1.9-.1 3.3-.6 4.3-1.4 1-1 1.6-2.3 1.7-4.6-2.7.1-4 1-4.9 2z"></path>
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-[#e7f1eb]">100% Rimpang Lokal</p>
                        </div>

                        <!-- Feature 2 -->
                        <div>
                            <div class="text-[#dfece4] mb-2.5">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"></path>
                                    <path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"></path>
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-[#e7f1eb]">Cold-Pressed Tanpa Pengawet</p>
                        </div>

                        <!-- Feature 3 -->
                        <div>
                            <div class="text-[#dfece4] mb-2.5">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 7V5a2 2 0 0 1 2-2h2"></path>
                                    <path d="M17 3h2a2 2 0 0 1 2 2v2"></path>
                                    <path d="M21 17v2a2 2 0 0 1-2 2h-2"></path>
                                    <path d="M7 21H5a2 2 0 0 1-2-2v-2"></path>
                                    <line x1="7" y1="12" x2="17" y2="12"></line>
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-[#e7f1eb]">Smart Batch Traceability</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Right Column: Warm Beige Section (Jamu images omitted/left empty as requested) -->
        <section class="lg:col-span-6 bg-[#ede5d8] px-6 sm:px-12 lg:px-14 py-12 flex flex-col justify-end">
            <!-- Bottom Caption Block -->
            <div class="max-w-md ml-auto lg:mr-8 mb-4">
                <p class="text-[10.5px] font-bold uppercase tracking-[0.06em] text-[#2b6346]">
                    SESEDERHANA KEMBALI KE ALAM
                </p>
                <h2 class="font-display text-2xl sm:text-[28px] font-medium text-[#2b6346] leading-[1.22] mt-1.5">
                    Pure Indonesian Roots,<br>
                    Modern Daily Ritual
                </h2>
                <p class="text-xs text-[#7c756b] mt-2.5">
                    Diracik alami. Dinikmati setiap hari.
                </p>
            </div>
        </section>
    </main>

    <!-- Bottom Footer -->
    <footer class="w-full bg-[#f7f4ee] px-6 sm:px-10 lg:px-12 py-4 border-t border-[#e8e2d7] flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-[#7d786f]">
        <div>&copy; 2026 TYP Herbal Drink</div>
        <div>Tradisi yang hidup dalam ritual barumu.</div>
    </footer>

    <!-- Modal Login & Daftar -->
    @include('partials.auth-modal', ['authTab' => $authTab ?? null])

</body>
</html>
