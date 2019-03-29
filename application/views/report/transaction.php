<div class="page-breadcrumb">
  <div class="row align-items-center">
    <div class="col-5">
      <h4 class="page-title"><?php echo $title ?></h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url('/') ?>">Dashboard</a></li>
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
          <form action="<?php echo current_url() ?>" method="get">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Dari Tanggal</label>
                  <input type="text" name="ds" class="form-control datepicker" placeholder="Tanggal Awal" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Sampai Tanggal</label>
                  <input type="text" name="de" class="form-control datepicker" placeholder="Tanggal Akhir" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>&nbsp;</label><br>
                  <button class="btn btn-dark">Filter</button>
                  <?php if ($q) { ?>
                    <a class="btn btn-success" href="<?php echo site_url('report/transaction_export' . '/?' . http_build_query($q)) ?>"><i class="fa fa-file-excel-o" ></i> Export Excel</a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>