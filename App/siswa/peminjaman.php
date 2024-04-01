<?php
session_start();
include("../database/db.php");
if (!isset($_SESSION["siswa"])) {
   echo "<script>location='../index.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="description" content="" />
   <meta name="author" content="" />
   <title>PERPUSTAKAAN</title>
   <link rel="icon" type="image/png" href="../foto/tut wuri.png">
   <link href="../css/styles.css" rel="stylesheet" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
   <style>
      #ftz16 {
         font-size: 16px;
      }

      body {
         background-color: #f1f1f1;
      }

      .bg-greenyellow {
         background-color: #63dd60;
      }

      .badges {
         padding: 2px 10px 0 10px;
         font-weight: bold;
      }

      .pesan {
         font-size: 7pt;
         border-radius: 10px;
         background-color: #3ba539;
         color: white;
         margin-left: 0;
         width: 50px;
      }

      .isi-pesan p {
         margin: 0;
      }

      .bungkus-atas {
         display: flex;
         justify-content: space-between;
      }

      .tooltips button {
         padding: 0 0 0 0;
         margin: 0;
      }
   </style>
</head>

<body class="sb-nav-fixed">
   <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand ps-3" href="index.php"> PERPUSTAKAAN</a>
      <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
         <i class="fas fa-bars"></i>
      </button>
      <!-- navbar nama -->
      <div class="navbar-nav ps-3 d-md-inline-block form-inline ms-auto" style="color: white; text-decoration: none">
         <p><?php echo "<p>" . $_SESSION['siswa']['nama'] . "</p>" ?></p>
      </div>
      <!-- navbar icon  -->
      <ul class="navbar-nav me-0 me-md-3 my-2 my-md-0">
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
               <li><a class="dropdown-item" href="#">Profil</a></li>
               <li>
                  <hr class="dropdown-divider" />
               </li>
               <li><a href="logout.php" class="dropdown-item">logout</a></li>
            </ul>
         </li>
      </ul>
   </nav>
   <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
         <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
               <div class="nav">
                  <div class="sb-sidenav-menu-heading">Menu</div>
                  <a class="nav-link" href="index.php">
                     <div class="sb-nav-link-icon">
                        <i class="fas fa-home"></i>
                     </div>
                     Beranda
                  </a>
                  <a class="nav-link" href="riwayat-peminjaman.php">
                     <div class="sb-nav-link-icon">
                        <i class="fas fa-address-book"></i>
                     </div>
                     Riwayat Peminjaman
                  </a>
               </div>
            </div>
            <div class="sb-sidenav-footer">
               <div class="small">masuk sebagai:</div>
               <h6>Siswa</h6>
            </div>
         </nav>
      </div>
      <div id="layoutSidenav_content">
         <main>
            <div class="container-fluid px-3">
               <ol class="breadcrumb mb-4 mt-2">
                  <li class="breadcrumb-item active">Peminjaman Buku</li>
               </ol>
               <div class="card card-body col-xl-4">
                  <form action="" method="POST">
                     <div class="form-outline mb-4">
                        <input type="text" id="typeEmailX-2" class="form-control form-control-lg" name="barcode_isbn" placeholder="Kode Buku" required />
                     </div>
                     <div class="login">
                        <button class="btn btn-warning form-control btn-block" name="submit" type="submit">Submit</button><br>
                     </div>
                  </form>
                  <?php
                    // include_once("db.php");
                    if (isset($_POST["submit"])) {
                      $nis_peminjam = $_SESSION['siswa']['nis'];
                      $nama_peminjam = $_SESSION['siswa']['nama'];
                      $barcode_isbn = $_POST['barcode_isbn'];
                      $tanggal_pinjam = date('d-m-Y');
                      $tanggal_kembali = date('d-m-Y', strtotime('+7 day'));
                      $telpon_peminjam = $_SESSION['siswa']['telp'];

                      $cek_peminjaman = mysqli_query($conn, "SELECT * FROM peminjaman WHERE barcode_isbn = '$barcode_isbn'");
                      $cek_buku = mysqli_query($conn, "SELECT * FROM buku WHERE barcode_isbn = '$barcode_isbn'");
                      if (mysqli_num_rows($cek_peminjaman) == 0) {
                        if (mysqli_num_rows($cek_buku) > 0) {
                           $set_peminjaman = mysqli_query($conn, "INSERT INTO peminjaman VALUE(
                                 null,
                                 '" . $barcode_isbn . "',
                                 '" . $nis_peminjam . "',
                                 '" . $nama_peminjam . "',
                                 '" . $tanggal_pinjam . "',
                                 '" . $tanggal_kembali . "',
                                 '" . $telpon_peminjam . "')");
                           if ($set_peminjaman) {
                              echo '<script>alert("data peminjaman buku berhasil dibuat")</script>';
                           } else {
                              echo '<script>alert("gagal, buku gagal di buat")</script>';
                           }
                      } else {
                        echo '<script>alert("Gagal, buku tidak ada")</script>';
                      }
                    } else {
                     echo '<script>alert("Gagal, buku sudah dipinjam sebelumnya")</script>';
                     }
                  }
                    ?>
               </div>
         </main>
         <footer class="mt-5">
         </footer>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
   <script src="../js/scripts.js"></script>
   <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
   <script>
      ClassicEditor
         .create(document.querySelector('#editor'))
         .catch(error => {
            console.error(error);
         });
   </script>
   <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
   </script>

</body>

</html>