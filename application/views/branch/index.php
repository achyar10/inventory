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
          <button type="button" class="btn btn-danger btn-sm float-right mb-3 tombolTambahData" data-toggle="modal" data-target="#formModal"><i class="fa fa-plus"></i> Tambah</button>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Cabang</th>
                  <th>No Telepon</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($branch)) {
                  $i = $jlhpage+1;
                  foreach ($branch as $row):
                    ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $row->branch_name ?></td>
                      <td><?php echo $row->branch_phone ?></td>
                      <td><?php echo $row->branch_address ?></td>
                      <td>
                        <a href="#" class="btn btn-success btn-sm tampilModalUbah" data-toggle="modal" data-target="#formModal" data-id="<?php echo $row->branch_id; ?>">Edit</a>
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

<div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="formModalLabel">Tambah Cabang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('branch/add') ?>" method="post">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label>Nama Cabang</label>
            <input type="text" class="form-control" id="name" name="branch_name" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>No Telepon</label>
            <input type="text" class="form-control" id="tlp" name="branch_phone" autocomplete="off">
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <textarea name="branch_address" class="form-control" id="alamat"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success waves-effect">Tambah Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

  $(function(){

    $('.tombolTambahData').on('click', function() {
      $('#formModalLabel').html('Tambah Cabang');
      $('.modal-footer button[type=submit]').html('Tambah Data');
      $('.modal-body form').attr('action', '<?php echo site_url('branch/add') ?>');
      $('#name').val('');
      $('#tlp').val('');
      $('#alamat').val('');
      $('#id').val('');
    });

    $('.tampilModalUbah').on('click', function() {

      $('#formModalLabel').html('Ubah Data Cabang');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', '<?php echo site_url('branch/edit') ?>');

      const id = $(this).data('id');

      $.ajax({
        url: '<?php echo site_url('branch/getUbah') ?>',
        data: {id : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {
          $('#name').val(data.branch_name);
          $('#tlp').val(data.branch_phone);
          $('#alamat').val(data.branch_address);
          $('#id').val(data.branch_id);
        }
      });
    });

  });

</script>