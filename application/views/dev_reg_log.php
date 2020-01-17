<?php include "elements/header-bank.php";?>

<div class="page-title">
<div class="container">
<div class="row">

<h1 class="h1">
<span>Logged In Details</span>
</h1>
</div>
</div>
</div>

<div class="gray-area">
<div class="container">
<div class="profile-page">
<div class="col-md-12">
<div class="">


<div class="table-responsvie" style="
margin-top: -10px;
width: 103.6%;
margin-left: -20px;
">           
<table class="table table-striped bordered " >
<tr style=" background: #696464; color: #fff !important; ">
<td style=" padding-left: 30px; ">IP Address</td>
<td>Device Name</td>
<td>Browser Name</td>
<td>Operating System</td>
<td>Browser Location</td>
<td>Registerd At</td> 
</tr>


<?php ?>
<tr>
<td style=" padding-left: 30px; ">zero</td>
<td>one</td>
<td>two</td>  
<td>Operating System</td>
<td>Browser Location</td>
<td>Registerd At</td> 
</tr>                                       

</tr>
</table>
</div>

<DIV class="text-center">
<?php echo $pagination ; ?>

</DIV>

<div><p><!-- This activity log shows your login / transactions done in the last 90 days. --></p></div>
</div>


</div>
</div>

</div>
</div>
</div> 
</div>  
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
.header-box{
background: #069198;
color: #fff;
padding: 20px;
}li.active a {
background: #00a997 !important;
}
.card .h2 {
padding: 30px !important;
}
</style>
<?php include "elements/footer-bank.php";?>