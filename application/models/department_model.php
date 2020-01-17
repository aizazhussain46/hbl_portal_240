<?php
class department_model extends CI_Model{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    //fetch department details from database
    function get_department_list($limit, $start,$fno)
    {
		//Changes done on 25/5/2018 - Rizwan
		$currectdat= date("Y-m-d");
        $diff_date= date('Y-m-d', strtotime('-90 days'));
        $sql = 'select id,description,status,Folio_No,ActivityDate,ActivityTime from activitylog where folio_no = "' .$fno. '" and STR_TO_DATE(ActivityDate,"%d/%m/%Y")  > "'.$diff_date.'" order by id desc limit ' . $start . ', ' . $limit;
		
        //$sql = 'select id,description,status,Folio_No,ActivityDate,ActivityTime from activitylog order by id desc limit ' . $start . ', ' . $limit;
        //print_r($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }
}
?>
