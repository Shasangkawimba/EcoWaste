<?php
include __DIR__ . '/../koneksi.php';

if (!isset($_GET['id_transaksi'])) {
    header("Location: index_setor.php");
    exit;
}

$id = $_GET['id_transaksi'];

mysqli_query($conn, "DELETE FROM transaksi_detail WHERE id_transaksi = $id");
mysqli_query($conn, "DELETE FROM transaksi_setor WHERE id_transaksi = $id");

header("Location: index_setor.php");
exit;
