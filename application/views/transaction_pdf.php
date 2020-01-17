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
        $this->db->where('FolioNo',$new_folio_get);
        $this->db->limit(1);
        $this->db->order_by('id',"DESC");
        $resultemaildata = $this->db->get('transactionrequest')->result_array();
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
    .invoice-box table tr.information table td {
        padding-bottom: 7px !important;
    }
    </style>



    <meta charset="utf-8">
    <title>HBL</title>
    
    <style>
td p {
    margin-bottom: 5px;
    margin-top: 2px;
}
    .invoice-box table tr td:nth-child(2) {
        text-align: left !important;
    }
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:0px;
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
        text-align:left;
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
                                <img src="<?php echo base_url();?>images/logo.png" style="width:100%;max-width: 50%;margin-bottom: -30px;">
                            </td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">

                <td colspan="2">
                    <table>
                        <tr>
                            <td>
        <h4>Dear Invester,</h4>
        <p>Your transaction has been submitted via <?php echo $resultemaildata[0]['Dest_Fund_Code'];?> The transaction reference number is <?php echo $resultemaildata[0]['ReferenceID'];?>
        <p>It may take up to 72 hours, or processing time as per Offering Document of the Fund, for processing of this transaction.</p><br>

        <table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#069198" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#069198 !important;">
          <tr> 
            <td colspan="2" height="25" bgcolor="069198"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Transaction Details</strong></font></td>
          </tr>
            <tr>
                <td width="300"><p><font size="-1">Folio Number</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['FolioNo'];?></font></p></td>
            </tr>
            <tr>
                <td width="300"><font size="-1">Request Type</font></td>
                <td width="300"><font size="-1">
                    
                    <?php
                    if ($resultemaildata[0]['RequestType']== "R") {
                        echo "Redemption";
                    }
                    if ($resultemaildata[0]['RequestType']== "T") {
                        echo "Converstion";
                    } 
                    if ($resultemaildata[0]['RequestType']== "I") {
                        echo "Investment";
                    }                                    
                    ?>

                </font></p></td>
            </tr>
            <?php 
            if ($resultemaildata[0]['RequestType']== "T") {
            ?>
            <tr>
                <td width="300"><p><font size="-1">To</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['Source_Fund_Code'];?></font></p></td>
            </tr>
            <?php } ?>

            <tr>
                <td width="300"><p><font size="-1">From</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['Dest_Fund_Code'];?></font></p></td>
            </tr>

            <?php 
            if ($resultemaildata[0]['RequestType']== "I") {
            ?>
            <tr>
                <td width="300"><p><font size="-1">Payment Mode</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['paymentmode'];?></font></p></td>
            </tr>
            <tr>
                <td width="300"><p><font size="-1">Bank Name</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['bankname'];?></font></p></td>
            </tr>
            <tr>
                <td width="300"><p><font size="-1">Bank Account Number</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['accountnumber'];?></font></p></td>
            </tr>
            <tr>
                <td width="300"><p><font size="-1">Cheque/ Intrument Number</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['cheque_intrument_no'];?></font></p></td>
            </tr>                                    
            <?php } ?>

            <tr>
                <td width="300"><p><font size="-1">Amount</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['RequestAmount'];?></font></p></td>
            </tr>           
            <tr>
                <td width="300"><p><font size="-1">Date</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['RequestDate'];?></font></p></td>
            </tr>                                   
            <tr>
                <td width="300"><p><font size="-1">Time</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['RequestTime'];?></font></p></td>
            </tr>                                   
            <tr>
                <td width="300"><p><font size="-1">ReferenceID</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['ReferenceID'];?></font></p></td>
            </tr>                                   
            <tr>
                <td width="300"><p><font size="-1">Remarks</font></p></td>
                <td width="300"><p><font size="-1"><?php echo $resultemaildata[0]['Remarks'];?></font></p></td>
            </tr>                                   
            <tr>
                <td width="300"><p><font size="-1">Status</font></p></td>
                <td width="300"><p><font size="-1">Log</font></p></td>
            </tr>                                   
        </table>

        <br>
        <p>For details, please call 0800-42522</p><br><br>
        <p>Your Sincerely,</p>
        <p>HBL ASSET MANAGEMENT LTD.</p>
        <p>7th floor, Emerald Tower, G-19, Block 5, Clifton, Karachi, Pakistan. </p>
        <p>www.hblasset.com</p>
        <p>UAN: 021-111-225-262</p>
        <p>Fax: 021-99207409, 021-99207407</p>
                            </td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
</table>

       
<style type="text/css">
    div.chart_div table {
    width: auto;
    margin: 0 auto !important;
}

</style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <!--<div id="donutchart" style="width: 900px; height: 500px;"></div>-->


    </div>
</body>
</html>
