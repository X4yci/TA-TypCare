@extends('layouts.admin')

@section('title', 'Laporan Penjualan — TYP-Care Backoffice')
@section('breadcrumb', 'Laporan penjualan')
@section('hide_footer', 'true')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-[25px] sm:text-[27px] font-bold text-[#18221b] tracking-tight leading-tight">Laporan penjualan</h2>
            <p class="text-[13.5px] text-[#6e736b] mt-1">Rekap transaksi lunas dan selesai, lengkap dengan penelusuran batch.</p>
        </div>

        <div>
            <button
                type="button"
                onclick="openPdfPreviewModal()"
                class="bg-[#d86b43] hover:bg-[#c35b35] text-white font-semibold text-[13px] px-6 py-2.5 rounded-lg inline-flex items-center justify-center shadow-2xs transition cursor-pointer"
            >
                Pratinjau laporan PDF
            </button>
        </div>
    </div>

    <!-- Periode Penjualan Filter Card -->
    <div class="mt-5 bg-white rounded-xl border border-[#e6e2d8] p-4 sm:px-5 sm:py-4 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
        <p class="text-[10.5px] font-semibold uppercase tracking-[0.06em] text-[#7a7f76]">PERIODE PENJUALAN</p>

        <div class="mt-2.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-4 flex-wrap">
                <button
                    type="button"
                    onclick="cyclePeriodPreset()"
                    class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-5 py-2.5 rounded-lg transition cursor-pointer"
                >
                    Pilih periode laporan
                </button>
                <span id="report-period-label" class="text-[13.5px] font-bold text-[#18221b]">01 &ndash; 12 November 2026</span>
            </div>

            <button
                type="button"
                onclick="applyPeriodFilter()"
                class="bg-[#eef3ef] hover:bg-[#dfe9e1] text-[#1e5631] font-semibold text-xs px-5 py-2.5 rounded-lg transition cursor-pointer self-start sm:self-center"
            >
                Terapkan filter
            </button>
        </div>
    </div>

    <!-- 3 KPI Summary Cards -->
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Card 1: Transaksi lunas / selesai -->
        <div class="bg-white rounded-xl border border-[#e6e2d8] p-4 sm:p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
            <span class="text-xs font-medium text-[#6e736b]">Transaksi lunas / selesai</span>
            <p id="report-kpi-tx" class="text-[25px] font-bold text-[#18221b] tracking-tight mt-1.5 leading-snug">4</p>
        </div>

        <!-- Card 2: Botol terjual (lunas) -->
        <div class="bg-white rounded-xl border border-[#e6e2d8] p-4 sm:p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
            <span class="text-xs font-medium text-[#6e736b]">Botol terjual (lunas)</span>
            <p id="report-kpi-bottles" class="text-[25px] font-bold text-[#18221b] tracking-tight mt-1.5 leading-snug">33</p>
        </div>

        <!-- Card 3: Pendapatan penjualan -->
        <div class="bg-white rounded-xl border border-[#e6e2d8] p-4 sm:p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
            <span class="text-xs font-medium text-[#6e736b]">Pendapatan penjualan</span>
            <p id="report-kpi-revenue" class="text-[25px] font-bold text-[#1f5633] tracking-tight mt-1.5 leading-snug">Rp 495.000</p>
        </div>
    </div>

    <!-- Main Sales Report Table Card -->
    <div class="mt-4 bg-white rounded-xl border border-[#e6e2d8] p-4 sm:p-5 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#ebf3ed] text-[11.5px] font-medium text-[#526658]">
                        <th class="py-3 pl-4 pr-4 rounded-l-lg">ID pesanan</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Pelanggan / produk &amp; batch FEFO</th>
                        <th class="py-3 px-4">Metode</th>
                        <th class="py-3 pl-4 pr-4 rounded-r-lg">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="reports-tbody" class="divide-y divide-[#ece8df] text-xs">
                    <!-- Row 1: TYP-261112-001 -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pl-4 pr-4">
                            <div class="font-bold text-[12.5px] text-[#18221b]">TYP-261112-001</div>
                            <div class="text-[11px] text-[#8c9188] mt-1">Sedang diracik</div>
                        </td>
                        <td class="py-4 px-4 text-[#5a6057]">12 Nov 2026</td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[13px] text-[#18221b]">Nadia Putri</div>
                            <div class="font-mono-code text-[11px] text-[#8c9188] mt-1">KA-20261112-02 · 8 / BK-20261111-01 · 2</div>
                        </td>
                        <td class="py-4 px-4 text-[#5a6057]">QRIS</td>
                        <td class="py-4 pl-4 pr-4 font-bold text-[13px] text-[#18221b]">Rp 150.000</td>
                    </tr>

                    <!-- Row 2: TYP-261112-002 -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pl-4 pr-4">
                            <div class="font-bold text-[12.5px] text-[#18221b]">TYP-261112-002</div>
                            <div class="text-[11px] text-[#8c9188] mt-1">Dikemas ice pack 4&deg;C</div>
                        </td>
                        <td class="py-4 px-4 text-[#5a6057]">12 Nov 2026</td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[13px] text-[#18221b]">Bima Pratama</div>
                            <div class="font-mono-code text-[11px] text-[#8c9188] mt-1">BK-20261111-01 · 8</div>
                        </td>
                        <td class="py-4 px-4 text-[#5a6057]">BCA VA</td>
                        <td class="py-4 pl-4 pr-4 font-bold text-[13px] text-[#18221b]">Rp 120.000</td>
                    </tr>

                    <!-- Row 3: TYP-261111-003 -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pl-4 pr-4">
                            <div class="font-bold text-[12.5px] text-[#18221b]">TYP-261111-003</div>
                            <div class="text-[11px] text-[#8c9188] mt-1">Kurir menuju lokasi</div>
                        </td>
                        <td class="py-4 px-4 text-[#5a6057]">11 Nov 2026</td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[13px] text-[#18221b]">Sinta Maharani</div>
                            <div class="font-mono-code text-[11px] text-[#8c9188] mt-1">JM-20261112-01 · 9</div>
                        </td>
                        <td class="py-4 px-4 text-[#5a6057]">QRIS</td>
                        <td class="py-4 pl-4 pr-4 font-bold text-[13px] text-[#18221b]">Rp 135.000</td>
                    </tr>

                    <!-- Row 4: TYP-261111-004 -->
                    <tr class="hover:bg-[#faf9f5]/60 transition">
                        <td class="py-4 pl-4 pr-4">
                            <div class="font-bold text-[12.5px] text-[#18221b]">TYP-261111-004</div>
                            <div class="text-[11px] text-[#8c9188] mt-1">Sedang diracik</div>
                        </td>
                        <td class="py-4 px-4 text-[#5a6057]">11 Nov 2026</td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-[13px] text-[#18221b]">Fajar Ramadhan</div>
                            <div class="font-mono-code text-[11px] text-[#8c9188] mt-1">KA-20261112-02 · 6</div>
                        </td>
                        <td class="py-4 px-4 text-[#5a6057]">BCA VA</td>
                        <td class="py-4 pl-4 pr-4 font-bold text-[13px] text-[#18221b]">Rp 90.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table Card Bottom Footnote -->
        <div class="pt-4 mt-2 border-t border-[#ece8df] text-[11.5px] text-[#7a7f76]">
            Transaksi dibatalkan tidak dihitung. Nilai penjualan lunas bukan laba setelah biaya operasional.
        </div>
    </div>

    <!-- Bottom Page Credit -->
    <p class="mt-5 px-1 text-xs text-[#7a7f76]">
        TYP HERBAL DRINK · Disiapkan oleh Rinaldi Mulya Putra
    </p>

    <!-- Modal Pratinjau Laporan PDF -->
    <div id="pdf-preview-modal" class="fixed inset-0 z-50 bg-black/50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-[#e6e2d8] w-full max-w-lg p-6 shadow-xl text-xs">
            <div class="flex items-center justify-between pb-3 border-b border-[#ece8df]">
                <div>
                    <h3 class="text-base font-bold text-[#18221b]">Pratinjau Laporan Penjualan PDF</h3>
                    <p id="pdf-period-subtitle" class="text-xs text-[#7a7f76] mt-0.5">Periode: 01 – 12 November 2026</p>
                </div>
                <button type="button" onclick="closePdfPreviewModal()" class="text-[#7a7f76] hover:text-[#18221b] text-lg leading-none cursor-pointer">&times;</button>
            </div>

            <div class="mt-4 bg-[#faf9f5] border border-[#ece8df] rounded-xl p-4 space-y-2">
                <div class="flex justify-between">
                    <span class="text-[#7a7f76]">Unit Usaha</span>
                    <span class="font-bold text-[#18221b]">UMKM TYP HERBAL DRINK</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#7a7f76]">Disiapkan Oleh</span>
                    <span class="font-semibold text-[#18221b]">Rinaldi Mulya Putra</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#7a7f76]">Transaksi Lunas / Selesai</span>
                    <span id="pdf-tx-count" class="font-bold text-[#18221b]">4 Transaksi</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#7a7f76]">Total Botol Terjual</span>
                    <span id="pdf-bottle-count" class="font-bold text-[#18221b]">33 Botol</span>
                </div>
                <div class="flex justify-between pt-2 border-t border-[#e6e2d8]">
                    <span class="font-semibold text-[#18221b]">Total Pendapatan Lunas</span>
                    <span id="pdf-revenue-total" class="font-bold text-sm text-[#1f5633]">Rp 495.000</span>
                </div>
            </div>

            <div class="mt-5 flex items-center justify-end gap-2">
                <button type="button" onclick="closePdfPreviewModal()" class="px-4 py-2 rounded-lg border border-[#dedad0] text-[#4a4f47] font-semibold hover:bg-[#faf9f5] cursor-pointer">
                    Tutup
                </button>
                <button type="button" onclick="window.print()" class="px-4 py-2 rounded-lg bg-[#d86b43] hover:bg-[#c35b35] text-white font-semibold cursor-pointer">
                    Cetak / Simpan PDF
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const MONTHS_SHORT_ID = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const MONTHS_LONG_ID = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    function addDays(base, days) {
        const d = new Date(base.getFullYear(), base.getMonth(), base.getDate());
        d.setDate(d.getDate() + days);
        return d;
    }

    function formatDateMed(d) {
        return `${String(d.getDate()).padStart(2, '0')} ${MONTHS_SHORT_ID[d.getMonth()]} ${d.getFullYear()}`;
    }

    function formatDateLong(d) {
        return `${String(d.getDate()).padStart(2, '0')} ${MONTHS_LONG_ID[d.getMonth()]} ${d.getFullYear()}`;
    }

    function formatYmdShort(d) {
        return `${String(d.getFullYear()).slice(-2)}${String(d.getMonth() + 1).padStart(2, '0')}${String(d.getDate()).padStart(2, '0')}`;
    }

    function formatYmdFull(d) {
        return `${d.getFullYear()}${String(d.getMonth() + 1).padStart(2, '0')}${String(d.getDate()).padStart(2, '0')}`;
    }

    const TODAY_REALTIME = new Date();
    const YESTERDAY_REALTIME = addDays(TODAY_REALTIME, -1);

    const INITIAL_REPORT_ROWS = [
        {
            id: `TYP-${formatYmdShort(TODAY_REALTIME)}-001`,
            status: 'Sedang diracik',
            date: formatDateMed(TODAY_REALTIME),
            customer: 'Nadia Putri',
            batchDetail: `KA-${formatYmdFull(TODAY_REALTIME)}-02 · 8 / BK-${formatYmdFull(YESTERDAY_REALTIME)}-01 · 2`,
            bottles: 10,
            method: 'QRIS',
            subtotal: 150000
        },
        {
            id: `TYP-${formatYmdShort(TODAY_REALTIME)}-002`,
            status: 'Dikemas ice pack 4°C',
            date: formatDateMed(TODAY_REALTIME),
            customer: 'Bima Pratama',
            batchDetail: `BK-${formatYmdFull(YESTERDAY_REALTIME)}-01 · 8`,
            bottles: 8,
            method: 'BCA VA',
            subtotal: 120000
        },
        {
            id: `TYP-${formatYmdShort(YESTERDAY_REALTIME)}-003`,
            status: 'Kurir menuju lokasi',
            date: formatDateMed(YESTERDAY_REALTIME),
            customer: 'Sinta Maharani',
            batchDetail: `JM-${formatYmdFull(TODAY_REALTIME)}-01 · 9`,
            bottles: 9,
            method: 'QRIS',
            subtotal: 135000
        },
        {
            id: `TYP-${formatYmdShort(YESTERDAY_REALTIME)}-004`,
            status: 'Sedang diracik',
            date: formatDateMed(YESTERDAY_REALTIME),
            customer: 'Fajar Ramadhan',
            batchDetail: `KA-${formatYmdFull(TODAY_REALTIME)}-02 · 6`,
            bottles: 6,
            method: 'BCA VA',
            subtotal: 90000
        }
    ];

    const PERIOD_PRESETS = [
        {
            label: `01 – ${String(TODAY_REALTIME.getDate()).padStart(2, '0')} ${MONTHS_LONG_ID[TODAY_REALTIME.getMonth()]} ${TODAY_REALTIME.getFullYear()}`,
            filterDate: null
        },
        {
            label: `${formatDateLong(TODAY_REALTIME)} (Hari Ini)`,
            filterDate: formatDateMed(TODAY_REALTIME)
        },
        {
            label: `${formatDateLong(YESTERDAY_REALTIME)} (Kemarin)`,
            filterDate: formatDateMed(YESTERDAY_REALTIME)
        }
    ];

    let currentPresetIndex = 0;

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('report-period-label').textContent = PERIOD_PRESETS[0].label;
        applyPeriodFilter();
    });

    function toggleMobileSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    }

    function formatRupiah(num) {
        return 'Rp ' + Number(num).toLocaleString('id-ID');
    }

    function cyclePeriodPreset() {
        currentPresetIndex = (currentPresetIndex + 1) % PERIOD_PRESETS.length;
        document.getElementById('report-period-label').textContent = PERIOD_PRESETS[currentPresetIndex].label;
    }

    function applyPeriodFilter() {
        const preset = PERIOD_PRESETS[currentPresetIndex];
        const filtered = preset.filterDate
            ? INITIAL_REPORT_ROWS.filter(r => r.date === preset.filterDate)
            : INITIAL_REPORT_ROWS;

        let totalBottles = 0;
        let totalRevenue = 0;

        const rowsHtml = filtered.map(row => {
            totalBottles += row.bottles;
            totalRevenue += row.subtotal;

            return `
                <tr class="hover:bg-[#faf9f5]/60 transition">
                    <td class="py-4 pl-4 pr-4">
                        <div class="font-bold text-[12.5px] text-[#18221b]">${row.id}</div>
                        <div class="text-[11px] text-[#8c9188] mt-1">${row.status}</div>
                    </td>
                    <td class="py-4 px-4 text-[#5a6057]">${row.date}</td>
                    <td class="py-4 px-4">
                        <div class="font-bold text-[13px] text-[#18221b]">${row.customer}</div>
                        <div class="font-mono-code text-[11px] text-[#8c9188] mt-1">${row.batchDetail}</div>
                    </td>
                    <td class="py-4 px-4 text-[#5a6057]">${row.method}</td>
                    <td class="py-4 pl-4 pr-4 font-bold text-[13px] text-[#18221b]">${formatRupiah(row.subtotal)}</td>
                </tr>
            `;
        });

        document.getElementById('reports-tbody').innerHTML = rowsHtml.join('');
        document.getElementById('report-kpi-tx').textContent = filtered.length;
        document.getElementById('report-kpi-bottles').textContent = totalBottles;
        document.getElementById('report-kpi-revenue').textContent = formatRupiah(totalRevenue);

        document.getElementById('pdf-period-subtitle').textContent = `Periode: ${preset.label}`;
        document.getElementById('pdf-tx-count').textContent = `${filtered.length} Transaksi`;
        document.getElementById('pdf-bottle-count').textContent = `${totalBottles} Botol`;
        document.getElementById('pdf-revenue-total').textContent = formatRupiah(totalRevenue);
    }

    function openPdfPreviewModal() {
        const modal = document.getElementById('pdf-preview-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closePdfPreviewModal() {
        const modal = document.getElementById('pdf-preview-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function resetDemoData() {
        currentPresetIndex = 0;
        document.getElementById('report-period-label').textContent = PERIOD_PRESETS[0].label;
        applyPeriodFilter();
    }
</script>
@endpush
