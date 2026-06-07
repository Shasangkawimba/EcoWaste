<?php 
include '../layout/layout.php';
include 'koneksi.php';

// Hitung statistik
$jumlahWarga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM warga"))['total'];
$jumlahSetor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM transaksi_setor"))['total'];
$jumlahPoin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_poin) AS total FROM poin"))['total'];
?>

<h2 class="fw-bold mb-4">Dashboard</h2>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card-custom text-center">
            <h5 class="fw-bold">Total Warga Terdaftar</h5>
            <p class="display-6 text-success"><?= $jumlahWarga ?></p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom text-center">
            <h5 class="fw-bold">Total Transaksi Setor</h5>
            <p class="display-6 text-primary"><?= $jumlahSetor ?></p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom text-center">
            <h5 class="fw-bold">Poin Beredar</h5>
            <p class="display-6 text-warning"><?= $jumlahPoin ? number_format($jumlahPoin, 0) : 0 ?></p>
        </div>
    </div>

</div>

<div class="mt-5">
    <div class="card-custom">
        <h4 class="fw-bold mb-3">Quick Access</h4>
        <div class="d-flex gap-3">
            <a href="warga/index_warga.php" class="btn btn-success">Kelola Warga</a>
            <a href="sampah/index_sampah.php" class="btn btn-success">Kelola Sampah</a>
            <a href="setor/index_setor.php" class="btn btn-success">Transaksi Setor</a>
            <a href="penukaran/index_penukaran.php" class="btn btn-success">Penukaran Poin</a>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>
