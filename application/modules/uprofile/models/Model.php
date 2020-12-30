<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends ci_Model
{

	var $admin="admin";
	var $data_kri="data_kri";
	public function __construct() {
        parent::__construct();
		//$this->m_konfig->validasi_session("super");
    }
	
	function get_Profile()
	{
		$code_level=$this->session->userdata("level");
		$id=$this->session->userdata("id");
		if($code_level==1 || $code_level==2){
			$this->db->from($this->admin);
			$this->db->where('id_admin',$id);
		}elseif($code_level==3){
			$this->db->from($this->data_kri);
			$this->db->where('id',$id);
		}
		
		$query = $this->db->get();
		return $query->row();
	}
	
	function update_Profile()
	{
		$var=array();
		$code_level=$this->session->userdata("level");
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);
		
		$username=trim($this->input->post("f[username]"));
		$username_b=trim($this->input->post("username_b"));
		$profileimg_b=$this->input->post("profileimg_b");
		//$password=md5($this->input->post("password"));

		//cek dulu
		$this->db->where("username!=",$username_b);
		$this->db->where('username',$username);
		if($code_level==1 || $code_level==2){
			$cek=$this->db->get($this->admin)->num_rows();
		}elseif($code_level==3){
			$cek=$this->db->get($this->data_kri)->num_rows();
		}
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Not allowed, username already exists.";
			return $var;
		}

		///
		if($code_level==1 || $code_level==2){
			$img1=$this->m_reff->upload_file("profileimg","theme/images/user/","fileadmin","JPG,JPEG,PNG","1000000",$profileimg_b);
			if($img1['validasi']==true){
				$this->db->set("profileimg",$img1['name']);
			}
			$this->db->set($datainputan); 
			$this->db->where("id_admin",$idu);
			$this->db->update($this->admin);
			
		}elseif($code_level==3){
			$img2=$this->m_reff->upload_file("profileimg","theme/images/user/","filemember","JPG,JPEG,PNG","1000000",$profileimg_b);
			if($img2['validasi']==true){
				$this->db->set("profileimg",$img2['name']);
			}
			$this->db->set($datainputan); 
			$this->db->where("id",$idu);
			$this->db->update($this->data_kiri);
		}
		return $var;
	}
	

	function update_Password()
	{
		$var=array();
		$code_level=$this->session->userdata("level");
		$idu=$this->session->userdata('id');
		$userDB=$this->m_konfig->dataProfile($idu);
		$password = $userDB->password;
		$passold = trim(md5($this->input->post('passold')));
		$passnew = trim($this->input->post('passnew'));
		$retpass = trim($this->input->post('retpass'));
		if($passold=='' || $passnew=='' || $retpass==''){
			$var['gagal']=false;
			$var['info']="Make sure all fields are filled";
			return $var;
		}else if($passold != $password){
			$var['gagal']=false;
			$var['info']="The old password is not suitable";
			return $var;
		}else if($passnew != $retpass){
			$var['gagal']=false;
			$var['info']="Please repeat the password correctly";
			return $var;
		}else{
			if($code_level==1 || $code_level==2){
				$this->db->set("password",$this->security->xss_clean(md5($passnew)));
				$this->db->where("id_admin",$idu);
				$this->db->update($this->admin);
			}elseif($code_level==3){
				$this->db->set("password",$this->security->xss_clean(md5($passnew)));
				$this->db->where("id_admin",$idu);
				$this->db->update($this->data_kri);
			}
			return $var;
		}

		
	}

}

?>