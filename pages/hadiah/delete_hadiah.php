<?php
include __DIR__ . '/../koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM hadiah WHERE id_hadiah = $id");

header("Location: index_hadiah.php?status=deleted");
exit;
