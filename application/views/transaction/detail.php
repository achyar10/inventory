<div class="page-breadcrumb">
  <div class="row">
    <div class="col-5 align-self-center">
      <h4 class="page-title"><?php echo $title ?></h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo site_url('transaction') ?>">Menu Transaksi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-body printableArea">
        <h3><span class="pull-right"><?php echo $trx->transaction_no_trx ?></span>
        <a target="_blank" href="<?php echo site_url('transaction/printInv/'.$trx->transaction_id) ?>" class="btn btn-success float-right"><i class="fa fa-print"></i> Cetak</a>
        </h3>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-left">
              <p class="m-t-30"><b>User Input :</b> <?php echo $trx->user_full_name ?></p>
              <p class="m-t-30"><b>Tanggal Pembelian :</b> <i class="fa fa-calendar"></i> <?php echo $trx->transaction_created_at ?></p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive m-t-40" style="clear: both;">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Nama Barang</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Sub Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1; 
                  foreach ($detail as $key): ?>
                    <tr>
                      <td class="text-center"><?php echo $i ?></td>
                      <td><?php echo $key->item_name ?></td>
                      <td class="text-right"><?php echo number_format($key->item_price) ?></td>
                      <td class="text-right"><?php echo $key->qty ?></td>
                      <td class="text-right"><?php echo number_format($key->item_price * $key->qty) ?></td>
                    </tr>
                  <?php 
                  $i++; 
                endforeach ?>
                  <tr class="bg-dark text-white text-center">
                    <td colspan="4">Grand Total</td>
                    <td class="text-right"><?php echo number_format($trx->transaction_total_price) ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>