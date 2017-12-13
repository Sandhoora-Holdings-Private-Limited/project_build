
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ProjectBuild</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href= "<?php echo base_url(); ?>/assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/AdminLTE.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap-datepicker.min.css">
  <!-- Applying skin-black-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/skin-black.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/select2.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Project</b>Build</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo base_url(); ?>assets/img/avatar5.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"> <?= $user['name'] ?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  <?= $user['name'] ?>
                  <!--small>Member since Nov. 2012</small-->
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <!-- div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <!--div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div-->
                <div class="pull-right">
                  <a href="<?= base_url(); ?>/Main/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li-->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $user['name'] ?></p>
          <!-- Status -->
          <!-- a href="#"><i class="fa fa-circle text-success"></i> Online</a -->
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NEVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Apps</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <?php
        foreach ($apps as $app) {
          echo '<li><a href="'.base_url().'/'.$app['controller_name'].'"><i class="'.$app['icon'].'"></i>'.$app['name'].'</a></li>';
        }
        ?>
          </ul>
        </li>

        <!-- TABS GO HERE -->
        <?php
        //app name as a spearator
        if(isset($page['app_name'])) echo '<li class="header">'.$page['app_name'].'</li>';

        //tabs
        if(isset($tabs)){
          $uri = $_SERVER['REQUEST_URI'];
          $url =  base_url();
          $full_url = $url.substr($uri,1);
          //var_dump( strcmp($murl, 'http://localhost:8001//Project/inventory_dashboard/2') );


          foreach ($tabs as $tab) {
            $active = '';
            $drop_active = '';
            if(isset($tab['next_level']))
            {
              if(isset($tab['active']))
                $drop_active='active menu-open';
              else
                $drop_active='';

              echo '<li class="treeview '.$drop_active.'">';
              echo '<a href="#"><i class="'.$tab['icon'].'"></i> <span>'.$tab['name'].'</span>';
              echo '<span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>';
              echo '<ul class="treeview-menu">';
              foreach ($tab['next_level'] as $tab_2) {
                 if(strcmp($full_url, $tab_2['link']) == 0)
                    $active = 'class="active"';
                else
                    $active = '';
                echo '<li '.$active.'><a href="'.$tab_2['link'].'"><i class="'.$tab_2['icon'].'"></i>'.$tab_2['name'].'</a></li>';
              }
            echo '</ul> </li>';
            }
            else
            {
              if(strcmp($full_url, $tab['link']) == 0)
                $active = 'class="active"';
              else
                $active = '';

              echo '<li '.$active.'><a href="'.$tab['link'].'"><i class="'.$tab['icon'].'"></i> <span>'.$tab['name'].'</span></a></li>';
            }
          }
        }
        ?>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $page['header'] ?>
        <small> <?= $page['description'] ?> </small>
      </h1>
      <!-- ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol -->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
