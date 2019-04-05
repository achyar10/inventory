<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url() ?>assets/images/favicon.png">
  <title><?php echo $title ?></title>
  <!-- Custom CSS -->
  <link href="<?php echo site_url() ?>assets/css/style.min.css" rel="stylesheet">
  <link href="<?php echo site_url() ?>assets/css/noty.css" rel="stylesheet">
  <link href="<?php echo site_url() ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="<?php echo site_url() ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">

  <script src="<?php echo site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo site_url() ?>assets/js/jquery.validate.min.js"></script>
</head>

<body>
  <!-- <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div> -->
  
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
          <a class="navbar-brand" href="<?php echo site_url('/') ?>">
            <!-- Logo icon -->
            <b class="logo-icon">
              <!-- Light Logo icon -->
              <img src="<?php echo site_url() ?>assets/images/logo-safira-full.png" alt="homepage" class="light-logo" height="50" />
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text">
              CV. Safira
           </span>
         </a>
         <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
       </div>
       <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
        <ul class="navbar-nav float-left mr-auto">
        </ul>

        <ul class="navbar-nav float-right">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo site_url() ?>assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
            <div class="dropdown-menu dropdown-menu-right user-dd animated">
              <a class="dropdown-item" href="<?php echo site_url('profile') ?>"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
              <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
            </div>
          </li>

        </ul>
      </div>
    </nav>
  </header>

  <?php $this->load->view('templates/sidebar') ?>

  <div class="page-wrapper">

    <?php isset($main) ? $this->load->view($main) : null ?>

    <footer class="footer text-center">
      Copyright &copy; <?php echo date('Y') ?> All Rights Reserved 
    </footer>
  </div>
</div>

<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo site_url() ?>assets/js/jquery.noty.packaged.min.js"></script>
<script src="<?php echo site_url() ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo site_url() ?>assets/js/jquery-migrate-3.0.0.min.js"></script>
<script src="<?php echo site_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo site_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo site_url() ?>assets/js/app-style-switcher.js"></script>
<!--Wave Effects -->
<script src="<?php echo site_url() ?>assets/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo site_url() ?>assets/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo site_url() ?>assets/js/custom.js"></script>
<script src="<?php echo site_url() ?>assets/js/jquery.dataTables.min.js"></script>

</body>

<script type="text/javascript">
  
  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    autoclose: true, 
    todayHighlight: true,
    format:'yyyy-mm-dd',
    orientation: 'bottom auto'
  });

  <?php if ($this->session->flashdata('success')) { ?>
   $(document).ready(function () {

    noty({
      text        : '<div class="activity-item"> <i class="fa fa-check text-success"></i> <div class="activity"> <?php echo $this->session->flashdata('success') ?> </div> </div>',
      type        : 'success',
      dismissQueue: true,
      progressBar : true,
      timeout     : 5000,
      layout      : 'topRight',
      closeWith   : ['click'],
      theme       : 'relax',
      maxVisible  : 10,
      animation   : {
        open  : 'animated bounceInRight',
        close : 'animated bounceOutRight',
        easing: 'swing',
        speed : 500
      }
    });

  });
 <?php } ?>
 <?php if ($this->session->flashdata('failed')) { ?>
   $(document).ready(function () {

    noty({
      text        : '<div class="activity-item"> <i class="fa fa-window-close text-danger"></i> <div class="activity"> <?php echo $this->session->flashdata('failed') ?> </div> </div>',
      type        : 'failed',
      dismissQueue: true,
      progressBar : true,
      timeout     : 5000,
      layout      : 'topRight',
      closeWith   : ['click'],
      theme       : 'relax',
      maxVisible  : 10,
      animation   : {
        open  : 'animated bounceInRight',
        close : 'animated bounceOutRight',
        easing: 'swing',
        speed : 500
      }
    });

  });
 <?php } ?>
</script>

</html>