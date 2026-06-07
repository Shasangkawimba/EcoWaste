<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Riwayat Penukaran Hadiah</h2>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'success_create'): ?>
            <div class="alert alert-success">Penukaran berhasil dibuat.</div>
        <?php elseif ($_GET['status'] == 'success_update'): ?>
            <div class="alert alert-success">Penukaran berhasil diperbarui.</div>
        <?php elseif ($_GET['status'] == 'deleted'): ?>
            <div class="alert alert-danger">Penukaran berhasil dihapus.</div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Daftar Penukaran</h5>
            <a href="create_penukaran.php" class="btn btn-success">+ Buat Penukaran</a>
        </div>

        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Warga</th>
                    <th>Petugas</th>
                    <th>Hadiah</th>
                    <th>Poin Digunakan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th style="width:150px">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $q = mysqli_query($conn, "
                    SELECT p.*, w.nama_warga, t.nama_petugas, h.nama_hadiah
                    FROM penukaran p
                    LEFT JOIN warga w ON w.id_warga = p.id_warga
                    LEFT JOIN petugas t ON t.id_petugas = p.id_petugas
                    LEFT JOIN hadiah h ON h.id_hadiah = p.id_hadiah
                    ORDER BY p.id_penukaran DESC
                ");

                while ($row = mysqli_fetch_assoc($q)):
                ?>

                <tr>
                    <td><?= $row['id_penukaran'] ?></td>
                    <td><?= $row['nama_warga'] ?></td>
                    <td><?= $row['nama_petugas'] ?></td>
                    <td><?= $row['nama_hadiah'] ?></td>
                    <td><?= number_format($row['poin_digunakan'], 0) ?></td>
                    <td>
                        <?php if ($row['status'] == 'Selesai'): ?>
                            <span class="badge bg-success">Selesai</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Proses</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $row['tgl_penukaran'] ?></td>
                    <td>
                        <a href="update_penukaran.php?id=<?= $row['id_penukaran'] ?>"
                           class="btn btn-sm btn-success">Detail</a>

                        <a href="delete_penukaran.php?id=<?= $row['id_penukaran'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Hapus penukaran ini?')">Hapus</a>
                    </td>
                </tr>

                <?php endwhile; ?>

                <?php if (mysqli_num_rows($q) == 0): ?>
                    <tr><td colspan="8" class="text-center text-muted">Belum ada penukaran.</td></tr>
                <?php endif; ?>

            </tbody>
        </table>

    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
