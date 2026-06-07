<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Data Jenis Sampah</h2>

    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Daftar Sampah</h5>
            <a href="create_sampah.php" class="btn btn-success">+ Tambah Sampah</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Nama Sampah</th>
                        <th>Kategori</th>
                        <th>Poin / Kg</th>
                        <th style="width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = mysqli_query($conn, "SELECT * FROM sampah ORDER BY id_sampah DESC");
                    while ($row = mysqli_fetch_assoc($q)):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_sampah']) ?></td>
                        <td><?= htmlspecialchars($row['kategori']) ?></td>
                        <td><?= number_format($row['harga_perkg']) ?></td>
                        <td>
                            <a href="update_sampah.php?id_sampah=<?= $row['id_sampah'] ?>" class="btn btn-sm btn-success">Edit</a>
                            <a href="delete_sampah.php?id_sampah=<?= $row['id_sampah'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data sampah ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                    <?php if (mysqli_num_rows($q) == 0): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada data sampah</td>
                    </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>

    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
