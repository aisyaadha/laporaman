<div id="view-detail-lacak" class="view-section hidden">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Tombol Kembali dengan Ikon SVG Panah Kiri -->
        <button onclick="switchView('login-pelapor')" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-[#1a365d] transition-colors mb-6 group cursor-pointer">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Pelacakan
        </button>

        <!-- NAVY HERO CARD -->
        <div class="bg-[#1a365d] rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-8 md:px-8 md:py-10">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-blue-200 text-sm font-medium mb-1">
                            <i class="fas fa-ticket mr-1"></i>Nomor Tiket
                        </p>
                        <h1 id="detail-ticket-title" class="text-2xl md:text-3xl font-bold text-white">
                            Status Laporan #LAPOR-1001-X
                        </h1>
                    </div>
                    <span id="detail-status-badge" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold shadow-md bg-[#eab308] text-[#1a365d]">
                        <span class="w-2 h-2 rounded-full bg-white/80 animate-pulse"></span>
                        Sedang Diverifikasi
                    </span>
                </div>
            </div>
        </div>

        <!-- MAIN CARD: Ringkasan & Keterangan Laporan -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-6">
            <h2 class="text-lg font-bold text-[#1a365d] mb-5 flex items-center">
                <i class="fas fa-file-lines mr-2 text-[#059669]"></i>Informasi Ringkasan Laporan
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 mb-1.5"><i class="fas fa-tag"></i>Kategori Laporan</p>
                    <p id="detail-category" class="text-sm font-semibold text-gray-800">-</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 mb-1.5"><i class="fas fa-calendar-alt"></i>Tanggal Kirim</p>
                    <p id="detail-date" class="text-sm font-semibold text-gray-800">-</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 mb-1.5"><i class="fas fa-user-shield"></i>Pengirim</p>
                    <p id="detail-identity" class="text-sm font-semibold text-[#059669]">
                        <i class="fas fa-lock text-xs mr-1"></i>Terenkripsi (Anonim)
                    </p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 mb-1.5"><i class="fas fa-flag"></i>Status Proses</p>
                    <p id="detail-status-text" class="text-sm font-semibold text-[#059669]">-</p>
                </div>
            </div>

            <div class="mt-5 pt-5 border-t border-gray-100 space-y-4">
                <div>
                    <p class="text-xs text-gray-400 mb-1.5"><i class="fas fa-align-left"></i>Deskripsi Laporan</p>
                    <p id="detail-description" class="text-sm text-gray-700 leading-relaxed">-</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-1.5"><i class="fas fa-location-dot"></i>Lokasi Kejadian</p>
                    <p id="detail-location" class="text-sm text-gray-700">-</p>
                </div>
            </div>
        </div>

        <!-- TIMELINE / ALUR PROSES 4 TAHAP -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-6">
            <h2 class="text-lg font-bold text-[#1a365d] mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Alur Perkembangan Laporan
            </h2>
            
            <div class="relative pl-6 space-y-8 before:absolute before:left-2.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-200">
                <!-- Tahap 1 -->
                <div class="relative flex items-start space-x-4">
                    <div class="absolute -left-6 mt-1 w-5 h-5 rounded-full bg-[#059669] flex items-center justify-center ring-4 ring-white">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Laporan Diterima</p>
                        <p class="text-xs text-gray-500 mt-0.5">Laporan Anda berhasil diterima dan tercatat dalam sistem LaporAman Kampus.</p>
                    </div>
                </div>

                <!-- Tahap 2 -->
                <div class="relative flex items-start space-x-4">
                    <div class="absolute -left-6 mt-1 w-5 h-5 rounded-full bg-[#eab308] flex items-center justify-center ring-4 ring-white">
                        <span class="w-2 h-2 rounded-full bg-white"></span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Sedang Diverifikasi</p>
                        <p class="text-xs text-gray-500 mt-0.5">Laporan sedang diverifikasi oleh tim Satgas Kampus untuk memastikan validitas informasi.</p>
                    </div>
                </div>

                <!-- Tahap 3 -->
                <div class="relative flex items-start space-x-4">
                    <div class="absolute -left-6 mt-1 w-5 h-5 rounded-full bg-gray-300 flex items-center justify-center ring-4 ring-white"></div>
                    <div>
                        <p class="text-sm font-bold text-gray-400">Investigasi dan Penanganan</p>
                        <p class="text-xs text-gray-400 mt-0.5">Laporan diteruskan ke unit terkait untuk ditindaklanjuti.</p>
                    </div>
                </div>

                <!-- Tahap 4 -->
                <div class="relative flex items-start space-x-4">
                    <div class="absolute -left-6 mt-1 w-5 h-5 rounded-full bg-gray-300 flex items-center justify-center ring-4 ring-white"></div>
                    <div>
                        <p class="text-sm font-bold text-gray-400">Kasus Selesai / Ditutup</p>
                        <p class="text-xs text-gray-400 mt-0.5">Penanganan laporan telah tuntas diselesaikan oleh pihak berwenang.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex flex-col sm:flex-row gap-3">
            <button onclick="switchView('login-pelapor')"
               class="flex-1 px-6 py-3.5 text-[#1a365d] border-2 border-[#1a365d] bg-transparent hover:bg-[#1a365d] hover:text-white rounded-xl font-semibold transition-all text-center cursor-pointer inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Pelacakan
            </button>
            <button onclick="switchView('buat')"
               class="flex-1 px-6 py-3.5 text-white bg-[#059669] hover:bg-[#047857] rounded-xl font-semibold transition-all shadow-sm hover:shadow-md text-center cursor-pointer">
                <i class="fas fa-plus mr-2"></i>Buat Laporan Baru
            </button>
        </div>

    </div>
</div>