<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends ci_Model
{
	var $tbl="main_konfig";
	public function __construct() {
        parent::__construct();
    }
	
	
	//-------------------------------------------------------------------------------
	function update_Config()
	{
		$time=date('His');
		
		$var=array();
		$loggo_b=$this->input->post("loggo_b");
		$fav_b=$this->input->post("fav_b");
		$loggo_login_b=$this->input->post("loggo_login_b");
		
		$img=$this->m_reff->upload_file("loggo","theme/images/","file_a","JPG,JPEG,PNG","500000",$loggo_b);
		if($img['validasi']==true){
			$data=array("value"=>$img['name'],);
			$this->db->where("id_konfig",1);
			$this->db->update($this->tbl,$data);
		}
		$img2=$this->m_reff->upload_file("fav","theme/images/","file_b","ICO","500000",$fav_b);
		if($img2['validasi']==true){
			$data=array("value"=>$img2['name'],);
			$this->db->where("id_konfig",2);
			$this->db->update($this->tbl,$data);
		}
		$img3=$this->m_reff->upload_file("loggo_login","theme/images/","file_c","JPG,JPEG,PNG","500000",$loggo_login_b);
		if($img3['validasi']==true){
			$data=array("value"=>$img3['name'],);
			$this->db->where("id_konfig",3);
			$this->db->update($this->tbl,$data);
		}
		
		////////////////////
		for($i=5;$i<=14;$i++)
		{
			if($i=='9' || $i=='13' || $i=='14'){
				$this->db->where("id_konfig",$i);
				$array=array("value"=>$this->input->post("input".$i));
				$this->db->update("main_konfig",$array);
			}
		}
		return $var;
		
	}
	
	
	
}

?>