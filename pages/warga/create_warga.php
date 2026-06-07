<?php 
include '../../layout/layout.php';
include '../koneksi.php';
?>

<h2 class="fw-bold mb-4">Tambah Warga</h2>

<div class="card-custom">

<form method="POST" class="row g-3">

    <div class="col-md-6">
        <label class="form-label">Nama Warga</label>
        <input type="text" class="form-control" name="nama_warga" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">No HP</label>
        <input type="text" class="form-control" name="no_hp" required>
    </div>

    <div class="col-12">
        <label class="form-label">Alamat</label>
        <input type="text" class="form-control" name="alamat" required>
    </div>

    <div class="col-12 text-end">
        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
        <a href="index_warga.php" class="btn btn-secondary">Kembali</a>
    </div>

</form>

</div>

<?php
if (isset($_POST['submit'])) {

    $nama = $_POST['nama_warga'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['no_hp'];

    mysqli_query($conn, "INSERT INTO warga (nama_warga, alamat, no_hp)
                         VALUES ('$nama', '$alamat', '$hp')");

    $idBaru = mysqli_insert_id($conn);
    mysqli_query($conn, "INSERT INTO poin (id_warga, total_poin) VALUES ($idBaru, 0)");

    echo "<script>window.location.href='index_warga.php';</script>";
}
?>

<?php include '../../layout/footer.php'; ?>
