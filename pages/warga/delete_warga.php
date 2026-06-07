<?php 
include '../koneksi.php';
$id = $_GET['id_warga'];

mysqli_query($conn, "DELETE FROM poin WHERE id_warga=$id");
mysqli_query($conn, "DELETE FROM warga WHERE id_warga=$id");

header("Location: index_warga.php");
