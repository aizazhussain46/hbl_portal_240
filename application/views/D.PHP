<?php include "elements/header-bank.php";?>
<div class="page-title">
    <div class="container">
    <div class="row">
        <h1 class="h1">
            <i class="icon icon-home"></i>
            <span>Folio Summary</span>
        </h1>
    </div>
    </div>
</div>

<div class="gray-area">
    <div class="container">
    <div class="row">
        <div class="col-sm-10">
            <div class="row">
            <div class="col-sm-6">
               <div class="table-box">
               <table cellpadding="0" cellspacing="0" class="fund-wise-table table table-responsive table-condensed table-striped table-grid">
               <caption>Fund Wise Investment</caption>
                   
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
                        
                        if( $investment->Amount1 !=0 ){

                    ?>

                       <tr>
                           <td>
                           <?php echo $fundName[0];?>
                           </td>
                           <td>
                           <?php echo  number_format($investment->Amount1, 2, '.', ','); ?>
                           </td>
                       </tr>
                <?php }
                
               else{
                   
                   
               }

                
            } ?>                   

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
            <div class="col-sm-6">
               
                    <div class="table-responsive table-box">
                    <div class="table-box">
                        <table cellpadding="0" cellspacing="0" class=" table table-responsive table-condensed table-striped table-grid">
                    <caption>Your Recent Transactions</caption>
                        
                        <thead>
                            <tr>
                                <th >Date</th>
                                <th >Name</th>
                                <th>Transaction Type</th>
                                <th>Units</th>
                                <th>Amount(Rs.)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                          $this->db->where('Folio_No',$foliodata);
                          $this->db->order_by("Trans_Date", "desc");
                          $this->db->order_by("Trans_Time", "desc");

                          $this->db->from('transactionhistory');
                          $this->db->limit(5);
                          $transactionhistory = $this->db->get();
                          foreach($transactionhistory->result() as $retransactionhistory){
                            $ex_date= explode(" ", $retransactionhistory->Trans_Date);
                        ?>                          
                            
                            <tr>
                                <td>
                                  <?php echo $ex_date[0]; ?>
                                </td>
                                <td>
                                  <?php echo $retransactionhistory->Fund_short_Name; ?>
                                </td>
                                <td>
                                  <?php echo $retransactionhistory->Trans_Type; ?>
                                </td>
                                <td style="text-align:right">
                                  <?php echo $retransactionhistory->Units; ?>
                                </td>
                                <td>
                                <?php echo  number_format($retransactionhistory->Amount, 2, '.', ','); ?>
                                </td>
                            </tr>
                        <?php  } ?>  
                        </tfoot>
                     </table> 
                     <h3 class="alert-transaction"><i class="icon icon-info"></i> It may take up to 24 hours for your latest transaction to appear.</h3>
                    </div>
                    </div>
                
            
         </div>
         <div class="col-sm-6">
             <div class="styled-box">
                 <h2 class="box-title">
                 Fund Wise Investment
                 </h2>
                <figure>
                    
                  <div id="piechart"  style="330px; height:250px;" ></div>






                  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                  <script type="text/javascript">
                  // Load google charts
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  // Draw the chart and set the chart values
                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                    ['Fund', 'Amount'],
                    <?php

                      $idfolio= $_SESSION['folio'];
                      $this->db->from('dailyportfoliosummary');
                      $this->db->where('Foli_No',$foliodata);
                      $query = $this->db->get();
                      foreach($query->result() as $aa){
                      $myObj1 =$aa->Fund_Code;
                      $myObj2 =$aa->Amount1;
                      


                    ?>
                       ['<?php echo $myObj1;?>', <?php echo $myObj2;?>],

                    <?php } ?>
                  ]);

                    // Optional; add a title and set the width and height of the chart
                    var options = {'title':'' };

                    // Display the chart inside the <div> element with id="piechart"
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                  }
                  </script> 
                </figure>
             </div>
         </div>
         <div class="col-sm-6 ">
             <div class="styled-box">
                 <h2 class="box-title">
                 Portfolio Gain / Loss
                 </h2>
                 <figure>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {packages: ['corechart']});     
   </script>
<div id="container" style="width:300px; height: 250px; margin: 0 auto"></div>




<script language="JavaScript">
function drawChart() {
   // Define the chart to be drawn.

   //var data = new google.visualization.DataTable($myJSON);

   var data = google.visualization.arrayToDataTable([
      ['', ''],
                    <?php

                      $this->db->from('dailyportfoliosummary');
                      $this->db->where('Foli_No',$foliodata);
                      $query22 = $this->db->get();
                      foreach($query22->result() as $aa2){
                      $myObj11 =$aa2->Fund_Code;
                      $myObj22 =$aa2->Amount1;
                      
                    ?>

                       ['<?php echo $myObj11;?>', <?php echo $myObj22;?>],
                    <?php } 
                  
                    ?>
   ]);

   var options = {
      title: ''   
   }; 

   // Instantiate and draw the chart.
   var chart = new google.visualization.ColumnChart(document.getElementById('container'));
   chart.draw(data, options);
}
google.charts.setOnLoadCallback(drawChart);
</script>



                </figure>
             </div>
         </div>
    </div>
        </div>
        
        <div class="col-sm-2 hidden-xs">
        
                    <img src="<?php echo base_url();?>images/banner.jpg" alt="">
                
        </div>
    </div>
    </div>  
</div>  

<?php include "elements/footer-bank.php";?>