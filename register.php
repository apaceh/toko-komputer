<?php
  require 'function.php';

  if(isset($_POST["register"])){
    if(register($_POST) > 0){
      echo "
        <script>
          alert('Registrasi berhasil!');
          document.location.href='index.php';
        </script>
      ";
    } else {
      echo mysqli_error($koneksi);
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
  <style>
    .container {
      width : 500px;
      height : 500px;
    }
  </style>
  <title>Register</title>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="#">BloBlo</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
<br><br>
  <div class="container">
    <form action="" method="post">
      <div class="form-group row">
        <label for="nama_customer" class="col-sm-4 col-form-label">Nama</label>
        <input type="text" name="nama_customer" id="nama_customer" class="col-sm-8 form-control" required>
      </div>
      <div class="form-group row">
        <label for="username" class="col-sm-4 col-form-label">Email</label>      
        <input type="email" class="col-sm-8 form-control" name="username" id="username" required>
      </div>
      <div class="form-group row">
        <label for="password" class="col-sm-4 col-form-label">Password</label>
        <input type="password" class="col-sm-8 form-control" name="password" id="password" required>
      </div>
      <div class="form-group row">
        <label for="password2" class="col-sm-4 col-form-label">Ulangi Password</label>
        <input type="password" class="col-sm-8 form-control" name="password2" id="password2" required>
      </div>
      <div class="form-group row">
        <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
        <textarea class="col-sm-8 form-control" name="alamat" id="alamat" rows="3" required></textarea>
      </div>
      <div class="form-group row">
        <label for="no_hp" class="col-sm-4 col-form-label">No HP</label>
        <input type="number" class="col-sm-8 form-control" name="no_hp" id="no_hp" required>
      </div>
      
      <button type="submit" class="btn btn-info" name="register">Submit</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      <a name="kembali" id="kembali" class="btn btn-warning" href="index.php" role="button">Kembali</a>
    </div>
  </form>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jquery/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>