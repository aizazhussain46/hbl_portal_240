<?php include "elements/header-bank.php";?>

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
      function clearamount(sign){
                document.getElementById('amnt').value = "";
        document.getElementById("amnt").disabled = true;
               

            }  
      function showamount(sign){
                document.getElementById('amnt').value = "";
        document.getElementById("amnt").disabled = false;
               

            }     
        </script>
        
<script>
function validateForm() {
    var from_fund = document.forms["myForm"]["redFROM"].value;
    var op1 = document.forms["myForm"]["op1"].value;
    var amnt = document.forms["myForm"]["amnt"].value;

    
    if (from_fund == "") {
        alert("Please select the Fund");
        return false;
    }
    if (document.getElementById('op1').checked) {
        if (amnt == "") {
        alert("Please enter amount then submit form");
        return false;
        }
        
    }    
    
}
</script>
</head>
<body>


</head>
<body>

        
<form id="ibft_Form" action="<?php echo base_url();?>Customer/etransfer"
onsubmit="" method="post">
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
              <p>
                <input type="radio" id="test3" name="r1" value="I"  onchange="show3(this.value)" >
                <label for="test3">Investment</label>
              </p>
                </div>
            <hr>

              <div class="form-group"> 
                <label for="exampleInputEmail1">Folio Number</label> 

                <input type="text" class="form-control" name="folio" value="<?php echo $folino;?>" readonly>
                  

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
                        $this->db->where('Amount1 >=',1000);  
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
                          <option value="<?php echo $result[0]['Fund_Code'].'|'.$investment->Amount1;?>"><?php   echo $fundName[0];?></option>
                          <?php } ?>

                    </select>
                 </div>

          </div>
         </div>
    
       <!-- END Redemption -->     


       <!-- Conversion -->     

          <div   id="sh1" style="display: none;">
            <div class="form-group"> 
                <label for="exampleInputEmail1">From Fund</label> 
                <div class="custom-select">
                  
                    <select name="conTo">
                          <option style="display: none;" value="">Select Fund</option>
                      <?php
                        $this->db->where('Foli_No',$foliodata);
            $this->db->where('Amount1 >=',1000);
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
                          <option value="<?php echo $result[0]['Fund_Code'].'|'.$investment->Amount1;?>"><?php   echo $fundName[0];?></option>
                          <?php } ?>

                    </select>
                 </div>

          </div>
            <div class="form-group"> 
                <label for="exampleInputEmail1">To Fund</label> 
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
                <label for="exampleInputEmail1">Name</label> 

                <input type="text" class="form-control" name="name" value="<?php echo $name;?>" readonly>
                    <?php
                     if(isset($message)){
                         echo $message;
                     } 
                    ?>

            </div>
            <div class="form-group"> 
                <label for="exampleInputEmail1">CNIC</label> 

              <input class="form-control" type="text" id="cnic"  data-inputmask="'mask': '99999-9999999-9'"  placeholder=""  name="cnic" required="" maxlength = "15">


              <script>
    $(":input").inputmask();

                  </script>

                <!-- <input type="number" class="form-control" name="cnic"> -->
                   
                    <?php
                     if(isset($message)){
                         echo $message;
                     } 
                    ?>

            </div>
            <div class="form-group"> 
            
                <label for="exampleInputEmail1">Select Fund</label> 
                <div class="custom-select">
                  
                    <select id="fn" name="funName">
                    <option style="display: none;" value="">Select Fund</option>
                    <?php             
                      $this->db->from('fundnames');
                      $query = $this->db->get();
                      foreach($query->result() as $aa){
                    ?>
                    <option value="<?php  echo $aa->Fund_Acc.':'.$aa->Fund_Name; ?>"><?php  echo $aa->Fund_Name; ?></option>
                    <?php   }  ?>

                    </select>
                 </div>

            </div>


<!-- start selection funds work -->

             <div class="form-group fund_acc" style="display: none;"> 
                <label> Fund Account Number</label> 

                <input  type="hidden" name="f_n" id="f_n">
                <input  type="text" class="form-control" name="f_acc" id="f_acc" readonly>
                  

            </div>


<!-- end selection funds work  -->





            <div class="form-group"> 
            <label  for="test3">Select Bank</label>
                  <select name="bankName" class="form-control" style="margin-bottom:20px;">
                        <option value="JS BANK">JS BANK</option>
                        <option value="ABL">ABL</option>
                        <option value="ADVANS PAK MIRCOFINANCE">ADVANS PAK MIRCOFINANCE</option>
                        <option value="ALBARAKA">ALBARAKA</option>
                        <option value="ALFALAH">ALFALAH</option>
                        <option value="APNA MF">APNA MF</option>
                        <option value="ASKARI">ASKARI</option>
                        <option value="BANK ALHABIB">BANK ALHABIB</option>
                        <option value="BANK ISLAMI">BANK ISLAMI</option>
                        <option value="BANK OF KHYBER">BANK OF KHYBER</option>
                        <option value="BOP">BOP</option>
                        <option value="BURJ Bank">BURJ Bank</option>
                        <option value="CITI BANK">CITI BANK</option>
                        <option value="DUBAI ISLAMIC">DUBAI ISLAMIC</option>
                        <option value="FAYSAL BANK">FAYSAL BANK</option>
                        <option value="FINCA MF">FINCA MF</option>
                        <option value="FIRST WOMEN">FIRST WOMEN</option>
                        <option value="HABIB METRO">HABIB METRO</option>
                        <option value="HBL">HBL</option>
                        <option value="ICBC">ICBC</option>
                        <option value="MCB">MCB</option>
                        <option value="MCB ISLAMIC BANKING">MCB ISLAMIC BANKING</option>
                        <option value="MEEZAN BANK">MEEZAN BANK</option>
                        <option value="MOBILINK MF">MOBILINK MF</option>
                        <option value="NBP">NBP</option>
                        <option value="NRSP MICRO FIN BANK">NRSP MICRO FIN BANK</option>
                        <option value="SAMBA BANK">SAMBA BANK</option>
                        <option value="SCB">SCB</option>
                        <option value="SILK Bank">SILK Bank</option>
                        <option value="SINDH BANK">SINDH BANK </option>
                        <option value="SONERI">SONERI</option>
                        <option value="SUMMIT BANK">SUMMIT BANK</option>
                        <option value="TAMEER MICRO FINANCE">TAMEER MICRO FINANCE </option>
                        <option value="U MICROFINANCE">U MICROFINANCE</option>
                        <option value="UBL">UBL</option>
                    </select>
            </div>
        

          
        </div>
         <!--- END Investment -->



      </div>
    </div> 
            
          <div class="col-sm-4">
          <div class="wrapper">
            <h3>Transaction Value</h3>

        
              <div class="form-group row radio-group" style="padding-top: 97px;">
                
                  <div id="start-two">
                      <p class="block">
                      <input type="radio" id="op1" name="selectopt"  checked="" value="Amount" onchange="showamount(this.value)">
                     <label for="op1">
                         Amount
                         <input type="number" class="form-control" name="amount" min="1000" id="amnt">
                     </label>
                    </p>
                      <p class="block">
                      <input type="radio" id="op2" name="selectopt"  value="All" onchange="clearamount(this.value)">
                     <label for="op2">
                       All Units
                     </label>
                    </p>
                  </div>

                 <div id="third" style="display: none;">
                
                  
                 <div class="form-group"> 
                <label for="exampleInputEmail1">Amount</label> 

                <input type="number" class="form-control" name="tamount">
                    <?php
                     if(isset($message)){
                         echo $message;
                     } 
                    ?>

            </div>
            <div class="form-group"> 
            <label>Reference Number</label>
                  <input type="text" name="cinum" class="form-control">

            </div>
            <div class="form-group"> 
            <label>Remarks (optional)
</label>
                 <textarea name="remark" class="form-control"></textarea>

            </div> 
                 
                 </div>
               



                <p class="block">
                    <small>
                    Minimum transaction value is Rs.1,000.
                    </small>
                
                </p>
                <div class="button-group text-center m-b20">
                    <input type="button" name="submit" value="Process" data-toggle="modal" data-target="#myModal" class="btn btn-primary" name="transaction_button">
                    <input type="reset" value="Reset" class="btn btn-default">
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
                           <th>Funds</th>
                           <th>Amount (Rs.)</th>
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
                        if( $investment->Amount1 !=0 ){

                    ?>
                       
                      
                       <tr>
                           <td>
                             <?php echo $fcode;?>
                           </td>
                           <td>
                            <?php echo number_format($investment->Amount1, 2, '.', ',');?>
                           </td>
                       </tr>
                       <?php }} ?>
                   </tbody>
                   <tfoot>
                       <tr>
                           <td>
                           Total Investment Value (Rs.)
                                                      <small>As on 
                           
                                                          <?php
                               
                    $this->db->select('*');
                    $this->db->where('Foli_No',$foliodata);
                    $resultnavdate = $this->db->get('dailyportfoliosummary')->result_array(); 
                    $this->db->order_by('id',"DESC");
                    $exdate= explode(" ",$resultnavdate[0]['NAV_Date']);
                    $excdate= explode("-",$resultnavdate[0]['NAV_Date']);
                    
                    $datefor= date('F Y', strtotime($exdate[0]));
                    
                    $excm= explode(" ",$excdate[2]);
                    
                    
                    echo $excm[0].' '.$datefor;
                               
                               ?>

                           
                           
                           </small>

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
    <div id="myModal" class="modal fade in" role="dialog">
  <div class="modal-dialog terms-dialog">
    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 class="modal-title"><center style=" color: #fff; ">Terms &amp; Conditions</center>
        </h3>
      </div>
      <div class="modal-body">
       <h4>Note:</h4>
     
             
     
       <p>
           I understand that if an e-transaction is submitted after the cut off time (Mon - Fri: 4:00 pm) or on non-business days, 
           that transaction will be processed on the next working day and that I would not hold HBL Asset Management &amp; respective 
           Trustee(s), responsible for any loss resulting from such processing of 
           e-transaction on the next working day. All Terms &amp; Conditions and provisions of constitutive documents shall apply.
       </p>
       <h4>Disclaimer:</h4>
       <p>
           I have read and understood the guidelines as stated in the Offering Document &amp; Trust Deed of the funds and the risks involved.
       </p>

<p>
    The Offer/ Redemption Price and conditions would be in accordance with the terms set in the Trust Deed &amp; Offering Document.
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

<form action="<?php echo base_url();?>Customer/insertdata" method="POST" style=" background: #efefef; font-size: 14px; padding-top: 14px; padding-bottom: 0px; padding-left: 14px; color: #069198; font-weight: bold; ">
<input type="checkbox" style="margin-right: 5px;margin-left: 5px" required="">
I confirm acceptance of Terms &amp; Conditions, Notes, Disclaimer and all charges related to this transaction. 
<br>    <br>   </form></div>
      <div class="modal-footer" style=" text-align: center; ">
        <input type="submit" name="sb" id="sb" class="btn-primary btn" style=" width: ; background: #00a997; " value="Process">


       <a href="http://10.6.209.240/pro/hbl-portal/Customer/crequest"> <button type="button" name="cb" id="cb" class="btn btn-default">Cancel</button></a>
      </div>
    </div>

  </div>
</div>
</form>
<style>
    table.table.table-grid.fund-wise-table td:first-child {
    color: #00a997;
    font-weight: 100 !important;
}
table.table.table-grid.fund-wise-table tfoot td:first-child {
    color: #fff;
    font-weight: bold !important;
}small {
    font-size: 13px !important;
}
</style>



<script type="text/javascript">

  $( document ).ready(function() {
     $('#cnic').prop('required',false);

    $('input[name="r1"]').change(function(){
      
      var ft = $('input[name="r1"]:checked').val(); 

    if(ft == 'I'){

    $('#cnic').prop('required',true);
          
    $('#ibft_Form').get(0).setAttribute('action', '<?php echo base_url();?>Customer/insertdata'); 



    }
    else{
      $('#cnic').prop('required',false);

    $('#ibft_Form').get(0).setAttribute('action', '<?php echo base_url();?>Customer/etransfer'); 

    }


});


       $('#fn').change(function(){
      
      $('.fund_acc').show();

    var str = $('#fn').val();
    var res = str.split(":");
    var fa = res[0];
    var fn = res[1];
    console.info(fn);

    $('#f_acc').val(fa);
    $('#f_n').val(fn);

     


});

});

</script>

<script type="text/javascript">

$(window).load(function(){        
   $('#myModal').modal('show');
}); 




</script>
<?php include "elements/footer-bank.php";?>
