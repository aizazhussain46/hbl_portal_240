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
$this->db->where('Folio_No',$folino);
$resulting = $this->db->get('investoraccountinfo')->result_array();     
$name= $resulting[0]['ACC_TITLE'];
$fname= $resulting[0]['Invester_FName'];
$cnic= $resulting[0]['ACC_CNIC'];




error_reporting(0);

?>
<script type="text/javascript">
setTimeout(onUserInactivity, 1000 * 900)
function onUserInactivity() {
   alert('Session expired. Please login to continue.');
   window.location.href = "../Customer";
}
</script>


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
<!-- Mainly scripts -->


	
	
	    <link rel="stylesheet" href="<?php echo base_url();?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/main.css">
    <script src="<?php echo base_url();?>/js/jquery.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

	
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
                <li><a href="<?php echo base_url();?>Customer/dashboard" class="">
                <i class="icon icon-home"></i><span>Home</span></a></li>
                <li><a href="<?php echo base_url();?>Customer/profile" class="">
                <i class="icon icon-profile"></i><span>Profile</span></a></li>
                <li><a href="<?php echo base_url();?>Customer/transaction" class="">
                <i class="icon icon-transaction"></i><span>E-Transaction</span></a></li>
                <li><a href="<?php echo base_url();?>Customer/report" class="">
                <i class="icon icon-reports"></i><span>Reports</span></a></li>
                <li><a href="<?php echo base_url();?>Customer/change_password" class="">
                <i class="icon icon-password"></i><span>Change Password</span></a></li>
                <li><a href="<?php echo base_url();?>Customer/logout" class="">
                <i class="icon icon-logout"></i><span>Logout</span></a></li>
               
            </ul>

</nav></div> 
<div class="row">
<div class="container">
<ul class="list-unstyled list-inline top-header pull-left">
                <li>
                
                <a href="tel:0800-425-26" class="dsc">
                <small>Call Toll-Free</small>
                <i class="icon icon-phone"></i>   
                <span>0800-425-26</span>
                
                </a>
                </li>
                <li> 
                <a href="#" class="dsc" aria-hidden="true" data-toggle="modal" data-target="#investmentadvisor" style="cursor: pointer;">
                <small>
                Contact
                </small>
              
                <i class="icon icon-agent"></i>
                <span>Investment Advisor</span>
              
                
                </a>
                </li>
                <li>
                <a  href="http://www.hblasset.com/" target="_blank" class="dsc">
                <small>Website</small>
                <i class="icon icon-sphere"></i>
                <span>www.hblasset.com</span>

                
                </a>
                </li>
               
               
            </ul>
          <!-- Contact Information Modal -->

                          <!-- Modal -->
                          <div class="modal fade" id="investmentadvisor" role="dialog">
                            <div class="modal-dialog">
                                
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">

                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title" style="color: #000">Contact Investment Advisor</h4>
                                </div>
                                <div class="modal-body">

                                <form name = "sfc" id="sfc" method="POST" action="<?php echo base_url().'Customer/contactadvisor' ?>">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1" style="color: #000">Folio Number</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" pattern="[0-9\+\-]+" placeholder="" readonly required="" name="folioNumber" 
                                    value="<?php echo $_SESSION['folio'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1"  style="color: #000">Cell Phone</label>
                             
								  
									<input type="text" class="form-control" id="phoneid" data-inputmask="'mask': '0399-99999999'"  placeholder=""  name="cell" required=""     oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"     maxlength = "12" pattern="[0-9]{4}-[0-9]{7}" title="Please enter complete number">
                    
								  
								  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1" style="color: #000">Email Address</label>
                                    <input required="" type="email" name="email"  class="form-control" id="" placeholder="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" title="Invalid email address" >
									</div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1"  style="color: #000">Messege</label>
                                    <textarea class="form-control" name="msg"></textarea>
                                  </div>
                                    <input type="hidden" class="form-control" id="exampleInputPassword1" placeholder="" required="" name="folio" value="<?php echo $_SESSION['folio'];?>">

                                  <input type="submit" name="sbc" id="sbc" class="btn btn-default" value="Submit">
                                </form>
								<script>
$(":input").inputmask();


</script>
								<script type="text/javascript">

    document.getElementById("sfc").onsubmit = function () {
		//13 June 2018
        //var send = document.getElementById("confirm"),
         //   sendValue = send.value,
          //  sendCheck = send.checked,
            //errors = "";
        //validate checkbox
        //if (!sendCheck) {
          //  errors += "Please tick the checkbox as confirmation your details are correct \n";
        //}
        //validate other stuff here
        //in case you added more error types above
        //stacked all errors and in the end, show them
        //if (errors != "") {
          //  alert(errors);
           // return false; //if return, below code will not run
       // }
        //passed all validations, then it's ok
        //alert("Your details are being sent"); // <- had a missing " after sent.
          document.getElementById("sbc").value = "Processing ...";
          document.getElementById("sbc").disabled = "disabled";
        return true; //will submit
    }
</script>
                                <br><br>


                                </div>
                               <!-- <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
                                </div>-->
                              </div>
                              
                            </div>
                          </div>

                <!-- End Modal Contact Information -->
            <ul class="list-unstyled list-inline pull-right user-info">
                <li>
                    <p><span>Welcome : </span><?php 
                    $ex_name= explode(" ", $name);
                    echo ucfirst(strtolower($ex_name[0])).' '.ucfirst(strtolower($ex_name[1]));?></p>
                    <p style=" margin-bottom: -10px; ">User ID: <?php echo $sessionid;?></p>
                   <!-- <p><?php 
                        echo date("jS <br> F Y ") . "<br>";


                    ?></p>-->
                    
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
                <li><a href="<?php echo base_url().'Customer/dashboard';?>" class="">
                <i class="icon icon-home"></i><span>Home</span></a></li>
                <li><a href="<?php echo base_url().'Customer/profile';?>" class="">
                <i class="icon icon-profile"></i><span>Profile</span></a></li>
                <li><a href="<?php echo base_url().'Customer/transaction';?>" class="">
                <i class="icon icon-transaction"></i><span>E-Transaction</span></a></li>
                <li class="dropdown report">
                <a href="<?php echo base_url().'Customer/report';?>" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon icon-reports"></i><span>Reports</span></a>
                <div class="dropdown-menu">
                             <span><a href="<?php echo base_url().'Customer/report';?>"><i class="icon icon-reports"></i> Account Statement</a></span>
                             <!--
							 <span class="menu-sub"><a href="#"><i class="icon icon-reports"></i>Certificates</a>
                             -->
							 <!--
							 <div class="submenu">
                                <span><a href="<?php echo base_url();?>/Customer/balance_sheet" target="_blank"><i class="icon icon-reports"></i>Balance Certificates</a></span>
                                <span><a href="<?php echo base_url();?>/Customer/investment" target="_blank"><i class="icon icon-reports"></i>Investment Certificate</a></span>
                                <!--
								<span><a href="<?php echo base_url();?>/Customer/tax"  target="_blank"><i class="icon icon-reports"></i>Tax Certificate</a></span>
                             -->
							  <!--
							 </div>
                              -->
                            
                           

                           </div>
                </li>
               
            </ul>
            <ul class="pull-right settings-options list-unstyled list-inline">
            <li><a href="<?php echo base_url().'Customer/activitylog';?>">
                <i class="icon icon-password"></i>
                <span>Activity Log</span>
                </a></li>
                <li><a href="<?php echo base_url().'Customer/change_password';?>">
                <i class="icon icon-password"></i>
                <span>Change Password</span>
                </a></li>
                <li><a href="<?php echo base_url().'Customer/logout';?>">
                <i class="icon icon-logout"></i>
                <span>Logout</span>
                </a></li>
                
            </ul>


       
</div>
</nav>
</div>  
<style type="text/css">
legend: {position: 'none'}


    .modal-header {
    background: #00a997;
}
.modal-header h4 {
    color: #fff !important;
}
.modal-dialog.terms-dialog{
	width:95%;
}

.modal-dialog.terms-dialog .modal-body {
    padding: 15px;
}
.btn.btn-default {
    background-color: #00a997 !important;
}
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>