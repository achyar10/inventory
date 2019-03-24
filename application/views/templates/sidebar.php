<aside class="left-sidebar" data-sidebarbg="skin6">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <!-- User Profile-->
        <li>
          <!-- User Profile-->
          <div class="user-profile d-flex no-block dropdown m-t-20">
            <div class="user-pic"><img src="<?php echo site_url() ?>assets/images/users/1.jpg" alt="users" class="rounded-circle" width="40" /></div>
            <div class="user-content hide-menu m-l-10">
              <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <h5 class="m-b-0 user-name font-medium"><?php echo $this->session->userdata('full_name'); ?> <i class="fa fa-angle-down"></i></h5>
                <span class="op-5 user-email"><?php echo $this->session->userdata('username'); ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                <a class="dropdown-item" href="<?php echo site_url('profile') ?>"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
              </div>
            </div>
          </div>
        </li>
        <li class="p-15 m-t-10"><a href="javascript:void(0)" class="btn btn-block create-btn text-white no-block d-flex align-items-center"><i class="fa fa-plus-square"></i> <span class="hide-menu m-l-5">Create New</span> </a></li>
        <!-- User Profile-->
        <li class="sidebar-item"> 
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo site_url('dashboard') ?>" aria-expanded="false">
            <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
          </a>
        </li>

        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cellphone"></i><span class="hide-menu">Barang </span></a>
          <ul aria-expanded="false" class="collapse  first-level">
            <li class="sidebar-item">
              <a href="<?php echo site_url('item') ?>" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Barang </span></a>
            </li>
            <li class="sidebar-item">
              <a href="<?php echo site_url('stock') ?>" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Stock </span></a>
            </li>
          </ul>
        </li>

        <li class="sidebar-item"> 
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo site_url('branch') ?>" aria-expanded="false">
            <i class="mdi mdi-home-variant"></i><span class="hide-menu">Cabang</span>
          </a>
        </li>

        <li class="sidebar-item"> 
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo site_url('distributor') ?>" aria-expanded="false">
            <i class="mdi mdi-car"></i><span class="hide-menu">Distributor</span>
          </a>
        </li>

        <li class="sidebar-item"> 
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo site_url('user') ?>" aria-expanded="false">
            <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Pengguna</span>
          </a>
        </li>

      </ul>

    </nav>
  </div>
</aside>