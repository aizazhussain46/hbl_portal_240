<?php
if (empty($_SESSION['folio'])){
     redirect('Customer');
}
$sessionid= $_SESSION['folio'];
$folino= $_SESSION['folino'];

$this->db->select('*');
$this->db->where('UserID',$sessionid);
$resultfoliodata = $this->db->get('user')->result_array();        
$foliodata= $resultfoliodata[0]['Folio_No'];



$this->db->select('*');
$this->db->where('Folio_No',$foliodata);
$resulting = $this->db->get('investorprofileinfo')->result_array();     
$name= $resulting[0]['Invester_Name'];
$fname= $resulting[0]['Invester_FName'];
$cnic= $resulting[0]['Invester_CNIC'];




error_reporting(0);

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>HBL Asset Management</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
  <script src="<?php echo base_url();?>js/jquery.min.js"> </script>
<!-- Mainly scripts -->

    <link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
</head>




<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
<!-- Add your site or application content here -->
<div class="rowc">
    <nav class="navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
                <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>images/hblasset-logo.jpg" alt=""></a>
  
            </div>
           <div class="hidden-lg hidden-md hide-me">    
               <nav class="main-navs collapse navbar-collapse hidden-lg hidden-md" id="collapse-nav">
        
            <ul class="nav navbar-nav menu list-unstyled">
                <li><a href="<?php echo base_url();?>/Customer/dashboard" class="">
                <i class="icon icon-home"></i><span>Home</span></a></li>
                <li><a href="<?php echo base_url();?>/Customer/profile" class="">
                <i class="icon icon-profile"></i><span>Profile</span></a></li>
                <li><a href="<?php echo base_url();?>/Customer/transaction" class="">
                <i class="icon icon-transaction"></i><span>E-Transaction</span></a></li>
                <li><a href="<?php echo base_url();?>/Customer/report" class="">
                <i class="icon icon-reports"></i><span>Reports</span></a></li>
                <li><a href="<?php echo base_url();?>/Customer/change_password" class="">
                <i class="icon icon-password"></i><span>Change Password</span></a></li>
                <li><a href="<?php echo base_url();?>/Customer/logout" class="">
                <i class="icon icon-logout"></i><span>Logout</span></a></li>
               
            </ul>

</nav></div> 
<div class="row">
<div class="container">
<ul class="list-unstyled list-inline top-header pull-left">
                <li>
                
                <div class="dsc">
                <small>Call Toll-Free</small>
                <i class="icon icon-phone"></i>   
                <a href="tel:0800-425-26"><span>0800-425-26</span></a>
                
                </div>
                </li>
                <li> 
                <div class="dsc">
                <small>
                Contact
                </small>
                <a href="">
                <i class="icon icon-agent"></i>
                <span>Investment Advisor</span>
                </a>
                
                </div>
                </li>
                <li>
                <div class="dsc">
                <small>Website</small>
                <i class="icon icon-sphere"></i>
                <a href="http://www.hblasset.com/"><span>www.hblasset.com</span></a>

                
                </div>
                </li>
               
               
            </ul>
          
            <ul class="list-unstyled list-inline pull-right user-info">
                <li>
                    <p>Welcome <?php 
                    $ex_name= explode(" ", $name);
                    echo $name[0].' '.$ex_name[1];?></p>
                    <p>UserID #:<?php echo $sessionid;?></p>
                   <!-- <p><?php 
                        echo date("jS <br> F Y ") . "<br>";


                    ?></p>-->
                    <a href="<?php echo base_url();?>/Customer/activitylog"><p>Activitylog</p></a>
                    <div class="clearfix"></div>
                </li>
            </ul>
</div>

            
</div>

</div>
          
        </div>
    </nav>
</div>

<div class="clearfix"></div>
<div class=" hidden-xs">
    <nav class="main-navs">
        <div class="container">
            <ul class="pull-left menu list-unstyled list-inline">
                <li><a href="<?php echo base_url();?>/Customer/dashboard" class="">
                <i class="icon icon-home"></i><span>Home</span></a></li>
                <li><a href="<?php echo base_url();?>/Customer/profile" class="">
                <i class="icon icon-profile"></i><span>Profile</span></a></li>
                <li><a href="<?php echo base_url();?>/Customer/transaction" class="">
                <i class="icon icon-transaction"></i><span>E-Transaction</span></a></li>
                <li><a href="<?php echo base_url();?>/Customer/report" class="">
                <i class="icon icon-reports"></i><span>Reports</span></a></li>
               
            </ul>
            <ul class="pull-right settings-options list-unstyled list-inline">
                <li><a href="<?php echo base_url();?>/Customer/change_password">
                <i class="icon icon-password"></i>
                <span>Change Password</span>
                </a></li>
                <li><a href="<?php echo base_url();?>/Customer/logout">
                <i class="icon icon-logout"></i>
                <span>Logout</span>
                </a></li>
                <li></li>
            </ul>


       
</div>
</nav>
</div>  
<style type="text/css">
    .modal-header {
    background: #00a997;
}
.modal-header h4 {
    color: #fff !important;
}
.btn.btn-default {
    background-color: #00a997 !important;
}
.modal-dialog {
    width: 55%;
}input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>