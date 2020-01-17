<?php 
include "elements/header.php";
$status_page_show= $this->uri->segment('3');

?>
	  
		<!--
    <img src="<?php echo base_url();?>images/profile-banner.jpg" style="width: 100%">
-->
    <div class="container" style="margin-top: 50px">
    	
    	<div class="col-md-12">
    		<DIV class="header-box">
    			Upload Data File

    		</DIV>

    		<div class="col-md-12">
    		    <?php if($this->session->flashdata('message')){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>

<br>
<style>
    input[type=file] {
    display: initial;
}
</style>

<div align="LEFT">
<form action="<?php echo base_url(); ?>uploadcsv/import" 
method="post" name="upload_excel" enctype="multipart/form-data" style="
    border: 1px solid #069198;
    width: 56%;
    padding: 28px;
">
    

<select style=" width: 89%; margin-bottom: 20px; height: 40px; " required="" name="import_type">
    <option style="display:none" value="">Select Data File Type</option>
    <option value="portfolio">Daily Portfolio Summary</option>
    <option value="investor">Investor Profile</option>
    <option value="transaction">Transaction History</option>
    <option value="fmr">FMR Sheet</option>
    <option value="fmrdata">FMR Data Sheet</option>
    
    
    
</select>
<input type="file" name="file" id="file" >
<button type="submit" id="submit" name="import" style=" background: #069198; color: #fff; padding: 8px 25px 8px 25px; text-decoration: none;cursor: pointer;border:0 ">Upload</button>
</form>
<br>

    		<DIV class="header-box">
    			Current Staging Data Files

    		</DIV>

    		<div class="table-responsvie" style=" height: 500px; overflow: auto; ">           
            <table class="table table-striped bordered ">
                <tr style=" background: #696464; color: #fff !important; ">
                    <!--<td style=" color: #fff; ">ID</td>-->
                    <td style=" color: #fff; ">Upload Date</td>
                    
                    <td style=" color: #fff; ">File Type</td>
                    <td style=" color: #fff; ">File Name</td>
                    <td style=" color: #fff; ">No of Records</td>
                    <td style=" color: #fff; ">Upload By</td>
                    <td style=" color: #fff; ">Upload Status</td>
                    <td style=" color: #fff; ">Remarks</td>
                    <td style=" color: #fff; ">Action</td>
                    
                </tr>

<?php

  //$this->db->order_by('id','desc');
  $this->db->from('import');
  $this->db->where('importstatus','S');
  $queryss = $this->db->get();
  foreach($queryss->result() as $aas){

?>

                <tr>
                    <!--<td><?php echo $aas->id;?></td>-->
                    <td><?php echo $aas->created_date;?></td>
                    <td><?php echo $aas->filetype;?></td>
                    <td><?php echo $aas->filename;?></td>
                    <td><?php echo $aas->noofrecords;?></td>
                    <td><?php echo $aas->importby;?></td>
                    <td><?php echo $aas->importstatus;?></td>
                    <td><?php echo $aas->remarks;?></td>
                    <!--<td>Process / View Data</td>-->
                    <td> 
<?php
  if($aas->filetype=="transaction")
  {
?>
                    <a href="<?php echo base_url();?>/Admin/process_importa/<?php echo $aas->filetype ?>">
                    <Button  class="btn btn-primary" name="abc" value="def" style="" onclick="return confirm('Are you sure to process the staging data?');">Append</Button>
    			    </a>
    			    <br>
<?php
  }
?>


    			    <a href="<?php echo base_url();?>/Admin/process_importo/<?php echo $aas->filetype ?>">
                    <Button  class="btn btn-primary" name="" style="" onclick="return confirm('Are you sure to process the staging data?');">Update</Button>
    			    </a>
    			    <br>
    			    <a href="<?php echo base_url();?>/Admin/display/<?php echo $aas->filetype ?>">
                    <Button  name="" style="" onclick="return confirm('Are you sure to process the staging data?');">Display</Button>
    			    </a>
    			
                    </td>
                </tr>
  <?php }
 ?>             

            </table>
        </div>
    </div>



<DIV class="header-box">
    			Processed Data Files

    		</DIV>

    		<div class="table-responsvie" style=" height: 500px; overflow: auto; ">           
            <table class="table table-striped bordered ">
                <tr style=" background: #696464; color: #fff !important; ">
                    <!--<td style=" color: #fff; ">ID</td>-->
                    <td style=" color: #fff; ">Upload Date</td>
                    
                    <td style=" color: #fff; ">File Type</td>
                    <td style=" color: #fff; ">File Name</td>
                    <td style=" color: #fff; ">No of Records</td>
                    <td style=" color: #fff; ">Upload By</td>
                    <td style=" color: #fff; ">Upload Status</td>
                    <td style=" color: #fff; ">Remarks</td>
                    <td style=" color: #fff; ">Status</td>
                    
                </tr>

<?php

  //$this->db->order_by('id','desc');
  $this->db->from('import');
  $this->db->where('importstatus','P');
  $queryss = $this->db->get();
  foreach($queryss->result() as $aas){

?>

                <tr>
                    <!--<td><?php echo $aas->id;?></td>-->
                    <td><?php echo $aas->created_date;?></td>
                    <td><?php echo $aas->filetype;?></td>
                    <td><?php echo $aas->filename;?></td>
                    <td><?php echo $aas->noofrecords;?></td>
                    <td><?php echo $aas->importby;?></td>
                    <td><?php echo $aas->importstatus;?></td>
                    <td><?php echo $aas->remarks;?></td>
                    <td>Processed</td>
                    
                    </td>
                </tr>
  <?php }
 ?>             

            </table>
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
	height: 200px;    margin-bottom: 35px;
}
</style>