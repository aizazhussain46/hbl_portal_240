<script>
    window.print();
</script>
<?php
session_start();
 
if (empty($_SESSION['folino'])){
     redirect('Customer');
}
 $sessionid= $_SESSION['folino'];
$this->db->select('*');
$this->db->where('UserID',$_SESSION['folio']);
$resulting_get_folio = $this->db->get('user')->result_array();     
$new_folio_get= $resulting_get_folio[0]['Folio_No'];


$this->db->select('*');
$this->db->where('Folio_No',$sessionid);
$resulting = $this->db->get('investoraccountinfo')->result_array();		
 $name= $resulting[0]['ACC_TITLE'];
//$fname= $resulting[0]['ACC_CNIC'];
$cnic= $resulting[0]['ACC_CNIC'];
date_default_timezone_set("Asia/Karachi");

$mobile= $resulting[0]['ACC_SMSCELLNUMBER'];
$address= $resulting[0]['ACC_ADDRESS'];

$Joint_Name1= $resulting[0]['Joint_Name1'];
$Joint_Name2= $resulting[0]['Joint_Name2'];
$Joint_Name3= $resulting[0]['Joint_Name3'];


$this->db->select('*');
$this->db->where('Folio_No',$new_folio_get);
$resultingZakat = $this->db->get('investoraccountinfo')->result_array();     
$zakat= $resultingZakat[0]['ACC_ZAKATSTATUS'];


?>
<script>
    //window.print();
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HBL Asset Management</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/summary.css">
</head>
<body style=" margin: 70px;    margin-top: 4px !important; ">



<header class="header">

    <div style="float: left">
        <img class="logo" src="<?php echo base_url();?>images/hblasset-logo.jpg" alt="">
    </div>
    <div style="float: right; margin-right: 5%; width: 25%">

        <p class="date">Print Date: <?php echo date("d/m/Y");?></p>
        <p class="date">Print Time: <?php echo date("h:i:sa");?></p>
    </div>


</header>
<br/><br/><br/>


<br>

<h3 align="center" >SUMMARY STATEMENT OF ACCOUNTS</h3>
<hr class="line">
<h4 align="center" ><?php echo $name;?></h4>
<hr class="line">

<div class="para">

    <div style="float: left">
        <table>
            <thead align="left">
            <tr>
                <th class="bottom">Folio: <?php echo $_SESSION['folio'];?></th>
            </tr>
            <tr>
                <th class="bottom">CNIC: 
                    <?php if(!empty($cnic)){echo $cnic;}
                if(empty($cnic)){echo "---";}?>
                </th>
            </tr>
            <tr>
                <th class="bottom">MOBILE: 
                 <?php if(!empty($mobile)){echo $mobile;}
                if(empty($mobile)){echo "---";}?>

                </th>
            </tr>
            <tr>
                <th>ADDRESS: <?php 
                                $address_break_line = wordwrap($address, 30, "<br />\n");
                                echo $address_break_line;?></th>
            </tr>
            </thead>
        </table>

    </div>
    <div style="float: right;">
        <table>
            <thead>
            <tr>
                <th>Joint Holders (if any):</th>
            </tr>
            <tr>
                <th class="bottom"><?php if(!empty($Joint_Name1)){echo $Joint_Name1;}else{echo "";}?></th>
            </tr>

            <tr>
                <th class="bottom"><?php if(!empty($Joint_Name2)){echo $Joint_Name2;}else{echo "";}?></th>
            </tr>

            <tr>
                <th class="bottom"><?php if(!empty($Joint_Name3)){echo $Joint_Name3;}else{echo "";}?></th>
            </tr>
            </thead>
        </table>

    </div>
    <table>
        <thead align="right">
        <tr>
            <th>Zakat Status: <?php echo $zakat;?> </th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>

        <table>
        <thead>
        <tr class="both">
            <th>Fund</th>
            <th>Fund Code</th>
            <th>Units</th>
            <th>Value (RS.)</th>
            <th>As of (Date)</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                      $this->db->from('dailyportfoliosummary');
                      $this->db->where('Foli_No',$_SESSION['folino']);
                
                $queryData = $this->db->get();
                foreach($queryData->result() as $queryDataShow){
                
               $FUNDCODE= $queryDataShow->Fund_Code;
            $this->db->select('*');
            $this->db->where('Fund_Code',$FUNDCODE);
            $resultFundName = $this->db->get('fundnames')->result_array(); 
            if($queryDataShow->Amount1 != 0){
            ?>            
            
        <tr class="both">
            <td><?php 
                    $explode_fundname= explode('(',$resultFundName[0]['Fund_Name']);
                    echo $explode_fundname[0];?></td>
            <td><?php echo $queryDataShow->Fund_Code;?></td>
            <td><?php echo number_format($queryDataShow->Units1,4);?></td>
            <td><?php echo number_format($queryDataShow->Amount1,2);?></td>
            <td><?php echo date('d m Y', strtotime($queryDataShow->NAV_Date));?></td>
        </tr>

         <?php } } ?>

        </tbody>
        <thead  class="total">
        <tr class="both">
            <th>Total Value Of Your Investment Is</th>
            <th></th>
            <th></th>
            <th></th>
            <th>
                
                <?php
                            $this->db->select_sum('Amount1');
                            $this->db->where('Foli_No',$sessionid);
                            $abc = $this->db->get('dailyportfoliosummary')->result_array();    
                            $sum_value= array_sum($abc[0]);

                            echo number_format($sum_value, 2, '.', ',');


                ?>                
                
            </th>
        </tr>
        </thead>

    </table>
	<h4 align="center">PORTFOLIO SUMMARY</h4>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {




        var data = google.visualization.arrayToDataTable([
      ['', ''],
                    <?php

                      $this->db->from('dailyportfoliosummary');
                      $this->db->where('Foli_No',$_SESSION['folino']);

                      $query22 = $this->db->get();
                          foreach($query22->result() as $aa2){
                      $myObj11 =$aa2->Fund_Code;
                      $myObj22 =$aa2->Amount1;
                      if($aa2->Amount1 != 0){
                    ?>

                       ['<?php echo $myObj11;?>', <?php echo $myObj22;?>],
                    <?php } 
                      }
                    ?>
        ]);

        var options = {
          title: ''
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <center><div id="piechart" style="width: 900px; height: 500px;"></div></center>



    </div>



<footer class="footer">
    <hr class="line1">
    <b><p>This is a computer generated report and does not require any signature. In case of any discrepencies, please contact:</p>
    <p>HBL ASSET MANAGEMENT LIMITED</p></b>
    <p>7th Floor, Emerald Tower, G-19, Block 5, Clifton, Karachi, Pakistan</p>
    <p>UAN:(021) 111-425-262 FAX: (021) 35168455 WEB: www.hblasset.com EMAIL: info@hblasset.com</p>
</footer>
<style>
    .both:nth-child(even) {
        background: gainsboro;
    }
    
    @media print {
  @page { margin: 0; }
  body { margin: 1.6cm; }
}

</style>
</body>
</html>