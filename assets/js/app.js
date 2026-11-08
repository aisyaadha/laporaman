// ============================================
// LOGIKA APLIKASI LAPORAMAN KAMPUS
// ============================================

// ---------- Notifikasi Modal (Custom Alert) ----------
function showCustomAlert(title, message) {
    document.getElementById('alert-title').innerText = title;
    document.getElementById('alert-message').innerText = message;
    document.getElementById('custom-alert-modal').classList.remove('hidden');
}

function closeCustomAlert() {
    document.getElementById('custom-alert-modal').classList.add('hidden');
}

// ---------- Navigasi Antar View ----------
function switchView(viewId) {
    const views = ['beranda', 'buat', 'success', 'login-pelapor', 'login-satgas', 'dashboard-satgas', 'detail-lacak'];
    views.forEach(v => {
        const el = document.getElementById('view-' + v);
        if (el) el.classList.add('hidden');
    });

    const navs = ['beranda', 'buat', 'login-pelapor'];
    navs.forEach(n => {
        const btn = document.getElementById('nav-' + n);
        if (btn) btn.className = "px-4 py-2 rounded-lg text-sm font-semibold transition text-blue-100 hover:bg-blue-800";
    });

    const target = document.getElementById('view-' + viewId);
    if (target) target.classList.remove('hidden');

    const activeBtn = document.getElementById('nav-' + viewId);
    if (activeBtn) activeBtn.className = "px-4 py-2 rounded-lg text-sm font-semibold transition bg-brand-blueDark text-white shadow-sm";

    if (viewId === 'dashboard-satgas') {
        renderSatgasTable();
    }
    // Tutup section kronologi/investigasi saat pindah view
    const kronSect = document.getElementById('satgas-kronologi-section');
    const invSect = document.getElementById('satgas-investigasi-section');
    if (kronSect) kronSect.classList.add('hidden');
    if (invSect) invSect.classList.add('hidden');

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    if (menu) menu.classList.toggle('hidden');
}

// ============================================
// BUKTI / EVIDENCE UPLOAD (PELAPOR)
// ============================================

// State bukti yang dipilih (array of {type, name, dataUrl, size})
let selectedEvidence = [];
const MAX_EVIDENCE_SIZE = 10 * 1024 * 1024; // 10MB per file

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('report-evidence');
    if (fileInput) {
        fileInput.addEventListener('change', handleEvidenceSelect);
    }
    // Drag & drop support
    const dropzone = document.getElementById('evidence-dropzone');
    if (dropzone) {
        ['dragenter', 'dragover'].forEach(ev => {
            dropzone.addEventListener(ev, e => {
                e.preventDefault();
                dropzone.classList.add('border-brand-blue', 'bg-blue-50/40');
            });
        });
        ['dragleave', 'drop'].forEach(ev => {
            dropzone.addEventListener(ev, e => {
                e.preventDefault();
                dropzone.classList.remove('border-brand-blue', 'bg-blue-50/40');
            });
        });
        dropzone.addEventListener('drop', e => {
            const files = Array.from(e.dataTransfer.files);
            processEvidenceFiles(files);
        });
    }
});

function handleEvidenceSelect(e) {
    const files = Array.from(e.target.files);
    processEvidenceFiles(files);
}

function processEvidenceFiles(files) {
    files.forEach(file => {
        if (file.size > MAX_EVIDENCE_SIZE) {
            showCustomAlert('File Terlalu Besar', `File "${file.name}" melebihi 10MB dan tidak dapat diunggah.`);
            return;
        }
        const reader = new FileReader();
        reader.onload = function(ev) {
            let type = 'file';
            if (file.type.startsWith('image/')) type = 'image';
            else if (file.type.startsWith('video/')) type = 'video';
            else if (file.type.startsWith('audio/')) type = 'audio';
            selectedEvidence.push({
                type: type,
                name: file.name,
                dataUrl: ev.target.result,
                size: formatBytes(file.size),
                uploadedAt: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ", " + new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
            });
            renderEvidencePreview();
        };
        reader.readAsDataURL(file);
    });
}

function removeEvidence(index) {
    selectedEvidence.splice(index, 1);
    renderEvidencePreview();
}

function renderEvidencePreview() {
    const container = document.getElementById('evidence-preview');
    if (!container) return;
    if (selectedEvidence.length === 0) {
        container.classList.add('hidden');
        container.innerHTML = '';
        return;
    }
    container.classList.remove('hidden');
    let html = '';
    selectedEvidence.forEach((ev, idx) => {
        let icon = '';
        let iconColor = '';
        if (ev.type === 'image') { icon = 'fa-image'; iconColor = 'text-blue-600'; }
        else if (ev.type === 'video') { icon = 'fa-film'; iconColor = 'text-purple-600'; }
        else if (ev.type === 'audio') { icon = 'fa-microphone'; iconColor = 'text-amber-600'; }
        else { icon = 'fa-file'; iconColor = 'text-slate-600'; }
        let thumb = '';
        if (ev.type === 'image' && ev.dataUrl) {
            thumb = `<img src="${ev.dataUrl}" class="w-12 h-12 rounded-lg object-cover border border-slate-300" alt="bukti">`;
        } else {
            thumb = `<div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center"><i class="fas ${icon} ${iconColor} text-lg"></i></div>`;
        }
        html += `
            <div class="flex items-center justify-between bg-white border border-slate-200 rounded-lg p-2.5 shadow-sm">
                <div class="flex items-center space-x-3 flex-1 min-w-0">
                    ${thumb}
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-semibold text-slate-800 truncate">${ev.name}</p>
                        <p class="text-[10px] text-slate-500">${ev.type.toUpperCase()} · ${ev.size}</p>
                    </div>
                </div>
                <button type="button" onclick="removeEvidence(${idx})" class="ml-2 text-slate-400 hover:text-brand-red text-xs"><i class="fas fa-times"></i></button>
            </div>
        `;
    });
    container.innerHTML = html;
}

// ============================================
// CREATE: Kirim Laporan Baru (dengan bukti opsional)
// ============================================
function handleFormSubmit(e) {
    e.preventDefault();
    const category = document.getElementById('report-category').value;
    const location = document.getElementById('report-location').value;
    const datetime = document.getElementById('report-datetime').value;
    const desc = document.getElementById('report-desc').value;
    const rawIdentity = document.getElementById('report-identity').value.trim();

    const randNum = Math.floor(1000 + Math.random() * 9000);
    const ticketCode = `#LAPOR-${randNum}-X`;
    const passcode = `PASS-${Math.floor(1000 + Math.random() * 9000)}`;

    const encryptedIdentity = rawIdentity ? `ENC[${rawIdentity}]` : "Anonim / Tanpa Identitas Kontak";

    const reports = getStorageReports();
    reports[ticketCode] = {
        ticketCode: ticketCode,
        passcode: passcode,
        category: category,
        location: location,
        datetime: datetime,
        description: desc,
        identity: encryptedIdentity,
        status: "Pending",
        validated: false,
        forwardedToInvestigation: false,
        evidence: selectedEvidence.slice(),
        logs: [
            {
                time: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ", " + new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                text: "Laporan dibuat dan identitas dienkripsi secara aman." + (selectedEvidence.length > 0 ? ` ${selectedEvidence.length} bukti lampiran diunggah.` : ""),
                actor: "Sistem"
            }
        ]
    };

    saveStorageReports(reports);

    document.getElementById('success-ticket').innerText = ticketCode;
    document.getElementById('success-passcode').innerText = passcode;

    // Reset bukti yang dipilih
    selectedEvidence = [];
    renderEvidencePreview();

    switchView('success');
    document.getElementById('report-form').reset();
}

// ============================================
// DOWNLOAD KARTU TIKET (PNG - untuk desktop/HP)
// ============================================
function downloadTicketCard() {
    const ticketCode = document.getElementById('success-ticket').innerText;
    const passcode = document.getElementById('success-passcode').innerText;

    if (!ticketCode || ticketCode === '#LAPOR-XXXX-X') {
        showCustomAlert('Data Belum Siap', 'Kode tiket belum tersedia untuk diunduh.');
        return;
    }

    // Ambil info kategori & waktu dari laporan (jika ada di storage)
    const reports = getStorageReports();
    const rep = reports[ticketCode] || {};
    const category = rep.category || '-';
    const created = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) + ", " + new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

    // Isi kartu
    document.getElementById('card-ticket-code').innerText = ticketCode;
    document.getElementById('card-passcode').innerText = passcode;
    document.getElementById('card-category').innerText = category;
    document.getElementById('card-created').innerText = created;

    const canvas = document.getElementById('ticket-card-canvas');
    const printArea = document.getElementById('ticket-card-print-area');
    printArea.classList.remove('hidden');
    printArea.style.position = 'fixed';
    printArea.style.left = '-9999px';
    printArea.style.top = '0';

    if (typeof html2canvas === 'undefined') {
        showCustomAlert('Library Belum Siap', 'Library html2canvas sedang dimuat. Coba lagi sebentar.');
        printArea.classList.add('hidden');
        return;
    }

    html2canvas(canvas, {
        backgroundColor: null,
        scale: 2,
        useCORS: true,
        logging: false
    }).then(function(c) {
        const link = document.createElement('a');
        link.download = `Tiket_${ticketCode.replace(/[^A-Z0-9]/gi, '_')}.png`;
        link.href = c.toDataURL('image/png');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        printArea.classList.add('hidden');
        showCustomAlert('Kartu Tiket Terunduh', `File PNG kartu tiket ${ticketCode} berhasil diunduh. Simpan file ini dengan aman.`);
    }).catch(function(err) {
        console.error(err);
        printArea.classList.add('hidden');
        showCustomAlert('Gagal Mengunduh', 'Terjadi kesalahan saat membuat PNG. Coba lagi.');
    });
}

// ============================================
// PELACAKAN TIKET PELAPOR
// ============================================
function executeTracking() {
    const ticketInput = document.getElementById('track-ticket-input');
    const passInput = document.getElementById('track-pass-input');

    if (!ticketInput || !passInput) return;

    let rawTicket = ticketInput.value.trim();
    const passcode = passInput.value.trim();

    if (!rawTicket || !passcode) {
        alert("Nomor Tiket dan Passcode wajib diisi!");
        return;
    }

    const reports = typeof getStorageReports === 'function' ? getStorageReports() : {};

    let searchKey1 = rawTicket.toUpperCase();
    let searchKey2 = '#' + searchKey1.replace(/^#/, '');

    const reportData = reports[searchKey2] || reports[searchKey1];

    if (reportData) {
        if (reportData.passcode.trim().toUpperCase() === passcode.toUpperCase()) {
            document.getElementById('detail-ticket-title').innerText = "Status Laporan " + reportData.ticketCode;
            document.getElementById('detail-category').innerText = reportData.category;
            document.getElementById('detail-description').innerText = reportData.description;
            document.getElementById('detail-location').innerText = reportData.location;
            document.getElementById('detail-status-text').innerText = reportData.status;

            let rawDate = reportData.datetime;
            let formattedDate = rawDate;
            if (rawDate) {
                let d = new Date(rawDate);
                if (!isNaN(d)) {
                    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                    let day = d.getDate();
                    let month = months[d.getMonth()];
                    let year = d.getFullYear();
                    let hours = String(d.getHours()).padStart(2, '0');
                    let minutes = String(d.getMinutes()).padStart(2, '0');
                    formattedDate = `${day} ${month} ${year}, ${hours}:${minutes} WIB`;
                }
            }
            document.getElementById('detail-date').innerText = formattedDate;
            document.getElementById('detail-identity').innerHTML = '<i class="fas fa-lock text-xs"></i> Anonim';
            switchView('detail-lacak');
        } else {
            alert("Passcode rahasia salah! Periksa kembali passcode Anda.");
        }
    } else {
        alert("Nomor Tiket tidak ditemukan dalam sistem.");
    }
}

// ============================================
// LOGIN SATGAS (ROLE-BASED)
// ============================================
function onRoleChange() {
    const role = document.querySelector('input[name="satgas-role"]:checked').value;
    const hintV = document.getElementById('role-hint-validator');
    const hintI = document.getElementById('role-hint-investigasi');
    if (hintV) hintV.classList.toggle('hidden', role !== 'validator');
    if (hintI) hintI.classList.toggle('hidden', role !== 'investigasi');

    // Update email placeholder default sesuai role
    const emailInput = document.getElementById('satgas-email');
    if (emailInput && role === 'validator') emailInput.value = 'validator@kampus.ac.id';
    if (emailInput && role === 'investigasi') emailInput.value = 'investigasi@kampus.ac.id';
}

function handleSatgasLogin(e) {
    e.preventDefault();
    const role = document.querySelector('input[name="satgas-role"]:checked').value;
    const email = document.getElementById('satgas-email').value;
    const password = document.getElementById('satgas-password').value;

    if (!email || !password) {
        showCustomAlert('Login Gagal', 'Email dan kata sandi wajib diisi.');
        return;
    }

    setSatgasSession(role, email);
    applyRoleToDashboard(role);
    switchView('dashboard-satgas');
    showCustomAlert('Login Berhasil', `Anda masuk sebagai ${role === 'validator' ? 'Validator' : 'Tim Investigasi'}.`);
}

function handleSatgasLogout() {
    clearSatgasSession();
    switchView('login-satgas');
    showCustomAlert('Logout Berhasil', 'Anda telah keluar dari dashboard Satgas.');
}

function applyRoleToDashboard(role) {
    const badge = document.getElementById('satgas-role-badge');
    const title = document.getElementById('satgas-role-title');
    const subtitle = document.getElementById('satgas-role-subtitle');
    if (!badge) return;

    if (role === 'validator') {
        badge.innerText = 'VALIDATOR';
        badge.className = 'px-2.5 py-1 rounded bg-amber-100 text-brand-yellow text-xs font-extrabold';
        title.innerText = 'Validator';
        subtitle.innerText = 'Tinjau kronologi laporan, perbarui status (Pending/Diproses), & validasi keabsahan sebelum diteruskan ke tim investigasi.';
    } else {
        badge.innerText = 'INVESTIGASI';
        badge.className = 'px-2.5 py-1 rounded bg-emerald-100 text-brand-emerald text-xs font-extrabold';
        title.innerText = 'Investigasi';
        subtitle.innerText = 'Tinjau detail laporan lengkap (kronologi, bukti, waktu, lokasi, kategori) & identitas terdekripsi pelapor untuk tindak lanjut.';
    }
}

// ============================================
// READ: Render Tabel Dashboard Satgas (Role-aware)
// ============================================
function renderSatgasTable() {
    const tbody = document.getElementById('satgas-table-body');
    const countEl = document.getElementById('satgas-count');
    const session = getSatgasSession();
    const role = session ? session.role : 'validator';

    let html = '';
    const reports = getStorageReports();
    let keys = Object.keys(reports);
    countEl.innerText = keys.length;

    if (keys.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7" class="px-4 py-6 text-center text-slate-500">Belum ada laporan masuk di database.</td></tr>`;
        return;
    }

    keys.forEach(k => {
        const rep = reports[k];
        let badgeClass = "bg-amber-100 text-amber-800 border border-amber-300";
        if (rep.status === 'Diproses' || rep.status === 'Investigasi') badgeClass = "bg-blue-100 text-brand-blue border border-blue-300";
        if (rep.status === 'Selesai') badgeClass = "bg-emerald-100 text-brand-emerald border border-emerald-300";
        if (rep.status === 'Darurat') badgeClass = "bg-red-100 text-brand-red border border-red-300";

        // Badge validasi
        let valBadge = '';
        if (rep.validated === true) {
            valBadge = `<span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 text-[10px] font-bold border border-emerald-300">VALID</span>`;
        } else if (rep.validated === false) {
            valBadge = `<span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[10px] font-bold border border-slate-300">BELUM</span>`;
        } else {
            valBadge = `<span class="px-2 py-0.5 rounded bg-red-100 text-red-800 text-[10px] font-bold border border-red-300">DITOLAK</span>`;
        }

        // Evidence count badge
        const evCount = (rep.evidence && rep.evidence.length) ? `<span class="ml-1 px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold">${rep.evidence.length} bukti</span>` : '';

        // Tombol aksi sesuai role
        let actions = '';
        if (role === 'validator') {
            actions = `
                <button onclick="openKronologi('${rep.ticketCode}')" class="px-2.5 py-1 bg-blue-50 hover:bg-blue-100 text-brand-blue rounded text-xs font-bold mb-1">Kronologi</button>
                <button onclick="openEditModal('${rep.ticketCode}')" class="px-2.5 py-1 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded text-xs font-bold mb-1">Update</button>
                <button onclick="openValidasiModal('${rep.ticketCode}')" class="px-2.5 py-1 bg-brand-emerald hover:bg-emerald-700 text-white rounded text-xs font-bold mb-1">Validasi</button>
                <button onclick="deleteReport('${rep.ticketCode}')" class="px-2.5 py-1 bg-brand-red hover:bg-red-700 text-white rounded text-xs font-bold">Hapus</button>
            `;
        } else {
            // Role: Investigasi
            // Hanya tampilkan yang sudah divalidasi & diteruskan, atau semua tapi aksi berbeda
            const canAccess = rep.validated === true || rep.forwardedToInvestigation === true;
            actions = canAccess
                ? `<button onclick="openInvestigasi('${rep.ticketCode}')" class="px-2.5 py-1 bg-brand-emerald hover:bg-emerald-700 text-white rounded text-xs font-bold mb-1">Detail</button>
                   <button onclick="openDecryptModal('${rep.ticketCode}')" class="px-2.5 py-1 bg-brand-blue hover:bg-blue-800 text-white rounded text-xs font-bold mb-1">Identitas</button>
                   <button onclick="openKronologi('${rep.ticketCode}')" class="px-2.5 py-1 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded text-xs font-bold">Kronologi</button>`
                : `<span class="text-[10px] text-slate-500 italic">Belum divalidasi Validator</span>`;
        }

        html += `
            <tr class="hover:bg-slate-50 transition">
                <td class="px-4 py-3 font-mono font-bold text-brand-blue">${rep.ticketCode}${evCount}</td>
                <td class="px-4 py-3 text-slate-700 font-semibold">${rep.category}</td>
                <td class="px-4 py-3 text-slate-700 truncate max-w-xs">${rep.location}</td>
                <td class="px-4 py-3 text-slate-500 text-xs">${rep.datetime}</td>
                <td class="px-4 py-3">
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold ${badgeClass}">${rep.status}</span>
                </td>
                <td class="px-4 py-3">${valBadge}</td>
                <td class="px-4 py-3 text-right space-x-1 space-y-1">
                    <div class="flex flex-wrap gap-1 justify-end">${actions}</div>
                </td>
            </tr>
        `;
    });
    tbody.innerHTML = html;
}

// ============================================
// VALIDATOR: Kronologi Laporan
// ============================================
function openKronologi(ticketCode) {
    const reports = getStorageReports();
    const rep = reports[ticketCode];
    if (!rep) return;

    document.getElementById('kronologi-ticket').innerText = rep.ticketCode;
    document.getElementById('kronologi-category').innerText = rep.category;
    document.getElementById('kronologi-location').innerText = rep.location;
    document.getElementById('kronogi-datetime').innerText = formatTanggalLaporan(rep.datetime);
    document.getElementById('kronologi-description').innerText = rep.description;

    // Render timeline
    const timelineEl = document.getElementById('kronologi-timeline');
    if (rep.logs && rep.logs.length > 0) {
        let tlHtml = '';
        rep.logs.forEach(log => {
            const actor = log.actor || 'Sistem';
            tlHtml += `
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 rounded-full bg-brand-blue mt-1.5 flex-shrink-0"></div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between flex-wrap gap-1">
                            <span class="text-xs font-bold text-slate-700">${escapeHtml(log.text)}</span>
                            <span class="text-[10px] text-slate-400">${log.time}</span>
                        </div>
                        <span class="text-[10px] text-slate-500 italic">oleh: ${escapeHtml(actor)}</span>
                    </div>
                </div>
            `;
        });
        timelineEl.innerHTML = tlHtml;
    } else {
        timelineEl.innerHTML = `<p class="text-xs text-slate-500 italic text-center py-4">Belum ada catatan timeline.</p>`;
    }

    document.getElementById('satgas-kronologi-section').classList.remove('hidden');
    document.getElementById('satgas-kronologi-section').scrollIntoView({ behavior: 'smooth' });
}

function closeKronologiSection() {
    document.getElementById('satgas-kronologi-section').classList.add('hidden');
}

// ============================================
// UPDATE: Modal Edit Status
// ============================================
function openEditModal(ticketCode) {
    const reports = getStorageReports();
    const rep = reports[ticketCode];
    if (rep) {
        document.getElementById('edit-ticket-code').value = ticketCode;
        document.getElementById('edit-status-select').value = rep.status;
        document.getElementById('edit-log-input').value = '';
        document.getElementById('edit-modal').classList.remove('hidden');
    }
}

function closeEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
}

function saveReportUpdate() {
    const ticketCode = document.getElementById('edit-ticket-code').value;
    const newStatus = document.getElementById('edit-status-select').value;
    const newLogText = document.getElementById('edit-log-input').value.trim();

    const reports = getStorageReports();
    const session = getSatgasSession();
    if (reports[ticketCode]) {
        reports[ticketCode].status = newStatus;

        const timeString = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ", " + new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

        let logMsg = "Status diperbarui menjadi: " + newStatus;
        if (newLogText) logMsg += " | Catatan: " + newLogText;

        if (!reports[ticketCode].logs) reports[ticketCode].logs = [];
        reports[ticketCode].logs.push({
            time: timeString,
            text: logMsg,
            actor: session ? `Validator (${session.email})` : 'Validator'
        });

        saveStorageReports(reports);
        closeEditModal();
        renderSatgasTable();
        showCustomAlert("Berhasil Diperbarui", "Status laporan " + ticketCode + " berhasil diperbarui menjadi: " + newStatus);
    }
}

// ============================================
// VALIDATOR: Validasi Keabsahan Laporan
// ============================================
function openValidasiModal(ticketCode) {
    const reports = getStorageReports();
    const rep = reports[ticketCode];
    if (rep) {
        document.getElementById('validasi-ticket-code').value = ticketCode;
        document.getElementById('validasi-ticket-id').innerText = rep.ticketCode;
        document.getElementById('validasi-result').value = rep.validated === false ? 'valid' : (rep.validated === true ? 'valid' : 'invalid');
        document.getElementById('validasi-note').value = '';
        document.getElementById('validasi-modal').classList.remove('hidden');
    }
}

function closeValidasiModal() {
    document.getElementById('validasi-modal').classList.add('hidden');
}

function submitValidasi() {
    const ticketCode = document.getElementById('validasi-ticket-code').value;
    const result = document.getElementById('validasi-result').value;
    const note = document.getElementById('validasi-note').value.trim();

    const reports = getStorageReports();
    const session = getSatgasSession();
    if (!reports[ticketCode]) return;

    const timeString = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ", " + new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

    let logMsg = '';
    if (result === 'valid') {
        reports[ticketCode].validated = true;
        reports[ticketCode].forwardedToInvestigation = true;
        if (reports[ticketCode].status === 'Pending') reports[ticketCode].status = 'Diproses';
        logMsg = `Laporan TERVERALIDASI & diteruskan ke Tim Investigasi.` + (note ? ` Catatan: ${note}` : '');
    } else if (result === 'invalid') {
        reports[ticketCode].validated = 'invalid';
        reports[ticketCode].forwardedToInvestigation = false;
        logMsg = `Laporan DITOLAK (tidak valid) & diarsipkan.` + (note ? ` Alasan: ${note}` : '');
    } else {
        // perlu info tambahan
        reports[ticketCode].validated = false;
        reports[ticketCode].forwardedToInvestigation = false;
        logMsg = `Validator meminta info tambahan: ${note || '(tanpa catatan)'}`;
    }

    if (!reports[ticketCode].logs) reports[ticketCode].logs = [];
    reports[ticketCode].logs.push({
        time: timeString,
        text: logMsg,
        actor: session ? `Validator (${session.email})` : 'Validator'
    });

    saveStorageReports(reports);
    closeValidasiModal();
    renderSatgasTable();
    showCustomAlert('Validasi Selesai', logMsg);
}

// ============================================
// DELETE: Hapus Laporan
// ============================================
function deleteReport(ticketCode) {
    if (!confirm('Yakin ingin menghapus laporan ' + ticketCode + '? Tindakan ini tidak dapat dibatalkan.')) return;
    const reports = getStorageReports();
    if (reports[ticketCode]) {
        delete reports[ticketCode];
        saveStorageReports(reports);
        renderSatgasTable();
        showCustomAlert('Laporan Dihapus', 'Data tiket ' + ticketCode + ' berhasil dihapus dari database.');
    }
}

// ============================================
// DEKRIPSI IDENTITAS (untuk Validator & Investigasi)
// ============================================
function openDecryptModal(ticketCode) {
    const reports = getStorageReports();
    const rep = reports[ticketCode];
    if (rep) {
        document.getElementById('modal-ticket-id').innerText = rep.ticketCode;
        let cleanIdent = rep.identity;
        if (cleanIdent.startsWith('ENC[')) {
            cleanIdent = cleanIdent.replace('ENC[', '').replace(']', '') + ' (Dekripsi Berhasil oleh Private Key)';
        }
        document.getElementById('modal-identity-val').innerText = cleanIdent;
        document.getElementById('decrypt-modal').classList.remove('hidden');
    }
}

function closeDecryptModal() {
    document.getElementById('decrypt-modal').classList.add('hidden');
}

// ============================================
// INVESTIGASI: Detail Laporan (kronologi, bukti, waktu, lokasi, kategori, identitas)
// ============================================
function openInvestigasi(ticketCode) {
    const reports = getStorageReports();
    const rep = reports[ticketCode];
    if (!rep) return;

    document.getElementById('inv-category').innerText = rep.category;
    document.getElementById('inv-location').innerText = rep.location;
    document.getElementById('inv-datetime').innerText = formatTanggalLaporan(rep.datetime);
    document.getElementById('inv-description').innerText = rep.description;

    // Bukti lampiran
    const evList = document.getElementById('inv-evidence-list');
    if (rep.evidence && rep.evidence.length > 0) {
        let evHtml = '';
        rep.evidence.forEach(ev => {
            if (ev.type === 'image' && ev.dataUrl) {
                evHtml += `
                    <div class="bg-white border border-slate-200 rounded-xl p-2 space-y-1.5 shadow-sm">
                        <img src="${ev.dataUrl}" class="w-full h-24 object-cover rounded-lg" alt="${escapeHtml(ev.name)}">
                        <p class="text-[10px] font-semibold text-slate-700 truncate">${escapeHtml(ev.name)}</p>
                        <p class="text-[9px] text-slate-500">${ev.type.toUpperCase()} · ${ev.size || '-'}</p>
                    </div>`;
            } else {
                let icon = ev.type === 'video' ? 'fa-film' : (ev.type === 'audio' ? 'fa-microphone' : 'fa-file');
                let color = ev.type === 'video' ? 'text-purple-600' : (ev.type === 'audio' ? 'text-amber-600' : 'text-slate-600');
                evHtml += `
                    <div class="bg-white border border-slate-200 rounded-xl p-2 space-y-1.5 shadow-sm">
                        <div class="w-full h-24 bg-slate-50 rounded-lg flex items-center justify-center">
                            <i class="fas ${icon} ${color} text-3xl"></i>
                        </div>
                        <p class="text-[10px] font-semibold text-slate-700 truncate">${escapeHtml(ev.name)}</p>
                        <p class="text-[9px] text-slate-500">${ev.type.toUpperCase()} · ${ev.size || '-'}</p>
                    </div>`;
            }
        });
        evList.innerHTML = evHtml;
    } else {
        evList.innerHTML = `<p class="col-span-full text-xs text-slate-500 italic text-center py-4">Tidak ada bukti lampiran.</p>`;
    }

    // Identitas terdekripsi
    let cleanIdent = rep.identity;
    if (cleanIdent.startsWith('ENC[')) {
        cleanIdent = cleanIdent.replace('ENC[', '').replace(']', '');
    }
    document.getElementById('inv-identity').innerText = cleanIdent + ' (Hasil Dekripsi Private Key Satgas)';

    // Timeline investigasi (filter: hanya log setelah laporan diteruskan, atau semua)
    const tlEl = document.getElementById('inv-timeline');
    if (rep.logs && rep.logs.length > 0) {
        let tlHtml = '';
        rep.logs.forEach(log => {
            tlHtml += `
                <div class="flex items-start space-x-2 text-xs">
                    <div class="w-1.5 h-1.5 rounded-full bg-brand-emerald mt-1.5 flex-shrink-0"></div>
                    <div class="flex-1">
                        <span class="text-slate-700">${escapeHtml(log.text)}</span>
                        <div class="text-[10px] text-slate-400">${log.time} · ${escapeHtml(log.actor || 'Sistem')}</div>
                    </div>
                </div>`;
        });
        tlEl.innerHTML = tlHtml;
    } else {
        tlEl.innerHTML = `<p class="text-xs text-slate-500 italic text-center py-4">Belum ada catatan investigasi.</p>`;
    }

    document.getElementById('inv-note-input').value = '';
    document.getElementById('inv-note-input').dataset.ticket = ticketCode;

    document.getElementById('satgas-investigasi-section').classList.remove('hidden');
    document.getElementById('satgas-investigasi-section').scrollIntoView({ behavior: 'smooth' });
}

function closeInvestigasiSection() {
    document.getElementById('satgas-investigasi-section').classList.add('hidden');
}

function addInvestigationNote() {
    const noteInput = document.getElementById('inv-note-input');
    const ticketCode = noteInput.dataset.ticket;
    const noteText = noteInput.value.trim();
    if (!ticketCode) {
        showCustomAlert('Error', 'Tiket tidak terdefinisi. Buka kembali detail laporan.');
        return;
    }
    if (!noteText) {
        showCustomAlert('Catatan Kosong', 'Tuliskan catatan investigasi terlebih dahulu.');
        return;
    }
    const reports = getStorageReports();
    const session = getSatgasSession();
    if (!reports[ticketCode]) return;

    const timeString = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ", " + new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    if (!reports[ticketCode].logs) reports[ticketCode].logs = [];
    reports[ticketCode].logs.push({
        time: timeString,
        text: `[Investigasi] ${noteText}`,
        actor: session ? `Investigasi (${session.email})` : 'Investigasi'
    });
    saveStorageReports(reports);
    noteInput.value = '';
    // Re-render timeline investigasi
    openInvestigasi(ticketCode);
    showCustomAlert('Catatan Ditambahkan', 'Catatan investigasi berhasil disimpan ke timeline.');
}

// ============================================
// UTILITAS
// ============================================
function formatTanggalLaporan(rawDate) {
    if (!rawDate) return '-';
    let d = new Date(rawDate);
    if (isNaN(d)) return rawDate;
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    let day = d.getDate();
    let month = months[d.getMonth()];
    let year = d.getFullYear();
    let hours = String(d.getHours()).padStart(2, '0');
    let minutes = String(d.getMinutes()).padStart(2, '0');
    return `${day} ${month} ${year}, ${hours}:${minutes} WIB`;
}

function escapeHtml(str) {
    if (str == null) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// Saat halaman dimuat, cek apakah ada sesi satgas yang masih aktif
document.addEventListener('DOMContentLoaded', function() {
    const session = getSatgasSession();
    if (session) {
        applyRoleToDashboard(session.role);
    }
});
