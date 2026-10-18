<?php
/**
 * ============================================
 * LAPORAMAN KAMPUS - File Utama (Entry Point)
 * ============================================
 */
 $pageTitle = "LaporAman Kampus - Sistem Pelaporan Terenkripsi & Keamanan";

require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <?php
    // ----- Semua halaman (view) dipanggil dari folder /views -----
    include __DIR__ . '/views/beranda.php';
    include __DIR__ . '/views/buat_laporan.php';
    include __DIR__ . '/views/sukses.php';
    include __DIR__ . '/views/lacak_tiket.php';
    include __DIR__ . '/views/login_satgas.php';
    include __DIR__ . '/views/dashboard_satgas.php';
    include __DIR__ . '/views/detail_lacak.php';
    ?>

</main>

<?php
require_once __DIR__ . '/includes/modals.php';
require_once __DIR__ . '/includes/footer.php';
?>