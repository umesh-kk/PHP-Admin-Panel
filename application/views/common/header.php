<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Role Model</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <!-- <link href="<?php echo base_url();?>assets/css/sb-admin-2.min.css" rel="stylesheet"> -->
  <link href="<?php echo base_url();?>assets/css/sb-admin-2.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>

  <link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="<?=base_url()?>/favicon.ico" type="image/x-icon"/>
  <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>/favicon-32x32.png"> 
  <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>/favicon-96x96.png"> 
  <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>/favicon-16x16.png"> 



</head>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo ADMIN_URL;?>dashboard" style="background-color: #ffff;color:#234665;">
        <div class="sidebar-brand-icon sidebar-brand-image">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          RM
        </div>
        <div class="sidebar-brand-text mx-1">
          <img src="<?php echo base_url();?>assets/img/logo.png" style="height:60px;">
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ADMIN_URL;?>dashboard">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

     

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo ADMIN_URL;?>users">
          <i class="fas fa-fw fa-users"></i>
          <span>User Management</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo ADMIN_URL?>agents">
          <i class="fas fa-fw fa-user-plus"></i>
          <span>Agent Management</span></a>
      </li> -->

      <li class="nav-item">
        <a class="nav-link" href="<?php echo ADMIN_URL?>lessons">
          <i class="fas fa-fw fa-file"></i>
          <span>Lessons</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo ADMIN_URL?>videos">
          <i class="fas fa-fw fa-video"></i>
          <span>Videos</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo ADMIN_URL?>musics">
          <i class="fas fa-fw fa-music"></i>
          <span>Musics</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo ADMIN_URL?>reports">
          <i class="fa fa-file-alt" aria-hidden="true"></i>
          <span>Reports</span></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo ADMIN_URL?>questions">
          <i class="fa fa-question-circle" aria-hidden="true"></i>
          <span>Questions</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Settings</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Settings:</h6>
            <a class="collapse-item" href="<?php echo ADMIN_URL?>settings/password">Change Password</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
      

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

        
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

         

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a> -->
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
		
        <!-- End of Topbar -->
