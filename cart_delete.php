<?php 	
	require 'function.php';
	session_start();
  if(!isset($_SESSION['id_customer'])){
    header('location:index.php');
  }

	$kd_barang = $_GET["kd_barang"];

	if( delete_cart($kd_barang) > 0 ){
		echo "
			<script>
				document.location.href = 'cart_list.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal dihapus!');
				document.location.href = 'cart_list.php';
			</script>
		";
	}
?>