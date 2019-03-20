<div class="page-breadcrumb">
  <div class="row align-items-center">
    <div class="col-5">
      <h4 class="page-title"><?php echo $title ?></h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card">
        <div class="card-body">
          <center class="m-t-30"> <img src="<?php echo site_url() ?>assets/images/users/1.jpg" class="rounded-circle" width="150" />
            <h4 class="card-title m-t-10"><?php echo $this->session->userdata('full_name'); ?></h4>
            <h6 class="card-subtitle"><?php echo $this->session->userdata('username'); ?></h6>
          </center>
        </div>
        <div>
          <hr> </div>
          <div class="card-body"> 
            <small class="text-muted">Cabang </small>
            <h6>hannagover@gmail.com</h6> 
            <small class="text-muted p-t-30 db">Role</small>
            <h6><?php echo $this->session->userdata('user_role'); ?></h6> 
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal form-material" action="<?php echo site_url('profile') ?>" method="post">
              <div class="form-group">
                <label for="example-email" class="col-md-12">Username</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" id="example-email" readonly="" value="<?php echo $user->user_name ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-12">Nama Lengkap</label>
                <div class="col-md-12">
                  <input type="text" name="user_full_name" placeholder="Nama Lengkap Anda" class="form-control form-control-line" value="<?php echo $user->user_full_name ?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-success">Update Profile</button>
                  <button type="button" data-toogle="modal" class="btn btn-danger">Change Password</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#check').click(function(){
      if(document.getElementById('check').checked) {
        $('#password').get(0).type = 'text';
      } else {
        $('#password').get(0).type = 'password';
      }
    });
  </script>