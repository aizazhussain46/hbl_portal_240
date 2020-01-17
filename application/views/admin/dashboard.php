<?php 


include "elements/header.php";

?>
	  
		<!---->
    <img src="<?php echo base_url();?>images/summary.jpg" style="width: 100%">

    <div class="container" style="margin-top: 50px">
    	
    	<div class="col-md-6">
    		<DIV class="header-box">
    			<center style=" font-size: 20px; ">Fund Wise Investment</center>
    		</DIV>
            <DIV class="header-box" style=" background: #707271; ">
                <div class="col-md-8" style=" margin-top: -10px; ">
                    FUNDS
                </div>
                <div class="col-md-4" style=" margin-top: -10px; ">
                    Ammount (Rs.)
                </div>                
            </DIV>
        <div class="table-responsvie" style=" height: 247px; overflow: auto; ">           
            <table class="table table-striped bordered ">
                <?php
                  $this->db->where('Foli_No',$sessionid);

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
                <tr>
                        <td style=" width: 68%;padding-left: 35px !important;    color: #069198; ">
                            <?php echo $fundName[0];?>
                        </td>
                        <td  style="color: #069198; "><?php echo number_format($investment->Amount1, 2, '.', ',');?></td>
                </tr>
                <?php } ?>                   
            </table>
        </div>
            <DIV class="header-box" style=" background: #707271;    height: 70px; ">
                <div class="col-md-8" style=" margin-top: -10px; ">
                    <p style="font-size: 20px">Total Investment value (Rs.)<p>
                    <p style="font-size: 12px">As on June 19, 2017</p>
                </div>
                <div class="col-md-4" style="margin-top: 5px;font-size: 21px;">
                    <?php
                    $this->db->select_sum('Amount1');
                    $this->db->where('Foli_No',$sessionid);
                    $abc = $this->db->get('dailyportfoliosummary')->result_array();    
                    $sum_value= array_sum($abc[0]);

                    echo number_format($sum_value, 2, '.', ',')

                    ?>


                </div>                
            </DIV>


        </div>



       <div class="col-md-6">
            <DIV class="header-box">
                <center style=" font-size: 20px; ">Your Recent Transaction</center>
            </DIV>


            <div class="table-responsvie" style=" height: 300px; overflow: auto; ">           
            <table class="table table-striped bordered ">
                <tr style="background: #707271;font-size: 14px;font-weight: bold;">
                        <td style="padding-left: 35px !important; color: #fff ">
                        Date                        
                        </td>
                        <td style=" color: #fff !important; ">Fund Name</td>
                        <td style=" color: #fff !important; " >Trans.Type</td>
                        <td style=" color: #fff !important; ">Units</td>
                        <td style=" color: #fff !important; ">Amount(Rs,)</td>
                </tr>
                <tr>
                        <td style="padding-left: 35px !important;">
                        28/09/2017                        
                        </td>
                        <td>HBLIF</td>
                        <td >Purchase</td>
                        <td>1090</td>
                        <td >10090</td>
                </tr>
                <tr>
                        <td style=" width: 30%;padding-left: 35px !important;">
                        28/09/2017                        
                        </td>
                        <td>HBLIF</td>
                        <td >Purchase</td>
                        <td>1090</td>
                        <td >10090</td>
                </tr>
                <tr>
                        <td style=" width: 30%;padding-left: 35px !important;">
                        28/09/2017                        
                        </td>
                        <td>HBLIF</td>
                        <td >Purchase</td>
                        <td>1090</td>
                        <td >10090</td>
                </tr>
                <tr>
                        <td style=" width: 30%;padding-left: 35px !important;">
                        28/09/2017                        
                        </td>
                        <td>HBLIF</td>
                        <td >Purchase</td>
                        <td>1090</td>
                        <td >10090</td>
                </tr>
                <tr>
                        <td style=" width: 30%;padding-left: 35px !important;">
                        28/09/2017                        
                        </td>
                        <td>HBLIF</td>
                        <td >Purchase</td>
                        <td>1090</td>
                        <td >10090</td>
                </tr>                                                
            </table>
        </div>
           

            <p style=" background: #f9f9f9; padding: 13px; color: #069198; font-size: 14px; padding-left: 35px;margin-bottom: 20px; "> It may take  up to 24 hours for your latest transaction to appear</p>

        </div>








        <div class="col-md-6">
            <DIV class="header-box">
                <center style=" font-size: 20px; ">Fund Wise Investment</center>
            </DIV>
            


<div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['HPL-F', 8],
  ['HBL MF', 2],
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':540, 'height':250};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script> 
        </div>



             <div class="col-md-6">
            <DIV class="header-box">
                <center style=" font-size: 20px; ">Profile Gain / Loss</center>
            </DIV>
            


  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["HPL-F", 8.94, "#b87333"],
        ["HPL-SF", 10.49, "silver"],
        ["HPL-MF", 19.30, "gold"],
        ["HPL-MAF", 21.45, "color: #e5e4e2"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        width: 540,
        height: 240,
        bar: {groupWidth: "8%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="columnchart_values" style="width: 540px; height: 240px;"></div>





        </div>
        </div>




<?php 
include "elements/footer.php";

?>

<style type="text/css">
	.header-box{
	background: #069198;
    color: #fff;
    padding: 20px;
	}
	.body {
    background: #fff;
    padding: 20px;    padding-bottom: 50px !important;
	}
	.body .col-md-6 {
    margin-bottom: 20px !important;
}
.body{
	height: 240px;    margin-bottom: 35px;
}html, body {
    font-family: 'Montserrat-Regular';
    font-size: 100%;
    background: #F3F3F4;
    overflow-x: initial;
}
</style>