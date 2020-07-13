<?php
  $koneksi = mysqli_connect("localhost", "root", "", "toko_komputer");

  function query($query){
		global $koneksi;
		$result = mysqli_query($koneksi, $query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($result) ) {
			$rows[] = $row;
		}
		return $rows;
  }

  //register-customer
  function register($data){
    global $koneksi;
    
    $nama_customer = $_POST["nama_customer"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];

    //cek username sudah ada atau belom
    $cek = mysqli_query($koneksi, "SELECT username FROM customer WHERE username = '$username'");
    if ( mysqli_fetch_assoc($cek) ) {
      echo "
            <script>
              alert('Email sudah digunakan');
            </script>
          ";
      
			return false;
    }

    //cek konfirmasi password
    if($password != $password2){
      echo "
            <script>
              alert('password tidak sesuai');
            </script>
          ";
    }

    //enkripsi password
    $password = md5($password);

    //tambah ke table
    mysqli_query($koneksi, "INSERT INTO customer VALUES('','$nama_customer','$username','$password','$alamat','$no_hp')");
    return mysqli_affected_rows($koneksi);
  }

  //update field pada keranjang dan barang jika qty bertambah
  function update_qty($data){
    global $koneksi;

    $kd_barang = htmlspecialchars($data["kd_barang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);

    $query = "UPDATE keranjang SET jumlah = '$jumlah' WHERE kd_barang='$kd_barang'";
            
		mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);
  }

  //hapus field pada table keranjang
  function delete_cart($kd_barang){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM keranjang WHERE kd_barang='$kd_barang'");
    return mysqli_affected_rows($koneksi);
  }

  //selesai belanja
  function selesai_belanja($data){
    global $koneksi;
    $id_customer = $_SESSION['id_customer'];

    $query_keranjang = query("SELECT *, barang.kd_barang FROM keranjang, barang WHERE id_customer='$id_customer' AND keranjang.kd_barang=barang.kd_barang");
    foreach($query_keranjang as $row){
      $kd_barang = $row['kd_barang'];
      $nama_customer = $_SESSION['nama_customer'];
      $id_customer = $_SESSION['id_customer'];
      $nama_barang = $row['nama_barang'];
      $status = "Dipesan";
      $jumlah = $row['jumlah'];
      $subtotal = $row['harga']*$jumlah;
      $total = $total + $subtotal;

      $query_transaksi = "INSERT INTO transaksi VALUES('', '$kd_barang', '$id_customer', '$nama_customer', '$nama_barang', '$status', '$jumlah', '$total')";
      mysqli_query($koneksi, $query_transaksi);

      //query update stock barang
      $query_barang = "UPDATE barang SET stock=stock-$jumlah WHERE kd_barang='$kd_barang'";
      mysqli_query($koneksi, $query_barang);
    }

    //query hapus data keranjang berdasarkan id session
    $query_keranjang2 = "DELETE FROM keranjang WHERE id_customer='$id_customer'";
    mysqli_query($koneksi, $query_keranjang2);

    return mysqli_affected_rows($koneksi);
  }

  //hapus field pada table barang
  function hapus_barang($kd_barang){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM barang WHERE kd_barang='$kd_barang'");
    return mysqli_affected_rows($koneksi);
  }

  //hapus field pada table transaksi
  function hapus_transaksi($id_transaksi){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'");
    return mysqli_affected_rows($koneksi);
  }

  //tambah data barang
  function tambah_barang($data){
    global $koneksi;

    $kd_barang = htmlspecialchars($data['kd_barang']);
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $spek_barang = htmlspecialchars($data['spek_barang']);
    $stock = htmlspecialchars($data['stock']);
    $harga = htmlspecialchars($data['harga']);

    // upload gambar
		$gambar = upload();
		if( !$gambar ) {
			return false;
		}

		// query insert data
		$query = "INSERT INTO barang
						VALUES
					('$kd_barang', '$nama_barang', '$spek_barang', '$gambar', '$stock', '$harga')
				";
		mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);
	}

	// fungsi upload
	function upload() {
		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name'];

		// cek apakah tidak ada gambar yang diupload
		if( $error === 4 ){
			echo "
				<script>
					alert('pilih gambar terlebih dahulu');
				</script>
				";
			return false;
		}

		// cek gambar atau bukan yang diupload
		$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
			echo "
				<script>
					alert('yang anda upload bukan gambar');
				</script>
				";
			return false;
		}

		// cek ukuran file
		if( $ukuranFile > 1000000){
			echo "
				<script>
					alert('ukuran gambar terlalu besar');
				</script>
				";
			return false;
		}

		// lolos pengecekan, gambar siap diupload
		// generate nama gambar baru
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensiGambar;
		
		move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

		return $namaFileBaru;
  }
  
  // fungsi ubah barang
	function ubah_barang($data){
		global $koneksi;

	// ambil data dari tiap elemen dalam form
    $kd_barang = htmlspecialchars($data['kd_barang']);
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $spek_barang = htmlspecialchars($data['spek_barang']);
    $stock = htmlspecialchars($data['stock']);
    $harga = htmlspecialchars($data['harga']);
		$gambarLama = htmlspecialchars($data["gambarLama"]);
		
		// cek apakah user pilih gambar baru atau tidak
		if( $_FILES['gambar']['error'] === 4 ) {
			$gambar = $gambarLama;
		} else {
			$gambar = upload();
		}
		

		// query insert data
		$query = "UPDATE barang SET
						kd_barang = '$kd_barang',
						nama_barang = '$nama_barang',
						spek_barang = '$spek_barang',
						gambar = '$gambar',
						stock = '$stock',
						harga = '$harga'
					WHERE kd_barang = '$kd_barang'
				";
		mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);

  }
  
  //update status transaksi oleh admin
  function update_status($data){
    global $koneksi;

    $id_transaksi = htmlspecialchars($data["id_transaksi"]);
    $status = htmlspecialchars($data["status"]);

    $query = "UPDATE transaksi SET status = '$status' WHERE id_transaksi = '$id_transaksi'";
            
		mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);
  }
?>