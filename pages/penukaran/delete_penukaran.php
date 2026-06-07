<?php
include __DIR__ . '/../koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM penukaran WHERE id_penukaran = $id");

header("Location: index_penukaran.php?status=deleted");
exit;
