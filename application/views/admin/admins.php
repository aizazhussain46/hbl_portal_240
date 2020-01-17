<?php 
include "elements/header.php";
$status_page_show= $this->uri->segment('3');

?>
	  
		<!---->
    <img src="<?php echo base_url();?>images/profile-banner.jpg" style="width: 100%">

    <div class="container" style="margin-top: 50px">
    	
    	<div class="col-md-12">
    		<DIV class="header-box">
    			Admin Users
                <input type="button" name="" style="float: left;margin-right: -5px; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    margin-top: -3px;    float: right; " value="New User" data-toggle="modal" data-target="#newuser">

    		<!--	<form action="<?php echo base_url();?>Admin/admin_users_search" method="POST">
                    <input type="submit" name="" style="float: left;margin-right:  5px;; height: 34px; color: #ffffff; background: #696464; border: #f3f3f4; font-size: 12px;    float: right;    margin-top: -25px;    float: right; " name="ok">

                    <input type="text" class="form-control" style=" width: 30%; float: left;     margin-top: -25px;    float: right;"  name="search_status" required="" Placeholder="Search Email Address" name="search_status">
                </form>    -->
    			
    			
    		</DIV>

    			    

    		
    		
    		<div class="table-responsvie" style=" height: 500px; overflow: auto; ">           
            <table class="table table-striped bordered ">
                <tr style=" background: #696464; color: #fff !important; ">
                    <td style=" color: #fff; ">ID</td>
                    <td style=" color: #fff; ">Email</td>
                    <td style=" color: #fff; ">User Type</td>
                    <td style=" color: #fff; ">Status</td>
                    <td style=" color: #fff; ">Options</td>
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

$sql = "SELECT * FROM admin ORDER BY adminid DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  
?>                 

<?php

if(!empty($status_page_show)){
  $this->db->where('UserID',$status_page_show);
    
}
  $this->db->from('admin');
  $query = $this->db->get();
  //foreach($query->result() as $aa){
while ($aa = mysqli_fetch_assoc($rs_result)) {


?>

                <tr>
                    <td><?php echo $aa[adminid];?></td>
                    <td><?php echo $aa[Email];?></td>
                    <td><?php echo $aa[UserTyoe];?></td>
                    <td><?php if($aa[status == 1]){echo "Active";}if($aa[status] == 0){echo "Deactive";}?></td>
                    <td style="">
                       <a  style=' background: #069198; color: #fff; padding: 3px 25px 3px 25px; text-decoration: none;cursor: pointer; ' data-toggle="modal" data-target="#myModal<?php echo $aa[adminid];?>"> Settings</a>


  <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $admin_id=$aa[adminid];?>" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          
          <?php
          
            $this->db->select('*');
            $this->db->where('adminid',$admin_id);
            $result_admin_user = $this->db->get('admin')->result_array();		

          ?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Settings</h4>
        </div>
        <div class="modal-body">
          <table>
             <form action="<?php echo base_url();?>Admin/update_user_profile" method="POST"> 
              <tr>
                  <input type="hidden" name="user_id" value="<?php echo $admin_id;?>">
                  <td>Email</td>
                  <td><input type="email" class="form-control" value="<?php echo $result_admin_user[0]['Email'];?>" name="email" required></td>
              </tr>
              <tr>
                  <td>User Type</td>
                  <td>
                      <select class="form-control" name="type_admin">
                          <option value="CBC" <?php if($result_admin_user[0]['UserTyoe']=="CBC"){?> selected <?php } ?> >CBC</option>
                          <option value="OPR" <?php if($result_admin_user[0]['UserTyoe']=="OPR"){?> selected <?php } ?> >OPR</option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td>Status</td>
                  <td>
                      <select class="form-control" name="status">
                          <option value="1" <?php if($result_admin_user[0]['status']== 1){?> selected <?php } ?> value="1">Active</option>
                          <option value="0" <?php if($result_admin_user[0]['status']== 0){?> selected <?php } ?>>Deactive</option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td>
                     <input type="submit" value="Submit" style=" background: #069198; color: #fff; padding: 8px 25px 8px 25px; text-decoration: none;cursor: pointer;border:0 "> 
                  </td>
                  <td>
                  </td>
              </tr>
            </form>
              <tr>
                  <td style=" font-weight: bold; color: #069198; ">Change Password</td>
                  <td>
                  </td>
              </tr>
             <form action="<?php echo base_url();?>Admin/update_user_password" method="POST"> 
              <tr>
                  <td>New Password</td>
                  <td><input type="password" required class="form-control" name="newpass"></td>
              </tr>
              <input type="hidden" name="user_id" value="<?php echo $admin_id;?>">

              <tr>
                  <td>
                     <input type="submit" value="Change Password" style=" background: #069198; color: #fff; padding: 8px 25px 8px 25px; text-decoration: none;cursor: pointer;border:0 "> 
                  </td>
                  <td>
                  </td>
              </tr>
            </form>  
              
              
              
              
          </table>
          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>







                    </td>
                </tr>
  <?php }
 ?>             
 

            </table>
            
            
            <?php  
$sql = "SELECT COUNT(adminid) FROM admin";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<nav><ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<li><center><a href='../Admin/admin_users?page=".$i."'>".$i."</a></center></li>";  
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
		hrefTextPrefix : '../Admin/admin_users?page='
    });
	});
</script>            
            
            
            
        </div>
    </div>

   <!-- New User -->
  <div class="modal fade" id="newuser" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" width: 90%; ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style=" text-align: center; font-size: 25px; ">Create New User</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?php echo base_url();?>admin/create_admin">
           <table class="table-responsive" style=" margin:0 auto ">
              <tr style=" height: 50px; ">
                  <td style="width: 50%;">Email</td>
                  <td><input type="email" name="email" class="form-control" required></td>
              </tr>
              <tr style=" height: 50px; ">
                  <td>Password</td>
                  <td><input type="password" name="pass" required class="form-control"></td>
              </tr>
              <tr style=" height: 50px; ">
                  <td>User Type</td>
                  <td>
                      <select class="form-control" name="type" required>
                          <option style="display:none" name="role">Select Type</option>
                          <option value="OPR">OPR</option>
                          <option value="CBC">CBC</option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td><input type="submit" value="Submit" style=" background: #069198; color: #fff; padding: 8px 25px 8px 25px; text-decoration: none;cursor: pointer;border:0 "></td>
              </tr>
          </table>
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
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