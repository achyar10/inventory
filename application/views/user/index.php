<?php 
$roles = ['Super Admin', 'Admin', 'User'];
 ?>

 <style>
   .error{
    color: red !important;
   }
 </style>

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
                  <th>Username</th>
                  <th>Nama Lengkap</th>
                  <th>Cabang</th>
                  <th>Role</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($user)) {
                  $i = $jlhpage+1;
                  foreach ($user as $row):
                    ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $row->user_name ?></td>
                      <td><?php echo $row->user_full_name ?></td>
                      <td><?php echo $row->branch_name ?></td>
                      <td><?php echo $row->user_role ?></td>
                      <td>
                        <?php if ($this->session->userdata('user_id') == $row->user_id){ ?>
                          <a href="<?php echo site_url('profile') ?>" class="btn btn-success btn-sm">Edit</a>
                        <?php } else { ?>
                          <a href="<?php echo site_url('user/edit/'.$row->user_id) ?>" class="btn btn-success btn-sm">Edit</a>
                        <?php } ?>
                        
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="formModalLabel">Tambah Pengguna</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('user/add') ?>" method="post" id="tambahUser">

          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" name="user_name" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" class="form-control" id="passconf" name="passconf" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" id="fullname" name="user_full_name" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>Cabang</label>
            <select name="branch_id" class="form-control">
              <?php foreach ($branch as $key): ?>
                <option value="<?php echo $key->branch_id ?>"><?php echo $key->branch_name ?></option>
              <?php endforeach ?>
            </select>
  
          </div>

          <div class="form-group">
            <label>Role</label>
            <select name="user_role" id="" class="form-control">
              <?php foreach ($roles as $role): ?>
                <option value="<?php echo $role ?>"><?php echo $role ?></option>
              <?php endforeach ?>
            </select>
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
  var validator = $("#tambahUser").validate({
  rules: {
    password: {
      required: true,
      minlength: 6
    },

    passconf: {
      required: true,
      minlength: 6,
      equalTo: "#password"
    }

  },
  messages: {
    password: {
      required: "Password wajib di isi",
      minlength: jQuery.validator.format("Minimal 6 karakter")
    },
    passconf: {
      required: "Konfirmasi password",
      minlength: jQuery.validator.format("Minimal 6 karakter"),
      equalTo: "Password tidak cocok!"
    }
  },
});
</script>