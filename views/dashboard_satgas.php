<!-- VIEW: DASHBOARD SATGAS / MANAJEMEN LAPORAN -->
<section id="view-dashboard-satgas" class="hidden space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200 pb-4">
            <div>
                <div class="flex items-center space-x-2">
                    <span class="px-2.5 py-1 rounded bg-brand-emerald text-white text-xs font-bold">TERAUTENTIKASI (ADMIN)</span>
                    <span class="text-xs font-semibold text-slate-500">Satgas PPKS & Keamanan Kampus</span>
                </div>
                <h2 class="text-2xl font-extrabold text-brand-dark tracking-tight mt-1">Dashboard Manajemen & Penanganan Laporan</h2>
            </div>
            <div class="flex items-center space-x-3">
                <span class="px-3 py-1.5 rounded-lg bg-brand-blue text-white text-xs font-bold">Total Laporan: <span id="satgas-count">0</span></span>
                <button onclick="switchView('beranda')" class="px-3 py-1.5 rounded-lg bg-brand-red text-white text-xs font-bold hover:bg-red-700 transition">Logout</button>
            </div>
        </div>

        <!-- Responsive Table -->
        <div class="overflow-x-auto border border-slate-200 rounded-xl bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-100 text-slate-700 font-bold text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3">Tiket</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Waktu Kejadian</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Tindakan Petugas</th>
                    </tr>
                </thead>
                <tbody id="satgas-table-body" class="divide-y divide-slate-200 text-slate-800">
                    <!-- Populated via Javascript -->
                </tbody>
            </table>
        </div>
    </div>
</section>