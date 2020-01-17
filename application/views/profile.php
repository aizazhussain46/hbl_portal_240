<?php include "elements/header-bank.php";?>
<?php
$this->db->select('*');
$this->db->where('Folio_No', $foliodata);
$resultsss = $this->db->get('investoraccountinfo')->result_array();
$zakat = $resultsss[0]['ACC_ZAKATSTATUS'];
$cgt = $resultsss[0]['ACC_CGTSTATUS'];
$type = $resultsss[0]['ACC_Type'];
$auth = $resultsss[0]['ACC_Auth'];
$ACC_TITLE = $resultsss[0]['ACC_TITLE'];
$ACC_RELAT = $resultsss[0]['ACC_TITLE'];
$phone = $resultsss[0]['ACC_PHONE'];
if ($phone == "") {
    $phone = "-";
}
$cell = $resultsss[0]['ACC_SMSCELLNUMBER'];
$email = $resultsss[0]['ACC_EMAILADDRESS'];
$address = $resultsss[0]['ACC_ADDRESS'];
$cnicc = $resultsss[0]['ACC_CNIC'];

$cnicc = $resultsss[0]['ACC_CNIC'];
$cnicc = $resultsss[0]['ACC_CNIC'];

$ABA_ACCOUNTCODE = $resultsss[0]['ABA_ACCOUNTCODE'];
if ($ABA_ACCOUNTCODE == "") {
    $ABA_ACCOUNTCODE = "N/A";
}
$address = $resultsss[0]['ACC_ADDRESS'];

$ACC_RELA = $resultsss[0]['ACC_RELATIONSHIPPERSONNAME'];
$title = $resultsss[0]['Bank_AccountTitle'];
$bankname = $resultsss[0]['Bank_Name'];
$bankaddress = $resultsss[0]['Branch_Address'];

$cnicexpire = $resultsss[0]['ACC_CNICEXPIRYDATE'];
$cnicexplode = explode(" ", $cnicexpire);

?>
<div class="page-title">
    <div class="container">
    <div class="row">
        <h1 class="h1">
            <i class="icon icon-profile"></i>
            <span>Profile</span>
        </h1>
    </div>
    </div>
</div>

    <div class="gray-area">
        <div class="container">
        <div class="profile-page row">
                  <div class="col-md-6">
                    <div class="card">
                     <div class="h2 gradient-1">Basic Information</div>
                    <table class="table table-bordered table-striped">
                    <tbody>
                      <tr>
                        <td>Name</td>
                        <td>
                        <?php echo $ACC_TITLE; ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Father / Husband Name</td>
                        <td>
                       <?php echo $ACC_RELA; ?>
                        </td>
                      </tr>
                      <tr>
                        <td>CNIC</td>
                        <td>
                        <?php echo $cnicc; ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Expiry Date</td>
                        <td>
                       <?php echo date('d/m/Y', strtotime($cnicexplode[0])); ?>
                        </td>
                      </tr>
                      </tbody>
                    </table>




                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="h2 gradient-1">Account Information</div>

                       <table class="table table-bordered table-striped">
                    <tbody>
                      <tr>
                           <td>Zakat Status</td>
                        <td><?php echo $zakat; ?></td>

                      </tr>
                      <tr>
                       <td>WHT / CGT</td>
                        <td><?php echo $cgt; ?></td>
                      </tr>
                      <tr>
                        <td>Account Type</td>
                        <td><?php echo $type; ?></td>

                      </tr>
                      <tr>
                        <td>Authorization </td>
                        <td><?php echo $auth; ?></td>
                      </tr>
                      </tbody>
                    </table>


                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="card">
                      <div class="h2 gradient-1">Contact Information
                    <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#myModal" style="cursor: pointer;float: right;"></i>
                      </div>
                        <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                          <td>Phone No</td>
                          <td><?php echo $phone; ?></td>
                        </tr>

                        <tr>
                          <td>Mobile No.</td>
                          <td><?php echo $cell; ?></td>
                        </tr>

                        <tr>
                          <td>Email Address</td>
                          <td><?php echo strtolower($email); ?></td>
                        </tr>

                        <tr>
                          <td>Address</h3>
                          <td><?php echo $address; ?></td>
                        </tr>
                         </tbody>
                      </table>


                    </div>
                  </div>
                  <!-- Contact Information Modal -->

                          <!-- Modal -->
                          <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">

                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title" style="color: #000">Contact Information</h4>
                                </div>
                                <div class="modal-body">

                                <form name = "sfc" id="sfc" method="POST" action="<?php echo base_url() . 'Customer/contactinformation' ?>">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1" style="color: #000">Phone Number</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" required="" name="phone"
                                    value="<?php echo $phone; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1"  style="color: #000">Cell Phone</label>
                                    <input type="text" placeholder=""  class="form-control" id="exampleInputPassword1" required="" name="cell" value="<?php echo $cell; ?>" >
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1" style="color: #000">Email Address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="" required="" name="email"  value="<?php echo $email; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1"  style="color: #000">Address</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" required="" name="address"  value="<?php echo $address; ?>">
                                  </div>
                                    <input type="hidden" class="form-control" id="exampleInputPassword1" placeholder="" required="" name="folio" value="<?php echo $_SESSION['folio']; ?>">

                                  <input type="submit" name="sbc" id="sbc" class="btn btn-default" value="Submit">
                                </form>
<script type="text/javascript">

    document.getElementById("sfc").onsubmit = function () {
          document.getElementById("sbc").value = "Processing ...";
          document.getElementById("sbc").disabled = "disabled";
        return true; //will submit
    }
</script>
                                <br><br>


                                </div>
                               <!-- <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
                                </div>-->
                              </div>

                            </div>
                          </div>

                <!-- End Modal Contact Information -->



                  <div class="col-md-6">
                    <div class="card">
                      <div class="h2 gradient-1">Bank Details
                          <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#myModal2" style="cursor: pointer;float: right;"></i>
                      </div>
                       <table class="table table-bordered table-striped">
                        <tbody>
                          <tr>
                            <td>Account Number</td>
                            <td>
                                <?php
    if (!empty($ABA_ACCOUNTCODE)) {
        echo $ABA_ACCOUNTCODE;
    }
    if (empty($ABA_ACCOUNTCODE)) {
        echo "-";
    }
    ?></td>
                          </tr>
  
                          <tr>
                            <td>Bank Account Title</td>
                            <td>
                                 <?php
    if (!empty($title)) {
        echo $title;
    }
    if (empty($title)) {
        echo "-";
    }
    ?>
                            </td>
                          </tr>
  
                          <tr>
                            <td>Bank Name</td>
                            <td>
                                 <?php
    if (!empty($bankname)) {
        echo $bankname;
    }
    if (empty($bankname)) {
        echo "-";
    }
    ?>
                            </td>
                          </tr>
  
                          <tr>
                            <td>Address</td>
                            <td>
                                 <?php
    if (!empty($bankaddress)) {
        echo $bankaddress;
    }
    if (empty($bankaddress)) {
        echo "-";
    }
    ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>


                    </div>
                  </div>


                  <!--  Bank Details Modal Open -->

                          <!-- Modal -->
                          <div class="modal fade" id="myModal2" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">

                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title" style="color: #000">Bank Information</h4>
                                </div>
                                <div class="modal-body">

                                <form method="POST" name="sfb" id="sfb" action="<?php echo base_url() . 'Customer/bankinformation' ?>">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1" style="color: #000">Account Number</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="82983918291" required="" name="accountnumber"
                                    value="<?php echo $ABA_ACCOUNTCODE; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1"  style="color: #000">Bank Account Title</label>
                                    <input type="text" pattern="" placeholder="Azeem Khan" readonly class="form-control" id="exampleInputPassword1" required="" name="accounttitle" value="<?php echo $title; ?>" >
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1" style="color: #000">Bank Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" required="" name="bankname"  value="<?php echo $bankname; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1"  style="color: #000">Branch Address</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" required="" name="address"  value="<?php echo $bankaddress; ?>">
                                  </div>
                                    <input type="hidden" class="form-control" id="exampleInputPassword1" placeholder="" required="" name="folio" value="<?php echo $_SESSION['folio']; ?>">

                                  <input type="submit" name="sbb" id="sbb" class="btn btn-default" value="Submit">
                                </form>
																<script type="text/javascript">

    document.getElementById("sfb").onsubmit = function () {
          document.getElementById("sbb").value = "Processing ...";
          document.getElementById("sbb").disabled = "disabled";
        return true; //will submit
    }
</script>
                                <br><br>



                                </div>
                               <!-- <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
                                </div>-->
                              </div>

                            </div>
                          </div>
                </div>



                  <!--  Bank Details Modal Close -->









                </div>
        </div>
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style type="text/css">
    .header-box{
  background: #069198;
    color: #fff;
    padding: 20px;
  }
</style>
<?php include "elements/footer-bank.php";?>