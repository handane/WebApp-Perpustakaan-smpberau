<?php
session_start();
include("../database/db.php");
if (!isset($_SESSION["admin"])) {
  echo "<script>location='../index.php'</script>";
}

if (isset($_GET['barcode_isbn'])) {
   $delete_buku = mysqli_query($conn, "DELETE FROM buku WHERE barcode_isbn = '" . $_GET['barcode_isbn'] . "'");
   $delete_pinjaman = mysqli_query($conn, "DELETE FROM peminjaman WHERE barcode_isbn = '" . $_GET['barcode_isbn'] . "'");
   if($delete_buku && $delete_pinjaman){
      echo "<script>window.location='manajemen-buku.php'</script>";
   }
}

if (isset($_GET['id_siswa'])) {
   $delete_siswa = mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa = '" . $_GET['id_siswa'] . "'");
   if($delete_siswa){
      echo "<script>window.location='manajemen-siswa.php'</script>";
   }
}
?>
