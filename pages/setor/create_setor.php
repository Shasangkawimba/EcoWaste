<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';
?>

<?php
if (isset($_POST['submit'])) {

    $id_warga = $_POST['id_warga'];
    $id_petugas = $_POST['id_petugas'];
    $tanggal = date("Y-m-d");

    mysqli_query($conn, "INSERT INTO transaksi_setor (id_warga, id_petugas, tgl_transaksi, total_poin)
                         VALUES ($id_warga, $id_petugas, '$tanggal', 0)");

    $id_transaksi = mysqli_insert_id($conn);

    $totalPoin = 0;

    foreach ($_POST['id_sampah'] as $i => $id_sampah) {
        $berat = $_POST['berat'][$i];

        // ambil harga per kg
        $s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga_perkg FROM sampah WHERE id_sampah = $id_sampah"));
        $poin = $s['harga_perkg'] * $berat;

        $totalPoin += $poin;

        // insert detail
        mysqli_query($conn, "
            INSERT INTO transaksi_detail (id_transaksi,id_sampah,berat,poin_diperoleh)
            VALUES ($id_transaksi,$id_sampah,$berat,$poin)
        ");
    }

    // update total poin di header transaksi
    mysqli_query($conn, "UPDATE transaksi_setor SET total_poin = $totalPoin WHERE id_transaksi = $id_transaksi");

    // update saldo poin warga
    mysqli_query($conn, "UPDATE poin SET total_poin = total_poin + $totalPoin WHERE id_warga = $id_warga");

    header("Location: index_setor.php?status=success_create");
    exit;
}
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Buat Transaksi Setor</h2>

    <div class="card-custom">

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Warga</label>
                <select name="id_warga" class="form-control" required>
                    <option value="">-- pilih warga --</option>
                    <?php
                    $w = mysqli_query($conn, "SELECT * FROM warga ORDER BY nama_warga");
                    while ($row = mysqli_fetch_assoc($w)):
                    ?>
                    <option value="<?= $row['id_warga'] ?>"><?= $row['nama_warga'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Petugas</label>
                <select name="id_petugas" class="form-control" required>
                    <option value="">-- pilih petugas --</option>
                    <?php
                    $p = mysqli_query($conn, "SELECT * FROM petugas ORDER BY nama_petugas");
                    while ($row = mysqli_fetch_assoc($p)):
                    ?>
                    <option value="<?= $row['id_petugas'] ?>"><?= $row['nama_petugas'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <hr class="my-4">

            <h5 class="fw-bold">Detail Sampah</h5>

            <div id="detail-box">

                <div class="row g-3 mt-2 detail-item">
                    <div class="col-md-4">
                        <label class="form-label">Jenis Sampah</label>
                        <select name="id_sampah[]" class="form-control" required>
                            <?php
                            $s = mysqli_query($conn, "SELECT * FROM sampah ORDER BY nama_sampah");
                            while ($row = mysqli_fetch_assoc($s)):
                            ?>
                            <option value="<?= $row['id_sampah'] ?>"><?= $row['nama_sampah'] ?> (<?= $row['harga_perkg'] ?> poin/kg)</option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Berat (kg)</label>
                        <input type="number" min="0.1" step="0.1" class="form-control" name="berat[]" required>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-detail">Hapus</button>
                    </div>
                </div>

            </div>

            <button type="button" id="add-detail" class="btn btn-outline-success mt-3">+ Tambah Sampah</button>

            <div class="mt-4 text-end">
                <a href="index_setor.php" class="btn btn-secondary">Batal</a>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </div>

        </form>

    </div>

</div>

<script>
// tambah detail
document.getElementById("add-detail").onclick = () => {
    const box = document.getElementById("detail-box");
    const clone = document.querySelector(".detail-item").cloneNode(true);
    clone.querySelector("input").value = "";
    box.appendChild(clone);

    clone.querySelector(".remove-detail").onclick = () => clone.remove();
};

// hapus detail pertama
document.querySelector(".remove-detail").onclick = function() {
    if (document.querySelectorAll(".detail-item").length > 1) {
        this.closest(".detail-item").remove();
    }
};
</script>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
