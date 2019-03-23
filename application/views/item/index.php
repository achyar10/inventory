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
                  <th>SKU</th>
                  <th>Nama Barang</th>
                  <th>Cabang</th>
                  <th>Stock</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($item)) {
                  $i = $jlhpage+1;
                  foreach ($item as $row):
                    ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $row->item_sku ?></td>
                      <td><?php echo $row->item_name ?></td>
                      <td><?php echo $row->branch_name ?></td>
                      <td><?php echo $row->item_stock ?></td>
                      <td>
                        <a href="#" class="btn btn-success btn-sm tampilModalUbah" data-toggle="modal" data-target="#formModal" data-id="<?php echo $row->item_id; ?>">Edit</a>
                      </td>
                    </tr>
                    <?php
                  endforeach;
                } else {
                  ?>
                  <tr id="row">
                    <td colspan="6" align="center">Data Kosong</td>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="formModalLabel">Tambah Cabang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form action="<?php echo site_url('item/add') ?>" id="formItem" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label>SKU</label>
            <input type="text" class="form-control" id="item_sku" name="item_sku" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" id="item_name" name="item_name" autocomplete="off">
          </div>

          <div class="form-group">
            <label>Merk</label>
            <input type="text" class="form-control" id="item_merk" name="item_merk" autocomplete="off">
          </div>

          <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" id="item_price" name="item_price" autocomplete="off">
          </div>

          <div class="form-group">
            <label>Cabang</label>
            <select name="branch_id" id="branchSelect" class="form-control">
              <?php foreach ($branch as $key): ?>
                <option value="<?php echo $key->branch_id ?>"><?php echo $key->branch_name ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>Distributor</label>
            <select name="distributor_id" id="distSelect" class="form-control">
              <?php foreach ($distributor as $key): ?>
                <option value="<?php echo $key->distributor_id ?>"><?php echo $key->distributor_name ?></option>
              <?php endforeach ?>
            </select>
  
          </div>
  
          <div class="form-group">
            <label>Foto Barang</label><br>
            <img src="" id="target" class="img-thumbnail" style="height: 250px">
            <input type='file' id="item_image" name="item_image">
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

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#target').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#item_image").change(function() {
    readURL(this);
  });

  $(function(){

    $('.tombolTambahData').on('click', function() {
      $('#formModalLabel').html('Tambah Barang');
      $('.modal-footer button[type=submit]').html('Tambah Data');
      $('#formItem').attr('action', '<?php echo site_url('item/add') ?>');
      $('#item_sku').val('');
      $('#item_name').val('');
      $('#item_merk').val('');
      $('#item_price').val('');
      $('#target').attr('src', '');
      $('#id').val('');
    });

    $('.tampilModalUbah').on('click', function() {

      $('#formModalLabel').html('Ubah Data Barang');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('#formItem').attr('action', '<?php echo site_url('item/edit') ?>');

      const id = $(this).data('id');

      $.ajax({
        url: '<?php echo site_url('item/getUbah') ?>',
        data: {id : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {
          var link = '<?php echo site_url('uploads/items/') ?>'+data.item_image;
          $('#item_sku').val(data.item_sku);
          $('#item_name').val(data.item_name);
          $('#item_merk').val(data.item_merk);
          $('#item_price').val(data.item_price);
          $('#branchSelect').val(data.branch_id);
          $('#distSelect').val(data.distributor_id);
          $('#target').attr('src', link);
          $('#id').val(data.item_id);
        }
      });
    });

  });

</script>