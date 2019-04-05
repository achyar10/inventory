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
                  <th>Distributor</th>
                  <th>Tanggal Buat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($order)) {
                  $i = $jlhpage+1;
                  foreach ($order as $row):
                    ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $row->order_no_trx ?></td>
                      <td><?php echo $row->distributor_name ?></td>
                      <td><?php echo $row->order_created_at ?></td>
                      <td>
                        <a href="<?php echo site_url('order/detail/'.$row->order_id) ?>" class="btn btn-dark btn-sm">Detail</a>
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
        <h4 class="modal-title" id="formModalLabel">Tambah Pemesanan Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('order/add') ?>" method="post">

          <div class="form-group">
            <label>Distributor</label>
            <select name="distributor_id" class="form-control">
              <option value="">--Pilih Distributor--</option>
              <?php foreach ($dist as $key): ?>
                <option value="<?php echo $key->distributor_id ?>"><?php echo $key->distributor_name ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div id="">
            <table class="table">
              <thead>
                <tr>
                  <th>Nama Barang</th>
                  <th>Stok Saat Ini</th>
                  <th>Jumlah Pesan</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="addRow">
                
              </tbody>
            </table>
            <a href="#" id="addTable"class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> Tambah Barang</a>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="buttonData" class="btn btn-success waves-effect">Proses</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

  $(function() {
    stock('X')
    var table = $('.addRow');
    var i = $('.addRow tr').size() + 1;
    $("#addTable").click(function() {

      $(`<tr>
        <td>
        <select name="item_id[]" class="form-control itemSelect`+i+`">
        <option value="">Pilih Barang</option>
        <?php foreach($item as $row): ?>
          <option value="<?php echo $row['item_id'] ?>"><?php echo $row['item_name'] ?></option>
        <?php endforeach ?>
        </select>
        </td>
        <td class="showStock`+i+`">-</td>
        <td><input class="form-control" name="qty[]" type="number" min="0" value="0"></td>
        <td><a href="#" class="btn btn-danger btn-sm removeTable"><i class="fa fa-times"></i></a></td>
        </tr>
        `).appendTo(table);
      stock(i)

      i++;
      return false;
    });

    function stock(i){
      $(".itemSelect"+i).change(function(){
        var itemID = $(this).val(); 
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo site_url('stock/getItem') ?>",
          data: "item_id="+itemID,
          success: function(response){
            if(itemID != ''){
              $(".showStock"+i).text(response.item_stock);
            } else {
              $(".showStock").text('-');
            }
          }
        });
      });
    }
    $(document).on("click", ".removeTable", function() {
      if (i > 1) {
        $(this).parents('tr').remove();
        i--;
      }
      return false;
    });
  });

</script>