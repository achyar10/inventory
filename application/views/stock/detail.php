<div class="page-breadcrumb">
  <div class="row">
    <div class="col-5 align-self-center">
      <h4 class="page-title"><?php echo $title ?></h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
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
        <h3><b>STOK</b> <span class="pull-right"><?php echo $stock->stock_no_trx ?></span></h3>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-left">
              <address>
                <h3> &nbsp;<b class="text-danger"><?php echo $stock->branch_name ?></b></h3>
              </address>
              <p class="m-t-30"><b>User Input :</b> <?php echo $stock->user_full_name ?></p>
              <p class="m-t-30"><b>Tanggal Buat :</b> <i class="fa fa-calendar"></i> <?php echo $stock->stock_created_at ?></p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive m-t-40" style="clear: both;">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Nama Barang</th>
                    <th class="text-right">Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($detail as $key): ?>
                    <tr>
                      <td class="text-center"><?php echo $i ?></td>
                      <td><?php echo $key->item_name ?></td>
                      <td class="text-right"><?php echo $key->qty ?></td>
                    </tr>
                  <?php $i++; endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12">
            <div class="text-right">
              <button id="print" class="btn btn-danger btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>