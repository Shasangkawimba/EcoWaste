<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';

// ambil ranking poin terbesar
$q = mysqli_query($conn, "
    SELECT w.nama_warga, p.total_poin
    FROM warga w
    LEFT JOIN poin p ON p.id_warga = w.id_warga
    ORDER BY p.total_poin DESC
    LIMIT 20
");

$ranking = [];
while ($r = mysqli_fetch_assoc($q)) {
    $ranking[] = $r;
}

// data posisi 1,2,3 (kalau ada)
$p1 = $ranking[0] ?? null;
$p2 = $ranking[1] ?? null;
$p3 = $ranking[2] ?? null;
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Leaderboard Warga</h2>

    <div class="row g-3">

        <!-- Posisi 1 -->
        <div class="col-md-4">
            <div class="card card-custom leaderboard-card-1">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Juara 1</h5>
                    <h3 class="fw-bold"><?= $p1['nama_warga'] ?? '-' ?></h3>
                    <p class="text-muted">Poin: <?= $p1['total_poin'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <!-- Posisi 2 -->
        <div class="col-md-4">
            <div class="card card-custom leaderboard-card-2">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Juara 2</h5>
                    <h3 class="fw-bold"><?= $p2['nama_warga'] ?? '-' ?></h3>
                    <p class="text-muted">Poin: <?= $p2['total_poin'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <!-- Posisi 3 -->
        <div class="col-md-4">
            <div class="card card-custom leaderboard-card-3">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Juara 3</h5>
                    <h3 class="fw-bold"><?= $p3['nama_warga'] ?? '-' ?></h3>
                    <p class="text-muted">Poin: <?= $p3['total_poin'] ?? 0 ?></p>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-4">

    <div class="card-custom">
        <h5 class="mb-3">Top 20 Warga</h5>

        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>Rank</th>
                    <th>Nama Warga</th>
                    <th>Total Poin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rank = 1;
                foreach ($ranking as $r):
                ?>
                <tr>
                    <td><?= $rank++ ?></td>
                    <td><?= $r['nama_warga'] ?></td>
                    <td><?= $r['total_poin'] ?></td>
                </tr>
                <?php endforeach; ?>

                <?php if (count($ranking) == 0): ?>
                <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada data poin</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
