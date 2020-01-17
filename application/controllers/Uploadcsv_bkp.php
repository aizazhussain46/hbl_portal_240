<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadcsv extends CI_Controller {

public function __construct()
{
    parent::__construct();
    $this->load->helper('url');                    
    $this->load->model('Welcome_model','welcome');
}

public function index()
{
    $this->data['view_data']= $this->welcome->view_data();
  $this->load->view('upload_data', $this->data, FALSE);
}

public function importbulkemail(){
    $this->load->view('upload_data');
}

public function import(){

 if(isset($_POST["import"]))
  {
      $import_type= $_POST['import_type'];
      //exit;
      $filename=$_FILES["file"]["tmp_name"];

      if($_FILES["file"]["size"] > 0)
        {
           if($import_type == "portfolio"){
               
               $this->db->from('temp_dailyportfoliosummary'); 
               $this->db->truncate(); 
//exit;
               $file = fopen($filename, "r");
               
               $x = 1; //header top row
               $result = 0;   //OK
               while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
               {
                   if($x==1)
                   {
                   //header top row
                        if($importdata[0]=="Foli_No" 
                        && $importdata[1]=="Fund_Code" 
                        && $importdata[2]=="Units1" 
                        && $importdata[3]=="AMOUNT1" 
                        && $importdata[4]=="NAV_Date" 
                        && $importdata[5]=="Zakat_Status" 
                        && $importdata[6]=="Balance"
                        )
                           {
                            //Header matched                     
                           }
                           else
                           {
                                
                                $result = 1;
                                break;
  
                           }
                   
                   }
                   
                   else
                   {
                          //$originalDate = '2018-01-06';
                         //$originalDate = $importdata[4];
                         
                         //$navDate = date("Y-m-d", strtotime($importdata[4]));
                         
                         
                          
                          $data = array(
                          'Foli_No' => $importdata[0],
                          'Fund_Code' =>$importdata[1],
                          'Units1' => $importdata[2],
                          'Amount1' => $importdata[3],
                          //'NAV_Date' => $importdata[4],
                          'NAV_Date' => date("Y-m-d", strtotime($importdata[4])),
                          'Zakat_Status' => $importdata[5],
                          'Balance' => $importdata[6],
                         // 'InsertDateTime' => '', auto
                          'InsertBy' => $_SESSION['SessionID'],
                          'FileName' => $_FILES["file"]["name"],
                            );
                        $insert = $this->welcome->insert_dailyportfoliosummary($data);
                   }
               
               $x++;
               
               }
           }  
           
           elseif($import_type == "investor"){
               
               $this->db->from('temp_investoraccountinfo'); 
               $this->db->truncate(); 
//exit;
               $file = fopen($filename, "r");
               
               $x = 1; //header top row
               $result = 0;   //OK
               while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
               {
                   if($x==1)
                   {
                       
                  //     Folio_No	ACC_TITLE	ACC_CNIC	ACC_CNICEXPIRYDATE	ACC_ZAKATSTATUS	ACC_TAXSTATUS	ACC_CGTSTATUS	ACC_EMAILADDRESS	ACC_SMSCELLNUMBER	ACC_ADDRESS	ACC_PHONE	ACC_RELATIONSHIPPERSONNAME	ACC_TYPE	ACC_Auth	ABA_ACCOUNTCODE	Bank_AccountTitle	Bank_Name	Branch_Address	ACC_DOB

                       
                       
                   //header top row
                        if($importdata[0]=="Folio_No" 
                        && $importdata[1]=="ACC_TITLE" 
                        && $importdata[2]=="ACC_CNIC" 
                        && $importdata[3]=="ACC_CNICEXPIRYDATE" 
                        && $importdata[4]=="ACC_ZAKATSTATUS" 
                        && $importdata[5]=="ACC_TAXSTATUS" 
                        && $importdata[6]=="ACC_CGTSTATUS"
                        && $importdata[7]=="ACC_EMAILADDRESS"
                        && $importdata[8]=="ACC_SMSCELLNUMBER"
                        && $importdata[9]=="ACC_ADDRESS"
                        && $importdata[10]=="ACC_PHONE"
                        && $importdata[11]=="ACC_RELATIONSHIPPERSONNAME"
                        && $importdata[12]=="ACC_TYPE"
                        && $importdata[13]=="ACC_Auth"
                        && $importdata[14]=="ABA_ACCOUNTCODE"
                        && $importdata[15]=="Bank_AccountTitle"
                        && $importdata[16]=="Bank_Name"
                        && $importdata[17]=="Branch_Address"
                        && $importdata[18]=="ACC_DOB"
                        //&& $importdata[19]=="ACC_OPEN_DATE"
                        
                        )
                           {
                            //Header matched                     
                           }
                           else
                           {
                                
                                $result = 1;
                                break;
  
                           }
                   
                   }
                   
                   else
                   {
                          $insDate = '2018-01-06';
                          
                          $data = array(
                            'Folio_No' => $importdata[0],
                        'ACC_TITLE' => $importdata[1], 
                        'ACC_CNIC' => $importdata[2], 
                        'ACC_CNICEXPIRYDATE' => $importdata[3], 
                        'ACC_ZAKATSTATUS' => $importdata[4],
                        'ACC_TAXSTATUS' => $importdata[5], 
                        'ACC_CGTSTATUS' => $importdata[6],
                        'ACC_EMAILADDRESS' => $importdata[7],
                        'ACC_SMSCELLNUMBER' => ''+$importdata[8],
                        'ACC_ADDRESS' => $importdata[9],
                        'ACC_PHONE' => $importdata[10],
                        'ACC_RELATIONSHIPPERSONNAME' => $importdata[11],
                        'ACC_TYPE' => $importdata[12],
                        'ACC_Auth' => $importdata[13],
                        'ABA_ACCOUNTCODE' => ''+$importdata[14],
                        'Bank_AccountTitle' => $importdata[15],
                        'Bank_Name' => $importdata[16],
                        'Branch_Address' => $importdata[17],
                        'dob' => $importdata[18],
                        'ACC_OPEN_DATE' => '',
                        // 'InsertDateTime' => $insDate,
                          'InsertBy' => $_SESSION['SessionID'],
                          'FileName' => $_FILES["file"]["name"],
                            );
                        $insert = $this->welcome->insert_investoraccountinfo($data);
                   }
               
               $x++;
               
               }
           }
           
           elseif($import_type == "transaction"){
               
               $this->db->from('temp_transactionhistory'); 
               $this->db->truncate(); 
//exit;
               $file = fopen($filename, "r");
               
               $x = 1; //header top row
               $result = 0;   //OK
               while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
               {
                   if($x==1)
                   {
                       
                   //header top row
                        if($importdata[0]=="Folio_No" 
                        && $importdata[1]=="Transaction_ID" 
                        && $importdata[2]=="Trans_Type" 
                        && $importdata[3]=="Trans_Date" 
                        && $importdata[4]=="Trans_Time" 
                        && $importdata[5]=="Fund_short_Name" 
                        && $importdata[6]=="Fund_Name" 
                        && $importdata[7]=="Units" 
                        && $importdata[8]=="Amount" 
                        && $importdata[9]=="NAV" 
                        && $importdata[10]=="Created_On" 
                        && $importdata[11]=="CGT" 
                        && $importdata[12]=="sortOrder"
                        )
                           {
                            //Header matched                     
                           }
                           else
                           {
                                
                                $result = 1;
                                break;
  
                           }
                   
                   }
                   
                   else
                   {
                          $txnDate = '2018-01-06';
                          $crtDate = '2018-01-06';
                          
                          $data = array(
                          'Folio_No' => $importdata[0],
                          'Transaction_ID' =>$importdata[1],
                          'Trans_Type' => $importdata[2],
                          //'Trans_Date' => $importdata[3],
                          'Trans_Date' => date("Y-m-d", strtotime($importdata[3])),
                          
                          'Trans_Time' => date("H:i:s", strtotime($importdata[4])),
                          'Fund_short_Name' => $importdata[5],
                          'Fund_Name' => $importdata[6],
                          'Units' => $importdata[7],
                          'Amount' => $importdata[8],
                          'NAV' => $importdata[9],
                          'Created_On' => date("Y-m-d H:i:s", strtotime($importdata[10])),
                          'CGT' => $importdata[11],
                          'sortOrder' => $importdata[12],
                          //'InsertDateTime' => '',
                          'InsertBy' => $_SESSION['SessionID'],
                          'FileName' => $_FILES["file"]["name"],
                            );
                        $insert = $this->welcome->insert_transactionhistory($data);
                   }
               
               $x++;
               
               }
           }
           
                      
           
          fclose($file);
          
          
          if($result == 0)
          {
            $this->session->set_flashdata('message', 'Import Data Successfully.');  
          }
          else
          {
              $this->session->set_flashdata('message', 'Import Data Failed. Header not matched.');
          }
            
            redirect('Admin/upload_data');
        }
        else{
            $this->session->set_flashdata('message', 'Data file not selected.');
            redirect('Admin/upload_data');
    }
  }
}

}
