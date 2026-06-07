<?php
include __DIR__ . '/../../layout/header.php';
include __DIR__ . '/../koneksi.php';

$pesan = "";

if (isset($_POST['buat'])) {

    $id_warga   = (int)$_POST['id_warga'];
    $id_petugas = (int)$_POST['id_petugas'];
    $id_hadiah  = (int)$_POST['id_hadiah'];

    // Ambil hadiah
    $hadiah = mysqli_fetch_assoc(mysqli_query(
        $conn, "SELECT * FROM hadiah WHERE id_hadiah=$id_hadiah"
    ));

    if (!$hadiah) {
        $pesan = "Hadiah tidak valid.";
    } else {

        // Ambil poin warga
        $poin = mysqli_fetch_assoc(mysqli_query(
            $conn, "SELECT total_poin FROM poin WHERE id_warga=$id_warga"
        ));

        if (!$poin) {
            $pesan = "Warga ini belum memiliki poin.";
        }
        elseif ($hadiah['stok'] <= 0) {
            $pesan = "Stok hadiah sudah habis.";
        }
        elseif ($poin['total_poin'] < $hadiah['poin_dibutuhkan']) {
            $pesan = "Poin warga tidak mencukupi.";
        }
        else {

            // INSERT penukaran
            mysqli_query($conn, "
                INSERT INTO penukaran
                (id_warga, id_petugas, id_hadiah, poin_digunakan, status, tgl_penukaran)
                VALUES
                ($id_warga, $id_petugas, $id_hadiah, {$hadiah['poin_dibutuhkan']}, 'Proses', CURDATE())
            ");

            // Update stok
            mysqli_query($conn, "
                UPDATE hadiah
                SET stok = stok - 1
                WHERE id_hadiah = $id_hadiah
            ");

            // Update poin
            mysqli_query($conn, "
                UPDATE poin
                SET total_poin = total_poin - {$hadiah['poin_dibutuhkan']}
                WHERE id_warga = $id_warga
            ");

            header("Location: index_penukaran.php?status=success_create");
            exit;
        }
    }
}
?>

<div class="container page-container py-4">

    <h2 class="fw-bold mb-4">Buat Penukaran Baru</h2>

    <div class="card-custom">

        <?php if ($pesan): ?>
            <div class="alert alert-danger"><?= $pesan ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Warga</label>
                <select name="id_warga" class="form-select" required>
                    <option value="">Pilih warga</option>
                    <?php
                    $w = mysqli_query($conn, "SELECT * FROM warga");
                    while ($row = mysqli_fetch_assoc($w)):
                    ?>
                        <option value="<?= $row['id_warga'] ?>"><?= $row['nama_warga'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Petugas</label>
                <select name="id_petugas" class="form-select" required>
                    <option value="">Pilih petugas</option>
                    <?php
                    $p = mysqli_query($conn, "SELECT * FROM petugas");
                    while ($row = mysqli_fetch_assoc($p)):
                    ?>
                        <option value="<?= $row['id_petugas'] ?>"><?= $row['nama_petugas'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Hadiah</label>
                <select name="id_hadiah" class="form-select" required>
                    <option value="">Pilih hadiah</option>

                    <?php
                    $h = mysqli_query($conn, "SELECT * FROM hadiah ORDER BY nama_hadiah ASC");
                    while ($row = mysqli_fetch_assoc($h)):
                    ?>
                        <option value="<?= $row['id_hadiah'] ?>">
                            <?= $row['nama_hadiah'] ?> (<?= $row['poin_dibutuhkan'] ?> poin)
                            <?php if ($row['stok'] <= 3): ?> [Stok rendah]
                            <?php endif; ?>
                        </option>
                    <?php endwhile; ?>

                </select>
            </div>

            <div class="mt-4 text-end">
                <a href="index_penukaran.php" class="btn btn-secondary">Batal</a>
                <button type="submit" name="buat" class="btn btn-success">Simpan</button>
            </div>

        </form>

    </div>

</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
