<?php 
include "elements/header-bank.php"; 
include "partials/two_factor.php"; 
include "partials/device_registration.php"; 
?>
<div class="page-title">
<div class="container">
<div class="row">
<h1 class="h1">
<i class="icon icon-home"></i>
<span>Portfolio Summary</span>
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
<div class="styled-box">
<h2 class="box-title">
Allocation Summary
</h2>
<figure>
<?php

$this->db->where('Foli_No',$foliodata);
$this->db->from('dailyportfoliosummary');
$count_second_graph=  $this->db->count_all_results(); 
if($count_second_graph!= 0){

?>
<div id="piechart"  style="310px; height:220px;" ></div>
<?php } 

if($count_second_graph== 0){
echo " <div style='310px; height:220px; text-align:center;' ><h2>N/A</h2></div>";
}


?>
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
<div class="col-sm-12" style="margin-top:20px;">

<div class="table-responsive table-box">
<div class="table-box">
<table cellpadding="0" cellspacing="0" class=" table table-responsive table-condensed table-striped table-grid">
<caption>Your Recent Transactions</caption>

<thead>
<tr>
<th >Date</th>
<th >Fund</th>
<th>Transaction Type</th>
<th style=" text-align: right; ">Units</th>
<th>Amount (Rs.)</th>
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
$date_format= explode("-",$ex_date[0]);

$new_date_format= $date_format[2].'/'.$date_format[1].'/'.$date_format[0];

?>                          

<tr>
<td>
<?php echo $new_date_format; ?>
</td>
<td>
<?php echo $retransactionhistory->Fund_short_Name; ?>
</td>
<td>
<?php echo $retransactionhistory->Trans_Type; ?>
</td>
<td style="text-align:right">
<?php 
// $removed_decimal= explode(".",$retransactionhistory->Units);
echo number_format((float)$retransactionhistory->Units, 4, '.', '');
//echo $retransactionhistory->Units//$removed_decimal[0]
; ?>
</td>
<td>
<?php echo  number_format($retransactionhistory->Amount+$retransactionhistory->CGT, 2, '.', ','); ?>

</td>
</tr>
<?php  } ?>  
</tfoot>
</table> 
<h3 class="alert-transaction"><i class="icon icon-info"></i> It may take up to 48 hours for your latest transaction to appear.</h3>
</div>
</div>


</div>


</div>

</div>
<div class="col-sm-2 hidden-xs">
<a href="http://hblasset.com/mobile-application/" target="_blank">
<img src="<?php echo base_url();?>images/banner.jpg" alt="">
</a>

</div>

</div>
</div>  
</div>  

<style>
tr td {
font-size: 12px !important;
font-weight: 500 !important;
}
caption {
font-size: 21px !important;
padding: 4px !important;
}
h2.box-title {
font-size: 21px !important;
padding: 7px !important;
}
h3.alert-transaction {
font-size: 13px !important;
padding-left: 14px;
}
tfoot td {
font-size: 14px !important;font-weight:bold !important;
}
th {
font-size: 12px !important;
}
</style>
<?php include "elements/footer-bank.php";?>