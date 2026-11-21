<header class="sticky top-0 z-20 h-14 bg-[#1e4930] text-white px-5 sm:px-8 flex items-center justify-between border-b border-black/10">
    <!-- Left: Mobile Hamburger + Breadcrumb -->
    <div class="flex items-center gap-3">
        <button type="button" onclick="toggleMobileSidebar()" class="lg:hidden p-1.5 -ml-1.5 rounded-lg text-white/80 hover:text-white hover:bg-white/10 focus:outline-none">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>

        <nav aria-label="Breadcrumb" class="flex items-center text-[13px]">
            <span class="text-[#b8d0c1] font-medium">Backoffice</span>
            <span class="text-[#6f967f] mx-2.5">/</span>
            <span class="text-white font-semibold">@yield('breadcrumb', 'Dashboard')</span>
        </nav>
    </div>

    <!-- Right: Date Badge & Notification Bell -->
    <div class="flex items-center gap-3">
        <div class="bg-white/[0.08] border border-white/[0.12] rounded-lg px-3.5 py-1.5 sm:min-w-[235px] flex items-center gap-2.5 text-xs text-[#e5f0e9]">
            <svg class="w-3.5 h-3.5 text-[#9ec4ad] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span class="font-medium">Kamis, 12 November 2026</span>
        </div>

        <button type="button" aria-label="Notifikasi" class="p-1.5 rounded-lg text-[#d5e6dc] hover:text-white hover:bg-white/10 transition cursor-pointer">
            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
        </button>
    </div>
</header>
