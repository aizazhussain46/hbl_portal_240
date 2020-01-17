<?php 
include "elements/header-bank.php";
$this->load->database();
$this->db->select('*');
$result = $this->db->get('binary_data')->result_array();
$data = array();
foreach ($result as $row) {
$data[] = $row;
}
shuffle($data);

$this->db->where('Folio_No',$foliodata);
$query = $this->db->get('user');
$array = array();
// echo '<pre>';print_r($query->result());
// die;
foreach($query->result() as $row){ 
?>


<div class="page-title">
    <div class="container">
    <div class="row">
        <h1 class="h1">
            <span>Change Password</span>
        </h1>
    </div>
    </div>
</div>

<div class="gray-area">
<div class="container">
<ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Change Password</a></li>
        <li><a data-toggle="tab" href="#menu1">Change Security Image</a></li>
        </ul>

<div class="tab-content">
<div id="home" class="tab-pane fade in active">
<div class="profile-page row">
<div class="col-md-12">
<div class="card">
<div class="h2 gradient-1">Change Password</div>
<div class="clearfix">
<form method="post" action="<?php echo base_url().'Customer/passchanged'; ?>">
<div class="form-group">
<label for="exampleInputEmail1" class="control-label">Current Password</label>
<input required="" type="password" name="oldpass"  class="form-control" id="exampleInputEmail1" placeholder="" required="">
</div>
<div class="form-group">
<div class="row less-margin">
<label for="exampleInputPassword1" class="control-label pull-left">New Password</label>
</div>
<input type="password" pattern="^(?=.*\d)(?=.*[a-zA-Z])(?=.*[A-Za-z])(?!.*\s).*$" title="Must be alpha numeric password" min="6" class="form-control" id="exampleInputPassword1" placeholder=""  name="pass" required="" >
</div>
<div class="form-group">
<div class="row less-margin">
<label for="exampleInputPassword1" class="control-label pull-left">Confirm  New Password</label>
</div>
<input type="password" pattern="^(?=.*\d)(?=.*[a-zA-Z])(?=.*[A-Za-z])(?!.*\s).*$" title="Must be alpha numeric password" class="form-control" id="exampleInputPassword1" placeholder=""  name="cpass" required="" >
</div>
<div class="row">
<div class="col-md-2">
<button type="submit" class="btn btn-sm btn-default">Submit <i class="icon icon-arrow"></i></button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>

</div>
<div id="menu1" class="tab-pane fade">
<form method="post" action="<?php echo base_url();?>Customer/save_sec_img" autocomplete="off">
<div class="profile-page row">
<div class="col-md-12">
<div class="card">
<div class="h2 gradient-1">Change Security Image</div>
<div class="clearfix">
<div class="imageselection modal-select">
<?php  foreach ($data as $key => $image){ ?>
<label id="label">
<input  required  type="radio" value="<?php echo $image['id'];?>" name="imageSecurity"> 
<?php echo '<img src="data:image/png;base64,'.base64_encode($image['img']).'"/>'; ?>

</label>
<?php }?>         
</div>
<div class="row" style="text-align:center;">
<div class="imageselection c_selection" style="display:none;">
<h4 style="width: 100%;">Please re-select the same image.</h4>
<br>
<?php  foreach ($data as $key => $image){ ?>
<label id="label">
<input  required  type="radio" value="<?php echo $image['id'];?>" name="c_imageSecurity"> 
<?php echo '<img src="data:image/png;base64,'.base64_encode($image['img']).'"/>'; ?>

</label>
<?php }?>             
</div>
<input  type="hidden" value="<?php echo $foliodata; ?>" name="folio_id"> 
<h4 style="display:none; width: 100%" class="error" id="msg">Image does not match.</h4>
<h4 id="img_selected" style="display: none;
    margin: 0 auto;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 10px;">Image Selected.</h4>
<button  type="Submit" id="btn"  class="btn btn-lg btn-default" style="margin:0 auto;">Submit</button>

</div>

</div>
</div>
</div>
</div>
</div>

</form>
</div>

</div> 
</div>
<?php }?>  



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
$(window).on('load',function(){
$('#myModal').modal('show');
});



$('#myModal').modal({
backdrop: 'static',
keyboard: false
});
</script>


<?php include "elements/footer-bank.php";?>