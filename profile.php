<?php
  session_start();

  if(!isset($_SESSION['id_customer'])){
    header('location:index.php');
  }

  require 'function.php';
  //pagination
  $jumlahDataPerhalaman = 6;
  $jumlahData = count(query("SELECT * FROM barang"));
  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
  $halamanAktif = ( isset($_GET["halaman"]) ? $_GET["halaman"] : 1);
  $awalData = ( $jumlahDataPerhalaman * $halamanAktif ) - $jumlahDataPerhalaman;

  $produk = mysqli_query($koneksi, "SELECT * FROM barang LIMIT $awalData, $jumlahDataPerhalaman");

  if ( isset($_POST["cari"])) {
    $buku = caribuku($_POST["keyword"]);
  }

  $id_customer = $_SESSION['id_customer'];
  $keranjang = query("SELECT * FROM keranjang WHERE id_customer='$id_customer'");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>BloBlo | Toko Komputer</title>
</head>
<body>

  <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">BloBlo</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
      <ul class="navbar-nav mr-2 mt-2 mt-sm-0">
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart" aria-hidden="true"> Keranjang</i></a>
          <div class="dropdown-menu" aria-labelledby="dropdownId">
            <div class="dropdown-item">
              <table class="table table-sm table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>

                <?php 
                  $no = 1;
                  foreach($keranjang as $row) : 
                ?>
                  <tbody>
                    <tr>
                      <td scope="row"><?= $no; ?></td>
                      <td><?= $row["nama_barang"]; ?></td>
                      <td><?= $row["jumlah"]; ?></td>
                    </tr>              
                  </tbody>
                <?php 
                  $no++;
                  endforeach; 
                ?>

              </table>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"> <?= $_SESSION['nama_customer']; ?></i></a>
          <div class="dropdown-menu" aria-labelledby="dropdownId">
            <div class="dropdown-item">
              <a href="cart_list.php"><i class="fa fa-shopping-cart" aria-hidden="true"> Checkout</i></a>
            </div>
            <div class="dropdown-item">
              <a href="pesanan.php"><i class="fa fa-shopping-bag" aria-hidden="true"> Pesanan</i></a>
            </div>
            <div class="dropdown-item">
              <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"> Logout</i></a>
            </div>
          </div>
        </li>        
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2 form-control-sm" type="text" placeholder="Search">
        <button class="btn btn-sm btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>
    </div>
  </nav>

<main>
  
    <div id="demo" class="carousel slide" data-ride="carousel">

      <!-- Indicators -->
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul>
      
      <!-- The slideshow -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/satu.png">
        </div>
        <div class="carousel-item">
          <img src="img/dua.jpg">
        </div>
        <div class="carousel-item">
          <img src="img/tiga.jpg">
        </div>
      </div>
      
      <!-- Left and right controls -->
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
<hr>
  <div class="container">
  <div class="card border-info">
      <h5 class="card-header text-center" style="background-color: #d9edf7;">--Daftar Barang--</h5>
      <div class="card-body">
        <div class="row">
          <?php  foreach($produk as $row ) : ?>
            <div class="col-md-2">
              <div class="card mb-4 shadow-sm">
                <h5 class="card-header small" style="background-color: #d9edf7;"><?= $row["nama_barang"]; ?></h5>
                <div class="card-body">
                  <img class="card-img-top" src="img/<?= $row["gambar"]?>" alt="" width="100" height="100">
                </div>
                <div class="card-footer">
                  <p class="text-center text-muted small">Rp. <?= number_format($row["harga"],0,',','.'); ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-sm btn-outline-success view_data" href="cart.php?kd_barang=<?= $row['kd_barang']; ?>&nama_barang=<?= $row['nama_barang'];?>&stock=<?= $row['stock'];?>" role="button"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                    <button class="btn btn-sm btn-outline-info view_data" href="#" role="button" data-toggle="modal" data-target="#modalQuickView" id="<?= $row["kd_barang"]; ?>"><i class="fa fa-info-circle" aria-hidden="true"></i> Detail</button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="card-footer">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <?php if( $halamanAktif > 1 ) : ?>
                <a class="page-link small" href="?halaman=<?= $halamanAktif - 1; ?>">
                  <span aria-hidden="true">&laquo;</>
                  <span class="sr-only">Previous</span>
                </a>
              <?php endif; ?>
            </li>

            
            <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
              <li class="page-item">
                <?php if( $i == $halamanAktif) : ?>
                  <a class="page-link small" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
            
                <?php else : ?>
                  <a class="page-link small" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
              </li>
            <?php endfor; ?>

            <li class="page-item">
              <?php if( $halamanAktif < $jumlahHalaman ) : ?>
                <a class="page-link small" href="?halaman=<?= $halamanAktif + 1; ?>">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              <?php endif; ?>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</main>
<hr>
<!-- Modal: modalQuickView -->
<div class="modal fade" id="modalQuickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" id="detail">
        
      </div>
    </div>
  </div>
</div>
  <footer class="footer py-3">
    <div class="container">
      <p class="text-muted text-center">Copyright © Alfi Syahri 2019</p>
    </div>
  </footer>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jquery/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
  <script type="text/javascript">
	  $(document).ready(function(){  
      $('.view_data').click(function(){  
          var id = $(this).attr("id");  
          $.ajax({  
                url:"detail.php",  
                method:"post",  
                data:{id:id},  
                success:function(data){  
                    $('#detail').html(data);  
                    $('#modalQuickView').modal("show");  
                }  
          });  
      });  
    });  
  </script>
</body>
</html>