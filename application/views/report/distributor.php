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
          <a href="<?php echo site_url('report/printDist') ?>" target="_blank" class="btn btn-sm btn-danger float-right mb-2"><i class="fa fa-print"></i> Eksport</a>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Distributor</th>
                  <th>Tanggal Input</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($distributor)) {
                  $i = 1;
                  foreach ($distributor as $row):
                    ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row->distributor_name ?></td>
                      <td><?php echo $row->distributor_created_at ?></td>
                    </tr>
                    <?php
                  $i++;
                  endforeach;

                } else {
                  ?>
                  <tr id="row">
                    <td colspan="3" align="center">Data Kosong</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>