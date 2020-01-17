<?php
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
<!-- Add your site or application content here -->
<div class="container">
<div class="main">
<figure class="logo-image">
<img src="<?php echo base_url();?>images/logo.png" alt="">
</figure>
<div class="login-box">

<h2 class="h2 text-uppercase text-center fz-18 fw-bold ls-3">Forgot Password</h2>
<span></span>
<!-- Modal content-->
<form method="post" action="<?php echo base_url();?>Customer/change_forgot_img" autocomplete="off">

<div class="modal-body">
<div class="row" style="text-align:center;">

<div class="imageselection modal-select" style="margin-bottom: 20px;">
<h4 class="info-2">Please select an image</h4>
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
<br>
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
<input  type="hidden" value="<?php echo $foliodata; ?>" name="folio_id"> 
<h4 style="display:none;" class="error" id="msg">Image does not match.</h4>
<button  type="button"  class="submit btn btn-lg btn-default" data-toggle="modal" data-target="#myModal" style="margin:0 auto;">Submit</button>
</div>



</div>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
    background: #00a997;">
        <h5 class="modal-title" style="    margin: 8px;
    line-height: 0.57143;
    float: left;">Update Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="modal-body">
<label style="color:black;">Enter User Id</label>
<input type="number" name="id" class="form-control">
<br>
<label style="color:black;">Enter Password</label>
<input type="password" name="pwd" class="form-control">
<br>
<button id="update_btn"  type="submit" class="form-control btn" style="width:20%;color:#fff;background: #00a997;">Update Image</button>


<button type="reset" class="form-control btn" data-dismiss="modal" style="width:20%;color:#fff;background:grey;">Cancel</button>

</div>

</div>

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
<script type="text/javascript">
$('input[name="imageSecurity"]').click(function(){
if($('input[name="imageSecurity"]:checked')){
$('.c_selection').slideToggle();   
$('#msg,#img_selected').hide();         

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
$('#update_btn,.submit').prop('disabled',false);
console.log(img,c_img);
}
else{
$('#msg').show();
$('#img_selected').hide();
$('.c_selection').slideUp(); 
$('#update_btn,.submit').prop('disabled',true);
//      $('#btn').hide();

}

});

</script>

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
<script src="<?php echo base_url();?>js/vendor/bootstrap.min.js"></script>

</html>
