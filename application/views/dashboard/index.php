<div class="page-breadcrumb">
  <div class="row align-items-center">
    <div class="col-5">
      <h4 class="page-title"><?php echo $title ?></h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
          <div class="d-md-flex align-items-center">
            <div>
              <h4 class="card-title">Ringkasan Penjualan</h4>
              <h5 class="card-subtitle">Bulan Terakhir</h5>
            </div>
            <div class="ml-auto d-flex no-block align-items-center">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <h1 class="m-b-0 m-t-30">Rp. <?php echo number_format($total_trx) ?></h1>
              <h6 class="font-light text-muted">Transaksi Penjualan</h6>
              <h3 class="m-t-30 m-b-0"><?php echo number_format($total_item) ?></h3>
              <h6 class="font-light text-muted">Barang Terjual</h6>
            </div>
            <div class="col-lg-8">
              <div class="row m-b-0">
                <div class="col-lg-6 col-md-6">
                  <div class="d-flex align-items-center">
                    <div class="m-r-10"><span class="text-orange display-5"><i class="mdi mdi-home-variant"></i></span></div>
                    <div><span>Cabang</span>
                      <h3 class="font-medium m-b-0"><?php echo number_format($total_branch) ?></h3>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="d-flex align-items-center">
                    <div class="m-r-10"><span class="text-cyan display-5"><i class="mdi mdi-star-circle"></i></span></div>
                    <div><span>Referral Earnings</span>
                      <h3 class="font-medium m-b-0">$769.08</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row m-b-0">
                <div class="col-lg-6 col-md-6">
                  <div class="d-flex align-items-center">
                    <div class="m-r-10"><span class="text-info display-5"><i class="mdi mdi-cellphone"></i></span></div>
                    <div><span>Barang</span>
                      <h3 class="font-medium m-b-0"><?php echo number_format($total_item_branch) ?></h3></div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="d-flex align-items-center">
                      <div class="m-r-10"><span class="text-primary display-5"><i class="mdi mdi-currency-usd"></i></span></div>
                      <div><span>Earnings</span>
                        <h3 class="font-medium m-b-0">$23,568.90</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>