<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Uprofile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("super","admin","kri"));
		$this->load->model("model","mdl");		
		date_default_timezone_set('Asia/Jakarta');
	}
	 
	function _template($data)
	{
		$code_level=$this->session->userdata("level");
		$id=$this->session->userdata("id");
		if($code_level==1 || $code_level==2){
			$this->load->view('temp_back/main',$data);
		}elseif($code_level==3){
			$this->load->view('temp_maps_kri/main',$data);
		}	
	}
	 
	function index()
	{
		 	
		$ajax=$this->input->get_post("ajax");
		$data['data']=$this->mdl->get_Profile();
		if($ajax=="yes")
		{	
			$code_level=$this->session->userdata("level");
			if($code_level==1 || $code_level==2){
				$this->load->view("index",$data);
			}elseif($code_level==3){
				$this->load->view('memberprofile',$data);
			}	
		}else{
			$data['konten']="index";
			$this->_template($data);
		}
		
	}
	
	function update_Profile()
	{
		$data=$this->mdl->update_Profile();
	 	echo json_encode($data);
	}
	
	
	public function new_password()
	{
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			$code_level=$this->session->userdata("level");
			if($code_level==1 || $code_level==2){
				$this->load->view("new_password");
			}elseif($code_level==3){
				$this->load->view("new_password_member");
			}	
		}else{
			$data['konten']="new_password";
			$this->_template($data);
		}
	}
	
	function update_Password()
	{
		$data=$this->mdl->update_Password();
		echo json_encode($data);
	}


	
	
	
	

	
}
