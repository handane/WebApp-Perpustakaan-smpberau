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
            <li class="breadcrumb-item active">Data Buku</li>
          </ol>
          <button type="button" class="mb-3 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Tambah Buku</button>
          <!-- tanggapan -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h6>Tambah Buku</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="judul_buku" placeholder="Judul Buku">
                      <input type="number" class="form-control mt-3" id="recipient-name" autocomplete="off" name="jumlah_buku" placeholder="Jumlah Buku">
                      <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="kategori_buku" placeholder="kategori buku">
                      <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="barcode_isbn" placeholder="barcode isbn">
                      <input type="file" class="form-control mt-3" id="recipient-name" autocomplete="off" name="foto" placeholder="Upload Gambar">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="regist" value="Simpan">
                  </div>
                </form>
                <?php
                // include_once("db.php");
                if (isset($_POST["regist"])) {
                  $judul_buku = $_POST['judul_buku'];
                  $jumlah_buku = $_POST['jumlah_buku'];
                  $kategori_buku = $_POST['kategori_buku'];
                  $barcode_isbn = $_POST['barcode_isbn'];
                  $cek_regist = mysqli_query($conn, "SELECT * FROM buku WHERE barcode_isbn = '$barcode_isbn'");
                  if (mysqli_num_rows($cek_regist) == 0) {
                    $filename1 = $_FILES['foto']['name'];
                    $tmp_name1 = $_FILES['foto']['tmp_name'];
                    $ukuran1 = $_FILES['foto']['size'];
                    $type1 = explode('.', $filename1);
                    $type2 = $type1[1];
                    $newname1 = 'f' . time() . '.' . $type2;
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', '');

                    $dest = "./foto/" . $_FILES['foto']['name'];
                    move_uploaded_file($tmp_name1, './images/' . $newname1);

                    $get_regist = mysqli_query($conn, "INSERT INTO buku VALUE(
                                null,
                                '" . $judul_buku . "',
                                '" . $jumlah_buku . "',
                                '" . $kategori_buku . "',
                                '" . $newname1 . "',
                                '" . $barcode_isbn . "'
                            )");
                    if ($get_regist) {
                      echo '<script>alert("buku berhasil ditambahkan")</script>';
                    } else {
                      echo '<script>alert("buku gagal ditambahkan")</script>';
                    }
                  } else {
                    echo '<script>alert("Gagal, buku atau kode isbn sudah terdaftar")</script>';
                  }
                }
                ?>
              </div>
            </div>
          </div>
          <div class="card">  
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
                  <tr style="font-size: 16px;">
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul Buku</th>
                    <th>Jumlah buku</th>
                    <th>Kategori Buku</th>
                    <th>Kode ISBN</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $get_buku = mysqli_query($conn, "SELECT * FROM buku");
                  while ($p = mysqli_fetch_array($get_buku)) {
                  ?>
                    <tr style="font-size: 16px;" id="klik-tabel">
                      <td><?php echo $no++; ?></td>
                      <td><img src="./images/<?= $p['gambar_buku'] ?>" alt="" width="70px;" height="70px;"></td>
                      <td><?php echo $p['judul_buku']; ?></td>
                      <td><?php echo $p['jumlah_buku']; ?></td>
                      <td><?php echo $p['kategori_buku']; ?></td>
                      <td><?php echo $p['barcode_isbn']; ?></td>
                      <td>
                        <a class="btn btn-sm btn-success" href="buku-edit.php?id_buku=<?php echo $p['id_buku'] ?>"><img src="./../icons/pencil-square.svg" alt="edit"></a>
                        <a class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus data <?php echo $p['judul_buku'] ?>, semua data akan hilang!')" href="delete.php?barcode_isbn=<?php echo $p['barcode_isbn']; ?>"><img src="./../icons/trash-fill.svg" alt="delete"></a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
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