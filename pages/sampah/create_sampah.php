<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Tambah Jenis Sampah</h2>

    <div class="card-custom">
        <form method="POST" class="row g-3">

            <div class="col-md-12">
                <label class="form-label">Nama Sampah</label>
                <input type="text" name="nama_sampah" class="form-control" required>
            </div>

            <div class="col-md-12">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control" placeholder="Plastik / Kertas / Logam / dll" required>
            </div>

            <div class="col-md-12">
                <label class="form-label">Poin Per Kg</label>
                <input type="number" name="harga_perkg" class="form-control" required>
            </div>

            <div class="col-12 text-end">
                <a href="index_sampah.php" class="btn btn-secondary">Batal</a>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </div>

        </form>
    </div>

</div>

<?php
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama_sampah']));
    $kategori = mysqli_real_escape_string($conn, trim($_POST['kategori']));
    $harga = (int) $_POST['harga_perkg'];

    $sql = "INSERT INTO sampah (nama_sampah, kategori, harga_perkg)
            VALUES ('$nama', '$kategori', $harga)";

    if (mysqli_query($conn, $sql)) {
        header("Location: index_sampah.php");
        exit;
    } else {
        echo "<div class='alert alert-danger mt-3 container'>Gagal menyimpan! ".mysqli_error($conn)."</div>";
    }
}
?>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
