<footer class="mt-8">
    <!-- Top Footer Bar -->
    <div class="pb-3 border-b border-[#e2ded3] flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
        <div class="flex items-center gap-2 flex-wrap">
            <span class="inline-flex items-center gap-1.5 font-bold text-[#1b5632]">
                <svg class="w-4 h-4 text-[#1f6b3b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
                <span>FEFO aktif</span>
            </span>
            <span class="text-[#6e736b] sm:ml-2">Stok dengan masa simpan &le; 3 hari terkunci otomatis.</span>
        </div>
        <div id="realtime-footer-timestamp" class="text-[#7a7f76]">
            Data real-time · {{ now()->timezone('Asia/Jakarta')->format('d M Y, H.i.s') }} WIB
        </div>
    </div>

    <!-- Bottom Footer Credits -->
    <div class="pt-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-[11px] text-[#8c9188]">
        <div class="tracking-wide">TYP-Care / UMKM TYP HERBAL DRINK &copy; {{ now()->year }}</div>
        <div>Operasional yang rapi, kualitas yang terjaga.</div>
    </div>
</footer>
