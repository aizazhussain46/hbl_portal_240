<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
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
   
    <h2 class="h2 text-uppercase text-center fz-18 fw-bold ls-3">Welcome To e-services portal</h2>
    <span></span>
    <form method="post" action="<?php echo base_url().'Customer/check_login' ?>">
        <div class="form-group">
                      <label for="exampleInputEmail1" class="control-label">Folio Number</label>
                      <input required="" type="text" name="folio"  class="form-control" id="exampleInputEmail1" placeholder="eg:A-910093">
                    </div>
                    <div class="form-group">
                        <div class="row less-margin">
                        <label for="exampleInputPassword1" class="control-label pull-left">Password</label>
                        <a href="/sessions/forgot_password" class="pull-right">(forgot password)</a>
                        </div>
                       
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"  name="pass" >
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <button type="submit" class="btn btn-sm btn-default">Login <i class="icon icon-arrow"></i></button>
                        </div>
                        <div class="col-md-10">
                        <p>New Member Registration. <a href="">Click Here</a></p>    
                        <p>To Know About Securities and Tips <a href="">Click Here</a></p>    
                        </div>
                    </div>
             </form>
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
                    <img src="<?php echo base_url();?>images/digicert.jpg" alt="">
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
        <p>© Copyright 2017 HBL Asset Management Limited. All rights reserved.</p>
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
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>

</html>
