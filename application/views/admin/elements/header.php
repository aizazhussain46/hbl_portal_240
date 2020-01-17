<?php
if (empty($_SESSION['Email'])){
     redirect('Admin');
}
$sessionid= $_SESSION['Email'];

?>
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
<style type="text/css">
	.navbar-header {
    display: none;
}
</style>
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
<!-- Mainly scripts -->
<script src="<?php echo base_url();?>js/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="<?php echo base_url();?>css/custom.css" rel="stylesheet">
<script src="<?php echo base_url();?>js/custom.js"></script>
<script src="<?php echo base_url();?>s/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
			

			
		});
		</script>


<script src="<?php echo base_url();?>js/pie-chart.js" type="text/javascript"></script>
 <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#3bb2d0',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#fbb03b',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ed6498',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

           
        });

    </script>
<!--skycons-icons-->
<script src="<?php echo base_url();?>js/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>
<div id="wrapper">
	<div class="col-md-12" style=" background: #069198; height: 47px; ">
		<div class="col-md-8">
	<a href="<?php echo base_url();?>Admin/profile" style=" cursor: pointer !important; color: #fff; ">

		<div class="menu">
			<i class="fa fa-user-o" aria-hidden="true"></i>
			<label>Users</label> 
		</div>
	</a>
	<a href="<?php echo base_url();?>Admin/transaction" style=" cursor: pointer !important; color: #fff; ">

		<div class="menu">
			<i class="fa fa-list-alt" aria-hidden="true"></i>
			<label>E-Transaction</label> 
		</div>	
	</a>
	<a href="<?php echo base_url();?>Admin/investments" style=" cursor: pointer !important; color: #fff; ">

		<div class="menu">
			<i class="fa fa-list-alt" aria-hidden="true"></i>
			<label>E-Investments</label> 
		</div>	
	</a>

<a href="<?php echo base_url();?>Admin/investments_log" style=" cursor: pointer !important; color: #fff; ">

		<div class="menu">
			<i class="fa fa-list-alt" aria-hidden="true"></i>
			<label>E-Investments Log</label> 
		</div>	
	</a>

	<a href="<?php echo base_url();?>Admin/contact_info" style=" cursor: pointer !important; color: #fff; ">

		<div class="menu">
			<i class="fa fa-list-alt" aria-hidden="true"></i>
			<label>Contact Info</label> 
		</div>	
	</a>
	<a href="<?php echo base_url();?>Admin/bank_info" style=" cursor: pointer !important; color: #fff; ">

		<div class="menu">
			<i class="fa fa-list-alt" aria-hidden="true"></i>
			<label>Bank Info</label> 
		</div>	
	</a>	
		 </div>	

		 <div class="col-md-4 text-right">
		<!--<div class="menu">
			<i class="fa fa-key" aria-hidden="true" style=" display: -webkit-box; text-align: center; margin-left: 38px; font-size: 16px; "></i>
			<label style=" display: -webkit-box; text-align: center; font-size: 14px; ">Change Password</label> 
		</div>-->
		<a href="<?php echo base_url();?>Admin/upload_data">
		<div class="menu">
			<i class="fa fa-upload" aria-hidden="true" style=" display: -webkit-box; text-align: center; margin-left: 23px; font-size: 16px; "></i>
			<label style=" display: -webkit-box; text-align: center; font-size: 14px; ">Upload Data</label> 
		</div>
		</a>
		<a href="<?php echo base_url();?>Admin/admin_users">
		<div class="menu">
			<i class="fa fa-user-o" aria-hidden="true" style=" display: -webkit-box; text-align: center; margin-left: 10px; font-size: 16px; "></i>
			<label style=" display: -webkit-box; text-align: center; font-size: 14px; ">Admin</label> 
		</div>
		</a>
		<a href="<?php echo base_url();?>Admin/activitylog">
		<div class="menu">
			<i class="fa fa-history" aria-hidden="true" style=" display: -webkit-box; text-align: center; margin-left: 20px; font-size: 16px; "></i>
			<label style=" display: -webkit-box; text-align: center; font-size: 14px; ">Activity Log</label> 
		</div>
		</a>		
		
		<a href="<?php echo base_url();?>Admin/logout">
		<div class="menu">
			<i class="fa fa-power-off" aria-hidden="true" style=" display: -webkit-box; text-align: center; margin-left: 10px; font-size: 16px; "></i>
			<label style=" display: -webkit-box; text-align: center; font-size: 14px; ">Logout</label> 
		</div>
		</a>	
		 </div>
	</div>
       
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
       
</div>

<style type="text/css">
	.menu{
padding-top: 15px;
    color: #fff;
    padding-left: 10px;
    padding-right: 18px;
    padding-top: 11px;
    display: inline-block;
	}
	.menu i {
	    font-size: 26px;    padding-left: 10px;
    padding-right: 10px;
	}
	label{
		font-size: 13px;    font-weight: 100;
	}

</style>