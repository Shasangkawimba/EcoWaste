<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';

$id = $_GET['id'];
$pesan = "";

$hadiah = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hadiah WHERE id_hadiah = $id"));

if (!$hadiah) {
    echo "<div class='container mt-5'><h3>Hadiah tidak ditemukan.</h3></div>";
    exit;
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama_hadiah'];
    $poin = $_POST['poin_dibutuhkan'];
    $stok = $_POST['stok'];

    $q = mysqli_query($conn, "UPDATE hadiah SET
                              nama_hadiah='$nama',
                              poin_dibutuhkan='$poin',
                              stok='$stok'
                              WHERE id_hadiah=$id");

    if ($q) {
        header("Location: index_hadiah.php?status=success_update");
        exit;
    } else {
        $pesan = "Gagal mengupdate data.";
    }
}

?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Edit Hadiah</h2>

    <div class="card-custom">

        <?php if ($pesan): ?>
            <div class="alert alert-danger"><?= $pesan ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Nama Hadiah</label>
                <input type="text" class="form-control" name="nama_hadiah"
                       value="<?= $hadiah['nama_hadiah'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Poin Dibutuhkan</label>
                <input type="number" class="form-control" name="poin_dibutuhkan"
                       value="<?= $hadiah['poin_dibutuhkan'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" class="form-control" name="stok"
                       value="<?= $hadiah['stok'] ?>" required>
            </div>

            <div class="col-12 text-end">
                <a href="index_hadiah.php" class="btn btn-secondary">Batal</a>
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>

        </form>

    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
