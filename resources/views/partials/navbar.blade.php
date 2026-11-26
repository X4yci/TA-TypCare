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

    <!-- Right: Real-Time Date & Clock Badge + Notification Bell -->
    <div class="flex items-center gap-3">
        <div class="bg-white/[0.08] border border-white/[0.12] rounded-lg px-3.5 py-1.5 sm:min-w-[265px] flex items-center justify-between gap-2.5 text-xs text-[#e5f0e9]">
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 text-[#9ec4ad] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span id="realtime-navbar-date" class="font-medium">{{ now()->timezone('Asia/Jakarta')->translatedFormat('l, d F Y') }}</span>
            </div>
            <span id="realtime-navbar-clock" class="font-mono-code text-[11px] text-[#95e2b2] font-semibold pl-2 border-l border-white/15">
                {{ now()->timezone('Asia/Jakarta')->format('H:i:s') }} WIB
            </span>
        </div>

        <button type="button" aria-label="Notifikasi" class="p-1.5 rounded-lg text-[#d5e6dc] hover:text-white hover:bg-white/10 transition cursor-pointer">
            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
        </button>
    </div>
</header>

<script>
    (function initAdminRealtimeClock() {
        const HARI_ID = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const BULAN_PANJANG_ID = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const BULAN_PENDEK_ID = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        function updateClocks() {
            const now = new Date();
            const hari = HARI_ID[now.getDay()];
            const tgl = String(now.getDate()).padStart(2, '0');
            const blnPanjang = BULAN_PANJANG_ID[now.getMonth()];
            const blnPendek = BULAN_PENDEK_ID[now.getMonth()];
            const thn = now.getFullYear();

            const jam = String(now.getHours()).padStart(2, '0');
            const mnt = String(now.getMinutes()).padStart(2, '0');
            const dtk = String(now.getSeconds()).padStart(2, '0');

            const navDateEl = document.getElementById('realtime-navbar-date');
            if (navDateEl) {
                navDateEl.textContent = `${hari}, ${tgl} ${blnPanjang} ${thn}`;
            }

            const navClockEl = document.getElementById('realtime-navbar-clock');
            if (navClockEl) {
                navClockEl.textContent = `${jam}:${mnt}:${dtk} WIB`;
            }

            const footerTimeEl = document.getElementById('realtime-footer-timestamp');
            if (footerTimeEl) {
                footerTimeEl.textContent = `Data real-time · ${tgl} ${blnPendek} ${thn}, ${jam}.${mnt}.${dtk} WIB`;
            }
        }

        updateClocks();
        setInterval(updateClocks, 1000);
    })();
</script>
