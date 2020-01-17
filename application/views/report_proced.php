<?php
if (empty($_SESSION['folio'])){
     redirect('Customer');
}
$sessionid= $_SESSION['folio'];


$fdate= $_POST['fdate'];
$change_fdate_format= explode("/", $fdate);
 $fdate_format= $change_fdate_format[2]."-".$change_fdate_format[0]."-".$change_fdate_format[1]." "."00:00:00";

$tdate= $_POST['tdate'];
 
$change_tdate_format= explode("/", $tdate);
  $tdate_format= $change_tdate_format[2]."-".$change_tdate_format[0]."-".$change_tdate_format[1]." "."00:00:00";

 
 $select_fund= $_POST['fund'];

$this->db->select('*');
$this->db->where('UserID',$_SESSION['folio']);
$resulting_get_folio = $this->db->get('user')->result_array();     
$new_folio_get= $resulting_get_folio[0]['Folio_No'];


$this->db->select('*');
$this->db->where('Folio_No',$new_folio_get);
$resulting = $this->db->get('investoraccountinfo')->result_array();		
$name= $resulting[0]['ACC_TITLE'];
//$fname= $resulting[0]['Invester_FName'];
$cnic= $resulting[0]['ACC_CNIC'];

$mobile= $resulting[0]['ACC_SMSCELLNUMBER'];
$phone= $resulting[0]['ACC_PHONE'];
$email= $resulting[0]['ACC_EMAILADDRESS'];


$address= $resulting[0]['ACC_ADDRESS'];

$Joint_Name1= $resulting[0]['Joint_Name1'];
$Joint_Name2= $resulting[0]['Joint_Name2'];
$Joint_Name3= $resulting[0]['Joint_Name3'];


$this->db->select('*');
$this->db->where('Folio_No',$new_folio_get);
$resultingZakat = $this->db->get('investoraccountinfo')->result_array();     
$zakat= $resultingZakat[0]['ACC_ZAKATSTATUS'];
$tax= $resultingZakat[0]['ACC_TAXSTATUS'];
$cgt= $resultingZakat[0]['ACC_CGTSTATUS'];



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
        font-size:13px;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
        font-size:14px;
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
                                <img src="<?php echo base_url();?>images/hblasset-logo.jpg" style="width:100%;max-width: 75%;margin-bottom: -30px;">
                            </td>
                            
                            <td>
                                
                                <br>
                                Print Date: <?php echo date("d-m-Y");?><br>
                                Print Time: <?php echo date("h:i:sa");?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">

                <td colspan="2">
                    <table>
                    <hr>
                    <center><h2>Statement of Account</h2></center>
                    <center><h4>From <?php echo date('d-m-Y', strtotime($fdate_format));?> To <?php echo date('d-m-Y', strtotime($tdate_format));?></h4></center>
                    
                    
                    
                    <hr>

                        <tr>
                            <td>
                                <b>Folio No:</b> <?php echo $new_folio_get;?><br>
                                <!--<b>Investor Name:</b>--> <b><?php echo $name;?></b><br>
                                
                                <!--<b>CNIC:</b> <?php echo $cnic;?><br>-->
                                
                                <!--<b>Address</b>--> <?php 
                                $address_break_line = wordwrap($address, 30, "<br />\n");
                                echo $address_break_line;?><br>
                                <!--<b>Phone:</b>--> <?php echo $phone;?><br>
                                <!--<b>Mobile:</b>--> <?php echo $mobile;?><br>
                                <!--<b>Email:</b>--> <?php echo $email;?><br>
                                
                            </td>
                            
                            <td>
                                <b>Joint Holders (if any):</b><br>
                                <?php if(!empty($Joint_Name1)){echo $Joint_Name1;}else{echo "";}?><br>
                                <?php if(!empty($Joint_Name2)){echo $Joint_Name2;}else{echo "";}?><br>
                                <?php if(!empty($Joint_Name3)){echo $Joint_Name3;}else{echo "";}?><br>
                                <br><b>Zakat Status:</b> <?php echo $zakat;?> <br>
                                <b>Tax Status (Dividend):</b> <?php echo $tax;?> <br>
                                <b>CGT Status (Redemption):</b> <?php echo $cgt;?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
</table>
<table>                  
            
            <tr class="heading">
                
                <td align="left">
                    Fund 
                </td>
                <td>
                    Date
                </td>
                
                <td>
                    Transaction ID
                </td>
                
                <td>
                    Transaction Type
                </td>
                
                <td>
                    Applicable Price
                </td>
                <td>
                    Units
                </td>
                <td>
                    Amount (Rs.)
                </td>
            </tr>
            <?php 
            $this->db->where('Folio_No',$new_folio_get);
            if($select_fund != "All"){
            $this->db->where('Fund_short_Name',$select_fund);       
            }
            
           $this->db->where('Trans_Date >=', $fdate_format);
            $this->db->where('Trans_Date <=', $tdate_format);

            
              $this->db->from('transactionhistory');
              $this->db->order_by('Fund_short_Name','asc');
             $this->db->order_by('Trans_Date','desc'); 
              $queryData = $this->db->get();
              
              foreach($queryData->result() as $queryDataShow){
                
            
        
            
            ?>
            
            
            <tr class="item">
                
                
                
                
                <td align="left">
                    <?php echo $queryDataShow->Fund_short_Name;?>
                </td>
                <td align="left">
                    <?php 
                    
                    echo date('d/m/Y', strtotime($queryDataShow->Trans_Date));?>
                </td>
                <td align="left">
                    <?php echo $queryDataShow->Transaction_ID;?>
                </td>
                <td align="left">
                    <?php echo $queryDataShow->Trans_Type;?>
                </td>
                
                <td align="right">
                    <?php echo number_format($queryDataShow->NAV,4);?>
                </td>
                
                <td align="right">
                    <?php echo number_format($queryDataShow->Units,4);?>
                </td>
                <td align="right">
                    <!--<?php echo number_format($queryDataShow->Amount,2);?>-->
					<?php echo number_format($queryDataShow->Amount+$queryDataShow->CGT,2);?>
                </td>
            </tr>
            
            
            
           <?php } ?>
   
        </table>
        <br>
        <br>
        
        <!--
        <table>
            <tr>
                <td><center><div id="piechart"></div></center></td>
                <td><b>Total value of your investment <br> is:

                <?php
                
                   // $query22= $this->db->where('Tran_Date <', $fdate_format);
                //    $query22= $this->db->where('Tran_Date >', $tdate_format);


                    $query22 = $this->db->select_sum('Amount', 'Amount');
                    $query22 = $this->db->where('Folio_No',$new_folio_get);
                    if($select_fund != "All"){
                    $query22 = $this->db->where('Fund_Code',$select_fund);       
                    }
                    
                    $query22 = $this->db->get('transactionhistory');
                    $result22 = $query22->result();
                    
                    echo "Rs. ".$result22[0]->Amount;
                ?></b>
                </td>
            </tr>
        </table>
-->
        <hr>
        <center><b>This is a computer generated report and does not require any signature. In case of any discrepencies, please contact:
        HBL ASSET MANAGEMENT LIMITED</b><br>
        <span>7th Floor, Emerald Tower, G-19, Block 5, Clifton, Karachi, Pakistan</span><br>
        <span>UAN:(021) 111-425-262 FAX: (021) 35168455 WEB: www.hblasset.com EMAIL: info@hblasset.com</span>
    </center>


    </div>
</body>
</html>