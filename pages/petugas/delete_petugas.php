<?php
include __DIR__ . '/../koneksi.php';

if (!isset($_GET['id_petugas'])) {
    header("Location: index_petugas.php");
    exit;
}

$id = (int) $_GET['id_petugas'];

mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = $id");

header("Location: index_petugas.php");
exit;
