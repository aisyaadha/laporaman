<!-- VIEW: LOGIN & AKSES TIKET PELAPOR -->
<section id="view-login-pelapor" class="hidden space-y-6 max-w-xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        <div class="border-b border-slate-200 pb-4">
            <span class="px-2.5 py-1 rounded bg-blue-100 text-brand-blue text-xs font-bold">PORTAL PELAPOR</span>
            <h2 class="text-2xl font-extrabold text-brand-dark tracking-tight mt-2">Lacak Status Tiket Laporan</h2>
            <p class="text-xs text-slate-600 mt-1">Akses riwayat pengaduan Anda menggunakan Kode Tiket dan Passcode rahasia.</p>
        </div>

        <div class="space-y-4">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-800">Kode Tiket Laporan</label>
                <input type="text" id="track-ticket-input" placeholder="Contoh: #LAPOR-1001-X" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue uppercase font-mono shadow-sm">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-800">Passcode Rahasia</label>
                <input type="password" id="track-pass-input" placeholder="Contoh: PASS-1234" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue font-mono shadow-sm">
            </div>

            <button onclick="executeTracking()" class="w-full py-3.5 rounded-xl bg-brand-blue hover:bg-blue-800 text-white font-bold text-sm transition shadow-md">
                Cek Perkembangan Tiket
            </button>
        </div>

        <!-- Result Box -->
        <div id="tracking-result-container" class="hidden pt-4 border-t border-slate-200 space-y-4">
            <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 space-y-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono font-bold text-slate-600" id="res-ticket-code">#LAPOR-1001-X</span>
                    <span id="res-status-badge" class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300">Pending</span>
                </div>
                <div class="space-y-1 text-xs">
                    <div class="text-slate-600">Kategori: <span class="font-bold text-slate-900" id="res-category">-</span></div>
                    <div class="text-slate-600">Lokasi: <span class="font-bold text-slate-900" id="res-location">-</span></div>
                    <div class="text-slate-600">Waktu Kejadian: <span class="font-bold text-slate-900" id="res-date">-</span></div>
                    <div class="text-slate-600">Kronologi: <span class="text-slate-800 block mt-1 bg-white p-2.5 rounded border border-slate-200" id="res-desc">-</span></div>
                </div>
                <div class="pt-3 border-t border-slate-200 space-y-2">
                    <div class="text-xs font-bold text-brand-dark uppercase tracking-wider">Catatan & Timeline Satgas</div>
                    <div id="res-timeline" class="text-xs text-slate-700 space-y-1 bg-white p-3 rounded-lg border border-slate-200 font-sans">
                        <!-- Dynamic logs -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>