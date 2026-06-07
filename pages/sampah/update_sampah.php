<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';

if (!isset($_GET['id_sampah'])) {
    header("Location: index_sampah.php");
    exit;
}

$id = (int) $_GET['id_sampah'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sampah WHERE id_sampah=$id"));
if (!$data) {
    header("Location: index_sampah.php");
    exit;
}
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Edit Jenis Sampah</h2>

    <div class="card-custom">
        <form method="POST" class="row g-3">

            <div class="col-md-12">
                <label class="form-label">Nama Sampah</label>
                <input type="text" name="nama_sampah" class="form-control"
                value="<?= htmlspecialchars($data['nama_sampah']) ?>" required>
            </div>

            <div class="col-md-12">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control"
                value="<?= htmlspecialchars($data['kategori']) ?>" required>
            </div>

            <div class="col-md-12">
                <label class="form-label">Poin Per Kg</label>
                <input type="number" name="harga_perkg" class="form-control"
                value="<?= (int)$data['harga_perkg'] ?>" required>
            </div>

            <div class="col-12 text-end">
                <a href="index_sampah.php" class="btn btn-secondary">Batal</a>
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>

        </form>
    </div>

</div>

<?php
if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama_sampah']));
    $kategori = mysqli_real_escape_string($conn, trim($_POST['kategori']));
    $harga = (int) $_POST['harga_perkg'];

    $sql = "UPDATE sampah SET 
                nama_sampah='$nama',
                kategori='$kategori',
                harga_perkg=$harga
            WHERE id_sampah=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index_sampah.php");
        exit;
    } else {
        echo "<div class='alert alert-danger mt-3 container'>Gagal update! ".mysqli_error($conn)."</div>";
    }
}
?>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
