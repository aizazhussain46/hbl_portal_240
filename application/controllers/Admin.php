<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
public function __construct()
{
parent::__construct();
$this->load->helper('url');
$this->load->database();
$this->load->library('pagination');

//load the department_model
$this->load->helper('url');
error_reporting(E_ALL & ~E_NOTICE);

$this->load->model('Pagination_transaction');
}

public function investment_activity(){
date_default_timezone_set("Asia/Karachi");
$comments = $this->input->post('comments');  
$id = $this->input->post('id');  
$approve = $this->input->post('approve');
$reject = $this->input->post('reject');
if($approve){
$status = 'Approved';
}
if($reject){
$status = 'Rejected';
}

$this->db->select('*');
$this->db->where('id',$id);
$this->db->where('status',$status);
$result = $this->db->get('ibft')->result_array();	


if (count($result) == 0) {

$this->db->where('id', $this->input->post('id'));
$this->db->update('ibft', ['comments' => $comments]); 

$this->db->where('id', $this->input->post('id'));
$updated = $this->db->update('ibft', ['status' => $status]); 
if ($updated) {

$data = [
'action' => $status,
'email' => $this->session->userdata("Email"),
'created_date' => date("Y-m-d"),
'created_time' => date("h:i:s"),
];
$inserted = $this->db->insert('investment_activity',$data); 
if($inserted){

echo '<script>alert("Record has been '.$status.'.");
window.location.href="../admin/investments";
</script>';

}
else{
echo '<script>alert("Something Went Wrong!");
window.location.href="../admin/investments";
</script>';
}

}
}
else{
echo '<script>alert("Cannot proceed the same action. ");
window.location.href="../admin/investments";
</script>';
}





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
$this->load->view('admin/signin');
}

public function check_login()
{

$user_email= $this->input->post('folio');
$user_pass= md5($this->input->post('pass'));
$status= "A";
//echo $user_pass;exit();

$this->db->select('*');
$this->db->where('Email',$user_email);
$this->db->where('Password',$user_pass);
$result = $this->db->get('admin')->result_array();		

if (count($result) == 1) 
{

if($result[0]['status'] == 0){
//echo $result[0]['status'];
//exit;

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Your id is block. Please contact administrator')
window.location.href='../admin/';
</SCRIPT>");     
}
if($result[0]['status'] == 1){

$session_id= $result[0]['adminid'];



$this->load->library("session");

$this->session->set_userdata("Email","$user_email");
$this->session->userdata("Email");

$this->session->set_userdata("SessionID","$session_id");
$this->session->userdata("SessionID");


$this->load->model('Customer_panel');
$this->Customer_panel->login_account_log();


// redirect('admin/dashboard'); 
redirect('Admin/transaction', 'refresh');
}
}
if (count($result) == 0) {
// Support Session
echo "<script>alert('Invalid username or password');</script>";
//$this->load->view('admin/login');

echo'
<script>
window.location.href = "../Admin";
</script>
';			
}
}
public function logout()
{
$this->session->sess_destroy();
echo'
<script>
window.location.href = "../admin";
</script>
';

}	
public function profile()
{
$this->load->view('admin/profile');
}
public function transaction()
{
$this->load->view('admin/transaction');
}	
public function investments()
{
$this->load->view('admin/investments');
}
public function investments_log()
{
$this->load->view('admin/investments_log');
}	

public function activate()
{

echo $this->uri->segment('3');
$this->load->view('admin/profile');
}	
public function contact_info()
{
$this->load->view('admin/contact_info');
}	
public function bank_info()
{
$this->load->view('admin/bank_info');
}	
public function contactinfo_search()
{
$tdate= $this->input->post('tdate');
$fdate= $this->input->post('fdate');

$status= $this->input->post('search_status');
//exit;

if($status != "all"){
$this->db->select('*');
$this->db->where('status',$status);
$result = $this->db->get('contactinformation')->result_array();		

if(empty($result[0]['status'])){
$status_search ="";
}		
if(!empty($result[0]['status'])){
$status_search = $result[0]['status'];
}

if(empty($status_search)){
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('No record found')
window.location.href='../admin/contact_info';
</SCRIPT>");

}

//exit();
else if(!empty($status_search)){
redirect("Admin/contact_info".'/'.$status_search.'/'.$tdate.'/'.$fdate,"refresh");



}


}
if($status == "all"){
// echo "dad";
redirect("Admin/contact_info/all".'/'.$status_search.'/'.$tdate.'/'.$fdate,"refresh");

}



}

public function bank_info_search()
{
$status= $this->input->post('search_status');
//exit;
$tdate= $this->input->post('tdate');
$fdate= $this->input->post('fdate');

if($status != "all"){
$this->db->select('*');
$this->db->where('status',$status);
$result = $this->db->get('bankinformation')->result_array();		

if(empty($result[0]['status'])){
$status_search ="";
}		
if(!empty($result[0]['status'])){
$status_search = $result[0]['status'];
}

if(empty($status_search)){
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('No record found')
window.location.href='../admin/bank_info';
</SCRIPT>");

}

//exit();
else if(!empty($status_search)){
redirect("admin/bank_info/".$status_search.'/'.$tdate.'/'.$fdate,"refresh");
}


}
if($status == "all"){
// echo "dad";
redirect("Admin/contact_info/all".'/'.$tdate.'/'.$fdate,"refresh");
}



}	

public function transaction_search()
	{
		$status= $this->input->post('search_status');
		$tdate= $this->input->post('tdate');
		$fdate= $this->input->post('fdate');


		if($status != "all"){
		$this->db->select('*');
		$this->db->where('Status',$status);
		$result = $this->db->get('transactionrequest')->result_array();		
		
		if(empty($result[0]['Status'])){
		    $status_search ="";
		}		
		if(!empty($result[0]['Status'])){
		    $status_search = $result[0]['Status'];
		}

    		if(empty($status_search)){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('No record found')
                window.location.href='../admin/transaction';
                </SCRIPT>");
    		
    		}
		
		//exit();
    		else if(!empty($status_search)){
    		redirect("admin/transaction/".$status_search.'/'.$tdate.'/'.$fdate,"refresh");
    		}
		    
		    
		}
		if($status == "all"){
		   // echo "dad";
		redirect("Admin/transaction/all".'/'.$tdate.'/'.$fdate,"refresh");
		}
	}


public function investment_search()
	{
		$status= $this->input->post('search_status');
		$tdate= $this->input->post('tdate');
		$fdate= $this->input->post('fdate');



		if($status != "all"){

		$this->db->select('*');
		$this->db->where('status',$status);
		$result = $this->db->get('ibft')->result_array();

	

		if(empty($result[0]['status'])){
		    $status_search ="";
		}		
		if(!empty($result[0]['status'])){
		    $status_search = $result[0]['status'];
		}

    		if(empty($status_search)){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('No record found')
                window.location.href='../admin/investments';
                </SCRIPT>");
    		
    		}
		
		//exit();
    		else if(!empty($status_search)){
    		redirect("admin/investments/".$status_search.'/'.$tdate.'/'.$fdate,"refresh");
    		}
		    
		    
		}
		if($status == "all"){
		   // echo "dad";
		redirect("Admin/investments/all".'/'.$tdate.'/'.$fdate,"refresh");
		}
	}



public function users_search()
{
$status= $this->input->post('search_status');

$this->db->select('*');
$this->db->where('UserID',$status);
$result = $this->db->get('user')->result_array();		

if(empty($result[0]['UserID'])){
$status_search ="";
}		
if(!empty($result[0]['UserID'])){
$status_search = $result[0]['UserID'];
}

if(empty($status_search)){
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('No record found')
window.location.href='../admin/profile';
</SCRIPT>");

}

//exit();
else if(!empty($status_search)){
redirect("admin/profile/".$status_search,"refresh");
}



}

public function admin_users_search()
{
$status= $this->input->post('search_status');

$this->db->select('*');
$this->db->where('Email',$status);
$result = $this->db->get('admin')->result_array();		

if(empty($result[0]['Email'])){
$status_search ="";
}		
if(!empty($result[0]['Email'])){
$status_search = $result[0]['Email'];
}

if(empty($status_search)){
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('No record found')
window.location.href='../admin/admin_users';
</SCRIPT>");

}

//exit();
else if(!empty($status_search)){
redirect("admin/admin_users/".$status_search,"refresh");
}



}

public function bankinfo_search()
{
$status= $this->input->post('search_status');

if($status == "Pending"){
$this->db->select('*');
$this->db->where('status',"pending");
$result = $this->db->get('bankinformation')->result_array();		
$status_search= $result[0]['status'];
//exit();
redirect("admin/bank_info/pending","refresh");
}
if($status == "Confirm"){
$this->db->select('*');
$this->db->where('status',"Confirm");
$result = $this->db->get('bankinformation')->result_array();		
$status_search= $result[0]['status'];
//exit();
redirect("admin/bank_info/Confirm","refresh");
}
if($status == "Reject"){
$this->db->select('*');
$this->db->where('status',"Reject");
$result = $this->db->get('bankinformation')->result_array();		
$status_search= $result[0]['status'];
//exit();
redirect("admin/bank_info/Reject","refresh");
}				
if($status == "all"){
redirect("admin/bank_info/all","refresh");
}
}



public function confirm_contactinfo()
{

$contactinfo_id= $this->uri->segment('3');

$this->db->select('*');
$this->db->where('id',$contactinfo_id);
$result = $this->db->get('contactinformation')->result_array();		

$phone= $result[0]['phone'];
$cell= $result[0]['cell'];
$address= $result[0]['address'];
$email= $result[0]['email'];
$folio= $result[0]['Folio_No'];


$data = array(
'status' => "Confirm",
);

$this->db->where('id', $contactinfo_id);
$this->db->update('contactinformation', $data); 

$data = array(
'ACC_SMSCELLNUMBER' => $cell,
'ACC_PHONE' => $phone,
'ACC_EMAILADDRESS' => $email,
'ACC_ADDRESS' => $address,
);

$this->db->where('Folio_No', $folio);
$this->db->update('investoraccountinfo', $data); 

echo "<script>alert('This is confirm now.');</script>";
echo'
<script>
window.location.href = "../../admin/contact_info";
</script>
';
}




public function confirm_bankinfo()
{

$contactinfo_id= $this->uri->segment('3');

$this->db->select('*');
$this->db->where('id',$contactinfo_id);
$result = $this->db->get('bankinformation')->result_array();		

$accountnumber= $result[0]['accountnumber'];
$accounttitle= $result[0]['accounttitle'];
$bankname= $result[0]['bankname'];
$address= $result[0]['address'];
$folio= $result[0]['Folio_No'];


$data = array(
'status' => "Confirm",
);

$this->db->where('id', $contactinfo_id);
$this->db->update('bankinformation', $data); 

$data = array(
'ABA_ACCOUNTCODE' => $accountnumber,
'Bank_AccountTitle' => $accounttitle,
'Bank_Name' => $bankname,
'Branch_Address' => $address,
);

$this->db->where('Folio_No', $folio);
$this->db->update('investoraccountinfo', $data); 

echo "<script>alert('This is confirm now.');</script>";
echo'
<script>
window.location.href = "../../admin/bank_info";
</script>
';
}


public function reject_contactinfosss()
{
$id= $this->uri->segment('3');
//echo $id;
//exit();

$data = array(
'status' => "Reject",
);

$this->db->where('id', $id);
$this->db->update('contactinformation', $data); 
echo "<script>alert('This is rejected now.');</script>";
echo'
<script>
window.location.href = "../../admin/contact_info";
</script>
';

}

public function reject_bankinfo()
{
$id= $this->uri->segment('3');
//echo $id;
//exit();

$data = array(
'status' => "Reject",
);

$this->db->where('id', $id);
$this->db->update('bankinformation', $data); 
echo "<script>alert('This is rejected now.');</script>";
echo'
<script>
window.location.href = "../../admin/bank_info";
</script>
';

}

public function authorized()
{
$pre_status= $_POST['previous_status'];
$t_id= $_POST['trans_id'];
$cur_status= "A";
$cur_date= date("Y-m-d");
$cur_time= date("h:i:s");
$by= $_SESSION['Email'];
$ip= $_SERVER['REMOTE_ADDR'];


if(empty($_POST['aut_reason'])){
$reason= "";

$datas = array(
'Authorize_IP' => $ip,
'PreviousStatus' => $pre_status,
'Authorize_By' => $by,
'Authorize_Date' => $cur_date,
'Authorize_Time' => $cur_time,
'Status' => $cur_status,
);

}

if(!empty($_POST['aut_reason'])){
$reason= $_POST['aut_reason'];
$datas = array(
'Authorize_IP' => $ip,
'PreviousStatus' => $pre_status,
'Authorize_By' => $by,
'Authorize_Date' => $cur_date,
'Authorize_Time' => $cur_time,
'Status' => $cur_status,
'Authorize_Reason' => $reason,
);
}  


//print_r($datas);exit;
$this->db->where('id', $t_id);
$this->db->update('transactionrequest', $datas); 

$this->load->model('Customer_panel');
$this->Customer_panel->authorize_transaction();

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully authorized now')
window.location.href='../Admin/transaction';
</SCRIPT>");

}


public function authorized_contactinfo()
{
$pre_status= $_POST['previous_status'];
$t_id= $_POST['trans_id'];
$cur_status= "A";
$cur_date= date("Y-m-d");
$cur_time= date("h:i:s");
$by= $_SESSION['Email'];
$ip= $_SERVER['REMOTE_ADDR'];


if(empty($_POST['aut_reason'])){
$reason= "";

$datas = array(
'Authorize_IP' => $ip,
'PreviousStatus' => $pre_status,
'Authorize_By' => $by,
'Authorize_Date' => $cur_date,
'Authorize_Time' => $cur_time,
'status' => $cur_status,
);

}

if(!empty($_POST['aut_reason'])){
$reason= $_POST['aut_reason'];
$datas = array(
'Authorize_IP' => $ip,
'PreviousStatus' => $pre_status,
'Authorize_By' => $by,
'Authorize_Date' => $cur_date,
'Authorize_Time' => $cur_time,
'status' => $cur_status,
'Authorize_Reason' => $reason,
);
}  


//print_r($datas);exit;
$this->db->where('id', $t_id);
$this->db->update('contactinformation', $datas); 

$this->load->model('Customer_panel');
$this->Customer_panel->authorize_contactinfo();

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully authorized now')
window.location.href='../Admin/contact_info';
</SCRIPT>");

}




public function authorized_bank_info()
{
$pre_status= $_POST['previous_status'];
$t_id= $_POST['trans_id'];
$cur_status= "A";
$cur_date= date("Y-m-d");
$cur_time= date("h:i:s");
$by= $_SESSION['Email'];
$ip= $_SERVER['REMOTE_ADDR'];


if(empty($_POST['aut_reason'])){
$reason= "";

$datas = array(
'Authorize_IP' => $ip,
'PreviousStatus' => $pre_status,
'Authorize_By' => $by,
'Authorize_Date' => $cur_date,
'Authorize_Time' => $cur_time,
'status' => $cur_status,
);

}

if(!empty($_POST['aut_reason'])){
$reason= $_POST['aut_reason'];
$datas = array(
'Authorize_IP' => $ip,
'PreviousStatus' => $pre_status,
'Authorize_By' => $by,
'Authorize_Date' => $cur_date,
'Authorize_Time' => $cur_time,
'status' => $cur_status,
'Authorize_Reason' => $reason,
);
}  


//print_r($datas);exit;
$this->db->where('id', $t_id);
$this->db->update('bankinformation', $datas); 

$this->load->model('Customer_panel');
$this->Customer_panel->authorize_bank_info();

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully authorized now')
window.location.href='../Admin/bank_info';
</SCRIPT>");

}


public function reject()
{
$pre_status= $_POST['previous_status'];
$t_id= $_POST['trans_id'];
$cur_status= "R";
$cur_date= date("Y-m-d");
$cur_time= date("h:i:s");
$by= $_SESSION['Email'];
$ip= $_SERVER['REMOTE_ADDR'];


//$result_fol_id[0]['FolioNo'];exit;

if(empty($_POST['reason'])){
$reason= "";
$datas = array(
'Reject_IP' => $ip,
'PreviousStatus' => $pre_status,
'Authorize_By' => $by,
'Authorize_Date' => $cur_date,
'Authorize_Time' => $cur_time,
'Status' => $cur_status,
'Reject_Reason' => $reason,
);          

}

if(!empty($_POST['reason'])){
$reason= $_POST['reason'];
$datas = array(
'Reject_IP' => $ip,
'PreviousStatus' => $pre_status,
'Reject_By' => $by,
'Reject_Date' => $cur_date,
'Reject_Time' => $cur_time,
'Status' => $cur_status,
'Reject_Reason' => $reason,
);             
}          

//print_r($datas);exit;
$this->db->where('id', $t_id);
$this->db->update('transactionrequest', $datas); 

$this->load->model('Customer_panel');
$this->Customer_panel->reject_transaction();


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully rejected now')
window.location.href='../Admin/transaction';
</SCRIPT>");

}



public function reject_contactinfo()
{
$pre_status= $_POST['previous_status'];
$t_id= $_POST['trans_id'];
$cur_status= "R";
$cur_date= date("Y-m-d");
$cur_time= date("h:i:s");
$by= $_SESSION['Email'];
$ip= $_SERVER['REMOTE_ADDR'];


//$result_fol_id[0]['FolioNo'];exit;

if(empty($_POST['reason'])){
$reason= "";
$datas = array(
'Reject_IP' => $ip,
'PreviousStatus' => $pre_status,
'Authorize_By' => $by,
'Authorize_Date' => $cur_date,
'Authorize_Time' => $cur_time,
'Status' => $cur_status,
'Reject_Reason' => $reason,
);          

}

if(!empty($_POST['reason'])){
$reason= $_POST['reason'];
$datas = array(
'Reject_IP' => $ip,
'PreviousStatus' => $pre_status,
'Reject_By' => $by,
'Reject_Date' => $cur_date,
'Reject_Time' => $cur_time,
'Status' => $cur_status,
'Reject_Reason' => $reason,
);             
}          

//print_r($datas);exit;
$this->db->where('id', $t_id);
$this->db->update('contactinformation', $datas); 

$this->load->model('Customer_panel');
$this->Customer_panel->reject_contactinfo();


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully rejected now')
window.location.href='../Admin/contact_info';
</SCRIPT>");

}



public function reject_bank_info()
{
$pre_status= $_POST['previous_status'];
$t_id= $_POST['trans_id'];
$cur_status= "R";
$cur_date= date("Y-m-d");
$cur_time= date("h:i:s");
$by= $_SESSION['Email'];
$ip= $_SERVER['REMOTE_ADDR'];


//$result_fol_id[0]['FolioNo'];exit;

if(empty($_POST['reason'])){
$reason= "";
$datas = array(
'Reject_IP' => $ip,
'PreviousStatus' => $pre_status,
'Authorize_By' => $by,
'Authorize_Date' => $cur_date,
'Authorize_Time' => $cur_time,
'Status' => $cur_status,
'Reject_Reason' => $reason,
);          

}

if(!empty($_POST['reason'])){
$reason= $_POST['reason'];
$datas = array(
'Reject_IP' => $ip,
'PreviousStatus' => $pre_status,
'Reject_By' => $by,
'Reject_Date' => $cur_date,
'Reject_Time' => $cur_time,
'Status' => $cur_status,
'Reject_Reason' => $reason,
);             
}          

//print_r($datas);exit;
$this->db->where('id', $t_id);
$this->db->update('bankinformation', $datas); 

$this->load->model('Customer_panel');
$this->Customer_panel->reject_bank_info();


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully rejected now')
window.location.href='../Admin/bank_info';
</SCRIPT>");

}    

public function deactive(){
$userid= $this->uri->segment('3');

$data = array(
'Status' => "D",
'WrongPassword' => "5",
);

$this->db->where('Folio_No', $userid);
$this->db->update('user', $data);         

$this->load->model('Customer_panel');
$this->Customer_panel->deactive_account_log();

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully deactive account')
window.location.href='../../Admin/profile';
</SCRIPT>");


}   

public function active(){
$userid= $this->uri->segment('3');

$data = array(
'Status' => "A",
'WrongPassword' => "0",
);

// users is the name of the db table you are inserting in
$this->db->where('Folio_No', $userid);
$this->db->update('user', $data);         

$this->load->model('Customer_panel');
$this->Customer_panel->active_account_log();

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully active account')
window.location.href='../../Admin/profile';
</SCRIPT>");
}     

public function process_importa($ftype){

if($ftype=="transaction")
{
$this->insert_transaction();
//log here update S to P
$this->update_importlog($ftype);
}
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Process completed. Successfully Append into the main data.')
window.location.href='../../Admin/upload_data';
</SCRIPT>");

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function process_importo($ftype){

//truncate main

$rsp_message = "";

if($ftype=="portfolio")
{
$this->db->from('dailyportfoliosummary');
$this->db->truncate(); 
$this->insert_portfolio();
//log here update S to P
$this->update_importlog($ftype);
$rsp_message = "Process completed. Successfully Update the main data.";
}

elseif($ftype=="investor")
{
//            $this->db->from('investoraccountinfo2');
//            $this->db->truncate(); 
// truncate not required. insert new one and update existing
$this->insert_investor();
//log here update S to P
$this->update_importlog($ftype);
$rsp_message = "Process completed. Successfully Update the main data.";
}
elseif($ftype=="transaction")
{
$this->db->from('transactionhistory');
$this->db->truncate(); 
$this->insert_transaction();
//log here update S to P
$this->update_importlog($ftype);
$rsp_message = "Process completed. Successfully Update the main data.";
}

elseif($ftype=="fmr" or $ftype=="fmrdata")
{
// first check for other file
///

if($ftype=="fmr"){
$sfile="fmrdata";
$rsp_message = "Sorry, upload FMR Data Sheet then re-try.";

}
else{
$sfile="fmr";

$rsp_message = "Sorry, upload FMR Sheet then re-try.";
}


$this->db->select('filetype');
$this->db->where('filetype',$sfile);
$this->db->where('importstatus','S');
$result = $this->db->get('import')->result_array();		

if(empty($result[0]['filetype']))
{
}
else
{
///    
$this->insert_fmrdata();

//log here update S to P
//temp comment
$this->update_importlog("fmr");
$this->update_importlog("fmrdata");

$rsp_message = "Process completed. Successfully Update the main data.";
}
}
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('$rsp_message')
window.location.href='../../Admin/upload_data';
</SCRIPT>");
}
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
////////////////insert FMR /////////////////////////////
////////////////////////////////////////////////////////
private function insert_fmrdata(){

$this->insert_fmr_master();
}


private function insert_fmr_fundinfo($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("FUND INFORMATION");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+23);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_FUND_INFO WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV = addslashes($row->B1);

$sql="INSERT INTO FMR_FUND_INFO(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV','$r')";
$query1=$this->db->query($sql);   
$r++;

}
}
}
}
////////////////////////////////////////////////////////////
private function insert_fmr_committe($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("INVESTMENT COMMITTEE");
$this->db->select('SNO');
$this->db->where('D1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('D1,E1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+6);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_COMMITTEE WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->D1);
$ITEMV = addslashes($row->E1);

$sql="INSERT INTO FMR_COMMITTEE(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV','$r')";
$query1=$this->db->query($sql);   
$r++;

}
}
}
}
////////////////////////////////////////////////////////////////////
private function insert_fmr_assetvalue($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("NET ASSET VALUE");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+16);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_NET_ASSET_VALUE WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV = addslashes($row->B1);

$sql="INSERT INTO FMR_NET_ASSET_VALUE(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV','$r')";
$query1=$this->db->query($sql);   
$r++;

}
}
}
}
////////////////////////////////////////////////////////////////
private function insert_fmr_assetclass($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("Asset Class");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1,C1,D1,E1,F1,G1,H1,I1,J1,K1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+10);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_ASSET_CLASS WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV1 = addslashes($row->B1);
$ITEMV2 = addslashes($row->C1);
$ITEMV3 = addslashes($row->D1);
$ITEMV4 = addslashes($row->E1);
$ITEMV5 = addslashes($row->F1);
$ITEMV6 = addslashes($row->G1);
$ITEMV7 = addslashes($row->H1);
$ITEMV8 = addslashes($row->I1);
$ITEMV9 = addslashes($row->J1);
$ITEMV10 = addslashes($row->K1);

$sql="INSERT INTO FMR_ASSET_CLASS(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2,ITEMVALUE3,ITEMVALUE4,ITEMVALUE5,ITEMVALUE6,ITEMVALUE7,ITEMVALUE8,ITEMVALUE9,ITEMVALUE10,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV1','$ITEMV2','$ITEMV3','$ITEMV4','$ITEMV5','$ITEMV6','$ITEMV7','$ITEMV8','$ITEMV9','$ITEMV10','$r')";
$query1=$this->db->query($sql);   

if($ITEM =="Total"){

$t= str_replace(",","",$ITEMV10);
$t= str_replace("-","",$t);
$t = doubleval($t);


if($t>0){
$sql1="TRUNCATE TABLE FMR_ASSET_QUALITY";

$query1=$this->db->query($sql1);

}



//1
try {
$p = 0;
$v= str_replace(",","",$ITEMV1);
$v= str_replace("-","",$v);
$v = doubleval($v);


if($v>0 && $t>0){
$p = round($v*100/$t,1);

}
}
catch(Exception $e) {
$v= 0;
$p = 0;
}

$sql1="INSERT INTO FMR_ASSET_QUALITY(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2) VALUES('$PCD','$FCD','Government Securities','$v','$p')";

$query1=$this->db->query($sql1);
//2
try {
$p = 0;

$v= str_replace(",","",$ITEMV2);
$v= str_replace("-","",$v);
$v = doubleval($v);

if($v>0 && $t>0){
$p = round($v*100/$t,1);

}
}
catch(Exception $e) {
$v= 0;
$p = 0;
}

$sql1="INSERT INTO FMR_ASSET_QUALITY(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2) VALUES('$PCD','$FCD','AA+','$v','$p')";

$query1=$this->db->query($sql1);
//3
try {
$p = 0;
$v= str_replace(",","",$ITEMV3);
$v= str_replace("-","",$v);
$v = doubleval($v);



if($v>0 && $t>0){
$p = round($v*100/$t,1);

}
}
catch(Exception $e) {
$v= 0;
$p = 0;
}

$sql1="INSERT INTO FMR_ASSET_QUALITY(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2) VALUES('$PCD','$FCD',' AA','$v','$p')";

$query1=$this->db->query($sql1);
//4
try {
$p = 0;
$v= str_replace(",","",$ITEMV4);
$v= str_replace("-","",$v);
$v = doubleval($v);
$t= str_replace(",","",$ITEMV10);
$t= str_replace("-","",$t);
$t = doubleval($t);


if($v>0 && $t>0){
$p = round($v*100/$t,1);

}
}
catch(Exception $e) {
$v= 0;
$p = 0;
}

$sql1="INSERT INTO FMR_ASSET_QUALITY(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2) VALUES('$PCD','$FCD',' AAA','$v','$p')";

$query1=$this->db->query($sql1);
//5
try {
$p = 0;
$v= str_replace(",","",$ITEMV5);
$v= str_replace("-","",$v);
$v = doubleval($v);



if($v>0 && $t>0){
$p = round($v*100/$t,1);

}
}
catch(Exception $e) {
$v= 0;
$p = 0;
}

$sql1="INSERT INTO FMR_ASSET_QUALITY(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2) VALUES('$PCD','$FCD',' AA-','$v','$p')";

$query1=$this->db->query($sql1);
//6
try {
$p = 0;
$v= str_replace(",","",$ITEMV6);
$v= str_replace("-","",$v);
$v = doubleval($v);



if($v>0 && $t>0){
$p = round($v*100/$t,1);

}
}
catch(Exception $e) {
$v= 0;
$p = 0;
}

$sql1="INSERT INTO FMR_ASSET_QUALITY(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2) VALUES('$PCD','$FCD',' A+','$v','$p')";

$query1=$this->db->query($sql1);
//7
try {
$p = 0;
$v= str_replace(",","",$ITEMV7);
$v= str_replace("-","",$v);
$v = doubleval($v);



if($v>0 && $t>0){
$p = round($v*100/$t,1);

}
}
catch(Exception $e) {
$v= 0;
$p = 0;
}

$sql1="INSERT INTO FMR_ASSET_QUALITY(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2) VALUES('$PCD','$FCD',' A-','$v','$p')";

$query1=$this->db->query($sql1);
//8
try {
$p = 0;
$v= str_replace(",","",$ITEMV8);
$v= str_replace("-","",$v);
$v = doubleval($v);



if($v>0 && $t>0){
$p = round($v*100/$t,1);

}
}
catch(Exception $e) {
$v= 0;
$p = 0;
}

$sql1="INSERT INTO FMR_ASSET_QUALITY(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2) VALUES('$PCD','$FCD',' Others','$v','$p')";

$query1=$this->db->query($sql1);
//9
try {
$p = 0;
$v= str_replace(",","",$ITEMV9);
$v= str_replace("-","",$v);
$v = doubleval($v);



if($v>0 && $t>0){
$p = round($v*100/$t,1);

}
}
catch(Exception $e) {
$v= 0;
$p = 0;
}

$sql1="INSERT INTO FMR_ASSET_QUALITY(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2) VALUES('$PCD','$FCD',' Non Rated','$v','$p')";

$query1=$this->db->query($sql1);


}



$r++;

// ASSET QUALITY to drive here


}
}
}
}

////////////////////////////////////////////////////////////////
private function insert_fmr_tfc($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$OFFSET=40;
$sHeading = addslashes("TFCs");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$this->db->where('SNO >',$OFFSET);

$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1,C1,D1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+6);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_TFC WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV1 = addslashes($row->B1);
$ITEMV2 = addslashes($row->C1);
$ITEMV3 = addslashes($row->D1);

$sql="INSERT INTO FMR_TFC(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2,ITEMVALUE3,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV1','$ITEMV2','$ITEMV3','$r')";
$query1=$this->db->query($sql);   
$r++;


}
}
}
}
private function insert_fmr_commpaper($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("Commercial Paper");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1,C1,D1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+1);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_COMM_PAPER WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV1 = addslashes($row->B1);
$ITEMV2 = addslashes($row->C1);
$ITEMV3 = addslashes($row->D1);

$sql="INSERT INTO FMR_COMM_PAPER(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2,ITEMVALUE3,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV1','$ITEMV2','$ITEMV3','$r')";
$query1=$this->db->query($sql);   
$r++;


}
}
}
}
////////////////////////////////////////////////////////////////
private function insert_fmr_BankBalance($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("Banks Deposit");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1,C1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+16);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_BANK_BALANCE WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV1 = addslashes($row->B1);
$ITEMV2 = addslashes($row->C1);

$sql="INSERT INTO FMR_BANK_BALANCE(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV1','$ITEMV2','$r')";
$query1=$this->db->query($sql);   
$r++;


}
}
}
}
////////////////////////////////////////////////////////////////
private function insert_fmr_tdr($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("TDRs and Placements");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1,C1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+3);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_TDR WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV1 = addslashes($row->B1);
$ITEMV2 = addslashes($row->C1);

$sql="INSERT INTO FMR_TDR(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV1','$ITEMV2','$r')";
$query1=$this->db->query($sql);   
$r++;


}
}
}
}
//////////////////////////////////////////////////
private function insert_fmr_benchmark($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("Month");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1,C1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+12);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_BENCHMARK WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV1 = addslashes($row->B1);
$ITEMV2 = addslashes($row->C1);

$sql="INSERT INTO FMR_BENCHMARK(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV1','$ITEMV2','$r')";
$query1=$this->db->query($sql);   
$r++;


}
}
}
}

//////////////////////////////////////////////////
private function insert_fmr_FUNDRETURNS($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("FUND RETURNS *");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1,C1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+9);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_RETURNS WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV1 = addslashes($row->B1);
$ITEMV2 = addslashes($row->C1);

$sql="INSERT INTO FMR_RETURNS(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV1','$ITEMV2','$r')";
$query1=$this->db->query($sql);   
$r++;


}
}
}
}


//////////////////////////////////////////////////
private function insert_fmr_assetalloc($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("ASSET ALLOCATION");
$this->db->select('SNO');
$this->db->like('D1',$sHeading);
$result = $this->db->get('temp_fmr')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('D1,E1,F1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+11);
$query = $this->db->get('temp_fmr');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_ASSET_ALLOC WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->D1);

if(!empty($ITEM))
{

if($ITEM == "Total Including Fund of Fund"){
$ITEMV1 = "100.00%";  
}

elseif($ITEM == "Total Excluding Fund of Fund"){
$ITEMV1 = round(100-3.72,2) . "%";

}
else
{


$ITEMV1 = "0.00%";
$sqli="SELECT REPLACE(REPLACE(ITEMVALUE, ',', ''),'-','0') AS IVALUE,
(SELECT REPLACE(REPLACE(ITEMVALUE, ',', ''),'-','0') 
FROM `FMR_NET_ASSET_VALUE` WHERE 
PERIODCODE = '$PCD' AND FUNDCODE = '$FCD' AND 
ITEM = 'Total Assets') AS TOTAL
FROM `FMR_NET_ASSET_VALUE` WHERE 
PERIODCODE = '$PCD' AND FUNDCODE = '$FCD' AND 
ITEM = '$ITEM'";


$queryi=$this->db->query($sqli);
if ($queryi->num_rows() > 0)
{
foreach ($queryi->result() as $rowi)
{
$v1 = $rowi->IVALUE;
$t1 = $rowi->TOTAL;
if($v1>0 && $t1>0){
$ITEMV1 = round(($v1 * 100)/$t1,2);
$ITEMV1 = $ITEMV1 . "%";
}
}
}
else
{
$ITEMV1 = "0.00%";      
}
}
}
else
{
// sub heading
$ITEMV1 = addslashes($row->E1);

}


$ITEMV2 = addslashes($row->F1);

$sql="INSERT INTO FMR_ASSET_ALLOC(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV1','$ITEMV2','$r')";
$query1=$this->db->query($sql);   
$r++;

}
}
}
}
//////////////////////////////////////////////////
private function insert_fmr_NonCompliant($FCD,$PCD){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = addslashes("Non-Compliant Investment");
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmrdata')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1,B1,C1,D1,E1,F1,G1');
$this->db->where('SNO >', $result[0]['SNO']);
$this->db->where('SNO <=', $result[0]['SNO']+5);
$query = $this->db->get('temp_fmrdata');
if ($query->num_rows() > 0)
{
$sql="DELETE FROM FMR_NONCOMPLIANT WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query1=$this->db->query($sql);
$r=1;
foreach ($query->result() as $row)
{
$ITEM =addslashes($row->A1);
$ITEMV1 = addslashes($row->B1);
$ITEMV2 = addslashes($row->C1);
$ITEMV3 = addslashes($row->D1);
$ITEMV4 = addslashes($row->E1);
$ITEMV5 = addslashes($row->F1);
$ITEMV6 = addslashes($row->G1);

$sql="INSERT INTO FMR_NONCOMPLIANT(PERIODCODE,FUNDCODE,ITEM,ITEMVALUE1,ITEMVALUE2,ITEMVALUE3,ITEMVALUE4,ITEMVALUE5,ITEMVALUE6,SNO) VALUES('$PCD','$FCD','$ITEM','$ITEMV1','$ITEMV2','$ITEMV3','$ITEMV4','$ITEMV5','$ITEMV6','$r')";
$query1=$this->db->query($sql);   
$r++;

// ASSET QUALITY to drive here


}
}
}
}
///////////////////////////////////////////////////////////
private function insert_fmr_master(){
//MASTER Data
//$FNAME = strtoupper("HBL Income Fund");

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get First Record
$this->db->select('A1');
$this->db->where('SNO',1);
$result = $this->db->get('temp_fmrdata')->result_array();
$FNAME = strtoupper($result[0]['A1']);
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

//Query DB to get Fund Code using Fund Name
$this->db->select('FUNDCODE');
$this->db->where('upper(FUNDNAME)',$FNAME);


$result = $this->db->get('FMR_FUND')->result_array();		

if(empty($result[0]['FUNDCODE']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}

//$PCD = "102017";
$FCD = $result[0]['FUNDCODE']; //"HBLIF";
//$PCDC = "OCTOBER 2017";


/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get First Record
$this->db->select('A1,B1');
$this->db->where('SNO',1);
$result = $this->db->get('temp_fmr')->result_array();
$PCDC = addslashes($result[0]['A1']);
$PCD = $result[0]['B1'];
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
$sHeading = "INVESTMENT OBJECTIVE";
$this->db->select('SNO');
$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmr')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1');
$this->db->where('SNO',$result[0]['SNO']+1);
$result = $this->db->get('temp_fmr')->result_array();
$OBJ = addslashes($result[0]['A1']);
}
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//Query DB to get
//$sHeading = addslashes("FUND MANAGER'S COMMENTS");
$sHeading = addslashes("COMMENTS");
$this->db->select('SNO');
$this->db->like('A1',$sHeading);
//$this->db->where('A1',$sHeading);
$result = $this->db->get('temp_fmr')->result_array();		
if(empty($result[0]['SNO']))
{
// Not Found
// Proper return value .... to do later
return(0);     		
}
else
{
$this->db->select('A1');
$this->db->where('SNO',$result[0]['SNO']+1);
$result = $this->db->get('temp_fmr')->result_array();
$RMK = addslashes($result[0]['A1']);
}
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////


//$OBJ = addslashes("The objective of the Fund is to provide a stable stream of income with moderate level of risk by investing in fixed income securities.");

//   $RMK = addslashes("The fund posted an annualized return of 5.07% against the benchmark return of 6.17% while fund size increased to PKR 4,201 mn from PKR 4,107mn in September. 17. During the month, fund returns improved by 105 bps MoM due to gains linked to TFCs. Exposure in TFCs was reduced to 26.69% of total assets compared to 30.47% in September in order to create liquidity for upcoming non-banking TFCs. Due to trimmed exposure in TFCs, weighted average time to maturity of the fund reduced to 653 days against 791 days September'17. Going forward, we expect return will improve as we are planning to increase exposure in high rated TFCs and Sukuks.");

/////////////////////////////////////////////////////////


$sql="DELETE FROM FMR_MASTER WHERE PERIODCODE='$PCD' AND FUNDCODE= '$FCD'";
$query=$this->db->query($sql);


$sql="INSERT INTO FMR_MASTER(PERIODCODE,FUNDCODE,PERIODCAPTION,OBJECTIVE,REMARKS) VALUES('$PCD','$FCD','$PCDC','$OBJ','$RMK')";

$query=$this->db->query($sql);

$this->insert_fmr_fundinfo($FCD,$PCD);
$this->insert_fmr_committe($FCD,$PCD);
$this->insert_fmr_assetvalue($FCD,$PCD);
$this->insert_fmr_assetalloc($FCD,$PCD);

$this->insert_fmr_assetclass($FCD,$PCD);
$this->insert_fmr_tfc($FCD,$PCD);
$this->insert_fmr_commpaper($FCD,$PCD);
$this->insert_fmr_BankBalance($FCD,$PCD);
$this->insert_fmr_tdr($FCD,$PCD);
$this->insert_fmr_benchmark($FCD,$PCD);
$this->insert_fmr_FUNDRETURNS($FCD,$PCD);
$this->insert_fmr_NonCompliant($FCD,$PCD);
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






private function insert_portfolio(){
//Summary Portfolio Data

$query=$this->db->query("INSERT INTO dailyportfoliosummary(Foli_No,Fund_Code,Units1,Amount1,NAV_Date,Zakat_Status,Balance,InsertDateTime,InsertBy,FileName,UpdateBy) SELECT Foli_No,Fund_Code,Units1,Amount1,NAV_Date,Zakat_Status,Balance,InsertDateTime,InsertBy,FileName,'' FROM temp_dailyportfoliosummary");

// foreach ($query->result() as $qry_result)
//    {
//echo $row->title;
//echo $row->name;
//echo $row->body;
//  }
//      return $query->result();

}

private function insert_investor(){
//Invester Profile Data

$query=$this->db->query("INSERT INTO investoraccountinfo(Folio_No,ACC_TITLE,ACC_CNIC,ACC_CNICEXPIRYDATE,ACC_ZAKATSTATUS,ACC_TAXSTATUS,ACC_CGTSTATUS,ACC_EMAILADDRESS,ACC_SMSCELLNUMBER,ACC_ADDRESS,ACC_PHONE,ACC_RELATIONSHIPPERSONNAME,ACC_Type,ACC_Auth,ABA_ACCOUNTCODE,Bank_AccountTitle,Bank_Name,Branch_Address,dob,ACC_OPEN_DATE,InsertDateTime,InsertBy,FileName,UpdateBy) SELECT Folio_No,ACC_TITLE,ACC_CNIC,ACC_CNICEXPIRYDATE,ACC_ZAKATSTATUS,ACC_TAXSTATUS,ACC_CGTSTATUS,ACC_EMAILADDRESS,ACC_SMSCELLNUMBER,ACC_ADDRESS,ACC_PHONE,ACC_RELATIONSHIPPERSONNAME,ACC_Type,ACC_Auth,ABA_ACCOUNTCODE,Bank_AccountTitle,Bank_Name,Branch_Address,dob,ACC_OPEN_DATE,InsertDateTime,InsertBy,FileName,'' FROM temp_investoraccountinfo t ON DUPLICATE KEY UPDATE ACC_TITLE=t.ACC_TITLE,ACC_CNIC=t.ACC_CNIC,ACC_CNICEXPIRYDATE=t.ACC_CNICEXPIRYDATE,ACC_ZAKATSTATUS=t.ACC_ZAKATSTATUS,ACC_TAXSTATUS=t.ACC_TAXSTATUS,ACC_CGTSTATUS=t.ACC_CGTSTATUS,ACC_EMAILADDRESS=t.ACC_EMAILADDRESS,ACC_SMSCELLNUMBER=t.ACC_SMSCELLNUMBER,ACC_ADDRESS=t.ACC_ADDRESS,ACC_PHONE=t.ACC_PHONE,ACC_RELATIONSHIPPERSONNAME=t.ACC_RELATIONSHIPPERSONNAME,ACC_Type=t.ACC_Type,ACC_Auth=t.ACC_Auth,ABA_ACCOUNTCODE=t.ABA_ACCOUNTCODE,Bank_AccountTitle=t.Bank_AccountTitle,Bank_Name=t.Bank_Name,Branch_Address=t.Branch_Address,dob=t.dob,ACC_OPEN_DATE=t.ACC_OPEN_DATE,FileName = t.FileName,UpdateBy='Admin'");

}

private function insert_transaction(){
//TH Data

$query=$this->db->query("INSERT INTO transactionhistory(Folio_No,Transaction_ID,Trans_Type,Trans_Date,Trans_Time,Fund_short_Name,Fund_Name,Units,Amount,NAV,Created_On,CGT,sortOrder,InsertDateTime,InsertBy,FileName,UpdateBy) SELECT Folio_No,Transaction_ID,Trans_Type,Trans_Date,Trans_Time,Fund_short_Name,Fund_Name,Units,Amount,NAV,Created_On,CGT,sortOrder,InsertDateTime,InsertBy,FileName,'' FROM temp_transactionhistory");

}
private function update_importlog($ftype)
{

$data = array(
'importstatus' =>'P',
'remarks' => 'Data Updated to Actual Database',
);

$this->db->where('filetype', $ftype);
$this->db->where('importstatus', "S");
$this->db->update('import', $data); 

unset($data);

$data = array(
'filetype' => $ftype,
'filename' =>'',
'noofrecords' =>0,
'importby' =>'',
'importstatus' =>'P',
'remarks' => 'Data Updated to Actual Database',
);
$this->db->insert('importhistory', $data);

}

public function display($ftype){






echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully processed the data')
window.location.href='../../Admin/upload_data';
</SCRIPT>");

}


public function process_transaction(){

$cur_date= date("Y-m-d");
$cur_time= date("h:i:s");
$by= $_SESSION['Email'];
$ip= $_SERVER['REMOTE_ADDR'];

$data = array(
'Process_IP' => $ip,
'PreviousStatus' => "A",
'Process_By' => $by,
'Process_Date' => $cur_date,
'Process_Time' => $cur_time,
'Status' => "O",
);
$this->db->where('Status', "A");
$this->db->update('transactionrequest', $data); 

$this->load->model('Customer_panel');
$this->Customer_panel->process_transaction_log();


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully Process Now')
window.location.href='../../admin/transaction';
</SCRIPT>");


}



public function process_contact_info(){

$cur_date= date("Y-m-d");
$cur_time= date("h:i:s");
$by= $_SESSION['Email'];
$ip= $_SERVER['REMOTE_ADDR'];

$data = array(
'Process_IP' => $ip,
'PreviousStatus' => "A",
'Process_By' => $by,
'Process_Date' => $cur_date,
'Process_Time' => $cur_time,
'Status' => "O",
);
$this->db->where('status', "A");
$this->db->update('contactinformation', $data); 

$this->load->model('Customer_panel');
$this->Customer_panel->process_contactinfo_log();


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully Process Now')
window.location.href='../../admin/contact_info';
</SCRIPT>");


}


public function process_bank_info(){

$cur_date= date("Y-m-d");
$cur_time= date("h:i:s");
$by= $_SESSION['Email'];
$ip= $_SERVER['REMOTE_ADDR'];

$data = array(
'Process_IP' => $ip,
'PreviousStatus' => "A",
'Process_By' => $by,
'Process_Date' => $cur_date,
'Process_Time' => $cur_time,
'Status' => "O",
);
$this->db->where('status', "A");
$this->db->update('bankinformation', $data); 

$this->load->model('Customer_panel');
$this->Customer_panel->process_bankinfo_log();


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successfully Process Now')
window.location.href='../../admin/bank_info';
</SCRIPT>");


}

public function pagination_transaction()
{

$config['base_url'] = site_url('Admin/transaction');
$config['total_rows'] = $this->db->count_all('transactionrequest');
$config['per_page'] = "10";
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
$data['deptlist'] = $this->Pagination_transaction->get_transaction_lists($config["per_page"], $data['page']);           

$data['pagination'] = $this->pagination->create_links();

//load the department_view
$this->load->view('transaction',$data);
}


public function admin_users(){
$this->load->view('admin/admins');

}
public function update_user_profile(){
$new_email= $_POST['email'];
$new_type= $_POST['type_admin'];
$new_status= $_POST['status'];
$admin_id= $_POST['user_id'];

$data = array(
'Email' => $new_email,
'UserTyoe' => $new_type,
'status' => $new_status,
);
//print_r($data);exit;
$this->db->where('adminid', $admin_id);
$this->db->update('admin', $data); 

$this->load->model('Customer_panel');
$this->Customer_panel->admin_profile_update_log();


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Profile Updated')
window.location.href='../admin/admin_users';
</SCRIPT>");


}    


public function update_user_password(){
$new_pass= $_POST['newpass'];
$new_encr_pass= md5($_POST['newpass']);
$admin_id= $_POST['user_id'];

$data = array(
'Password' => $new_encr_pass,
);
//print_r($data);exit;
$this->db->where('adminid', $admin_id);
$this->db->update('admin', $data); 

$this->load->model('Customer_panel');
$this->Customer_panel->admin_profile_passupdate_log();


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Password Updated')
window.location.href='../admin/admin_users';
</SCRIPT>");

}


public function create_admin(){
$email= $_POST['email'];
$pass= $_POST['pass'];
$admin_type= $_POST['type'];

$this->db->select('*');
$this->db->where('Email',$email);
$result = $this->db->get('admin')->result_array();		
//echo $result[0]['Email'];

if(!empty($result[0]['Email'])){	        
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('This email id is already registered.')
window.location.href='../admin/admin_users';
</SCRIPT>");

}

else{
//echo "not exist";

$this->load->model('Customer_panel');
$this->Customer_panel->created_new_admin_log();            

$this->load->model('Customer_panel');
$this->Customer_panel->created_admin_log();            


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('New admin successfully created now')
window.location.href='../admin/admin_users';
</SCRIPT>");


}
exit;

}


public function activitylog(){
$this->load->view('admin/log');
}
public function upload_data(){
$this->load->view('admin/upload_data');
}    

}
