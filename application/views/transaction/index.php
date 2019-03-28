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
      <form action="<?php echo site_url('transaction/process') ?>" method="post">
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
            <tr class="bg-dark text-white">
                <td colspan="3">Grand Total</td>
                <td colspan="2" class="gTotal">0</td>
              </tr>
          </table>
        </div>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda akan melakukan proses transaksi ini ?')">Proses Bayar</button>
      </div>
    </form>
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
                      <a href="javascript:void(0)" class="btn btn-dark btn-sm <?php echo ($key->item_branch_stock == 0) ? '' : 'btnAdd' ?>" data-id="<?php echo $key->item_branch_id ?>">Tambah</a>
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
      const id = $(this).data('id');

      $.ajax({
        url: '<?php echo site_url('transaction/getItem') ?>',
        data: {id : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {

          $(`<tr class="showPay"><td><input type="hidden" name="item_branch_id[]" value="`+data.item_id+`">`+data.item_name+`</td><td><input type="hidden" name="item_price[]" value="`+data.item_price+`">`+number(data.item_price)+`</td><td><input autocomplete="off" type="text" id="qty`+i+`" name="qty[]" size="3"></td><td class="sum`+i+`">0</td><td><a href="#" class="btn btn-danger btn-sm remvBtn"><i class="fa fa-times"></i></a></td></tr>`).appendTo(table);
          var total = 0;
          $(document).on("input", "#qty"+i, function() {
            var qty = $('#qty'+i).val();
            var subt = data.item_price*qty;
            $('.sum'+i).text(number(subt));
          })
        }
      });
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

    function number(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

  } );
</script>