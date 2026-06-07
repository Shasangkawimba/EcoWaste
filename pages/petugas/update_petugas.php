<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';

if (!isset($_GET['id_petugas'])) {
    header("Location: index_petugas.php");
    exit;
}

$id = (int) $_GET['id_petugas'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = $id"));
if (!$data) {
    header("Location: index_petugas.php");
    exit;
}
?>

<div class="container page-container py-4">
    <h2 class="fw-bold mb-4">Edit Petugas</h2>

    <div class="card-custom">
        <form method="POST" class="row g-3">

            <div class="col-12">
                <label class="form-label">Nama Petugas</label>
                <input type="text" name="nama_petugas" class="form-control"
                       value="<?= htmlspecialchars($data['nama_petugas']) ?>" required>
            </div>

            <div class="col-12">
                <label class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control"
                       value="<?= htmlspecialchars($data['jabatan']) ?>" required>
            </div>

            <div class="col-12 text-end">
                <a href="index_petugas.php" class="btn btn-secondary">Batal</a>
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>

        </form>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama_petugas']));
    $jabatan = mysqli_real_escape_string($conn, trim($_POST['jabatan']));

    $sql = "UPDATE petugas SET 
                nama_petugas='$nama', 
                jabatan='$jabatan'
            WHERE id_petugas=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index_petugas.php");
        exit;
    } else {
        echo "<div class='container page-container py-4'><div class='alert alert-danger'>Gagal update: ".mysqli_error($conn)."</div></div>";
    }
}
?>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
