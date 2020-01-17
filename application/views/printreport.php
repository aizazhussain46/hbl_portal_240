<script>
    window.print();
</script>
<?php
if (empty($_SESSION['folio'])){
     redirect('Customer');
}
$sessionid= $_SESSION['folio'];

$this->db->select('*');
$this->db->where('UserID',$_SESSION['folio']);
$resulting_get_folio = $this->db->get('user')->result_array();     
$new_folio_get= $resulting_get_folio[0]['Folio_No'];


$this->db->select('*');
$this->db->where('Folio_No',$new_folio_get);
$resulting = $this->db->get('investorprofileinfo')->result_array();		
$name= $resulting[0]['Invester_Name'];
$fname= $resulting[0]['Invester_FName'];
$cnic= $resulting[0]['Invester_CNIC'];

$mobile= $resulting[0]['Invester_Mobile_No'];
$address= $resulting[0]['Invester_Address'];

$Joint_Name1= $resulting[0]['Joint_Name1'];
$Joint_Name2= $resulting[0]['Joint_Name2'];
$Joint_Name3= $resulting[0]['Joint_Name3'];


$this->db->select('*');
$this->db->where('Folio_No',$new_folio_get);
$resultingZakat = $this->db->get('investoraccountinfo')->result_array();     
$zakat= $resultingZakat[0]['ACC_ZAKATSTATUS'];


?>
<!doctype html>
<html>
<head>
    <style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    body
    {
        margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
    }
    </style>



    <meta charset="utf-8">
    <title>HBL</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo base_url();?>images/banner.jpg" style="width:100%;max-width: 75%;margin-bottom: -30px;">
                            </td>
                            
                            <td>
                                Print Date: <?php echo date("d-m-Y");?><br>
                                Print Time: <?php echo date("h:i:sa");?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">

                <td colspan="2">
                    <table>
                    <hr>
                    <center><h3><?php echo $name;?></h3></center>
                    <hr>

                        <tr>
                            <td>
                                <b>Folio:</b> <?php echo $sessionid;?><br>
                                <b>CNIC:</b> <?php echo $cnic;?><br>
                                <b>Mobile:</b> <?php echo $mobile;?><br>
                                <b>Address:</b> <?php 
                                $address_break_line = wordwrap($address, 30, "<br />\n");
                                echo $address_break_line;?><br>
                            </td>
                            
                            <td>
                                <b>Joint Holders (if any):</b><br>
                                <?php if(!empty($Joint_Name1)){echo $Joint_Name1;}else{echo "";}?><br>
                                <?php if(!empty($Joint_Name2)){echo $Joint_Name2;}else{echo "";}?><br>
                                <?php if(!empty($Joint_Name3)){echo $Joint_Name3;}else{echo "";}?><br>
                                <br><b>ZAKAT STATUS1: <?php echo $zakat;?> </b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
</table>
<table>                  
            
            <tr class="heading">
                <td>
                    FUND
                </td>
                
                <td>
                    FUND CODE
                </td>
                
                <td>
                    UNITS
                </td>
                
                <td>
                    AMOUNT (Rs.)
                </td>
                
                <td>
                    AS OF (Date)
                </td>
            </tr>
            <?php 
            $this->db->where('Foli_No',$sessionid);            
              $this->db->from('transactionhistorydata');
              $queryData = $this->db->get();
              foreach($queryData->result() as $queryDataShow){
                $FUNDCODE= $queryDataShow->Fund_Code;

            $this->db->select('*');
            $this->db->where('Fund_Code',$FUNDCODE);
            $resultFundName = $this->db->get('fundnames')->result_array(); 
            ?>
            <tr class="item">
                <td>
                    <?php 
                    $explode_fundname= explode('(',$resultFundName[0]['Fund_Name']);
                    echo $explode_fundname[0];?>
                </td>
                
                <td>
                    <?php echo $queryDataShow->Fund_Code;?>
                </td>
                <td>
                    <?php echo number_format($queryDataShow->Tran_Unit, 4);?>
                </td>
                <td>
                    <?php echo number_format($queryDataShow->Tran_Amountt, 2);?>
                </td>
                <td>
                    <?php echo Date('d/m/Y', strtotime($queryDataShow->Tran_Date));?>
                </td>
            </tr>
           <?php } ?>
   
        </table>
        <hr>
        <table>
            <tr>
                <td><center><div id="piechart"></div></center></td>
                <td><b>Total value of your investment <br> is:

                <?php
$query22 = $this->db->select_sum('Tran_Amount', 'Amount');
$query22 = $this->db->where('Foli_No',$sessionid);
$query22 = $this->db->get('transactionhistorydata');
$result22 = $query22->result();

echo "Rs. ".$result22[0]->Amount;

                ?></b>
                </td>
            </tr>
        </table>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Work', 8],
  ['Eat', 2],
  ['TV', 4],
  ['Gym', 2],
  ['Sleep', 8]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Average Day', 'width':550, 'height':280};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

        <hr>
        <center><b>This is a computer generated report and does not require any signature. In case of any discrepencies, please contact:
        HBL ASSET MANAGEMENT LIMITED</b><br>
        <span>7th Floor, Emerald Tower, G-19, Block 5, Clifton, Karachi, Pakistan</span><br>
        <span>UAN:(021) 111-425-262 FAX: (021) 35168455 WEB: www.hblasset.com EMAIL: info@hblasset.com</span>
    </center>


    </div>
</body>
</html>
