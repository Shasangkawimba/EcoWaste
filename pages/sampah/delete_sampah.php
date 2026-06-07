<?php
include __DIR__ . '/../koneksi.php';

if (!isset($_GET['id_sampah'])) {
    header("Location: index_sampah.php");
    exit;
}

$id = (int) $_GET['id_sampah'];

mysqli_query($conn, "DELETE FROM sampah WHERE id_sampah=$id");

header("Location: index_sampah.php");
exit;
