<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Data Petugas</h2>

    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Daftar Petugas</h5>
            <a href="create_petugas.php" class="btn btn-success">+ Tambah Petugas</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Nama Petugas</th>
                        <th>Jabatan</th>
                        <th style="width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = mysqli_query($conn, "SELECT * FROM petugas ORDER BY id_petugas DESC");
                    while ($row = mysqli_fetch_assoc($q)):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_petugas']) ?></td>
                        <td><?= htmlspecialchars($row['jabatan']) ?></td>
                        <td>
                            <a href="update_petugas.php?id_petugas=<?= $row['id_petugas'] ?>" class="btn btn-sm btn-success">Edit</a>
                            <a href="delete_petugas.php?id_petugas=<?= $row['id_petugas'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus petugas ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if (mysqli_num_rows($q) == 0): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada data petugas</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
