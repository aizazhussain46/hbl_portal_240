<?php

 $id= $_SESSION['loginid'];
 $otp= $_SESSION['otp'];
 $mobileinput= $_SESSION['mobileinput'];
 $emailinput= $_SESSION['emailinput'];
 $foliii= $_SESSION['folioss'];
 $otp_created_time= $_SESSION['otp_created_time'];
 $otptype = $_SESSION['otptype'];


     //  $this->session->sess_destroy();


if (empty($_SESSION['loginid']) OR empty($_SESSION['otp']) ){
     redirect('Customer/forgot_password');
}

   
error_reporting(0);

?>


<script type="text/javascript">
setTimeout(onUserInactivity, 1000 * 3600)
function onUserInactivity() {
  // window.location.href = "../Register/otp_expire";
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

    <link rel="manifest" href="<?php echo base_url();?>site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
    
</head>

<body class="login">
    <!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

    <!-- Add your site or application content here -->
    <div class="container">
    <div class="main">
    <figure class="logo-image">
        <img src="<?php echo base_url();?>images/logo.png" alt="">
    </figure>
    <div class="login-box">
    <a href="../Register/otp_expire">
       
       <img src="https://cdn3.iconfinder.com/data/icons/status/100/close_4-512.png" style="float: right;width:25px;margin-top: 5px;margin-right: -42px;" id="close_icon">
    </a>
    <h2 class="h2 text-uppercase text-center fz-18 fw-bold ls-3">Confirm forgot password</h2>
    <span></span>
    
    <form method="post" action="<?php echo base_url(); ?>Register/confirmpass_check">
                   

               
                <div class="col-md-12">
                    <b>We have sent One Time Passcode (OTP) to your 
                    <?php if($otptype == "M"){ echo "mobile number.";} if($otptype == "E"){ echo "Email address. Please check your email Junk box in case email not received";}?> </b><br><br>
                    <div class="form-group">
                      <label for="exampleInputEmail1" class="control-label">
                          
                      </label>
                      <input required="" type="text" name="otpcode" value=""  class="form-control" id="exampleInputEmail1" placeholder="Enter  OTP here" required="" pattern="[A-Za-z0-9]+" maxlength="6">
                    </div>
                <?php
                    $_chars = "ZXCVBNMASDFGHJKLQWERTYUIOP0123456789";

                $_charcode = ''; // initialize the variable with an empty string
                for($l = 0; $l<8; $l++){
                    $temp = str_shuffle($_chars);
                    $_charcode .= $temp[0];
                }
                ?>
               <input type="hidden" value="<?php echo $_charcode;?>" name="newpass">
               <input type="hidden" value="<?php echo $otp_created_time;?>" name="otpcreated">

                </div>


                <div class="col-md-12"><br>
                    <div class="row">
                        <div class="col-md-3">
                        <button type="submit" class="btn btn-sm btn-default">Verify <i class="icon icon-arrow"></i></button>

        </form>
                
                        </div>
                        <div class="col-md-9">
                        <p>Didn't receive OTP? 
                        <?php if($otptype == "M"){?>
                        <a href="<?php echo base_url();?>Customer/resend_pass">
                            <label style=" color: #ffcc1f;cursor: pointer; ">Resend OTP</label>
                        <?php } ?>
                        <?php if($otptype == "E"){?>
                        <a href="<?php echo base_url();?>Customer/resend_pass_email">
                            <label style=" color: #ffcc1f;cursor: pointer; ">Resend OTP</label>
                        <?php } ?>
                        </a></p> 
                             <p></p>
   
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                <br>
                </div>









        <footer class="row">
            <ul class="list-unstyled list-inline row">
                <li>
                    <small>Call Toll Free</small>
                    <i class="icon icon-phone"></i>
                    <span>0800 425 26</span>
                </li>
                <li> <small>Contact Us</small>
                    <i class="icon icon-mail"></i>
                    <span>info@hblasset.com</span>
                </li>
                <li>
                <small>Web Site</small>
                    <i class="icon icon-sphere"></i>
                    <a href="http://www.hblasset.com/">www.hblasset.com</a>
                </li>
                <li>
                    <img src="<?php echo base_url();?>images/digicert.jpg" alt="" id="footerlogo">
                </li>
                
            </ul>
        </footer>
    </div>
    </div>
    </div>
    <div class="slideshow">
    <div class="login-foot">
        
    </div>
    </div>
    <div class="foot-copyright fz-18">
        <p>© Copyright 2018 HBL Asset Management Limited. All rights reserved.</p>
    </div>
    
    <script src="<?php echo base_url();?>js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="<?php echo base_url();?>js/vendor/jquery-3.2.1.min.js"><\/script>')

    </script>
    <script src="<?php echo base_url();?>js/plugins.js"></script>
    <script src="<?php echo base_url();?>js/main.js"></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function () {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')

    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
<style type="text/css">
@media (max-width:768px){
#close_icon
{
    float: right;
    width: 30px;
    margin-top: -63px !important;
    margin-right: -18px !important;
}
.main .logo-image img {
    width: 100%;
    height: auto;
    margin-top: 35px;
}
}

@media (max-width:736px){


img#footerlogo {
    width: 66%;
}
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
label.staric {
    color: #d81515;
    margin-left: 3px;
}
</style>
</html>
