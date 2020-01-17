<?php 
error_reporting(0);
include "elements/header.php";
//exit;

 $status_page_show= $this->uri->segment('3');
 $to_date= $this->uri->segment('4');
 $from_date= $this->uri->segment('5');

?>
      
        <!---->
    <img src="<?php echo base_url();?>images/etransaction.jpg" style="width: 100%">

    <div class="container" style="margin-top: 50px">
        
        <div class="col-md-12">
            <div class="col-md-3">
                
            </div>            

            <div class="col-md-9">
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
                <a href="<?php echo base_url();?>Download_cvs/contactinfo/<?php echo $from_date;?>/<?php echo $to_date;?>">
                    <Button  name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    margin-top: 25px;    float: right;    float: right;margin-left: 4px; " onclick="return confirm('Are you sure to download excel data?');">Download Excel</button>
    			</a>    




                <a href="<?php echo base_url();?>/Admin/process_contact_info">
                    <Button  name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right;margin-left: 4px;     margin-top: 25px;" ' onclick="return confirm('Are you sure to process authorize transaction?');"> Process </button>
    			</a>    

                <form action="<?php echo base_url();?>Admin/contactinfo_search" method="POST">
                    <input type="submit" name="" style="float: left; margin-top: 25px; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right; " name="ok">



                    <input type="text" id="datepickers" class="from-control"  style="width: 120px;  margin-top: 25px;  float: left;margin-bottom: -23px;float: right;height: 34px;/* font-weight: 100 !important;     font-size: 13px !important;" name="tdate" required="" placeholder="To date" >
                    
                    <input type="text" id="datepicker" class="from-control"  style="width: 120px;  margin-top: 25px;  float: left;margin-bottom: -23px;float: right;height: 34px;/* font-weight: 100 !important;    margin-top: 22px;font-size: 13px !important;" name="fdate" required="" placeholder="From date" >
                       
                    <script type="text/javascript">
                            
                            $('#datepicker').datepicker({
                                  dateFormat: 'yy-mm-dd'
                            });                           
                            $('#datepickers').datepicker({
                                  dateFormat: 'yy-mm-dd'
                            });

                    </script>



                    <select class="form-control" style="width:200px;float: left;margin-bottom: -23px;float: right;    margin-top: 25px;"  name="search_status" required="">
                        <option value="" style="display: none;">Search Status</option>
                        <option value="all">All</option>
                        <option value="Pending">Pending</option>
                        <option value="R">Reject</option>
                        <option value="A">Authorize</option>
                        <option value="O">Process</option>
                    </select>
                </form>
            </div>
            <DIV class="header-box">
                   Contact Information
            </DIV>
            <div class="table-responsvie" style=" height: 800px; overflow: auto; ">           
            <table class="table table-striped bordered ">
                <tr style=" background: #696464; color: #fff !important; ">
                    <td style=" color: #fff; ">ID</td>
                    <td style=" color: #fff; ">Folio No.</td>
                    <td style=" color: #fff; ">Phone</td>
                    <td style=" color: #fff; ">Cell</td>
                    <td style=" color: #fff; ">Email</td>
                    <td style=" color: #fff; ">Address</td>
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


if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  

if($status_page_show== "Pending"){
                         //echo "dasd";
$sql = "SELECT * FROM contactinformation where status='pending' AND (RequestDate between '$from_date' and '$to_date')  ORDER BY id DESC LIMIT $start_from, $limit";  
}
                     if($status_page_show== "A"){
$sql = "SELECT * FROM contactinformation where status='A' AND (RequestDate between '$from_date' and '$to_date')  ORDER BY id DESC LIMIT $start_from, $limit";  
                     } 
                     if($status_page_show== "R"){
$sql = "SELECT * FROM contactinformation where status='R' AND (RequestDate between '$from_date' and '$to_date')  ORDER BY id DESC LIMIT $start_from, $limit";  
                     } 
                     if($status_page_show== "O"){
$sql = "SELECT * FROM contactinformation where status='O' AND (RequestDate between '$from_date' and '$to_date')  ORDER BY id DESC LIMIT $start_from, $limit";  
                     }                        
                     else if(empty($status_page_show)){

$sql = "SELECT * FROM contactinformation where status='Pending' ORDER BY id DESC LIMIT $start_from, $limit";  
                     }  
                     

$rs_result = mysqli_query($conn, $sql);  

$status_page_show= $this->uri->segment('3');
//exit;
?> 


                <?php

                  $this->db->order_by("id","desc");
                  $this->db->from('contactinformation');

                 if($status_page_show== "Pending"){
                  $this->db->WHERE('status','Pending');
                 }
                 if($status_page_show== "A"){
                  $this->db->WHERE('status','A');
                 } 
                 if($status_page_show== "R"){
                  $this->db->WHERE('status','R');
                 } if($status_page_show== "O"){
                  $this->db->WHERE('status','O');
                 }
                 
                  
                 $tquery = $this->db->get();
                 $queryArr = $tquery->result();        
                  
                  //foreach($tquery->result() as $taa){
                 while ($taa = mysqli_fetch_assoc($rs_result)) {

                ?>

                <tr>
                    <td><?php echo $taa[id];?></td>
                    <td><?php echo $taa[Folio_No];?></td>
                    <td><?php echo $taa[phone];?></td>
                    <td><?php echo $taa[cell];?></td>
                    <td><?php echo $taa[email];?></td>
                    <td><?php echo $taa[address];?></td>
                    <td><?php if($taa[status]=="Pending"){echo "Pending";} else if($taa[status]=="A"){echo "Authorize";} else if($taa[status]=="R"){echo "Reject";} else if($taa[status]=="O"){echo "Process";}?></td>
                   <td> 
                   
                    <a href="" data-toggle="modal" data-target="#message<?php echo $taa[id];?>" style=" background: #069198; color: #fff; padding-left: 6px; padding-right: 6px; text-decoration: none; ">View Details</a><br>
                    
                    <?php if($taa[status]=="R" OR $taa[status]=="Pending" ){?>
                    <a href="" data-toggle="modal" data-target="#authorize<?php echo $taa[id];?>" style=" background: #069198; color: #fff; padding-left: 10px; padding-right: 10px; text-decoration: none; ">Authorized</a><br>
                    <?php } ?>
                    
                    <?php if($taa[status]=="A" OR $taa[status]=="Pending" ){?>
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
        $result_rej = $this->db->get('contactinformation')->result_array();
        ?>
          <form action="<?php echo base_url();?>Admin/reject_contactinfo" method="post">

        <input type="hidden" name="previous_status" value="<?php echo $result_rej[0]['status']; ?>">
        
        <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>">
        <?php if($result_rej[0]['status'] == "A"){?>
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
        $result_auth = $this->db->get('contactinformation')->result_array();
        ?>
          <form action="<?php echo base_url();?>Admin/authorized_contactinfo" method="post">

        <input type="hidden" name="previous_status" value="<?php echo $result_auth[0]['status']; ?>">
        
        <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>">
        
        <?php if($result_auth[0]['status'] == "R"){?>
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
        //echo $trans_id;
        $this->db->select('*');
        $this->db->where('id',$trans_id);
        $result_tran_id = $this->db->get('contactinformation')->result_array();
        ?>
        <div class="modal-body">    
            <div class="col-md-6">
                UserID
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['Folio_No']; ?>
            </div>
            <div class="col-md-6">
                Phone
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['phone']; ?>
            </div>
            <div class="col-md-6">
                Cell
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['cell']; ?>
            </div>
            <div class="col-md-6">
                Email
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['email']; ?>
            </div>
            <div class="col-md-6">
                Address<br>
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['address']; ?>
            </div>            
            <div class="col-md-6">
                Status
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['status']; ?>
            </div>    
            <div class="col-md-6">
                Requestor IP
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['Requestor_IP']; ?>
            </div>
                        <div class="col-md-6">
                Authorize_By
            </div>
            <div class="col-md-6">
                <?php if($result_tran_id[0]['Authorize_By'] !=""){echo $result_tran_id[0]['Authorize_By'];}else{echo "-";} ?>
                
            </div>            
            <div class="col-md-6">
                Authorize Date
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['Authorize_Date']; ?>
            </div>            
            <div class="col-md-6">
                Authorize Time
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['Authorize_Time']; ?>
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


 



                
                
                  <?php 
                       
                    }
                 ?>             




    <script>
        $(document).on("click", ".open-AddBookDialog", function () {
             var myBookId = $(this).data('id');
             $(".modal-body #bookId").val( myBookId );
        });

    
    </script>
                



               
            </table>
            
            <?php  
$sql = "SELECT COUNT(id) FROM contactinformation";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<nav><ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<li><center><a href='../Admin/contact_info?page=".$i."'>".$i."</a></center></li>";  
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
		hrefTextPrefix : '../Admin/contact_info?page='
    });
	});
</script>
            
            
            
        </div>
    </div>

<?php 
include "elements/footer.php";

?>

<style type="text/css">
    .header-box{
    background: #069198;
    color: #fff;
    padding: 20px;
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
.modal-dialog {
    width: 64%;
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