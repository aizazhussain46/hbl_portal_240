<?php
class Pagination_transaction extends CI_Model{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    //fetch department details from database
    function get_transaction_lists($limit, $start)
    {
        $sql = 'select id,FolioNo,RequestType,Source_Fund_Code,Dest_Fund_Code,RequestAmount,RequestUnit,Status from transactionrequest order by id desc limit ' . $start . ', ' . $limit;
        //print_r($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }
}
?>