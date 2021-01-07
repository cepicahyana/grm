<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_global extends ci_Model
{
	
	public function __construct() {
        parent::__construct();
    }

	
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	 function goField($tbl,$select,$where=null)
	{
	    	$select=$this->security->xss_clean($select);
		if($where)
		{	
			//$where = addslashes($where);
			$where=$this->security->xss_clean($where);
			$where=str_replace("where","",$where);
			 $where=str_replace("'''","'\''",$where);  
			$this->db->where($where);
		}
		$this->db->select($select); 
		$data=$this->db->get($tbl)->row(); 
		return isset($data->$select)?($data->$select):"";
	}
	function goField2($tbl,$select,$where=null)
	{
	    $data=$this->db->query("SELECT $select from $tbl $where ")->row();
		return isset($data->val)?($data->val):"";
	}
	
	function goResult($tbl,$select,$where=null)
	{
	   return $data=$this->db->query("SELECT $select from $tbl $where ");  
	}
}

?>