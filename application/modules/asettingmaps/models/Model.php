<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model
{
	var $tbl="tm_maps";
	public function __construct() {
        parent::__construct();
    }
	

	//-------------------------------------------------------------------------------
	function update_Config()
	{
		$time=date('His');
		
		$var=array();
		//$param=$this->input->post("loggo");

		////////////////////
		for($i=1;$i<=3;$i++)
		{
			$input=$this->input->post("input".$i);
			$this->db->where("id_konfig",$i);
			$array=array("value"=>$this->security->xss_clean($input));
			$this->db->update($this->tbl,$array);
		}
		return $var;
		
	}
	

}

?>