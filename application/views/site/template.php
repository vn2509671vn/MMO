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
    <link rel="shortcut icon" href="<?php echo site_template('images/logo.png'); ?>" />
     <title>Home Page</title>
    <link href="<?php echo site_template(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo site_template(); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo site_template(); ?>css/manager.css" rel="stylesheet">
    <script src="<?php echo site_template(); ?>javascripts/jquery-min.js"></script>

    <script src="<?php echo site_template(); ?>javascripts/bootstrap.min.js"></script>
    <script src="<?php echo site_template(); ?>javascripts/main.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
               <ul class="sidebar-nav">
                <?php if($check != 0) { ?>
                    <li><a href="<?php echo home_url('infomation'); ?>" >Information</a></li>
                    <li><a href="<?php echo home_url('with-draw-cash'); ?>">Withdraw Cash</a></li>
                    <li><a href="<?php echo home_url('tranfer-history'); ?>">Tranfer History</a></li>
                     <li><a href="<?php echo home_url('income-info'); ?>">Income information</a></li>
                     <li><a href="<?php echo home_url('history-info'); ?>">Bonus from children</a></li>
                     <li><a href="<?php echo (($check == 0) ? '#' : home_url('create-account')); ?>">Create account</a></li>
                <?php } ?>
                <li><a href="<?php echo home_url('active-acount'); ?>">Active Acount</a></li>
                <li><a href="<?php echo home_url('change-password'); ?>">Change Password</a></li>
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
                            <li class="active"><a href="<?php echo home_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
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
                <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> <strong>Hello <?php echo $this->session->userdata('name'); ?></strong>
              </div>
              </div>
              <div class="dashboard">
                <div class="row">
                  <div class="col-md-12">
						<?php  $this->load->view('site/' . $layout); ?>
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
