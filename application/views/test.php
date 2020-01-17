<?php include "elements/header-bank.php";?>
<div class="page-title">
    <div class="container">
    <div class="row">
        <h1 class="h1">
            <i class="icon icon-transaction"></i>
            <span>E-transactions</span>
        </h1>
    </div>
    </div>
</div>
<style>
.modal-body{
    padding:40px ;
}
.modal-body h4{font-size:22px; color:#000; }
.modal-body p{
    font-size:16px;
}
</style>
        <script type="text/javascript">
            function show(str){
                document.getElementById('sh2').style.display = 'none';
                document.getElementById('sh1').style.display = 'block';
                document.getElementById('sh3').style.display = 'none';
                document.getElementById('third').style.display = 'none';
                document.getElementById('start-two').style.display = 'block';

            }
            function show2(sign){
                document.getElementById('sh2').style.display = 'block';
                document.getElementById('sh1').style.display = 'none';
                document.getElementById('sh3').style.display = 'none';
                document.getElementById('third').style.display = 'none';
                document.getElementById('start-two').style.display = 'block';



            }
            function show3(sign){
                document.getElementById('sh3').style.display = 'block';
                document.getElementById('sh2').style.display = 'none';
                document.getElementById('sh1').style.display = 'none';
                document.getElementById('start-two').style.display = 'none';
                document.getElementById('third').style.display = 'block';

            }            
        </script>


          <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog terms-dialog">
    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><center style=" color: #fff; ">Terms & Conditions</center>
        </h3>
      </div>
      <div class="modal-body">
       <h4>Note:</h4>
	   
	   	   <?php
//25/5/2018 - Rizwan
		   if(!empty($this->session->userdata("SHOWNOTE")))
		   //if(1==0)
	   {
	   
	 ?>
	   <p style=" background: #efefef; font-size: 14px; padding-top: 14px; padding-bottom: 14px; padding-left: 12px; color: red; font-weight: normal; ">
	   
	   <?php
	   //echo $this->session->userdata("SHOWNOTE");
	   echo "You have already submitted a similar transaction request earlier. Please continue if you want to submit another similar request again. Or you may also cancel this request by pressing 'Cancel' button below.";
	   ?>
	   </p>
	   
	   <?php
	   }
	   ?>
	   
	   
       <p>
           I understand that if an e-transaction is submitted after the cut off time (Mon - Fri: 4:00 pm) or on non-business days, 
           that transaction will be processed on the next working day and that I would not hold HBL Asset Management & respective 
           Trustee(s), responsible for any loss resulting from such processing of 
           e-transaction on the next working day. All Terms & Conditions and provisions of constitutive documents shall apply.
       </p>
       <h4>Disclaimer:</h4>
       <p>
           I have read and understood the guidelines as stated in the Offering Document & Trust Deed of the funds and the risks involved.
       </p>

<p>
    The Offer/ Redemption Price and conditions would be in accordance with the terms set in the Trust Deed & Offering Document.
</p>
<p>
    I understand the offer/ Redemption Price of units may go up or down. In case Forward-priced funds, the offer/redemption 
    Price will be as announced by HBL Asset Management for the application date.
</p>
 <p>
     I understand that third party payment against redemption of units shall not be made. HBL AMC/Trustee(s) shall only issue 
     redemption payment in favor of my title of account with HBL AMC.
 </p>
<p>
    I, hereby waive and discharge HBL Asset Management (and the trustees) fully from any implied or expressed obligation of confidentiality / 
    non-disclosure, which may result as a consequence of HBL Asset Management Mutual Funds complying with the request herein above and/or 
    any break-dawn malfunction, erroneous or unauthorized transaction-mission or access to the Statements of Account and the related services.
</p>

<form name="sf" id="sf" action="<?php echo base_url();?>Customer/complete" method="POST" style=" background: #efefef; font-size: 14px; padding-top: 14px; padding-bottom: 0px; padding-left: 14px; color: #069198; font-weight: bold; ">
<input type="checkbox" style="margin-right: 5px;margin-left: 5px" required="">
I confirm acceptance of Terms & Conditions, Notes, Disclaimer and all charges related to this transaction. 
<br>    <br>   </div>
      <div class="modal-footer" style=" text-align: center; ">
        <input type="submit" name="sb" id="sb" class="btn-primary btn" style=" width: ; background: #00a997; " value="Process">
</form>

       <a href="<?php echo base_url();?>Customer/crequest"> <button type="button" name="cb" id="cb" class="btn btn-default">Cancel</button></a>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">

    document.getElementById("sf").onsubmit = function () {
          document.getElementById("sb").value = "Processing ...";
          document.getElementById("sb").disabled = "disabled";
		  document.getElementById("cb").disabled = "disabled";
        return true; //will submit
    }

$(window).load(function(){        
   $('#myModal').modal('show');
            backdrop: 'static'
}); 

</script>
    <form method="post" action="<?php echo base_url().'Customer/etransfer' ?>" class="form">
    <div class="gray-area">
        <div class="container">
        <div class="row">
        <div class="container white">
          <div class="col-sm-4">
            <div class="wrapper">
            <h3>transaction type</h3>

                <div class="form-group row radio-group">
                <p>
                <input type="radio" id="test1" name="r1"  value="R" onchange="show2()" checked>
                <label for="test1">Redemption</label>
              </p>
              <p>
                <input type="radio" id="test2" name="r1" onchange="show(this.value)" value="T" >
                <label for="test2">Conversion</label>
              </p>
              <!--
              <p>
                <input type="radio" id="test3" name="r1" value="I"  onchange="show3(this.value)" >
                <label for="test3">Investment</label>
              </p>
              -->
                </div>
            <hr>

            <div class="form-group"> 
            <h4>Folio Number</h4>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $foliodata;?>" disabled> 
            </div>

       <!-- Redemption -->     
          <div  id="sh2" >
            <div class="form-group"> 
                <label for="exampleInputEmail1">Select Fund</label> 
                <div class="custom-select">
                  
                    <select name="redFROM">
                          <option style="display: none;" value="">Select Fund</option>
                      <?php
                        $this->db->where('Foli_No',$foliodata);

                        $this->db->from('dailyportfoliosummary');
                        $query = $this->db->get();
                        foreach($query->result() as $investment){
                          $fcode= $investment->Fund_Code;
                          $this->db->select('*');
                          $this->db->where('Fund_Code',$fcode);
                          $result = $this->db->get('fundnames')->result_array();        
                          $fname= $result[0]['Fund_Name'];

                          $fundName= explode('(', $fname);

                          ?>
                          <option value="<?php echo $result[0]['Fund_Code'];?>"><?php   echo $fundName[0];?></option>
                          <?php } ?>

                    </select>
                 </div>

          </div>
         </div>
    
       <!-- END Redemption -->     


       <!-- Conversion -->     

          <div   id="sh1" style="display: none;">
            <div class="form-group"> 
                <label for="exampleInputEmail1">To Fund</label> 
                <div class="custom-select">
                  
                    <select name="conTo">
                          <option style="display: none;" value="">Select Fund</option>
                      <?php
                        $this->db->where('Foli_No',$foliodata);

                        $this->db->from('dailyportfoliosummary');
                        $query = $this->db->get();
                        foreach($query->result() as $investment){
                          $fcode= $investment->Fund_Code;
                          $this->db->select('*');
                          $this->db->where('Fund_Code',$fcode);
                          $result = $this->db->get('fundnames')->result_array();        
                          $fname= $result[0]['Fund_Name'];

                          $fundName= explode('(', $fname);

                          ?>
                          <option value="<?php echo $result[0]['Fund_Code'];?>"><?php   echo $fundName[0];?></option>
                          <?php } ?>

                    </select>
                 </div>

          </div>
            <div class="form-group"> 
                <label for="exampleInputEmail1">From Fund</label> 
                <div class="custom-select">
                  
                    <select name="conTo">
                    <option style="display: none;" value="">Select Fund</option>
                    <?php             
                      $this->db->from('fundnames');
                      $query = $this->db->get();
                      foreach($query->result() as $aa){
                    ?>
                    <option value="<?php  echo $aa->Fund_Code; ?>"><?php  echo $aa->Fund_Name; ?></option>
                    <?php   }  ?>

                    </select>
                 </div>

          </div>
         </div>
         <!--- END Conversion -->


         <!--- Investment -->
         
        <div id="sh3" style="display: none;">
            <div class="form-group"> 
                <label for="exampleInputEmail1">Fund Name</label> 
                <div class="custom-select">
                  
                    <select name="funName">
                    <option style="display: none;" value="">Select Fund</option>
                    <?php             
                      $this->db->from('fundnames');
                      $query = $this->db->get();
                      foreach($query->result() as $aa){
                    ?>
                    <option value="<?php  echo $aa->Fund_Code; ?>"><?php  echo $aa->Fund_Name; ?></option>
                    <?php   }  ?>

                    </select>
                 </div>
            </div>
            <div class="form-group"> 
                <label for="exampleInputEmail1">Payment Mode</label> 
                <div class="custom-select">
                    <select name="selpayment">
                    <option style="display: none;" value="">Select Payment</option>
                    <option value="Cheque">Cheque</option>
                    </select>
                 </div>
            </div>
            <div class="form-group"> 
                <label for="exampleInputEmail1">Amount</label> 
                <input type="number" class="form-control" name="tamount">
            </div>

        </div>
         <!--- END Investment -->



      </div>
    </div> 
            
          <div class="col-sm-4">
          <div class="wrapper">
            <h3>Transaction type</h3>

                <div class="form-group row radio-group">
                
                  <div id="start-two">
                      <p class="block">
                      <input type="radio" id="op1" name="selectopt"  checked="">
                     <label for="op1">
                         Amount
                         <input type="text" class="form-control">
                     </label>
                    </p>
                      <p class="block">
                      <input type="radio" id="op2" name="selectopt" >
                     <label for="op2">
                       All Units
                     </label>
                    </p>
                  </div>

                 <div id="third" style="display: none;">
                  <label  for="test3">Bank Name</label>
                  <input type="text" name="bname" class="form-control" pattern="[a-zA-Z\s]+"></br>
                  <label>Bank Account Number</label>
                  <input type="number" name="ban" class="form-control"></br>
                  <label>Cheque/ Intrument Number</label>
                  <input type="number" name="cinum" class="form-control">
                  <br></br>
                 </div>
               



                <p class="block">
                    <small>
                    Minium transaction value is Rs.1,000.
                    </small>
                
                </p>
                <div class="button-group text-center m-b20">
                    <a href="#" class="btn btn-primary">Process</a>
                    <a href="#" class="btn btn-default">Reset</a>
                </div>
             
                </div>
           
            </div>
          </div> 
            
          <div class="col-sm-4">
          <div class="wrapper">
            <h3>Fund wise investment</h3>
            <table cellpadding="0" cellspacing="0" class="fund-wise-table table table-responsive table-condensed table-striped table-grid">
              
                   
                   <thead>
                       <tr>
                           <th>Funds Amount</th>
                           <th>Amount(Rs.)</th>
                       </tr>
                   </thead>
                   <tbody>

                     <?php
                      $this->db->where('Foli_No',$foliodata);

                      $this->db->from('dailyportfoliosummary');
                      $query = $this->db->get();
                      foreach($query->result() as $investment){
                        $fcode= $investment->Fund_Code;
                        $this->db->select('*');
                        $this->db->where('Fund_Code',$fcode);
                        $result = $this->db->get('fundnames')->result_array();        
                        $fname= $result[0]['Fund_Name'];

                        $fundName= explode('(', $fname);

                    ?>
                       
                      
                       <tr>
                           <td>
                             <?php echo $fundName[0];?>
                           </td>
                           <td>
                            <?php echo number_format($investment->Amount1, 2, '.', ',');?>
                           </td>
                       </tr>
                       <?php } ?>
                   </tbody>
                   <tfoot>
                       <tr>
                           <td>
                           Total Investment Value (Rs.)
                           <small>As on June 19, 2017</small>
                           </td>
                           <td>
                           <?php
                            $this->db->select_sum('Amount1');
                            $this->db->where('Foli_No',$foliodata);
                            $abc = $this->db->get('dailyportfoliosummary')->result_array();    
                            $sum_value= array_sum($abc[0]);

                            echo number_format($sum_value, 2, '.', ',')

                            ?>
                           </td>
                       </tr>
                   </tfoot>
                </table> 
         
            </div>
          </div> 
            
           
        </div>
        </div> 
        </div> 
    </div>  
</form>

<?php include "elements/footer-bank.php";?>
