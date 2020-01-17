<!doctype html>
<html class="no-js" lang="">
<?php
//ECHO md5("YPI10JOS");EXIT;
// DB : 63bad057c33af09c981a282cbc6b70c2
// or: 63bad057c33af09c981a282cbc6b70c2
?>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

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
   
    <h2 class="h2 text-uppercase text-center fz-18 fw-bold ls-3">Forgot Password</h2>
    <span></span>
    <form method="post" action="<?php echo base_url().'Customer/changed_forgot_password' ?>">
                    <div class="form-group">
                      <label for="exampleInputEmail1" class="control-label">User ID</label>
                      <input required="" type="text" name="loginid"  class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1" class="control-label">Registered Email Address</label>
                      <input required="" type="email" name="email"  class="form-control" id="" placeholder="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" title="Invalid email address" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1" class="control-label">Registered Mobile Number</label>

                      <input type="tel" class="form-control" id="phoneid" data-inputmask="'mask': '0399-99999999'"  placeholder=""  name="mobile" required=""     oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"     maxlength = "12" pattern="[0-9]{4}-[0-9]{7}" title="Please enter complete number">
                    </div>
                    <div class="form-group">
                      <label for="sendOTPOption" class="control-label">Send me OTP on my </label>

                      <p>
                <input type="radio" id="test1" name="r1"  value="E" checked>
                <label for="test1"><font color="white">Email Address</font></label>
               &nbsp;&nbsp;&nbsp;
                <input type="radio" id="test2" name="r1"  value="M" >
                <label for="test2"><font color="white">Mobile Number</font></label>
              </p>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <button type="submit" class="btn btn-sm btn-default">Submit <i class="icon icon-arrow"></i></button>
                        </div>
                        <div class="col-md-10">
                        <p style="margin-top: 5px">Know the password? <a href="<?php echo base_url();?>Customer/login">Click here to login. </a><br>Forgot your User ID? Please contact our helpline for support.</br>
                        </p>
                        
                        </div>
                    </div>
             </form>
<script>
$(":input").inputmask();


</script>
             
             <footer class="row">
             <ul class="list-unstyled list-inline row">
                 <li>
                 <a href="">
                         <small>Call Toll-Free</small>
                         <i class="icon icon-phone"></i>
                         <span>0800 425 26</span>
                     </a>
                 </li>
                 <li> <a href="mailto:info@hblasset.com">
                     <small>Contact Us</small>
                         <i class="icon icon-mail"></i>
                         <span>info@hblasset.com</span>
                 </a>
                 </li>
                 <li>
                 <a href="http://www.hblasset.com/">
                     <small>Web Site</small>
                         <i class="icon icon-sphere"></i>
                         <span>www.hblasset.com</span>
                 </a>
                 </li>
                 <li>
                     <img src="<?php echo base_url();?>images/digicert.jpg" alt=""  id="footerlogo">
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
@media (max-width:736px){

img#footerlogo {
    width: 66%;
}
}input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
</html>
