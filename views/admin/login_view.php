<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BOMA - Site Administration</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>admintheme/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>admintheme/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>admintheme/css/AdminLTE.css" rel="stylesheet" type="text/css" />
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url(); ?>admin"><b>BOMA </b>Administration</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
                        <form role="form" method="post" action="<?php echo base_url().'admin/verifylogin'; ?>">
        				<?php if(validation_errors()){ ?><span style="color:#FF0000"> <?php echo validation_errors(); ?></span><?php } ?>
						
                        <div class="form-group has-feedback">
                                    <input class="form-control" placeholder="E-mail" name="email" type="text" autofocus>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
          				<div class="form-group has-feedback">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          				</div>
                        <div class="row">
                        <div class="col-xs-8">    
                                                      
                            </div><!-- /.col -->
                            <div class="col-xs-4">
                            	<input type="submit"  class="btn btn-primary btn-block btn-flat" value="Login">
                             
                            </div><!-- /.col -->
                         </div>
                       
                        <input type="hidden" name="do" value="Login" />
                        </form>
                        
                         <a href="#">I forgot my password</a><br>
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url(); ?>admintheme/js/jQuery-2.1.3.min.js"></script>
    <script src="<?php echo base_url(); ?>admintheme/js/jquery-ui-1.10.3.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>admintheme/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>admintheme/js/dashboard.js"></script>
	<script src="<?php echo base_url(); ?>admintheme/js/app.js"></script>
   
  </body>
</html>