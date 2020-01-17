<?php 
include "elements/header-bank.php";?>
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


<form name="" action="<?php echo base_url();?>Customer/etransfer"
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
<h4>Folio Number</h4>
<input type="text" name="folio" value="<?php echo $folino;?>" readonly style="border: 2px solid #dedede;padding-left: 10px;padding-top: 8px;padding-bottom: 8px;margin-top: 7px;" > 

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

<input type="text" class="form-control" name="name">
<?php
if(isset($message)){
echo $message;
} 
?>

</div>
<div class="form-group"> 
<label for="exampleInputEmail1">CNIC</label> 

<input type="number" class="form-control" name="cnic">
<?php
if(isset($message)){
echo $message;
} 
?>

</div>
<div class="form-group"> 
<label for="exampleInputEmail1">Select Fund</label> 
<div class="custom-select">

<select name="fund">
<option style="display: none;" value="">Select Fund</option>
<?php             
$this->db->from('fundnames');
$query = $this->db->get();
foreach($query->result() as $aa){
?>
<option value="<?php  echo $aa->Fund_Code; ?>"><?php  echo $aa->Fund_Name; ?></option>
<?php   }  ?>
<option value="<?php  echo $aa->Fund_Code; ?>">Static Fund</option>

</select>
</div>

</div>
<div class="form-group"> 
<label  for="test3">Select Bank</label>
<select name="bank" class="form-control" id="" style="margin-bottom:20px;"><option value="603733">JS BANK</option>
<option value="589430">ABL</option>
<option value="505895">ADVANS PAK MIRCOFINANCE</option>
<option value="639530">ALBARAKA</option>
<option value="627100">ALFALAH</option>
<option value="581862">APNA MF </option>
<option value="603011">ASKARI</option>
<option value="627197">BANK ALHABIB</option>
<option value="639357">BANK ISLAMI</option>
<option value="357718 627618">BANK OF KHYBER</option>
<option value="623977">BOP</option>
<option value="604786">BURJ Bank</option>
<option value="421435">CITI BANK</option>
<option value="428273">DUBAI ISLAMIC</option>
<option value="601373">FAYSAL BANK</option>
<option value="502841">FINCA MF</option>
<option value="628138">FIRST WOMEN</option>
<option value="627408">HABIB METRO</option>
<option value="600648">HBL</option>
<option value="621464">ICBC</option>
<option value="589388">MCB</option>
<option value="623404">MCB ISLAMIC BANKING</option>
<option value="627873">MEEZAN BANK</option>
<option value="585953">MOBILINK MF</option>
<option value="958600">NBP</option>
<option value="586010">NRSP MICRO FIN BANK</option>
<option value="606101">SAMBA BANK</option>
<option value="627271">SCB</option>
<option value="627544">SILK Bank</option>
<option value="505439">SINDH BANK </option>
<option value="786110">SONERI</option>
<option value="604781">SUMMIT BANK</option>
<option value="639390">TAMEER MICRO FINANCE </option>
<option value="581886">U MICROFINANCE</option>
<option value="588974">UBL</option>
</select>
</div>


</div>
<!--- END Investment -->



</div>
</div> 

<div class="col-sm-4">
<div class="wrapper">
<h3>Transaction Value</h3>

<div class="form-group row radio-group">

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

<input type="number" class="form-control" name="amount">
<?php
if(isset($message)){
echo $message;
} 
?>

</div>
<div class="form-group"> 
<label>Transaction ID</label>
<input type="number" name="t_id" class="form-control">

</div>
<div class="form-group"> 
<label>Remarks (optional)
</label>
<textarea name="remarks" class="form-control"></textarea>

</div> 

</div>




<p class="block">
<small>
Minimum transaction value is Rs.1,000.
</small>

</p>
<div class="button-group text-center m-b20">
<input type="submit" value="Process" class="btn btn-primary" name="transaction_button">
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
<?php include "elements/footer-bank.php";?>
