<?php
  require '../function.php';

  $transaksi = query("SELECT * FROM transaksi, barang, customer WHERE transaksi.kd_barang=barang.kd_barang AND transaksi.id_customer=customer.id_customer");

  if( isset($_POST["submit"]) ){
		// cek apakah data berhasil ditambahkan atau tidak
		if ( update_status($_POST) > 0 ) {
			echo "
        <script>document.location.href='index.php?page=transaksi';</script>
      ";
      
		} else {
			echo "
        <div class='alert alert-info alert-dismissible fade show' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            <span class='sr-only'>Close</span>
          </button>
          status transaksi tidak diubah.
        </div>
      ";
		}
  }
?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Transaksi</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Transaksi</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Nama Pemesan</th>
                    <th>Email</th>
                    <th>QTY</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach($transaksi as $row) :
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><img src="../img/<?= $row['gambar']; ?>" alt="" width="100"></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['nama_customer']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['jumlah']; ?></td>
                    <td><?= $row['total']; ?></td>
                    <form action="" method="post">
                    <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi']; ?>">
                      <td>
                        <select name="status" id="status" class="form-control form-control-sm">
                          <?php $dipesan = ''; $dikirim = ''; $selesai='';
                            if($row['status'] == 'Dipesan'){
                              $dipesan = 'selected';
                            } elseif ($row['status'] == 'Dikirim') {
                              $dikirim = 'selected';
                            } elseif ($row['status'] == 'Selesai') {
                              $selesai = 'selected';
                            }
                          ?>
                          <option value="Dipesan" <?= $dipesan; ?>>Dipesan</option>
                          <option value="Dikirim" <?= $dikirim; ?>>Dikirim</option>
                          <option value="Selesai" <?= $selesai; ?>>Selesai</option>
                        </select>
                      </td>
                      <td>
                        <button type="submit" class="btn btn-outline-primary btn-sm" name="submit"><i class="far fa-fw fa-edit"></i></button>
                        <a class="btn btn-outline-danger btn-sm" href="hapus_transaksi.php?id_transaksi=<?= $row['id_transaksi']; ?>" onclick="return confirm('yakin?');" role="button"><i class="far fa-trash-alt fa-fw"></i></a>
                      </td>
                    </form>
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