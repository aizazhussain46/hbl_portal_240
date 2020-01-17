<?php include "elements/header-bank.php";?>

<div class="page-title">
    <div class="container">
    <div class="row">
    
        <h1 class="h1">
            <span>Activity log</span>
        </h1>
    </div>
    </div>
</div>

    <div class="gray-area">
        <div class="container">
        <div class="profile-page row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="h2 gradient-1">
                          <div class="col-md-6">Activity Logs<br></div>
                          
                          
                         <form method="post" action="<?php echo base_url();?>Customer/activitylog">
                          <div class="col-md-6 text-right" style="    margin-top: -15px; color: #000; font-size: 12px; ">
                              <select style="width:200px;height: 34px" name="search_res" required>
                               <option value="" style="display:none">Number of rows</option>
                               <option value="25">25</option>
                               <option value="50">50</option>
                               <option value="100">100</option>
                               <option value="250">250</option>
                               <option value="500">500</option>
                              </select>
                              <input type="submit" class="btn btn-primary" style="background: #696464;">
                          </div>
                         </form>
                      </div>
                      <div class="clearfix">

                                    <div class="table-responsvie" style="
    margin-top: -10px;
    width: 103.6%;
    margin-left: -20px;
">           
            <table class="table table-striped bordered " >
                <tr style=" background: #696464; color: #fff !important; ">
                    <td style=" padding-left: 30px; ">Activity Date / Time</td>
                    <td>Activity Description</td>
                    <td>Status</td>
                </tr>

                <?php for ($i = 0; $i < count($deptlist); ++$i) { ?>


                    <tr>
                                        <td style=" padding-left: 30px; "><?php 
                                            echo $deptlist[$i]->ActivityDate.' '.$deptlist[$i]->ActivityTime;
                                         ?></td>
                                             <td><?php 
                                            echo $deptlist[$i]->description;
                                         ?></td>
                                        <td><?php 
                                            echo $deptlist[$i]->status;
                                         ?></td>                                         
                                        
                    </tr>

                <?php  }


                ?>           

            </table>
        </div>

                    <DIV class="text-center">
                       <?php echo $pagination ; ?>

                    </DIV>

<div><p>This activity log shows your login / transactions done in the last 90 days.</p></div>
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