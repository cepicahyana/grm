<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_total extends ci_Model
{
	var $data_kri="data_kri";
	var $data_lantamal="data_lantamal";
	var $data_lanal="data_lanal";
	var $data_brigif="data_brigif";
	var $data_posal="data_posal";
	var $data_satrad="data_satrad";
	public function __construct() {
        parent::__construct();
    }
	
	
	/*=================================== total marker maps ==*/
	public function ttl_fm1()
	{
		$this->db->from($this->data_kri);
		$ttl=$this->db->get()->num_rows();
		$total=isset($ttl)?($ttl):'0'; 
		return $total;
	}
	public function ttl_fm2()
	{
		$this->db->from($this->data_lantamal);
		$ttl=$this->db->get()->num_rows();
		$total=isset($ttl)?($ttl):'0'; 
		return $total;
	}
	public function ttl_fm3()
	{
		$this->db->from($this->data_lanal);
	 	$ttl=$this->db->get()->num_rows();
		$total=isset($ttl)?($ttl):'0'; 
		return $total;
	}
	public function ttl_fm4()
	{
		$this->db->from($this->data_brigif);
	 	$ttl=$this->db->get()->num_rows();
		$total=isset($ttl)?($ttl):'0'; 
		return $total;
	}
	public function ttl_fm5()
	{
		$this->db->from($this->data_posal);
	 	$ttl=$this->db->get()->num_rows();
		$total=isset($ttl)?($ttl):'0'; 
		return $total;
	}
	public function ttl_fm6()
	{
		$this->db->from($this->data_satrad);
	 	$ttl=$this->db->get()->num_rows();
		$total=isset($ttl)?($ttl):'0'; 
		return $total;
	}
	public function ttl_fm7()
	{
		$this->db->from($this->data_lantamal);
	 	$ttl=$this->db->get()->num_rows();
		$total=isset($ttl)?($ttl):'0'; 
		return $total;
	}
	public function ttl_fm8()
	{
		$this->db->from($this->data_lantamal);
	 	$ttl=$this->db->get()->num_rows();
		$total=isset($ttl)?($ttl):'0'; 
		return $total;
	}
	

	

    


}
//End of file data_param.php