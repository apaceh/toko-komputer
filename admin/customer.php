<?php
  require '../function.php';

  $customer = query("SELECT * FROM customer");
?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Data Customer</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            Data Customer</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach($customer as $row) :
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row['nama_customer']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td><?= $row['no_hp']; ?></td>
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