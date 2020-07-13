<?php
  require '../function.php';

  if(isset($_POST['submit'])){
    if (tambah_barang($_POST) > 0) {
      echo "
        <script>
          alert('Data Berhasil Ditambahkan');
          document.location.href='index.php?page=barang';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data Gagal Ditambahkan');
          document.location.href='index.php?page=barang';
        </script>
      ";
    }
    
  }
?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Barang</li>
          <li class="breadcrumb-item active">Tambah Data Barang</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
              <span><i class="fas fa-cubes"></i>
              Tambah Data Barang</span>
          </div>
          <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group row">
                <label for="kd_barang" class="col-md-2 col-form-label-sm">Kode Barang</label>
                <div class="col-md-5">
                  <input type="text" name="kd_barang" id="kd_barang" class="form-control form-control-sm" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Masukkan 3 karakter.</small>
                </div>
              </div>
              <div class="form-group row">
                <label for="nama_barang" class="col-md-2 col-form-label-sm">Nama Barang</label>
                <div class="col-md-5">
                  <input type="text" name="nama_barang" id="nama_barang" class="form-control form-control-sm" placeholder="">
                </div>
              </div>
              <div class="form-group row">
                <label for="spek_barang" class="col-md-2 col-form-label-sm">Spesifikasi</label>
                <div class="col-md-5">
                  <textarea type="text" name="spek_barang" id="spek_barang" class="form-control form-control-sm" rows="3"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="stock" class="col-md-2 col-form-label-sm">Stock</label>
                <div class="col-md-5">
                  <input type="number" name="stock" id="stock" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-group row">
                <label for="harga" class="col-md-2 col-form-label-sm">Harga</label>
                <div class="col-md-5">
                  <input type="number" name="harga" id="harga" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-group row">
                <label for="gambar" class="col-md-2 col-form-label-sm">Gambar</label>
                <div class="col-md-5">
                  <input type="file" class="form-control-file" name="gambar" id="gambar">
                </div>
              </div>
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-5">
                <button type="submit" class="btn btn-outline-primary btn-sm" name="submit"><i class="fas fa-save fa-sm fa-fw"></i> Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>