<!-- VIEW: SUKSES KIRIM LAPORAN -->
<section id="view-success" class="hidden space-y-6 max-w-xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 text-center space-y-6 shadow-sm">
        <div class="w-16 h-16 bg-emerald-100 text-brand-emerald rounded-full flex items-center justify-center mx-auto border border-emerald-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="space-y-2">
            <h2 class="text-2xl font-bold text-slate-900">Laporan Berhasil Dibuat &amp; Disimpan</h2>
            <p class="text-xs text-slate-600">Simpan Kode Tiket dan Passcode rahasia berikut untuk melacak perkembangan investigasi kasus Anda.</p>
        </div>

        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 text-left space-y-3 shadow-inner">
            <div>
                <span class="text-xs text-slate-500 block font-medium">Kode Tiket Laporan Anda:</span>
                <span id="success-ticket" class="font-mono font-extrabold text-brand-blue text-xl">#LAPOR-XXXX-X</span>
            </div>
            <div>
                <span class="text-xs text-slate-500 block font-medium">Passcode Kunci Rahasia:</span>
                <span id="success-passcode" class="font-mono font-extrabold text-brand-emerald text-xl">PASS-XXXX</span>
            </div>
        </div>

        <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-amber-900 text-xs text-left font-medium">
            Catatan: Sistem tidak menyimpan sandi ini dalam teks biasa. Jika passcode hilang, Anda tidak dapat melacak status laporan kembali.
        </div>

        <!-- ===== Tombol Aksi: Lacak / Buat Baru / Unduh Kartu Tiket ===== -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
            <button onclick="switchView('login-pelapor')" class="py-3 bg-brand-blue hover:bg-blue-800 text-white rounded-xl text-xs font-bold transition flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span>Lacak Status</span>
            </button>
            <button onclick="switchView('buat')" class="py-3 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-xl text-xs font-bold transition flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                <span>Buat Laporan Lain</span>
            </button>
            <button onclick="downloadTicketCard()" class="py-3 bg-brand-emerald hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center justify-center space-x-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                <span>Unduh Kartu Tiket</span>
            </button>
        </div>

        <div class="text-xs text-slate-500 pt-1">
            <i class="fas fa-info-circle mr-1"></i>Kartu tiket dapat diunduh dalam format gambar PNG dan dicetak di desktop / HP Anda.
        </div>
    </div>
</section>

<!-- ===== KARTU TIKET (Tersembunyi - Dirender ke PNG saat diunduh) ===== -->
<div id="ticket-card-print-area" class="hidden">
    <div id="ticket-card-canvas" style="width: 400px; padding: 28px; background: linear-gradient(135deg, #1E3A8A 0%, #172554 100%); border-radius: 20px; color: #ffffff; font-family: 'Inter', sans-serif; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
        <!-- Header -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.15);">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 36px; height: 36px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FACC15" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div>
                    <div style="font-size: 14px; font-weight: 800; line-height: 1.1;">LaporAman Kampus</div>
                    <div style="font-size: 9px; color: #BFDBFE; margin-top: 1px;">Sistem Pelaporan Terenkripsi</div>
                </div>
            </div>
            <div style="font-size: 9px; color: #FDE68A; background: rgba(250,204,21,0.15); padding: 4px 8px; border-radius: 6px; font-weight: 700;">TIKET RESMI</div>
        </div>

        <!-- Body -->
        <div style="padding: 20px 0 16px;">
            <div style="font-size: 10px; color: #BFDBFE; margin-bottom: 4px;">KODE TIKET LAPORAN</div>
            <div id="card-ticket-code" style="font-size: 28px; font-weight: 800; font-family: 'Courier New', monospace; color: #FACC15; letter-spacing: 0.05em;">#LAPOR-XXXX-X</div>
        </div>
        <div style="padding-bottom: 16px; border-bottom: 1px dashed rgba(255,255,255,0.2);">
            <div style="font-size: 10px; color: #BFDBFE; margin-bottom: 4px;">PASSCODE RAHASIA</div>
            <div id="card-passcode" style="font-size: 18px; font-weight: 700; font-family: 'Courier New', monospace; color: #6EE7B7; letter-spacing: 0.05em;">PASS-XXXX</div>
        </div>

        <!-- Footer info -->
        <div style="padding-top: 16px; display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-size: 9px;">
            <div>
                <div style="color: #BFDBFE; margin-bottom: 2px;">Kategori</div>
                <div id="card-category" style="font-weight: 600;">-</div>
            </div>
            <div>
                <div style="color: #BFDBFE; margin-bottom: 2px;">Waktu Dibuat</div>
                <div id="card-created" style="font-weight: 600;">-</div>
            </div>
        </div>

        <div style="margin-top: 16px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.1); font-size: 8px; color: #93C5FD; text-align: center; line-height: 1.4;">
            Simpan kode tiket &amp; passcode ini secara aman untuk melacak perkembangan laporan Anda.<br>
            Jangan berikan passcode kepada pihak manapun selain petugas resmi Satgas.
        </div>
    </div>
</div>
