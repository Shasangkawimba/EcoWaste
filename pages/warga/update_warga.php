<?php 
include '../../layout/layout.php';
include '../koneksi.php';

$id = $_GET['id_warga'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM warga WHERE id_warga=$id"));
?>

<h2 class="fw-bold mb-4">Edit Warga</h2>

<div class="card-custom">

<form method="POST" class="row g-3">

    <div class="col-md-6">
        <label class="form-label">Nama Warga</label>
        <input type="text" class="form-control" name="nama_warga"
               value="<?= $data['nama_warga'] ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">No HP</label>
        <input type="text" class="form-control" name="no_hp"
               value="<?= $data['no_hp'] ?>" required>
    </div>

    <div class="col-12">
        <label class="form-label">Alamat</label>
        <input type="text" class="form-control" name="alamat"
               value="<?= $data['alamat'] ?>" required>
    </div>

    <div class="col-12 text-end">
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index_warga.php" class="btn btn-secondary">Kembali</a>
    </div>

</form>

</div>

<?php
if (isset($_POST['update'])) {

    $nama = $_POST['nama_warga'];
    $hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn,
        "UPDATE warga SET 
        nama_warga='$nama', alamat='$alamat', no_hp='$hp'
        WHERE id_warga=$id"
    );

    echo "<script>window.location.href='index_warga.php';</script>";
}
?>

<?php include '../../layout/footer.php'; ?>
