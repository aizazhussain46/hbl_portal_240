<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    
class Download_cvs extends CI_Controller { 
    
    public function __construct() { 
        parent::__construct(); 
        $this->load->library('excel');
        }
 
        public function index()
    {
                $data['rs'] =  $this->db->get('transactionrequest');
                $this->load->view('admin/transaction', $data);
    }
    public function excel()
    {
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Export');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Transaction Record');
                $this->excel->getActiveSheet()->setCellValue('A3', 'S.No.');
                $this->excel->getActiveSheet()->setCellValue('B3', 'Folio No');
                $this->excel->getActiveSheet()->setCellValue('C3', 'RequestType');
                $this->excel->getActiveSheet()->setCellValue('D3', 'Source Fund');
                $this->excel->getActiveSheet()->setCellValue('E3', 'Destination Fund');
                
                $this->excel->getActiveSheet()->setCellValue('F3', 'Request Amount');
                $this->excel->getActiveSheet()->setCellValue('G3', 'Request Unit');
                $this->excel->getActiveSheet()->setCellValue('H3', 'RequestDate');
                $this->excel->getActiveSheet()->setCellValue('I3', 'RequestTime');
                $this->excel->getActiveSheet()->setCellValue('J3', 'ReferenceID');
                $this->excel->getActiveSheet()->setCellValue('K3', 'Status');
                $this->excel->getActiveSheet()->setCellValue('L3', 'Remarks');
                $this->excel->getActiveSheet()->setCellValue('M3', 'InsertDate');
                $this->excel->getActiveSheet()->setCellValue('N3', 'InsertTime');
                $this->excel->getActiveSheet()->setCellValue('O3', 'InsertBy');
                $this->excel->getActiveSheet()->setCellValue('P3', 'UpdateDate');
                $this->excel->getActiveSheet()->setCellValue('Q3', 'UpdateTime');
                $this->excel->getActiveSheet()->setCellValue('R3', 'UpdateBy');
                $this->excel->getActiveSheet()->setCellValue('S3', 'UpdateStatus');
                $this->excel->getActiveSheet()->setCellValue('T3', 'CurrentBalance');
                $this->excel->getActiveSheet()->setCellValue('U3', 'CurrentUnits');
                $this->excel->getActiveSheet()->setCellValue('V3', 'LimitAllowed');
                $this->excel->getActiveSheet()->setCellValue('W3', 'TOCAcceptance');
                $this->excel->getActiveSheet()->setCellValue('X3', 'paymentmode');
                $this->excel->getActiveSheet()->setCellValue('Y3', 'bankname');
                $this->excel->getActiveSheet()->setCellValue('Z3', 'accountnumber');
                $this->excel->getActiveSheet()->setCellValue('AA3', 'cheque_intrument_no');
                $this->excel->getActiveSheet()->setCellValue('AB3', 'Requestor_IP');
                $this->excel->getActiveSheet()->setCellValue('AC3', 'Authorize_By');
                $this->excel->getActiveSheet()->setCellValue('AD3', 'Authorize_Date');


                $this->excel->getActiveSheet()->setCellValue('AE3', 'Authorize_Time');
                $this->excel->getActiveSheet()->setCellValue('AF3', 'Authorize_Reason');
				$this->excel->getActiveSheet()->setCellValue('AG3', 'Authorize_IP');
				
                $this->excel->getActiveSheet()->setCellValue('AH3', 'Reject_By');
                $this->excel->getActiveSheet()->setCellValue('AI3', 'Reject_Date');
                $this->excel->getActiveSheet()->setCellValue('AJ3', 'Reject_Time');
                $this->excel->getActiveSheet()->setCellValue('AK3', 'Reject_Reason');
				$this->excel->getActiveSheet()->setCellValue('AL3', 'Reject_IP');
				
                $this->excel->getActiveSheet()->setCellValue('AM3', 'PreviousStatus');
                $this->excel->getActiveSheet()->setCellValue('AN3', 'Process_By');
                $this->excel->getActiveSheet()->setCellValue('AO3', 'Process_Date');
                $this->excel->getActiveSheet()->setCellValue('AP3', 'Process_Time');
				$this->excel->getActiveSheet()->setCellValue('AQ3', 'Process_IP');
				
			
				$this->excel->getActiveSheet()->setCellValue('AR3', 'Account_Title');
				$this->excel->getActiveSheet()->setCellValue('AS3', 'Bank_Name');
				$this->excel->getActiveSheet()->setCellValue('AT3', 'Branch_Address');
				$this->excel->getActiveSheet()->setCellValue('AU3', 'ABA_ACCOUNTCODE');
	                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:C1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
                
       for($col = ord('A'); $col <= ord('C'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                //retrive contries table data
               // $this->db->where('Status','A');
               
                $to_date= $this->uri->segment('3');
                $from_date= $this->uri->segment('4');
				$current= date("Y-m-d");
	//	echo $to_date;
	//	echo $from_date;
		
//exit;         
				$this->db->select('t1.*, t2.Acc_Title,t2.Bank_Name, t2.Branch_Address,t2.ABA_ACCOUNTCODE');
				$this->db->from('transactionrequest as t1');
				$this->db->join('investoraccountinfo as t2', 't1.FolioNo = t2.Folio_No', 'LEFT');
				
                            
                if(empty($to_date) OR empty($from_date)){
                //    $this->db->where('RequestDate', $current);
                }
				
                if(!empty($to_date) OR !empty($from_date)){
                //$this->db->where('InsertDate >=', $to_date);
                //$this->db->where('InsertDate <=', $from_date);
                }
                $this->db->order_by('InsertDate',"DESC");
				$this->db->order_by('InsertTime',"DESC");
				$rs = $this->db->get();
				
				//$rs = $this->db->get('transactionrequest');
				
                $exceldata="";
        foreach ($rs->result_array() as $row){
                $exceldata[] = $row;
        }
        
        if(empty($exceldata)){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Sorry no data found in authorize data')
            window.location.href='../Admin/transaction';
            </SCRIPT>");

        }else{
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');
                 
                $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='Export_Transaction_Records.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
        }   
    }
     
     
     
    public function contactinfo()
    {
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Export');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Contact Info  Record');
                $this->excel->getActiveSheet()->setCellValue('A3', 'S.No.');
                $this->excel->getActiveSheet()->setCellValue('B3', 'User ID');
                $this->excel->getActiveSheet()->setCellValue('C3', 'Phone');
                $this->excel->getActiveSheet()->setCellValue('D3', 'Cell');
                $this->excel->getActiveSheet()->setCellValue('E3', 'Email');
                
                $this->excel->getActiveSheet()->setCellValue('F3', 'Address');
                $this->excel->getActiveSheet()->setCellValue('G3', 'Status');
                $this->excel->getActiveSheet()->setCellValue('H3', 'Requestor_IP');
                $this->excel->getActiveSheet()->setCellValue('I3', 'Authorize_By');
                $this->excel->getActiveSheet()->setCellValue('J3', 'Authorize_Date');


                $this->excel->getActiveSheet()->setCellValue('K3', 'Authorize_Time');
                $this->excel->getActiveSheet()->setCellValue('L3', 'Authorize_Reason');
                $this->excel->getActiveSheet()->setCellValue('M3', 'Authorize IP');
                $this->excel->getActiveSheet()->setCellValue('N3', 'Reject_By');
                $this->excel->getActiveSheet()->setCellValue('O3', 'Reject_Date');
                $this->excel->getActiveSheet()->setCellValue('P3', 'Reject_Time');
                $this->excel->getActiveSheet()->setCellValue('Q3', 'Reject_Reason');
                $this->excel->getActiveSheet()->setCellValue('R3', 'Reject IP');
                $this->excel->getActiveSheet()->setCellValue('S3', 'PreviousStatus');
                $this->excel->getActiveSheet()->setCellValue('T3', 'Process_By');
                $this->excel->getActiveSheet()->setCellValue('U3', 'Process_Date');
                $this->excel->getActiveSheet()->setCellValue('V3', 'Process_Time');
                $this->excel->getActiveSheet()->setCellValue('W3', 'Process IP');


                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:C1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
                
                
       for($col = ord('A'); $col <= ord('C'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                //retrive contries table data
                
                $to_date= $this->uri->segment('3');
                $from_date= $this->uri->segment('4');
                $current= date("Y-m-d");             
                if(empty($to_date) OR empty($from_date)){
             //       $this->db->where('RequestDate', $current);
                }
                if(!empty($to_date) OR !empty($from_date)){
             //   $this->db->where('RequestDate >=', $to_date);
             //   $this->db->where('RequestDate <=', $from_date);
                }
                
                
                //$this->db->where('status','A');
                $rs = $this->db->get('contactinformation');
                $exceldata="";
                foreach ($rs->result_array() as $row){
                        $exceldata[] = $row;
                }
        
                if(empty($exceldata)){
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Sorry no data found in authorize data')
                    window.location.href='../Admin/contact_info';
                    </SCRIPT>");
        
                }else{
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');
                 
                $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='Export_ContactInfo_Records.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
        }   
    }     
     
     
     
    public function bankinfo()
    {
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Export');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Bank Info  Record');
                $this->excel->getActiveSheet()->setCellValue('A3', 'S.No.');
                $this->excel->getActiveSheet()->setCellValue('B3', 'User ID');
                $this->excel->getActiveSheet()->setCellValue('C3', 'accountnumber');
                $this->excel->getActiveSheet()->setCellValue('D3', 'accounttitle');
                $this->excel->getActiveSheet()->setCellValue('E3', 'bankname');
                
                $this->excel->getActiveSheet()->setCellValue('F3', 'Address');
                $this->excel->getActiveSheet()->setCellValue('G3', 'Status');
                $this->excel->getActiveSheet()->setCellValue('H3', 'Requestor_IP');
                $this->excel->getActiveSheet()->setCellValue('I3', 'Authorize_By');
                $this->excel->getActiveSheet()->setCellValue('J3', 'Authorize_Date');


                $this->excel->getActiveSheet()->setCellValue('K3', 'Authorize_Time');
                $this->excel->getActiveSheet()->setCellValue('L3', 'Authorize_Reason');
                $this->excel->getActiveSheet()->setCellValue('M3', 'Authorize IP');
                $this->excel->getActiveSheet()->setCellValue('N3', 'Reject_By');
                $this->excel->getActiveSheet()->setCellValue('O3', 'Reject_Date');
                $this->excel->getActiveSheet()->setCellValue('P3', 'Reject_Time');
                $this->excel->getActiveSheet()->setCellValue('Q3', 'Reject_Reason');
                $this->excel->getActiveSheet()->setCellValue('R3', 'Reject IP');
                $this->excel->getActiveSheet()->setCellValue('S3', 'PreviousStatus');
                $this->excel->getActiveSheet()->setCellValue('T3', 'Process_By');
                $this->excel->getActiveSheet()->setCellValue('U3', 'Process_Date');
                $this->excel->getActiveSheet()->setCellValue('V3', 'Process_Time');
                $this->excel->getActiveSheet()->setCellValue('W3', 'Process IP');


                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:C1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
                
                
       for($col = ord('A'); $col <= ord('C'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }



                $to_date= $this->uri->segment('3');
                $from_date= $this->uri->segment('4');
                $current= date("Y-m-d");             
                if(empty($to_date) OR empty($from_date)){
                //    $this->db->where('RequestDate', $current);
                }
                if(!empty($to_date) OR !empty($from_date)){
               // $this->db->where('RequestDate >=', $to_date);
              //  $this->db->where('RequestDate <=', $from_date);
                }

                //$this->db->where('status','A');
                $rs = $this->db->get('bankinformation');
                $exceldata="";
                foreach ($rs->result_array() as $row){
                        $exceldata[] = $row;
                }
        
                if(empty($exceldata)){
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Sorry no data found in authorize data')
                    window.location.href='../Admin/bank_info';
                    </SCRIPT>");
        
                }else{
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');
                 
                $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='Export_BankInfo_Records.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
        }   
    }          
     
     
     
     
         
}

 
/* End of file welcome.php */
/* Location: ./application/controllers/home.php */