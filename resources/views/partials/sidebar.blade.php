<!-- Mobile Sidebar Backdrop -->
<div id="sidebar-backdrop" onclick="toggleMobileSidebar()" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

<!-- Left Sidebar -->
<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-40 w-[248px] bg-[#1b432c] text-white flex flex-col justify-between border-r border-white/10 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out select-none">
    <!-- Top Brand & Navigation -->
    <div>
        <!-- Brand Header -->
        <div class="px-5 pt-5 pb-4 border-b border-white/10">
            <a href="{{ url('/') }}" class="block focus:outline-none">
                <h1 class="font-brand text-[23px] font-bold text-white tracking-tight leading-none">TYP-Care</h1>
                <p class="text-[9.5px] font-semibold tracking-[0.14em] text-[#92b8a0] uppercase mt-2">HERBAL DRINK · BACKOFFICE</p>
            </a>
        </div>

        <!-- Workspace Navigation -->
        @php
            $isProductAiPage = request()->routeIs('admin.products*') || request()->routeIs('admin.produk*');
            $isOrdersPage = request()->routeIs('admin.orders*') || request()->routeIs('admin.pesanan*');
            $isReportsPage = request()->routeIs('admin.reports*') || request()->routeIs('admin.laporan*');
            $isDashboardPage = ! $isProductAiPage && ! $isOrdersPage && ! $isReportsPage;
        @endphp
        <div class="px-3.5 pt-5">
            <p class="px-2.5 text-[10px] font-semibold uppercase tracking-[0.12em] text-[#7fa68e] mb-2.5">RUANG KERJA</p>
            <nav class="space-y-1">
                <!-- Dashboard & stok FEFO -->
                <a href="{{ route('admin.dashboard') }}" class="{{ $isDashboardPage ? 'bg-white/[0.13] text-white font-semibold shadow-2xs' : 'text-[#c8ddd0] hover:bg-white/[0.06] hover:text-white font-medium' }} rounded-lg px-3 py-2.5 text-[13px] flex items-center gap-3 transition">
                    <svg class="w-4 h-4 {{ $isDashboardPage ? 'text-[#95e2b2]' : 'text-[#9abca7]' }} shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                        <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                        <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                        <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
                    </svg>
                    <span>Dashboard &amp; stok FEFO</span>
                </a>

                <!-- Produk & data AI -->
                <a href="{{ route('admin.products') }}" class="{{ $isProductAiPage ? 'bg-white/[0.13] text-white font-semibold shadow-2xs' : 'text-[#c8ddd0] hover:bg-white/[0.06] hover:text-white font-medium' }} rounded-lg px-3 py-2.5 text-[13px] flex items-center gap-3 transition">
                    <svg class="w-4 h-4 {{ $isProductAiPage ? 'text-[#95e2b2]' : 'text-[#9abca7]' }} shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span>Produk &amp; data AI</span>
                </a>

                <!-- Pesanan & tracking -->
                <a href="{{ route('admin.orders') }}" class="{{ $isOrdersPage ? 'bg-white/[0.13] text-white font-semibold shadow-2xs' : 'text-[#c8ddd0] hover:bg-white/[0.06] hover:text-white font-medium' }} rounded-lg px-3 py-2.5 text-[13px] flex items-center gap-3 transition">
                    <svg class="w-4 h-4 {{ $isOrdersPage ? 'text-[#95e2b2]' : 'text-[#9abca7]' }} shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span>Pesanan &amp; tracking</span>
                </a>

                <!-- Laporan penjualan -->
                <a href="{{ route('admin.reports') }}" class="{{ $isReportsPage ? 'bg-white/[0.13] text-white font-semibold shadow-2xs' : 'text-[#c8ddd0] hover:bg-white/[0.06] hover:text-white font-medium' }} rounded-lg px-3 py-2.5 text-[13px] flex items-center gap-3 transition">
                    <svg class="w-4 h-4 {{ $isReportsPage ? 'text-[#95e2b2]' : 'text-[#9abca7]' }} shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <line x1="10" y1="9" x2="8" y2="9"></line>
                    </svg>
                    <span>Laporan penjualan</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Bottom Info Card, Demo Reset, User Profile & Logout -->
    <div class="mt-auto">
        <!-- Quality Guarantee Box -->
        <div class="mx-3.5 mb-5 p-4 rounded-xl bg-white/[0.07] border border-white/[0.08]">
            <div class="text-[#95e2b2] mb-2.5">
                <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
            </div>
            <h3 class="text-[12.5px] font-semibold text-white leading-snug">Stok aman, pelanggan tenang.</h3>
            <p class="text-[11.5px] text-[#b4cebd] mt-1 leading-relaxed">
                Filter H-3 menjaga kualitas jamu di setiap pesanan.
            </p>
        </div>

        <!-- Reset Data Demo -->
        <button type="button" onclick="resetDemoData()" class="w-full px-5 py-3 text-left text-[13px] font-medium text-[#c8ddd0] hover:text-white hover:bg-white/[0.05] flex items-center gap-3 transition cursor-pointer">
            <svg class="w-4 h-4 text-[#9abca7] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                <path d="M3 3v5h5"></path>
            </svg>
            <span>Reset data demo</span>
        </button>

        <!-- Admin User Info -->
        @php
            $adminUser = session('auth_user', [
                'name' => 'Rinaldi Mulya Putra',
                'email' => 'rinaldi@gmail.com',
                'role_label' => 'Admin · TYP Herbal Drink',
            ]);
        @endphp
        <div class="px-5 py-3.5 border-t border-white/10">
            <p class="text-[13.5px] font-semibold text-white leading-tight">{{ $adminUser['name'] ?? 'Rinaldi Mulya Putra' }}</p>
            <p class="text-[11.5px] text-[#8eb49c] mt-1">{{ $adminUser['role_label'] ?? 'Admin · TYP Herbal Drink' }}</p>
        </div>

        <!-- Logout Button -->
        <div class="border-t border-white/10">
            <a href="{{ route('logout') }}" class="w-full px-5 py-3.5 text-left text-[13px] font-medium text-[#c8ddd0] hover:text-white hover:bg-white/[0.05] flex items-center gap-3 transition">
                <svg class="w-4 h-4 text-[#9abca7] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>Logout</span>
            </a>
        </div>
    </div>
</aside>
