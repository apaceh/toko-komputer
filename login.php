<?php
  require 'function.php';

  session_start();

  if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM customer WHERE username='$username' AND password='$password'";
    $query = mysqli_query($koneksi,$sql);
    $count = mysqli_num_rows($query);

    if($count == 1){
      $row = mysqli_fetch_array($query);
      $_SESSION['id_customer'] = $row['id_customer'];
      $_SESSION['nama_customer'] = $row['nama_customer'];
      header('location:profile.php');
    }
  }
?>