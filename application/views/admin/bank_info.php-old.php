<?php 
error_reporting(0);
include "elements/header.php";
$status_page_show= $this->uri->segment('3');

     //   exit;

?>
      
        <!---->
    <img src="<?php echo base_url();?>images/etransaction.jpg" style="width: 100%">

    <div class="container" style="margin-top: 50px">
        
        <div class="col-md-12">
            <div class="col-md-6">
                
            </div>            

            <div class="col-md-6">
                <a href="<?php echo base_url();?>/Download_cvs/bankinfo">
                    <Button  name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    margin-top: 25px;    float: right;    float: right;margin-left: 4px; " onclick="return confirm('Are you sure to download excel data?');">Download Excel</button>
    			</a>    

                <a href="<?php echo base_url();?>/Admin/process_bank_info">
                    <Button  name="" style="float: left; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right;margin-left: 4px;     margin-top: 25px;" ' onclick="return confirm('Are you sure to process authorize transaction?');"> Process </button>
    			</a>    

                <form action="<?php echo base_url();?>Admin/bank_info_search" method="POST">
                    <input type="submit" name="" style="float: left; margin-top: 25px; margin-bottom: -23px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    float: right; " name="ok">

                    <select class="form-control" style=" width: 50%; float: left; margin-top: 25px; margin-bottom: -23px;     float: right;"  name="search_status" required="">
                        <option value="" style="display: none;">Search Status</option>
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="R">Reject</option>
                        <option value="A">Authorize</option>
                        <option value="O">Process</option>
                    </select>
                </form>
            </div>
            
            <DIV class="header-box">
                   Bank Information
            </DIV>
            <div class="table-responsvie" style=" height: 800px; overflow: auto; ">           
            <table class="table table-striped bordered ">
                <tr style=" background: #696464; color: #fff !important; ">
                    <td style=" color: #fff; ">ID</td>
                    <td style=" color: #fff; ">Folio No.</td>
                    <td style=" color: #fff; ">Account Number</td>
                    <td style=" color: #fff; ">Account Title</td>
                    <td style=" color: #fff; ">Bank Name</td>
                    <td style=" color: #fff; ">Bank Address</td>
                    <td style=" color: #fff; ">Status</td>
                    <td style=" color: #fff; ">Options</td>
                </tr>

                <?php


                  $this->db->from('bankinformation');
                  $this->db->order_by("id","desc");
                     if($status_page_show== "pending"){
                         //echo "dasd";
                      $this->db->WHERE('status','pending');
                     }
                     if($status_page_show== "A"){
                      $this->db->WHERE('status','A');
                     } 
                     if($status_page_show== "R"){
                      $this->db->WHERE('status','R');
                     } 
                     if($status_page_show== "O"){
                      $this->db->WHERE('status','O');
                     }                  
                      
                  $tquery = $this->db->get();
                  foreach($tquery->result() as $taa){

                ?>

                <tr>
                    <td><?php echo $taa->id;?></td>
                    <td><?php echo $taa->Folio_No;?></td>
                    <td><?php echo $taa->accountnumber;?></td>
                    <td><?php echo $taa->accounttitle;?></td>
                    <td><?php echo $taa->bankname;?></td>
                    <td><?php echo $taa->address;?></td>
                    <td><?php echo ucfirst($taa->status);?></td>
                    <td>
                    <a href="" data-toggle="modal" data-target="#message<?php echo $taa->id;?>" style=" background: #069198; color: #fff; padding-left: 6px; padding-right: 6px; text-decoration: none; ">View Details</a><br>
                    
                    <?php if($taa->status=="R" OR $taa->status=="pending" ){?>
                    <a href="" data-toggle="modal" data-target="#authorize<?php echo $taa->id;?>" style=" background: #069198; color: #fff; padding-left: 10px; padding-right: 10px; text-decoration: none; ">Authorized</a><br>
                    <?php } ?>
                    
                    <?php if($taa->status=="A" OR $taa->status=="pending" ){?>
                    <a href="" data-toggle="modal" data-target="#reject<?php echo $taa->id;?>" style=" background: #069198; color: #fff; padding-left: 23px; padding-right: 25px;text-decoration:none; ">Reject</a>
                    <?php } ?>

  <!-- Reject Modal -->
  <div class="modal fade" id="reject<?php echo $trans_id= $taa->id;?>" role="dialog">
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
        $result_rej = $this->db->get('bankinformation')->result_array();
        ?>
          <form action="<?php echo base_url();?>Admin/reject_bank_info" method="post">

        <input type="hidden" name="previous_status" value="<?php echo $result_rej[0]['status']; ?>">
        
        <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>">
        <?php if($result_rej[0]['status'] == "A"){?>
        <label>Reason</label><br>

        <textarea required="" class="form-control" name="reason" style="height:100px"><?php echo $result_rej[0]['Reject_Reason'];?></textarea><br>
        <?php } ?>
          <input type="submit" style="background: #069198;color: #fff;padding: 8px 15px 8px 15px;margin-right: 3px;text-decoration: none;" class="btn btn-default"  value="Yes">

          </form>
          
          
        </div>
      </div>
      
    </div>
  </div>


  <!-- Authorize Modal -->
  <div class="modal fade" id="authorize<?php echo $trans_id= $taa->id;?>" role="dialog">
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
        $result_auth = $this->db->get('bankinformation')->result_array();
        ?>
          <form action="<?php echo base_url();?>Admin/authorized_bank_info" method="post">

        <input type="hidden" name="previous_status" value="<?php echo $result_auth[0]['status']; ?>">
        
        <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>">
        
        <?php if($result_auth[0]['status'] == "R"){?>
        <label>Reason</label><br>

        <textarea required="" class="form-control" name="aut_reason" style="height:100px"><?php echo $result_auth[0]['Authorize_Reason'];?></textarea><br>
        <?php } ?>

          <input type="submit" style="background: #069198;color: #fff;padding: 8px 15px 8px 15px;margin-right: 3px;text-decoration: none;" class="btn btn-default"  value="Yes">

          </form>
          

        </div>
      </div>
      
    </div>
  </div>




  <!-- Modal View Details-->
  <div class="modal fade" id="message<?php echo $trans_id= $taa->id;?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Bank Info Details</h4>
        </div>
        
        <?php
        //echo $trans_id;
        $this->db->select('*');
        $this->db->where('id',$trans_id);
        $result_tran_id = $this->db->get('bankinformation')->result_array();
        ?>
        <div class="modal-body">    
            <div class="col-md-6">
                User ID
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['Folio_No']; ?>
            </div>
            <div class="col-md-6">
                Account Number
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['accountnumber']; ?>
            </div>
            <div class="col-md-6">
                Account Title
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['accounttitle']; ?>
            </div>
            <div class="col-md-6">
                Bank Name
            </div>
            <div class="col-md-6">
                <?php echo $result_tran_id[0]['bankname']; ?>
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



                    </td>
                </tr>
                  <?php 
                       
                    }
                 ?>             

               
            </table>
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
}.modal-footer {
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
</style>    