<?php
session_start();
include("../database/db.php");
if (!isset($_SESSION["admin"])) {
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
  <title>Perpustakaan | Admin</title>
  <link rel="icon" type="image/png" href="">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/LOGO UNMUL.png" />

  <link href="../css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    #ftz16 {
      font-size: 16px;
    }

    body {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">


    <a class="navbar-brand ps-3" href="index.php"> ADMIN</a>
    <!-- Navbar Brand-->
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
      <i class="fas fa-bars"></i>
    </button>

    <!-- navbar nama -->
    <div class="navbar-nav ps-3 d-md-inline-block form-inline ms-auto" style="color: white; text-decoration: none">
      <p><?php echo "<p>" . $_SESSION['admin']['nama'] . "</p>" ?></p>
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
                  <div class="sb-sidenav-menu-heading">Admin</div>
                  <a class="nav-link" href="index.php">
                     <div class="sb-nav-link-icon">
                        <i class="fas fa-home"></i>
                     </div>
                     Beranda
                  </a>
                  <a class="nav-link aktif" href="manajemen-buku.php">
                     <div class="sb-nav-link-icon">
                        <i class="fas fa-address-book"></i>
                     </div>
                     Manajemen Buku
                  </a>
                  <a class="nav-link" href="manajemen-siswa.php">
                     <div class="sb-nav-link-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                     </div>
                     Manajemen Siswa
                  </a>
               </div>
            </div>
            <div class="sb-sidenav-footer">
               <div class="small">masuk sebagai:</div>
               <h6>Admin</h6>
            </div>
         </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-3">
          <ol class="breadcrumb mb-4 mt-2">
            <li class="breadcrumb-item active">Update Data Buku</li>
          </ol>
          <div class="card">
            <div class="card-body">
              <?php
              if (isset($_GET['id_buku'])) {
                $id_buku = $_GET['id_buku'];
                $edit = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku = '$id_buku'");
                if (mysqli_num_rows($edit) > 0) {
                  while ($row = mysqli_fetch_array($edit)) {
              ?>

                    <form class="row g-3" method="POST" enctype="multipart/form-data">
                      <div class="col-md-6">
                        <label for="" class="form-label-md"><b>Judul</b></label>
                        <input type="text" class="form-control" name="judul_buku" value="<?php echo $row['judul_buku'] ?>" />
                      </div>
                      <div class="col-md-6">
                        <label for="" class="form-label-md"><b>jumlah_buku</b></label>
                        <input type="text" class="form-control" name="jumlah_buku" value="<?php echo $row['jumlah_buku'] ?>" />
                      </div>
                      <div class="col-md-6">
                        <label for="" class="form-label-md"><b>Kategori</b></label>
                        <input type="text" class="form-control" name="kategori_buku" value="<?php echo $row['kategori_buku'] ?>" />
                      </div>
                      <div class="col-md-6">
                        <label for="" class="form-label-md"><b>Barcode ISBN</b></label>
                        <input type="text" class="form-control" name="barcode_isbn" value="<?php echo $row['barcode_isbn'] ?>" />
                      </div>
                      <div class="col-md-6">
                        <label for="" class="form-label-md"><b>Upload Gambar Baru</b></label>
                        <input type="file" class="form-control" name="foto" />
                      </div>
                      <div class="col-md-12">
                        <input type="submit" class="btn btn-success" name="submit" value="Save" />
                      </div>
                    </form>
              <?php }
                }
              } ?>

              <?php
              if (isset($_POST['submit'])) {
                $judul_buku = $_POST['judul_buku'];
                $jumlah_buku = $_POST['jumlah_buku'];
                $kategori_buku = $_POST['kategori_buku'];
                $barcode_isbn = $_POST['barcode_isbn'];
                $filename1 = $_FILES['foto']['name'];

                if($filename1 != null ) {
                  $tmp_name1 = $_FILES['foto']['tmp_name'];
                    $ukuran1 = $_FILES['foto']['size'];
                    $type1 = explode('.', $filename1);
                    $type2 = $type1[1];
                    $newname1 = 'f' . time() . '.' . $type2;
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', '');

                    $dest = "./foto/" . $_FILES['foto']['name'];
                    move_uploaded_file($tmp_name1, './images/' . $newname1);
                  $update = mysqli_query($conn, "UPDATE buku SET
                           judul_buku = '$judul_buku',
                           jumlah_buku = '$jumlah_buku',
                           kategori_buku = '$kategori_buku',
                           gambar_buku = '$newname1',
                           barcode_isbn = '$barcode_isbn'
                           WHERE id_buku = '$id_buku'");
                }else {
                  $update = mysqli_query($conn, "UPDATE buku SET
                           judul_buku = '$judul_buku',
                           jumlah_buku = '$jumlah_buku',
                           kategori_buku = '$kategori_buku',
                           barcode_isbn = '$barcode_isbn'
                           WHERE id_buku = '$id_buku'");
                }
                
                if ($update) {
              ?>
              <?php
                  echo
                  '<script>
                  window.location="manajemen-buku.php";
                  alert("data berhasil diupdate");
                  </script>';
                } else {
                  echo 'gagal ' . mysqli_error($conn);
                }
              }
              ?>

            </div>
          </div>
      </main>
      <footer class="mt-5">
      </footer>
    </div>
  </div>
  <script src="../js/scripts.js"></script>
  <script src="../datatables/datatable.js"></script>
  <script src="../js/datatables-simple-demo.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>