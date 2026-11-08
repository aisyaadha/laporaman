// ============================================
// DATA & PENYIMPANAN (LocalStorage)
// ============================================

// Initial Mock Data Storage with LocalStorage Persistence
const defaultReports = {
    "#LAPOR-1001-X": {
        ticketCode: "#LAPOR-1001-X",
        passcode: "PASS-1234",
        category: "Kekerasan Seksual & Pelecehan",
        location: "Koridor Gedung Kuliah Utama Lt. 2",
        datetime: "2026-10-15T10:30",
        description: "Terjadi perlakuan pelecehan secara verbal dan kontak fisik tanpa persetujuan.",
        identity: "ENC[Mahasiswa Fasilkom / WA: 081299887766]",
        status: "Diproses",
        validated: true,
        forwardedToInvestigation: true,
        evidence: [
            { type: "image", name: "bukti_foto_1.jpg", dataUrl: "", size: "120 KB", uploadedAt: "15 Okt 2026, 10:35" }
        ],
        logs: [
            { time: "15 Okt 2026, 10:35", text: "Laporan diterima oleh sistem terenkripsi.", actor: "Sistem" },
            { time: "15 Okt 2026, 11:00", text: "Tim Validator memverifikasi bukti awal. Laporan TERVERALIDASI.", actor: "Validator" },
            { time: "15 Okt 2026, 11:15", text: "Laporan diteruskan ke Tim Investigasi untuk ditindaklanjuti.", actor: "Validator" }
        ]
    },
    "#LAPOR-1002-X": {
        ticketCode: "#LAPOR-1002-X",
        passcode: "PASS-5678",
        category: "Kriminalitas Kampus",
        location: "Parkiran Sepeda Motor Basement",
        datetime: "2026-10-14T15:20",
        description: "Pencurian helm dan kaca spion di area parkir basement.",
        identity: "Anonim / Tanpa Identitas Kontak",
        status: "Pending",
        validated: false,
        forwardedToInvestigation: false,
        evidence: [],
        logs: [
            { time: "14 Okt 2026, 15:30", text: "Laporan masuk dalam antrean validasi Satgas.", actor: "Sistem" }
        ]
    }
};

// Sesi Satgas aktif (role-based)
function getSatgasSession() {
    const s = localStorage.getItem('lapor_aman_satgas_session');
    return s ? JSON.parse(s) : null;
}

function setSatgasSession(role, email) {
    localStorage.setItem('lapor_aman_satgas_session', JSON.stringify({ role: role, email: email, loginAt: new Date().toISOString() }));
}

function clearSatgasSession() {
    localStorage.removeItem('lapor_aman_satgas_session');
}

// Ambil semua laporan dari localStorage
function getStorageReports() {
    const stored = localStorage.getItem('lapor_aman_reports');
    if (!stored) {
        localStorage.setItem('lapor_aman_reports', JSON.stringify(defaultReports));
        return defaultReports;
    }
    try {
        return JSON.parse(stored);
    } catch (e) {
        return defaultReports;
    }
}

// Simpan semua laporan ke localStorage
function saveStorageReports(reports) {
    localStorage.setItem('lapor_aman_reports', JSON.stringify(reports));
}

// Helper: format bytes ke bentuk human-readable
function formatBytes(bytes) {
    if (!bytes) return "0 B";
    const k = 1024;
    const sizes = ["B", "KB", "MB", "GB"];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return (bytes / Math.pow(k, i)).toFixed(1) + " " + sizes[i];
}
