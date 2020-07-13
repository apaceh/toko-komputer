<?php
  error_reporting(null);
  session_start();
  if(!isset($_SESSION['id_customer'])){
    header('location:index.php');
  }

  require "function.php";

  $id_customer = $_SESSION['id_customer'];
  $data_keranjang = query("SELECT *, barang.kd_barang FROM keranjang, barang WHERE id_customer='$id_customer' AND keranjang.kd_barang=barang.kd_barang");
  // cek apakah tombol submit sudah ditekan atau belum
	if( isset($_POST["submit"]) ){
		// cek apakah data berhasil ditambahkan atau tidak
		if ( update_qty($_POST) > 0 ) {
			echo "
        <script>document.location.href='cart_list.php';</script>
      ";
      
		} else {
			echo "
        <div class='alert alert-info alert-dismissible fade show' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            <span class='sr-only'>Close</span>
          </button>
          Jumlah barang tidak diubah.
        </div>
      ";
		}
  }
  
  if(isset($_POST["selesai"])){
    if (selesai_belanja($_POST) > 0 ) {
      echo "
        <script>
          alert('Barang berhasil dipesan');
          document.location.href='pesanan.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('gagal');
        </script>"
      ;
    }
    
  }
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
  <title>Checkout</title>
</head>
<body>
<br><br>
  <div class="container">
    <div class="card border-info">
      <h5 class="card-header text-center">Data Belanjaan</h5>
      <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center" width="50">No</th>
                <th class="text-center" width="400">Nama Barang</th>
                <th class="text-center" width="100">Jumlah</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Sub Total</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $no = 1;
              foreach($data_keranjang as $row) :
                $subtotal = $row['harga']*$row['jumlah'];
                $total = $total + $subtotal;
            ?>
              
                <tr>
                  <td scope="row"><?= $no; ?></td>
                  <form action="" method="post">
                    <input type="hidden" name="kd_barang" value="<?= $row["kd_barang"]; ?>">
                    <input type="hidden" name="id_session" value="<?= $row["id_session"]; ?>">
                    <td>
                      <input type="text" class="form-control form-control-sm" name="nama_barang" id="nama_barang" value="<?= $row["nama_barang"]; ?>" readonly>
                    </td>
                    <td>                    
                      <input type="number" class="form-control form-control-sm" name="jumlah" id="jumlah" value="<?= $row["jumlah"]; ?>" > 
                    </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" name="harga" id="harga" value="Rp. <?= number_format($row["harga"],0,',','.'); ?>" readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" name="subtotal" id="subtotal" value="Rp. <?= number_format($subtotal,0,',','.'); ?>" readonly>
                    </td>
                    <td>
                      <button type="submit" class="btn btn-sm btn-outline-success" name="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                      <a name="" id="" class="btn btn-sm btn-outline-danger" href="cart_delete.php?kd_barang=<?= $row["kd_barang"];?>" onclick="return confirm('yakin?');" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                  </form>
                </tr>
              <?php
                $no++;
                endforeach;
              ?>
                <tr>
                  <td scope="row"></td>
                  <td></td>
                  <td></td>
                  <td class="text-right">Total :</td>
                  <td><input type="text" class="form-control form-control-sm" value="Rp. <?= number_format($total,0,',','.'); ?>" readonly></td>
                  <td></td>
                </tr>
            </tbody>
          </table>
        
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-end align-content-end">
          <a name="lanjut" id="lanjut" class="btn btn-outline-secondary btn-sm mr-2" href="profile.php" role="button">Lanjut Belanja</a>
          <form action="" method="post">
            <button type="submit" class="btn btn-outline-primary btn-sm" name="selesai" id="selesai">Selesai</button>
          </form>
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



