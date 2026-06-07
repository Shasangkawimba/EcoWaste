<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Riwayat Setor Sampah</h2>

    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Daftar Transaksi Setor</h5>
            <a href="create_setor.php" class="btn btn-success">+ Buat Transaksi Baru</a>
        </div>

        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Warga</th>
                    <th>Petugas</th>
                    <th>Tanggal</th>
                    <th>Total Poin</th>
                    <th style="width:150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($conn, "
                    SELECT t.*, w.nama_warga, p.nama_petugas
                    FROM transaksi_setor t
                    LEFT JOIN warga w ON w.id_warga = t.id_warga
                    LEFT JOIN petugas p ON p.id_petugas = t.id_petugas
                    ORDER BY t.id_transaksi DESC
                ");

                while ($row = mysqli_fetch_assoc($q)):
                ?>
                <tr>
                    <td><?= $row['id_transaksi'] ?></td>
                    <td><?= $row['nama_warga'] ?></td>
                    <td><?= $row['nama_petugas'] ?></td>
                    <td><?= $row['tgl_transaksi'] ?></td>
                    <td><?= number_format($row['total_poin'], 0) ?></td>
                    <td>
                        <a href="update_setor.php?id_transaksi=<?= $row['id_transaksi'] ?>" class="btn btn-sm btn-success">Detail</a>
                        <a href="delete_setor.php?id_transaksi=<?= $row['id_transaksi'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>

                <?php if (mysqli_num_rows($q) == 0): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada transaksi</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
