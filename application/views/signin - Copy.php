
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>HBL</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo base_url();?>css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?php echo base_url();?>css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url();?>css/font-awesome.css" rel="stylesheet"> 
<script src="<?php echo base_url();?>js/jquery.min.js"> </script>
<script src="<?php echo base_url();?>js/bootstrap.min.js"> </script>
</head>
<style type="text/css">
	.login-bottom {
	    width: 40%;
	    margin: 3em auto;
	    background-color: #00958f;
	}
	.login-mail {
    border: 1px solid #E9E9E9;
    margin-bottom: 2em;
    background: #fff;
	}
	.login-do input[type="submit"] {
    border: none;
    background: #5f5d5d !important;
	}

	label{
		color:#fff;
		font-weight: 100;
	}

</style>

<body>
	<div class="login">
		<h1 ><a href=""><img src="<?php echo base_url();?>images/logo.png" style=" width: 300px; margin-bottom: -45px; margin-top: -65px"> </a></h1>
		<div class="login-bottom">
			<h2 style=" text-align: center; color: #fff; ">Welcome to E-SERVICES PORTAL</h2>
	<form method="post" action="<?php echo base_url().'Customer/check_login' ?>">

			<div class="col-md-12">
				<label>Folio Number</label>

				<div class="login-mail">
					<input type="text" name="folio" placeholder="" required=""  >
					<i class="fa fa-envelope"></i>
				</div>
				<label>Password</label>

				<div class="login-mail">
					<input type="password" name="pass" placeholder="" required="" >
					<i class="fa fa-lock"></i>
				</div>
				 <!--  <a class="news-letter " href="#">
						 <label class="checkbox1"><input type="checkbox" name="checkbox" ><i> </i>Forget Password</label>
					</a>-->	

			
			</div>
			<div class="col-md-6 login-do">
				<label class="hvr-shutter-in-horizontal login-sub">
					<input type="submit" value="login" >
					</label>
			</div>
			
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>
		<!---->
<div class="copy-right">
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
</body>
</html>

