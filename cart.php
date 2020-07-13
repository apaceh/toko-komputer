<?php
  require "function.php";

    session_start();
    if(!isset($_SESSION['id_customer'])){
      echo "
				<script>
					alert('Silahkan login terlebih dahulu!');
					document.location.href = 'index.php';
				</script>
			";
    } else {
    $stock = $_GET['stock'];
    if($stock > 0) {
        $id_customer = $_SESSION['id_customer'];
        $kd_barang = $_GET['kd_barang'];
        $nama_barang = $_GET['nama_barang'];

        //di cek dulu apakah barang yang di beli sudah ada di tabel keranjang
        $sql = mysqli_query($koneksi, "SELECT kd_barang FROM keranjang WHERE kd_barang='$kd_barang' AND id_customer='$id_customer'");
        $hasil=mysqli_num_rows($sql);
        if ($hasil==0){
            // kalau barang belum ada, maka di jalankan perintah insert
          mysqli_query($koneksi, "INSERT INTO keranjang (kd_barang, id_customer, nama_barang, jumlah)
                    VALUES ('$kd_barang', '$id_customer', '$nama_barang', 1)");
          //mysqli_query($koneksi, "UPDATE barang SET jumlah = jumlah-1 WHERE kd_barang='$kd_barang'");
        } else {
            //  kalau barang ada, maka di jalankan perintah update
            mysqli_query($koneksi, "UPDATE keranjang
                    SET jumlah = jumlah + 1
                    WHERE id_customer ='$id_customer' AND kd_barang='$kd_barang'");   
            //mysqli_query($koneksi, "UPDATE barang SET jumlah = jumlah-1 WHERE kd_barang='$kd_barang'");
        }
        header('Location:profile.php');
      } else {
          echo "
            <script>
              alert('Stock barang sudah habis');
              document.location.href='profile.php';
            </script>
          ";
        }
    } 
?>