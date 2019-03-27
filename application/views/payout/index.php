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
    <div class="col-md-5 col-sm-12">
      <div class="card">
          <div class="table-responsive">
            <table class="table">
              <thead class="bg-success text-white">
                <tr>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="addPay">

              </tbody>
            </table>
          </div>
      </div>
    </div>
    <div class="col-md-7 col-sm-12">
      <div class="card">
        <div class="card-body">
          <h4 class="mb-3">Menu</h4>
          <div class="row">
            <?php foreach ($item_branch as $key): ?>
              <div class="col-md-4">
                <div class="card" style="border: 1px #eee solid;">
                  <img class="card-img-top img-responsive" src="<?php echo site_url('uploads/items/'.$key->item_image) ?>" alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title" style="margin-bottom: -2px"><?php echo $key->item_name ?></h4>
                    <p class="card-text" style="margin-bottom: -10px">Rp. <?php echo number_format($key->item_price) ?></p>
                    <hr>
                    <center>
                      <a href="javascript:void(0)" class="btn btn-dark btn-sm btnAdd" data-id="<?php echo $key->item_id ?>">Tambah</a>
                    </center>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#addPay');
    var i = $('#addPay tr').size() + 1;
    $('.btnAdd').click(function(){
      $(`<tr class="showPay"><td>Xiaomi Redmi 3</td><td>1.200.000</td><td><input autofocus type="text" name="qty[]" size="3"></td><td>1.200.000</td><td><a href="#" class="btn btn-danger btn-sm remvBtn"><i class="fa fa-times"></i></a></td></tr>`).appendTo(table);;
      i++;
      return false;
    });

    $(document).on("click", ".remvBtn", function() {
      if (i > 1) {
        $(this).parents('tr').remove();
        i--;
      }
      return false;
    });


  } );
</script>