<?php
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

if($row->checked == 0){
?>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog sel-img">

<!-- Modal content-->
<div class="modal-content">
<form method="post" action="<?php echo base_url();?>Customer/save_sec_img" autocomplete="off">
<div class="modal-header">
<h4 class="modal-title">Security Check</h4>
</div>
<div class="modal-body">
<div class="row" style="text-align:center;">

<div class="imageselection modal-select">
<h4 class="info-2">Please select an image for 2 factor authentication</h4>
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

</div>



</div>
<div class="modal-footer">

<input  type="hidden" value="<?php echo $foliodata; ?>" name="folio_id"> 
<h4 style="display:none;" class="error" id="msg">Image does not match.</h4>
<button  type="Submit" id="btn"  class="btn btn-lg btn-default" style="margin:0 auto;">Submit</button>
</div>
</form>

</div>

</div>
</div>



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



$('#label').change(function(){
var img_id = $('input[name="imageSecurity"]:checked').val();
console.log(img_id);
});
$('#myModal').modal({
backdrop: 'static',
keyboard: false
});
</script>


<?php }} ?>