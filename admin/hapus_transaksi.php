<?php 	
	require '../function.php';
	session_start();
  if(!isset($_SESSION['id'])){
    header('location:login.php');
  }

	$id_transaksi = $_GET["id_transaksi"];

	if( hapus_transaksi($id_transaksi) > 0 ){
		echo "
      <script>
        alert('Data berhasil dihapus');
				document.location.href = 'index.php?page=transaksi';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal dihapus!');
				document.location.href = 'index.php?page=transaksi';
			</script>
		";
	}
?>