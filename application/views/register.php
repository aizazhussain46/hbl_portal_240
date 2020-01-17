<?php
if (!empty($_SESSION['loginid']) OR !empty($_SESSION['Folio_No'])  OR !empty($_SESSION['otp']) ){
 //    redirect('Register/Confirm');
}


error_reporting(0);

$this->load->database();
$this->db->select('*');
$result = $this->db->get('binary_data')->result_array();
$data = array();
foreach ($result as $row) {
$data[] = $row;
}
shuffle($data);

?>




<!doctype html>
<html class="no-js" lang="">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>HBL ASSET MANAGEMENT</title>
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
    <div class="login-box login-register">
   
    <h2 class="h2 text-uppercase text-center fz-18 fw-bold ls-3">User Registration for E-Services Portal</h2>
    <span></span>
    
    <form method="post" action="<?php echo base_url();?>Register/check_registration">
                    
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1" class="control-label">Account Title</label>
                      <label class="staric"></label>

                      <input required="" type="text" name="accountTitle"  class="form-control" id="exampleInputEmail1" placeholder="" required="" style="text-transform:uppercase">
                    </div>
                    </div>
                    
           
                <div class="col-md-6">

                    <div class="form-group">
                        <div class="row less-margin">
                        <label for="exampleInputPassword1" class="control-label pull-left">Registered Mobile </label>                      
                        <label class="staric"></label>

                        </div>
   
                      <input type="tel" class="form-control" id="phoneid" data-inputmask="'mask': '0399-99999999'"  placeholder=""  name="mobile" required=""     oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"     maxlength = "12" pattern="[0-9]{4}-[0-9]{7}" title="Please enter complete number">

                    </div>
                    </div>
                    
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="row less-margin">
                        <label for="exampleInputPassword1" class="control-label pull-left">CNIC </label>                      
                        <label class="staric"></label>


                        </div>
                      <input type="tel" class="form-control" id="" data-inputmask="'mask': '99999-9999999-9'"  placeholder=""  name="cnic" required="" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" title="Example: 42304-2999999-2" maxlength="15"  id="cnic">
<script>
$(":input").inputmask();

</script>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1" class="control-label">Registered Email Address</label>
                      <label class="staric"></label>
                      <input required="" type="email" name="email"  class="form-control" id="" placeholder="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" title="Invalid email address" >
                    </div>
                    </div>
          
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="row less-margin">
                        <label for="exampleInputPassword1" class="control-label pull-left">Folio No. </label>
                         <label class="staric"></label>
                        </div>
                      <input type="number" class="form-control" id="exampleInputPassword1" placeholder=""  name="reg_folio" required="">
                    </div>
                    </div>
                <div class="col-md-6">

    			        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">   
<style>
.ui-datepicker-header.ui-widget-header.ui-helper-clearfix.ui-corner-all {
    background: #069198;
    border: 1px solid;
}
input#datepicker {
    color: gray;
    font-family: 'Muli-Regular';padding-left:10px;
    font-size:13px;
}
input#datepickers {
    color: gray;
    font-family: 'Muli-Regular';padding-left:10px;
        font-size:13px;

}

hr.style7 {
	border-top: 2px solid #ca902f;
    border-bottom: 3px solid #ca902f;
    clear: both;
    margin-top:20px!important;
    margin-left:-60px;
   margin-right:-60px;
}


</style>

                    <div class="form-group">
                        <div class="row less-margin">
                        <label for="exampleInputPassword1" class="control-label pull-left">Date of Birth </label>
                         <label class="staric"></label>
                        </div>
                      <input type="date"  class="form-control" id="" placeholder=""  name="dob" required=""  style="background-color:#fff">
                      
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr class="style7">


                <p class="loginsuccess">Select security image&nbsp;<span style="border: 1px solid #fff; color:#00a997; font-weight:bold; background-color:#fff; border-radius:5px;"> ? </span>&nbsp;
                            <i style="cursor: hand; font-size: 25px; color: #f9ff12; vertical-align: middle;" class="icon-question" data-toggle="popover" data-placement="bottom" data-original-title="" title=""></i>
                        </p>

                        <div class="modal-body">
<div class="row" style="text-align:center;">

<div class="imageselection modal-select">
<?php  foreach ($data as $key => $image){ ?>
<label id="label">
<input  required  type="radio" value="<?php echo $image['id'];?>" name="imageSecurity"> 
<?php echo '<img src="data:image/png;base64,'.base64_encode($image['img']).'"/>'; ?>

</label>
<?php }?>         
</div>
</div>


<div class="row" style="text-align:center;">
<div class="imageselection c_selection" style="display: none;">
<h4>Please re-select the same image.</h4>

<?php  foreach ($data as $key => $image){ ?>
<label id="label">
<input  required  type="radio" value="<?php echo $image['id'];?>" name="c_imageSecurity"> 
<?php echo '<img src="data:image/png;base64,'.base64_encode($image['img']).'"/>'; ?>

</label>
<?php }?>   

</div>

<h4 id="img_selected" style="display: none;color: #555; width: 70%;
    border: 1px solid #ccc;
    margin: 0 auto;
    font-size: 13px;
    background: #f4f4f4;
    padding: 10px;
    text-align: center;
    border-radius: 8px;
    margin-bottom: 20px;
    margin-top: 10px;">Image Selected.</h4>

</div>



</div>

                

 <div class="clearfix"></div>




                    <script type="text/javascript">
                            
                            $('#datepicker').datepicker({
                                  dateFormat: 'dd-mm-yy',   maxDate: 0,

                            });                           

                    </script>



                <div class="col-md-12"><br>
                    <div class="row">
                        <div class="col-md-3">
                        <button id="btn" type="submit" class="btn btn-sm btn-default">Register <i class="icon icon-arrow"></i></button>
                        </div>
                        <div class="col-md-9">
                            <p><label class="staric">*</label> All above fields are mandatory.</p> 
                        <p>Already registered? <a href="<?php echo base_url();?>customer">Click here to login.</a></p>    
                        <p>To know about securities and tips <a href="">Click here.</a></p>    
                        </div>
                    </div>
                </div>
                <div class="col-md-12"><br><br></div>



             </form>






        <footer class="row">
            <ul class="list-unstyled list-inline row">
                <li>
                <a href="tel:0800-425-26">
                    <small>Call Toll Free</small>
                    <i class="icon icon-phone"></i>
                    <span>0800 425 26</span>
                    </a>
                </li>
                <li> 
                <a href="mailto:info@hblasset.com">
                <small>Contact Us</small>
                    <i class="icon icon-mail"></i>
                    <span>info@hblasset.com</span>
                    </a>
                </li>
                <li>
                <a href="http://www.hblasset.com/">
                <small>Web Site</small>
                    <i class="icon icon-sphere"></i>
                   www.hblasset.com
                    </a>
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

<script type="text/javascript">
$('input[name="imageSecurity"]').click(function(){
if($('input[name="imageSecurity"]:checked')){
$('.c_selection').slideToggle();   
$('#msg,#img_selected').hide();  
$('#btn').prop('disabled',true);


}

});



$('input[name="c_imageSecurity"]').click(function(){
var img = $('input[name="imageSecurity"]:checked').val();
var c_img = $('input[name="c_imageSecurity"]:checked').val();

if(img == c_img){

$('#btn').show();
$('#msg').hide();
$('#img_selected').show();

$('.c_selection').show(); 
$('#btn').prop('disabled',false);
console.log(img,c_img);
}
else{
$('#msg').show();
$('#img_selected').hide();
$('.c_selection').slideUp(); 
$('#btn').prop('disabled',true);
//      $('#btn').hide();

}

});



$('#label').change(function(){
var img_id = $('input[name="imageSecurity"]:checked').val();
console.log(img_id);
});

</script>
</html>





