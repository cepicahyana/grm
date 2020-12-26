<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_app extends CI_Controller {

	

	function __construct()
	{
		parent::__construct();	
		$this->load->model('model','mdl');
		$this->m_konfig->validasi_session(array("super","admin"));
	}
	
	function _template($data)
	{
	$this->load->view('temp_user/main',$data);
	}
	
	public function index()
	{
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo $this->load->view("index");
		}else{
			$data['konten']="index";
			$this->_template($data);
		}
	}

	function update_Config() 
	{
		$data=$this->mdl->update_Config();
	 	echo json_encode($data);
	}
	
	
}

