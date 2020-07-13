<?php
  require '../function.php';

  $barang = query("SELECT * FROM barang");
?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Barang</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <div class="d-flex justify-content-between align-content-end">
              <span><i class="fas fa-cubes"></i>
              Data Barang</span>
              <a href="index.php?page=tambah_barang" role="button" class="btn btn-outline-info btn-sm"><i class="fas fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Spesifikasi</th>
                    <th>Stock</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach($barang as $row) :
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><img src="../img/<?= $row['gambar']; ?>" alt="" width="100"></td>
                    <td><?= $row['kd_barang']; ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['spek_barang']; ?></td>
                    <td><?= $row['stock']; ?></td>
                    <td><?= $row['harga']; ?></td>
                    <td>
                      <a class="btn btn-outline-primary btn-sm" href="ubah_barang.php?kd_barang=<?= $row['kd_barang']; ?>" role="button"><i class="far fa-fw fa-edit "></i></a>
                      <a class="btn btn-outline-danger btn-sm" href="hapus_barang.php?kd_barang=<?= $row['kd_barang']; ?>" onclick="return confirm('yakin?');" role="button"><i class="far fa-trash-alt fa-fw"></i></a>
                    </td>
                  </tr>
                  <?php
                    $no++;
                    endforeach;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>