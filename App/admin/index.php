<?php
session_start();
include("../database/db.php");
if (!isset($_SESSION["admin"])) {
   echo "<script>location='../index.php'</script>";
}
function bruteForceSearch($text, $pattern) {
   $textLength = strlen($text);
   $patternLength = strlen($pattern);
   for ($i = 0; $i <= $textLength - $patternLength; $i++) {
       $j = 0;
       while ($j < $patternLength && $text[$i + $j] == $pattern[$j]) {
           $j++;
       }
       if ($j == $patternLength) {
           return $i;
       }
   }
   return -1;
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
   <title>ADMIN</title>
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
      <a class="navbar-brand ps-3" href="index.php"> ADMIN</a>
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
                  <a class="nav-link aktif" href="index.php">
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
                  <li class="breadcrumb-item active">Daftar Buku</li>
               </ol>
               <div class="">
                  <div class="col-xl-5">
                     <form action="" method="post" class="col-md-12 row">
                        <input type="text" name="findfrombrute" class="ms-3 col-md-7">
                        <input type="submit" name="searchbrute" value="Cari Buku" class="btn btn-sm btn-success col-md-3 ms-2">
                     </form>
                  </div>
                  <?php 
                  
                     if (isset($_POST["searchbrute"])) {
                        $getbrute = $_POST['findfrombrute'];
                        $getbrute_lower = strtolower($getbrute);
                        $booksdata = mysqli_query($conn, "SELECT * FROM buku WHERE LOWER(judul_buku) LIKE '%$getbrute_lower%' OR LOWER(judul_buku) LIKE '$getbrute_lower%' OR LOWER(judul_buku) LIKE '%$getbrute_lower'");
                        
                        if(mysqli_num_rows($booksdata) > 0) {
                           $show = mysqli_fetch_array($booksdata);
                           $findbook = $show['judul_buku'];
                           $findbook_lower = strtolower($findbook);
                           $result = bruteForceSearch($getbrute_lower, $findbook_lower);
                           if ($result != -1) {
                              ?>
                              <div class="col-md-2 mt-3">
                                 <a href="detail.php?id_buku=<?php echo $show['id_buku'] ?>" style="text-decoration: none; color:#000; font-weight:400; font-size:13px" >
                                    <div class="card card-body p-2 shadow-sm mb-3">
                                       <img src="./images/<?php echo $show['gambar_buku'] ?>" style="border-radius: 3px; height:230px;">
                                       <p class="huruf-kecil mt-3 mb-0" style="text-align: center;"><?php echo $show['judul_buku'] ?></p>
                                    </div>
                                 </a>
                              </div>
                              <?php 
                              
                           } else {
                              echo "Buku tidak ditemukan";
                           }
                        }else {
                           echo "Buku tidak ditemukan";
                        }
                     }   
                              
                  ?>
                  <section id="minimal-statistics">
                     <?php
                     $ambil_buku = mysqli_query($conn, "SELECT * FROM buku");
                     ?>
                     <div class="row bg-light pt-2 pb-1">
                        <?php 
                           while($p = mysqli_fetch_array($ambil_buku)){ 
                        ?>
                        <div class="col-md-2 mt-2">
                           <a href="detail.php?id_buku=<?php echo $p['id_buku'] ?>" style="text-decoration: none; color:#000; font-weight:400; font-size:13px" >
                              <div class="card card-body p-2 shadow-sm mb-3">
                                 <img src="./images/<?php echo $p['gambar_buku'] ?>" style="border-radius: 3px; height:180px;">
                                 <p class="huruf-kecil mt-3 mb-0" style="text-align: center;"><?php echo $p['judul_buku'] ?></p>
                              </div>
                           </a>
                        </div>
                        <?php } ?>
                     </div>
                     
                  </section>
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