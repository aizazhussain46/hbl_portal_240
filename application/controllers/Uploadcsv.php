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

set_time_limit(0);  



 //    $this->session->set_flashdata('message', date('mY', strtotime('march2017'//)));
       //     redirect('Admin/upload_data');


 if(isset($_POST["import"]))
  {
      $import_type= $_POST['import_type'];
      //exit;
      $filename=$_FILES["file"]["tmp_name"];
set_time_limit(0);  

//50MB defined but limit error shows at 45MB just for controlling
//Rizwan Jan 2018
//php_value post_max_size 52428800
//php_value upload_max_filesize 52428800

 if ($_FILES['file']['size'] > 47185920) {
        //throw new RuntimeException('Exceeded filesize limit.');
     $this->session->set_flashdata('message', 'Sorry, File data size limit exceeded. Make the data file into parts limiting size upto 45 MB and try again.');
            redirect('Admin/upload_data');
     }

      if($_FILES["file"]["size"] > 0)
        {
           if($import_type == "portfolio"){
               
               $rst = $this->welcome->delete_importstagingstatus($import_type);
                
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
                          'InsertBy' => $_SESSION['Email'],
                          'FileName' => $_FILES["file"]["name"],
                            );
                        $insert = $this->welcome->insert_dailyportfoliosummary($data);
                        
                        
                   }
               
               $x++;
               
               }
               
               
               
               
               
           }  
           elseif($import_type == "investorxxxxxxxxxxxxx"){
               
               //Test Code
               
               $data = array(
                          'filetype' => $import_type,
                          'filename' =>$_FILES["file"]["name"],
                          'importby' =>$_SESSION['SessionID'],
                          'importstatus' =>'S',
                          'remarks' => 'Staging Data- Pending to Update in Actual Database',
                            );
                        $insert = $this->welcome->insert_importlog($data);
                        unset($data);
               //exit;
               $file = fopen($filename, "r");
               
               $x = 1; //header top row
               $result = 0;   //OK
               
               echo ini_get('upload_max_filesize');  
               echo '<BR>';  
               
               echo ini_get('max_execution_time');  
               echo '<BR>';
               echo ini_get('post_max_size');  
               echo '<BR>';
               echo ini_get('memory_limit');  
               echo '<BR>';
               echo ini_get('max_input_time'); 
               echo '<BR>';
               
               while (($importdata = fgetcsv($file, 1000, ",")) !== FALSE)
               {
                    echo($x."-");
                    $x++;
               }
           }
           elseif($import_type == "investor"){
               $rst = $this->welcome->delete_importstagingstatus($import_type);
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
                        && $importdata[19]=="ACC_OPEN_DATE"
                        
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
                        'ABA_ACCOUNTCODE' => $importdata[14],
                        'Bank_AccountTitle' => $importdata[15],
                        'Bank_Name' => $importdata[16],
                        'Branch_Address' => $importdata[17],
                        'dob' => $importdata[18],
                        'ACC_OPEN_DATE' => $importdata[19],
                        // 'InsertDateTime' => $insDate,
                          'InsertBy' => $_SESSION['Email'],
                          'FileName' => $_FILES["file"]["name"],
                            );
                        $insert = $this->welcome->insert_investoraccountinfo($data);
                   }
               
               $x++;
               
               }
           }
           
           elseif($import_type == "transaction"){
               
               $rst = $this->welcome->delete_importstagingstatus($import_type);
                
//exit;
               $file = fopen($filename, "r");
               
               $x = 1; //header top row
               $result = 0;   //OK
                
               
               while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
               {
                    set_time_limit(0);    
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
                          'InsertBy' => $_SESSION['Email'],
                          'FileName' => $_FILES["file"]["name"],
                            );
                        $insert = $this->welcome->insert_transactionhistory($data);
                        unset($data);
                   }
               unset($importdata);
               $x++;
               
               }
           }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////fmr////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

           elseif($import_type == "fmr"){
               
               $rst = $this->welcome->delete_importstagingstatus($import_type);
                
//exit;
               $file = fopen($filename, "r");
               
               $x = 1; //header top row
               $row = 1;
               $result = 0;   //OK
                
               
               while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
               {
                    set_time_limit(0);
                    
                   if($x==0)
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
                       //is_null
                       //$var_is_greater_than_two = ($var > 2 ? true : false);
                       
                       //(is_null($importdata[0])? $importdata[0] : '')
                       
                       
                       $colms = max(array_keys($importdata));
                       
                       
                       /**
    Convert excel file to csv
*/
//$excel_readers = array(
  //  'Excel5' , 
    //'Excel2003XML' , 
    //'Excel2007'
//);
//require_once('lib/PHPExcel/PHPExcel.php');
//$reader = PHPExcel_IOFactory::createReader('Excel5');
//$reader->setReadDataOnly(true);
//$path = 'data.xls';
//$excel = $reader->load($path);
//$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
//$writer->save('data.csv');
                        $mf=7;
                        $nf=0;                           
                        for ($i = 0; $i <= $mf; $i++) 
                        {
                            //echo "The number is: $nf <br>";
                            if(empty($importdata[$i])){
                                $importdata[$i] = '';
                                $nf++;
                            }
                        }

if($nf <=$mf){
    
                    if($row==1)
                   {
                     
                     
                     $importdata[1] = date('mY', strtotime($importdata[0]));
                     
                       
                   //header top row
                        if(1==1)
                           {
                            //Header matched                     
                           }
                           else
                           {
                                
                                $result = 1;
                                break;
  
                           }
                   
                   }        
    
    
                          $data = array(
                          'A1' => (!empty($importdata[0])? $importdata[0] : ''),
                          'B1' => (!empty($importdata[1])? $importdata[1] : ''),
                          'C1' => (!empty($importdata[2])? $importdata[2] : ''),
                          'D1' => (!empty($importdata[3])? $importdata[3] : ''),
                          'E1' => (!empty($importdata[4])? $importdata[4] : ''),
                          'F1' => (!empty($importdata[5])? $importdata[5] : ''),
                          'G1' => (!empty($importdata[6])? $importdata[6] : ''),
                          'H1' => (!empty($importdata[7])? $importdata[7] : ''),
                          'I1' => (!empty($importdata[8])? $importdata[8] : ''),
                          //'J1' => (!empty($importdata[9])? $importdata[9] : ''),
                          //'K1' => (!empty($importdata[10])? $importdata[10] : ''),
                          //'L1' => (!empty($importdata[11])? $importdata[11] : ''),
                            );
                            
                        $insert = $this->welcome->insert_fmr($data);
                        $row++;
}
                        unset($data);
                        
                   }
               unset($importdata);
               $x++;
               
               }
           }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////fmrdata////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

           elseif($import_type == "fmrdata"){
               
               $rst = $this->welcome->delete_importstagingstatus($import_type);
                
//exit;
               $file = fopen($filename, "r");
               
               $x = 1; //header top row
               $result = 0;   //OK
                
               
               while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
               {
                    set_time_limit(0);
                    
                   if($x==0)
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
                       //is_null
                       //$var_is_greater_than_two = ($var > 2 ? true : false);
                       
                       //(is_null($importdata[0])? $importdata[0] : '')
                       
                       
                       $colms = max(array_keys($importdata));
                       
                       
                       /**
    Convert excel file to csv
*/
//$excel_readers = array(
  //  'Excel5' , 
    //'Excel2003XML' , 
    //'Excel2007'
//);
//require_once('lib/PHPExcel/PHPExcel.php');
//$reader = PHPExcel_IOFactory::createReader('Excel5');
//$reader->setReadDataOnly(true);
//$path = 'data.xls';
//$excel = $reader->load($path);
//$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
//$writer->save('data.csv');
                        $mf=11;
                        $nf=0;                           
                        for ($i = 0; $i <= $mf; $i++) 
                        {
                            //echo "The number is: $nf <br>";
                            if(empty($importdata[$i])){
                                $importdata[$i] = '';
                                $nf++;
                            }
                        }

if($nf <=$mf){
     
                          $data = array(
                          'A1' => (!empty($importdata[0])? $importdata[0] : ''),
                          'B1' => (!empty($importdata[1])? $importdata[1] : ''),
                          'C1' => (!empty($importdata[2])? $importdata[2] : ''),
                          'D1' => (!empty($importdata[3])? $importdata[3] : ''),
                          'E1' => (!empty($importdata[4])? $importdata[4] : ''),
                          'F1' => (!empty($importdata[5])? $importdata[5] : ''),
                          'G1' => (!empty($importdata[6])? $importdata[6] : ''),
                          'H1' => (!empty($importdata[7])? $importdata[7] : ''),
                          'I1' => (!empty($importdata[8])? $importdata[8] : ''),
                          'J1' => (!empty($importdata[9])? $importdata[9] : ''),
                          'K1' => (!empty($importdata[10])? $importdata[10] : ''),
                          'L1' => (!empty($importdata[11])? $importdata[11] : ''),
                            );
                            
                        $insert = $this->welcome->insert_fmrdata($data);
}
                        unset($data);
                   }
               unset($importdata);
               $x++;
               
               }
           }






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          fclose($file);
          
          if($result == 0)
          {
               $data = array(
                          'filetype' => $import_type,
                          'filename' =>$_FILES["file"]["name"],
                          'noofrecords' =>$x-2,
                          'importby' =>$_SESSION['Email'],
                          'importstatus' =>'S',
                          'remarks' => 'Staging Data- Pending to Update in Actual Database',
                            );
                        $insert = $this->welcome->insert_importlog($data);
                        
                        unset($data);

            $this->session->set_flashdata('message', 'Successfully uploaded '.$_FILES["file"]["name"]. ' file with ['.($x-2).'] records into staging data. Please proceed to update the staging data into main database by pressing Process button below.');  
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
