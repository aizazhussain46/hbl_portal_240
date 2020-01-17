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

<h2 class="h2 text-uppercase text-center fz-18 fw-bold ls-3">Welcome To E-Services Portal</h2>
<span></span>
<form method="post" action="<?php echo base_url().'Customer/check_login' ?>">
<div class="form-group">
<label for="exampleInputEmail1" class="control-label">User ID</label>
<input required="" type="text" name="folio"  class="form-control" id="exampleInputEmail1" placeholder="" autocomplete="off">
</div>
<div class="form-group">
<div class="row less-margin">
<label for="exampleInputPassword1" class="control-label pull-left">Password</label>
<a href="<?php echo base_url();?>Customer/forgot_password" class="pull-right">(Forgot Password?)</a>
</div>

<input type="password" class="form-control" id="exampleInputPassword1" name="pass" autocomplete="new-password">
</div>
<div style="display: none;" id="show_sec_img">

<div class="imageselection ">
<h4>Select security image <a href="" data-toggle="popover" tabindex="0" data-trigger="focus"><i class="icon icon-info"></i></a></h4>

<?php  
$query = $this->db->get('user')->result();
foreach($query as $row){ 

if($row->checked == 1){
$images = [
        base_url()."images/clockimage.png",
        base_url()."images/capeimage.png",
        base_url()."images/duckimage.png",
        base_url()."images/giftimage.png",
        base_url()."images/imageseven.png",
        base_url()."images/voiletimage.png",
        base_url()."images/imageten.png",
        base_url()."images/glassesimage.png",
        base_url()."images/mouseimage.png",
        base_url()."images/cupimage.png",
];
shuffle($images); // the magic

foreach ($images as $image){ ?>
<label id="label">
<input  required  type="radio" value="<?php echo $image; ?>" name="imageSecurity"> 
<img src="<?php echo $image; ?>">
</label>

<?php }}} ?>         
</div>
</div>
<div class="row">
<div class="col-md-2">
<button type="submit" class="btn btn-sm btn-default">Login <i class="icon icon-arrow"></i></button>
</div>
<div class="col-md-10 m-t-20">
<p>Not registered? 
<a href="<?php echo site_url('Register');?>" > Click here to register.</a>
</p>
<p>To know about securities and tips <a href="">Click here.</a></p>    
</div>
</div>
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
  <script src="<?php echo base_url();?>js/vendor/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/plugins.js"></script>
<script src="<?php echo base_url();?>js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->






<script>
$('#label').change(function(){
  var img_id = $('input[name="imageSecurity"]:checked').val();
  console.log(img_id);
  });

i = 0;
 $("input#exampleInputEmail1").blur(function(){
    var id = $("input#exampleInputEmail1").val();

        $.post('<?php echo base_url()."/Customer/get_all_data"?>',{id:id},function(data, status){

            console.log(data);

            if(data > 0 ){
                $('#show_sec_img').show();
            }
            else{
                $('#show_sec_img').hide();
            }
        });




        });
window.ga = function () {
ga.q.push(arguments)
};
ga.q = [];
ga.l = +new Date;
ga('create', 'UA-XXXXX-Y', 'auto');
ga('send', 'pageview')

</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>

<?php if($this->session->flashdata('message')){?>
<div class="alert alert-success">      
<?php echo $this->session->flashdata('message')?>
</div>
<?php } ?>

</body>
<style type="text/css">
@media (max-width:736px){

img#footerlogo {
width: 66%;
}
}
</style>

    <script type="text/javascript">
$(document).ready(function(){
   $.fn.extend({
    popoverClosable: function (options) {
        var defaults = {
            template:
                '<div class="popover">\
<div class="arrow"></div>\
<div class="popover-header">\
<button type="button" class="close" data-dismiss="popover" aria-hidden="true">&times;</button>\
<h3 class="popover-title"></h3>\
</div>\
<div class="popover-content"></div>\
</div>'
,
placement:'bottom',
html: true,
        title: 'Security Image',
        content: '<div class="media"><div class="media-body">' +
        '<p style="font-size: 12px;line-height: 16px;">Security image is an additional layer of security. Please do not share it with anyone in any circumstances.<br /><br /> '
        };
        options = $.extend({}, defaults, options);
        var $popover_togglers = this;
        $popover_togglers.popover(options);
        $popover_togglers.on('click', function (e) {
            e.preventDefault();
            $popover_togglers.not(this).popover('hide');
        });
        $('html').on('click', '[data-dismiss="popover"]', function (e) {
            $popover_togglers.popover('hide');
        });
    }
});

$(function () {
    $('[data-toggle="popover"]').popoverClosable();
});
    $('[data-toggle="popover"]').click(function( event ) {
  event.preventDefault();
 
   
});
});
</script>
</html>
