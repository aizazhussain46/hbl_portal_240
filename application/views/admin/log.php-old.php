<?php 
include "elements/header.php";
$status_page_show= $this->uri->segment('3');

?>
	  
		<!---->
    <img src="<?php echo base_url();?>images/profile-banner.jpg" style="width: 100%">

    <div class="container" style="margin-top: 50px">
    	
    	<div class="col-md-12">
    		<DIV class="header-box">
    			Activity Log

    			<!--<form action="<?php echo base_url();?>Admin/users_search" method="POST">
                    <input type="submit" name="" style="float: left;margin-right: -5px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    margin-top: -25px;    float: right; " name="ok">

                    <input type="text" class="form-control" style=" width: 30%; float: left;     margin-top: -25px;    float: right;"  name="search_status" required="" Placeholder="Search UserID" name="search_status">
                </form>    
    			-->
    			
    		</DIV>

    			    

    		
    		
    		<div class="table-responsvie" >           
            <table class="table table-striped bordered ">
                <tr style=" background: #696464; color: #fff !important; ">
                    <td style=" color: #fff; ">ActivityTable</td>
                    <td style=" color: #fff; ">ActivityBy</td>
                    <td style=" color: #fff; ">ActivityDate</td>
                    <td style=" color: #fff; ">ActivityTime</td>
                    <td style=" color: #fff; ">ActivityIP</td>
                    <td style=" color: #fff; ">Activity</td>
                    <td style=" color: #fff; ">ID</td>
                    <td style=" color: #fff; ">FolioNo</td>
                </tr>
                
                
                
                

<?php

if(!empty($status_page_show)){
  $this->db->where('UserID',$status_page_show);
    
}
  $this->db->order_by('SNO','desc');
  $this->db->from('AuditTrailAdmin');
  $query = $this->db->get();
  foreach($query->result() as $aa){

?>

                <tr>
                    <td><?php echo $aa->ActivityTable;?></td>
                    <td><?php echo $aa->ActivityBy;?></td>
                    <td><?php echo $aa->ActivityDate;?></td>
                    <td><?php echo $aa->ActivityTime;?></td>
                    <td><?php echo $aa->ActivityIP;?></td>
                    <td><?php echo $aa->Activity;?></td>
                    <td><?php echo $aa->ID;?></td>
                    <td><?php echo $aa->FolioNo;?></td>
                  
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
.pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #069198;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 2;
    color: #fff;
    cursor: default;
    background-color: #069198 !important;
    border-color: #069198 !important;
}
ul.pagination.light-theme.simple-pagination {
    margin: 0 auto !important;
    display: inherit;
    text-align: center;
    margin-top: 20px !important;
}
</style>