<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';
?>

<div class="container page-container py-4">
    <h2 class="fw-bold mb-4">Tambah Petugas</h2>

    <div class="card-custom">
        <form method="POST" class="row g-3">

            <div class="col-md-12">
                <label class="form-label">Nama Petugas</label>
                <input type="text" name="nama_petugas" class="form-control" required>
            </div>

            <div class="col-md-12">
                <label class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control" required>
            </div>

            <div class="col-12 text-end">
                <a href="index_petugas.php" class="btn btn-secondary">Batal</a>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </div>

        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama_petugas']));
    $jabatan = mysqli_real_escape_string($conn, trim($_POST['jabatan']));

    $sql = "INSERT INTO petugas (nama_petugas, jabatan) 
            VALUES ('$nama', '$jabatan')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index_petugas.php");
        exit;
    } else {
        echo "<div class='container page-container py-4'><div class='alert alert-danger'>Gagal: ".mysqli_error($conn)."</div></div>";
    }
}
?>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
