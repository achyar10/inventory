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
                  <th>No Transaksi</th>
                  <th>Cabang</th>
                  <th>Tanggal Buat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($stock)) {
                  $i = $jlhpage+1;
                  foreach ($stock as $row):
                    ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $row->stock_no_trx ?></td>
                      <td><?php echo $row->branch_name ?></td>
                      <td><?php echo $row->stock_created_at ?></td>
                      <td>
                        <a href="<?php echo site_url('stock/detail/'.$row->stock_id) ?>" class="btn btn-dark btn-sm">Detail</a>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="formModalLabel">Tambah Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('stock/add') ?>" method="post">

          <div class="form-group">
            <label>Cabang</label>
            <select name="branch_id" id="branchSelect" class="form-control">
              <option value="">--- Pilih Cabang ---</option>
              <?php foreach ($branch as $key): ?>
                <option value="<?php echo $key->branch_id ?>"><?php echo $key->branch_name ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="table-responsive" id="tableContainer" style="display: none;">
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

    $("#branchSelect").change(function(){
      var branch_id = $(this).val();
      var str = "";
      $("#branchSelect option:selected").each(function() {
        str += $(this).text();
      });

      $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo site_url('stock/getItem') ?>",
        data: "branch_id="+branch_id,
        success: function(data){
          if(data.branch_id != ''){
          var table = `<table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Barang</th>
                  <th>Stok</th>
                  <th>Quantity</th>
                </tr>
              </thead>`;
              var i = 1;
          $.each(data, function (idx, obj) {                                   
            table += ('<tr>');
            table += ('<td>' + i + '</td>');
            table += ('<td><input type="hidden" name="item_id[]" value="'+ obj.item_id +'">' + obj.item_name + '</td>');
            table += ('<td>' + obj.item_stock + '</td>');
            table += ('<td><input type="number" name="qty[]" class="form-control" value="0"></td>');
            table += ('</tr>');
            i++
          });
          table += '</table>';
          $("#tableContainer").css('display','');
          $("#tableContainer").html(table);
        } else {
          $("#tableContainer").css('display','none');
        }
        }
      })

    });

  });

</script>