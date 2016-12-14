<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="Quản lý cafe">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo site_template('images/icon/ico.ico'); ?>" />
     <title>Home Page</title>
    <link href="<?php echo site_template(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo site_template(); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo site_template(); ?>css/jquery-ui.min.css" rel="stylesheet">
    <link href="<?php echo site_template(); ?>css/manager.css" rel="stylesheet">

    <script src="<?php echo site_template(); ?>javascripts/jquery-min.js"></script>

    <script src="<?php echo site_template(); ?>javascripts/bootstrap.min.js"></script>
    <script src="<?php echo site_template(); ?>javascripts/jquery-ui.min.js"></script>
    <script src="<?php echo site_template(); ?>javascripts/main.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li><a href="<?php echo admin_url('approve-register'); ?>">Approve register</a></li>
                <li><a href="<?php echo admin_url('approve-withdraw'); ?>">Approve withdraw</a></li>
                <li><a href="<?php echo admin_url('user-list'); ?>">User list</a></li>
                 <li><a href="<?php echo admin_url('lock-account'); ?>">Lock Account</a></li>
                <li><a href="<?php echo admin_url('change-password'); ?>">Change password</a></li>
            </ul>
        </div>
            <nav class="navbar navbar-top navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".top-menu">
                            <span class="sr-only">Menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="#menu-toggle" class="navbar-brand" id="menu-toggle"><i class="fa fa-tachometer" aria-hidden="true"></i> Menu</a>
                    </div>
                    <div class="collapse navbar-collapse top-menu">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?php echo admin_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="<?php echo home_url('logout')?>">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
               <div class="menu-control">
                <div class="box-controll">
                <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> <strong>Hello <?php echo $this->session->userdata('info_login'); ?></strong>
              </div>
              </div>
              <div class="dashboard">
                <div class="row">
                  <div class="col-md-12">
						<?php  $this->load->view('admin/' . $layout); ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
     </div>
  </div>
</div>
</body>
</html>
