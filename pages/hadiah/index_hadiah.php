<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Daftar Hadiah</h2>

    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Data Hadiah</h5>
            <a href="create_hadiah.php" class="btn btn-success">+ Tambah Hadiah</a>
        </div>

        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Nama Hadiah</th>
                    <th>Poin Dibutuhkan</th>
                    <th>Stok</th>
                    <th style="width:150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hadiah = mysqli_query($conn, "SELECT * FROM hadiah ORDER BY id_hadiah DESC");
                $no = 1;

                while ($h = mysqli_fetch_assoc($hadiah)):
                    // badge stok
                    if ($h['stok'] <= 3) {
                        $badge = "<span class='badge bg-danger'>Hampir Habis</span>";
                    } else if ($h['stok'] <= 10) {
                        $badge = "<span class='badge bg-warning text-dark'>Menipis</span>";
                    } else {
                        $badge = "<span class='badge bg-success'>Aman</span>";
                    }
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $h['nama_hadiah'] ?></td>
                    <td><?= $h['poin_dibutuhkan'] ?></td>
                    <td>
                        <?= $h['stok'] ?> <?= $badge ?>
                    </td>
                    <td>
                        <a href="update_hadiah.php?id=<?= $h['id_hadiah'] ?>" class="btn btn-sm btn-success">Edit</a>
                        <a href="delete_hadiah.php?id=<?= $h['id_hadiah'] ?>"
                           onclick="return confirm('Hapus hadiah ini?')"
                           class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>

                <?php if (mysqli_num_rows($hadiah) == 0): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada hadiah</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
