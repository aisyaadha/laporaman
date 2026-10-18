<!-- CUSTOM MESSAGE MODAL (Replaces alert) -->
<div id="custom-alert-modal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 space-y-4 border border-slate-200 shadow-2xl text-center">
        <div id="alert-icon-box" class="w-12 h-12 bg-blue-100 text-brand-blue rounded-full flex items-center justify-center mx-auto font-bold text-lg">i</div>
        <div class="space-y-1">
            <h3 id="alert-title" class="text-base font-bold text-slate-900">Informasi Sistem</h3>
            <p id="alert-message" class="text-xs text-slate-600">Pesan sistem...</p>
        </div>
        <button onclick="closeCustomAlert()" class="w-full py-2.5 bg-brand-blue text-white rounded-xl text-xs font-bold hover:bg-blue-800">Tutup</button>
    </div>
</div>

<!-- EDIT / UPDATE STATUS MODAL -->
<div id="edit-modal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 border border-slate-200 shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-200 pb-3">
            <h3 class="text-lg font-bold text-slate-900">Perbarui Status & Catatan</h3>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <input type="hidden" id="edit-ticket-code">
        <div class="space-y-3">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Status Laporan</label>
                <select id="edit-status-select" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-900">
                    <option value="Pending">Pending</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Investigasi">Investigasi</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Darurat">Darurat</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Tambah Catatan Progres / Log Baru</label>
                <textarea id="edit-log-input" rows="3" placeholder="Tuliskan catatan penanganan petugas..." class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-900"></textarea>
            </div>
        </div>
        <div class="flex justify-end space-x-2 pt-2">
            <button onclick="closeEditModal()" class="px-4 py-2 bg-slate-200 text-slate-800 rounded-xl text-xs font-bold">Batal</button>
            <button onclick="saveReportUpdate()" class="px-4 py-2 bg-brand-blue text-white rounded-xl text-xs font-bold">Simpan Perubahan</button>
        </div>
    </div>
</div>

<!-- DECRYPT MODAL -->
<div id="decrypt-modal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 border border-slate-200 shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-200 pb-3">
            <h3 class="text-lg font-bold text-slate-900">Dekripsi Data Identitas Pelapor</h3>
            <button onclick="closeDecryptModal()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <p class="text-xs text-slate-600">Proses dekripsi menggunakan Private Key milik Tim Satgas Kampus secara aman:</p>
        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 font-mono text-xs text-slate-800 space-y-2">
            <div><strong>Kode Tiket:</strong> <span id="modal-ticket-id">-</span></div>
            <div><strong>Hasil Dekripsi Identitas:</strong> <span id="modal-identity-val" class="text-brand-blue font-bold block mt-1">-</span></div>
        </div>
        <div class="flex justify-end pt-2">
            <button onclick="closeDecryptModal()" class="px-4 py-2 bg-brand-blue text-white rounded-xl text-xs font-bold">Selesai / Tutup</button>
        </div>
    </div>
</div>