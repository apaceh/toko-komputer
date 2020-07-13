<?php
  session_start();
  if(!isset($_SESSION['id'])){
    header('Location:login.php');
  }

  require '../function.php';

  $kd_barang = $_GET['kd_barang'];

  $barang = query("SELECT * FROM barang WHERE kd_barang='$kd_barang'");

  if(isset($_POST['submit'])){
    if (ubah_barang($_POST) > 0) {
      echo "
        <script>
          alert('Data Berhasil Diubah');
          document.location.href='index.php?page=barang';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data Gagal Diubah');
          document.location.href='index.php?page=barang';
        </script>
      ";
    }
    
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">BloBlo</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
          <span>Hi, <?= $_SESSION['nama']; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">
            <i class="fas fa-fw fa-key" aria-hidden="true"></i>
            <span>Ganti Password</span>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-fw"></i>
            <span>Logout</span>
          </a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=barang">
          <i class="fas fa-fw fa-cubes"></i>
          <span>Barang</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=transaksi">
          <i class="fas fa-fw fa-table"></i>
          <span>Transaksi</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=customer">
          <i class="fas fa-fw fa-users"></i>
          <span>Data Customer</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Barang</li>
          <li class="breadcrumb-item active">Ubah Data Barang</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
              <span><i class="fas fa-cubes"></i>
              Ubah Data Barang</span>
          </div>
          <div class="card-body">
          <?php
            foreach($barang as $row) :
          ?>
            <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="gambarLama" value="<?= $row['gambar']; ?>">
              <div class="form-group row">
                <label for="kd_barang" class="col-md-2 col-form-label-sm">Kode Barang</label>
                <div class="col-md-5">
                  <input type="text" name="kd_barang" id="kd_barang" class="form-control form-control-sm" placeholder="" aria-describedby="helpId" value="<?= $row['kd_barang']; ?>">
                  <small id="helpId" class="text-muted">Masukkan 3 karakter.</small>
                </div>
              </div>
              <div class="form-group row">
                <label for="nama_barang" class="col-md-2 col-form-label-sm">Nama Barang</label>
                <div class="col-md-5">
                  <input type="text" name="nama_barang" id="nama_barang" class="form-control form-control-sm" placeholder="" value="<?= $row['nama_barang']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="spek_barang" class="col-md-2 col-form-label-sm">Spesifikasi</label>
                <div class="col-md-5">
                  <textarea type="text" name="spek_barang" id="spek_barang" class="form-control form-control-sm" rows="3"><?= $row['spek_barang']; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="stock" class="col-md-2 col-form-label-sm">Stock</label>
                <div class="col-md-5">
                  <input type="number" name="stock" id="stock" class="form-control form-control-sm" value="<?= $row['stock']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="harga" class="col-md-2 col-form-label-sm">Harga</label>
                <div class="col-md-5">
                  <input type="number" name="harga" id="harga" class="form-control form-control-sm"  value="<?= $row['harga']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="gambar" class="col-md-2 col-form-label-sm">Gambar</label>
                <div class="col-md-5">
                  <img src="../img/<?= $row['gambar']; ?>" alt="" width="70">
                  <input type="file" class="form-control-file" name="gambar" id="gambar">
                </div>
              </div>
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-5">
                <button type="submit" class="btn btn-outline-primary btn-sm" name="submit"><i class="fas fa-save fa-sm fa-fw"></i> Simpan</button>
                </div>
              </div>
            </form>
            <?php
              endforeach;
            ?>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Alfi Syahri 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Logout" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>

        