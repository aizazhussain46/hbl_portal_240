<?php 
include "elements/header.php";
$status_page_show= $this->uri->segment('3');

?>
	  
		<!---->
    <img src="<?php echo base_url();?>images/profile-banner.jpg" style="width: 100%">

    <div class="container" style="margin-top: 50px">
    	
    	<div class="col-md-12">
    		<DIV class="header-box">
    			Investment Activity Log

    			<!--<form action="<?php echo base_url();?>Admin/users_search" method="POST">
                    <input type="submit" name="" style="float: left;margin-right: -5px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    margin-top: -25px;    float: right; " name="ok">

                    <input type="text" class="form-control" style=" width: 30%; float: left;     margin-top: -25px;    float: right;"  name="search_status" required="" Placeholder="Search UserID" name="search_status">
                </form>    
    			-->
    			
    		</DIV>

    			    

    		
    		
    		<div class="table-responsvie" >           
            <table class="table table-striped bordered ">
                <tr style=" background: #696464; color: #fff !important; ">
                    
                    <td style=" color: #fff; ">Email</td>
                    <td style=" color: #fff; ">Action</td>
                    <td style=" color: #fff; ">Process Date</td>
                    <td style=" color: #fff; ">Process Time</td>
                </tr>
                
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/simplePagination.css" />
<script src="<?php echo base_url();?>css/jquery.simplePagination.js"></script>

  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sysmtech_hbl";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 
  
$limit = 10;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  

$sql = "SELECT * FROM investment_activity ORDER BY id DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  
?>                 
                
                

<?php

if(!empty($status_page_show)){
  $this->db->where('UserID',$status_page_show);
    
}
  $this->db->order_by('id','desc');
  $this->db->from('investment_activity');
  $query = $this->db->get();
  //foreach($query->result() as $aa){
  while ($aa = mysqli_fetch_assoc($rs_result)) {

?>

                <tr>
                    <td><?php echo $aa[email];?></td>
                    <td><?php echo $aa[action];?></td>
                    <td><?php echo $aa[created_date];?></td>
                    <td><?php echo $aa[created_time];?></td
                  
                    </td>
                </tr>
  <?php }
 ?>             

            </table>
            
            <?php  
$sql = "SELECT COUNT(id) FROM investment_activity";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<nav><ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<li><center><a href='../Admin/investments_log?page=".$i."'>".$i."</a></center></li>";  
};  
echo $pagLink . "</ul></nav>";  
?>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('.pagination').pagination({
        items: <?php echo $total_records;?>,
        itemsOnPage: <?php echo $limit;?>,
        cssStyle: 'light-theme',
		currentPage : <?php echo $page;?>,
		hrefTextPrefix : '../Admin/investments_log?page='
    });
	});
</script>            
            
            
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
        margin-bottom: 40px !important;
}
</style>