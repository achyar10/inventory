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
                  <th>Nama Distributor</th>
                  <th>Tanggal Input</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($distributor)) {
                  $i = $jlhpage+1;
                  foreach ($distributor as $row):
                    ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $row->distributor_name ?></td>
                      <td><?php echo $row->distributor_created_at ?></td>
                      <td>
                        <a href="#" class="btn btn-success btn-sm tampilModalUbah" data-toggle="modal" data-target="#formModal" data-id="<?php echo $row->distributor_id; ?>">Edit</a>
                      </td>
                    </tr>
                    <?php
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
        <h4 class="modal-title" id="formModalLabel">Tambah Distributor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('distributor/add') ?>" method="post">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label>Nama Distributor</label>
            <input type="text" class="form-control" id="name" name="distributor_name" autocomplete="off" required>
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
      $('#formModalLabel').html('Tambah Distributor');
      $('.modal-footer button[type=submit]').html('Tambah Data');
      $('.modal-body form').attr('action', '<?php echo site_url('distributor/add') ?>');
      $('#name').val('');
      $('#id').val('');
    });

    $('.tampilModalUbah').on('click', function() {

      $('#formModalLabel').html('Ubah Data Distributor');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', '<?php echo site_url('distributor/edit') ?>');

      const id = $(this).data('id');

      $.ajax({
        url: '<?php echo site_url('distributor/getUbah') ?>',
        data: {id : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {
          $('#name').val(data.distributor_name);
          $('#id').val(data.distributor_id);
        }
      });
    });

  });

</script>