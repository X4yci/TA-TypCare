@extends('layouts.admin')

@section('title', 'Produk & Data AI — TYP-Care Backoffice')
@section('breadcrumb', 'Produk & data AI')
@section('hide_footer', 'true')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-[25px] sm:text-[27px] font-bold text-[#18221b] tracking-tight leading-tight">Produk &amp; data AI</h2>
            <p class="text-[13.5px] text-[#6e736b] mt-1">Kelola varian jamu dan informasi yang menjadi acuan rekomendasi AI.</p>
        </div>
        <div>
            <button
                type="button"
                onclick="openProductModal()"
                class="bg-[#d86b43] hover:bg-[#c35b35] text-white font-semibold text-[13px] px-5 py-2.5 rounded-lg inline-flex items-center justify-center shadow-2xs transition cursor-pointer"
            >
                Tambah produk
            </button>
        </div>
    </div>

    <!-- Top 3-Column Summary Card -->
    <div class="mt-5 bg-white rounded-xl border border-[#e6e2d8] px-6 py-4 shadow-[0_1px_2px_rgba(0,0,0,0.02)] grid grid-cols-1 sm:grid-cols-3 gap-5">
        <!-- Col 1: Katalog Produk -->
        <div>
            <p class="text-[10.5px] font-semibold uppercase tracking-[0.06em] text-[#7a7f76]">KATALOG PRODUK</p>
            <p class="text-[19px] font-bold text-[#18221b] mt-1 leading-snug">
                <span id="summary-variant-count">3</span> varian dengan stok
            </p>
        </div>

        <!-- Col 2: Stok Layak Jual -->
        <div>
            <p class="text-[10.5px] font-semibold uppercase tracking-[0.06em] text-[#7a7f76]">STOK LAYAK JUAL</p>
            <p class="mt-1 leading-snug flex items-baseline gap-2.5">
                <span id="summary-bottle-count" class="text-[20px] font-bold text-[#18221b]">34</span>
                <span class="text-xs font-normal text-[#7a7f76]">botol</span>
            </p>
        </div>

        <!-- Col 3: Pengetahuan AI -->
        <div>
            <p class="text-[10.5px] font-semibold uppercase tracking-[0.06em] text-[#7a7f76]">PENGETAHUAN AI</p>
            <p class="text-[14px] font-bold text-[#1f6b3b] mt-1.5 leading-snug">
                Tersinkronisasi dengan AI Chatbot
            </p>
        </div>
    </div>

    <!-- Main Table Card: Daftar Varian Jamu -->
    <div class="mt-5 bg-white rounded-xl border border-[#e6e2d8] p-5 sm:p-6 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
        <div>
            <h3 class="text-[16px] font-bold text-[#18221b]">Daftar varian jamu</h3>
            <p class="text-xs text-[#7a7f76] mt-0.5">Stok tidak termasuk batch terkunci H-3.</p>
        </div>

        <div class="mt-4 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#ece8df] text-[11px] font-medium text-[#7a7f76]">
                        <th class="py-3 pr-4">Produk &amp; ukuran</th>
                        <th class="py-3 px-4">Harga</th>
                        <th class="py-3 px-4">Stok layak jual</th>
                        <th class="py-3 px-4">Komposisi utama</th>
                        <th class="py-3 px-4">Alergen / pantangan</th>
                        <th class="py-3 pl-4 text-left w-[150px]">Aksi</th>
                    </tr>
                </thead>
                <tbody id="ai-products-tbody" class="divide-y divide-[#ece8df] text-xs">
                    <!-- Row 1: Kunyit Asam -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pr-4">
                            <div class="font-bold text-[14px] text-[#18221b]">Kunyit Asam</div>
                            <div class="text-[11.5px] text-[#8c9188] mt-0.5">250 ml · Jamu botolan</div>
                        </td>
                        <td class="py-4 px-4 font-semibold text-[#18221b]">Rp 15.000</td>
                        <td class="py-4 px-4 font-bold text-[14px] text-[#1e6f3d]">10</td>
                        <td class="py-4 px-4 text-[#4a4f47]">Kunyit segar, asam jawa, gula aren</td>
                        <td class="py-4 px-4 font-medium text-[#b45309]">Maag akut / asam lambung tinggi</td>
                        <td class="py-4 pl-4 whitespace-nowrap">
                            <button type="button" onclick="editProductRow(0)" class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-3.5 py-2 rounded-lg transition cursor-pointer">
                                Edit
                            </button>
                            <button type="button" onclick="deleteProductRow(0)" class="bg-[#fdf0f0] hover:bg-[#fbdada] text-[#c53030] font-semibold text-xs px-3.5 py-2 rounded-lg transition cursor-pointer ml-1.5">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2: Beras Kencur -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pr-4">
                            <div class="font-bold text-[14px] text-[#18221b]">Beras Kencur</div>
                            <div class="text-[11.5px] text-[#8c9188] mt-0.5">250 ml · Jamu botolan</div>
                        </td>
                        <td class="py-4 px-4 font-semibold text-[#18221b]">Rp 15.000</td>
                        <td class="py-4 px-4 font-bold text-[14px] text-[#1e6f3d]">8</td>
                        <td class="py-4 px-4 text-[#4a4f47]">Beras, kencur segar, gula aren</td>
                        <td class="py-4 px-4 font-medium text-[#b45309]">Perhatikan asupan gula</td>
                        <td class="py-4 pl-4 whitespace-nowrap">
                            <button type="button" onclick="editProductRow(1)" class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-3.5 py-2 rounded-lg transition cursor-pointer">
                                Edit
                            </button>
                            <button type="button" onclick="deleteProductRow(1)" class="bg-[#fdf0f0] hover:bg-[#fbdada] text-[#c53030] font-semibold text-xs px-3.5 py-2 rounded-lg transition cursor-pointer ml-1.5">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3: Jahe Merah -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pr-4">
                            <div class="font-bold text-[14px] text-[#18221b]">Jahe Merah</div>
                            <div class="text-[11.5px] text-[#8c9188] mt-0.5">250 ml · Jamu botolan</div>
                        </td>
                        <td class="py-4 px-4 font-semibold text-[#18221b]">Rp 15.000</td>
                        <td class="py-4 px-4 font-bold text-[14px] text-[#1e6f3d]">16</td>
                        <td class="py-4 px-4 text-[#4a4f47]">Jahe merah, serai, gula aren</td>
                        <td class="py-4 px-4 font-medium text-[#b45309]">Sensitif jahe pedas</td>
                        <td class="py-4 pl-4 whitespace-nowrap">
                            <button type="button" onclick="editProductRow(2)" class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-3.5 py-2 rounded-lg transition cursor-pointer">
                                Edit
                            </button>
                            <button type="button" onclick="deleteProductRow(2)" class="bg-[#fdf0f0] hover:bg-[#fbdada] text-[#c53030] font-semibold text-xs px-3.5 py-2 rounded-lg transition cursor-pointer ml-1.5">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bottom Green Info Callout Banner -->
    <div class="mt-5 bg-[#e6efe8] border border-[#d3e2d7] rounded-xl p-5 sm:px-6 sm:py-5 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="max-w-3xl">
            <h3 class="text-[15px] font-bold text-[#1b4d2e] leading-snug">
                Data produk yang lengkap, rekomendasi yang lebih aman.
            </h3>
            <p class="text-xs text-[#4a6453] mt-1.5 leading-relaxed">
                AI membaca komposisi, manfaat, dan pantangan terbaru. Produk tanpa stok layak jual tidak direkomendasikan.
            </p>
            <p class="text-xs text-[#4a6453] mt-2 leading-relaxed">
                Periksa alergi dan kondisi pantangan setiap kali memperbarui produk.
            </p>
            <p class="text-[11px] text-[#637b6b] mt-2">
                Klik Edit untuk mencoba perubahan harga, komposisi, manfaat, dan pantangan.
            </p>
        </div>

        <button
            type="button"
            onclick="alert('Panduan Data AI TYP-Care:\n1. Pastikan komposisi utama ditulis jelas.\n2. Cantumkan alergen/pantangan (misal: maag akut, diabetes, sensitif pedas).\n3. AI Chatbot otomatis mengecualikan produk dengan stok layak jual = 0.')"
            class="bg-[#f4f7f4] hover:bg-white text-[#1e4930] border border-[#d5e2d8] font-semibold text-xs px-4 py-2.5 rounded-lg self-start sm:self-end shrink-0 transition cursor-pointer shadow-2xs"
        >
            Panduan data AI
        </button>
    </div>

    <!-- Modal Tambah / Edit Produk & Data AI -->
    <div id="product-ai-modal" class="fixed inset-0 z-50 bg-black/50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-[#e6e2d8] w-full max-w-md p-6 shadow-xl">
            <div class="flex items-center justify-between pb-3 border-b border-[#ece8df]">
                <h3 id="modal-form-title" class="text-base font-bold text-[#18221b]">Tambah Produk &amp; Data AI</h3>
                <button type="button" onclick="closeProductModal()" class="text-[#7a7f76] hover:text-[#18221b] text-lg leading-none cursor-pointer">&times;</button>
            </div>

            <form id="product-ai-form" onsubmit="saveProductRow(event)" class="mt-4 space-y-3.5 text-xs">
                <input type="hidden" id="edit-row-index" value="-1">

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-[#4a4f47] mb-1">Nama varian</label>
                        <input type="text" id="input-name" required placeholder="Contoh: Temulawak" class="w-full border border-[#dedad0] rounded-lg px-3 py-2 text-xs text-[#18221b] focus:outline-none focus:border-[#1f4b31]">
                    </div>
                    <div>
                        <label class="block font-semibold text-[#4a4f47] mb-1">Ukuran</label>
                        <input type="text" id="input-size" value="250 ml · Jamu botolan" required class="w-full border border-[#dedad0] rounded-lg px-3 py-2 text-xs text-[#18221b] focus:outline-none focus:border-[#1f4b31]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-[#4a4f47] mb-1">Harga (Rp)</label>
                        <input type="number" id="input-price" value="15000" min="0" required class="w-full border border-[#dedad0] rounded-lg px-3 py-2 text-xs text-[#18221b] focus:outline-none focus:border-[#1f4b31]">
                    </div>
                    <div>
                        <label class="block font-semibold text-[#4a4f47] mb-1">Stok layak jual (botol)</label>
                        <input type="number" id="input-stock" value="10" min="0" required class="w-full border border-[#dedad0] rounded-lg px-3 py-2 text-xs text-[#18221b] focus:outline-none focus:border-[#1f4b31]">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-[#4a4f47] mb-1">Komposisi utama</label>
                    <input type="text" id="input-composition" required placeholder="Kunyit segar, asam jawa, gula aren" class="w-full border border-[#dedad0] rounded-lg px-3 py-2 text-xs text-[#18221b] focus:outline-none focus:border-[#1f4b31]">
                </div>

                <div>
                    <label class="block font-semibold text-[#4a4f47] mb-1">Alergen / pantangan</label>
                    <input type="text" id="input-allergen" required placeholder="Maag akut / asam lambung tinggi" class="w-full border border-[#dedad0] rounded-lg px-3 py-2 text-xs text-[#18221b] focus:outline-none focus:border-[#1f4b31]">
                </div>

                <div class="pt-2 flex items-center justify-end gap-2">
                    <button type="button" onclick="closeProductModal()" class="px-4 py-2 rounded-lg border border-[#dedad0] text-[#4a4f47] font-semibold hover:bg-[#faf9f5] cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-[#d86b43] hover:bg-[#c35b35] text-white font-semibold cursor-pointer">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const INITIAL_AI_PRODUCTS = [
        {
            name: 'Kunyit Asam',
            size: '250 ml · Jamu botolan',
            price: 15000,
            stock: 10,
            composition: 'Kunyit segar, asam jawa, gula aren',
            allergen: 'Maag akut / asam lambung tinggi'
        },
        {
            name: 'Beras Kencur',
            size: '250 ml · Jamu botolan',
            price: 15000,
            stock: 8,
            composition: 'Beras, kencur segar, gula aren',
            allergen: 'Perhatikan asupan gula'
        },
        {
            name: 'Jahe Merah',
            size: '250 ml · Jamu botolan',
            price: 15000,
            stock: 16,
            composition: 'Jahe merah, serai, gula aren',
            allergen: 'Sensitif jahe pedas'
        }
    ];

    let aiProducts = JSON.parse(JSON.stringify(INITIAL_AI_PRODUCTS));

    function toggleMobileSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    }

    function formatRupiah(num) {
        return 'Rp ' + Number(num).toLocaleString('id-ID');
    }

    function renderAiProducts() {
        const tbody = document.getElementById('ai-products-tbody');
        let totalBottles = 0;
        let activeVariants = 0;

        const rows = aiProducts.map((item, idx) => {
            const stock = Number(item.stock) || 0;
            totalBottles += stock;
            if (stock > 0) activeVariants++;

            return `
                <tr class="hover:bg-[#faf9f5]/60 transition">
                    <td class="py-4 pr-4">
                        <div class="font-bold text-[14px] text-[#18221b]">${item.name}</div>
                        <div class="text-[11.5px] text-[#8c9188] mt-0.5">${item.size}</div>
                    </td>
                    <td class="py-4 px-4 font-semibold text-[#18221b]">${formatRupiah(item.price)}</td>
                    <td class="py-4 px-4 font-bold text-[14px] text-[#1e6f3d]">${stock}</td>
                    <td class="py-4 px-4 text-[#4a4f47]">${item.composition}</td>
                    <td class="py-4 px-4 font-medium text-[#b45309]">${item.allergen}</td>
                    <td class="py-4 pl-4 whitespace-nowrap">
                        <button type="button" onclick="editProductRow(${idx})" class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-3.5 py-2 rounded-lg transition cursor-pointer">
                            Edit
                        </button>
                        <button type="button" onclick="deleteProductRow(${idx})" class="bg-[#fdf0f0] hover:bg-[#fbdada] text-[#c53030] font-semibold text-xs px-3.5 py-2 rounded-lg transition cursor-pointer ml-1.5">
                            Hapus
                        </button>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = rows.join('');
        document.getElementById('summary-variant-count').textContent = activeVariants;
        document.getElementById('summary-bottle-count').textContent = totalBottles;
    }

    function openProductModal() {
        document.getElementById('modal-form-title').textContent = 'Tambah Produk & Data AI';
        document.getElementById('edit-row-index').value = '-1';
        document.getElementById('input-name').value = '';
        document.getElementById('input-size').value = '250 ml · Jamu botolan';
        document.getElementById('input-price').value = '15000';
        document.getElementById('input-stock').value = '10';
        document.getElementById('input-composition').value = '';
        document.getElementById('input-allergen').value = '';

        const modal = document.getElementById('product-ai-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function editProductRow(index) {
        const item = aiProducts[index];
        if (!item) return;

        document.getElementById('modal-form-title').textContent = 'Edit Produk & Data AI';
        document.getElementById('edit-row-index').value = String(index);
        document.getElementById('input-name').value = item.name;
        document.getElementById('input-size').value = item.size;
        document.getElementById('input-price').value = item.price;
        document.getElementById('input-stock').value = item.stock;
        document.getElementById('input-composition').value = item.composition;
        document.getElementById('input-allergen').value = item.allergen;

        const modal = document.getElementById('product-ai-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeProductModal() {
        const modal = document.getElementById('product-ai-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function saveProductRow(event) {
        event.preventDefault();
        const index = parseInt(document.getElementById('edit-row-index').value, 10);
        const item = {
            name: document.getElementById('input-name').value.trim(),
            size: document.getElementById('input-size').value.trim(),
            price: parseInt(document.getElementById('input-price').value, 10) || 15000,
            stock: parseInt(document.getElementById('input-stock').value, 10) || 0,
            composition: document.getElementById('input-composition').value.trim(),
            allergen: document.getElementById('input-allergen').value.trim(),
        };

        if (index >= 0 && index < aiProducts.length) {
            aiProducts[index] = item;
        } else {
            aiProducts.push(item);
        }

        closeProductModal();
        renderAiProducts();
    }

    function deleteProductRow(index) {
        aiProducts.splice(index, 1);
        renderAiProducts();
    }

    function resetDemoData() {
        aiProducts = JSON.parse(JSON.stringify(INITIAL_AI_PRODUCTS));
        renderAiProducts();
    }
</script>
@endpush
