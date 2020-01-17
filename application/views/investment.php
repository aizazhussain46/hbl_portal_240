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




error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Investment Certificate</title>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/investment.css">
</head>
<body>



<header class="header">

    <img class="logo" src="<?php echo base_url();?>/images/HBL-Assets-Logo.png" alt="">
    <p class="date">Print Date: <?php echo date("d-m-Y h:i:sa");?></p>


</header>





<h1 align="center" ><u>To Whom It May Concern</u></h1>
<div class="para">
    <p>This is to certify that Mr/Mrs. <strong><?php echo $name;?></strong> bearing CNIC No. <strong><?php echo $cnic;?></strong> having Portfolio No. <strong><?php echo $folino;?></strong> has made following investment(s) with HBL Asset Management.
        The investment detail(s)is as follows;</p>
    <br/>
    <table class="table" align="center">
        <thead>
        <tr>
            <th>FUND NAME</th>
            <th>AS AT</th>
            <th>NAV (Rs.)</th>
            <th>Units</th>
            <th>VALUE (Rs.)</th>
        </tr>
        </thead>
        <tbody align="center">
            
                    <?php
                      $this->db->where('Foli_No',$folino);

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
            <td><?php echo $fundName[0];?></td>
            <td>-</td>
            <td>-</td>
            <td><?php echo $investment->Units1;?></td>
            <td><?php echo number_format($investment->Amount1, 2, '.', ','); ?></td>
        </tr>
        <?php }}?>
        <thead>
        <tr>
            <th>TOTAL</th>
            <th>-</th>
            <th>-</th>
            <th>
                            <?php
                            $this->db->select_sum('Units1');
                            $this->db->where('Foli_No',$folino);
                            $abcd = $this->db->get('dailyportfoliosummary')->result_array();    
                            $sum_values= array_sum($abcd[0]);

                            echo number_format($sum_values, 2, '.', ',')

                            ?>                  
            </th>
            <th>
                            <?php
                            $this->db->select_sum('Amount1');
                            $this->db->where('Foli_No',$folino);
                            $abc = $this->db->get('dailyportfoliosummary')->result_array();    
                            $sum_value= array_sum($abc[0]);

                            echo number_format($sum_value, 2, '.', ',')

                            ?>                
                
                
            </th>
        </tr>
        </thead>
        </tbody>
    </table>
    <br/>
    <br/>
    <p>These units are redeemable at any point of times as per the Offering Documents of the respective fund. This certificate is being issued at the request of unit holder without any responsibility
        what so ever on part  of HBL Asset Management or any of its officers.</p>
    <p></p>
    <p>Thanks and Regards</p>
    <p></p>
    <p><strong>Customer Services</strong></p>
    <p><strong>HBL Asset Management</strong></p>
</div>

<footer class="footer">
    <p>This is system generated certificate and does not require any signature</p>
    <p><strong>Important:</strong>This document contains time-sensitive information, please review it carefully and report any discrepancy(s) in writing within 7 days of the date of this documents,
        otherwise it will be considered correct and accepted by you</p>
    <hr>
    <div align="center">
        <p>7th Floor, Emerald Tower, G-19 Block 5, Main Clifton Road, Clifton, Karachi</p>
        <p>UAN: 111 HBL AMC (111-425-262) | FAX: 021 3516 8455</p>
        <p>Email:<u>info@hblasset.com</u> | Website: www.hblasset.com</p>
    </div>
</footer>
<style>
  table {
    border-collapse: collapse;
    width: 98%;
}
</style>
</body>
</html>