<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="UTF-8">
    <title>BOMA - Edmonton | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>admintheme/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>admintheme/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
   <?php /*?> <link rel="stylesheet" href="<?php echo base_url(); ?>admintheme/css/bootstrap-datetimepicker.css" /><?php */?>
   <link rel="stylesheet" href="<?php echo base_url(); ?>admintheme/css/datepicker3.css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>admintheme/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>admintheme/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>admintheme/css/style.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?php echo base_url(); ?>admintheme/js/jQuery-2.1.3.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>admintheme/js/jquery.js"></script> 
    <script  type="text/javascript" src="<?php echo base_url(); ?>js/typeahead.min.js"></script>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>admin" class="logo"><b>BOMA</b>Edmonton</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="<?php echo base_url(); ?>admin" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>admintheme/images/admin.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">Admin BOMA</span>
                </a>
                
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>images/users/admin.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Admin BOMA</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="<?php echo base_url(); ?>admin/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="<?php echo base_url(); ?>admin/home"><i class="fa fa-picture-o"></i> Home Banners</a></li>            
            <li><a href="<?php echo base_url(); ?>admin/menu"><i class="fa fa-sitemap"></i> Manage Menu/Sub-Menu</a></li>
            <li><a href="<?php echo base_url(); ?>admin/board"><i class="fa fa-male"></i> Manage Board Member</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-male"></i> <span>Company Membership</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>admin/membership/approved/"> Approved Members</a></li>
                <li><a href="<?php echo base_url(); ?>admin/membership/pending"> Pending Application</a></li>
                <?php /*?><li><a href="<?php echo base_url(); ?>admin/membership/sub_member"> Sub Members</a></li><?php */?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-clipboard"></i> <span>Job Board</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>admin/jobs/approved"> Posted By Members</a></li>
                <li><a href="<?php echo base_url(); ?>admin/jobs/approved_nonmembers/"> Posted By Non-Members</a></li>
                <li><a href="<?php echo base_url(); ?>admin/jobs/pending"> Pending Members Jobs</a></li>
                <li><a href="<?php echo base_url(); ?>admin/jobs/pending_nonmembers"> Pending Non-Members Jobs</a></li>
                <li><a href="<?php echo base_url(); ?>admin/jobs/add_jobs">Add New Jobs</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-calendar-check-o"></i> <span>Events</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>admin/events/add"> Create New Event</a></li>
                <li><a href="<?php echo base_url(); ?>admin/events/"> View Events</a></li>
                 <li><a href="<?php echo base_url(); ?>admin/events/event_archive"> Events Archives</a></li>
               <!-- <li><a href="<?php //echo base_url(); ?>admin/events/view_registration"> Registrations</a></li>-->
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Courses</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>admin/courses/add"> Create New Course</a></li>
                <li><a href="<?php echo base_url(); ?>admin/courses/"> View Courses</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-building-o"></i> <span>Seminars</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>admin/seminars/add"> Add New Seminar</a></li>
                <li><a href="<?php echo base_url(); ?>admin/seminars/add_event"> Add New Event</a></li>
                <li><a href="<?php echo base_url(); ?>admin/seminars/"> View Seminars/Events</a></li>
                <li><a href="<?php echo base_url(); ?>admin/seminars/view_registration"> Event Registrations</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>admin/services"><i class="fa fa-industry"></i> <span>Service Listing</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-male"></i> <span>News</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>admin/news/add/"> Add News</a></li>
                <li><a href="<?php echo base_url(); ?>admin/news/"> View News</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-newspaper-o"></i> <span>Blogs</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>admin/posts/"> View Blog Post</a></li>
                <li><a href="<?php echo base_url(); ?>admin/tags/">View Blog Tag</a></li>
                
              </ul>
            </li>
             <li class="treeview">
              <a href="<?php echo base_url(); ?>admin/email/">
                <i class="fa fa-envelope"></i> <span>Email</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            
            <li><a href="<?php echo base_url(); ?>admin/homebox/edit/1"><i class="fa fa-industry"></i> <span>Home Content1</span></a></li>
            <li><a href="<?php echo base_url(); ?>admin/homebox/edit/2"><i class="fa fa-industry"></i> <span>Home Content2</span></a></li>
            <!--<li class="treeview">
              <a href="#">
                <i class="fa fa-envelope-o"></i> <span>Email Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"> New Member Registration</a></li>
                <li><a href="#">New Member Invoice</a></li>
                <li><a href="#"> Membership Renewal</a></li>
              </ul>
            </li>-->
            <li><a href="<?php echo base_url(); ?>admin/setting"><i class="fa fa-gear"></i> <span>Account Settings</span></a></li>
            <li><a href="<?php echo base_url(); ?>admin/welcome/logout"><i class="fa fa-power-off"></i> <span>Log Out</span></a></li>
          
        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>     