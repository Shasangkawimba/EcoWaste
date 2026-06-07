<?php 
include '../../layout/layout.php';
include '../../pages/koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM warga");
?>

<h2 class="fw-bold mb-4">Daftar Warga</h2>

<div class="card-custom">
    <div class="d-flex justify-content-between mb-3">
        <h4>Data Warga Terdaftar</h4>
        <a href="create_warga.php" class="btn btn-success">+ Tambah Warga</a>
    </div>

    <table class="table table-borderless table-hover">
        <thead class="table-success">
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['nama_warga'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['no_hp'] ?></td>
                <td>
                    <a href="update_warga.php?id_warga=<?= $row['id_warga'] ?>" class="btn btn-sm btn-success">Edit</a>
                    <a href="delete_warga.php?id_warga=<?= $row['id_warga'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php include '../../layout/footer.php'; ?>
