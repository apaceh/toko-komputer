<?php
  error_reporting(null);
  session_start();
  if(!isset($_SESSION['id_customer'])){
    header('Location:index.php');
  }

  require 'function.php';
  $id_customer = $_SESSION['id_customer'];

  $data_transaksi = query("SELECT * FROM transaksi, barang WHERE id_customer='$id_customer' AND transaksi.kd_barang=barang.kd_barang");
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
  <title>Struck Pembelian</title>
</head>
<body>
<br><br>
  <div class="container">
    <div class="card border-info">
      <h5 class="card-header text-center">Data Belanjaan</h5>
      <div class="card-body">
          <table class="table table-sm table-hover">
            <thead>
              <tr>
                <th class="text-center" width="50">No</th>
                <th >Gambar</th>
                <th >Nama Barang</th>
                <th >Status</th>
                <th  width="200">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach($data_transaksi as $row) :
                  $total = $total+$row['total'];
              ?>
                <tr>
                  <td scope="row" class="text-center"><?= $no; ?></td>
                  <td><img src="img/<?= $row['gambar']; ?>" alt="" width="50" height="50"></td>
                  <td><?= $row['nama_barang']; ?></td>
                  <td><?= $row['status']; ?></td>
                  <td><?= $row['jumlah']; ?></td>
                </tr>
              <?php
                $no++;
                endforeach;
              ?>            
            <tr>
                  <td scope="row"></td>
                  <td></td>
                  <td></td>
                  <td class="text-right">Total Harga :</td>
                  <td>Rp. <?= number_format($total,0,',','.'); ?> </td>
                </tr>
              </tbody>
          </table>       
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-end align-content-end">
          <a name="lanjut" id="lanjut" class="btn btn-outline-secondary btn-sm mr-2" href="profile.php" role="button">Lanjut Belanja</a>
        </div>
      </div>
    </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jquery/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>