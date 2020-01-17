<?php
if (empty($_SESSION['folio'])){
     redirect('Customer');
}
 $sessionid= $_SESSION['folio'];
 $folino= $_SESSION['folino'];


date_default_timezone_set("Asia/Karachi");

$this->db->select('*');
$this->db->where('Folio_No',$folino);
$resulting = $this->db->get('investoraccountinfo')->result_array();     

$name= $resulting[0]['ACC_TITLE'];
$cnic= $resulting[0]['ACC_CNIC'];
$tax= $resulting[0]['ACC_TAXSTATUS'];
$address= $resulting[0]['ACC_ADDRESS'];
$phone= $resulting[0]['ACC_PHONE'];
$cell= $resulting[0]['ACC_SMSCELLNUMBER'];




error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">

        
<head>
    <meta charset="UTF-8">
    <title>Tax Certificate</title>
            <link rel="stylesheet" href="<?php echo base_url();?>/css/tax.css">
</head>        
        
<body>



<header class="header">

    <img class="logo" src="<?php echo base_url();?>/images/HBL-Assets-Logo.png" alt="">
    <p class="date">Print Date: <?php echo date("d-m-Y h:i:sa");?></p>


</header>
<div class="para">

<p>Customer ID: <?php echo $sessionid;?></p>
<p>Tax Status: <?php echo $tax;?></p>

<strong><?php echo $name;?></strong>
<br>
<span><?php echo $address;?></span><br>
<span><?php echo $cell;?></span><br>
<span><?php echo $phone;?></span><br>
<br>
<strong>SUBJECT: TAX CERTIFICATE BY 2016-2017</strong>

<p>Please find below your gain/loss statement for financial year 2016-2017 along with the tax deposited in government treasury against CGT/Income tax/Dividend income.</p>


    <table>
        <thead>
        <tr>
            <th>GAIN/LOSS STATEMENT</th>
            <th>AMOUNT (Rs.)</th>
            <th>CGT RATE</th>
            <th>TAX LIABILITY (Rs.)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Gain/Loss Exempt</td>
            <td>0</td>
            <td>123</td>
            <td>123</td>
        </tr>
        <tr>
            <td>Gain/Loss between 4 years</td>
            <td>117,044</td>
            <td>10.00%</td>
            <td>11,704</td>
        </tr>
        <tr>
            <td>Total Gain/Loss</td>
            <td>117,044</td>
            <td>123</td>
            <td>11,704</td>
        </tr>
        <tr>
            <td>Dividend Income</td>
            <td>114,655</td>
            <td>123</td>
            <td>123</td>
        </tr>
        <tr>
            <td>Bonus Income</td>
            <td>1,959,916</td>
            <td>123</td>
            <td>123</td>
        </tr>
        </tbody>
        <thead>
        <tr>
            <th>TAX DEDUCTION</th>
            <th>TAX DEDUCTED (Rs.)</th>
            <th>TAX LIABILITY</th>
            <th>TAX REFUNDABLE/(PAYABLE)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>CGT</td>
            <td>123</td>
            <td>11,704</td>
            <td>1,604</td>
        </tr>

        <tr>
            <td>Income TAX(MTPF)</td>
            <td>123</td>
            <td>123</td>
            <td>123</td>
        </tr>
        <tr>
            <td>TAX on Dividend</td>
            <td>123</td>
            <td>123</td>
            <td>123</td>
        </tr>
        <tr>
            <td>TAX on Bonus</td>
            <td>123</td>
            <td>123</td>
            <td>123</td>
        </tr>
        <tr>
            <td>Total Tax Deducted & Deposited</td>
            <td>123</td>
            <td>123</td>
            <td>123</td>
        </tr>
        </tbody>
    </table>
<br>
<span>Cost of investment (Other than MTPF)</span><br>
    <span>Cost of investment (MTPF)</span><br>
    <span>Total Cost of investment as at 06/30/2017</span>
<hr class="line">




<p>We hope that  above information will facilitate  your good self in filing of annual return to FBR.</p>
<p>Thanks & Regards</p>
<br/>
<p>Operations Department</p>

</div>


<footer class="footer">
    <hr>
    <p>This is computer generated tax Certificate and do not require any stamp or signature</p>
</footer>

</body>
<style>
    th {
    font-size: 12px;
}td {
    font-size: 14px;
}
</style>
</html></title>
</head>
<body>

</body>
</html>