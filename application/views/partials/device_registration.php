<?php 
$this->db->where('Folio_No',$foliodata);
$query = $this->db->get('user');
$array = array();
// echo '<pre>';print_r($query->result());
// die;
foreach($query->result() as $row){ 

if($row->checked == 1){

    if(!isset($_COOKIE['cookie_id']))
        {
            if(!isset($_SESSION['skip'])){


?>
<!-- Modal device registration -->

<div class="modal fade" id="myModal1" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><p>Device Registration</p></h4>
</div>
<div class="modal-body">
<p>We at HBL Asset Management Ltd. are constantly striving to ensure that your Investments are safe. Keeping this in view, we are pleased to announce “Device Registration”. With this new feature, we aim to provide you the peace of mind while ensuring that your investments stay safe.</p>
<p>
We strongly recommend you to click “Yes” underneath and register your device. 
</p>

<form method="POST" action="<?php echo base_url();?>Customer/dr_otp" style="display: inline-block;">
<button type="submit" name="btn" value="yes" class="btn btn-default">
Yes 
</button>
</form>
<form method="POST" action="<?php echo base_url();?>Customer/skip" style="display: inline-block;">
<button type="submit" name="skip" value="skip"  class="btn btn-default">
Skip 
</button>
</form>
</div>

</div>

</div>
</div>

<script type="text/javascript">
$(window).on('load',function(){
$('#myModal1').modal('show');
});

</script>
<?php  }}}} ?>