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
        <h3><span class="pull-right"><?php echo $mutation->mutation_no_trx ?></span></h3>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-left">
              <p class="m-t-30"><b>Untuk Cabang :</b> <?php echo $mutation->branch_name ?></p>
              <p class="m-t-30"><b>User Input :</b> <?php echo $mutation->user_full_name ?></p>
              <p class="m-t-30"><b>Status :</b> <?php echo ($mutation->mutation_status) ? 'Diterima' : 'Terkirim' ?></p>
              <p class="m-t-30"><b>Tanggal Kirim :</b> <i class="fa fa-calendar"></i> <?php echo $mutation->mutation_created_at ?></p>
              <p class="m-t-30"><b>Tanggal Terima :</b> <i class="fa fa-calendar"></i> <?php echo ($mutation->mutation_updated_at > 0) ? $mutation->mutation_updated_at : '-' ?></p>
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
          <?php if(!$mutation->mutation_status){ ?>
          <div class="col-md-12">
            <div class="text-right">
              <button class="btn btn-success btn-outline" type="button" data-toggle="modal" data-target="#approve"> <span><i class="fa fa-check"></i> Terima</span> </button>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <div id="approve" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="formModalLabel">Konfirmasi Terima Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('mutation/approve') ?>" method="post">
          <input type="hidden" name="mutation_id" value="<?php echo $mutation->mutation_id ?>">
          <p>Anda akan mengkonfirmasi barang sudah diterima?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success waves-effect">Terima</button>
        </div>
      </form>
    </div>
  </div>
</div>