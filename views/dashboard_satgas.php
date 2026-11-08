<!-- VIEW: DASHBOARD SATGAS / MANAJEMEN LAPORAN (ROLE-AWARE) -->
<section id="view-dashboard-satgas" class="hidden space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200 pb-4">
            <div>
                <div class="flex items-center flex-wrap gap-2">
                    <span class="px-2.5 py-1 rounded bg-brand-emerald text-white text-xs font-bold">TERAUTENTIKASI</span>
                    <span id="satgas-role-badge" class="px-2.5 py-1 rounded bg-amber-100 text-brand-yellow text-xs font-extrabold">VALIDATOR</span>
                    <span class="text-xs font-semibold text-slate-500">Satgas PPKS &amp; Keamanan Kampus</span>
                </div>
                <h2 class="text-2xl font-extrabold text-brand-dark tracking-tight mt-1">
                    Dashboard <span id="satgas-role-title">Validator</span> - Manajemen Laporan
                </h2>
                <p id="satgas-role-subtitle" class="text-xs text-slate-500 mt-1">Tinjau kronologi laporan, perbarui status, &amp; validasi keabsahan sebelum diteruskan ke tim investigasi.</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="px-3 py-1.5 rounded-lg bg-brand-blue text-white text-xs font-bold">Total Laporan: <span id="satgas-count">0</span></span>
                <button onclick="handleSatgasLogout()" class="px-3 py-1.5 rounded-lg bg-brand-red text-white text-xs font-bold hover:bg-red-700 transition">Logout</button>
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
                        <th class="px-4 py-3">Validasi</th>
                        <th class="px-4 py-3 text-right">Tindakan Petugas</th>
                    </tr>
                </thead>
                <tbody id="satgas-table-body" class="divide-y divide-slate-200 text-slate-800">
                    <!-- Populated via Javascript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- ===== SECTION: KRONOLOGI LAPORAN (Validator & Investigasi) ===== -->
    <div id="satgas-kronologi-section" class="hidden bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 space-y-5 shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-200 pb-3">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-lg font-bold text-slate-900">Kronologi &amp; Timeline Penanganan</h3>
            </div>
            <button onclick="closeKronologiSection()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <!-- Kolom Kiri: Info Laporan -->
            <div class="lg:col-span-1 space-y-3">
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                    <p class="text-xs text-slate-500 mb-1">Kode Tiket</p>
                    <p id="kronologi-ticket" class="font-mono font-bold text-brand-blue">-</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                    <p class="text-xs text-slate-500 mb-1">Kategori</p>
                    <p id="kronologi-category" class="text-sm font-semibold text-slate-800">-</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                    <p class="text-xs text-slate-500 mb-1">Lokasi Kejadian</p>
                    <p id="kronologi-location" class="text-sm font-semibold text-slate-800">-</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                    <p class="text-xs text-slate-500 mb-1">Waktu Kejadian</p>
                    <p id="kronogi-datetime" class="text-sm font-semibold text-slate-800">-</p>
                </div>
            </div>
            <!-- Kolom Kanan: Timeline -->
            <div class="lg:col-span-2 space-y-4">
                <div>
                    <p class="text-xs text-slate-500 mb-1">Deskripsi Kronologi Pelapor</p>
                    <p id="kronologi-description" class="text-sm text-slate-700 bg-slate-50 p-3 rounded-lg border border-slate-200 leading-relaxed">-</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Riwayat Timeline Satgas</p>
                    <div id="kronologi-timeline" class="space-y-3 bg-slate-50 p-4 rounded-lg border border-slate-200 max-h-72 overflow-y-auto">
                        <!-- populated via JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== SECTION: DETAIL INVESTIGASI (Hanya role Investigasi) ===== -->
    <div id="satgas-investigasi-section" class="hidden bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-200 pb-3">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-brand-emerald" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <h3 class="text-lg font-bold text-slate-900">Detail Laporan untuk Investigasi</h3>
            </div>
            <button onclick="closeInvestigasiSection()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Info Grid: Kronologi, Bukti, Waktu, Lokasi, Kategori -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                <p class="text-xs text-slate-500 mb-1"><i class="fas fa-tag"></i> Kategori</p>
                <p id="inv-category" class="text-sm font-semibold text-slate-800">-</p>
            </div>
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                <p class="text-xs text-slate-500 mb-1"><i class="fas fa-location-dot"></i> Lokasi Kejadian</p>
                <p id="inv-location" class="text-sm font-semibold text-slate-800">-</p>
            </div>
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                <p class="text-xs text-slate-500 mb-1"><i class="fas fa-calendar-alt"></i> Waktu Kejadian</p>
                <p id="inv-datetime" class="text-sm font-semibold text-slate-800">-</p>
            </div>
        </div>

        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
            <p class="text-xs text-slate-500 mb-1"><i class="fas fa-align-left"></i> Kronologi / Deskripsi Laporan</p>
            <p id="inv-description" class="text-sm text-slate-800 leading-relaxed">-</p>
        </div>

        <!-- Bukti Lampiran -->
        <div>
            <h4 class="text-sm font-bold text-slate-800 mb-3 flex items-center">
                <svg class="w-4 h-4 mr-2 text-brand-emerald" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                Bukti Lampiran (Foto / Video / Rekaman)
            </h4>
            <div id="inv-evidence-list" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                <!-- populated via JS -->
            </div>
        </div>

        <!-- Identitas Laporan (Terdekripsi) -->
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 space-y-2">
            <div class="flex items-center justify-between">
                <h4 class="text-sm font-bold text-emerald-900 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Identitas Pelapor (Terdekripsi)
                </h4>
                <span class="px-2 py-0.5 rounded bg-emerald-200 text-emerald-900 text-[10px] font-bold">PRIVATE KEY OK</span>
            </div>
            <p id="inv-identity" class="text-sm font-mono text-emerald-900 bg-white p-3 rounded-lg border border-emerald-200">-</p>
        </div>

        <!-- Catatan Investigasi -->
        <div>
            <h4 class="text-sm font-bold text-slate-800 mb-2">Catatan &amp; Tindak Lanjut Investigasi</h4>
            <div id="inv-timeline" class="space-y-2 bg-slate-50 p-3 rounded-lg border border-slate-200 max-h-60 overflow-y-auto">
                <!-- populated via JS -->
            </div>
            <textarea id="inv-note-input" rows="3" placeholder="Tuliskan catatan investigasi / kemajuan tindak lanjut..." class="mt-3 w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-brand-emerald"></textarea>
            <button onclick="addInvestigationNote()" class="mt-2 px-4 py-2 bg-brand-emerald text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition">Tambah Catatan Investigasi</button>
        </div>
    </div>
</section>
