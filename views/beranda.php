<!-- VIEW: BERANDA & INFORMASI PLATFORM -->
<section id="view-beranda" class="space-y-10">

    <!-- Hero Banner -->
    <div class="bg-gradient-to-br from-brand-blue to-brand-blueDark text-white rounded-3xl p-8 sm:p-12 shadow-xl relative overflow-hidden">
        <div class="relative z-10 max-w-3xl space-y-6">
            <span class="inline-block px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-xs font-bold text-yellow-300 uppercase tracking-wide">
                Layanan Keamanan & Perlindungan Kampus Terpadu
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                Platform Pelaporan Kampus Aman, Rahasia, & Terenkripsi.
            </h1>
            <p class="text-slate-200 text-base sm:text-lg font-normal leading-relaxed">
                LaporAman Kampus adalah sistem pengaduan resmi untuk melaporkan kekerasan seksual, perundungan, kekerasan fisik, serta tindakan kriminal di lingkungan kampus secara aman. Identitas Anda dienkripsi penuh demi menjamin kerahasiaan dan perlindungan diri.
            </p>
            <div class="flex flex-wrap gap-4 pt-2">
                <button onclick="switchView('buat')" class="px-6 py-3.5 rounded-xl bg-brand-emerald hover:bg-emerald-700 text-white font-bold text-sm shadow-md transition flex items-center space-x-2">
                    <span>Buat Laporan Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
                <button onclick="switchView('login-pelapor')" class="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/30 text-white font-bold text-sm transition">
                    Lacak Status Tiket Anda
                </button>
            </div>
        </div>
    </div>

    <!-- Keterangan & Cara Kerja Web -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-brand-blue flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Apa itu LaporAman Kampus?</h3>
            </div>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                Web ini dirancang khusus untuk mahasiswa dan civitas akademika agar dapat melaporkan insiden sensitif atau tindak kriminal tanpa rasa takut akan kebocoran data pribadi. Sistem kami mengamankan identitas menggunakan enkripsi tingkat lanjut (*client-side encryption*) sehingga pengelola server/database tidak dapat membaca siapa pelapornya.
            </p>
        </div>

        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 sm:p-8 shadow-sm space-y-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-amber-200 text-amber-900 flex items-center justify-center font-extrabold text-xs">INFO</div>
                <h3 class="text-lg font-bold text-amber-950">Dari Mana Mendapatkan Kode Tiket?</h3>
            </div>
            <p class="text-xs sm:text-sm text-amber-900 leading-relaxed">
                Kode Tiket dan Passcode <strong>TIDAK</strong> perlu dibeli atau didaftarkan manual. Setelah Anda selesai mengirim formulir di menu <strong>"Buat Laporan"</strong>, sistem otomatis menggenerasi Kode Tiket unik (contoh: <code>#LAPOR-1001-X</code>) dan Kunci Passcode di layar konfirmasi. Simpan kode tersebut untuk memantau status secara anonim.
            </p>
        </div>
    </div>

    <!-- Kategori Pelaporan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
            <span class="px-2.5 py-1 rounded bg-rose-100 text-brand-red text-xs font-bold">Kategori 1</span>
            <h4 class="font-bold text-slate-900">Kekerasan Seksual & Pelecehan</h4>
            <p class="text-xs text-slate-600">Pelanggaran kesusilaan, pelecehan verbal, maupun kontak fisik tanpa persetujuan di area kampus.</p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
            <span class="px-2.5 py-1 rounded bg-blue-100 text-brand-blue text-xs font-bold">Kategori 2</span>
            <h4 class="font-bold text-slate-900">Kekerasan Fisik & Perundungan</h4>
            <p class="text-xs text-slate-600">Perundungan (bullying), penganiayaan, atau kekerasan fisik dalam kegiatan organisasi maupun akademik.</p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
            <span class="px-2.5 py-1 rounded bg-amber-100 text-brand-yellow text-xs font-bold">Kategori 3</span>
            <h4 class="font-bold text-slate-900">Kriminalitas & Kejahatan</h4>
            <p class="text-xs text-slate-600">Pencurian kendaraan, barang berharga, pungutan liar, atau tindakan kriminal lainnya di area kampus.</p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
            <span class="px-2.5 py-1 rounded bg-emerald-100 text-brand-emerald text-xs font-bold">Kategori 4</span>
            <h4 class="font-bold text-slate-900">Keamanan Lingkungan</h4>
            <p class="text-xs text-slate-600">Area kampus yang gelap, fasilitas rusak berbahaya, atau situasi rawan kejahatan malam hari.</p>
        </div>
    </div>
</section>