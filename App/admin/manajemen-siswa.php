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


    <a class="navbar-brand ps-3" href="index.php">ADMIN</a>
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
                  <a class="nav-link" href="manajemen-buku.php">
                     <div class="sb-nav-link-icon">
                        <i class="fas fa-address-book"></i>
                     </div>
                     Manajemen Buku
                  </a>
                  <a class="nav-link aktif" href="manajemen-siswa.php">
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
            <li class="breadcrumb-item active">Data Siswa</li>
          </ol>
          <button type="button" class="mb-3 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Tambah Siswa</button>
          <!-- tanggapan -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h6>Tambah Siswa</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                    <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="nis" placeholder="nis">
                          <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="nama" placeholder="Nama">
                          <select name="jenis_kelamin" class="form-control mt-3" id="" required>
                            <option>-- Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
                          <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="kelas" placeholder="Kelas">
                          <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="alamat" placeholder="Alamat">
                          <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="telp_baru" placeholder="nomor telpon">
                          <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="password_baru" placeholder="password">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="regist" value="Simpan">
                  </div>
                </form>
                <?php
                    // include_once("db.php");
                    if (isset($_POST["regist"])) {
                      $nis = $_POST['nis'];
                      $nama = $_POST['nama'];
                      $password_baru = $_POST['password_baru'];
                      $telp_baru = $_POST['telp_baru'];
                      $jenis_kelamin = $_POST['jenis_kelamin'];
                      $kelas = $_POST['kelas'];
                      $alamat = $_POST['alamat'];
                      $cek_regist = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '$nis'");
                      if (mysqli_num_rows($cek_regist) == 0) {
                        $get_regist = mysqli_query($conn, "INSERT INTO siswa VALUE(
                                null,
                                '" . $nis . "',
                                '" . $password_baru . "',
                                '" . $nama . "',
                                '" . $jenis_kelamin . "',
                                '" . $kelas . "',
                                '" . $alamat . "',
                                '" . $telp_baru . "'
                            )");
                        if ($get_regist) {
                          echo '<script>alert("akun berhasil dibuat")</script>';
                        } else {
                          echo '<script>alert("akun gagal dibuat")</script>';
                        }
                      } else {
                        echo '<script>alert("Gagal, akun sudah terdaftar")</script>';
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
                    <th>NIS</th>
                    <th>Password</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $get_siswa = mysqli_query($conn, "SELECT * FROM siswa");
                  while ($p = mysqli_fetch_array($get_siswa)) {
                  ?>
                    <tr style="font-size: 16px;" id="klik-tabel">
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $p['nis']; ?></td>
                      <td><?php echo $p['password']; ?></td>
                      <td><?php echo $p['nama']; ?></td>
                      <td><?php echo $p['jenis_kelamin']; ?></td>
                      <td><?php echo $p['kelas']; ?></td>
                      <td><?php echo $p['alamat']; ?></td>
                      <td><?php echo $p['telp']; ?></td>
                      <td>
                        <a class="btn btn-sm btn-success" href="siswa-edit.php?id_siswa=<?php echo $p['id_siswa'] ?>"><img src="./../icons/pencil-square.svg" alt=""></a>
                        <a class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus data <?php echo $p['nama'] ?>, semua data akan hilang!')" href="delete.php?id_siswa=<?php echo $p['id_siswa'] ?>"><img src="./../icons/trash-fill.svg" alt=""></a>
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