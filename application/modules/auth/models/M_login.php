<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model  {
    
		
	public function __construct() {
        parent::__construct();
		//$this->m_konfig->validasi_session("super");
    }
	

	//------------------LOGIN------------------------
	function cekLogin()
	{	
		$pass=$this->input->post('password');
		$user=$this->input->post('username');
		
		$this->db->where("sts_aktif",'1');
		$this->db->where("username",$user);
		$this->db->where("password",md5($pass));
		$loginAdmin=$this->db->get("admin");
		
		$this->db->where("sts_aktif",'1');
		$this->db->where("username",$user);
		$this->db->where("password",md5($pass));
		$loginMember=$this->db->get("data_kri");

		if($loginAdmin->num_rows()==1)
		{
			$login=$loginAdmin->row();
			$level=$this->m_konfig->goField("admin","level",$this->db->where("id_admin",$login->id_admin));
			$profilename=$this->m_konfig->goField("admin","profilename",$this->db->where("id_admin",$login->id_admin));
			$this->saveSessionLog($login->id_admin,$profilename,$level,$pass,'admin');
			$this->updateLoginTable("admin",$login->id_admin);
			$var["validasi"]=true; 
			$var["direct"]=$this->direct($level);
		}
		elseif($loginMember->num_rows()==1)
		{
			$login=$loginMember->row();
			$level=$this->m_konfig->goField("data_kri","level",$this->db->where("id",$login->id));
			$profilename=$this->m_konfig->goField("data_kri","profilename",$this->db->where("id",$login->id));
			$this->saveSessionLog($login->id,$profilename,$level,$pass,'data_kri');
			$this->updateLoginTable("data_kri",$login->id);
			$var["validasi"]=true; 
			$var["direct"]=$this->direct($level);
		}else{
	    	 $var["validasi"]=false; 
			 $var["upass"]=false;
		}
		$data=$var;
		return $data;	
	}
	
	
	function direct($level)
	{
		$this->db->where("code_level",$level);
	    $return=$this->db->get("main_level")->row();
	    return isset($return->direct)?($return->direct):"login";
	}
	private function saveSessionLog($id,$profilename,$level,$pass,$tbl)
	{
		$array=array(
		"id"=>$id,
		"level"=>strtoupper($level),
		"pass"=>$pass,
		);
		
		$this->session->set_userdata($array);
		$this->m_konfig->logSave($tbl,"Login",$profilename);
		return "1_success";
	}

	function updateLoginTable($tbl,$id)
	{	
		$this->db->set("last_login",date("Y-m-d H:i:s"));
		$this->db->where("id_admin",$id);
		return	$this->db->update($tbl);
	}
	 
}
 