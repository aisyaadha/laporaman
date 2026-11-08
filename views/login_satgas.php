<!-- VIEW: LOGIN SATGAS KAMPUS (dengan pilihan role) -->
<section id="view-login-satgas" class="hidden space-y-6 max-w-md mx-auto">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        <div class="border-b border-slate-200 pb-4">
            <span class="px-2.5 py-1 rounded bg-amber-100 text-brand-yellow text-xs font-extrabold">PORTAL PETUGAS</span>
            <h2 class="text-2xl font-extrabold text-brand-dark tracking-tight mt-2">Login Petugas Satgas</h2>
            <p class="text-xs text-slate-600 mt-1">Pilih peran (role) petugas Anda, lalu masukkan kredensial khusus tim penampung laporan &amp; manajemen penanganan kasus.</p>
        </div>

        <form onsubmit="handleSatgasLogin(event)" class="space-y-4">
            <!-- Pilihan Role Petugas -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-800">Pilih Peran (Role) Petugas <span class="text-brand-red">*</span></label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="satgas-role" value="validator" class="peer sr-only" checked onchange="onRoleChange()">
                        <div class="px-3 py-4 border-2 border-slate-200 rounded-xl text-center peer-checked:border-brand-blue peer-checked:bg-blue-50/40 transition">
                            <div class="w-10 h-10 mx-auto rounded-lg bg-amber-100 text-brand-yellow flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div class="text-sm font-bold text-slate-900">Validator</div>
                            <div class="text-[10px] text-slate-500 mt-0.5">Verifikasi &amp; validasi laporan</div>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="satgas-role" value="investigasi" class="peer sr-only" onchange="onRoleChange()">
                        <div class="px-3 py-4 border-2 border-slate-200 rounded-xl text-center peer-checked:border-brand-emerald peer-checked:bg-emerald-50/40 transition">
                            <div class="w-10 h-10 mx-auto rounded-lg bg-emerald-100 text-brand-emerald flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <div class="text-sm font-bold text-slate-900">Investigasi</div>
                            <div class="text-[10px] text-slate-500 mt-0.5">Tindak lanjut &amp; investigasi kasus</div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-800">Email Petugas Satgas</label>
                <input type="email" id="satgas-email" required value="validator@kampus.ac.id" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue shadow-sm">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-800">Kata Sandi / Private Key</label>
                <input type="password" id="satgas-password" required value="satgas123" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue shadow-sm">
            </div>

            <!-- Info Hint per Role -->
            <div id="role-hint-validator" class="p-3 bg-blue-50 border border-blue-200 rounded-xl text-blue-900 text-xs space-y-1">
                <div class="font-bold flex items-center space-x-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>Peran Validator</span></div>
                <ul class="list-disc list-inside space-y-0.5 text-blue-800">
                    <li>Memeriksa kronologi laporan</li>
                    <li>Update status (Pending / Diproses)</li>
                    <li>Validasi keabsahan laporan</li>
                    <li>Meneruskan laporan valid ke tim investigasi</li>
                </ul>
            </div>
            <div id="role-hint-investigasi" class="hidden p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-900 text-xs space-y-1">
                <div class="font-bold flex items-center space-x-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg><span>Peran Investigasi</span></div>
                <ul class="list-disc list-inside space-y-0.5 text-emerald-800">
                    <li>Mengakses detail laporan lengkap</li>
                    <li>Memeriksa kronologi, bukti, waktu, lokasi, kategori</li>
                    <li>Melihat identitas terdekripsi pelapor</li>
                </ul>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-brand-dark hover:bg-slate-800 text-white font-bold text-sm transition shadow-md">
                Masuk ke Dashboard Satgas
            </button>
        </form>
    </div>
</section>
