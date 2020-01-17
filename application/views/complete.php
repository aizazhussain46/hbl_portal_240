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
        <script type="text/javascript">
            function show(str){
                document.getElementById('sh2').style.display = 'none';
                document.getElementById('sh1').style.display = 'block';
                document.getElementById('sh3').style.display = 'none';
                document.getElementById('third').style.display = 'none';
                document.getElementById('start-two').style.display = 'block';
                 document.getElementById('third_content').style.display = 'none';

            }
            function show2(sign){
                document.getElementById('sh2').style.display = 'block';
                document.getElementById('sh1').style.display = 'none';
                document.getElementById('sh3').style.display = 'none';
                document.getElementById('third').style.display = 'none';
                document.getElementById('start-two').style.display = 'block';
                document.getElementById('third_content').style.display = 'none';



            }
            function show3(sign){
                document.getElementById('sh3').style.display = 'block';
                document.getElementById('sh2').style.display = 'none';
                document.getElementById('sh1').style.display = 'none';
                document.getElementById('start-two').style.display = 'none';
                document.getElementById('third').style.display = 'block';
                document.getElementById('third_content').style.display = 'block';

            }            
        </script>


 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Transaction Confirmation</h4>
      </div>
      <div class="modal-body">
        <?php

//print_r($resultss);
//echo $resultss->Dest_Fund_Code;

        $this->db->select('*');
        $this->db->where('FolioNo',$_SESSION['folino']);
        $this->db->limit(1);
        $this->db->order_by('id',"DESC");
        $resulttransactionid = $this->db->get('transactionrequest')->result_array();        
        ?><br>
        <h4>Dear Investor,</h4><br>
        <p>Your transaction has been submitted. The transaction reference number is <?php echo strtoupper($resulttransactionid[0]['ReferenceID']); ?>.<br><br>
        <p>It may take up to 72 hours, or processing time as per Offering Document of the Fund, for processing of this transaction.</p><br>
        <p>For details, please call <a href="021-080042526" style=" color: #069198; ">0800-42526</a></p>
        <br><br>
        <center>
            <a href="<?php echo base_url();?>/Customer/dashboard"  style=" padding: 8px 20px 8px; background: #00a997 !important; color: #fff; ">Click Here for Home</a>
            <a href="<?php echo base_url();?>/Customer/transaction"  style=" padding: 8px 20px 8px; background: #00a997 !important; color: #fff; ">Process another Transaction</a>
        </center>

       <!--<a href="<?php echo base_url();?>/Customer/printreport" target="_blank" style=" padding: 8px 20px 8px; background: #069198; color: #fff; ">Print</a>
       <a href="<?php echo base_url();?>/Customer/pdf" target="_blank" style=" padding: 8px 20px 8px;background: #069198; color: #fff; ">PDF</a>
-->
<br><br>
<!--<form action="<?php echo base_url();?>Customer/completed" method="POST">-->
 


      </div>
    </div>

  </div>
</div>

<script type="text/javascript">

$(window).load(function(){        
   $('#myModal').modal('show');
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
                <input type="radio" id="test2" name="r1"  value="T"  onchange="show(this.value)" >
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
                  
                    <select name="conFrom">
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
