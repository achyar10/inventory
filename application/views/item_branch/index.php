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
            <table id="dataTable" class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>SKU</th>
                  <th>Nama Barang</th>
                  <th>Stock</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  foreach ($item_branch as $row):
                    ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row->item_sku ?></td>
                      <td><?php echo $row->item_name ?></td>
                      <td><?php echo $row->item_branch_stock ?></td>
                      <td>
                        <a href="<?php echo site_url('item_branch/detail/'.$row->item_branch_id) ?>" class="btn btn-dark btn-sm">Detail</a>
                      </td>
                    </tr>
                    <?php $i++;
                  endforeach;
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>



