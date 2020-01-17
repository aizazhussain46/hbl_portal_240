<?php 
include "elements/header.php";
$status_page_show= $this->uri->segment('3');
$to_date= $this->uri->segment('4');
$from_date= $this->uri->segment('5');
?>

<!---->
<img src="<?php echo base_url();?>images/etransaction.jpg" style="width: 100%">

<div class="container" style="margin-top: 50px;">

<div class="col-md-12">
<div class="header-box">
<div class="col-md-3">
Transactions
</div> 
<div class="col-md-9">
                <a href="<?php echo base_url();?>/Download_cvs_inv/excel_inv/<?php echo $from_date;?>/<?php echo $to_date;?>">
<button name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right;margin-left: 4px; " onclick="return confirm('Are you sure to download data in excel?');">Download Excel</button>
</a>    
<!--
<a href="http://10.6.209.240/pro/hbl-portal//Admin/process_transaction">
<Button  name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right;margin-left: 4px; " ' onclick="return confirm('Are you sure to process authorize transaction?');"> Process </button>
</a>    
-->
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
</style>


<form action="<?php echo base_url();?>Admin/investment_search" method="POST" id="f1">
<input type="submit" name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right; ">

<input type="text" id="datepickers" class="form-control hasDatepicker" style="width: 120px;float: left;margin-bottom: -23px;float: right;height: 34px;/* font-weight: 100 !important;     font-size: 13px !important;" name="tdate" required="false" placeholder="To date">

<input type="text" id="datepicker" class="form-control hasDatepicker" style="width: 120px;float: left;margin-bottom: -23px;float: right;height: 34px;/* font-weight: 100 !important;     font-size: 13px !important;" name="fdate" required="false" placeholder="From date">

<script type="text/javascript">

$('#datepicker').datepicker({
dateFormat: 'yy-mm-dd',
required: false
});                           
$('#datepickers').datepicker({
dateFormat: 'yy-mm-dd',
required: false
});

      


//Blank Case >> Show/Download All
//$("#datepicker").datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "0");
//$("#datepickers").datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "0");

</script>

<select class="form-control" style=" width:200px;float: left; margin-bottom: -23px;     float: right;" name="search_status" required="">
<option value="" style="display: none;">Search Status</option>
<option value="all">All</option>
<option value="Pending">Pending</option>
<option value="Rejected">Rejected</option>
<option value="Approved">Approved</option>
</select>


</form>    

</div>

</div>
<div class="table-responsvie" style="  overflow: auto; ">           
<table class="table table-striped bordered ">
<tr style=" background: #696464; color: #fff !important; ">
<td style=" color: #fff; ">Folio</td>
<td style=" color: #fff; ">Account Title</td>
<td style=" color: #fff; ">Reference ID<br>(IBFT transaction number)</td>
<td style=" color: #fff; ">Fund Name</td>
<td style=" color: #fff; ">CNIC</td>
<td style=" color: #fff; ">Bank</td>
<td style=" color: #fff; ">Amount</td>
<td style=" color: #fff; ">Trancaction ID</td>
<td style=" color: #fff; ">Status</td>
<td style=" color: #fff; ">Agreed</td>
<td style=" color: #fff; ">Comments</td>
<td style=" color: #fff; ">Created at</td>
<td style=" color: #fff; ">Options</td>


</tr>


<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/simplePagination.css" />
<script src="<?php echo base_url();?>css/jquery.simplePagination.js"></script>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "240";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
} 

$limit = 10;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  

//echo $status_page_show; 
if($status_page_show== "all"){
	$sql = "SELECT * FROM ibft where (created_date between '$from_date' - interval 1 day and '$to_date') ORDER BY id DESC LIMIT $start_from, $limit"; 

}


if($status_page_show== "Pending"){
	
	$sql = "SELECT * FROM ibft where (created_date between '$from_date' - interval 1 day and '$to_date') ORDER BY id DESC LIMIT $start_from, $limit"; 

}

//Authorize
if($status_page_show== "Approved"){
$sql = "SELECT * FROM ibft where status='Approved' AND (created_date between '$from_date' - interval 1 day and '$to_date') ORDER BY id DESC LIMIT $start_from, $limit";  

}

if($status_page_show== "Rejected"){
$sql = "SELECT * FROM ibft where status='Rejected' AND (created_date between '$from_date' - interval 1 day and '$to_date') ORDER BY id DESC LIMIT $start_from, $limit";  

}
else if(empty($status_page_show)){
$sql = "SELECT * FROM ibft ORDER BY id DESC LIMIT $start_from, $limit";  

}
//Authorize

if(empty($status_page_show)){
$sql = "SELECT * FROM ibft ORDER BY id DESC LIMIT $start_from, $limit"; 

}

$rs_result = mysqli_query($conn, $sql);  
?> 

<?php
$this->db->order_by('id','desc');

$this->db->from('ibft');


$tquery = $this->db->get();
//print_r($tquery);exit;
$queryArr = $tquery->result();        

//foreach($queryArr as $taa ){
$filtered =  [];
$yesterday = date('Y-m-d',strtotime($from_date . "-1 days"));

while($row = mysqli_fetch_assoc($rs_result)) {
	$folio= $row['folio_no'];
	if($yesterday == $row['created_date'] && $row['created_time'] >= '04:00:00pm'){
	$filtered[] = $row;			
	}
	if($to_date == $row['created_date'] && $row['created_time'] <= '03:59:59pm'){
	$filtered[] = $row;			
	}

	if($from_date != $to_date){
		if($yesterday != $row['created_date'] && $to_date != $row['created_date']){
		$filtered[] = $row;			
		}
	}
}
foreach ($filtered as $value) {
	$nd = new DateTime($value['created_date']);
	//echo $nd->format('d-m-Y');
?>
<tr>
<td><?php echo $value['folio_no'].$test;?></td>
<td><?php echo $value['name'];?></td>
<td><?php echo $value['ref_no'];?></td>
<td><?php echo explode(':', $value['select_fund'])[1];?></td>
<td><?php echo $value['cnic_no'];?></td>
<td><?php echo $value['select_bank'];?></td>
<td><?php echo $value['amount'];?></td>
<td><?php echo $value['transaction_id'];?></td>
<td><?php echo $value['status'];?></td>
<td><?php echo $value['agreed'];?></td>
<td><?php echo $value['comments'];?></td>
<td><?php echo $nd->format('d-m-Y').'<br>'.$value['created_time'];?></td>

<td>
<form action="<?php echo base_url();?>Admin/investment_activity" method="POST">
<input type="hidden" name="id" id="hid" value="<?php echo $value['id'];?>">




<input type="submit" name="approve" <?php if ($value[status] == 'Approved') {echo 'disabled=""';}?> class="btn" value="Approve" style="padding:4px;color: #fff; background: #069198; font-size: 10px;"/>
<button id="rej" type="button" class="btn btn-danger" <?php if ($value[status] == 'Rejected') {echo 'disabled=""';}?> data-toggle="modal" style="margin-top: 3%;padding: 4px 9.5px;color: #fff; font-size: 10px;" data-target="#myModal<?php echo $taa[id];?>">
Reject</button>





<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $value[id];?>" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background: #069198;color:#fff;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Reason to Reject.</h4>
</div>
<div class="modal-body">
<textarea type="text" name="comments" class="form-control" rows="5"></textarea>
<br>
<input type="submit" name="reject" class="btn" style="background: #069198;color:#fff;" value="Submit" />

</div>

</div>

</div>
</div>




</form>

</td>

</tr>




<?php } ?>             





</table>






<?php  
$sql = "SELECT COUNT(id) FROM ibft";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<nav><ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
$pagLink .= "<li><center><a href='../Admin/investments?page=".$i."'>".$i."</a></center></li>";  
};  
echo $pagLink . "</ul></nav>";  
?>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('.pagination').pagination({
items: <?php echo $total_records;?>,
itemsOnPage: <?php echo $limit;?>,
cssStyle: 'light-theme',
currentPage : <?php echo $page;?>,
hrefTextPrefix : '../Admin/investments?page='
});
});
</script>




</div>
</div>

<script>
$(document).on("click", ".open-AddBookDialog", function () {
var myBookId = $(this).data('id');
$(".modal-body #bookId").val( myBookId );



});


</script>

<?php 
include "elements/footer.php";

?>

<style type="text/css">
.header-box{
background: #069198;
color: #fff;
padding: 20px;
height: 70px;
}
.body {
background: #fff;
padding: 20px;    padding-bottom: 50px !important;
}
.body .col-md-6 {
margin-bottom: 20px !important;
}
.body{
height: 200px;    margin-bottom: 35px;
}
td {
font-size: 12px !important;
}
.btn-success {
color: #fff;
background-color: #069198;
border-color: #069198;
}
.btn-success:active {
color: #fff;
background-color: #069198;
border-color: #069198;
}
.btn-success:hover {
color: #fff;
background-color: #696464;
border-color: #696464;
}
.modal-footer {
padding: 15px;
text-align: right;
border-top: 0px solid #e5e5e5;
margin-top: 60px;
}
.modal-body .col-md-6 {
border: 1px solid #cecccc;
padding: 8px;
}
.pagination>li>a, .pagination>li>span {
position: relative;
float: left;
padding: 6px 12px;
margin-left: -1px;
line-height: 1.42857143;
color: #069198;
text-decoration: none;
background-color: #fff;
border: 1px solid #ddd;
}
.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
z-index: 2;
color: #fff;
cursor: default;
background-color: #069198 !important;
border-color: #069198 !important;
}
ul.pagination.light-theme.simple-pagination {
margin: 0 auto !important;
display: inherit;
text-align: center;
margin-top: 20px !important;
}
</style>