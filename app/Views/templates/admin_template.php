<!DOCTYPE html>
<html>
<?= $this->include('templates/header'); ?>

<body class="hold-transition sidebar-mini layout-fixed mobility_mea">
  <input type="text" id="BASE_URL" hidden name="BASE_URL" value="<?php echo base_url(); ?>">
  <div class="wrapper">
    <?php $BASE_URL = base_url() . "/index.php/"; ?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item text-top">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!--<li class="nav-item text-top">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
        <div class="image">
          <img src="<?= base_url() ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="pull-right">
          <a href="<?php echo base_url(); ?>/logout" class="btn btn-default btn-flat">Sign out</a>
        </div>
      </div>
      </li>-->
        <li>&nbsp;</li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link p-0" data-toggle="dropdown" href="#">
            <!--<i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>-->
            <img src="<?= base_url() ?>/dist/img/user2-160x160.jpg" alt="User Avatar" class="img-size-50 profi_img mr-3 img-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <div class="media-body text-center">
                  <h3 class="dropdown-item-title">
                    <?= $_SESSION['name']; ?>
                  </h3>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <!--  <a href="#" class="dropdown-item">
                  <h3 class="dropdown-item-title">
                    Change password
                  </h3>
            </a> -->
            <div class="dropdown-divider"></div>
            <a href="<?= $BASE_URL . 'logout'; ?>" class="dropdown-item dropdown-footer">Sign out</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= $BASE_URL . 'dashboard'; ?>" class="brand-link">
        <img src="<?= base_url() ?>/dist/img/logo.png" alt="Etisalat" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Etisalat</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) --
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>-->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item active">
              <a href="<?= $BASE_URL . 'dashboard'; ?>" class="nav-link">
                <!--<i class="fas fa-tachometer-alt nav-icon"></i>-->
                <img alt="Dashboard_Management" src="<?= base_url() ?>/dist/img/sidemenu/Dashboard_Management.png" />
                <p>Dashboard</p>
              </a>
            </li>
            <?php if (isset($_SESSION['role_name']) || isset($_SESSION['account-management'])) { ?>
              <li class="nav-item active">
                <a href="<?= $BASE_URL . 'customer/list'; ?>" class="nav-link">
                  <!--<i class="far fa-circle nav-icon"></i>-->
                  <img alt="Dashboard_Management" src="<?= base_url() ?>/dist/img/sidemenu/user_management.png" />
                  <p>Customers</p>
                </a>
              </li>
            <?php } ?>
            <?php if (isset($_SESSION['role_name']) || isset($_SESSION['subscription-management'])) { ?>
              <li class="nav-item active">
                <a href="<?= $BASE_URL . 'subscription/list'; ?>" class="nav-link">
                  <!--<i class="far fa-circle nav-icon"></i>-->
                  <img alt="Dashboard_Management" src="<?= base_url() ?>/dist/img/sidemenu/Subscription_Management.png" />
                  <p>Subscriptions</p>
                </a>
              </li>
            <?php } ?>
            <?php if (isset($_SESSION['role_name']) || isset($_SESSION['role-management'])) { ?>
              <li class="nav-item active">
                <a href="<?= $BASE_URL . 'role/list'; ?>" class="nav-link">
                  <!--<i class="far fa-circle nav-icon"></i>-->
                  <img alt="Dashboard_Management" src="<?= base_url() ?>/dist/img/sidemenu/user_management.png" />
                  <p>User Roles</p>
                </a>
              </li>
            <?php } ?>
            <?php if (isset($_SESSION['account-management'])) { ?>
              <li class="nav-item active">
                <a href="<?= $BASE_URL . 'customer/my_details'; ?>" class="nav-link">
                  <!--<i class="far fa-circle nav-icon"></i>-->
                  <img alt="Dashboard_Management" src="<?= base_url() ?>/dist/img/sidemenu/Dashboard_Management.png" />
                  <p>My details</p>
                </a>
              </li>
            <?php } ?>
            <?php if (isset($_SESSION['role_name']) || isset($_SESSION['reports'])) { ?>
              <li class="nav-item">
                <a href="<?= $BASE_URL . 'report'; ?>" class="nav-link">
                  <!--<i class="fas fa-tachometer-alt nav-icon"></i>-->
                  <img alt="Dashboard_Management" src="<?= base_url() ?>/dist/img/sidemenu/report.png" />
                  <p>Report Management</p>
                </a>
              </li>
            <?php } ?>
            <?php if (isset($_SESSION['role_name']) || isset($_SESSION['campaign-management'])) { ?>
              <li class="nav-item active">
                <a href="http://localhost:3000" class="nav-link" target="_blank">
                  <!--<i class="far fa-circle nav-icon"></i>-->
                  <img alt="Campaign_Management" src="<?= base_url() ?>/dist/img/sidemenu/campaign_management.png" />
                  <p>Campaign Management</p>
                </a>
              </li>
            <?php } ?>
            <!--<li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
            <i class="nav-icon fas fa fa-cog"></i>
              <p>
                Role Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/role/add') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/role/list') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Roles</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-user"></i>
              <p>
                Customer Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/customer/list') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Customer</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-th"></i>
              <p>
                Subscription Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/subscription/list') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Subscription</p>
                </a>
              </li>
            </ul>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/subscription/add') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Subscription</p>
                </a>
              </li>
            </ul>
          </li>-->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <?= $this->renderSection('content') ?>

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <!-- <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div> -->
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!--<?//= $this->include('templates/footer') ?>-->
</body>

</html>