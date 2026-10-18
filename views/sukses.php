<!-- VIEW: SUKSES KIRIM LAPORAN -->
<section id="view-success" class="hidden space-y-6 max-w-xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 text-center space-y-6 shadow-sm">
        <div class="w-16 h-16 bg-emerald-100 text-brand-emerald rounded-full flex items-center justify-center mx-auto border border-emerald-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="space-y-2">
            <h2 class="text-2xl font-bold text-slate-900">Laporan Berhasil Dibuat & Disimpan</h2>
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

        <div class="flex space-x-3 pt-2">
            <button onclick="switchView('login-pelapor')" class="flex-1 py-3 bg-brand-blue hover:bg-blue-800 text-white rounded-xl text-xs font-bold transition">
                Lacak Status Tiket
            </button>
            <button onclick="switchView('buat')" class="px-4 py-3 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-xl text-xs font-bold transition">
                Buat Laporan Lain
            </button>
        </div>
    </div>
</section>