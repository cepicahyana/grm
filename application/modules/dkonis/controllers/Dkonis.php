<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dkonis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("super","kri"));
		$this->load->model("model","mdl");		
		date_default_timezone_set('Asia/Jakarta');
	}
	 
	function _template($data)
	{
		$this->load->view('temp_maps_kri/main',$data);	
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
	function page_index()
	{
		echo $this->load->view("page_index");
	}
	function history()
	{
		echo $this->load->view("history");
	}
	function data_tables()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {

			$id=isset($dataDB->id)?($dataDB->id):'';
			$tanggal=isset($dataDB->tanggal)?($dataDB->tanggal):'';
			//$namadata=isset($dataDB->namadata)?($dataDB->namadata):'';
			
			/*$tgl_lahir=isset($dataDB->tanggal_lahir)?($dataDB->tanggal_lahir):'';
			if($tgl_lahir!=''){$tanggal_lahir=$this->tanggal->ind($tgl_lahir,0);}else{$tanggal_lahir="";}*/
			/*$kelasDB=$this->db->where("kode",$kd_kelas);
			$kelasDB=$this->db->get("tm_kelas")->row();
			$kelas=isset($kelasDB->kelas)?($kelasDB->kelas):'';*/

			$tombol='
					<button type="button" onclick="edit(`'.$id.'`)" class="btn bg-info btn-sm">EDIT</button>
					<button type="button" onclick="del(`'.$id.'`)" class="btn bg-danger btn-sm">DELETE</button>
			';
			$row = array();
			$row[] = "<span class='size' >".$no++."</span>";	
			$row[] = "<span class='size' ></span>";
			$row[] = "<span class='size' ></span>";
			$row[] = "<span class='size' ></span>";
			//$row[] = $tombol ;
			 
			  
			//add html for action
			$data[] = $row;
			}
			
		//$csrf_name = $this->security->get_csrf_token_name();
		//$csrf_hash = $this->security->get_csrf_hash(); 
		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $c=$this->mdl->count_data(),
		"recordsFiltered" =>$c,
		"data" => $data,
		);
		//output to json format
		//$output[$csrf_name] = $csrf_hash;
		echo json_encode($output);
	}
	
	function import_Data()
	{
		$data=$this->mdl->import_Data();
	 	echo json_encode($data);
	}
	

	
}
