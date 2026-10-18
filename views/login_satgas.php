<!-- VIEW: LOGIN SATGAS KAMPUS -->
<section id="view-login-satgas" class="hidden space-y-6 max-w-md mx-auto">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        <div class="border-b border-slate-200 pb-4">
            <span class="px-2.5 py-1 rounded bg-amber-100 text-brand-yellow text-xs font-extrabold">PORTAL PETUGAS</span>
            <h2 class="text-2xl font-extrabold text-brand-dark tracking-tight mt-2">Login Petugas Satgas</h2>
            <p class="text-xs text-slate-600 mt-1">Kredensial khusus tim penampung laporan & manajemen penanganan kasus.</p>
        </div>

        <form onsubmit="handleSatgasLogin(event)" class="space-y-4">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-800">Email Petugas Satgas</label>
                <input type="email" id="satgas-email" required value="satgas@kampus.ac.id" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue shadow-sm">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-800">Kata Sandi / Private Key</label>
                <input type="password" id="satgas-password" required value="satgas123" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-brand-blue shadow-sm">
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-brand-dark hover:bg-slate-800 text-white font-bold text-sm transition shadow-md">
                Masuk ke Dashboard Satgas
            </button>
        </form>
    </div>
</section>