<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';

if (!isset($_GET['id_transaksi'])) {
    header("Location: index_setor.php");
    exit;
}

$id = $_GET['id_transaksi'];

$trans = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT t.*, w.nama_warga, p.nama_petugas 
    FROM transaksi_setor t
    LEFT JOIN warga w ON w.id_warga = t.id_warga
    LEFT JOIN petugas p ON p.id_petugas = t.id_petugas
    WHERE t.id_transaksi = $id
"));

$detail = mysqli_query($conn, "
    SELECT d.*, s.nama_sampah, s.kategori
    FROM transaksi_detail d
    LEFT JOIN sampah s ON s.id_sampah = d.id_sampah
    WHERE d.id_transaksi = $id
");
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Detail Transaksi Setor</h2>

    <div class="card-custom">

        <p><strong>ID Transaksi:</strong> <?= $trans['id_transaksi'] ?></p>
        <p><strong>Warga:</strong> <?= $trans['nama_warga'] ?></p>
        <p><strong>Petugas:</strong> <?= $trans['nama_petugas'] ?></p>
        <p><strong>Tanggal:</strong> <?= $trans['tgl_transaksi'] ?></p>
        <p><strong>Total Poin:</strong> <?= number_format($trans['total_poin'], 0) ?></p>

        <hr>

        <h5>Detail Sampah</h5>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Sampah</th>
                    <th>Kategori</th>
                    <th>Berat (kg)</th>
                    <th>Poin</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($d = mysqli_fetch_assoc($detail)): ?>
                <tr>
                    <td><?= $d['nama_sampah'] ?></td>
                    <td><?= $d['kategori'] ?></td>
                    <td><?= $d['berat'] ?></td>
                    <td><?= number_format($d['poin_diperoleh'], 0) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="index_setor.php" class="btn btn-secondary">Kembali</a>

    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
