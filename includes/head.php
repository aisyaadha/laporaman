<?php if (!isset($pageTitle)) $pageTitle = "LaporAman Kampus"; ?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Konfigurasi Tailwind (warna brand & font) -->
    <script src="assets/js/tailwind-config.js"></script>

    <!-- CSS Custom -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-slate-50 text-slate-900 min-h-full flex flex-col selection:bg-brand-blue selection:text-white">