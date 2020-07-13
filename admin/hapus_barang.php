<?php 	
	require '../function.php';
	session_start();
  if(!isset($_SESSION['id'])){
    header('location:login.php');
  }

	$kd_barang = $_GET["kd_barang"];

	if( hapus_barang($kd_barang) > 0 ){
		echo "
      <script>
        alert('Data berhasil dihapus');
				document.location.href = 'index.php?page=barang';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal dihapus!');
				document.location.href = 'index.php?page=barang';
			</script>
		";
	}
?>