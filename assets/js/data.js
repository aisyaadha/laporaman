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
        logs: [
            { time: "15 Okt 2026, 10:35", text: "Laporan diterima oleh sistem terenkripsi." },
            { time: "15 Okt 2026, 11:00", text: "Tim Satgas PPKS memverifikasi bukti awal." }
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
        logs: [
            { time: "14 Okt 2026, 15:30", text: "Laporan masuk dalam antrean investigasi keamanan kampus." }
        ]
    }
};

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