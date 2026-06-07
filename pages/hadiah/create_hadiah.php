<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';

$pesan = "";
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_hadiah'];
    $poin = $_POST['poin_dibutuhkan'];
    $stok = $_POST['stok'];

    $q = mysqli_query($conn, "INSERT INTO hadiah (nama_hadiah, poin_dibutuhkan, stok)
                              VALUES ('$nama', '$poin', '$stok')");

    if ($q) {
        header("Location: index_hadiah.php?status=success_create");
        exit;
    } else {
        $pesan = "Gagal menambah hadiah.";
    }
}

?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Tambah Hadiah Baru</h2>

    <div class="card-custom">

        <?php if ($pesan): ?>
            <div class="alert alert-danger"><?= $pesan ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Hadiah</label>
                <input type="text" name="nama_hadiah" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Poin Dibutuhkan</label>
                <input type="number" name="poin_dibutuhkan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <div class="mt-4 text-end">
                <a href="index_hadiah.php" class="btn btn-secondary">Batal</a>
                <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
            </div>
        </form>

    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
