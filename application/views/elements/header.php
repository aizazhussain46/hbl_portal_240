<?php
if (empty($_SESSION['folio'])){
     redirect('Customer');
}
$sessionid= $_SESSION['folio'];
$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['folio']);
$resulting = $this->db->get('investorprofileinfo')->result_array();		
$name= $resulting[0]['Invester_Name'];
$fname= $resulting[0]['Invester_FName'];
$cnic= $resulting[0]['Invester_CNIC'];




error_reporting(0);

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

.table-condensed > thead > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > th, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > th, .table-condensed > tfoot > tr > td {
    padding: 5px;
    font-size: 12px !important;
    font-weight: 500 !important;
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
<script src="j<?php echo base_url();?>s/screenfull.js"></script>
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
		<a href="<?php echo base_url();?>/Customer/dashboard">

		<div class="menu">
			<i class="fa fa-home" aria-hidden="true" style="color:#fff"></i>
					<a href="<?php echo base_url();?>/Customer/dashboard" style=" cursor: pointer !important; color: #fff; ">
					<label style=" color: #fff !important;  ">HOME</label> </a>
		</div>
	</a>
	<a href="<?php echo base_url();?>/Customer/profile" style=" cursor: pointer !important; color: #fff; ">

		<div class="menu">
			<i class="fa fa-user-o" aria-hidden="true"></i>
			<label>PROFILE</label> 
		</div>
	</a>
	<a href="<?php echo base_url();?>/Customer/transaction" style=" cursor: pointer !important; color: #fff; ">

		<div class="menu">
			<i class="fa fa-money" aria-hidden="true"></i>
			<label>e-TRANSACTION</label> 
		</div>
	</a>
	<a href="<?php echo base_url();?>/Customer/report" style=" cursor: pointer !important; color: #fff; ">

		<div class="menu">
			<i class="fa fa-list-alt" aria-hidden="true"></i>
			<label>REPORTS</label> 
		</div>	
</a>		
		 </div>	

		 <div class="col-md-4 text-right">
		<a href="<?php echo base_url();?>/Customer/activitylog">
		<div class="menu">
			<i class="fa fa-location-arrow" aria-hidden="true" style=" display: -webkit-box; text-align: center; margin-left: 20px; font-size: 16px; "></i>
			<label style=" display: -webkit-box; text-align: center; font-size: 14px; ">Acitivity Log</label> 
		</div>
		</a>	

		<div class="menu">
			<i class="fa fa-key" aria-hidden="true" style=" display: -webkit-box; text-align: center; margin-left: 38px; font-size: 16px; "></i>
			<label style=" display: -webkit-box; text-align: center; font-size: 14px; ">Change Password</label> 
		</div>
		<a href="<?php echo base_url();?>/Customer/logout">
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