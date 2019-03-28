<div class="page-breadcrumb">
  <div class="row align-items-center">
    <div class="col-5">
      <h4 class="page-title"><?php echo $title ?></h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Transaksi</th>
                  <th>Total Pembelian</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($trx)) {
                  $i = $jlhpage+1;
                  foreach ($trx as $row):
                    ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $row->transaction_no_trx ?></td>
                      <td><?php echo number_format($row->transaction_total_price) ?></td>
                      <td><?php echo $row->transaction_created_at ?></td>
                      <td>
                        <a href="<?php echo site_url('transaction/detail/'.$row->transaction_id) ?>" class="btn btn-dark btn-sm">Detail</a>
                      </td>
                    </tr>
                    <?php
                  endforeach;
                } else {
                  ?>
                  <tr id="row">
                    <td colspan="5" align="center">Data Kosong</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <ul class="pagination">
            <?php echo $this->pagination->create_links(); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>