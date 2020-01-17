<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

public function __construct()
{
parent::__construct();
$this->load->helper('url');
$this->load->database();
$this->load->library('pagination');

//load the department_model
$this->load->helper('url');

$this->load->model('department_model');
}
/**

* Index Page for this controller.
*
* Maps to the following URL
* 		http://example.com/index.php/welcome
*	- or -
* 		http://example.com/index.php/welcome/index
*	- or -
* Since this controller is set as the default controller in
* config/routes.php, it's displayed at http://example.com/
*
* So any other public methods not prefixed with an underscore will
* map to /index.php/welcome/<method_name>
* @see https://codeigniter.com/user_guide/general/urls.html
*/
public function index()
{
$this->load->view('register');
}
public function confirm()
{
$this->load->view('confirm');
}	


public function otp_expire()
{
$this->session->sess_destroy();

echo '<script> window.location.href = "../";</script>';

}
public function confirm_check()
{


date_default_timezone_set("Asia/Karachi");

$current_time= date("h:i:sa");


$otpcode= $this->input->post('otpcode');

$otpcreated= $this->input->post('otpcreated');

$newpass= $this->input->post('newpass');
//echo $newpass;exit();
//echo "<br>";
///echo $_SESSION['otp'];

$minutes_diff = round(abs(strtotime($otpcreated) - strtotime($current_time)) / 60);

if($minutes_diff >= 60){

$this->load->library("session");

$this->session->set_userdata("otp","");
$this->session->userdata("otp");


echo "<script>alert('This OTP was expire now. Please resend again OTP and try again.');</script>";
echo'<script>window.location.href = "../Register/confirm";</script>';	

exit;    
}



if ($otpcode != $_SESSION['otp']) {
// $this->session->sess_destroy();

echo "<script>alert('Verification code are not match. Please try again later.');</script>";

echo'<script>window.location.href = "../Register/confirm";</script>';	


}


if ($otpcode == $_SESSION['otp']) {



$logfolio= $_SESSION['Folio_No'];
//exit;
$logid= "-";//exit;
$logotp= $_SESSION['otp'];//exit;

//echo $_charcode;exit();

$this->db->select('*');
$this->db->where('Folio_No',$logfolio);
$resultname = $this->db->get('investoraccountinfo')->result_array();	
//print_r($resultname);exit;
$emailadd= $resultname[0]['ACC_EMAILADDRESS'];
//echo "<br>";
$smscell= $resultname[0]['ACC_SMSCELLNUMBER'];
$ACCTITLE= $resultname[0]['ACC_TITLE'];

//exit;


$this->db->select('*');
$this->db->where('Folio_No',$logfolio);
$resultchecking = $this->db->get('user')->result_array();
if(!empty($resultchecking[0]['UserID'])){
$useridcheck= $resultchecking[0]['UserID'];
}
if(empty($resultchecking[0]['UserID'])){
$useridcheck="";
}

if(!empty($resultchecking[0]['Folio_No'])){
$foliocheck= $resultchecking[0]['Folio_No'];
}
if(empty($resultchecking[0]['Folio_No'])){
$foliocheck="";
}				

if($foliocheck == $logfolio OR $useridcheck==$logfolio){
echo "<script>alert('Sorry this folio is already registered. Please contact our representative.');</script>";
$this->session->sess_destroy();

echo'<script>window.location.href = "../Register";</script>';	
exit;
}


$this->load->model('Customer_panel');
$ok = $this->Customer_panel->addNewUser();


if($ok){
$output = false;
$encrypt_method = "AES-256-CBC";
$secret_key = '9KXtqsphm+NrdmHFfoNFfnaB13pKnBakY+RZ6RsRiFE=';

// hash
$key = hash('sha256', $secret_key);

// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
$iv = substr(hash('sha256', strrev($secret_key)), 0, 16);

$output = openssl_encrypt($_SESSION['img'], $encrypt_method, $key, 0,$iv);
$res = base64_encode($output);


$this->db->where('Folio_No',$_SESSION['my_id']);
$this->db->update('user', ['img' => $res]); 
}



$insester_name= "Customer";
if(!empty($ACCTITLE)){
$insester_name= $ACCTITLE;
}


$this->db->select('*');
$this->db->limit(1);
$resultadmin = $this->db->get('Parameters')->result_array();
$admin_email= $resultadmin[0]['AdminEmail'];


//EXIT;
include 'email/class.phpmailer.php';
include 'email/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail2Admin = new PHPMailer;


///
$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.6.209.160';                 // Specify main and backup server
$mail->Port = 25;// Set the SMTP port
$mail->SMTPAuth = false;           // Enable SMTP authentication


$mail2Admin->Host = $mail->Host; // Specify main and backup server
$mail2Admin->Port = $mail->Port;// = 465;                                    // Set the SMTP port
$mail2Admin->SMTPAuth = false; 
/////
$mail->From = 'info@hblasset.com';
$mail2Admin->From=$mail->From;
$mail->FromName = '';
$mail2Admin->FromName = $mail->FromName;
// Add a recipient \\ 

$mail->AddAddress($emailadd,$insester_name);  // Add a recipient 

$mail2Admin->AddAddress($admin_email,$insester_name);

$mail->IsHTML(true);    // Set email format to HTML
$mail2Admin->IsHTML(true);
$mail->Subject = 'HBL Asset Management Ltd. - Successful Registration';
$mail2Admin->Subject =$mail->Subject ;
$mail->Body    = '<br>
<h4>Dear Customer,</h4>
<p>HBL Asset Management Company Ltd. welcomes you to its Online Services Portal.</p>
<p>Please login by using the following credentials:</p>

<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#00a997" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#00a997 !important;">
<tr> 
<td colspan="2" height="25" bgcolor="00a997"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Login Details</strong></font></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Folio No</font></p></td>
<td width="300"><p><font size="-1">'.$logfolio.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Password</font></p></td>
<td width="300"><p><font size="-1">'.$newpass.'</font></p></td>
</tr>
</table>				    
<p>For your safety, it is highly recommended to change the Password provided to you on your first login to the Online Services portal.</p>
<p>Our customers are our most valuable asset. It will be a pleasure for us to help you with any query or information that you may have. Please feel free to contact us on Toll Free No. 0800 42526 (during business hours) or email us on info@hblasset.com in case of any queries related to your account. 
</p>    
<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>

';

$mail2Admin->Body    = '<br>
<h4>Dear Customer,</h4>
<p>HBL Asset Management Company Ltd. welcomes you to its Online Services Portal.</p>
<p>Please login by using the following credentials:</p>

<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#00a997" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#00a997 !important;">
<tr> 
<td colspan="2" height="25" bgcolor="00a997"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Login Details</strong></font></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Folio No</font></p></td>
<td width="300"><p><font size="-1">'.$logfolio.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Password</font></p></td>
<td width="300"><p><font size="-1">********</font></p></td>
</tr>
</table>				    
<p>For your safety, it is highly recommended to change the Password provided to you on your first login to the Online Services portal.</p>
<p>Our customers are our most valuable asset. It will be a pleasure for us to help you with any query or information that you may have. Please feel free to contact us on Toll Free No. 0800 42526 (during business hours) or email us on info@hblasset.com in case of any queries related to your account. 
</p>    
<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>

';

$mail->AltBody = '';
$mail2Admin->AltBody = $mail->AltBody;

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
exit;
}
else  {

$mail2Admin->Send();
error_reporting(0);


echo "<script>alert('Successfully Registered. Your login details have been sent to your registered email address.');</script>";
$this->session->sess_destroy();

echo'<script>window.location.href = "../Customer";</script>';	
}
//            echo'<script>window.location.href = "../Customer";</script>';	
}


}

private function sendSMS($recipient,$messagedata){
////////set input values here ////////////////
//$recipient = "923332263324";
//$messagedata = "Your%20OTP%20is%20".$_charcode."%20to%20change%20your%20password%20request.%20This%20OTP%20will%20expire%20after%205%20minutes.";
//////////////////////////////////////////////
//$url = "https://rizwaanahmed.000webhostapp.com/hblsms.php?recipient={$recipient}&messagedata={$messagedata}";

$url = "http://smsctp1.eocean.us:24555/api?action=sendmessage&username=9300_HBL2&password=HbL321456&recipient={$recipient}&originator=9300&messagedata={$messagedata}";

$ch = curl_init(str_replace(" ", '%20', $url));
curl_setopt($ch, CURLOPT_HEADER, true);  
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch,CURLOPT_HTTPGET, true);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
$output = curl_exec($ch);
//print curl_error($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
//print $output;
//httpcode must be 200 for successful
//echo 'HTTP code: ' . $httpcode;
//get the Message id from reposne/output and save into DB with OTP log file.
//set No more than 2 OTP allowed per day per userid. 			

}


public function check_registration()
{

$_SESSION['img'] = $_POST['imageSecurity'];

$title= $_POST['accountTitle'];
// $cnic= $_POST['cnic'];
//13 June 2018
$cnic = str_replace('-', '',$_POST['cnic']);

//exit;
$email= strtolower($_POST['email']);

$mobiles= $_POST['mobile'];
//echo "<br>";

$output = str_split($mobiles, 2);
$output[0] = substr($mobiles, 0, 2);
$ex_minus= $output[1] = substr($mobiles, 2, 10);
$numberget= explode("-",$ex_minus);
$mobile= "923".$numberget[0]."".$numberget[1];
//exit;
//exit;
//$Individual= $_POST['Individual'];

$reg_folio= $_POST['reg_folio'];
$_SESSION['my_id'] = $reg_folio;
//$loginid= $_POST['loginid'];
$change_dob_format= explode("-",$_POST['dob']);

//$dob= ltrim($change_dob_format[1], '0').'/'.$change_dob_format[2].'/'.$change_dob_format[0];
$dob= ltrim($change_dob_format[1], '0').'/'.$change_dob_format[2].'/'.$change_dob_format[0];

$this->db->select('*');
$this->db->where('Folio_No',$reg_folio);
$accountinfo = $this->db->get('investoraccountinfo')->result_array();		
$ACC_TITLE= $accountinfo[0]['ACC_TITLE'];

//$ACC_CNIC= $accountinfo[0]['ACC_CNIC'];
//13 June 2018
$ACC_CNIC= str_replace('-', '',$accountinfo[0]['ACC_CNIC']);


$ACC_EMAILADDRESS= strtolower($accountinfo[0]['ACC_EMAILADDRESS']);
$ACC_SMSCELLNUMBER= $accountinfo[0]['ACC_SMSCELLNUMBER'];
$ACC_Type= $accountinfo[0]['ACC_Type'];
$Folio_No= $accountinfo[0]['Folio_No'];
$dob_db= $accountinfo[0]['dob'];//exit;
$loginid= $accountinfo[0]['Folio_No'];



if (//$ACC_TITLE != $title OR 
$ACC_CNIC != $cnic OR 
$ACC_EMAILADDRESS != $email OR 
$ACC_SMSCELLNUMBER != $mobile OR 
//$ACC_Type != $Individual OR 
$Folio_No != $reg_folio OR 
//$dob != $dob_db
date("m/d/Y",strtotime($dob)) != 
date("m/d/Y",strtotime($dob_db))


) {
echo "<script>alert('Sorry, we didn’t recognize you. Please contact our representative.');</script>";

echo'<script>window.location.href = "../Register";</script>';exit;	
}

if (empty($title) OR empty($cnic) OR 
empty($email) OR empty($mobile) OR 
//empty($Individual) OR 
empty($reg_folio) 
OR empty($loginid) 
OR empty($dob)) {


echo "<script>alert('Please fill complete form then submit.');</script>";

echo'<script>window.location.href = "../Register";</script>';
exit;
}

if (//$ACC_TITLE == $title AND 
$ACC_CNIC == $cnic AND 
$ACC_EMAILADDRESS == $email AND 
$ACC_SMSCELLNUMBER == $mobile AND 
$Folio_No == $reg_folio 
AND 
//$dob == $dob_db
date("m/d/Y",strtotime($dob)) == 
date("m/d/Y",strtotime($dob_db))



) {

// echo "das";exit; 
error_reporting(0);
$this->db->select('*');
$this->db->where('Folio_No',$Folio_No);
$check_id = $this->db->get('user')->result_array();		
$idvalue= $check_id[0]['UserID'];
$idfolio= $check_id[0]['Folio_No'];
$idstatus= $check_id[0]['Status'];

if ($idfolio==$reg_folio AND $idstatus=="P" OR  $idstatus=="Pending") {

echo "<script>alert('Request for this account is already sent. Please contact our representative.');</script>";
echo'<script>window.location.href = "../Register";</script>';	exit;


}
if ($idfolio == $Folio_No) {
echo "<script>alert('This user is already registered. Please contact our representative.');</script>";

echo'<script>window.location.href = "../Register";</script>';

exit;
}
else {

// echo "Osama";

$_chars = "ZXCVBNMASDFGHJKLQWERTYUIOP0123456789";

$_charcode = ''; // initialize the variable with an empty string
for($l = 0; $l<6; $l++){
$temp = str_shuffle($_chars);
$_charcode .= $temp[0];
}
$_SESSION['my_code'] = $_charcode;
$recipient = $ACC_SMSCELLNUMBER;
$messagedata = "Dear%20customer,%20your%20OTP%20to%20complete%20registeration%20is%20".$_charcode."%20.%20This%20will%20expire%20after%2060%20minutes.%20For%20help,%20call%200800-42526.%20HBL%20Asset%20Management%20Ltd.";
$this->sendSMS($recipient, $messagedata);

date_default_timezone_set("Asia/Karachi");
$current_time= date("h:i:sa");

$this->load->library("session");

$this->session->set_userdata("Folio_No","$Folio_No");
$this->session->userdata("Folio_No");

//$this->session->set_userdata("loginid","$loginid");
//$this->session->userdata("loginid");

$this->session->set_userdata("otp","$_charcode");
$this->session->userdata("otp");

$this->session->set_userdata("emailinputs","$email");
$this->session->userdata("emailinputs");

$this->session->set_userdata("mobnum","$mobile");
$this->session->userdata("mobnum");

$this->session->set_userdata("otp_created_time","$current_time");
$this->session->userdata("otp_created_time");


echo'<script>window.location.href = "../Register/confirm";</script>';


}

}

}
public function resend()
{

$logfolio= $_SESSION['Folio_No'];
$mobilenum= $_SESSION['mobnum'];

$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['Folio_No']);
$resultmobile = $this->db->get('investoraccountinfo')->result_array();		
$mobileno= $resultmobile[0]['ACC_SMSCELLNUMBER'];

$_chars = "ZXCVBNMASDFGHJKLQWERTYUIOP0123456789";

$_charcode = ''; // initialize the variable with an empty string
for($l = 0; $l<6; $l++){
$temp = str_shuffle($_chars);
$_charcode .= $temp[0];
}


$recipient = $mobileno;
$messagedata = "Dear%20customer,%20your%20OTP%20to%20complete%20registeration%20is%20".$_charcode."%20.%20This%20will%20expire%20after%2060%20minutes.%20For%20help,%20call%200800-42526.%20HBL%20Asset%20Management%20Ltd.";
$this->sendSMS($recipient, $messagedata);

$this->load->library("session");

$this->session->set_userdata("otp","$_charcode");
$this->session->userdata("otp");
echo'<script>window.location.href = "../Register/Confirm";</script>';


}

public function confirmpass_check()
{

date_default_timezone_set("Asia/Karachi");

$current_time= date("h:i:sa");


$otpcode= $this->input->post('otpcode');

$otpcreated= $this->input->post('otpcreated');

$neworignalpass= $this->input->post('newpass');
$newpass= md5($this->input->post('newpass'));

$minutes_diff = round(abs(strtotime($otpcreated) - strtotime($current_time)) / 60);

if($minutes_diff >= 60){

$this->load->library("session");

$this->session->set_userdata("otp","");
$this->session->userdata("otp");


echo "<script>alert('This OTP was expire now. Please resend again OTP and try again.');</script>";
echo'<script>window.location.href = "../Customer/confirm_forgotpass";</script>';	

exit;    
}
if(empty($otpcode)){
$this->load->library("session");

$this->session->set_userdata("otp","");
$this->session->userdata("otp");


echo "<script>alert('Please click on resend OTP and create new OTP.');</script>";
echo'<script>window.location.href = "../Customer/confirm_forgotpass";</script>';	
exit;    

}

//echo $newpass;exit();
//echo "<br>";
///echo $_SESSION['otp'];

if ($otpcode != $_SESSION['otp']) {

// $this->session->sess_destroy();

echo "<script>alert('Verification code are not match. Please try again later.');</script>";



echo'<script>window.location.href = "../Customer/confirm_forgotpass";</script>';	

}


if ($otpcode == $_SESSION['otp']) {


$emailinput= $_SESSION['emailinput'];
$logid= $_SESSION['loginid'];//exit;
$logotp= $_SESSION['otp'];//exit;
$aaa= $_SESSION['loginid'];
$afol= $_SESSION['folioss'];

//echo $_charcode;exit();

$data = array(
'Password' => $newpass,
);

$this->db->where('Folio_No', $logid);
$this->db->update('user', $data); 

$this->load->model('Customer_panel');
$this->Customer_panel->forgot_password_log();

$this->db->select('*');
$this->db->where('UserID',$_SESSION['loginid']);
$resultf = $this->db->get('user')->result_array();		
$Folio_Nos= $resultf[0]['Folio_No'];


$this->db->select('*');
$this->db->where('Folio_No',$Folio_Nos);
$resultname = $this->db->get('investoraccountinfo')->result_array();		
$insester_name= $resultname[0]['ACC_TITLE'];
$insester_sms= $resultname[0]['ACC_SMSCELLNUMBER'];
$insester_email= $resultname[0]['ACC_EMAILADDRESS'];

$this->db->select('*');
$this->db->limit(1);
$resultadmin = $this->db->get('Parameters')->result_array();
$admin_email= $resultadmin[0]['AdminEmail'];




include 'email/class.phpmailer.php';
include 'email/PHPMailerAutoload.php';

$mail = new PHPMailer;

///
$mail->IsSMTP();                                     
$mail->Host = '10.6.209.160'; 
$mail->Port = 25;                            
$mail->SMTPAuth = false;                      
$mail->From = 'info@hblasset.com'; //'noreply@hblasset.com';
$mail->FromName = ''; 
$mail->AddAddress($insester_email,'HBL Asset Management Ltd.');  // Add a recipient \\ 

$mail->IsHTML(true);                                  // Set email format to HTML
$mail->Subject = 'HBL Asset Management Ltd. - Password Reset';
$mail->Body    = '<br>
<h4>Dear Customer,</h4>
<p>Your password has been changed successfully. Your new password details are as following:</p>

<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#00a997" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#00a997 !important;">
<tr> 
<td colspan="2" height="25" bgcolor="00a997"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Login Details</strong></font></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Folio No.</font></p></td>
<td width="300"><p><font size="-1">'.$aaa.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Password</font></p></td>
<td width="300"><p><font size="-1">'.$neworignalpass.'</font></p></td>
</tr>
</table>
<p>For your safety, it is highly recommended to change the Password provided to you on your next login to the Online Services portal.</p>
<p>Our customers are our most valuable asset. It will be a pleasure for us to help you with any query or information that you may have. Please feel free to contact us on Toll Free No. 0800 42526 (during business hours) or email us on info@hblasset.com in case of any queries related to your account.</p>
<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>

';

$mail->AltBody = '';

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
exit;
}
else  {
error_reporting(0);


echo "<script>alert('Your Password has been reset. The credentials have been sent to your email address.');</script>";
$this->session->sess_destroy();

echo'<script>window.location.href = "../Customer";</script>';	
}
//            echo'<script>window.location.href = "../Customer";</script>';	
}


}


public function resend_pass()
{

$logfolio= $_SESSION['folioss'];

$this->db->select('*');
$this->db->where('Folio_No',$logfolio);
$resultmobile = $this->db->get('investoraccountinfo')->result_array();		
$mobilesms= $resultmobile[0]['ACC_SMSCELLNUMBER'];

$_chars = "ZXCVBNMASDFGHJKLQWERTYUIOP0123456789";

$_charcode = ''; // initialize the variable with an empty string
for($l = 0; $l<6; $l++){
$temp = str_shuffle($_chars);
$_charcode .= $temp[0];
}

$recipientss = $mobilesms;
$messagedatass = "Your%20OTP%20is%20".$_charcode."%20to%20change%20your%20password%20request.%20This%20OTP%20will%20expire%20after%2060%20minutes.";
$this->sendSMS($recipientss, $messagedatass);
$this->load->library("session");

$this->session->set_userdata("otp","$_charcode");
$this->session->userdata("otp");
echo'<script>window.location.href = "../Customer/confirm_forgotpass";</script>';


}



}
