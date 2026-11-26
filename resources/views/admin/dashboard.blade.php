@extends('layouts.admin')

@section('title', 'Dashboard Operasional — TYP-Care Backoffice')
@section('breadcrumb', 'Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-[25px] sm:text-[27px] font-bold text-[#18221b] tracking-tight leading-tight">Dashboard operasional</h2>
            <p class="text-[13.5px] text-[#6e736b] mt-1">Pantau pesanan, catat produksi, dan jaga kualitas stok jamu Anda.</p>
        </div>
        <div>
            <a href="{{ route('admin.orders') }}" class="bg-[#d86b43] hover:bg-[#c35b35] text-white font-semibold text-[13px] px-4 py-2.5 rounded-lg inline-flex items-center gap-2.5 shadow-2xs transition">
                <span>Lihat pesanan</span>
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </div>

    <!-- 4 KPI Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mt-5">
        <!-- Card 1: Total pendapatan lunas -->
        <div class="bg-white rounded-xl border border-[#e6e2d8] p-4 sm:p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
            <div class="flex items-start justify-between gap-2">
                <span class="text-xs font-medium text-[#6e736b]">Total pendapatan lunas</span>
                <span class="w-7 h-7 rounded-md bg-[#e8f3ec] text-[#25633d] flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                        <circle cx="12" cy="12" r="2.5"></circle>
                        <path d="M6 12h.01M18 12h.01"></path>
                    </svg>
                </span>
            </div>
            <p class="text-[25px] font-bold text-[#18221b] tracking-tight mt-1.5 leading-snug">Rp 495.000</p>
            <p class="text-[11px] text-[#8c9188] mt-1.5">Terverifikasi payment gateway</p>
        </div>

        <!-- Card 2: Pesanan masuk aktif -->
        <div class="bg-white rounded-xl border border-[#e6e2d8] p-4 sm:p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
            <div class="flex items-start justify-between gap-2">
                <span class="text-xs font-medium text-[#6e736b]">Pesanan masuk aktif</span>
                <span class="w-7 h-7 rounded-md bg-[#e8f3ec] text-[#25633d] flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </span>
            </div>
            <p class="text-[25px] font-bold text-[#18221b] tracking-tight mt-1.5 leading-snug">4 Pesanan</p>
            <p class="text-[11px] text-[#8c9188] mt-1.5">Perlu diproses / dalam pengiriman</p>
        </div>

        <!-- Card 3: Stok botol layak jual -->
        <div class="bg-white rounded-xl border border-[#e6e2d8] p-4 sm:p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
            <div class="flex items-start justify-between gap-2">
                <span class="text-xs font-medium text-[#6e736b]">Stok botol layak jual</span>
                <span class="w-7 h-7 rounded-md bg-[#e8f3ec] text-[#25633d] flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </span>
            </div>
            <p class="text-[25px] font-bold text-[#18221b] tracking-tight mt-1.5 leading-snug"><span id="kpi-sellable-bottles">34</span> Botol</p>
            <p class="text-[11px] text-[#8c9188] mt-1.5">Lolos filter kedaluwarsa H-3</p>
        </div>

        <!-- Card 4: Peringatan batch -->
        <div class="bg-white rounded-xl border border-[#e6e2d8] p-4 sm:p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
            <div class="flex items-start justify-between gap-2">
                <span class="text-xs font-medium text-[#6e736b]">Peringatan batch</span>
                <span class="w-7 h-7 rounded-md bg-[#fdf0e5] text-[#c05621] flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </span>
            </div>
            <p class="text-[25px] font-bold text-[#18221b] tracking-tight mt-1.5 leading-snug"><span id="kpi-alert-batches">2</span> Batch</p>
            <p id="kpi-alert-detail" class="text-[11px] text-[#8c9188] mt-1.5">1 warning · 1 terkunci H-3</p>
        </div>
    </div>

    <!-- Warning Callout Banner -->
    <div class="mt-4 bg-[#fdf3e7] border border-[#f2d2b1] rounded-xl px-5 py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-start sm:items-center gap-3.5">
            <svg class="w-5 h-5 text-[#b45309] shrink-0 mt-0.5 sm:mt-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            <div>
                <h3 id="banner-title" class="text-[13.5px] font-bold text-[#9c4221] leading-snug">2 batch perlu perhatian Anda</h3>
                <p id="banner-desc" class="text-xs text-[#7c5e45] mt-0.5">
                    1 batch terkunci H-3 tidak tampil di katalog. Prioritaskan 1 batch warning (H-6) untuk pesanan berikutnya.
                </p>
            </div>
        </div>
        <button type="button" onclick="filterBatches('locked')" class="bg-white hover:bg-[#faf8f4] text-[#272d28] border border-[#e3d2c1] rounded-lg px-3.5 py-2 text-xs font-semibold inline-flex items-center gap-1.5 self-start sm:self-center shrink-0 transition cursor-pointer shadow-2xs">
            <span>Tinjau batch</span>
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>

    <!-- Main 2-Column Section: Catat Produksi Harian & Antrean Stok FEFO -->
    <div class="mt-5 grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch">
        <!-- Left Column: Catat Produksi Harian -->
        <div class="lg:col-span-4 bg-white rounded-xl border border-[#e6e2d8] p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)] flex flex-col justify-between">
            <div>
                <h3 class="text-[16px] font-bold text-[#18221b]">Catat produksi harian</h3>
                <p class="text-xs text-[#7a7f76] mt-0.5">Tambahkan batch baru ke stok.</p>

                <form id="production-form" onsubmit="handleAddBatch(event)" class="mt-4 space-y-3.5">
                    <!-- Varian Produk -->
                    <div>
                        <label for="product-variant" class="block text-xs font-semibold text-[#4a4f47] mb-1.5">Varian produk</label>
                        <div class="relative">
                            <select id="product-variant" onchange="updateBatchCodePreview()" class="w-full appearance-none bg-white border border-[#dedad0] rounded-lg px-3.5 py-2.5 pr-9 text-[13px] text-[#18221b] font-medium focus:outline-none focus:border-[#1f4b31]">
                                <option value="Kunyit Asam" data-prefix="KA" selected>Kunyit Asam · 250 ml</option>
                                <option value="Beras Kencur" data-prefix="BK">Beras Kencur · 250 ml</option>
                                <option value="Jahe Merah" data-prefix="JM">Jahe Merah · 250 ml</option>
                                <option value="Temulawak" data-prefix="TW">Temulawak · 250 ml</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#6e736b]">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Kode Batch -->
                    <div>
                        <label for="batch-code" class="block text-xs font-semibold text-[#4a4f47] mb-1.5">Kode batch</label>
                        <input
                            type="text"
                            id="batch-code"
                            value="BATCH-KA-20261112-01"
                            readonly
                            class="w-full font-mono-code text-xs bg-[#faf9f5] border border-[#e6e2d8] rounded-lg px-3.5 py-2.5 text-[#3b4039] focus:outline-none"
                        >
                    </div>

                    <!-- Tanggal Produksi & Kedaluwarsa (Real-Time Validated) -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="prod-date" class="block text-xs font-semibold text-[#4a4f47] mb-1.5">Tanggal produksi</label>
                            <div class="relative flex items-center">
                                <input
                                    type="text"
                                    id="prod-date"
                                    value="{{ now()->timezone('Asia/Jakarta')->format('d/m/Y') }}"
                                    placeholder="DD/MM/YYYY"
                                    oninput="validateRealtimeDates()"
                                    class="w-full bg-white border border-[#dedad0] rounded-lg pl-3 pr-8 py-2 text-[13px] text-[#18221b] focus:outline-none focus:border-[#1f4b31]"
                                >
                                <svg class="w-3.5 h-3.5 text-[#6e736b] absolute right-2.5 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                        </div>

                        <div>
                            <label for="exp-date" class="block text-xs font-semibold text-[#4a4f47] mb-1.5">Kedaluwarsa</label>
                            <div class="relative flex items-center">
                                <input
                                    type="text"
                                    id="exp-date"
                                    value="{{ now()->timezone('Asia/Jakarta')->addDays(14)->format('d/m/Y') }}"
                                    placeholder="DD/MM/YYYY"
                                    oninput="validateRealtimeDates()"
                                    class="w-full bg-white border border-[#dedad0] rounded-lg pl-3 pr-8 py-2 text-[13px] text-[#18221b] focus:outline-none focus:border-[#1f4b31]"
                                >
                                <svg class="w-3.5 h-3.5 text-[#6e736b] absolute right-2.5 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p id="date-validation-msg" class="hidden text-[11px] font-medium text-[#c53030]"></p>

                    <!-- Jumlah Produksi -->
                    <div>
                        <label for="prod-qty" class="block text-xs font-semibold text-[#4a4f47] mb-1.5">Jumlah produksi</label>
                        <div class="flex items-center bg-white border border-[#dedad0] rounded-lg px-3.5 py-2 focus-within:border-[#1f4b31]">
                            <input
                                type="number"
                                id="prod-qty"
                                value="0"
                                min="0"
                                class="w-full text-[13px] text-[#18221b] font-medium focus:outline-none"
                            >
                            <span class="text-xs text-[#8c9188] ml-2 select-none">botol</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-1">
                        <button type="submit" class="w-full bg-[#d86b43] hover:bg-[#c35b35] text-white font-semibold text-[13px] py-2.5 px-4 rounded-lg inline-flex items-center justify-center gap-2 transition cursor-pointer shadow-2xs">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>Simpan batch &amp; tambah stok</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footnote -->
            <div class="flex items-center gap-1.5 text-[11px] text-[#7a7f76] pt-3.5">
                <svg class="w-3.5 h-3.5 text-[#5b6158] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
                <span>Urutan FEFO dihitung otomatis.</span>
            </div>
        </div>

        <!-- Right Column: Antrean Stok FEFO -->
        <div class="lg:col-span-8 bg-white rounded-xl border border-[#e6e2d8] p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)] flex flex-col justify-between">
            <div>
                <!-- Header Row -->
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3">
                    <div>
                        <h3 class="text-[16px] font-bold text-[#18221b]">Antrean stok FEFO</h3>
                        <p class="text-xs text-[#7a7f76] mt-0.5">Batch terdekat kedaluwarsa keluar lebih dulu.</p>
                    </div>
                    <div class="border border-[#e6e2d8] bg-[#faf9f5] text-[#3b4039] text-xs font-medium px-3 py-1.5 rounded-lg inline-flex items-center gap-1.5 self-start shrink-0">
                        <svg class="w-3.5 h-3.5 text-[#5a6057]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 16 4 4 4-4"></path>
                            <path d="M7 20V4"></path>
                            <path d="M11 4h10"></path>
                            <path d="M11 8h7"></path>
                            <path d="M11 12h4"></path>
                        </svg>
                        <span>Kedaluwarsa terdekat</span>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="flex items-center gap-1.5 mt-4 mb-3.5 flex-wrap">
                    <button type="button" id="tab-all" onclick="filterBatches('all')" class="bg-[#e6f0e9] text-[#1d5131] font-semibold text-xs px-3 py-1.5 rounded-lg inline-flex items-center gap-2 transition cursor-pointer">
                        <span>Semua batch</span>
                        <span id="count-all" class="font-bold">4</span>
                    </button>
                    <button type="button" id="tab-sellable" onclick="filterBatches('sellable')" class="text-[#6e736b] hover:bg-[#f5f2eb] font-medium text-xs px-3 py-1.5 rounded-lg inline-flex items-center gap-2 transition cursor-pointer">
                        <span>Layak jual</span>
                        <span id="count-sellable">3</span>
                    </button>
                    <button type="button" id="tab-locked" onclick="filterBatches('locked')" class="text-[#6e736b] hover:bg-[#f5f2eb] font-medium text-xs px-3 py-1.5 rounded-lg inline-flex items-center gap-2 transition cursor-pointer">
                        <span>Terkunci</span>
                        <span id="count-locked">1</span>
                    </button>
                </div>

                <!-- FEFO Queue Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#faf9f5] border-y border-[#ece8df] text-[11px] font-medium text-[#7a7f76]">
                                <th class="py-2.5 pl-3 pr-2 w-10">#</th>
                                <th class="py-2.5 px-3">Produk / kode batch</th>
                                <th class="py-2.5 px-3">Produksi</th>
                                <th class="py-2.5 px-3">Kedaluwarsa</th>
                                <th class="py-2.5 px-3">Sisa hari</th>
                                <th class="py-2.5 px-3">Stok</th>
                                <th class="py-2.5 pl-3 pr-3">Status kelayakan</th>
                            </tr>
                        </thead>
                        <tbody id="fefo-table-body" class="divide-y divide-[#ece8df] text-xs">
                            <!-- Row 1: Locked H-3 -->
                            <tr class="hover:bg-[#faf9f5]/60 transition" data-status="locked">
                                <td class="py-3.5 pl-3 pr-2 text-[#9a9e96] font-medium">&mdash;</td>
                                <td class="py-3.5 px-3">
                                    <div class="font-bold text-[13.5px] text-[#18221b]">Kunyit Asam</div>
                                    <div class="font-mono-code text-[11px] text-[#8c9188] mt-0.5">BATCH-KA-20261107-01</div>
                                </td>
                                <td class="py-3.5 px-3 text-[#6e736b]">07 Nov 26</td>
                                <td class="py-3.5 px-3 font-semibold text-[#18221b]">14 Nov 26</td>
                                <td class="py-3.5 px-3 font-bold text-[#c53030]">2 hari</td>
                                <td class="py-3.5 px-3 font-bold text-[13.5px] text-[#18221b]">6</td>
                                <td class="py-3.5 pl-3 pr-3">
                                    <span class="inline-block bg-[#fde8e8] text-[#b91c1c] text-[11px] font-semibold px-2.5 py-0.5 rounded-md">
                                        Terkunci otomatis H-3
                                    </span>
                                    <div class="text-[11px] text-[#8c9188] mt-1">Tidak masuk stok katalog</div>
                                </td>
                            </tr>

                            <!-- Row 2: Priority #1 Warning H-6 -->
                            <tr class="bg-[#fffcf5] hover:bg-[#fef9ec] transition" data-status="sellable">
                                <td class="py-3.5 pl-3 pr-2 font-bold text-[#18221b]">#1</td>
                                <td class="py-3.5 px-3">
                                    <div class="font-bold text-[13.5px] text-[#18221b]">Beras Kencur</div>
                                    <div class="font-mono-code text-[11px] text-[#8c9188] mt-0.5">BATCH-BK-20261111-01</div>
                                </td>
                                <td class="py-3.5 px-3 text-[#6e736b]">11 Nov 26</td>
                                <td class="py-3.5 px-3 font-semibold text-[#18221b]">18 Nov 26</td>
                                <td class="py-3.5 px-3 font-bold text-[#b45309]">6 hari</td>
                                <td class="py-3.5 px-3 font-bold text-[13.5px] text-[#18221b]">8</td>
                                <td class="py-3.5 pl-3 pr-3">
                                    <span class="inline-block bg-[#fef3c7] text-[#b45309] text-[11px] font-semibold px-2.5 py-0.5 rounded-md">
                                        Warning H-6
                                    </span>
                                    <div class="text-[11px] font-bold text-[#18221b] mt-1">Prioritas keluar #1 (FEFO)</div>
                                </td>
                            </tr>

                            <!-- Row 3: Priority #2 Layak Jual -->
                            <tr class="hover:bg-[#faf9f5]/60 transition" data-status="sellable">
                                <td class="py-3.5 pl-3 pr-2 font-medium text-[#6e736b]">#2</td>
                                <td class="py-3.5 px-3">
                                    <div class="font-bold text-[13.5px] text-[#18221b]">Kunyit Asam</div>
                                    <div class="font-mono-code text-[11px] text-[#8c9188] mt-0.5">BATCH-KA-20261112-02</div>
                                </td>
                                <td class="py-3.5 px-3 text-[#6e736b]">12 Nov 26</td>
                                <td class="py-3.5 px-3 font-semibold text-[#18221b]">23 Nov 26</td>
                                <td class="py-3.5 px-3 font-medium text-[#4a4f47]">11 hari</td>
                                <td class="py-3.5 px-3 font-bold text-[13.5px] text-[#18221b]">10</td>
                                <td class="py-3.5 pl-3 pr-3">
                                    <span class="inline-block bg-[#e6f4ea] text-[#1e6f3d] text-[11px] font-semibold px-2.5 py-0.5 rounded-md">
                                        Layak jual
                                    </span>
                                    <div class="text-[11px] text-[#8c9188] mt-1">Antrean FEFO #2</div>
                                </td>
                            </tr>

                            <!-- Row 4: Priority #3 Layak Jual -->
                            <tr class="hover:bg-[#faf9f5]/60 transition" data-status="sellable">
                                <td class="py-3.5 pl-3 pr-2 font-medium text-[#6e736b]">#3</td>
                                <td class="py-3.5 px-3">
                                    <div class="font-bold text-[13.5px] text-[#18221b]">Jahe Merah</div>
                                    <div class="font-mono-code text-[11px] text-[#8c9188] mt-0.5">BATCH-JM-20261112-01</div>
                                </td>
                                <td class="py-3.5 px-3 text-[#6e736b]">12 Nov 26</td>
                                <td class="py-3.5 px-3 font-semibold text-[#18221b]">26 Nov 26</td>
                                <td class="py-3.5 px-3 font-medium text-[#4a4f47]">14 hari</td>
                                <td class="py-3.5 px-3 font-bold text-[13.5px] text-[#18221b]">16</td>
                                <td class="py-3.5 pl-3 pr-3">
                                    <span class="inline-block bg-[#e6f4ea] text-[#1e6f3d] text-[11px] font-semibold px-2.5 py-0.5 rounded-md">
                                        Layak jual
                                    </span>
                                    <div class="text-[11px] text-[#8c9188] mt-1">Antrean FEFO #3</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Card Footer Summary -->
            <div class="pt-3.5 mt-2 border-t border-[#ece8df] flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
                <div class="flex items-center gap-1.5 flex-wrap">
                    <svg class="w-3.5 h-3.5 text-[#1e6f3d] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span id="footer-sellable-text" class="font-semibold text-[#1e6f3d]">34 botol layak jual</span>
                    <span class="text-[#b5b0a6] mx-0.5">·</span>
                    <span id="footer-locked-text" class="text-[#7a7f76]">6 botol terkunci dikecualikan dari katalog</span>
                </div>
                <div id="footer-batch-count" class="text-[#7a7f76]">
                    4 batch
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const MONTHS_SHORT_ID = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    function addDaysToDate(baseDate, days) {
        const d = new Date(baseDate.getFullYear(), baseDate.getMonth(), baseDate.getDate());
        d.setDate(d.getDate() + days);
        return d;
    }

    function formatShortDate(dateObj) {
        const d = String(dateObj.getDate()).padStart(2, '0');
        const m = MONTHS_SHORT_ID[dateObj.getMonth()] || 'Nov';
        const y = String(dateObj.getFullYear()).slice(-2);
        return `${d} ${m} ${y}`;
    }

    function formatSlashDate(dateObj) {
        const d = String(dateObj.getDate()).padStart(2, '0');
        const m = String(dateObj.getMonth() + 1).padStart(2, '0');
        const y = dateObj.getFullYear();
        return `${d}/${m}/${y}`;
    }

    function formatCompactYmd(dateObj) {
        const y = dateObj.getFullYear();
        const m = String(dateObj.getMonth() + 1).padStart(2, '0');
        const d = String(dateObj.getDate()).padStart(2, '0');
        return `${y}${m}${d}`;
    }

    function buildRealtimeInitialBatches() {
        const today = new Date();
        const ymdToday = formatCompactYmd(today);
        const ymdMinus1 = formatCompactYmd(addDaysToDate(today, -1));
        const ymdMinus5 = formatCompactYmd(addDaysToDate(today, -5));

        return [
            {
                product: 'Kunyit Asam',
                code: `BATCH-KA-${ymdMinus5}-01`,
                prodDateDisplay: formatShortDate(addDaysToDate(today, -5)),
                expDateDisplay: formatShortDate(addDaysToDate(today, 2)),
                daysLeft: 2,
                stock: 6
            },
            {
                product: 'Beras Kencur',
                code: `BATCH-BK-${ymdMinus1}-01`,
                prodDateDisplay: formatShortDate(addDaysToDate(today, -1)),
                expDateDisplay: formatShortDate(addDaysToDate(today, 6)),
                daysLeft: 6,
                stock: 8
            },
            {
                product: 'Kunyit Asam',
                code: `BATCH-KA-${ymdToday}-02`,
                prodDateDisplay: formatShortDate(today),
                expDateDisplay: formatShortDate(addDaysToDate(today, 11)),
                daysLeft: 11,
                stock: 10
            },
            {
                product: 'Jahe Merah',
                code: `BATCH-JM-${ymdToday}-01`,
                prodDateDisplay: formatShortDate(today),
                expDateDisplay: formatShortDate(addDaysToDate(today, 14)),
                daysLeft: 14,
                stock: 16
            }
        ];
    }

    let batches = buildRealtimeInitialBatches();
    let currentFilter = 'all';

    function toggleMobileSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    }

    // Validasi ketat tanggal, bulan (1-12), dan tahun (termasuk kabisat) secara real-time
    function parseSlashDate(dateStr) {
        if (!dateStr) return null;
        const parts = dateStr.trim().split('/');
        if (parts.length !== 3) return null;

        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10);
        const year = parseInt(parts[2], 10);

        if (isNaN(day) || isNaN(month) || isNaN(year)) return null;
        if (year < 2020 || year > 2100 || month < 1 || month > 12 || day < 1 || day > 31) return null;

        const dateObj = new Date(year, month - 1, day);
        // Pastikan tanggal tidak melompat bulan (misal 31/02 atau 31/11 tidak valid)
        if (
            dateObj.getFullYear() !== year ||
            dateObj.getMonth() !== month - 1 ||
            dateObj.getDate() !== day
        ) {
            return null;
        }
        return dateObj;
    }

    function updateBatchCodePreview() {
        const select = document.getElementById('product-variant');
        const selectedOption = select.options[select.selectedIndex];
        const prefix = selectedOption.getAttribute('data-prefix') || 'KA';
        const prodDateObj = parseSlashDate(document.getElementById('prod-date')?.value) || new Date();
        const ymd = formatCompactYmd(prodDateObj);
        const existingForPrefix = batches.filter(b => b.code.includes(`BATCH-${prefix}-${ymd}`)).length;
        const seq = String(existingForPrefix + 1).padStart(2, '0');
        document.getElementById('batch-code').value = `BATCH-${prefix}-${ymd}-${seq}`;
    }

    function validateRealtimeDates() {
        const prodInput = document.getElementById('prod-date');
        const expInput = document.getElementById('exp-date');
        const msgEl = document.getElementById('date-validation-msg');

        const prodObj = parseSlashDate(prodInput.value);
        const expObj = parseSlashDate(expInput.value);

        if (!prodObj) {
            msgEl.textContent = 'Format Tanggal Produksi tidak valid (gunakan DD/MM/YYYY dengan tanggal, bulan 01-12, & tahun yang benar).';
            msgEl.classList.remove('hidden');
            prodInput.classList.add('border-[#c53030]');
            return false;
        }
        prodInput.classList.remove('border-[#c53030]');

        if (!expObj) {
            msgEl.textContent = 'Format Tanggal Kedaluwarsa tidak valid (gunakan DD/MM/YYYY dengan tanggal, bulan 01-12, & tahun yang benar).';
            msgEl.classList.remove('hidden');
            expInput.classList.add('border-[#c53030]');
            return false;
        }

        if (expObj <= prodObj) {
            msgEl.textContent = 'Tanggal Kedaluwarsa harus lebih besar dari Tanggal Produksi.';
            msgEl.classList.remove('hidden');
            expInput.classList.add('border-[#c53030]');
            return false;
        }

        expInput.classList.remove('border-[#c53030]');
        msgEl.classList.add('hidden');
        updateBatchCodePreview();
        return true;
    }

    function filterBatches(filter) {
        currentFilter = filter;
        const tabIds = ['all', 'sellable', 'locked'];
        tabIds.forEach(id => {
            const btn = document.getElementById(`tab-${id}`);
            if (id === filter) {
                btn.className = 'bg-[#e6f0e9] text-[#1d5131] font-semibold text-xs px-3 py-1.5 rounded-lg inline-flex items-center gap-2 transition cursor-pointer';
            } else {
                btn.className = 'text-[#6e736b] hover:bg-[#f5f2eb] font-medium text-xs px-3 py-1.5 rounded-lg inline-flex items-center gap-2 transition cursor-pointer';
            }
        });
        renderBatches();
    }

    function renderBatches() {
        // Sort by FEFO (shortest daysLeft first)
        batches.sort((a, b) => a.daysLeft - b.daysLeft);

        let fefoQueueIndex = 0;
        let sellableBottles = 0;
        let lockedBottles = 0;
        let sellableCount = 0;
        let lockedCount = 0;
        let warningCount = 0;

        const rowsHtml = [];

        batches.forEach(batch => {
            const isLocked = batch.daysLeft <= 3;
            const isWarning = !isLocked && batch.daysLeft <= 7;

            if (isLocked) {
                lockedCount++;
                lockedBottles += batch.stock;
            } else {
                sellableCount++;
                sellableBottles += batch.stock;
                fefoQueueIndex++;
                if (isWarning) warningCount++;
            }

            if (currentFilter === 'sellable' && isLocked) return;
            if (currentFilter === 'locked' && !isLocked) return;

            const isFirstPriority = !isLocked && fefoQueueIndex === 1;
            const rowBgClass = isFirstPriority
                ? 'bg-[#fffcf5] hover:bg-[#fef9ec] transition'
                : 'hover:bg-[#faf9f5]/60 transition';

            const queueLabel = isLocked
                ? '<span class="text-[#9a9e96] font-medium">&mdash;</span>'
                : `<span class="${isFirstPriority ? 'font-bold text-[#18221b]' : 'font-medium text-[#6e736b]'}">#${fefoQueueIndex}</span>`;

            let daysClass = 'font-medium text-[#4a4f47]';
            if (isLocked) daysClass = 'font-bold text-[#c53030]';
            else if (isWarning) daysClass = 'font-bold text-[#b45309]';

            let statusBadge = '';
            let statusSubtext = '';

            if (isLocked) {
                statusBadge = `<span class="inline-block bg-[#fde8e8] text-[#b91c1c] text-[11px] font-semibold px-2.5 py-0.5 rounded-md">Terkunci otomatis H-3</span>`;
                statusSubtext = `<div class="text-[11px] text-[#8c9188] mt-1">Tidak masuk stok katalog</div>`;
            } else if (isWarning) {
                statusBadge = `<span class="inline-block bg-[#fef3c7] text-[#b45309] text-[11px] font-semibold px-2.5 py-0.5 rounded-md">Warning H-${batch.daysLeft}</span>`;
                statusSubtext = isFirstPriority
                    ? `<div class="text-[11px] font-bold text-[#18221b] mt-1">Prioritas keluar #1 (FEFO)</div>`
                    : `<div class="text-[11px] text-[#8c9188] mt-1">Antrean FEFO #${fefoQueueIndex}</div>`;
            } else {
                statusBadge = `<span class="inline-block bg-[#e6f4ea] text-[#1e6f3d] text-[11px] font-semibold px-2.5 py-0.5 rounded-md">Layak jual</span>`;
                statusSubtext = isFirstPriority
                    ? `<div class="text-[11px] font-bold text-[#18221b] mt-1">Prioritas keluar #1 (FEFO)</div>`
                    : `<div class="text-[11px] text-[#8c9188] mt-1">Antrean FEFO #${fefoQueueIndex}</div>`;
            }

            rowsHtml.push(`
                <tr class="${rowBgClass}">
                    <td class="py-3.5 pl-3 pr-2">${queueLabel}</td>
                    <td class="py-3.5 px-3">
                        <div class="font-bold text-[13.5px] text-[#18221b]">${batch.product}</div>
                        <div class="font-mono-code text-[11px] text-[#8c9188] mt-0.5">${batch.code}</div>
                    </td>
                    <td class="py-3.5 px-3 text-[#6e736b]">${batch.prodDateDisplay}</td>
                    <td class="py-3.5 px-3 font-semibold text-[#18221b]">${batch.expDateDisplay}</td>
                    <td class="py-3.5 px-3 ${daysClass}">${batch.daysLeft} hari</td>
                    <td class="py-3.5 px-3 font-bold text-[13.5px] text-[#18221b]">${batch.stock}</td>
                    <td class="py-3.5 pl-3 pr-3">
                        ${statusBadge}
                        ${statusSubtext}
                    </td>
                </tr>
            `);
        });

        document.getElementById('fefo-table-body').innerHTML = rowsHtml.join('');

        // Update counts & KPIs
        document.getElementById('count-all').textContent = batches.length;
        document.getElementById('count-sellable').textContent = sellableCount;
        document.getElementById('count-locked').textContent = lockedCount;

        document.getElementById('kpi-sellable-bottles').textContent = sellableBottles;
        document.getElementById('kpi-alert-batches').textContent = warningCount + lockedCount;
        document.getElementById('kpi-alert-detail').textContent = `${warningCount} warning · ${lockedCount} terkunci H-3`;

        document.getElementById('footer-sellable-text').textContent = `${sellableBottles} botol layak jual`;
        document.getElementById('footer-locked-text').textContent = `${lockedBottles} botol terkunci dikecualikan dari katalog`;
        document.getElementById('footer-batch-count').textContent = `${batches.length} batch`;
    }

    function handleAddBatch(event) {
        event.preventDefault();
        if (!validateRealtimeDates()) {
            return;
        }

        const select = document.getElementById('product-variant');
        const product = select.value;
        const code = document.getElementById('batch-code').value;
        const prodDateStr = document.getElementById('prod-date').value;
        const expDateStr = document.getElementById('exp-date').value;
        const qtyInput = document.getElementById('prod-qty');
        const qty = parseInt(qtyInput.value, 10) || 0;

        if (qty <= 0) {
            qtyInput.focus();
            return;
        }

        // Hitung sisa hari secara real-time terhadap tanggal hari ini
        const now = new Date();
        const refDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        const prodDateObj = parseSlashDate(prodDateStr) || refDate;
        const expDateObj = parseSlashDate(expDateStr) || addDaysToDate(refDate, 14);
        const diffDays = Math.max(0, Math.round((expDateObj - refDate) / (1000 * 60 * 60 * 24)));

        batches.push({
            product,
            code,
            prodDateDisplay: formatShortDate(prodDateObj),
            expDateDisplay: formatShortDate(expDateObj),
            daysLeft: diffDays,
            stock: qty
        });

        // Simpan juga secara langsung ke database melalui TypCareController
        const expIso = `${expDateObj.getFullYear()}-${String(expDateObj.getMonth() + 1).padStart(2, '0')}-${String(expDateObj.getDate()).padStart(2, '0')}`;
        fetch('{{ route("admin.products.save") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                nama_barang: `Jamu ${product} 250ml`,
                ukuran: '250 ml',
                harga: 15000,
                stok: qty,
                kode_batch: code,
                tgl_kedaluwarsa: expIso
            })
        }).catch(() => {});

        qtyInput.value = 0;
        renderBatches();
        updateBatchCodePreview();
    }

    function resetDemoData() {
        const today = new Date();
        batches = buildRealtimeInitialBatches();
        document.getElementById('product-variant').selectedIndex = 0;
        document.getElementById('prod-date').value = formatSlashDate(today);
        document.getElementById('exp-date').value = formatSlashDate(addDaysToDate(today, 14));
        document.getElementById('prod-qty').value = '0';
        validateRealtimeDates();
        filterBatches('all');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const today = new Date();
        document.getElementById('prod-date').value = formatSlashDate(today);
        document.getElementById('exp-date').value = formatSlashDate(addDaysToDate(today, 14));
        updateBatchCodePreview();
        renderBatches();
    });
</script>
@endpush
