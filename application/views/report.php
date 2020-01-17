<?php 

include "elements/header-bank.php";
$this->db->select('*');
$this->db->where('Folio_No',$foliodata);
$resultsss = $this->db->get('investoraccountinfo')->result_array();   
$zakat= $resultsss[0]['ACC_ZAKATSTATUS'];
$cgt= $resultsss[0]['ACC_CGTSTATUS'];
$type= $resultsss[0]['ACC_Type'];
$auth= $resultsss[0]['ACC_Auth'];

$phone= $resultsss[0]['ACC_PHONE'];
$cell= $resultsss[0]['ACC_SMSCELLNUMBER'];
$email= $resultsss[0]['ACC_EMAILADDRESS'];
$address= $resultsss[0]['ACC_ADDRESS'];

$code= $resultsss[0]['ABA_ACCOUNTCODE'];
$title= $resultsss[0]['Bank_AccountTitle'];
$bankname= $resultsss[0]['Bank_Name'];
$bankaddress= $resultsss[0]['Branch_Address'];
$cnicexpire= $resultsss[0]['ACC_CNICEXPIRYDATE'];

?><div class="page-title">
    <div class="container">
    <div class="row">
        <h1 class="h1">
            <i class="icon icon-reports"></i>
            <span>Account Statement</span>
        </h1>
    </div>
    </div>
</div>

    <div class="gray-area ">
        <div class="container white">
            <div class="account-statement row">        
                <div class="col-sm-4">
                    <div class="basic-info">
                        <figure>
                            <img src="<?php echo base_url();?>images/logo.png" alt="">
                        </figure>
                        <ul class="list-unstyled">
                            <li>NIC</li>
                            <li>&nbsp;<?php echo $cnic;?>&nbsp;</li>
                            <li>CNIC Expiry Date  </li>
                            <li><?php 
                            
                            $extime= explode(" ", $cnicexpire);
                            echo date('d/m/Y', strtotime($extime[0]));
                            ?>&nbsp;</li>
                            <li>Cell Number</li>
                            <li><?php echo $cell;?>&nbsp;</li>
                            <li>Address</li>
                            <li><?php echo $address;?>&nbsp;</li>
                           
                        </ul>
                        <div class="clearfix"></div>
                        
                      <p><b>FUND WISE INVESTMENT SUMMARY</b>
                        
                           
                        </p>  
                                       </div>
                    
                    
                    
                    
                </div>
                <div class="col-sm-8">
                    <div class="account-details">
                        <ul class="list-unstyled list-inline">
                            <li><?php echo $name;?></li>
                            <li>Folio Number : <?php echo $foliodata;?></li>
                            
                            <li>
                            <!--
                            <a href="<?php echo base_url();?>/Customer/pdf"  target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 25px"></i></a>
                            -->
                            </li>
                            
                            <li><a href="<?php echo base_url();?>/Customer/printreport" target="_blank"><i class="fa fa-print" aria-hidden="true" style=" font-size: 25px; "></i></a></li>
                        </ul>
                    </div>
                    <div class="date-select">
                        <form method="POST" action="<?php echo base_url().'Customer/report_proced'; ?>" target="_blank">
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="form-group">
                            <label class="control-label" for="">From Date:</label>
                            <div class="input-group date" data-provide="datepicker">
                              <input type="text" name="fdate" class="form-control" required>
                              <div class="input-group-addon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>

                              </div>
                            </div>
                          </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                            <label class="control-label" for="">To Date:</label>
                            <div class="input-group date" data-provide="datepicker" >
                              <input type="text" name="tdate" class="form-control">
                              <div class="input-group-addon" required>
                                <i class="fa fa-calendar" aria-hidden="true"></i>

                              </div>
                            </div>
                          </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                            <label class="control-label" for="">Folio Number</label>
                           
                              <input name="foliologinuser" type="text" class="form-control" placeholder="<?php echo $foliodata;?>" disabled>
                            
                          </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group"> 
                            <label for="exampleInputEmail1">Select Fund</label> 
                            <div class="custom-select">
                              <select name="fund" >
                                 <option value="All">All Funds</option>

                                <?php 
                                  $this->db->from('fundnames');
                                  $query_fund_report = $this->db->get();
                                  foreach($query_fund_report->result() as $fund_report){
                                 ?>
                                <option value="<?php echo $fund_report->Fund_Code;?>"><?php echo $fund_report->Fund_Code;?> </option>
                                <?php } ?>
                              </select>
                            </div>
                        </div>
                        
                          <div class="button-group text-right m-b20">
                            <input type="submit" value="Transactions" class="btn btn-primary">
                          </div>

                        
                            </div>
                        </div>
                    </div>
                   
                </form>

                </div>
                
                <div class="container">
                      
                   <div class="table-box">
                        <table cellpadding="0" cellspacing="0" class=" table table-responsive table-condensed table-striped table-grid">
                   
                        
                        <thead>
                            <tr>
                                <th>As of (Date) </th>
                                <th>Fund</th>
                                <th>Fund Code </th>
                                <th>  Amount (Rs.)      </th>
                                
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


                <tr>    <td><?php
                $nav= $investment->NAV_Date; 
                $exd= explode(" ",$nav);
                echo date('d/m/Y', strtotime($exd[0]));
                ?></td>
                        <td >
                            <?php echo $fundName[0];?>
                        </td>
                        <td><?php echo $result[0]['Fund_Code'];?></td>
                        <td ><?php echo number_format($investment->Amount1, 2, '.', ',');?></td>
                </tr>
                <?php } ?>                   

                          
                        
                     </tbody></table> 
                     <h3 class="grand-total">Total value of your investment is: 

                            <?php
                            $this->db->select_sum('Amount1');
                            $this->db->where('Foli_No',$foliodata);
                            $abc = $this->db->get('dailyportfoliosummary')->result_array();    
                            $sum_value= array_sum($abc[0]);

                            echo number_format($sum_value, 2, '.', ',')

                            ?>
                     </h3>
                    </div>
                </div>
                   
                  
           
        </div> 
    </div>  
</form>

<?php include "elements/footer-bank.php";?>