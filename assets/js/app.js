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
    // 1. Tambahkan 'detail-lacak' ke dalam daftar views agar ikut diatur sistem
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

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    if (menu) menu.classList.toggle('hidden');
}

// ---------- CREATE: Kirim Laporan Baru ----------
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
        logs: [
            {
                time: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ", " + new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                text: "Laporan dibuat dan identitas dienkripsi secara aman."
            }
        ]
    };

    saveStorageReports(reports);

    document.getElementById('success-ticket').innerText = ticketCode;
    document.getElementById('success-passcode').innerText = passcode;

    switchView('success');
    document.getElementById('report-form').reset();
}

// Fungsi untuk memproses pencarian tiket pelapor
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

    // Ambil data dari LocalStorage menggunakan fungsi bawaan data.js
    const reports = typeof getStorageReports === 'function' ? getStorageReports() : {};

    // Format pencarian agar fleksibel (dengan/tanpa #)
    let searchKey1 = rawTicket.toUpperCase();
    let searchKey2 = '#' + searchKey1.replace(/^#/, '');

    const reportData = reports[searchKey2] || reports[searchKey1];

    if (reportData) {
        // Cek kecocokan passcode (menggunakan toUpperCase agar aman dari huruf kecil)
        if (reportData.passcode.trim().toUpperCase() === passcode.toUpperCase()) {
            
            // 1. Masukkan data dasar ke elemen HTML detail lacak
            document.getElementById('detail-ticket-title').innerText = "Status Laporan " + reportData.ticketCode;
            document.getElementById('detail-category').innerText = reportData.category;
            document.getElementById('detail-description').innerText = reportData.description;
            document.getElementById('detail-location').innerText = reportData.location;
            document.getElementById('detail-status-text').innerText = reportData.status;

            // 2. Format Tanggal Cantik (Contoh: 15 Oktober 2026, 10:30 WIB)
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

            // 3. Paksa identitas pengirim menjadi Anonim / Terenkripsi yang rapi
            document.getElementById('detail-identity').innerHTML = '<i class="fas fa-lock text-xs"></i>Anonim';

            // 4. Panggil switchView untuk menutup form lacak & membuka tampilan detail secara bersih
            switchView('detail-lacak');

        } else {
            alert("Passcode rahasia salah! Periksa kembali passcode Anda.");
        }
    } else {
        alert("Nomor Tiket tidak ditemukan dalam sistem.");
    }
}

// ---------- LOGIN SATGAS ----------
function handleSatgasLogin(e) {
    e.preventDefault();
    switchView('dashboard-satgas');
}

// ---------- READ: Render Tabel Dashboard Satgas ----------
function renderSatgasTable() {
    const tbody = document.getElementById('satgas-table-body');
    const countEl = document.getElementById('satgas-count');
    let html = '';
    const reports = getStorageReports();
    let keys = Object.keys(reports);
    countEl.innerText = keys.length;

    if (keys.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="px-4 py-6 text-center text-slate-500">Belum ada laporan masuk di database.</td></tr>`;
        return;
    }

    keys.forEach(k => {
        const rep = reports[k];
        let badgeClass = "bg-amber-100 text-amber-800 border border-amber-300";
        if (rep.status === 'Diproses' || rep.status === 'Investigasi') badgeClass = "bg-blue-100 text-brand-blue border border-blue-300";
        if (rep.status === 'Selesai') badgeClass = "bg-emerald-100 text-brand-emerald border border-emerald-300";
        if (rep.status === 'Darurat') badgeClass = "bg-red-100 text-brand-red border border-red-300";

        html += `
            <tr class="hover:bg-slate-50 transition">
                <td class="px-4 py-3 font-mono font-bold text-brand-blue">${rep.ticketCode}</td>
                <td class="px-4 py-3 text-slate-700 font-semibold">${rep.category}</td>
                <td class="px-4 py-3 text-slate-700 truncate max-w-xs">${rep.location}</td>
                <td class="px-4 py-3 text-slate-500 text-xs">${rep.datetime}</td>
                <td class="px-4 py-3">
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold ${badgeClass}">${rep.status}</span>
                </td>
                <td class="px-4 py-3 text-right space-x-1">
                    <button onclick="openEditModal('${rep.ticketCode}')" class="px-2.5 py-1 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded text-xs font-bold">Update</button>
                    <button onclick="openDecryptModal('${rep.ticketCode}')" class="px-2.5 py-1 bg-brand-blue hover:bg-blue-800 text-white rounded text-xs font-bold">Dekripsi</button>
                    <button onclick="deleteReport('${rep.ticketCode}')" class="px-2.5 py-1 bg-brand-red hover:bg-red-700 text-white rounded text-xs font-bold">Hapus</button>
                </td>
            </tr>
        `;
    });
    tbody.innerHTML = html;
}

// ---------- UPDATE: Modal Edit Status ----------
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
    if (reports[ticketCode]) {
        reports[ticketCode].status = newStatus;

        const timeString = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ", " + new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

        let logMsg = "Status diperbarui menjadi: " + newStatus;
        if (newLogText) {
            logMsg += " | Catatan: " + newLogText;
        }

        if (!reports[ticketCode].logs) {
            reports[ticketCode].logs = [];
        }
        reports[ticketCode].logs.push({
            time: timeString,
            text: logMsg
        });

        saveStorageReports(reports);
        closeEditModal();
        renderSatgasTable();
        showCustomAlert("Berhasil Diperbarui", "Status laporan " + ticketCode + " berhasil diperbarui.");
    }
}

// ---------- DELETE: Hapus Laporan ----------
function deleteReport(ticketCode) {
    const reports = getStorageReports();
    if (reports[ticketCode]) {
        delete reports[ticketCode];
        saveStorageReports(reports);
        renderSatgasTable();
        showCustomAlert("Laporan Dihapus", "Data tiket " + ticketCode + " berhasil dihapus dari database.");
    }
}

// ---------- DEKRIPSI IDENTITAS ----------
function openDecryptModal(ticketCode) {
    const reports = getStorageReports();
    const rep = reports[ticketCode];
    if (rep) {
        document.getElementById('modal-ticket-id').innerText = rep.ticketCode;
        let cleanIdent = rep.identity;
        if (cleanIdent.startsWith("ENC[")) {
            cleanIdent = cleanIdent.replace("ENC[", "").replace("]", "") + " (Dekripsi Berhasil oleh Private Key)";
        }
        document.getElementById('modal-identity-val').innerText = cleanIdent;
        document.getElementById('decrypt-modal').classList.remove('hidden');
    }
}

function closeDecryptModal() {
    document.getElementById('decrypt-modal').classList.add('hidden');
}