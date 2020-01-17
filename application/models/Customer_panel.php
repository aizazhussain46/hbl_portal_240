<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_panel extends CI_Model {


        public function requestTransfer()
        {
           date_default_timezone_set("Asia/Karachi");

            if ($this->input->post('r1') == "R") {
                
		        if ($this->input->post('selectopt') == "Amount") {
                
                    $data = array(
                        'FolioNo' => $this->input->post('folio'),
                        'RequestType' => 'R',
                        'Source_Fund_Code' => '0',
                        'Dest_Fund_Code' => $this->input->post('redFROM'),
                        'RequestAmount' => $this->input->post('amount'),
                        'RequestUnit' => '1',
                        'RequestDate' => date('Y/m/d'),
                        'RequestTime' => date('H:i:s'),
                        'ReferenceID' => uniqid(),
                        'Status' => 'P',
                        'Remarks' => 'Successful',
                        'InsertDate' => date('Y/m/d'),
                        'InsertTime' => date('H:i:s'),
                        'InsertBy' => 'Customer',
                        'UpdateDate' => date('Y/m/d'),
                        'UpdateTime' => date('H:i:s'),
                        'UpdateBy' => 'Customer',
                        'UpdateStatus' => 'T',
                        'CurrentBalance' => '0',
                        'CurrentUnits' => '0',
                        'LimitAllowed' => '0',
                        'TOCAcceptance' => '0',
                        'paymentmode' => '0',
                        'bankname' => '0',
                        'accountnumber' => '0',
                        'cheque_intrument_no' => '0',
                        'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
                        
                    );
		        }
		        if ($this->input->post('selectopt') == "All") {
                
    			$newam=   $this->input->post('redFROM');
                $ex_get_amount= explode("|" ,$newam );
				$get_amout= $ex_get_amount[1];


                    $data = array(
                        'FolioNo' => $this->input->post('folio'),
                        'RequestType' => 'R',
                        'Source_Fund_Code' => '0',
                        'Dest_Fund_Code' => $this->input->post('redFROM'),
                        'RequestAmount' => $get_amout,
                        'RequestUnit' => 'All',
                        'RequestDate' => date('Y/m/d'),
                        'RequestTime' => date('H:i:s'),
                        'ReferenceID' => uniqid(),
                        'Status' => 'P',
                        'Remarks' => 'Successful',
                        'InsertDate' => date('Y/m/d'),
                        'InsertTime' => date('H:i:s'),
                        'InsertBy' => 'Customer',
                        'UpdateDate' => date('Y/m/d'),
                        'UpdateTime' => date('H:i:s'),
                        'UpdateBy' => 'Customer',
                        'UpdateStatus' => 'T',
                        'CurrentBalance' => '0',
                        'CurrentUnits' => '0',
                        'LimitAllowed' => '0',
                        'TOCAcceptance' => '0',
                        'paymentmode' => '0',
                        'bankname' => '0',
                        'accountnumber' => '0',
                        'cheque_intrument_no' => '0',
                        'Requestor_IP' => $_SERVER['REMOTE_ADDR'],

                    );
                   // print_r($date);exit;
		        }		        
		        
		        
		        
            }

            if ($this->input->post('r1') == "T") {
               if ($this->input->post('selectopt') == "Amount") {
                    $data = array(
                    'FolioNo' => $this->input->post('folio'),
                    'RequestType' => 'T',
                    'Source_Fund_Code' => $this->input->post('conTo'),
                    'Dest_Fund_Code' => $this->input->post('conFrom'),
                    'RequestAmount' => $this->input->post('amount'),
                    'RequestUnit' => '1',
                    'RequestDate' => date('Y/m/d'),
                    'RequestTime' => date('H:i:s'),
                    'ReferenceID' => uniqid(),
                    'Status' => 'P',
                    'Remarks' => 'Successful',
                    'InsertDate' => date('Y/m/d'),
                    'InsertTime' => date('H:i:s'),
                    'InsertBy' => 'Customer',
                    'UpdateDate' => date('d/m/Y'),
                    'UpdateTime' => date('H:i:s'),
                    'UpdateBy' => 'Customer',
                    'UpdateStatus' => 'T',
                    'CurrentBalance' => '0',
                    'CurrentUnits' => '0',
                    'LimitAllowed' => '0',
                    'TOCAcceptance' => '0',
                    'paymentmode' => '0',
                    'bankname' => '0',
                    'accountnumber' => '0',
                    'cheque_intrument_no' => '0',
                    'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
                     );
                }     
               if ($this->input->post('selectopt') == "All") {
                   
                $newam=   $this->input->post('conTo');
                $ex_get_amount= explode("|" ,$newam );
				$get_amout= $ex_get_amount[1];
				
                    $data = array(
                    'FolioNo' => $this->input->post('folio'),
                    'RequestType' => 'T',
                    'Source_Fund_Code' => $this->input->post('conTo'),
                    'Dest_Fund_Code' => $this->input->post('conFrom'),
                    'RequestAmount' => $get_amout,
                    'RequestUnit' => 'All',
                    'RequestDate' => date('Y/m/d'),
                    'RequestTime' => date('H:i:s'),
                    'ReferenceID' => uniqid(),
                    'Status' => 'P',
                    'Remarks' => 'Successful',
                    'InsertDate' => date('Y/m/d'),
                    'InsertTime' => date('H:i:s'),
                    'InsertBy' => 'Customer',
                    'UpdateDate' => date('d/m/Y'),
                    'UpdateTime' => date('H:i:s'),
                    'UpdateBy' => 'Customer',
                    'UpdateStatus' => 'T',
                    'CurrentBalance' => '0',
                    'CurrentUnits' => '0',
                    'LimitAllowed' => '0',
                    'TOCAcceptance' => '0',
                    'paymentmode' => '0',
                    'bankname' => '0',
                    'accountnumber' => '0',
                    'cheque_intrument_no' => '0',
                    'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
                    
                     );
                }     
                 
                 
                 
            }

            if ($this->input->post('r1') == "I") {
                
                $data = array(
                'FolioNo' => $this->input->post('folio'),
                'RequestType' => 'I',
                'Source_Fund_Code' => '0',
                'Dest_Fund_Code' => $this->input->post('funName'),
                'RequestAmount' => $this->input->post('tamount'),
                'RequestUnit' => '1',
                'RequestDate' => date('Y/m/d'),
                'RequestTime' => date('H:i:s'),
                'ReferenceID' => uniqid(),
                'Status' => 'P',
                'Remarks' => 'Successful',
                'InsertDate' => date('Y/m/d'),
                'InsertTime' => date('H:i:s'),
                'InsertBy' => 'Customer',
                'UpdateDate' => date('Y/m/d'),
                'UpdateTime' => date('H:i:s'),
                'UpdateBy' => 'Customer',
                'UpdateStatus' => 'T',
                'CurrentBalance' => '0',
                'CurrentUnits' => '0',
                'LimitAllowed' => '0',
                'TOCAcceptance' => '0',
                'paymentmode' => $this->input->post('selpayment'),
                'bankname' => $this->input->post('bname'),
                'accountnumber' => $this->input->post('ban'),
                'cheque_intrument_no' => $this->input->post('cinum'),
                'Requestor_IP' => $_SERVER['REMOTE_ADDR'],

                 );
            }

        // users is the name of the db table you are inserting in
            return $this->db->insert('transactionrequest', $data);
        }

        public function transaction_record_activitylog()
        {
        if ($this->input->post('r1') =="R") {
        }
        else if ($this->input->post('r1') =="T") {
            $data = array(
                'ActivityDate' => date('d/m/Y'),
                'ActivityTime' => date('H:i:s'),
                'description' => 'New Request Transaction - Conversion',
                'status' => 'Successful -'.uniqid(),
                'Folio_No' => $_SESSION['folio'],
				'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
            );
        }     
        else if ($this->input->post('r1') =="I") {
            $data = array(
                'ActivityDate' => date('d/m/Y'),
                'ActivityTime' => date('H:i:s'),
                'description' => 'New Request Transaction - Investment',
                'status' => 'Successful -'.uniqid(),
                'Folio_No' => $_SESSION['folio'],
				'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
            );
        }     

        return $this->db->insert('activitylog', $data);
        }

				public function contactrequest()
        {
		//**************13 June 2018**************************/

        $data = array(
            'Folio_No' => $this->input->post('folio'),
            'phone' => '',
            'cell' => $this->input->post('cell'),
            'email' => $this->input->post('email'),
            'message' => $this->input->post('msg'),
			'RequestDate' => date('Y/m/d'),
            'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
			
        );

        return $this->db->insert('contactrequest', $data);
        }
		
		public function requestconreqlog()
        {
		//**************13 June 2018**************************/

        date_default_timezone_set("Asia/Karachi");
        $data = array(
            'ActivityDate' => date('d/m/Y'),
            'ActivityTime' => date('H:i:s'),
            'description' => 'Contact Request - Investment Advisor',
            'status' => 'Successful',
            'Folio_No' => $this->input->post('folio'),
			'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('activitylog', $data);
        }
		
		
        public function addloginData()
        {
        date_default_timezone_set("Asia/Karachi");

            
        $data = array(
            'ActivityDate' => date('d/m/Y'),
            'ActivityTime' => date('H:i:s'),
            'description' => 'Logged In',
            'status' => 'Successful',
            'Folio_No' => 6604, //$_SESSION['folio'],
			'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('activitylog', $data);
        }

        public function addlogutData()
        {
        date_default_timezone_set("Asia/Karachi");
        $data = array(
            'ActivityDate' => date('d/m/Y'),
            'ActivityTime' => date('H:i:s'),
            'description' => 'Logged Out',
            'status' => 'Successful',
            'Folio_No' => $_SESSION['folio'],
			'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('activitylog', $data);
        }

        public function addWronglogin()
        {
        date_default_timezone_set("Asia/Karachi");
        $data = array(
            'ActivityDate' => date('d/m/Y'),
            'ActivityTime' => date('H:i:s'),
            'description' => 'Logged In',
            'status' => 'Failed',
            'Folio_No' => $this->input->post('folio'),
			'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('activitylog', $data);
        }


        public function changepassword()
        {
        date_default_timezone_set("Asia/Karachi");
        $data = array(
            'ActivityDate' => date('d/m/Y'),
            'ActivityTime' => date('H:i:s'),
            'description' => 'Password Changed',
            'status' => 'Successfull',
            'Folio_No' => $_SESSION['folio'],
			'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('activitylog', $data);
        }


        public function forgot_password_log()
        {
        date_default_timezone_set("Asia/Karachi");
        $data = array(
            'ActivityDate' => date('d/m/Y'),
            'ActivityTime' => date('H:i:s'),
            'description' => 'Password Reset',
            'status' => 'Successfull',
            'Folio_No' => $_SESSION['loginid'],
			'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('activitylog', $data);
        }

        public function requestconinfolog()
        {
        date_default_timezone_set("Asia/Karachi");
        $data = array(
            'ActivityDate' => date('d/m/Y'),
            'ActivityTime' => date('H:i:s'),
            'description' => 'Change Request - Contact Information',
            'status' => 'Successful',
            'Folio_No' => $this->input->post('folio'),
			'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('activitylog', $data);
        }

        public function requestbankinfolog()
        {
        date_default_timezone_set("Asia/Karachi");
        $data = array(
            'ActivityDate' => date('d/m/Y'),
            'ActivityTime' => date('H:i:s'),
            'description' => 'Change Request - Bank Information',
            'status' => 'Successful',
            'Folio_No' => $this->input->post('folio'),
			'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
			
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('activitylog', $data);
        }
        public function blockaccount()
        {
        date_default_timezone_set("Asia/Karachi");
        $data = array(
            'ActivityDate' => date('d/m/Y'),
            'ActivityTime' => date('H:i:s'),
            'description' => 'Logged In',
            'status' => 'System Request User ID is Disable',
            'Folio_No' => $this->input->post('folio'),
			'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('activitylog', $data);
        }
        public function contactinformation()
        {
        $data = array(
            'Folio_No' => $this->input->post('folio'),
            'phone' => $this->input->post('phone'),
            'cell' => $this->input->post('cell'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
			'RequestDate' => date('Y/m/d'),
            'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        return $this->db->insert('contactinformation', $data);
        }

        public function bankinformations()
        {
        $data = array(
            'Folio_No' => $this->input->post('folio'),
            'accountnumber' => $this->input->post('accountnumber'),
            'accounttitle' => $this->input->post('accounttitle'),
            'bankname' => $this->input->post('bankname'),
            'address' => $this->input->post('address'),
			'RequestDate' => date('Y/m/d'),
            'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
            
        );

        return $this->db->insert('bankinformation', $data);
        }


        public function addNewUser()
        {
           
        $data = array(
            'UserID' => $_SESSION['Folio_No'],
            'Password' => md5($this->input->post('newpass')),
            'Folio_No' => $_SESSION['Folio_No'],
            'UserType' => 'CST',
            'Status' => 'A',
            'InsertDate' => date('Y/m/d'),
            'InsertTime' => date('H:i:s'),
            'InsertBy' => 'Customer',
            'UpdateDate' => date('Y/m/d'),
            'UpdateTime' => date('H:i:s'),            
            'UpdateBy' => 'Customer',
            'WrongPassword' => '0',
            'checked' => 1,
        );
        //print_r($data);exit;
        // users is the name of the db table you are inserting in
        return $this->db->insert('user', $data);
        }

        public function deactive_account_log()
        {
        $data = array(
            'ActivityTable' => "User",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Deactivate Customer Account",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $this->uri->segment('3'),
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }

        public function active_account_log()
        {

        $data = array(
            'ActivityTable' => "User",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Activate Customer Account",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $this->uri->segment('3'),
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }
        
        public function login_account_log()
        {

        $data = array(
            'ActivityTable' => "Admin",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Login",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => "0"
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }        
        
        public function reject_transaction()
        {
        $this->db->select('*');
        $this->db->where('id',$_POST['trans_id']);
        $result_fol_id = $this->db->get('transactionrequest')->result_array();		

             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "TransactionRequest",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Reject Transaction",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $result_fol_id[0]['FolioNo'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }           
        

        public function reject_contactinfo()
        {
        $this->db->select('*');
        $this->db->where('id',$_POST['trans_id']);
        $result_fol_id = $this->db->get('contactinformation')->result_array();		

             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "ContactInfo",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Reject Contact Info",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $result_fol_id[0]['Folio_No'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }   




        public function reject_bank_info()
        {
        $this->db->select('*');
        $this->db->where('id',$_POST['trans_id']);
        $result_fol_id = $this->db->get('bankinformation')->result_array();		

             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "BankInfo",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Reject Bank Info",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $result_fol_id[0]['Folio_No'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }   




        public function authorize_transaction()
        {
        $this->db->select('*');
        $this->db->where('id',$_POST['trans_id']);
        $result_fol_id = $this->db->get('transactionrequest')->result_array();		

             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "TransactionRequest",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Authorize Transaction",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $result_fol_id[0]['FolioNo'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }           


   public function authorize_contactinfo()
        {
        $this->db->select('*');
        $this->db->where('id',$_POST['trans_id']);
        $result_fol_id = $this->db->get('contactinformation')->result_array();		

             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "ContactInfo",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Authorize Contact Info",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $result_fol_id[0]['Folio_No'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }         

        public function authorize_bank_info()
        {
        $this->db->select('*');
        $this->db->where('id',$_POST['trans_id']);
        $result_fol_id = $this->db->get('bankinformation')->result_array();		

             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "BankInfo",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Authorize Bank Info",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $result_fol_id[0]['Folio_No'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }   
        
        
        public function process_transaction_log()
        {
        $this->db->select('*');
        $this->db->where('PreviousStatus','A');
        $result_fol_id = $this->db->get('transactionrequest')->result_array();		

             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "TransactionRequest",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Process Transaction",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $result_fol_id[0]['FolioNo'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }   



        public function process_contactinfo_log()
        {
        $this->db->select('*');
        $this->db->where('PreviousStatus','A');
        $result_fol_id = $this->db->get('contactinformation')->result_array();		

             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "ContactInfo",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Process Contact Info",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => $result_fol_id[0]['Folio_No'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }   
        
        public function process_bankinfo_log()
        {
        $this->db->select('*');
        $this->db->where('PreviousStatus','A');
        $result_fol_id = $this->db->get('bankinformation')->result_array();		

             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "BankInfo",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Process Bank Info",
            'ID' =>$_SESSION['SessionID'],
            'FolioNo' => $result_fol_id[0]['Folio_No'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }           
        
        public function admin_profile_update_log()
        {
             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "Admin",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Admin Profile Updated",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => 0,
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }           
                
        public function admin_profile_passupdate_log()
        {
             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "Admin",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Admin Password Updated",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => 0,
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        }           
        
        public function created_admin_log()
        {
             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'ActivityTable' => "Admin",
            'ActivityBy' => $_SESSION['Email'],
            'ActivityDate' => date('Y/m/d'),
            'ActivityTime' =>date('h:i:s') ,
            'ActivityIP' => $_SERVER['REMOTE_ADDR'],
            'Activity' => "Created New User",
            'ID' => $_SESSION['SessionID'],
            'FolioNo' => 0,
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('AuditTrailAdmin', $data);
        } 

        public function created_new_admin_log()
        {
             //$result_fol_id[0]['FolioNo'];;exit;

        $data = array(
            'Email' => $_POST['email'],
            'Password' => md5($_POST['pass']),
            'UserTyoe' => $_POST['type'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('admin', $data);
        } 
        


    public function TransferRedemption()
        {
        $data = array(
                        'FolioNo' =>  $_SESSION['folio'],
                        'RequestType' => 'R',
                        'Source_Fund_Code' => '0',
                        'Dest_Fund_Code' => $_SESSION['RedFROM'],
                        'RequestAmount' => $_SESSION['RedAmount'],
                        'RequestUnit' => '0',
                        'RequestDate' => date('Y/m/d'),
                        'RequestTime' => date('H:i:s'),
                        'ReferenceID' => uniqid(),
                        'Status' => 'P',
                        'Remarks' => 'Successful',
                        'InsertDate' => date('Y/m/d'),
                        'InsertTime' => date('H:i:s'),
                        'InsertBy' => 'Customer',
                        'UpdateDate' => date('Y/m/d'),
                        'UpdateTime' => date('H:i:s'),
                        'UpdateBy' => 'Customer',
                        'UpdateStatus' => 'T',
                        'CurrentBalance' => '0',
                        'CurrentUnits' => '0',
                        'LimitAllowed' => '0',
                        'TOCAcceptance' => '0',
                        'paymentmode' => '0',
                        'bankname' => '0',
                        'accountnumber' => '0',
                        'cheque_intrument_no' => '0',
                        'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('transactionrequest', $data);
        }

        public function redemption_activitylog(){
        $data = array(
                'ActivityDate' => date('d/m/Y'),
                'ActivityTime' => date('H:i:s'),
                'description' => 'New Request Transaction - Redemption',
                'status' => 'Successful -'.uniqid(),
                'Folio_No' => $_SESSION['folio'],
				'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );
        
        return $this->db->insert('activitylog', $data);
        }
        
        
        
        
        
        
        
    public function TransferAllRedemption()
        {
        $data = array(
                        'FolioNo' =>  $_SESSION['folio'],
                        'RequestType' => 'R',
                        'Source_Fund_Code' => '0',
                        'Dest_Fund_Code' => $_SESSION['RedFROM'],
                        'RequestAmount' => 0,
                        'RequestUnit' => $_SESSION['RedAmount'],
                        'RequestDate' => date('Y/m/d'),
                        'RequestTime' => date('H:i:s'),
                        'ReferenceID' => uniqid(),
                        'Status' => 'P',
                        'Remarks' => 'Successful',
                        'InsertDate' => date('Y/m/d'),
                        'InsertTime' => date('H:i:s'),
                        'InsertBy' => 'Customer',
                        'UpdateDate' => date('Y/m/d'),
                        'UpdateTime' => date('H:i:s'),
                        'UpdateBy' => 'Customer',
                        'UpdateStatus' => 'T',
                        'CurrentBalance' => '0',
                        'CurrentUnits' => '0',
                        'LimitAllowed' => '0',
                        'TOCAcceptance' => '0',
                        'paymentmode' => '0',
                        'bankname' => '0',
                        'accountnumber' => '0',
                        'cheque_intrument_no' => '0',
                        'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('transactionrequest', $data);
        }

        public function allredemption_activitylog(){
            $data = array(
                    'ActivityDate' => date('d/m/Y'),
                    'ActivityTime' => date('H:i:s'),
                    'description' => 'New Request Transaction - Redemption',
                    'status' => 'Successful -'.uniqid(),
                    'Folio_No' => $_SESSION['folio'],
					'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
            );
            
            return $this->db->insert('activitylog', $data);
        }
        
        
        
        
        
        
        




    public function TransferConversion()
        {
        $data = array(
                        'FolioNo' =>  $_SESSION['folio'],
                        'RequestType' => 'T',
                        'Source_Fund_Code' => $_SESSION['ConTo'],
                        'Dest_Fund_Code' => $_SESSION['ConFROm'],
                        'RequestAmount' => $_SESSION['ConAmounts'],
                        'RequestUnit' => '0',
                        'RequestDate' => date('Y/m/d'),
                        'RequestTime' => date('H:i:s'),
                        'ReferenceID' => uniqid(),
                        'Status' => 'P',
                        'Remarks' => 'Successful',
                        'InsertDate' => date('Y/m/d'),
                        'InsertTime' => date('H:i:s'),
                        'InsertBy' => 'Customer',
                        'UpdateDate' => date('Y/m/d'),
                        'UpdateTime' => date('H:i:s'),
                        'UpdateBy' => 'Customer',
                        'UpdateStatus' => 'T',
                        'CurrentBalance' => '0',
                        'CurrentUnits' => '0',
                        'LimitAllowed' => '0',
                        'TOCAcceptance' => '0',
                        'paymentmode' => '0',
                        'bankname' => '0',
                        'accountnumber' => '0',
                        'cheque_intrument_no' => '0',
                        'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('transactionrequest', $data);
        }

        public function conversion_activitylog(){
            $data = array(
                    'ActivityDate' => date('d/m/Y'),
                    'ActivityTime' => date('H:i:s'),
                    'description' => 'New Request Transaction - Conversion',
                    'status' => 'Successful -'.uniqid(),
                    'Folio_No' => $_SESSION['folio'],
					'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
            );
            
            return $this->db->insert('activitylog', $data);
        }
      
        
        
        
        
    public function TransferConversionAll()
        {
        $data = array(
                        'FolioNo' =>  $_SESSION['folio'],
                        'RequestType' => 'T',
                        'Source_Fund_Code' => $_SESSION['ConTo'],
                        'Dest_Fund_Code' => $_SESSION['ConFROm'],
                        'RequestAmount' => 0,
                        'RequestUnit' => $_SESSION['ConAmounts'],
                        'RequestDate' => date('Y/m/d'),
                        'RequestTime' => date('H:i:s'),
                        'ReferenceID' => uniqid(),
                        'Status' => 'P',
                        'Remarks' => 'Successful',
                        'InsertDate' => date('Y/m/d'),
                        'InsertTime' => date('H:i:s'),
                        'InsertBy' => 'Customer',
                        'UpdateDate' => date('Y/m/d'),
                        'UpdateTime' => date('H:i:s'),
                        'UpdateBy' => 'Customer',
                        'UpdateStatus' => 'T',
                        'CurrentBalance' => '0',
                        'CurrentUnits' => '0',
                        'LimitAllowed' => '0',
                        'TOCAcceptance' => '0',
                        'paymentmode' => '0',
                        'bankname' => '0',
                        'accountnumber' => '0',
                        'cheque_intrument_no' => '0',
                        'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
        );

        // users is the name of the db table you are inserting in
        return $this->db->insert('transactionrequest', $data);
        }

        public function allconversion_activitylog(){
            $data = array(
                    'ActivityDate' => date('d/m/Y'),
                    'ActivityTime' => date('H:i:s'),
                    'description' => 'New Request Transaction - Conversion',
                    'status' => 'Successful -'.uniqid(),
                    'Folio_No' => $_SESSION['folio'],
					'Requestor_IP' => $_SERVER['REMOTE_ADDR'],
            );
            
            return $this->db->insert('activitylog', $data);
        }


        
        
        
        
        
}
?>