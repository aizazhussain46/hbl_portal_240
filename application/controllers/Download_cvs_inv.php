<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Download_cvs_inv extends CI_Controller { 

public function __construct() { 
parent::__construct(); 
$this->load->library('excel');
}

public function index()
{
$data['rs'] =  $this->db->get('ibft');
$this->load->view('admin/investments', $data);
}


public function excel_inv()
{
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('Export');
//set cell A1 content with some text
$this->excel->getActiveSheet()->setCellValue('A1', 'Investment Record');
$this->excel->getActiveSheet()->setCellValue('A3', 'Folio No');
$this->excel->getActiveSheet()->setCellValue('B3', 'Account Title');
$this->excel->getActiveSheet()->setCellValue('C3', 'Reference No (IBFT transaction number)');
$this->excel->getActiveSheet()->setCellValue('D3', 'Fund Name');
$this->excel->getActiveSheet()->setCellValue('E3', 'CNIC');
$this->excel->getActiveSheet()->setCellValue('F3', 'Bank');
$this->excel->getActiveSheet()->setCellValue('G3', 'Amount');
$this->excel->getActiveSheet()->setCellValue('H3', 'Transaction id');
$this->excel->getActiveSheet()->setCellValue('I3', 'Status');
$this->excel->getActiveSheet()->setCellValue('J3', 'Agreed');
$this->excel->getActiveSheet()->setCellValue('K3', 'Attach');
$this->excel->getActiveSheet()->setCellValue('L3', 'Comments');
$this->excel->getActiveSheet()->setCellValue('M3', 'Created Date');
$this->excel->getActiveSheet()->setCellValue('N3', 'Created Time');                
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

$to_date= $this->uri->segment('4');
$from_date= $this->uri->segment('3');
$yesterday = date('m-d-Y',strtotime($from_date . "-1 days"));

$from_date = new DateTime($from_date);
$from_date= $from_date->format('m-d-Y');
$to_date = new DateTime($to_date);
$to_date= $to_date->format('m-d-Y');

$this->db->select('*');
$this->db->order_by('id','desc');
$this->db->from('ibft');
$rs = $this->db->get();

$arr = [];
$exceldata="";
$cell = 3;
foreach ($rs->result_array() as $row){
	//echo $fund[1];
	   $d = new DateTime($row['created_date']);
       $nd = $d->format('m-d-Y');
	   $arr[] = [
			"folio_no" => $row['folio_no'],
			"name" => $row['name'],
			"ref_no" => $row['ref_no'],			
			"select_fund" => $row['select_fund'],
			"cnic_no" => $row['cnic_no'],
			"select_bank" => $row['select_bank'],
			"amount" => $row['amount'],
			"transaction_id" => $row['transaction_id'],
			"status" => $row['status'],
			"agreed" => $row['agreed'],
			"file" => base_url().'investments/'.$row['file'],
			"comments" => $row['comments'],
			"created_date" => $nd,
			"created_time" => $row['created_time']
		];

}

$now = date("Y-m-d");
foreach ($arr as $rows) {
	if($yesterday == $rows['created_date'] && strtotime($row['created_time']) >= strtotime($yesterday.' 04:00:00pm')){	
	$exceldata[] = $rows;			
	}
	if($now == $row['created_date'] && strtotime($row['created_time']) <= strtotime('03:59:59pm')){
		$exceldata[] = $rows;			
	}

	if($from_date != $to_date){
		if($yesterday != $rows['created_date'] && $to_date != $rows['created_date']){
		$exceldata[] = $rows;			
		}
	}

}

if(empty($exceldata)){
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Sorry no data found in authorize data')
window.location.href='../Admin/investments';
</SCRIPT>");

}else{
//Fill data 
$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');

$this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$filename='Export_Investment_Records.csv'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'CSV');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
}   
}




}


/* End of file welcome.php */
/* Location: ./application/controllers/home.php */