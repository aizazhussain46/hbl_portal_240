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


<form id="ibft_Form" action="<?php echo base_url(); ?>Customer/etransfer"
onsubmit="" method="post" enctype="multipart/form-data">
<?php //echo form_open_multipart('Customer/etransfer');?>
<div class="gray-area">

<div class="container">
<div class="row">
<div class="container white">
<div class="col-sm-4">

<div class="wrapper">
<h3>Your Portfolio</h3>
<div class="nano">
<div class="content">
<table cellpadding="0" cellspacing="0" class=" content fund-wise-table table table-responsive table-condensed table-striped table-grid" style="width:100%;">


<thead>
<tr>
<th>Funds</th>
<th>Amount (Rs.)</th>
</tr>
</thead>
<tbody>

<?php
$this->db->where('Foli_No', $foliodata);
$this->db->from('dailyportfoliosummary');
$query = $this->db->get();
foreach ($query->result() as $investment) {
$fcode = $investment->Fund_Code;
$this->db->select('*');
$this->db->where('Fund_Code', $fcode);
$result = $this->db->get('fundnames')->result_array();
$fname = $result[0]['Fund_Name'];

$fundName = explode('(', $fname);
if ($investment->Amount1 != 0) {

?>


<tr>
<td>
<?php echo $fcode; ?>
</td>
<td>
<?php echo number_format($investment->Amount1, 2, '.', ','); ?>
</td>
</tr>

<?php }}?>
</tbody>
<tfoot>
<tr>
<td>
Total Investment Value (Rs.)
<small>As on

<?php

$this->db->select('*');
$this->db->where('Foli_No', $foliodata);
$resultnavdate = $this->db->get('dailyportfoliosummary')->result_array();
$this->db->order_by('id', "DESC");
$exdate = explode(" ", $resultnavdate[0]['NAV_Date']);
$excdate = explode("-", $resultnavdate[0]['NAV_Date']);

$datefor = date('F Y', strtotime($exdate[0]));

$excm = explode(" ", $excdate[2]);

echo $excm[0] . ' ' . $datefor;

?>



</small>

</td>
<td>
<?php
$this->db->select_sum('Amount1');
$this->db->where('Foli_No', $foliodata);
$abc = $this->db->get('dailyportfoliosummary')->result_array();
$sum_value = array_sum($abc[0]);

echo number_format($sum_value, 2, '.', ',')

?>
</td>
</tr>
</tfoot>
</table>





</div>

</div>
<div id="third_content" style="display:none;">
<h2 style="font-size:19px; color:#00a997;">How to Invest</h2>
<ul style="margin-bottom:30px; font-size:14px;">
<li style="padding-top:6px;padding-bottom:6px;">Log on to internet banking / mobile app platform of your selected bank.</li>
<li style="padding-top:6px;padding-bottom:6px;">Select Interbank/Intrabank Fund Transfer (IBFT) or any other means of transferring funds.</li>
<li style="padding-top:6px;padding-bottom:6px;">In beneficiary details, use the fund name and account number of the fund that you have selected.</li>

<li style="padding-top:6px;padding-bottom:6px;">Please verify account details before executing the funds transfer.</li>
<li style="padding-top:6px;padding-bottom:6px;">Upon successful execution of Interbank/Intrabank, you will be issued a transaction reference number by your Bank's Online Banking / Mobile app which you will receive through email/SMS.</li>
<li style="padding-top:6px;padding-bottom:6px;">
Copy the transaction reference number received via email/SMS and paste it in the “IBFT TRANSACTION REFERENCE NUMBER” box of E-transaction page.
</li>

<li style="padding-top:6px;padding-bottom:6px;">Press Process button and wait for confirmation message.</li>

</ul>
</div>


</div>

</div>
<div class="col-sm-4">
<div class="wrapper">
<h3>transaction type</h3>

<div class="form-group row radio-group">
<p>
<input type="radio" id="test3" name="r1" value="I"  onchange="show3(this.value)" >
<label for="test3">Investment</label>
</p>
<p>
<input type="radio" id="test1" name="r1"  value="R" onchange="show2()" >
<label for="test1">Redemption</label>
</p>
<p>
<input type="radio" id="test2" name="r1" onchange="show(this.value)" value="T" >
<label for="test2">Conversion</label>
</p>

</div>
<hr>

<div class="form-group">
<label for="exampleInputEmail1">Folio Number</label>

<input type="text" class="form-control" name="folio" value="<?php echo $folino; ?>" readonly>


</div>

<!-- Redemption -->
<div  id="sh2"  style="display: none;" >
<div class="form-group">
<label for="exampleInputEmail1">Select Fund</label>
<div class="custom-select">

<select name="redFROM">
<option style="display: none;" value="">Select Fund</option>
<?php
$this->db->where('Foli_No', $foliodata);
$this->db->where('Amount1 >=', 1000);
$this->db->from('dailyportfoliosummary');

$query = $this->db->get();
foreach ($query->result() as $investment) {
$fcode = $investment->Fund_Code;
$this->db->select('*');
$this->db->where('Fund_Code', $fcode);
$result = $this->db->get('fundnames')->result_array();
$fname = $result[0]['Fund_Name'];

$fundName = explode('(', $fname);

?>
<option value="<?php echo $result[0]['Fund_Code'] . '|' . $investment->Amount1; ?>"><?php echo $fundName[0]; ?></option>
<?php }?>

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
$this->db->where('Foli_No', $foliodata);
$this->db->where('Amount1 >=', 1000);
$this->db->from('dailyportfoliosummary');
$query = $this->db->get();
foreach ($query->result() as $investment) {
$fcode = $investment->Fund_Code;
$this->db->select('*');
$this->db->where('Fund_Code', $fcode);
$result = $this->db->get('fundnames')->result_array();
$fname = $result[0]['Fund_Name'];

$fundName = explode('(', $fname);

?>
<option value="<?php echo $result[0]['Fund_Code'] . '|' . $investment->Amount1; ?>"><?php echo $fundName[0]; ?></option>
<?php }?>

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
foreach ($query->result() as $aa) {
?>
<option value="<?php echo $aa->Fund_Code; ?>"><?php echo $aa->Fund_Name; ?></option>
<?php }?>

</select>
</div>

</div>
</div>
<!--- END Conversion -->


<!--- Investment -->

<div id="sh3" style="display: none;">

<div class="form-group">
<label for="exampleInputEmail1">Name</label>

<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" readonly>
<?php
if (isset($message)) {
echo $message;
}
?>

</div>
<div class="form-group">
<label for="exampleInputEmail1">CNIC</label>

<input class="form-control" data-inputmask="'mask': '99999-9999999-9'"  type="text" id="cnic"   placeholder=""  name="cnic" required="" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" title="Example: 42304-2999999-2" maxlength="15" >


<script>
$(":input").inputmask();

</script>

<!-- <input type="number" class="form-control" name="cnic"> -->

<?php
if (isset($message)) {
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
foreach ($query->result() as $aa) {
?>
<option value="<?php echo $aa->Fund_Acc . ':' . $aa->Fund_Name . ':' . $aa->branch; ?>"><?php echo $aa->Fund_Name; ?></option>
<?php }?>

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
<label  for="test3">Select Bank (IBFT PROCESSED From)</label>
<select name="bankName" id="bankName" class="form-control" style="margin-bottom:20px;">
<option value="HBL">HBL</option>
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
<option value="JS BANK">JS BANK</option>
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
<p class="">
<small style="color:red;">
HBL Asset Management Ltd. does NOT accept “3rd Party Payments”.
In case of investment received from “3rd Party Source”, or your Bank Account not registered with HBL Asset Management Ltd., the investment amount will NOT be booked and will be reimbursed.
</small>

</p>

</div>
<!--- END Investment -->



</div>
</div>

<div class="col-sm-4">
<div class="wrapper">
<h3> &nbsp;</h3>


<div class="form-group row radio-group" style="padding-top: 97px;">

<div id="start-two" style="display:none;">
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

<p class="block">
<small>
Minimum transaction value is Rs.1,000.
</small>

</p>
<div class="button-group text-center m-b20">
<input type="submit" name="submit" value="Process"  class="btn btn-primary" name="transaction_button">
<input type="reset" value="Reset" class="btn btn-default">
</div>
</div>

<div id="third" style="display: none;">


<div class="form-group">
<label for="exampleInputEmail1">Amount</label>

<input type="number" class="form-control" name="tamount" id="tamount" title="please provide amount">
<?php
if (isset($message)) {
echo $message;
}
?>

</div>
<div class="form-group">
<label>IBFT TRANSACTION REFERENCE NUMBER</label>
<input type="text" name="cinum" id="cinum" class="form-control" title="Example: 42304-2999999-2">

</div>

<div class="form-group">
<label>IBFT TRANSACTION (ATTACHMENT)</label>
<input type="file" name="inv_file" id="inv_file" class="form-control" style="padding-top: 4px; padding-left: 5px;" >

</div>
<br />

<div class="form-group">
<label>Remarks (optional)
</label>
<textarea name="remark" rows="5" style="max-width: 350px;min-width: 350px;max-height: 103px; min-height: 103px;" class="form-control"></textarea>

</div>


<p class="block">
<small>
Minimum transaction value is Rs.1,000.
</small>

</p>
<div class="button-group text-center m-b20">
<input type="submit" name="submit" value="Process"  class="btn btn-primary" name="transaction_button">
<input type="reset" value="Reset" class="btn btn-default">
</div>
</div>





</div>


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



<script type="text/javascript">

$( document ).ready(function() {
$('#cnic').prop('required',false);
$('#inv_file').prop('required',false);
$('#fn').prop('required',false);
$('#bankName').prop('required',false);
$('#tamount').prop('required',false);
$('#cinum').prop('required',false);

$('input[name="r1"]').change(function(){

var ft = $('input[name="r1"]:checked').val();

if(ft == 'I'){

$('#cnic').prop('required',true);
$('#inv_file').prop('required',true);
$('#fn').prop('required',true);
$('#bankName').prop('required',true);
$('#tamount').prop('required',true);
$('#cinum').prop('required',true);
$('#ibft_Form').get(0).setAttribute('action', '<?php echo base_url(); ?>Customer/investment_confirmation');



}
else{
$('#cnic').prop('required',false);
$('#inv_file').prop('required',false);
$('#fn').prop('required',false);
$('#bankName').prop('required',false);
$('#tamount').prop('required',false);
$('#cinum').prop('required',false);
$('#ibft_Form').get(0).setAttribute('action', '<?php echo base_url(); ?>Customer/etransfer');

}


});


$('#fn').change(function(){

$('.fund_acc').show();

var str = $('#fn').val();
var res = str.split(":");
var fa = res[0];
var fn = res[1];
console.info(res[2]);

$('#f_acc').val(fa);
$('#f_n').val(fn);




});

});

</script>

<?php include "elements/footer-bank.php";?>
