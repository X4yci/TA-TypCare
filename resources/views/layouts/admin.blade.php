<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Operasional — TYP-Care Backoffice')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=JetBrains+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via Vite or CDN Fallback -->
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
                        serif: ['"Fraunces"', 'Georgia', 'serif'],
                        mono: ['"JetBrains Mono"', 'ui-monospace', 'SFMono-Regular', 'monospace'],
                    },
                    colors: {
                        forest: {
                            800: '#1f4b31',
                            900: '#1a422a',
                            950: '#143521',
                        },
                        cream: {
                            50: '#faf9f5',
                            100: '#f5f2eb',
                            200: '#e6e2d8',
                        },
                        terracotta: {
                            500: '#d86b43',
                            600: '#c45b35',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: #f5f2eb;
            color: #18221b;
        }
        .font-brand {
            font-family: 'Fraunces', Georgia, serif;
        }
        .font-mono-code {
            font-family: 'JetBrains Mono', ui-monospace, monospace;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f5f2eb;
        }
        ::-webkit-scrollbar-thumb {
            background: #d1cbc0;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #b5ae9f;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex bg-[#f5f2eb] text-[#18221b] antialiased selection:bg-[#1f4b31] selection:text-white">

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 lg:pl-[248px]">
        <!-- Top Header Bar -->
        @include('partials.navbar')

        <!-- Main Workspace Content -->
        <main class="flex-1 px-5 sm:px-8 pt-6 pb-8 max-w-[1440px] w-full mx-auto flex flex-col justify-between">
            <div>
                @yield('content')
            </div>

            <!-- Footer -->
            @include('partials.footer')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
