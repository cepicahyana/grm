<?php
class Model extends CI_Model
{

    var $tbl="data_kri";
	public function __construct() {
        parent::__construct();
    }
	
	
	/*===================================*/
	public function get_data_statuskri()
	{
		$this->_get_datatables_statuskri();
		if($this->input->post("length") != -1) 
		$this->db->limit($this->input->post("length"),$this->input->post("start"));
	 	return $this->db->get()->result();
	}
	private function _get_datatables_statuskri() 
	{	
		 //$this->db->where("level","3"); 
		 if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"namadata"=>$searchkey
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}
		$this->db->order_by("id","asc"); 
		$query=$this->db->from($this->tbl);
		return $query;
	
	}	
	public function count_data_statuskri()
	{		
		$this->_get_datatables_statuskri();
		return $this->db->get()->num_rows();
	}
	

    


}
//End of file data_param.php