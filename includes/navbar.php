<header class="bg-brand-blue text-white shadow-lg sticky top-0 z-50 border-b border-brand-blueDark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Brand Logo / Title -->
        <div class="flex items-center space-x-3 cursor-pointer" onclick="switchView('beranda')">
            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center border border-white/20 shadow-inner">
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <div>
                <span class="font-extrabold text-lg tracking-tight block leading-tight">LaporAman Kampus</span>
                <span class="text-xs text-blue-200">Sistem Pelaporan Terenkripsi End-to-End</span>
            </div>
        </div>

        <!-- Desktop Nav Buttons -->
        <nav class="hidden md:flex items-center space-x-2">
            <button onclick="switchView('beranda')" id="nav-beranda" class="px-4 py-2 rounded-lg text-sm font-semibold transition bg-brand-blueDark text-white shadow-sm">Beranda</button>
            <button onclick="switchView('buat')" id="nav-buat" class="px-4 py-2 rounded-lg text-sm font-semibold transition text-blue-100 hover:bg-blue-800">Buat Laporan</button>
            <button onclick="switchView('login-pelapor')" id="nav-login-pelapor" class="px-4 py-2 rounded-lg text-sm font-semibold transition text-blue-100 hover:bg-blue-800">Lacak Tiket Pelapor</button>
            <button onclick="switchView('login-satgas')" id="nav-login-satgas" class="px-4 py-2 rounded-lg text-sm font-semibold transition bg-yellow-500 hover:bg-yellow-600 text-brand-dark">Login Satgas</button>
        </nav>

        <!-- Mobile Hamburger Toggle -->
        <div class="md:hidden">
            <button onclick="toggleMobileMenu()" class="p-2 rounded-lg text-blue-100 hover:bg-blue-800 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Dropdown -->
    <div id="mobile-menu" class="hidden md:hidden bg-brand-blueDark border-t border-blue-900 px-4 py-3 space-y-2">
        <button onclick="switchView('beranda'); toggleMobileMenu();" class="block w-full text-left px-3 py-2 rounded-lg text-sm font-semibold text-white hover:bg-blue-900">Beranda</button>
        <button onclick="switchView('buat'); toggleMobileMenu();" class="block w-full text-left px-3 py-2 rounded-lg text-sm font-semibold text-blue-100 hover:bg-blue-900">Buat Laporan Baru</button>
        <button onclick="switchView('login-pelapor'); toggleMobileMenu();" class="block w-full text-left px-3 py-2 rounded-lg text-sm font-semibold text-blue-100 hover:bg-blue-900">Lacak Tiket Pelapor</button>
        <button onclick="switchView('login-satgas'); toggleMobileMenu();" class="block w-full text-left px-3 py-2 rounded-lg text-sm font-semibold text-yellow-400 hover:bg-blue-900">Login Petugas Satgas</button>
    </div>
</header>