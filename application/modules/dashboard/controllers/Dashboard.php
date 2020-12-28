<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller 
{
	public function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("super","admin"));
		$this->load->model("model","mdl");
		date_default_timezone_set('Asia/Jakarta');
	}
	 
	function _template($data)
	{
		$this->load->view('temp_back/main',$data);	
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

	function data_tables_statuskri()
	{
		$list = $this->mdl->get_data_statuskri();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {

			$id=isset($dataDB->id)?($dataDB->id):'';
			$namadata=isset($dataDB->namadata)?($dataDB->namadata):'';
			$imgdata=isset($dataDB->imgdata)?($dataDB->imgdata):'';
			$descdata=isset($dataDB->descdata)?($dataDB->descdata):'';
			$lat=isset($dataDB->lat)?($dataDB->lat):'';
			$lng=isset($dataDB->lng)?($dataDB->lng):'';
			$datenow=date('Y-m-d');
			$dbkonlog=$this->db->get_where('data_konlog',array('id_kri'=>$id,'tanggal'=>$datenow))->row();
			$kondisilog=isset($dbkonlog->kondisi)?($dbkonlog->kondisi):'';
			$dbkonis=$this->db->get_where('data_konis',array('id_kri'=>$id,'tanggal'=>$datenow))->row();
			$kondisinis=isset($dbkonis->kondisi)?($dbkonis->kondisi):'';
			/*$tgl_lahir=isset($dataDB->tanggal_lahir)?($dataDB->tanggal_lahir):'';
			if($tgl_lahir!=''){$tanggal_lahir=$this->tanggal->ind($tgl_lahir,0);}else{$tanggal_lahir="";}*/
			/*$kelasDB=$this->db->where("kode",$kd_kelas);
			$kelasDB=$this->db->get("tm_kelas")->row();
			$kelas=isset($kelasDB->kelas)?($kelasDB->kelas):'';*/
			
			if($imgdata!=''){
				$img_1=''.base_url().'theme/images/data/'.$imgdata.'';
			}else{
				$img_1=''.base_url().'theme/images/no-image.png';
			}
			
			$tombol='
					<button type="button" onclick="edit(`'.$id.'`)" class="btn bg-info btn-sm">EDIT</button>
					<button type="button" onclick="del(`'.$id.'`,`'.$namadata.'`)" class="btn bg-danger btn-sm">DELETE</button>
			';
			$row = array();
			$row[] = "<span class='size' >".$no++."</span>";
			$row[] = "<span class='size' >".$namadata."</span>";	
			$row[] = "<span class='size' >".$kondisilog."</span>";
			$row[] = "<span class='size' >".$kondisinis."</span>";
			$row[] = "<span class='size' ></span>";
			
			 
			  
			//add html for action
			$data[] = $row;
			}
			
		//$csrf_name = $this->security->get_csrf_token_name();
		//$csrf_hash = $this->security->get_csrf_hash(); 
		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $c=$this->mdl->count_data_statuskri(),
		"recordsFiltered" =>$c,
		"data" => $data,
		);
		//output to json format
		//$output[$csrf_name] = $csrf_hash;
		echo json_encode($output);
	}


	
}
