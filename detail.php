<?php
  require 'function.php';
  $id = $_POST["id"];
  $detail = query("SELECT * FROM barang WHERE kd_barang='$id'");
  if(isset($_POST["id"])) :
    foreach ($detail as $row) :
?>
        <div class="row">
          <div class="col-sm-5">
            <img src="img/<?= $row['gambar']; ?>" alt="" class="d-block w-100">
          </div>
          <div class="col-sm-7">
            <h2 class="h2-responsive product-name">
              <strong><?= $row['nama_barang']; ?></strong>
            </h2>
            <h4 class="h4-responsive">
              <span class="green-text">
                <strong>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></strong>
              </span>
            </h4>
            <table class="table">
              <tr>
                <th>Spesifikasi</th>
                <td><?= $row['spek_barang']; ?></td>
              </tr>
              <tr>
                <th>Stock</th>
                <td><?= $row['stock']; ?></td>
              </tr>
            </table>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <a class="btn btn-sm btn-outline-success view_data" href="cart.php?kd_barang=<?= $row['kd_barang']; ?>&nama_barang=<?= $row['nama_barang'];?>" role="button"><i class="fa fa-cart-plus" aria-hidden="true"></i> Tambah Ke Keranjang</a>
          </div>
        </div>

<?php
  endforeach;
  endif;
?>