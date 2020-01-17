<?php
class Welcome_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_dailyportfoliosummary($data)
            {
                
                $this->db->insert('temp_dailyportfoliosummary', $data);
                return TRUE;
            }
            
    public function insert_investoraccountinfo($data)
            {
                
                $this->db->insert('temp_investoraccountinfo', $data);
                return TRUE;
            }
            
    public function insert_fmr($data)
            {
                
                $this->db->insert('temp_fmr', $data);
                return TRUE;
            }
    public function insert_fmrdata($data)
            {
                
                $this->db->insert('temp_fmrdata', $data);
                return TRUE;
            }            
            
    public function insert_transactionhistory($data)
            {
                                
                $this->db->insert('temp_transactionhistory', $data);
                return TRUE;
            }
            
    public function insert_importlog($data)
            {
                
                $this->db->insert('import', $data);
                $this->db->insert('importhistory', $data);
                
                return TRUE;
            }
            
    public function delete_importstagingstatus($data)
            {
                if($data == 'portfolio')
                {
                    $this->db->from('temp_dailyportfoliosummary');
                }
                elseif($data == 'investor')
                {
                    $this->db->from('temp_investoraccountinfo');    
                }
                elseif($data == 'transaction')
                {
                    $this->db->from('temp_transactionhistory');
                }
                elseif($data == 'fmr')
                {
                    $this->db->from('temp_fmr');
                }
                elseif($data == 'fmrdata')
                {
                    $this->db->from('temp_fmrdata');
                }
                
                 
                $this->db->truncate(); 
                $this->db->where('filetype',$data);
                //$this->db->where('importstatus','S');
                $this->db->delete('import');
            }        
            
                public function view_data(){
        $query=$this->db->query("SELECT im.*
                                 FROM import im 
                                 ORDER BY im.created_date ASC");
        return $query->result_array();
    }

}