<!-- VIEW: BUAT LAPORAN -->
<section id="view-buat" class="hidden space-y-6 max-w-3xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
        <div class="border-b border-slate-200 pb-4">
            <h2 class="text-2xl font-extrabold text-brand-dark tracking-tight">Formulir Pelaporan Insiden Kampus</h2>
            <p class="text-xs text-slate-600 mt-1">Sampaikan laporan Anda secara aman. Data identitas dienkripsi di sisi browser sebelum disimpan ke database.</p>
        </div>

        <form id="report-form" onsubmit="handleFormSubmit(event)" class="space-y-5">
            <!-- Kategori -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-800">Kategori Insiden <span class="text-brand-red">*</span></label>
                <select id="report-category" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue shadow-sm">
                    <option value="">-- Pilih Kategori Pelaporan --</option>
                    <option value="Kekerasan Seksual & Pelecehan">Kekerasan Seksual & Pelecehan</option>
                    <option value="Kekerasan Fisik & Perundungan">Kekerasan Fisik & Perundungan (Bullying)</option>
                    <option value="Kriminalitas Kampus">Kriminalitas Kampus (Pencurian / Pungli / Curanmor)</option>
                    <option value="Keamanan Lingkungan">Keamanan Lingkungan (Area Rawan / Fasilitas Berbahaya)</option>
                </select>
            </div>

            <!-- Lokasi & Waktu -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-800">Lokasi Kejadian <span class="text-brand-red">*</span></label>
                    <input type="text" id="report-location" required placeholder="Contoh: Gedung Rektorat Lt. 3 / Parkiran" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue shadow-sm">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-800">Waktu Kejadian <span class="text-brand-red">*</span></label>
                    <input type="datetime-local" id="report-datetime" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue shadow-sm">
                </div>
            </div>

            <!-- Deskripsi Kronologi -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-800">Kronologi Singkat Kejadian <span class="text-brand-red">*</span></label>
                <textarea id="report-desc" rows="4" required placeholder="Jelaskan urutan peristiwa secara terperinci..." class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue shadow-sm"></textarea>
            </div>

            <!-- Identitas Terenkripsi Opsional -->
            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl space-y-3 shadow-sm">
                <div class="flex items-start space-x-3">
                    <div class="p-2 rounded-lg bg-blue-100 text-brand-blue mt-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Enkripsi Identitas Pelapor (Client-Side Encryption)</h3>
                        <p class="text-xs text-slate-600 mt-0.5">Jika Anda ingin didampingi Satgas, masukkan identitas/kontak. Data dienkripsi langsung di browser Anda.</p>
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-slate-700">Nama / Kontak WhatsApp / Email (Opsional)</label>
                    <input type="text" id="report-identity" placeholder="Kosongkan jika ingin anonim total" class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-brand-blue">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-brand-blue hover:bg-blue-800 text-white font-bold text-sm transition shadow-md flex items-center justify-center space-x-2">
                <span>Kirim Laporan Terenkripsi</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>
    </div>
</section>