<?php
$request_uri = $_SERVER['REQUEST_URI'] ?? '';
$base_url = (strpos($request_uri, '/ProjectAkhir') === 0) ? '/ProjectAkhir' : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>EcoWaste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= $base_url ?>/assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- TOP NAVIGATION -->
<nav class="navbar navbar-expand-lg shadow-sm topnav">
    <div class="container-fluid px-4">

        <!-- LOGO -->
        <a class="navbar-brand brand-eco" href="<?= $base_url ?>/pages/dashboard.php">
            EcoWaste
        </a>

        <!-- NAV LINKS -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navEco">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navEco">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 nav-eco-links">

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>/pages/dashboard.php">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>/pages/warga/index_warga.php">Warga</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>/pages/petugas/index_petugas.php">Petugas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>/pages/sampah/index_sampah.php">Sampah</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>/pages/setor/index_setor.php">Transaksi Setor</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>/pages/penukaran/index_penukaran.php">Penukaran</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>/pages/hadiah/index_hadiah.php">Hadiah</a>
                </li>

                <li class="nav-item">
                     <a class="nav-link" href="<?= $base_url ?>/pages/leaderboard/index_leaderboard.php">Leaderboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>/pages/laporan/index_laporan.php">Laporan</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
