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
   <link rel="shortcut icon" href="<?php echo site_template('images/favicon.ico'); ?>">
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
<body>
<div id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
                <a class="navbar-brand page-scroll" href="<?php echo home_url(); ?>">Home</a>
            </div>
        </div>
        <!-- /.container -->
    </nav>
    
    <!--Intro Section -->
    <header class="intro-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img class="img-responsive" src="<?php echo site_template('images/intro.jpg'); ?>">
					<br>
				</div>
			<div class="col-md-6">
				<form class="form-horizontal" action="" method="post">
				  <div class="form-group">  
				    <label for="hoten" class="col-sm-3 control-label">Name</label>
				    <div class="col-sm-9">
		    			<?php echo form_error('hoten'); ?>	
				      <input type="text" class="form-control" id="hoten" name="hoten" placeholder="Name" value="<?php echo set_value('hoten'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="username" class="col-sm-3 control-label">User name</label>
				    <div class="col-sm-9">
		 			  <?php echo form_error('username'); ?>
				      <input type="text" class="form-control" id="username" placeholder="User name" name="username" value="<?php echo set_value('username'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="sodienthoai" class="col-sm-3 control-label">Phone number</label>
				    <div class="col-sm-9">
		 			  <?php echo form_error('sodienthoai'); ?>
				      <input type="text" class="form-control" id="sodienthoai" placeholder="Phone number" name="sodienthoai" value="<?php echo set_value('sodienthoai'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="email" class="col-sm-3 control-label">Email</label>
				    <div class="col-sm-9">
		 			  <?php echo form_error('email'); ?>
				      <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="diachibitcoin" class="col-sm-3 control-label">Bitcoin address</label>
				    <div class="col-sm-9">
		 			  <?php echo form_error('diachibitcoin'); ?>
				      <input type="text" class="form-control" id="diachibitcoin" name="diachibitcoin" placeholder="Bitcoin address" value="<?php echo set_value('diachibitcoin'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="password" class="col-sm-3 control-label">Password</label>
				    <div class="col-sm-9">
		 			  <?php echo form_error('password'); ?>
				      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="passconf" class="col-sm-3 control-label">Confirm password</label>
				    <div class="col-sm-9">
		 			  <?php echo form_error('passconf'); ?>
				      <input type="password" class="form-control" id="passconf" name="passconf" placeholder="Confirm password" value="<?php echo set_value('passconf'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="countries" class="col-sm-3 control-label">Countries</label>
				    <div class="col-sm-9">
		 			  <?php echo form_error('quocgia'); ?>
		 			  <select name="quocgia" class="form-control">
		 			  <?php foreach($countries as $c) { ?>
		 			  	<option value="<?php echo $c['name']; ?>" <?php echo ($this->input->post('quocgia') == $c['name'] ? 'selected' : ''); ?>><?php echo $c['name']; ?></option>
		 			  	<?php } ?>
		 			  </select>
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
				      <button type="submit" class="btn btn-primary btn-lg btn-block">Sign up</button>
				    </div>
				  </div>
				  <hr>
				  <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-9">
				      <a href="<?php echo home_url(); ?>" class="btn btn-success  btn-lg btn-block">Sign in</a>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</header>
</div>
</body>
</html>