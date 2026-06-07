<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';

$id = $_GET['id'];
$pesan = "";

$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT p.*, w.nama_warga, t.nama_petugas, h.nama_hadiah
    FROM penukaran p
    LEFT JOIN warga w ON w.id_warga = p.id_warga
    LEFT JOIN petugas t ON t.id_petugas = p.id_petugas
    LEFT JOIN hadiah h ON h.id_hadiah = p.id_hadiah
    WHERE p.id_penukaran = $id
"));

if (!$data) {
    echo "<div class='container mt-5'>Data tidak ditemukan.</div>";
    exit;
}

if (isset($_POST['update'])) {
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE penukaran SET status='$status' WHERE id_penukaran=$id");

    header("Location: index_penukaran.php?status=success_update");
    exit;
}
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Detail Penukaran</h2>

    <div class="card-custom">

        <form method="POST">

            <p><strong>Warga:</strong> <?= $data['nama_warga'] ?></p>
            <p><strong>Petugas:</strong> <?= $data['nama_petugas'] ?></p>
            <p><strong>Hadiah:</strong> <?= $data['nama_hadiah'] ?></p>
            <p><strong>Poin Digunakan:</strong> <?= $data['poin_digunakan'] ?></p>
            <p><strong>Tanggal Penukaran:</strong> <?= $data['tgl_penukaran'] ?></p>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option>Selesai</option>
                    <option <?= $data['status'] == 'Proses' ? 'selected' : '' ?>>Proses</option>
                </select>
            </div>

            <div class="col-12 text-end">
                <a href="index_penukaran.php" class="btn btn-secondary">Batal</a>
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>

        </form>

    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
