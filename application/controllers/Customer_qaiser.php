<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Customer extends CI_Controller {
public function __construct()
{
parent::__construct();
$this->load->helper('url');
$this->load->database();
$this->load->library('pagination');
$this->load->helper('url');
error_reporting(E_ALL & ~E_NOTICE);

$this->load->model('department_model');
}

public function investment_confirmation()
{
$folio_no = $this->input->post('folio');
$name = $this->input->post('name');
$cnic = $this->input->post('cnic');	
$fund_name = $this->input->post('funName');
$acc = $this->input->post('f_acc');
$bank_name = $this->input->post('bankName');
$amount = $this->input->post('tamount');
$ref = $this->input->post('cinum');
$remarks = $this->input->post('remark');
if(empty($fund_name) || empty($bank_name) || empty($amount) || empty($ref)){
	echo '<script>alert("Please fill the required fields.");
				  window.location.href = "../Customer/transaction";
		 </script>';

}
else{

$_SESSION['inv_folio_no'] =$folio_no;
$_SESSION['inv_name'] = $name;
$_SESSION['inv_cnic'] = $cnic;
$_SESSION['inv_select_fund_name'] = $fund_name;
$_SESSION['inv_acc'] = $cc;
$_SESSION['inv_select_bank'] = $bank_name;
$_SESSION['inv_tamount'] = $amount;
$_SESSION['inv_cinum'] = $ref;
$_SESSION['inv_remark'] = $remarks;
$this->load->view('investment_confirmation');

}
}

public function investment_confirmed()
{
if(!isset($_COOKIE['inv_ref_id'])){
echo '<script>window.location.href = "../Customer/dashboard";</script>';
}
	$this->load->view('investment_confirmed');
}

public function index()
{
$this->load->view('login');
}
public function login()
{
$this->load->view('login');
}
public function dr(){
if(!isset($_COOKIE['code'])){
echo '<script>window.location.href = "../Customer/dashboard";</script>';
}
$this->load->view('register_device');
}




private function dr_otp_send($recipient,$msg){


$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 
"http://smsctp1.eocean.us:24555/api?action=sendmessage&username=9300_HBL2&password=HbL321456&recipient={$recipient}&originator=9300&messagedata={$msg}",
));
curl_setopt($ch, CURLOPT_HEADER, true);  
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch,CURLOPT_HTTPGET, true);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resp = curl_exec($ch);
if (curl_error($ch)) {
echo 'server is temporarily down';
}

curl_close($ch);
}

public function skip(){
	$_SESSION['skip'] = $_POST['skip'];
	echo '<script>window.location.href = "../Customer/dashboard";</script>';

}


public function dr_otp(){

$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['folino']);
$result = $this->db->get('investoraccountinfo')->result_array();		
$recipient = $result[0]['ACC_SMSCELLNUMBER'];
$_charcode = rand(pow(10, 3), pow(10,4)-1);
$msg = "Dear%20customer,%20your%20OTP%20is%20".$_charcode."%20.%20This%20will%20expire%20after%2060%20seconds.%20For%20help,%20call%200800-42526.%20HBL%20Asset%20Management%20Ltd.";
$this->dr_otp_send($recipient,$msg);
echo '<script>window.location.href = "../Customer/dr";</script>';
setcookie("code", $_charcode, time()+3600);
}
public function device_reg(){

if($_COOKIE['code'] != $_POST['code']){
echo '<script>alert("incorrect code! please try again.")</script>';
echo '<script>window.location.href = "../Customer/dr";</script>';
}
else{
 date_default_timezone_set("Asia/Karachi");
$ip_address = $_SERVER['REMOTE_ADDR'];
$pc_name = gethostname();
$br_name = $this->getBrowser();
$os_name = $this->getOS();
$Folio_No = $_SESSION['folio'];
$cookie_id = rand(pow(10, 3), pow(10, 4)-1);
$arr = [
'ip_address' => $ip_address,
'pc_name' => $pc_name,
'br_name' => $br_name,
'os_name' => $os_name,
'Folio_No' => $Folio_No,
'cookie_id' => $cookie_id,
'created_at' => date('Y-m-d h:i:s'),
];
$this->db->insert('device_reg', $arr);
$n = 10 * 365 * 24 * 60 * 60;
setcookie("cookie_id",$cookie_id, time()+($n));
setcookie("ip_address",$ip_address, time()+($n));
setcookie("pc_name",$pc_name, time()+($n));
setcookie("br_name",$br_name, time()+($n));
setcookie("os_name",$os_name, time()+($n));
setcookie("Folio_No",$Folio_No, time()+($n));
setcookie("location",$location, time()+($n));


$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['folino']);
$result = $this->db->get('investoraccountinfo')->result_array();		
$email = $result[0]['ACC_EMAILADDRESS'];

include 'email/class.phpmailer.php';
include 'email/PHPMailerAutoload.php';

$mail = new PHPMailer;


$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.6.209.160';                 // Specify main and backup server
$mail->SMTPAuth = false;
$mail->Port = 25;                                    // TCP port to connect to
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->From = 'info@hblasset.com';
$mail->FromName = '';
$mail->AddAddress($email,$result[0]['ACC_TITLE']);
$mail->Subject = 'Device Registration';


$body = '
<div  style="width:300px;padding: 40px;">
<table>
<tr>
<td>
<img src="http://salesapp.hblasset.com/images/hbl-logo.png" width="400" > 
<br>
<br>
</td>


</tr>
<tr>
<td colspan="2">
<br>
<br>
<h2 style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" >New device has been registered</h2>
<table style="width:400px;">
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Device Name</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">'.$pc_name.'</td>
</tr>
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Operating System</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">'.$os_name.'</td>
</tr>
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Browser </td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">'.$br_name.'</td>
</tr>
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">IP Address</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">
'.$ip_address.'


</td>
</tr>
</table>      

</td>
</tr>
</table>
<br>
<br>
<br>
<br>
<div style="padding:10px;font-family: Arial, Helvetica, sans-serif;font-size: 12px;">&copy; Copyright 2018 HBL Asset Management Limited. All rights reserved.
</div>
</div>
';
$mail->Body    = $body;
$mail->AltBody = strip_tags($body);

if(!$mail->Send()) {
echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
exit;
}
else  {
error_reporting(0);
echo '<script>alert("you have successfully registered your device.")</script>';
echo '<script>window.location.href = "../Customer/dashboard";</script>';
}





}



}



private function getOS() { 


$os_platform  = "Unknown OS Platform";

$os_array     = array(
'/windows nt 10/i'      =>  'Windows 10',
'/windows nt 6.3/i'     =>  'Windows 8.1',
'/windows nt 6.2/i'     =>  'Windows 8',
'/windows nt 6.1/i'     =>  'Windows 7',
'/windows nt 6.0/i'     =>  'Windows Vista',
'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
'/windows nt 5.1/i'     =>  'Windows XP',
'/windows xp/i'         =>  'Windows XP',
'/windows nt 5.0/i'     =>  'Windows 2000',
'/windows me/i'         =>  'Windows ME',
'/win98/i'              =>  'Windows 98',
'/win95/i'              =>  'Windows 95',
'/win16/i'              =>  'Windows 3.11',
'/macintosh|mac os x/i' =>  'Mac OS X',
'/mac_powerpc/i'        =>  'Mac OS 9',
'/linux/i'              =>  'Linux',
'/ubuntu/i'             =>  'Ubuntu',
'/iphone/i'             =>  'iPhone',
'/ipod/i'               =>  'iPod',
'/ipad/i'               =>  'iPad',
'/android/i'            =>  'Android',
'/blackberry/i'         =>  'BlackBerry',
'/webos/i'              =>  'Mobile'
);

foreach ($os_array as $regex => $value)
if (preg_match($regex, $_SERVER['HTTP_USER_AGENT']))
$os_platform = $value;

return $os_platform;
}



private function getBrowser() {


$browser        = "Unknown Browser";

$browser_array = array(
'/msie/i'      => 'Internet Explorer',
'/firefox/i'   => 'Firefox',
'/safari/i'    => 'Safari',
'/chrome/i'    => 'Chrome',
'/edge/i'      => 'Edge',
'/opera/i'     => 'Opera',
'/netscape/i'  => 'Netscape',
'/maxthon/i'   => 'Maxthon',
'/konqueror/i' => 'Konqueror',
'/mobile/i'    => 'Handheld Browser'
);

foreach ($browser_array as $regex => $value)
if (preg_match($regex, $_SERVER['HTTP_USER_AGENT']))
$browser = $value;

return $browser;
}



private function sendSMS($recipient,$messagedata){

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


public function dev_reg_log(){
$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['folino']);
$data = $this->db->get('device_reg')->result_array();		
//echo '<pre>';print_r($result[0]);
$this->load->view('dev_reg_log',$data);

}


public function get_all_data()
{
$this->db->where('Folio_No',$_POST['id']);
$this->db->where('checked',1);
$result = $this->db->get('user')->result();      
echo count($result);
}

public function save_sec_img()
{
$img = $_POST['imageSecurity'];
$c_img = $_POST['c_imageSecurity'];



if($img == $c_img){


$output = false;
$encrypt_method = "AES-256-CBC";
$secret_key = '9KXtqsphm+NrdmHFfoNFfnaB13pKnBakY+RZ6RsRiFE=';

// hash
$key = hash('sha256', $secret_key);

// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
$iv = substr(hash('sha256', strrev($secret_key)), 0, 16);

$output = openssl_encrypt($img, $encrypt_method, $key, 0,$iv);
$res = base64_encode($output);

$data =  [
'Folio_No' => $_POST['folio_id'],
'img' => $res,
'checked' => 1,
];

//echo '<pre>';print_r($data);
$this->db->where('Folio_No',$_POST['folio_id']);
$updated = $this->db->update('user', $data); 

if($updated){

$this->load->model('Customer_panel');
$this->Customer_panel->addlogutData();
$this->session->sess_destroy();

echo '<script>window.location.href = "../";</script>';



}
}



}

public function check_login()
{
$folio_id= $this->input->post('folio');
$user_pass= md5($this->input->post('pass'));
$img = $_POST['imageSecurity'];
$output = false;
$encrypt_method = "AES-256-CBC";
$secret_key = '9KXtqsphm+NrdmHFfoNFfnaB13pKnBakY+RZ6RsRiFE=';

// hash
$key = hash('sha256', $secret_key);

// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
$iv = substr(hash('sha256', strrev($secret_key)), 0, 16);

$output = openssl_encrypt($img, $encrypt_method, $key, 0,$iv);
$img = base64_encode($output);

$status= "A";

$this->db->select('*');
$this->db->where('Folio_No',$folio_id);
$this->db->where('Password',$user_pass);
$this->db->where('Status',$status);
$result = $this->db->get('user')->result_array();

//for unchecked users
//case:1
if($result[0]['checked'] == 0){

$this->db->select('*');
$this->db->where('Folio_No',$folio_id);
$res = $this->db->get('user')->result_array();	

if($res[0]['Password'] != $user_pass){

if($res[0]['WrongPassword'] == 3){

$this->load->model('Customer_panel');
$this->Customer_panel->blockaccount();
echo "<script>alert('UserID has been blocked. Please contact customer support for further details.');</script>";
echo'<script>window.location.href = "../Customer";</script>';	
}

else{

$this->db->where('Folio_No',$folio_id);
$this->db->update('user', ['WrongPassword' => $res[0]['WrongPassword']+1,]); 

$this->load->model('Customer_panel');
$this->Customer_panel->addWronglogin();
echo "<script>alert('Sorry! Combination does not match. After 3 wrong attempts UserID will be blocked by the system.');</script>";
echo'<script>window.location.href = "../Customer";</script>';	

}

}

if($res[0]['Password'] == $user_pass){

// Session
if($res[0]['WrongPassword'] == 3){
$this->load->model('Customer_panel');
$this->Customer_panel->blockaccount();
echo "<script>alert('UserID has been blocked. Please contact customer support for further details.');</script>";
echo'<script>window.location.href = "../Customer";</script>';	

}
else{

$this->load->library("session");

$this->session->set_userdata("folio","$folio_id");
$this->session->userdata("folio");


$this->session->set_userdata("folino","$folio_id");
$this->session->userdata("folino");

$this->db->where('Folio_No',$folio_id);
$this->db->update('user', ['WrongPassword' => 0]); 	

//  Activity Log
$this->load->model('Customer_panel');
$this->Customer_panel->addloginData();
echo'<script>window.location.href = "../Customer/dashboard";</script>';	


}

}


}

//for checked users
//case:1
if($result[0]['checked'] == 1){

$this->db->select('*');
$this->db->where('Folio_No',$folio_id);
$res = $this->db->get('user')->result_array();	

if($res[0]['Password'] != $user_pass || $res[0]['img'] != $img){

if($res[0]['WrongPassword'] >= 3){

$this->load->model('Customer_panel');
$this->Customer_panel->blockaccount();
echo "<script>alert('UserID has been blocked. Please contact customer support for further details.');</script>";
echo'<script>window.location.href = "../Customer";</script>';	
}

else{

$this->db->where('Folio_No',$folio_id);
$this->db->update('user', ['WrongPassword' => $res[0]['WrongPassword']+1,]); 

$this->load->model('Customer_panel');
$this->Customer_panel->addWronglogin();
echo "<script>alert('Sorry! Combination does not match. After 3 wrong attempts UserID will be blocked by the system.');</script>";
echo'<script>window.location.href = "../Customer";</script>';	

}

}

if($res[0]['Password'] == $user_pass && $res[0]['img'] == $img){

// Session
if($res[0]['WrongPassword'] == 3){
$this->load->model('Customer_panel');
$this->Customer_panel->blockaccount();
echo "<script>alert('UserID has been blocked. Please contact customer support for further details.');</script>";
echo'<script>window.location.href = "../Customer";</script>';	

}
else{

$this->load->library("session");

$this->session->set_userdata("folio","$folio_id");
$this->session->userdata("folio");


$this->session->set_userdata("folino","$folio_id");
$this->session->userdata("folino");

$this->db->where('Folio_No',$folio_id);
$this->db->update('user', ['WrongPassword' => 0]); 	

//  Activity Log
$this->load->model('Customer_panel');
$this->Customer_panel->addloginData();
echo'<script>window.location.href = "../Customer/dashboard";</script>';	


}

}


}

}
public function logout()
{
$this->load->model('Customer_panel');
$this->Customer_panel->addlogutData();

$this->session->sess_destroy();

echo '<script> window.location.href = "../";</script>';
}

public function profile()
{
$this->load->view('profile');
}
public function dashboard()
{

$this->load->view('dashboard');
}	
public function transaction()
{
$this->load->view('transaction');
}
public function report()
{
$this->load->view('report');
}	
public function report_proced()
{
$this->load->view('report_proced');
}
public function pdf()
{
$data = [];
//load the view and saved it into $html variable
$html=$this->load->view('pdf', $data, true);

//this the the PDF filename that user will get to download
$pdfFilePath = "summary_report.pdf";

//load mPDF library
$this->load->library('m_pdf');

//generate the PDF from the given html
$this->m_pdf->pdf->WriteHTML($html);

//D- download it.
$this->m_pdf->pdf->Output($pdfFilePath, "I");			


}

public function printreport()
{
$this->load->view('summary');
}

public function etransfer()
{

//***************************************************/
//**************25 May 2018**************************/
//***** Three transactions allowed per day **********/
$sql = "SELECT COUNT(*)
FROM `transactionrequest`
WHERE `FolioNo` = '" . $_SESSION['folino'] . "' and `RequestDate` = '" . date('Y/m/d') . "'"; 
$result_check = $this->db->query($sql)->row_array();
$count = $result_check['COUNT(*)'];
if($count>2) {
echo "<script>alert('Sorry, you have already availed your daily transaction limit. Please contact our customer support for further assistance.');</script>";
echo'<script>window.location.href = "../Customer/transaction";</script>';
exit;
}
//***************************************************/
//***************************************************/


// Redemption


if ($this->input->post('r1') == "R") {
$newam=   $this->input->post('redFROM');
$ex_get_amount= explode("|" ,$newam );

if (empty($this->input->post('redFROM'))) {

echo "<script>alert('Please select the Fund.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';
}


//***************************************************/
//**************21 May 2018**************************/
//***** Duplicate Transaction Request Redemption*****/

$this->db->select('id');
$this->db->where('FolioNo',$_SESSION['folino']);
$this->db->where('RequestDate',date('Y/m/d'));
$this->db->where('RequestType',$this->input->post('r1'));
$this->db->where('Dest_Fund_Code',$ex_get_amount[0]);
if ($this->input->post('selectopt') == "All") {
$this->db->where('RequestAmount',0);
}
else
{
$this->db->where('RequestAmount',$this->input->post('amount'));
}
$result_check = $this->db->get('transactionrequest')->result_array();	
$id= $result_check[0]['id'];
$this->load->library("session");
if($id>0) {
//found duplicate	
if ($this->input->post('selectopt') == "All") {
echo "<script>alert('You have already submitted a similar transaction request earlier. Please contact our customer support for further assistance.');</script>";
echo'<script>window.location.href = "../Customer/transaction";</script>';
exit;   

}

//Put the note in session to show in disclaimer

$note = "Your request has already been submitted.";
$this->session->set_userdata("SHOWNOTE","$note");
$this->session->userdata("SHOWNOTE");
}
else
{
$note = "";
$this->session->set_userdata("SHOWNOTE",$note);
$this->session->userdata("SHOWNOTE");
}
//***************************************************/
//***************************************************/


if ($this->input->post('selectopt') == "Amount") {
if (empty($this->input->post('amount'))) {

echo "<script>alert('Please enter amount then submit form.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';
}

if (!is_numeric ($this->input->post('amount')))	{
echo "<script>alert('For amount field only numbers are allowed.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';			
}
$get_amout= $ex_get_amount[1];
$insert_amount= $this->input->post('amount');

if($get_amout < $insert_amount){
echo "<script>alert('Sorry, Balance insufficiant for this transaction.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';			
exit;
}
//echo $_SESSION['folio'];exit();
else{ 

$this->load->library("session");


$abcdefgh= "R";
$this->session->set_userdata("typetrans","$abcdefgh");
$this->session->userdata("typetrans");

$abcde= $ex_get_amount[0];

$this->session->set_userdata("RedFROM","$abcde");
$this->session->userdata("RedFROM");

$this->session->set_userdata("RedAllAmount","RedFixAmount");
$this->session->userdata("RedAllAmount");


$totAmm_red= $ex_get_amount[0];

$abcdef=  $this->input->post('amount');

$this->session->set_userdata("RedAmount","$abcdef");
$this->session->userdata("RedAmount");    


echo'
<script>
window.location.href = "../Customer/confirm";
</script>
';


}

}


if ($this->input->post('selectopt') == "All") {//echo "dasd";

//exit;
//	echo $_SESSION['folio'];exit();


$get_amout= $ex_get_amount[1];

if($get_amout < 1){
echo "<script>alert('Sorry, Balance insufficiant for this transaction.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';			
exit;
}




//$this->load->model('Customer_panel');
//$this->Customer_panel->requestTransfer();

//$this->load->model('Customer_panel');
//$this->Customer_panel->transaction_record_activitylog();
// echo "<script>alert('E-Transaction request successfull submitted');</script>";

$this->load->library("session");

$fn = $_SESSION['folino'];
$fc = $ex_get_amount[0];



$this->db->select('*');

$this->db->where('Foli_No',$fn); //Folio
$this->db->where('Fund_Code',$fc); //FundCode
$resultfsum = $this->db->get('dailyportfoliosummary')->result_array();
$all_units= $resultfsum[0]['Units1'];

$abcdefgh= "R";
$this->session->set_userdata("typetrans","$abcdefgh");
$this->session->userdata("typetrans");

$this->session->set_userdata("RedAllAmount","RedAllAmount");
$this->session->userdata("RedAllAmount");



$abcde= $ex_get_amount[0];

$this->session->set_userdata("RedFROM","$abcde");
$this->session->userdata("RedFROM");


//$abcdef=  $ex_get_amount[1];
$abcdef=  $all_units ; //$ex_get_amount[1];

$this->session->set_userdata("RedAmount","$abcdef");
$this->session->userdata("RedAmount");    



echo'
<script>
window.location.href = "../Customer/confirm";
</script>
';




}			







}
// END Redemption Method

// Conversion Method
if ($this->input->post('r1') == "T") {


$newam=   $this->input->post('conTo');
$ex_get_amount= explode("|" ,$newam );

if (empty($this->input->post('conTo')) || empty($this->input->post('conFrom'))) {

echo "<script>alert('Please select funds then submit form.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';}

else if ($this->input->post('conTo') == $this->input->post('conFrom')) {
echo "<script>alert('From and To fund selection can not be same. Please select different funds');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';
}

//***************************************************/
//**************21 May 2018**************************/
//***** Duplicate Transaction Request Conversion*****/

$this->db->select('id');
$this->db->where('FolioNo',$_SESSION['folino']);
$this->db->where('RequestDate',date('Y/m/d'));
$this->db->where('RequestType',$this->input->post('r1'));
$this->db->where('Source_Fund_Code',$ex_get_amount[0]);
$this->db->where('Dest_Fund_Code',$this->input->post('conFrom'));

if ($this->input->post('selectopt') == "All") {
$this->db->where('RequestAmount',0);
}
else
{
$this->db->where('RequestAmount',$this->input->post('amount'));
}
$result_check = $this->db->get('transactionrequest')->result_array();	
$id= $result_check[0]['id'];
$this->load->library("session");
if($id>0) {
//found duplicate	
if ($this->input->post('selectopt') == "All") {
echo "<script>alert('You have already submitted a similar transaction request earlier. Please contact our customer support for further assistance.');</script>";
echo'<script>window.location.href = "../Customer/transaction";</script>';
exit;   

}

//Put the note in session to show in disclaimer

$note = "Your request has already been submitted.";
$this->session->set_userdata("SHOWNOTE","$note");
$this->session->userdata("SHOWNOTE");

}
else
{
$note = "";
$this->session->set_userdata("SHOWNOTE",$note);
$this->session->userdata("SHOWNOTE");
}




//***************************************************/
//***************************************************/


if ($this->input->post('selectopt') == "Amount") {
if (empty($this->input->post('amount'))) {

echo "<script>alert('Please enter amount then submit form.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';
}
if (!is_numeric ($this->input->post('amount')))	{
echo "<script>alert('For amount field only numbers are allowed.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';			
}


$get_amout= $ex_get_amount[1];
$insert_amount= $this->input->post('amount');

if($get_amout < $insert_amount){
echo "<script>alert('Sorry, balance insufficiant for this transaction.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';			
//exit;
}
//echo $_SESSION['folio'];exit();
else{ //exit;



$this->load->library("session");


$abcdefgh= "T";
$this->session->set_userdata("typetrans","$abcdefgh");
$this->session->userdata("typetrans");

//$this->session->set_userdata("RedAllAmount","RedAllAmount");
//$this->session->userdata("RedAllAmount");

$this->session->set_userdata("ConAllAmount","ConFixAmount");
$this->session->userdata("ConAllAmount");

$abcde= $ex_get_amount[0];
$this->session->set_userdata("ConTo","$abcde");
$this->session->userdata("ConTo");


$conFrom= $this->input->post('conFrom');
$this->session->set_userdata("ConFROm","$conFrom");
$this->session->userdata("ConFROm");


$conAmount= $this->input->post('amount');
$this->session->set_userdata("ConAmounts","$conAmount");
$this->session->userdata("ConAmounts");


//$this->load->model('Customer_panel');
//$this->Customer_panel->requestTransfer();

//$this->load->model('Customer_panel');
//$this->Customer_panel->transaction_record_activitylog();





echo'
<script>
window.location.href = "../Customer/confirm";
</script>
';


}

}

if ($this->input->post('selectopt') == "All") {


$get_amout= $ex_get_amount[1];

if($get_amout < 1){
echo "<script>alert('Sorry, balance insufficiant for this transaction.');</script>";

echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';			
exit;
}


$this->load->library("session");

$fn = $_SESSION['folino'];
$fc = $ex_get_amount[0];

$this->db->select('*');

$this->db->where('Foli_No',$fn); //Folio
$this->db->where('Fund_Code',$fc); //FundCode
$resultfsum = $this->db->get('dailyportfoliosummary')->result_array();
$all_units= $resultfsum[0]['Units1'];
$abcdefgh= "T";
$this->session->set_userdata("typetrans","$abcdefgh");
$this->session->userdata("typetrans");

$this->session->set_userdata("ConAllAmount","ConAllAmount");
$this->session->userdata("ConAllAmount");



$abcde= $ex_get_amount[0];
$this->session->set_userdata("ConTo","$abcde");
$this->session->userdata("ConTo");


$conFrom= $this->input->post('conFrom');
$this->session->set_userdata("ConFROm","$conFrom");
$this->session->userdata("ConFROm");


//$conAmount= $ex_get_amount[1];

$conAmount=  $all_units ; 

$this->session->set_userdata("ConAmounts","$conAmount");
$this->session->userdata("ConAmounts");



//$this->load->model('Customer_panel');
//$this->Customer_panel->requestTransfer();

//$this->load->model('Customer_panel');
//$this->Customer_panel->transaction_record_activitylog();

echo'
<script>
window.location.href = "../Customer/confirm";
</script>
';




}			





}
// END Conversion

// Investment Method
if ($this->input->post('r1') == "I") {

if (empty($this->input->post('funName')) OR 
empty($this->input->post('selpayment')) OR 
empty($this->input->post('tamount')) OR 
empty($this->input->post('bname')) OR 
empty($this->input->post('ban')) OR 
empty($this->input->post('cinum'))) {

echo "<script>alert('Please fill complete fields of investment then submit form');</script>";
echo'
<script>
window.location.href = "../Customer/transaction";
</script>
';
}

else if (!empty($this->input->post('funName')) OR 
!empty($this->input->post('selpayment')) OR 
!empty($this->input->post('tamount')) OR 
!empty($this->input->post('bname')) OR 
!empty($this->input->post('ban')) OR 
!empty($this->input->post('cinum'))) {

$this->load->model('Customer_panel');
$this->Customer_panel->requestTransfer();

$this->load->model('Customer_panel');
$this->Customer_panel->transaction_record_activitylog();

echo'
<script>
window.location.href = "../Customer/confirm";
</script>
';




exit();
}



}		



}	
public function confirm()
{
$this->load->view('test');
}
public function crequest()
{
$this->db->select('*');
$this->db->where('FolioNo',$foliodata);
$this->db->limit(1);
$this->db->order_by('id',"DESC");
$resultabc = $this->db->get('transactionrequest')->result_array();   

$abc= $resultabc[0]['id'];
//echo $abc;exit;
$this->db->where('id', $abc);
$this->db->delete('transactionrequest'); 
echo'<script>window.location.href = "../Customer/transaction";</script>';

}

public function completesss(){
$this->load->view('complete');
}
public function transaction_pdf(){
$this->load->view('transaction_pdf');
}
public function bankinfo_pdf(){
$this->load->view('bankinfo_pdf');
}		
public function contactinfo_pdf(){
$this->load->view('contactinfo_pdf');
}



public function complete()

{
//echo $_SESSION['folio'];exit;

// echo $_SESSION['typeamnt'];exit;
//echo $_SESSION['typetrans'];exit;
// $_SESSION['folio'];
//echo $_SESSION['RedFROM']."<br>";//exit;
//echo $_SESSION['RedAmount'];
//echo $_SESSION['RedAllAmount'];
//exit;



if($_SESSION['typetrans'] == "T"){		

if($_SESSION['ConAllAmount'] == "ConAllAmount"){
//echo "das";exit;
$this->load->model('Customer_panel');
$this->Customer_panel->TransferConversionAll();

$this->load->model('Customer_panel');
$this->Customer_panel->allconversion_activitylog();

}
else{
$this->load->model('Customer_panel');
$this->Customer_panel->TransferConversion();

$this->load->model('Customer_panel');
$this->Customer_panel->conversion_activitylog();
}
}




if($_SESSION['typetrans'] == "R"){		

if($_SESSION['RedAllAmount'] == "RedAllAmount"){
//echo "das";exit;
$this->load->model('Customer_panel');
$this->Customer_panel->TransferAllRedemption();

$this->load->model('Customer_panel');
$this->Customer_panel->allredemption_activitylog();

}
else{
$this->load->model('Customer_panel');
$this->Customer_panel->TransferRedemption();

$this->load->model('Customer_panel');
$this->Customer_panel->redemption_activitylog();
}
}



$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['folino']);
$result = $this->db->get('investoraccountinfo')->result_array();		
$email= $result[0]['ACC_EMAILADDRESS'];
$smstrans= $result[0]['ACC_SMSCELLNUMBER'];
//exit();

$this->db->select('*');
$this->db->where('FolioNo',$_SESSION['folio']);
$this->db->limit(1);
$this->db->order_by('id',"DESC");
$resultemaildata = $this->db->get('transactionrequest')->result_array();


$this->db->select('*');
$this->db->limit(1);
$resultadmin = $this->db->get('Parameters')->result_array();
$admin_email= $resultadmin[0]['AdminEmail'];


//echo $resultemaildata[0]['RequestType'];
//exit;

$data = [];
//load the view and saved it into $html variable
//$html=$this->load->view('transaction_pdf', $data, true);

//this the the PDF filename that user will get to download
//$pdfFilePath = 'pdf/'.$foliodata."_transaction_summary.pdf";

//load mPDF library
//$this->load->library('m_pdf');

//generate the PDF from the given html
//$this->m_pdf->pdf->WriteHTML($html);

//download it.
//$this->m_pdf->pdf->Output($pdfFilePath, "F");	


@set_magic_quotes_runtime(false);
ini_set('magic_quotes_runtime', 0);
error_reporting(0);
include 'email/class.phpmailer.php';
include 'email/PHPMailerAutoload.php';

$mail = new PHPMailer;


$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.6.209.160';                 // Specify main and backup server
$mail->SMTPAuth = false;
$mail->Port = 25;                                    // TCP port to connect to
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->From = 'info@hblasset.com';
$mail->FromName = '';

$mail->AddAddress($email,$result[0]['ACC_TITLE']);  // Add a recipient \\ 
$mail->AddBCC($admin_email, $result[0]['ACC_TITLE']);

//$mail->AddAttachment(realpath('pdf/'.$folino.'_transaction_summary.pdf'),'transaction.pdf','base64', 'application/pdf');

$mail->IsHTML(true);                                  // Set email format to HTML
//$mail->Subject = 'New Fund transfer Request from Folio No.'.$_SESSION['folino'];

if ($resultemaildata[0]['RequestType']== "R") {
$mail->Subject = 'Request for Redemption';

$caption = "";
$captionvalue = "";

if ($resultemaildata[0]['RequestAmount']== 0) 
{
$caption = "All Units";
$captionvalue = $resultemaildata[0]['RequestUnit'];

}
else
{
$caption = "Amount (Rs.)";
$captionvalue = number_format($resultemaildata[0]['RequestAmount'],2);

}


$mail->Body    = '<br>
<h4>Dear Investor,</h4>
<p>Your request for redemption from '.$resultemaildata[0]['Dest_Fund_Code'].' has been successfully submitted via Online Portal Service.</p>
<p>It may take up to 72 hours, or time stated as per Offering Document of the Fund, for processing of this transaction.</p><br>

<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#069198" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#069198 !important;">
<tr> 
<td colspan="2" height="25" bgcolor="069198"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Transaction Details</strong></font></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Folio Number</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['FolioNo'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Name of Investor</font></p></td>
<td width="300"><p><font size="-1">'.$result[0]['ACC_TITLE'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Request Type</font></p></td>
<td width="300"><p><font size="-1">Redemption</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">From</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['Dest_Fund_Code'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">'.$caption.'</font></p></td>
<td width="300"><p><font size="-1">'.$captionvalue.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Bank Name</font></p></td>
<td width="300"><p><font size="-1">'.$result[0]['Bank_Name'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Bank Branch Name & City</font></p></td>
<td width="300"><p><font size="-1">'.$result[0]['Branch_Address'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Bank A/C No.</font></p></td>
<td width="300"><p><font size="-1">'.$result[0]['ABA_ACCOUNTCODE'].'</font></p></td>
</tr>			
<tr>
<td width="300"><p><font size="-1">Date</font></p></td>
<td width="300"><p><font size="-1">'.date("d/m/Y", strtotime($resultemaildata[0]['RequestDate'])).'</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Time (24 Hour Format)</font></p></td>
<td width="300"><p><font size="-1">'.date("H:i:s", strtotime($resultemaildata[0]['RequestTime'])).'</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Reference ID</font></p></td>
<td width="300"><p><font size="-1">'.strtoupper($resultemaildata[0]['ReferenceID']).'</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Remarks</font></p></td>
<td width="300"><p><font size="-1">Successful</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Status</font></p></td>
<td width="300"><p><font size="-1">In process</font></p></td>
</tr>									
</table>


<p>If you have not processed this transaction, please immediately contact our Investor Services Department.</p>
<p>Our customers are our most valuable asset. It will be a pleasure for us to help you with any query or information that you may have. Please feel free to contact us on Toll Free No. 0800 42526 (during business hours) or email us on info@hblasset.com in case of any queries related to your account.</p>

<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>
';
$dest_sms= $resultemaildata[0]['Dest_Fund_Code'];
$dest_amount= $resultemaildata[0]['RequestAmount'];
$dest_ref= $resultemaildata[0]['ReferenceID'];
$recipient = $smstrans;
//redemption sms
//riz22/3
//$messagedata = "Your%20request%20for%20redemption%20from%20$dest_sms%20of%20amount%20$dest_amount%20submitted%20successfully.%20 Reference ID%20is%20$dest_ref.%20For%20details,%20please%20call%200800-42526.";
$messagedata = "Your%20request%20for%20redemption%20from%20$dest_sms%20submitted%20successfully.%20 Reference ID%20is%20$dest_ref.%20For%20details,%20please%20call%200800-42526.";

$this->sendSMS($recipient, $messagedata);

}


if ($resultemaildata[0]['RequestType']== "T") {
$mail->Subject = 'Request for Conversion';
$caption = "";
$captionvalue = "";

if ($resultemaildata[0]['RequestAmount']== 0) 
{
$caption = "All Units";
$captionvalue = $resultemaildata[0]['RequestUnit'];

}
else
{
$caption = "Amount (Rs.)";
$captionvalue = number_format($resultemaildata[0]['RequestAmount'],2);

}
$mail->Body    = '<br>
<h4>Dear Investor,</h4>
<p>Your request for conversion from '.$resultemaildata[0]['Source_Fund_Code'].' to '.$resultemaildata[0]['Dest_Fund_Code'].' has been successfully submitted via Online Portal Service.</p>
<p>It may take up to 72 hours, or time stated as per Offering Document of the Fund, for processing of this transaction.</p><br>

<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#069198" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#069198 !important;">
<tr> 
<td colspan="2" height="25" bgcolor="069198"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Transaction Details</strong></font></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Folio Number</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['FolioNo'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Name of Investor</font></p></td>
<td width="300"><p><font size="-1">'.$result[0]['ACC_TITLE'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Request Type</font></p></td>
<td width="300"><p><font size="-1">Conversion</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">From</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['Source_Fund_Code'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">To</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['Dest_Fund_Code'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">'.$caption.'</font></p></td>
<td width="300"><p><font size="-1">'.$captionvalue.'</font></p></td>
</tr>

<tr>
<td width="300"><p><font size="-1">Date</font></p></td>
<td width="300"><p><font size="-1">'.date("d/m/Y", strtotime($resultemaildata[0]['RequestDate'])).'</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Time (24 Hour Format)</font></p></td>
<td width="300"><p><font size="-1">'.date("H:i:s", strtotime($resultemaildata[0]['RequestTime'])).'</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">ReferenceID</font></p></td>
<td width="300"><p><font size="-1">'.strtoupper($resultemaildata[0]['ReferenceID']).'</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Remarks</font></p></td>
<td width="300"><p><font size="-1">Successful</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Status</font></p></td>
<td width="300"><p><font size="-1">In process</font></p></td>
</tr>									
</table>

<p>If you have not processed this transaction, please immediately contact our Investor Services Department.</p>
<p>Our customers are our most valuable asset. It will be a pleasure for us to help you with any query or information that you may have. Please feel free to contact us on Toll Free No. 0800 42526 (during business hours) or email us on info@hblasset.com in case of any queries related to your account.</p>

<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>
';
$dest_sms= $resultemaildata[0]['Dest_Fund_Code'];
$src_sms= $resultemaildata[0]['Source_Fund_Code'];
$dest_amount= $resultemaildata[0]['RequestAmount'];
$dest_ref= $resultemaildata[0]['ReferenceID'];
$recipient = $smstrans;
//$messagedata = "Your%20request%20for%20conversion%20from%20$src_sms%20of%20amount%20$dest_amount%20submitted%20successfully.%20 Reference ID%20is%20$dest_ref.%20For%20details,%20please%20call%200800-42526.";
$messagedata = "Your%20request%20for%20conversion%20from%20$src_sms%20submitted%20successfully.%20 Reference ID%20is%20$dest_ref.%20For%20details,%20please%20call%200800-42526.";

$this->sendSMS($recipient, $messagedata);
}


// Email Body Invester 

if ($resultemaildata[0]['RequestType']== "I") {
$mail->Subject = 'Request for Investment';

$mail->Body    = '<br>
<h4>Dear Investor,</h4>
<p>Your request for investment in '.$resultemaildata[0]['Dest_Fund_Code'].' has been successfully submitted via Online Portal Service.</p>
<p>It may take up to 72 hours, or time stated as per Offering Document of the Fund, for processing of this transaction.</p><br>

<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#069198" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#069198 !important;">
<tr> 
<td colspan="2" height="25" bgcolor="069198"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Transaction Details</strong></font></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Folio Number</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['FolioNo'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Request Type</font></p></td>
<td width="300"><p><font size="-1">Investment</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Fund Name</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['Dest_Fund_Code'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Payment Mode</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['paymentmode'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Amount (Rs.)</font></p></td>
<td width="300"><p><font size="-1">'.number_format($resultemaildata[0]['RequestAmount'],2).'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Bank Name</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['bankname'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Bank Account Number</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['accountnumber'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Cheque/ Intrument Number</font></p></td>
<td width="300"><p><font size="-1">'.$resultemaildata[0]['cheque_intrument_no'].'</font></p></td>
</tr>									


<tr>
<td width="300"><p><font size="-1">Date</font></p></td>
<td width="300"><p><font size="-1">'.date("d/m/Y", strtotime($resultemaildata[0]['RequestDate'])).'</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Time (24 Hour Format)</font></p></td>
<td width="300"><p><font size="-1">'.date("H:i:s", strtotime($resultemaildata[0]['RequestTime'])).'</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">ReferenceID</font></p></td>
<td width="300"><p><font size="-1">'.strtoupper($resultemaildata[0]['ReferenceID']).'</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Remarks</font></p></td>
<td width="300"><p><font size="-1">Successful</font></p></td>
</tr>									
<tr>
<td width="300"><p><font size="-1">Status</font></p></td>
<td width="300"><p><font size="-1">In process</font></p></td>
</tr>									
</table>

<p>If you have not processed this transaction, please immediately contact our Investor Services Department.</p>
<p>Our customers are our most valuable asset. It will be a pleasure for us to help you with any query or information that you may have. Please feel free to contact us on Toll Free No. 0800 42526 (during business hours) or email us on info@hblasset.com in case of any queries related to your account.</p>

<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>

';
$dest_sms= $resultemaildata[0]['Dest_Fund_Code'];
$dest_amount= $resultemaildata[0]['RequestAmount'];
$dest_ref= $resultemaildata[0]['ReferenceID'];
$recipient = $smstrans;

$messagedata = "Your%20request%20for%investment%20in%20$dest_sms%20of%20amount%20$dest_amount%20submitted%20successfully.%20 Reference ID%20is%20$dest_ref.%20For%20details,%20please%20call%200800-42526.";
$this->sendSMS($recipient, $messagedata);
}




$mail->AltBody = '';

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
exit;
}
else  {
error_reporting(0);

$this->load->view('complete');
}


}

public function activitylog()
{

if (!empty($this->input->post('search_res'))) {
$limitsearch= $this->input->post('search_res');

$this->db->select('*');
$this->db->limit($limitsearch);
$result = $this->db->get('activitylog')->result_array();		
$status_search= $result[0]['id'];
//exit();
}

$diff_date= date('Y-m-d', strtotime('-90 days'));

$config['base_url'] = site_url('Customer/activitylog');
//Changes done on 25/5/2018 - Rizwan
//$config['total_rows'] =  $this->db->where("STR_TO_DATE(ActivityDate, '%d/%m/%Y') >",$diff_date)->from("activitylog")->count_all_results();
$fno = $_SESSION['folino'];
$this->db->where("Folio_No =",$fno);
$this->db->where("STR_TO_DATE(ActivityDate, '%d/%m/%Y') >",$diff_date);
$config['total_rows'] =  $this->db->from("activitylog")->count_all_results();

//$config['total_rows'] = $this->db->count_all('activitylog');

if (empty($this->input->post('search_res'))) {
$config['per_page'] = "25";
}	
if (!empty($this->input->post('search_res'))) {
$config['per_page'] = $limitsearch;
}	    	
$config["uri_segment"] = 3;
$choice = $config["total_rows"] / $config["per_page"];
$config["num_links"] = floor($choice);

//config for bootstrap pagination class integration
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';
$config['first_link'] = false;
$config['last_link'] = false;
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['prev_link'] = '&laquo';
$config['prev_tag_open'] = '<li class="prev">';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = '&raquo';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$this->pagination->initialize($config);
$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

//call the model function to get the department data
//Changes done on 25/5/2018 - Rizwan
//$data['deptlist'] = $this->department_model->get_department_list($config["per_page"], $data['page']);           
$data['deptlist'] = $this->department_model->get_department_list($config["per_page"], $data['page'],$fno);

$data['pagination'] = $this->pagination->create_links();

//load the department_view
$this->load->view('activitylog',$data);
}

public function page()
{
echo "string";
}

public function contactinformation()
{

$phone= $this->input->post('phone');
$cell= $this->input->post('cell');
$newemail= $this->input->post('email');
$address= $this->input->post('address');


//***************************************************/
//***************************************************/
$this->db->select('id');
$this->db->where('Folio_No',$_SESSION['folino']);
$this->db->where('RequestDate',date('Y/m/d'));
$this->db->where('phone',$phone);
$this->db->where('cell',$cell);
$this->db->where('email',$newemail);
$this->db->where('address',$address);

$result_check = $this->db->get('contactinformation')->result_array();	
$id= $result_check[0]['id'];
if($id>0) {
//echo 'The request has already been submitted.';
echo "<script>alert('Your request has already been submitted.');</script>";
echo'<script>window.location.href = "../Customer/profile";</script>';
exit;

}
//***************************************************/
//***************************************************/



$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['folino']);
$result = $this->db->get('investoraccountinfo')->result_array();		
$email= $result[0]['ACC_EMAILADDRESS'];
$smstrans= $result[0]['ACC_SMSCELLNUMBER'];


$this->db->select('*');
$this->db->limit(1);
$resultadmin = $this->db->get('Parameters')->result_array();
$admin_email= $resultadmin[0]['AdminEmail'];

$data = [];
//load the view and saved it into $html variable
//$html=$this->load->view('contactinfo_pdf', $data, true);

//this the the PDF filename that user will get to download
//$pdfFilePath = 'pdf/'.$foliodata."_contact_information.pdf";

//load mPDF library
//$this->load->library('m_pdf');

//generate the PDF from the given html
//$this->m_pdf->pdf->WriteHTML($html);

//download it.
//$this->m_pdf->pdf->Output($pdfFilePath, "F");	

include "email/class.phpmailer.php";
include "email/PHPMailerAutoload.php";

$mail = new PHPMailer;
///
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.6.209.160';                 // Specify main and backup server
$mail->SMTPAuth = false;
$mail->Port = 25;                                    // TCP port to connect to
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->From = 'info@hblasset.com';
$mail->FromName = '';
$mail->AddAddress($email,$result[0]['ACC_TITLE']);
$mail->AddBCC($admin_email,'');  // Add a recipient \\ 
//$mail->AddAddress("azhar.raza@orangeroomdigital.com","Azhar Raza");
//Rizwan
//$mail->AddAttachment(realpath('pdf/'.$_SESSION['foliono'].'_contact_information.pdf'),'contact_information.pdf','base64', 'application/pdf');


$mail->IsHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Request for change in Contact Information';

$mail->Body    = '<br>
<h4>Dear Customer,</h4>
<p>Your request for change in contact information has been submitted successfully. The folio number is '.$_SESSION['folino'].'.</p>Requested new contact information is as follows:<br><br>

<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#069198" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#069198 !important;">
<tr> 
<td colspan="2" height="25" bgcolor="069198"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Contact Information</strong></font></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Phone Number</font></p></td>
<td width="300"><p><font size="-1">'.$phone.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Cell Number</font></p></td>
<td width="300"><p><font size="-1">'.$cell.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Email Address</font></p></td>
<td width="300"><p><font size="-1">'.$newemail.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Address</font></p></td>
<td width="300"><p><font size="-1">'.$address.'</font></p></td>
</tr>									
</table>


<p>For details, please call 0800-42526</p>

<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>
';

$mail->AltBody = '';

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
//redirect('Customer/profile');

exit;
}
else {
$this->load->model('Customer_panel');
$this->Customer_panel->contactinformation();

$this->load->model('Customer_panel');
$this->Customer_panel->requestconinfolog();



echo "<script>alert('Your request for Contact Information update has been successfully submitted.');</script>";
echo'<script>window.location.href = "../Customer/profile";</script>';

}
}





public function bankinformation()
{

$accountnumber= $this->input->post('accountnumber');
$accounttitle= $this->input->post('accounttitle');
$bankname= $this->input->post('bankname');
$address= $this->input->post('address');

//***************************************************/
//***************************************************/
$this->db->select('id');
$this->db->where('Folio_No',$_SESSION['folino']);
$this->db->where('RequestDate',date('Y/m/d'));
$this->db->where('accountnumber',$accountnumber);
$this->db->where('bankname',$bankname);
$this->db->where('address',$address);
$result_check = $this->db->get('bankinformation')->result_array();	
$id= $result_check[0]['id'];
if($id>0) {
echo "<script>alert('Your request has already been submitted.');</script>";
echo'<script>window.location.href = "../Customer/profile";</script>';
exit;
}
//***************************************************/
//***************************************************/

$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['folino']);
$result = $this->db->get('investoraccountinfo')->result_array();		
$email= $result[0]['ACC_EMAILADDRESS'];
$smstrans= $result[0]['ACC_SMSCELLNUMBER'];


$this->db->select('*');
$this->db->limit(1);
$resultadmin = $this->db->get('Parameters')->result_array();
$admin_email= $resultadmin[0]['AdminEmail'];

$data = [];
//load the view and saved it into $html variable
//$html=$this->load->view('bankinfo_pdf', $data, true);

//this the the PDF filename that user will get to download
//$pdfFilePath = 'pdf/'.$foliodata."_bank_information.pdf";

//load mPDF library
//$this->load->library('m_pdf');

//generate the PDF from the given html
//$this->m_pdf->pdf->WriteHTML($html);

//download it.
//$this->m_pdf->pdf->Output($pdfFilePath, "F");	

include "email/PHPMailerAutoload.php";

$mail = new PHPMailer;
///
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.6.209.160';                 // Specify main and backup server
$mail->SMTPAuth = false;
$mail->Port = 25;                                    // TCP port to connect to
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->From = 'info@hblasset.com';
$mail->FromName = '';

$mail->AddAddress($email,$result[0]['ACC_TITLE']);
$mail->AddBCC($admin_email,'');  // Add a recipient \\ 

//$mail->AddAttachment(realpath('pdf/'.$_SESSION['foliono'].'_bank_information.pdf'),'bank_information.pdf','base64', 'application/pdf');

$mail->IsHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Request for change in Bank Information';

$mail->Body    = '<br>
<h4>Dear Customer,</h4>
<p>Your request for change in bank information has been submitted successfully. The folio number is '.$_SESSION['folino'].'.</p>Requested new bank information is as follows:<br><br>

<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#069198" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#069198 !important;">
<tr> 
<td colspan="2" height="25" bgcolor="069198"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Bank Information</strong></font></td>
</tr>


<tr>
<td width="300"><p><font size="-1">Account Number</font></p></td>
<td width="300"><p><font size="-1">'.$accountnumber.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Account Title</font></p></td>
<td width="300"><p><font size="-1">'.$accounttitle.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Bank Name</font></p></td>
<td width="300"><p><font size="-1">'.$bankname.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Bank Address</font></p></td>
<td width="300"><p><font size="-1">'.$address.'</font></p></td>
</tr>									
</table>


<p>For details, please call 0800-42526</p>

<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>
';

$mail->AltBody = '';

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
//redirect('Customer/profile');

exit;
}
else  {

$this->load->model('Customer_panel');
$this->Customer_panel->bankinformations();

$this->load->model('Customer_panel');
$this->Customer_panel->requestbankinfolog();
echo "<script>alert('Your Request for Bank Details update has been successfully submitted.');</script>";
echo'<script>window.location.href = "../Customer/profile";</script>';

}
}


public function contactadvisor()
{

$fno= $this->input->post('foliono');
$cell= $this->input->post('cell');
$em= $this->input->post('email');
$msg= $this->input->post('msg');
$phone = '';

//***************************************************/
//**************13 June 2018**************************/
//***** Three transactions allowed per day **********/
$sql = "SELECT COUNT(*)
FROM `contactrequest`
WHERE `Folio_No` = '" . $_SESSION['folino'] . "' and `RequestDate` = '" . date('Y/m/d') . "'"; 
$result_check = $this->db->query($sql)->row_array();
$count = $result_check['COUNT(*)'];
if($count>2) {
echo "<script>alert('Sorry, you have already availed your daily request limit. Please contact our customer support for further assistance.');</script>";
echo'<script>window.location.href = "../Customer/dashboard";</script>';
exit;
}
//***************************************************/
//***************************************************/

//***************************************************/
//***************************************************/
//**************13 June 2018**************************/
//***** Duplicate Request Reject **********/

$this->db->select('id');
$this->db->where('Folio_No',$_SESSION['folino']);
$this->db->where('RequestDate',date('Y/m/d'));
$this->db->where('phone',$phone);
$this->db->where('cell',$cell);
$this->db->where('email',$em);
$this->db->where('message',$msg);

$result_check = $this->db->get('contactrequest')->result_array();	
$id= $result_check[0]['id'];
if($id>0) {
//echo 'The request has already been submitted.';
echo "<script>alert('You have already sent a similar request earlier.');</script>";
echo'<script>window.location.href = "../Customer/dashboard";</script>';
exit;
}
//***************************************************/
//***************************************************/

//    $this->db->select('*');
//	$this->db->where('Folio_No',$_SESSION['folino']);
//	$result = $this->db->get('investoraccountinfo')->result_array();		
$email= $em;//$result[0]['ACC_EMAILADDRESS'];
//	$smstrans= $result[0]['ACC_SMSCELLNUMBER'];


$this->db->select('*');
$this->db->limit(1);
$resultadmin = $this->db->get('Parameters')->result_array();
$admin_email= $resultadmin[0]['AdminEmail'];

include "email/PHPMailerAutoload.php";

$mail = new PHPMailer;


$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.6.209.160';                 // Specify main and backup server
$mail->SMTPAuth = false;
$mail->Port = 25;                                    // TCP port to connect to
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->From = 'info@hblasset.com';
$mail->FromName = '';
$mail->AddAddress($admin_email,'');
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Request for Contact Investment Advisor';

$mail->Body    = '<br>
<h4>Dear Investment Advisor,</h4>
<p>Please contact me on my contact details given below:</p><br>

<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#069198" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#069198 !important;">
<tr> 
<td colspan="2" height="25" bgcolor="069198"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Bank Information</strong></font></td>
</tr>


<tr>
<td width="300"><p><font size="-1">Folio Number</font></p></td>
<td width="300"><p><font size="-1">'.$_SESSION['folino'].'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Mobile No</font></p></td>
<td width="300"><p><font size="-1">'.$cell.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Email</font></p></td>
<td width="300"><p><font size="-1">'.$em.'</font></p></td>
</tr>
<tr>
<td width="300"><p><font size="-1">Message</font></p></td>
<td width="300"><p><font size="-1">'.$msg.'</font></p></td>
</tr>									
</table>

<p>Regards,</p>

<b><p>HBL Asset Management Ltd.</p></b>
';

$mail->AltBody = '';

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
//redirect('Customer/profile');

exit;
}
else  {

$this->load->model('Customer_panel');
$this->Customer_panel->contactrequest();

$this->load->model('Customer_panel');
$this->Customer_panel->requestconreqlog();

echo "<script>alert('Your Request for Contact Investment Advisor has been sent successfully.');</script>";
echo'<script>window.location.href = "../Customer/dashboard";</script>';

}
}



public function change_password()
{
$this->load->view('change_password');
}
public function passchanged()
{
$oldpass= md5($this->input->post('oldpass'));

$pass= $this->input->post('pass');
$cpass= $this->input->post('cpass');


if (empty($oldpass) OR empty($pass) OR empty($cpass)) {
echo "<script>
alert('Please fill complete form');
window.location.href='../Customer/change_password';
</script>";
}
if (!empty($oldpass) AND !empty($pass) AND !empty($cpass)) {

$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['folio']);
$resultoldpass = $this->db->get('user')->result_array();		
$user= $resultoldpass[0]['UserID'];
$oldpasswordget= $resultoldpass[0]['Password'];


if ($oldpass != $oldpasswordget) {
echo "<script>
alert('Current password entered is not correct. Please enter correct current password');
window.location.href='../Customer/change_password';
</script>";
}
else if ($oldpass == $oldpasswordget) {

if ($pass != $cpass) {
echo "<script>
alert('New password and Confirm password not matched.');
window.location.href='../Customer/change_password';
</script>";
}
if ($pass == $cpass) {
//echo $_SESSION['folio'];exit();
$this->load->model('Customer_panel');
$this->Customer_panel->changepassword();
$encryptpass= md5($pass);
$data = array(
'Password' => $encryptpass,
);

$this->db->where('UserID', $_SESSION['folio']);
$this->db->update('user', $data); 




echo "<script>
alert('Your password has been successfully changed.');
window.location.href='../Customer/dashboard';
</script>";

}

}


}

}



public function forgot_password(){
$this->load->view('forgat');
}
public function forgot_img(){
$this->load->view('forgot_img');
}

public function change_forgot_img(){
$img = $_POST['imageSecurity'];
$c_img = $_POST['c_imageSecurity'];


if($img == $c_img){

$id = $_POST['id'];
$pwd = $_POST['pwd'];

$this->db->select('*');
$this->db->where('Folio_No',$id);
$this->db->where('Password',md5($pwd));
$result = $this->db->get('user')->result_array();

if(count($result) > 0){
$output = false;
$encrypt_method = "AES-256-CBC";
$secret_key = '9KXtqsphm+NrdmHFfoNFfnaB13pKnBakY+RZ6RsRiFE=';

// hash
$key = hash('sha256', $secret_key);

// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
$iv = substr(hash('sha256', strrev($secret_key)), 0, 16);

$output = openssl_encrypt($img, $encrypt_method, $key, 0,$iv);
$res = base64_encode($output);


//echo '<pre>';print_r($res);die;
$this->db->where('Folio_No',$id);
$updated = $this->db->update('user', ['img' => $res]); 

if($updated){


echo '<script>window.location.href = "../";</script>';



}
}

}
}

public function changed_forgot_password(){

$otp_option = $_POST['r1'];
//echo $otp_option;
//exit;
$emailinput= strtolower($_POST['email']);

$mobileinput= $_POST['mobile'];



$mobileinputs= $_POST['mobile'];
//	exit;
//echo "<br>";

$output = str_split($mobileinputs, 2);
$output[0] = substr($mobileinputs, 0, 2);
$ex_minus= $output[1] = substr($mobileinputs, 2, 10);
$numberget= explode("-",$ex_minus);
$mobileinput= "923".$numberget[0]."".$numberget[1];

//echo $mobileinput; 
//exit;


$loginidinput= $_POST['loginid'];

//exit;
//	if (strlen($loginidinput) != 8) {
//		echo "<script>alert('UserID must be of length 8.');</script>";

//       echo'<script>window.location.href = "../Customer/forgot_password";</script>';	
//exit;
//}
$this->db->select('*');
$this->db->where('UserID',$loginidinput);
$get_id = $this->db->get('user')->result_array();		
$get_folio= $get_id[0]['Folio_No'];
$get_userid= $get_id[0]['UserID'];


$this->db->select('*');
$this->db->where('Folio_No',$get_folio);
$accountinfo = $this->db->get('investoraccountinfo')->result_array();		
$ACC_EMAILADDRESS= strtolower($accountinfo[0]['ACC_EMAILADDRESS']);
$ACC_SMSCELLNUMBER= $accountinfo[0]['ACC_SMSCELLNUMBER'];
//exit();


if ($ACC_EMAILADDRESS != $emailinput OR 
$ACC_SMSCELLNUMBER != $mobileinput OR 
$loginidinput != $get_userid ) 
{
echo "<script>alert('Sorry, we didn’t recognize you. Please contact our representative for further details.');</script>";

echo'<script>window.location.href = "../Customer/forgot_password";</script>';	
exit;
}

if (empty($loginidinput) OR empty($emailinput) OR empty($mobileinput)) {
echo "<script>alert('Please fill the mandatory fields and then submit the form.');</script>";

echo'<script>window.location.href = "../Register/confirm_forgotpass";</script>';	
exit;
}
else {
error_reporting(0);
//echo "das";

$_chars = "ZXCVBNMASDFGHJKLQWERTYUIOP0123456789";

$_charcode = ''; // initialize the variable with an empty string
for($l = 0; $l<6; $l++){
$temp = str_shuffle($_chars);
$_charcode .= $temp[0];
}    
//echo $_charcode;



if ($otp_option== "M"){


////////set input values here //////////////// $ACC_SMSCELLNUMBER
//forgot password sms
$recipient = $ACC_SMSCELLNUMBER;
$messagedata = "Dear%20customer,%20your%20OTP%20to%20change%20password%20is%20".$_charcode."%20.%20This%20will%20expire%20after%2060%20minutes.%20For%20help,%20call%200800-42526.%20HBL%20Asset%20Management%20Ltd.";
$this->sendSMS($recipient, $messagedata);

date_default_timezone_set("Asia/Karachi");

$current_time= date("h:i:sa");


$this->load->library("session");

$this->session->set_userdata("otp_created_time","$current_time");
$this->session->userdata("otp_created_time");


$this->session->set_userdata("loginid","$loginidinput");
$this->session->userdata("loginid");

$this->session->set_userdata("otp","$_charcode");
$this->session->userdata("otp");

$this->session->set_userdata("folioss","$get_folio");
$this->session->userdata("folioss");

$this->session->set_userdata("mobileinput","$mobileinput");
$this->session->userdata("mobileinput");

$this->session->set_userdata("emailinput","$emailinput");
$this->session->userdata("emailinput");

$this->session->set_userdata("otptype","M");
$this->session->userdata("otptype");


echo'<script>window.location.href = "../Customer/confirm_forgotpass";</script>';
}



if ($otp_option== "E"){

$this->db->select('*');
$this->db->limit(1);
$resultadmin = $this->db->get('Parameters')->result_array();


include "email/class.phpmailer.php";
include "email/PHPMailerAutoload.php";

$mail = new PHPMailer;
///
$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.6.209.160';                 // Specify main and backup server
$mail->Port = 25;                                    // Set the SMTP port
$mail->SMTPAuth = false;                            // Enable encryption, 'ssl' also accepted
/////
$mail->From = 'info@hblasset.com';

$mail->FromName = '';
$mail->AddAddress($ACC_EMAILADDRESS,$accountinfo[0]['ACC_TITLE']);  // Add a recipient \\ 

$mail->IsHTML(true);                                  // Set email format to HTML
$mail->Subject = 'HBL Asset Management Ltd. - Forget Password OTP (One Time Passcode)';

$mail->Body    = '<br>
<h4>Dear Customer,</h4>
<p>Your OTP to change your password is '.$_charcode.'.</p> 

<p>This OTP will expire after 60 minutes.</p><br>

<p>Our customers are our most valuable asset. It will be a pleasure for us to help you with any query or information that you may have. Please feel free to contact us on Toll Free No. 0800 42526 (during business hours) or email us on info@hblasset.com in case of any queries related to your account.</p>

<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>
';

$mail->AltBody = '';

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
//redirect('Customer/profile');

exit;
}
else {

//print $output;
date_default_timezone_set("Asia/Karachi");

$current_time= date("h:i:sa");


$this->load->library("session");

$this->session->set_userdata("otp_created_time","$current_time");
$this->session->userdata("otp_created_time");


$this->session->set_userdata("loginid","$loginidinput");
$this->session->userdata("loginid");

$this->session->set_userdata("otp","$_charcode");
$this->session->userdata("otp");

$this->session->set_userdata("folioss","$get_folio");
$this->session->userdata("folioss");

$this->session->set_userdata("mobileinput","$mobileinput");
$this->session->userdata("mobileinput");

$this->session->set_userdata("emailinput","$emailinput");
$this->session->userdata("emailinput");

$this->session->set_userdata("otptype","E");
$this->session->userdata("otptype");

echo'<script>window.location.href = "../Customer/confirm_forgotpass";</script>';

}                    




}

}



}

public function confirm_forgotpass(){
$this->load->view('confirm_forgot');
}

public function investment(){

$data = [];
//load the view and saved it into $html variable
$html=$this->load->view('investment', $data, true);

//this the the PDF filename that user will get to download
$pdfFilePath = "investment.pdf";

//load mPDF library
$this->load->library('m_pdf');

//generate the PDF from the given html
$this->m_pdf->pdf->WriteHTML($html);

//download it.
$this->m_pdf->pdf->Output($pdfFilePath, "I");	

//	$this->load->view('investment');
}

public function balance_sheet(){

$data = [];
//load the view and saved it into $html variable
$html=$this->load->view('balance', $data, true);

//this the the PDF filename that user will get to download
$pdfFilePath = "balance_sheet.pdf";

//load mPDF library
$this->load->library('m_pdf');

//generate the PDF from the given html
$this->m_pdf->pdf->WriteHTML($html);

//download it.
$this->m_pdf->pdf->Output($pdfFilePath, "I");			    


//$this->load->view('balance');
}

public function tax(){
$data = [];
//load the view and saved it into $html variable
$html=$this->load->view('tax', $data, true);

//this the the PDF filename that user will get to download
$pdfFilePath = "tax.pdf";

//load mPDF library
$this->load->library('m_pdf');

//generate the PDF from the given html
$this->m_pdf->pdf->WriteHTML($html);

//download it.
$this->m_pdf->pdf->Output($pdfFilePath, "I");			    



}
public function resend_pass()
{

$logfolio= $_SESSION['folioss'];
//exit;

$this->db->select('*');
$this->db->where('Folio_No',$logfolio);
$resultmobile = $this->db->get('investoraccountinfo')->result_array();		
$mobileno= $resultmobile[0]['ACC_SMSCELLNUMBER'];

$_chars = "ZXCVBNMASDFGHJKLQWERTYUIOP0123456789";

$_charcode = ''; // initialize the variable with an empty string
for($l = 0; $l<6; $l++){
$temp = str_shuffle($_chars);
$_charcode .= $temp[0];
}

//resend pass code sms
$recipientss =$mobileno;//EXIT;

$messagedatass = "Dear%20customer,%20your%20OTP%20to%20change%20password%20is%20".$_charcode."%20.%20This%20will%20expire%20after%2060%20minutes.%20For%20help,%20call%200800-42526.%20HBL%20Asset%20Management%20Ltd.";
$this->sendSMS($recipientss, $messagedatass);

$this->load->library("session");

$this->session->set_userdata("otp","$_charcode");
$this->session->userdata("otp");
echo'<script>window.location.href = "../Customer/confirm_forgotpass";</script>';


}
public function resend_pass_email()
{

$logfolio= $_SESSION['folioss'];
//exit;

$this->db->select('*');
$this->db->where('Folio_No',$logfolio);
$resultmobile = $this->db->get('investoraccountinfo')->result_array();		
$mobileno= $resultmobile[0]['ACC_SMSCELLNUMBER'];
$email= $resultmobile[0]['ACC_EMAILADDRESS'];

$this->db->select('*');
$this->db->limit(1);
$resultadmin = $this->db->get('Parameters')->result_array();

$_chars = "ZXCVBNMASDFGHJKLQWERTYUIOP0123456789";

$_charcode = ''; // initialize the variable with an empty string
for($l = 0; $l<6; $l++){
$temp = str_shuffle($_chars);
$_charcode .= $temp[0];
}

include "email/class.phpmailer.php";
include "email/PHPMailerAutoload.php";

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.6.209.160';                 // Specify main and backup server
$mail->SMTPAuth = false;
$mail->Port = 25;                                    // TCP port to connect to
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->From = 'info@hblasset.com';
$mail->FromName = '';
$mail->AddAddress($email,$resultmobile[0]['ACC_TITLE']);  // Add a recipient \\ 

$mail->IsHTML(true);                                  // Set email format to HTML
$mail->Subject = 'HBL Asset Management Ltd. - Forget Password OTP (One Time Passcode)';

$mail->Body    = '<br>
<h4>Dear Customer,</h4>
<p>Your OTP to change your password is '.$_charcode.'.</p> 

<p>This OTP will expire after 60 minutes.</p><br>

<p>Our customers are our most valuable asset. It will be a pleasure for us to help you with any query or information that you may have. Please feel free to contact us on Toll Free No. 0800 42526 (during business hours) or email us on info@hblasset.com in case of any queries related to your account.</p>

<p>Regards,</p>

<b><p>Investor Services Department,</p></b>
<b><p>HBL Asset Management Ltd.</p></b>
';

$mail->AltBody = '';

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
//redirect('Customer/profile');

exit;
}
else {

//print $output;
$this->load->library("session");

$this->session->set_userdata("otp","$_charcode");
$this->session->userdata("otp");
echo'<script>window.location.href = "../Customer/confirm_forgotpass";</script>';

}                    

}

//INVESTMENT FORM WORKING



public function insertdata(){  

date_default_timezone_set("Asia/Karachi");
$ref_id = uniqid();

setcookie("inv_ref_id", $ref_id, time()+600);

$query=[
'ref_no' =>$ref_id,
'folio_no' =>$this->input->post('inv_folio_no'),
'name' =>$this->input->post('inv_name'),
'cnic_no' =>$this->input->post('inv_cnic'),
'select_fund' =>$this->input->post('inv_select_fund_name'),
'acc' =>$this->input->post('inv_acc'),
'select_bank' =>$this->input->post('inv_select_bank'),
'amount' =>$this->input->post('inv_tamount'),
'transaction_id' =>$this->input->post('inv_cinum'),
'remarks' =>$this->input->post('inv_remark'),
'status' =>'Pending',
'agreed' => 'yes',
'created_date' => date('Y-m-d'),
'created_time' => date('h:i:s'),
];

$success = $this->db->insert('ibft', $query);
if($success)
{
$this->db->select('*');
$this->db->where('Folio_No',$_SESSION['folino']);
$result = $this->db->get('investoraccountinfo')->result_array();		
$email = $result[0]['ACC_EMAILADDRESS'];	
include 'email/class.phpmailer.php';
include 'email/PHPMailerAutoload.php';

$mail = new PHPMailer;


$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '10.6.209.160';                 // Specify main and backup server
$mail->SMTPAuth = false;
$mail->Port = 25;                                    // TCP port to connect to
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->From = 'info@hblasset.com';
$mail->FromName = '';
$mail->AddAddress('qaiserinfolive@gmail.com',$result[0]['ACC_TITLE']);

$mail->Subject = 'Hbl Asset Management (IBFT Offline)';

$body = '
<div  style="width:300px;padding: 40px;">
<table>
<tr>
<td>
<img src="http://salesapp.orangeroomdigital.com/images/hbl-logo.png" width="400" > 
<br>
<br>
</td>


</tr>
<tr>
<td colspan="2">
<br>
<br>
<h2 style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" >Dear '.$this->input->post('inv_name').', </h2>
<p>Your investment for HBL Asset Management funds was successful.</p>
<p>The transaction details are as follows:</p>
<table style="width:400px;">
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Reference Number</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">'.$ref_id.'</td>
</tr>
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Folio Number</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">'.$this->input->post('inv_folio_no').'</td>
</tr>
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">CNIC</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">'.$this->input->post('inv_cnic').'</td>
</tr>
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Fund Invested In</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">'.$this->input->post('inv_select_fund_name').'</td>
</tr>

<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Fund Account Number</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">
'.$this->input->post('inv_acc').'
</td>
</tr>
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Bank</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">
'.$this->input->post('inv_select_bank').'


</td>
</tr>
<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Fund Ammount Invested</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">
'.$this->input->post('inv_tamount').'


</td>
</tr>

<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Transaction ID</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">
'.$this->input->post('inv_cinum').'


</td>
</tr>

<tr>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">Remarks</td>
<td style="font-size:15px; font-family:Arial, Helvetica, sans-serif;">
'.$this->input->post('inv_remark').'
</td>
</tr>
</table>      

</td>
</tr>
</table>
<br>
<br>
<br>
<br>
<div style="padding:10px;font-family: Arial, Helvetica, sans-serif;font-size: 12px;">&copy; Copyright 2018 HBL Asset Management Limited. All rights reserved.
</div>
</div>
';

//Content
}

$mail->Body    = $body;
$mail->AltBody = strip_tags($body);


if(!$mail->Send()) {
echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
exit;
}
else  {
error_reporting(0);
echo'<script>window.location.href = "../Customer/investment_confirmed";</script>';
}

}



}

//INVESTMENT CLOSE

