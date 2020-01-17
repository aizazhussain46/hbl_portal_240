<?php 


include "elements/header.php";
$status_page_show= $this->uri->segment('3');
 $to_date= $this->uri->segment('4');
 $from_date= $this->uri->segment('5');
?>
	  
		<!---->
    <img src="<?php echo base_url();?>images/etransaction.jpg" style="width: 100%">

    <div class="container" style="margin-top: 50px">
    	
    	<div class="col-md-12">
    	     <DIV class="header-box">
    	        <div class="col-md-3">
    	            Transactions
    	        </div> 
    			<div class="col-md-9">
                    
                <a href="<?php echo base_url();?>/Download_cvs/excel/<?php echo $from_date;?>/<?php echo $to_date;?>">
                    <Button  name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right;margin-left: 4px; " onclick="return confirm('Are you sure to download excel data?');">Download Excel</button>
    			</a>    

                <a href="<?php echo base_url();?>/Admin/process_transaction">
                    <Button  name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right;margin-left: 4px; " ' onclick="return confirm('Are you sure to process authorize transaction?');"> Process </button>
    			</a>    

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


    			<form action="<?php echo base_url();?>Admin/transaction_search" method="POST">
                    <input type="submit" name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right; " name="ok">

                    <input type="text" id="datepickers" class="from-control"  style="width: 120px;float: left;margin-bottom: -23px;float: right;height: 34px;/* font-weight: 100 !important;     font-size: 13px !important;" name="tdate" required="" placeholder="To date" >
                    
                    <input type="text" id="datepicker" class="from-control"  style="width: 120px;float: left;margin-bottom: -23px;float: right;height: 34px;/* font-weight: 100 !important;     font-size: 13px !important;" name="fdate" required="" placeholder="From date" >
                       
                    <script type="text/javascript">
                            
                            $('#datepicker').datepicker({
                                  dateFormat: 'yy-mm-dd'
                            });                           
                            $('#datepickers').datepicker({
                                  dateFormat: 'yy-mm-dd'
                            });

                    </script>

                    <select class="form-control" style=" width:200px;float: left; margin-bottom: -23px;     float: right;"  name="search_status" required="">
                        <option value="" style="display: none;">Search Status</option>
                        <option value="all">All</option>
                        <option value="P">Pending</option>
                        <option value="R">Reject</option>
                        <option value="A">Authorize</option>
                        <option value="O">Process</option>
                    </select>
                    

                </form>    
    			    
    			</div>
                
    	    </div>


    	    
    		<div class="table-responsvie" style="  overflow: auto; ">           
            <table class="table table-striped bordered ">
                <tr style=" background: #696464; color: #fff !important; ">
                    <td style=" color: #fff; ">ID.</td>
                    <td style=" color: #fff; ">Date Time</td>
                    <td style=" color: #fff; ">Folio</td>
                    <td style=" color: #fff; ">Referance No</td>
                    <td style=" color: #fff; ">Transaction Type</td>
                    <td style=" color: #fff; ">Source Fund</td>
                    <td style=" color: #fff; ">Destination Fund</td>
                    <td style=" color: #fff; ">Amount</td>
                    <td style=" color: #fff; ">Unit</td>
                    <td style=" color: #fff; ">Status</td>
                    <td style=" color: #fff; ">Options</td>
                </tr>


<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/simplePagination.css" />
<script src="<?php echo base_url();?>css/jquery.simplePagination.js"></script>

  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sysmtech_hbl";

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
if($status_page_show== "P"){
$sql = "SELECT * FROM transactionrequest where Status='P' AND (RequestDate between '$from_date' and '$to_date') ORDER BY id DESC LIMIT $start_from, $limit";  
}
if($status_page_show== "A"){
$sql = "SELECT * FROM transactionrequest where Status='A' AND (RequestDate between '$from_date' and '$to_date') ORDER BY id DESC LIMIT $start_from, $limit";  
}
if($status_page_show== "O"){
$sql = "SELECT * FROM transactionrequest where Status='O' AND (RequestDate between '$from_date' and '$to_date') ORDER BY id DESC LIMIT $start_from, $limit";  
}
if($status_page_show== "R"){
$sql = "SELECT * FROM transactionrequest where Status='R' AND (RequestDate between '$from_date' and '$to_date') ORDER BY id DESC LIMIT $start_from, $limit";  
}
else if(empty($status_page_show)){
$sql = "SELECT * FROM transactionrequest ORDER BY id DESC LIMIT $start_from, $limit";  

}
//print_r($sql);
$rs_result = mysqli_query($conn, $sql);  
?> 

<?php
$this->db->order_by('id','desc');

  $this->db->from('transactionrequest');

 if($status_page_show== "P"){
  $this->db->WHERE('Status','P');
  
 }
 if($status_page_show== "A"){
  $this->db->WHERE('Status','A');
 } 
 if($status_page_show== "R"){
  $this->db->WHERE('Status','R');
 } if($status_page_show== "O"){
  $this->db->WHERE('Status','O');
 }
 

  $tquery = $this->db->get();
  //print_r($tquery);exit;
  $queryArr = $tquery->result();        

  //foreach($queryArr as $taa ){
  while ($taa = mysqli_fetch_assoc($rs_result)) {
  $folio= $taa[FolioNo];

$this->db->select('*');
$this->db->where('Folio_No',$folio);
$result1 = $this->db->get('investorprofileinfo')->result_array();        

?>



                <tr>
                    <td><?php echo $taa[id];?></td>
                    <td><?php echo $taa[RequestDate].'<br> '.$taa[RequestTime];?></td>
                    <td><?php echo $folio;?></td>
                    <td><?php echo $taa[ReferenceID];?></td>
                    <td><?php if($taa[RequestType]=="R"){echo "Redemption";}if($taa[RequestType]=="T"){echo "Conversion";}?></td>

                    <td><?php if($taa[Source_Fund_Code] != "0"){ echo $taa[Source_Fund_Code];}else{ echo '-';}?></td>
                    <td><?php echo $taa[Dest_Fund_Code];?></td>
                    <td><?php echo $taa[RequestAmount];?></td>
                    <td><?php echo $taa[RequestUnit];?></td>
                    <td><?php if($taa[Status]=="P"){echo "Pending";} else if($taa[Status]=="A"){echo "Authorize";} else if($taa[Status]=="R"){echo "Reject";} else if($taa[Status]=="O"){echo "Process";}?></td>
                    <td>
                    
                    <p>
                    
                    </p>
                    <a href="" data-toggle="modal" data-target="#message<?php echo $taa[id];?>" style=" background: #069198; color: #fff; padding-left: 6px; padding-right: 6px; text-decoration: none; ">View Details</a><br>
                    
                    <?php if($taa[Status]=="R" OR $taa[Status]=="P" ){?>
                    <a href="" data-toggle="modal" data-target="#authorize<?php echo $taa[id];?>" style=" background: #069198; color: #fff; padding-left: 10px; padding-right: 10px; text-decoration: none; ">Authorized</a><br>
                    <?php } ?>
                    
                    <?php if($taa[Status]=="A" OR $taa[Status]=="P" ){?>
                    <a href="" data-toggle="modal" data-target="#reject<?php echo $taa[id];?>" style=" background: #069198; color: #fff; padding-left: 23px; padding-right: 25px;text-decoration:none; ">Reject</a>
                    <?php } ?>
                    </td>
            
                </tr>
                

  <!-- Reject Modal -->
  <div class="modal fade" id="reject<?php echo $trans_id= $taa[id];?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" margin-top: 15%; ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to reject this user?</p><br>

        <?php
        $this->db->select('*');
        $this->db->where('id',$trans_id);
        $result_rej = $this->db->get('transactionrequest')->result_array();
        ?>
          <form action="<?php echo base_url();?>Admin/reject" method="post">

        <input type="hidden" name="previous_status" value="<?php echo $result_rej[0]['Status']; ?>">
        
        <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>">
        <?php if($result_rej[0]['Status'] == "A"){?>
        <label>Reason</label><br>

        <textarea required="" class="form-control" name="reason" style="height:100px"><?php echo $result_rej[0]['Reject_Reason'];?></textarea><br>
        <?php } ?>
          <input type="submit" style="background: #069198;color: #fff;padding: 8px 15px 8px 15px;margin-right: 3px;text-decoration: none;" class="btn btn-default"  value="Yes">

          </form>
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      
    </div>
  </div>



  <!-- Authorize Modal -->
  <div class="modal fade" id="authorize<?php echo $trans_id= $taa[id];?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" margin-top: 15%; ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to authorize this user?</p><br>

        <?php
        $this->db->select('*');
        $this->db->where('id',$trans_id);
        $result_auth = $this->db->get('transactionrequest')->result_array();
        ?>
          <form action="<?php echo base_url();?>Admin/authorized" method="post">

        <input type="hidden" name="previous_status" value="<?php echo $result_auth[0]['Status']; ?>">
        
        <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>">
        
        <?php if($result_auth[0]['Status'] == "R"){?>
        <label>Reason</label><br>

        <textarea required="" class="form-control" name="aut_reason" style="height:100px"><?php echo $result_auth[0]['Authorize_Reason'];?></textarea><br>
        <?php } ?>

          <input type="submit" style="background: #069198;color: #fff;padding: 8px 15px 8px 15px;margin-right: 3px;text-decoration: none;" class="btn btn-default"  value="Yes">

          </form>
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      
    </div>
  </div>



  <!-- Modal View Details-->
  <div class="modal fade" id="message<?php echo $trans_id= $taa[id];?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Transaction Details</h4>
        </div>
        
        <?php
        $this->db->select('*');
        $this->db->where('id',$trans_id);
        $result_tran_id = $this->db->get('transactionrequest')->result_array();
        ?>
        <div class="modal-body">    
            <div class="col-md-6">
                Folio No
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['FolioNo']; ?>
            </div>
            <div class="col-md-6">
                Request Type
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['RequestType'] == "R"){echo "Redemption";} else if($result_tran_id[0]['RequestType'] == "T"){echo "Conversion";} else if($result_tran_id[0]['RequestType'] == "I"){echo "Investment";} ?>
            </div>
            <div class="col-md-6">
                Source
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['Source_Fund_Code']; ?>
            </div>
            <div class="col-md-6">
                Destination
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['Dest_Fund_Code']; ?>
            </div>
            <div class="col-md-6">
                Request Amount
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['RequestAmount']; ?>
            </div>
            <div class="col-md-6">
                Unit
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['RequestUnit']; ?>
            </div>
            <div class="col-md-6">
                Date
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['RequestDate']; ?>
            </div>
            <div class="col-md-6">
                Time
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['RequestTime']; ?>
            </div>
            <div class="col-md-6">
                Reference ID
            </div>
            <div class="col-md-6">
                <?php echo strtoupper($result_tran_id[0]['ReferenceID']); ?>
            </div>
            <div class="col-md-6">
                Status
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Status']=="P"){echo "Pending";} else if($result_tran_id[0]['Status']=="A"){echo "Authorize";} else if($result_tran_id[0]['Status']=="R"){echo "Reject";}else if($result_tran_id[0]['Status']=="O"){echo "Process";}?>
            </div>
            <div class="col-md-6">
                Remarks
            </div>
            <div class="col-md-6">
                <?php echo strtoupper($result_tran_id[0]['Remarks']); ?>
            </div>


            <div class="col-md-6">
                Insert Date
            </div>
            <div class="col-md-6">
                <?php echo strtoupper($result_tran_id[0]['InsertDate']); ?>
            </div>
            <div class="col-md-6">
                InsertTime
            </div>
            <div class="col-md-6">
                <?php echo strtoupper($result_tran_id[0]['InsertTime']); ?>
            </div>
            <div class="col-md-6">
                Insert By
            </div>
            <div class="col-md-6">
                <?php echo strtoupper($result_tran_id[0]['InsertBy']); ?>
            </div>
            <div class="col-md-6">
                Update Date
            </div>
            <div class="col-md-6">
                <?php echo strtoupper($result_tran_id[0]['UpdateDate']); ?>
            </div>
            <div class="col-md-6">
                Update Time
            </div>
            <div class="col-md-6">
                <?php echo strtoupper($result_tran_id[0]['UpdateTime']); ?>
            </div>

            <div class="col-md-6">
                Update By
            </div>
            <div class="col-md-6">
                <?php echo strtoupper($result_tran_id[0]['UpdateBy']); ?>
            </div>
            <div class="col-md-6">
                Update Status
            </div>
            <div class="col-md-6">
                <?php echo strtoupper($result_tran_id[0]['UpdateStatus']); ?>
            </div>
            <div class="col-md-6">
                Current Balance
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['CurrentBalance']; ?>
            </div>
            <div class="col-md-6">
                Payment Mode
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['paymentmode']; ?>
            </div>
            <div class="col-md-6">
                Bank Name
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['bankname'] !="0"){echo $result_tran_id[0]['bankname'];}else{echo "-";} ?>
            </div>

            <div class="col-md-6">
                Account Number
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['accountnumber'] !="0"){echo $result_tran_id[0]['accountnumber'];}else{echo "-";} ?>
            </div>
            <div class="col-md-6">
                Cheque Intrument No
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['cheque_intrument_no'] !="0"){echo $result_tran_id[0]['cheque_intrument_no'];}else{echo "-";} ?>
            </div>

            <div class="col-md-6">
                Requestor IP
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Requestor_IP'] !=""){echo $result_tran_id[0]['Requestor_IP'];}else{echo "-";} ?>
            </div>
            <div class="col-md-6">
                Authorize By
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Authorize_By'] !=""){echo $result_tran_id[0]['Authorize_By'];}else{echo "-";} ?>
            </div>
            <div class="col-md-6">
                Authorize Date
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Authorize_Date'] !=""){echo $result_tran_id[0]['Authorize_Date'];}else{echo "-";} ?>
            </div>

            <div class="col-md-6">
                Authorize Time
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Authorize_Time'] !=""){echo $result_tran_id[0]['Authorize_Time'];}else{echo "-";} ?>
            </div>
      

            <div class="col-md-6">
                Authorize Reason
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Authorize_Reason'] !=""){echo $result_tran_id[0]['Authorize_Reason'];}else{echo "-";} ?>
            </div>
            <div class="col-md-6">
                Reject By
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Reject_By'] !=""){echo $result_tran_id[0]['Reject_By'];}else{echo "-";} ?>
            </div>



            <div class="col-md-6">
                Reject Date
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Reject_Date'] !=""){echo $result_tran_id[0]['Reject_Date'];}else{echo "-";} ?>
            </div>
            <div class="col-md-6">
                Reject Time
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Reject_Time'] !=""){echo $result_tran_id[0]['Reject_Time'];}else{echo "-";} ?>
            </div>            <div class="col-md-6">
                Reject Reason
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Reject_Reason'] !=""){echo $result_tran_id[0]['Reject_Reason'];}else{echo "-";} ?>
            </div>
            <div class="col-md-6">
                Previous Status
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['PreviousStatus'] !=""){echo $result_tran_id[0]['PreviousStatus'];}else{echo "-";} ?>
            </div>    
    
            <div class="col-md-6">
                Process By
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Process_By'] !=""){echo $result_tran_id[0]['Process_By'];}else{echo "-";} ?>
            </div>            <div class="col-md-6">
                Process Date
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Process_Date'] !=""){echo $result_tran_id[0]['Process_Date'];}else{echo "-";} ?>
            </div>
            <div class="col-md-6">
                Process Time
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Process_Time'] !=""){echo $result_tran_id[0]['Process_Time'];}else{echo "-";} ?>
            </div>     
    
    

        <br><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


  <?php }
 ?>             





            </table>
            
<?php  
$sql = "SELECT COUNT(id) FROM transactionrequest";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<nav><ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<li><center><a href='../Admin/transaction?page=".$i."'>".$i."</a></center></li>";  
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
		hrefTextPrefix : '../Admin/transaction?page='
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