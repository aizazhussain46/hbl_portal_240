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
           		$this->Customer_panel->addNewUser();
				
				
				if(!empty($resultname[0]['Invester_Name'])){
				    $insester_name= $resultname[0]['Invester_Name'];
				}
				if(empty($resultname[0]['Invester_Name'])){
				    $insester_name= "Customer";
				}
                //EXIT;
				include 'email/class.phpmailer.php';
				include 'email/PHPMailerAutoload.php';

				$mail = new PHPMailer;
				///
			//	$mail->IsSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'sg2plcpnl0151.prod.sin2.secureserver.net';                 // Specify main and backup server
				$mail->Port = 465;                                    // Set the SMTP port
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'info@sundabiz.com';                // SMTP username
				$mail->Password = 'osamabaqi';                  // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
				/////
				$mail->From = 'noreply@hblasset.com';
				$mail->FromName = 'HBL Asset';
				//$mail->AddAddress($email,'HBL');  // Add a recipient \\ 
				$mail->AddAddress($emailadd,'HBL Assets');  // Add a recipient \\ 

				$mail->IsHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'HBL Asset Management - Successful Registration';

				$mail->Body    = '<br>
				        <h4>Dear '.$insester_name.',</h4>
				        <p>HBL Asset Management welcomes you to its Online Services Portal. Please login at <URL of Login page here> by using the following credentials. It is highly advised to change the Password provided to you on your first login on the portal.</p>

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
						</table><br>				    
						<p>Thank you for using our services.</p>    
				        <br><br>
				        <p><b>HBL Asset Management Team</b></p>
				        <p>www.hblassets.com</p>
				        <p>UAN: 021-111-225-262</p>
				        <p>Fax: 021-99207409, 021-99207407</p>

				';

				$mail->AltBody = '';

				if(!$mail->Send()) {
				   echo 'Message could not be sent.';
				   echo 'Mailer Error: ' . $mail->ErrorInfo;
				   exit;
				}
				else  {
				error_reporting(0);
				
				
				echo "<script>alert('Thank you for registration. Your account was created successully now. Account credentials send from your email address. Please check your email and then login');</script>";
				$this->session->sess_destroy();

           		echo'<script>window.location.href = "../Customer";</script>';	
			}
//            echo'<script>window.location.href = "../Customer";</script>';	
		}


	}
	public function check_registration()
	{

		 $title= $_POST['accountTitle'];
		 $cnic= $_POST['cnic'];
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
		//$loginid= $_POST['loginid'];
		$change_dob_format= explode("-",$_POST['dob']);

	    //$dob= ltrim($change_dob_format[1], '0').'/'.$change_dob_format[2].'/'.$change_dob_format[0];
	    $dob= ltrim($change_dob_format[1], '0').'/'.$change_dob_format[2].'/'.$change_dob_format[0];

		$this->db->select('*');
		$this->db->where('Folio_No',$reg_folio);
		$accountinfo = $this->db->get('investoraccountinfo')->result_array();		
		$ACC_TITLE= $accountinfo[0]['ACC_TITLE'];
	    $ACC_CNIC= $accountinfo[0]['ACC_CNIC'];
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
			$dob != $dob_db) {
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
		$dob == $dob_db
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

         //$recipient = $mobile;
         $recipient = $ACC_SMSCELLNUMBER;
        $messagedata = "Your%20OTP%20is%20".$_charcode."%20to%20complete%20your%20registration%20request.%20This%20OTP%20will%20expire%20after%205%20minutes.";
        //////////////////////////////////////////////
        $url = "https://rizwaanahmed.000webhostapp.com/hblsms.php?recipient={$recipient}&messagedata={$messagedata}";
        //print($url);exit;
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
        //exit;
        
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
		
		
		//$recipient = $mobilenum;
		$recipient = $mobileno;
		$messagedata= "Your%20OTP%20is%20".$_charcode."%20to%20complete%20your%20registration%20request.%20This%20OTP%20will%20expire%20after%205%20minutes.";
        //////////////////////////////////////////////
        $url = "https://rizwaanahmed.000webhostapp.com/hblsms.php?recipient={$recipient}&messagedata={$messagedata}";
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

		
		
		
		
			
		//	$Messages= "Your%20OTP%20is%20".$_charcode."%20to%20complete%20your%20registration%20request.%20This%20OTP%20will%20expire%20after%205%20minutes.";
				//$numbersms= "923012480333";

		//	file_get_contents('http://smsctp1.eocean.us:24555/api?action=sendmessage&username=9300_HBL2&password=HbL321456&recipient='.$mobile.'&originator=9300&messagedata='.$Messages);

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

				include 'email/class.phpmailer.php';
				include 'email/PHPMailerAutoload.php';

				$mail = new PHPMailer;
				
				///
			//	$mail->IsSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'sg2plcpnl0151.prod.sin2.secureserver.net';                 // Specify main and backup server
				$mail->Port = 465;                                    // Set the SMTP port
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'info@sundabiz.com';                // SMTP username
				$mail->Password = 'osamabaqi';                  // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
				/////
				$mail->From = 'noreply@hblasset.com';
				$mail->FromName = 'HBL Asset';
				//$mail->AddAddress($email,'HBL');  // Add a recipient \\ 
				$mail->AddAddress($insester_email,'HBL Assets');  // Add a recipient \\ 

				$mail->IsHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'HBL Asset Management - Password Reset';
				$mail->Body    = '<br>
				        <h4>Dear Customer,</h4>
				        <p>Your password successfully changed now. Your new password details are the followng:</p>

						<table width="600" border="1" cellpadding="5" cellspacing="0" bordercolor="#00a997" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#00a997 !important;">
						  <tr> 
						    <td colspan="2" height="25" bgcolor="00a997"><font color="#FFFFFF" size="-1" face="Arial, Helvetica, sans-serif"><strong>Login Details</strong></font></td>
						  </tr>
							<tr>
								<td width="300"><p><font size="-1">User ID</font></p></td>
								<td width="300"><p><font size="-1">'.$aaa.'</font></p></td>
							</tr>
							<tr>
								<td width="300"><p><font size="-1">Password</font></p></td>
								<td width="300"><p><font size="-1">'.$neworignalpass.'</font></p></td>
							</tr>
						</table><br>				    
						<p>Thank you for using our services.</p>    
				        <br><br>
				        <p><b>HBL Asset Management Team</b></p>
				        <p>www.hblassets.com</p>
				        <p>UAN: 021-111-225-262</p>
				        <p>Fax: 021-99207409, 021-99207407</p>

				';

				$mail->AltBody = '';

				if(!$mail->Send()) {
				   echo 'Message could not be sent.';
				   echo 'Mailer Error: ' . $mail->ErrorInfo;
				   exit;
				}
				else  {
				error_reporting(0);
				
				
				echo "<script>alert('Your account was reset now. Account credentials send from your email address. Please check your email and then login');</script>";
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
			
			//$Messages= "Your%20OTP%20is%20".$_charcode."%20to%20complete%20your%20registration%20request.%20This%20OTP%20will%20expire%20after%205%20minutes.";
				//$numbersms= "923012480333";

               // $recipientss = $_SESSION['emailinput'];
                $recipientss = $mobilesms;
                $messagedatass = "Your%20OTP%20is%20".$_charcode."%20to%20change%20your%20password%20request.%20This%20OTP%20will%20expire%20after%205%20minutes.";
                //////////////////////////////////////////////
                $url = "https://rizwaanahmed.000webhostapp.com/hblsms.php?recipient={$recipientss}&messagedata={$messagedatass}";
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

		//	file_get_contents('http://smsctp1.eocean.us:24555/api?action=sendmessage&username=9300_HBL2&password=HbL321456&recipient='.$mobile.'&originator=9300&messagedata='.$Messages);

			$this->load->library("session");

            $this->session->set_userdata("otp","$_charcode");
			$this->session->userdata("otp");
            echo'<script>window.location.href = "../Customer/confirm_forgotpass";</script>';


	}








}
