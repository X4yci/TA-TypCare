@extends('layouts.admin')

@section('title', 'Pesanan & Tracking — TYP-Care Backoffice')
@section('breadcrumb', 'Pesanan & tracking')
@section('hide_footer', 'true')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-[25px] sm:text-[27px] font-bold text-[#18221b] tracking-tight leading-tight">Pesanan &amp; tracking</h2>
            <p class="text-[13.5px] text-[#6e736b] mt-1">Pantau pembayaran, alokasi batch, dan perjalanan pesanan pelanggan.</p>
        </div>

        <!-- Active Orders Badge -->
        <div class="bg-[#e8f1eb] border border-[#dce8e0] rounded-xl px-5 py-3.5 inline-flex items-baseline gap-3 self-start sm:self-center shrink-0">
            <span id="active-orders-count" class="text-[22px] font-bold text-[#1b4d2e] leading-none">4</span>
            <span class="text-xs font-medium text-[#4a6453]">pesanan aktif</span>
        </div>
    </div>

    <!-- Filter Bar Card -->
    <div class="mt-5 bg-white rounded-xl border border-[#e6e2d8] p-4 sm:px-5 sm:py-4 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
        <div class="flex items-center gap-2 flex-wrap">
            <button
                type="button"
                data-filter="all"
                data-label="Semua pesanan"
                onclick="filterOrders('all', 'Semua pesanan')"
                class="order-filter-btn bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-bold text-xs px-4 py-2.5 rounded-lg transition cursor-pointer"
            >
                Filter Semua
            </button>

            <button
                type="button"
                data-filter="Menunggu bayar"
                data-label="Menunggu bayar"
                onclick="filterOrders('Menunggu bayar', 'Menunggu bayar')"
                class="order-filter-btn bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-4 py-2.5 rounded-lg transition cursor-pointer"
            >
                Filter Menunggu bayar
            </button>

            <button
                type="button"
                data-filter="Sedang diracik"
                data-label="Diracik"
                onclick="filterOrders('Sedang diracik', 'Diracik')"
                class="order-filter-btn bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-4 py-2.5 rounded-lg transition cursor-pointer"
            >
                Filter Diracik
            </button>

            <button
                type="button"
                data-filter="Dikemas ice pack 4°C"
                data-label="Dikemas"
                onclick="filterOrders('Dikemas ice pack 4°C', 'Dikemas')"
                class="order-filter-btn bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-4 py-2.5 rounded-lg transition cursor-pointer"
            >
                Filter Dikemas
            </button>

            <button
                type="button"
                data-filter="Kurir menuju lokasi"
                data-label="Dikirim"
                onclick="filterOrders('Kurir menuju lokasi', 'Dikirim')"
                class="order-filter-btn bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-4 py-2.5 rounded-lg transition cursor-pointer"
            >
                Filter Dikirim
            </button>

            <button
                type="button"
                data-filter="Selesai"
                data-label="Selesai"
                onclick="filterOrders('Selesai', 'Selesai')"
                class="order-filter-btn bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-4 py-2.5 rounded-lg transition cursor-pointer"
            >
                Filter Selesai
            </button>

            <button
                type="button"
                data-filter="Dibatalkan"
                data-label="Dibatalkan"
                onclick="filterOrders('Dibatalkan', 'Dibatalkan')"
                class="order-filter-btn bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-4 py-2.5 rounded-lg transition cursor-pointer"
            >
                Filter Dibatalkan
            </button>
        </div>

        <div class="mt-3 flex items-center gap-2 text-xs">
            <span class="text-[#7a7f76]">Menampilkan:</span>
            <span id="active-filter-label" class="font-bold text-[#1e5631]">Semua pesanan</span>
        </div>
    </div>

    <!-- Orders Table Card -->
    <div class="mt-4 bg-white rounded-xl border border-[#e6e2d8] p-4 sm:p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#ebf3ed] text-[11.5px] font-medium text-[#526658]">
                        <th class="py-3 pl-4 pr-4 rounded-l-lg">Pesanan / pelanggan</th>
                        <th class="py-3 px-4">Total bayar</th>
                        <th class="py-3 px-4">Payment gateway</th>
                        <th class="py-3 px-4">Status pengiriman</th>
                        <th class="py-3 pl-4 pr-4 rounded-r-lg w-[160px]">Aksi</th>
                    </tr>
                </thead>
                <tbody id="orders-tbody" class="divide-y divide-[#ece8df] text-xs">
                    <!-- Row 1: TYP-261112-001 -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pl-4 pr-4">
                            <div class="font-bold text-[13px] text-[#18221b]">TYP-261112-001</div>
                            <div class="font-semibold text-[13px] text-[#18221b] mt-0.5">Nadia Putri</div>
                            <div class="text-[11.5px] text-[#8c9188] mt-1">Klojen, Kota Malang</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[13.5px] text-[#18221b]">Rp 150.000</div>
                            <div class="text-[11px] text-[#8c9188] mt-1">10 botol · 12 Nov 2026</div>
                        </td>
                        <td class="py-4 px-4">
                            <div>
                                <span class="font-bold text-[#1e6f3d]">Lunas</span>
                                <span class="text-[#5a6057]"> · QRIS</span>
                            </div>
                            <div class="text-[11px] text-[#8c9188] mt-1">Payment gateway terverifikasi</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[#b45309]">Sedang diracik</div>
                            <div class="text-[11px] text-[#7a7f76] mt-1">Alokasi batch FEFO tersedia</div>
                        </td>
                        <td class="py-4 pl-4 pr-4 whitespace-nowrap">
                            <button
                                type="button"
                                onclick="openOrderDetailModal(0)"
                                class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-5 py-2.5 rounded-lg transition cursor-pointer"
                            >
                                Detail pesanan
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2: TYP-261112-002 -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pl-4 pr-4">
                            <div class="font-bold text-[13px] text-[#18221b]">TYP-261112-002</div>
                            <div class="font-semibold text-[13px] text-[#18221b] mt-0.5">Bima Pratama</div>
                            <div class="text-[11.5px] text-[#8c9188] mt-1">Lowokwaru, Kota Malang</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[13.5px] text-[#18221b]">Rp 120.000</div>
                            <div class="text-[11px] text-[#8c9188] mt-1">8 botol · 12 Nov 2026</div>
                        </td>
                        <td class="py-4 px-4">
                            <div>
                                <span class="font-bold text-[#1e6f3d]">Lunas</span>
                                <span class="text-[#5a6057]"> · BCA VA</span>
                            </div>
                            <div class="text-[11px] text-[#8c9188] mt-1">Payment gateway terverifikasi</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[#b45309]">Dikemas ice pack 4&deg;C</div>
                            <div class="text-[11px] text-[#7a7f76] mt-1">Alokasi batch FEFO tersedia</div>
                        </td>
                        <td class="py-4 pl-4 pr-4 whitespace-nowrap">
                            <button
                                type="button"
                                onclick="openOrderDetailModal(1)"
                                class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-5 py-2.5 rounded-lg transition cursor-pointer"
                            >
                                Detail pesanan
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3: TYP-261111-003 -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pl-4 pr-4">
                            <div class="font-bold text-[13px] text-[#18221b]">TYP-261111-003</div>
                            <div class="font-semibold text-[13px] text-[#18221b] mt-0.5">Sinta Maharani</div>
                            <div class="text-[11.5px] text-[#8c9188] mt-1">Blimbing, Kota Malang</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[13.5px] text-[#18221b]">Rp 135.000</div>
                            <div class="text-[11px] text-[#8c9188] mt-1">9 botol · 11 Nov 2026</div>
                        </td>
                        <td class="py-4 px-4">
                            <div>
                                <span class="font-bold text-[#1e6f3d]">Lunas</span>
                                <span class="text-[#5a6057]"> · QRIS</span>
                            </div>
                            <div class="text-[11px] text-[#8c9188] mt-1">Payment gateway terverifikasi</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[#b45309]">Kurir menuju lokasi</div>
                            <div class="text-[11px] text-[#7a7f76] mt-1">Alokasi batch FEFO tersedia</div>
                        </td>
                        <td class="py-4 pl-4 pr-4 whitespace-nowrap">
                            <button
                                type="button"
                                onclick="openOrderDetailModal(2)"
                                class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-5 py-2.5 rounded-lg transition cursor-pointer"
                            >
                                Detail pesanan
                            </button>
                        </td>
                    </tr>

                    <!-- Row 4: TYP-261111-004 -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pl-4 pr-4">
                            <div class="font-bold text-[13px] text-[#18221b]">TYP-261111-004</div>
                            <div class="font-semibold text-[13px] text-[#18221b] mt-0.5">Fajar Ramadhan</div>
                            <div class="text-[11.5px] text-[#8c9188] mt-1">Sukun, Kota Malang</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[13.5px] text-[#18221b]">Rp 90.000</div>
                            <div class="text-[11px] text-[#8c9188] mt-1">6 botol · 11 Nov 2026</div>
                        </td>
                        <td class="py-4 px-4">
                            <div>
                                <span class="font-bold text-[#1e6f3d]">Lunas</span>
                                <span class="text-[#5a6057]"> · BCA VA</span>
                            </div>
                            <div class="text-[11px] text-[#8c9188] mt-1">Payment gateway terverifikasi</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[#b45309]">Sedang diracik</div>
                            <div class="text-[11px] text-[#7a7f76] mt-1">Alokasi batch FEFO tersedia</div>
                        </td>
                        <td class="py-4 pl-4 pr-4 whitespace-nowrap">
                            <button
                                type="button"
                                onclick="openOrderDetailModal(3)"
                                class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-5 py-2.5 rounded-lg transition cursor-pointer"
                            >
                                Detail pesanan
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bottom Footnote -->
    <p class="mt-4 px-1 text-xs text-[#7a7f76]">
        Pembatalan sebelum selesai akan mengembalikan stok ke kode batch asal. Refund ditangani terpisah.
    </p>

    <!-- Modal Detail Pesanan & Update Status Pengiriman -->
    <div id="order-detail-modal" class="fixed inset-0 z-50 bg-black/50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-[#e6e2d8] w-full max-w-md p-6 shadow-xl text-xs">
            <div class="flex items-center justify-between pb-3 border-b border-[#ece8df]">
                <div>
                    <h3 id="detail-order-code" class="text-base font-bold text-[#18221b]">TYP-261112-001</h3>
                    <p id="detail-order-customer" class="text-xs text-[#7a7f76] mt-0.5">Nadia Putri · Klojen, Kota Malang</p>
                </div>
                <button type="button" onclick="closeOrderDetailModal()" class="text-[#7a7f76] hover:text-[#18221b] text-lg leading-none cursor-pointer">&times;</button>
            </div>

            <div class="mt-4 space-y-3">
                <div class="bg-[#faf9f5] border border-[#ece8df] rounded-xl p-3.5 space-y-1.5">
                    <div class="flex justify-between">
                        <span class="text-[#7a7f76]">Total Pembayaran</span>
                        <span id="detail-order-total" class="font-bold text-[#18221b]">Rp 150.000 (10 botol)</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#7a7f76]">Metode &amp; Status</span>
                        <span id="detail-order-payment" class="font-semibold text-[#1e6f3d]">Lunas · QRIS</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#7a7f76]">Batch Terpotong (FEFO)</span>
                        <span id="detail-order-batch" class="font-mono-code text-[11px] text-[#3b4039]">BATCH-BK-20261111-01</span>
                    </div>
                </div>

                <div>
                    <label for="detail-status-select" class="block font-semibold text-[#4a4f47] mb-1.5">Perbarui Status Pengiriman</label>
                    <select id="detail-status-select" class="w-full border border-[#dedad0] rounded-lg px-3 py-2.5 text-xs text-[#18221b] font-medium focus:outline-none focus:border-[#1f4b31]">
                        <option value="Menunggu bayar">Menunggu bayar</option>
                        <option value="Sedang diracik">Sedang diracik</option>
                        <option value="Dikemas ice pack 4°C">Dikemas ice pack 4&deg;C</option>
                        <option value="Kurir menuju lokasi">Kurir menuju lokasi</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>
            </div>

            <div class="mt-5 pt-3 border-t border-[#ece8df] flex items-center justify-end gap-2">
                <button type="button" onclick="closeOrderDetailModal()" class="px-4 py-2 rounded-lg border border-[#dedad0] text-[#4a4f47] font-semibold hover:bg-[#faf9f5] cursor-pointer">
                    Tutup
                </button>
                <button type="button" onclick="saveOrderStatus()" class="px-4 py-2 rounded-lg bg-[#1e5631] hover:bg-[#174226] text-white font-semibold cursor-pointer">
                    Simpan Status
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const MONTHS_SHORT_ID = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    function addDays(base, days) {
        const d = new Date(base.getFullYear(), base.getMonth(), base.getDate());
        d.setDate(d.getDate() + days);
        return d;
    }

    function formatDateMed(d) {
        return `${String(d.getDate()).padStart(2, '0')} ${MONTHS_SHORT_ID[d.getMonth()]} ${d.getFullYear()}`;
    }

    function formatYmdShort(d) {
        return `${String(d.getFullYear()).slice(-2)}${String(d.getMonth() + 1).padStart(2, '0')}${String(d.getDate()).padStart(2, '0')}`;
    }

    function formatYmdFull(d) {
        return `${d.getFullYear()}${String(d.getMonth() + 1).padStart(2, '0')}${String(d.getDate()).padStart(2, '0')}`;
    }

    function buildRealtimeOrders() {
        const today = new Date();
        const yesterday = addDays(today, -1);

        return [
            {
                code: `TYP-${formatYmdShort(today)}-001`,
                customer: 'Nadia Putri',
                area: 'Klojen, Kota Malang',
                totalFormatted: 'Rp 150.000',
                qtyDate: `10 botol · ${formatDateMed(today)}`,
                paymentStatus: 'Lunas',
                paymentMethod: 'QRIS',
                paymentNote: 'Payment gateway terverifikasi',
                shippingStatus: 'Sedang diracik',
                shippingNote: 'Alokasi batch FEFO tersedia',
                batchCode: `BATCH-BK-${formatYmdFull(yesterday)}-01`
            },
            {
                code: `TYP-${formatYmdShort(today)}-002`,
                customer: 'Bima Pratama',
                area: 'Lowokwaru, Kota Malang',
                totalFormatted: 'Rp 120.000',
                qtyDate: `8 botol · ${formatDateMed(today)}`,
                paymentStatus: 'Lunas',
                paymentMethod: 'BCA VA',
                paymentNote: 'Payment gateway terverifikasi',
                shippingStatus: 'Dikemas ice pack 4°C',
                shippingNote: 'Alokasi batch FEFO tersedia',
                batchCode: `BATCH-KA-${formatYmdFull(today)}-02`
            },
            {
                code: `TYP-${formatYmdShort(yesterday)}-003`,
                customer: 'Sinta Maharani',
                area: 'Blimbing, Kota Malang',
                totalFormatted: 'Rp 135.000',
                qtyDate: `9 botol · ${formatDateMed(yesterday)}`,
                paymentStatus: 'Lunas',
                paymentMethod: 'QRIS',
                paymentNote: 'Payment gateway terverifikasi',
                shippingStatus: 'Kurir menuju lokasi',
                shippingNote: 'Alokasi batch FEFO tersedia',
                batchCode: `BATCH-KA-${formatYmdFull(today)}-02`
            },
            {
                code: `TYP-${formatYmdShort(yesterday)}-004`,
                customer: 'Fajar Ramadhan',
                area: 'Sukun, Kota Malang',
                totalFormatted: 'Rp 90.000',
                qtyDate: `6 botol · ${formatDateMed(yesterday)}`,
                paymentStatus: 'Lunas',
                paymentMethod: 'BCA VA',
                paymentNote: 'Payment gateway terverifikasi',
                shippingStatus: 'Sedang diracik',
                shippingNote: 'Alokasi batch FEFO tersedia',
                batchCode: `BATCH-JM-${formatYmdFull(today)}-01`
            }
        ];
    }

    let ordersData = buildRealtimeOrders();
    let currentOrderFilter = 'all';
    let selectedOrderIndex = -1;

    document.addEventListener('DOMContentLoaded', function () {
        renderOrdersTable();
    });

    function toggleMobileSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    }

    function filterOrders(filterValue, labelText) {
        currentOrderFilter = filterValue;
        document.getElementById('active-filter-label').textContent = labelText;

        const buttons = document.querySelectorAll('.order-filter-btn');
        buttons.forEach(btn => {
            if (btn.getAttribute('data-filter') === filterValue) {
                btn.className = 'order-filter-btn bg-[#dce8df] text-[#164225] font-bold text-xs px-4 py-2.5 rounded-lg transition cursor-pointer';
            } else {
                btn.className = 'order-filter-btn bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-4 py-2.5 rounded-lg transition cursor-pointer';
            }
        });

        renderOrdersTable();
    }

    function renderOrdersTable() {
        const tbody = document.getElementById('orders-tbody');
        const activeCount = ordersData.filter(o => o.shippingStatus !== 'Selesai' && o.shippingStatus !== 'Dibatalkan').length;
        document.getElementById('active-orders-count').textContent = activeCount;

        const rows = [];
        ordersData.forEach((order, idx) => {
            if (currentOrderFilter !== 'all' && order.shippingStatus !== currentOrderFilter) {
                return;
            }

            let statusColor = 'text-[#b45309]';
            if (order.shippingStatus === 'Selesai') statusColor = 'text-[#1e6f3d]';
            else if (order.shippingStatus === 'Dibatalkan') statusColor = 'text-[#c53030]';

            rows.push(`
                <tr class="hover:bg-[#faf9f5]/60 transition">
                    <td class="py-4 pl-4 pr-4">
                        <div class="font-bold text-[13px] text-[#18221b]">${order.code}</div>
                        <div class="font-semibold text-[13px] text-[#18221b] mt-0.5">${order.customer}</div>
                        <div class="text-[11.5px] text-[#8c9188] mt-1">${order.area}</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="font-bold text-[13.5px] text-[#18221b]">${order.totalFormatted}</div>
                        <div class="text-[11px] text-[#8c9188] mt-1">${order.qtyDate}</div>
                    </td>
                    <td class="py-4 px-4">
                        <div>
                            <span class="font-bold text-[#1e6f3d]">${order.paymentStatus}</span>
                            <span class="text-[#5a6057]"> · ${order.paymentMethod}</span>
                        </div>
                        <div class="text-[11px] text-[#8c9188] mt-1">${order.paymentNote}</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="font-bold ${statusColor}">${order.shippingStatus}</div>
                        <div class="text-[11px] text-[#7a7f76] mt-1">${order.shippingNote}</div>
                    </td>
                    <td class="py-4 pl-4 pr-4 whitespace-nowrap">
                        <button
                            type="button"
                            onclick="openOrderDetailModal(${idx})"
                            class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-5 py-2.5 rounded-lg transition cursor-pointer"
                        >
                            Detail pesanan
                        </button>
                    </td>
                </tr>
            `);
        });

        tbody.innerHTML = rows.length
            ? rows.join('')
            : `<tr><td colspan="5" class="py-8 text-center text-xs text-[#8c9188]">Tidak ada pesanan pada filter ini.</td></tr>`;
    }

    function openOrderDetailModal(index) {
        const order = ordersData[index];
        if (!order) return;
        selectedOrderIndex = index;

        document.getElementById('detail-order-code').textContent = order.code;
        document.getElementById('detail-order-customer').textContent = `${order.customer} · ${order.area}`;
        document.getElementById('detail-order-total').textContent = `${order.totalFormatted} (${order.qtyDate})`;
        document.getElementById('detail-order-payment').textContent = `${order.paymentStatus} · ${order.paymentMethod}`;
        document.getElementById('detail-order-batch').textContent = order.batchCode;
        document.getElementById('detail-status-select').value = order.shippingStatus;

        const modal = document.getElementById('order-detail-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeOrderDetailModal() {
        const modal = document.getElementById('order-detail-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function saveOrderStatus() {
        if (selectedOrderIndex < 0 || !ordersData[selectedOrderIndex]) return;
        const newStatus = document.getElementById('detail-status-select').value;
        ordersData[selectedOrderIndex].shippingStatus = newStatus;

        if (newStatus === 'Dibatalkan') {
            ordersData[selectedOrderIndex].shippingNote = 'Stok dikembalikan ke batch asal';
        } else {
            ordersData[selectedOrderIndex].shippingNote = 'Alokasi batch FEFO tersedia';
        }

        closeOrderDetailModal();
        renderOrdersTable();
    }

    function resetDemoData() {
        ordersData = buildRealtimeOrders();
        filterOrders('all', 'Semua pesanan');
    }
</script>
@endpush
