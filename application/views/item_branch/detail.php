<div class="page-breadcrumb">
  <div class="row">
    <div class="col-5 align-self-center">
      <h4 class="page-title"><?php echo $title ?></h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo site_url('item_branch') ?>">Barang</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h3><?php echo $item_branch->item_name ?></h3>
      <div class="row">
        <div class="col-md-4">
          <img src="<?php echo site_url('uploads/items/'.$item_branch->item_image) ?>" class="img-thumbnail" alt="">
        </div>
        <div class="col-md-8">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <td>Cabang</td>
                <td>:</td>
                <td><?php echo $item_branch->branch_name ?></td>
              </tr>
              <tr>
                <td>SKU</td>
                <td>:</td>
                <td><?php echo $item_branch->item_sku ?></td>
              </tr>
              <tr>
                <td>Harga</td>
                <td>:</td>
                <td>Rp. <?php echo number_format($item_branch->item_price) ?></td>
              </tr>
              <tr>
                <td>Stok</td>
                <td>:</td>
                <td><?php echo $item_branch->item_branch_stock ?></td>
              </tr>
              <tr>
                <td>Distributor</td>
                <td>:</td>
                <td><?php echo $item_branch->distributor_name ?></td>
              </tr>
              <tr>
                <td>Tanggal Terakhir Update</td>
                <td>:</td>
                <td><?php echo $item_branch->item_branch_updated_at ?></td>
              </tr>
            </table>
            <a href="<?php echo site_url('item_branch') ?>" class="btn btn-secondary btn-sm">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>