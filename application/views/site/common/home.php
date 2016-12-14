<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">    
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <meta name="author" content="">
   <meta name="generator" content="">
  <title>Home Page</title>
  <link rel="shortcut icon" href="<?php echo site_template('images/logo.png'); ?>">
  <link rel="stylesheet" href="<?php echo site_template('css/bootstrap.min.css'); ?>" type="text/css"> 
  <link rel="stylesheet" href="<?php echo site_template('css/font-awesome.min.css'); ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo site_template('css/style.css'); ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo site_template('css/scrolling-nav.css'); ?>" type="text/css">
  <script type="text/javascript" src="<?php echo site_template('javascripts/jquery-min.js'); ?>"></script> 
  <script type="text/javascript" src="<?php echo site_template('javascripts/bootstrap.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo site_template('javascripts/jquery.easing.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo site_template('javascripts/scrolling-nav.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo site_template('javascripts/main.js'); ?>"></script>
   <script type="text/javascript">
$(document).ready(function()
{
// Load captcha image.    
    $( ".captcha-image" ).load( "<?php echo home_url('captcha'); ?>" );    
// Ajax post for refresh captcha image.
    $("a.refresh").click(function() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo home_url('captcha'); ?>",
            success: function(res) {
            if (res)
                {
                    jQuery("div.imagecaptcha").html(res);
                }
            }
        });
    });            
});
</script>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
  <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Snowballworld</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Commission</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!--Intro Section -->
    <header class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                      	<?php $this->load->view('site/common/flashdata'); ?>
                      		<img class="img-responsive" src="<?php echo site_template('images/intro.jpg'); ?>">
                      		<br>Description Website
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal" action="<?php echo home_url('')  ?>" method='post'>
                        <div class="form-group">
                            <label for="alert" class="col-sm-3 control-label"></label>
                      	    <div class="col-sm-9">
                      	     <?php echo form_error('login'); ?>
                      	    </div>
                      	</div>
                      	<div class="form-group">
                      	    <label for="username" class="col-sm-3 control-label">User name</label>
                      		<div class="col-sm-9">
                      		 <?php echo form_error('username'); ?>
                      		    <input type="text" class="form-control" id="username" placeholder="User name" name="username">
                      	    </div>
                      	</div>
                      	<div class="form-group">
                      	    <label for="matkhau" class="col-sm-3 control-label">Password</label>
                      		<div class="col-sm-9">
                      		<?php echo form_error('matkhau'); ?>
                      		  <input type="password" name="matkhau" class="form-control" id="matkhau" placeholder="Password">
                      		</div>
                      	</div>
                      	<div class="form-group">
                      	    <label for="passconf" class="col-sm-3 control-label">Captcha</label>
                      		<div class="col-sm-4">
                         	   <div class="captcha-image span5 imagecaptcha"></div>
                      		</div>
                      		<div class="col-sm-1">
                      		    <a class="refresh" href="javascript:void(0)"><i class="fa fa-refresh" aria-hidden="true"></i></a> 
                      		</div>
                      		<div class="col-sm-4">
                      		    <?php echo form_error('check_captcha'); ?>
                         	   <input type="text" name="captcha_image" class="form-control" placeholder="Captcha">
                         	</div>
                      	</div>
                      	<div class="form-group">
                      	    <div class="col-sm-offset-3 col-sm-9">
                      		  <button type="submit" class="btn btn-primary  btn-lg btn-block">Sign in</button>
                      		</div>
                      	</div>
                      	<hr>	
                      	<div class="form-group">
                      	    <div class="col-sm-offset-3 col-sm-9">
                      	      <a href="<?php echo home_url('signup'); ?>" class="btn btn-success btn-lg btn-block">Sign up</a>
                      	    </div>
                      	</div>
                    </form>
                </div>
             </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive max-height-612" src="<?php echo site_template('images/About.png'); ?>">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <img class="img-responsive max-height-612" src="<?php echo site_template('images/Commistion.png'); ?>">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <img class="img-responsive max-height-612" src="<?php echo site_template('images/man-winner.png')  ?>"></img>
                </div>
            </div>
        </div>
    </section>
</body>
</html>