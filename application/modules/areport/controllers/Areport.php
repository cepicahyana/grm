<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Areport extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("super","admin","kri"));
		$this->load->model("model","mdl");		
		date_default_timezone_set('Asia/Jakarta');
	}
	 
	function _template($data)
	{
		$this->load->view('temp_back/main',$data);	
	}
	 
	public function index()
	{	
		$levelsession=$this->session->userdata('level');
		if($levelsession==1 || $levelsession==2){
			$ajax=$this->input->get_post("ajax");
			if($ajax=="yes")
			{
				echo $this->load->view("index");
			}else{
				$data['konten']="index";
				$this->_template($data);
			}
		}elseif($levelsession==3){
			$this->input_data();
		}
		
		
	}
	function data_tables()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {
			$id=isset($dataDB->id)?($dataDB->id):'';
			$code_object=isset($dataDB->code_object)?($dataDB->code_object):'';
			$kategori=isset($dataDB->kategori)?($dataDB->kategori):'';
			$status_data=isset($dataDB->status_data)?($dataDB->status_data):'';
			$name_object=isset($dataDB->name_object)?($dataDB->name_object):'';
			$no_object=isset($dataDB->no_object)?($dataDB->no_object):'';
			$date_detected=isset($dataDB->date_detected)?($dataDB->date_detected):'';
			$sts_object=isset($dataDB->sts_object)?($dataDB->sts_object):'';
			$type_object=isset($dataDB->type_object)?($dataDB->type_object):'';
			$nasionality=isset($dataDB->nasionality)?($dataDB->nasionality):'';
			$lat_object=isset($dataDB->lat)?($dataDB->lat):'';
			$lng_object=isset($dataDB->lng)?($dataDB->lng):'';
			$_tid=isset($dataDB->_tid)?($dataDB->_tid):'';
			$_ttime=isset($dataDB->_ttime)?($dataDB->_ttime):'';

			$user_detected=$this->m_konfig->goField('data_kri','profilename','id='.$_tid.'');
			$taggal_deteksi=$this->tanggal->inddatetime($date_detected,' ');
			$taggal_input=$this->tanggal->inddatetime($_ttime,' ');

			$dbkat=$this->db->get_where('tm_kategoriobject',array('kode'=>$kategori))->row();
			$iconobject=isset($dbkat->icon)?($dbkat->icon):'';
			$kategoriobject=isset($dbkat->kategori)?($dbkat->kategori):'';

			if($type_object!=''){
				$esmobject="<br>".$type_object." <br>".$nasionality."";
			}else{
				$esmobject="";
			}
			if($status_data!="trash"){
				$tombol='
					<button type="button" onclick="history_object(`'.$code_object.'`,`'.$name_object.'`)" class="btn bg-info btn-sm mb-2">HISTORY</button>
				';
			}else{
				$tombol='
					<button type="button" onclick="history_object(`'.$code_object.'`,`'.$name_object.'`)" class="btn bg-info btn-sm  mb-2">HISTORY</button>
					<button type="button" onclick="del(`'.$id.'`,`'.$name_object.'`)" class="btn bg-danger btn-sm">DELETE PERMANENT</button>
				';
			}
			
			$row = array();
			$row[] = "<span class='size' >".$no++."</span>";	
			$row[] = "<span class='size' >".$name_object." <br><span class='text-muted'>".$code_object."</span> <br>".$no_object." <br>".$esmobject." </span>";
			$row[] = "<span class='size' >".$kategoriobject."</span>";
			$row[] = "<span class='size' >".$sts_object."</span>";
			$row[] = "<span class='size' ><i>".$status_data."</i></span>";
			$row[] = "<span class='size' >BY ".$user_detected." ".$taggal_deteksi."</span>";
			$row[] = "<span class='size' >BY ".$user_detected." ".$taggal_input."</span>";
			$row[] = "<span class='size text-sm' >".$lat_object.",<br>".$lng_object."</span>";
			$row[] = $tombol;

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
	function input_data()
	{
		echo $this->load->view("formAdd");
	}
	function insert_data()
	{
		$data=$this->mdl->insert_data();
		echo json_encode($data);
	}	
	function edit_data()
	{
		$data["data"]=$this->mdl->edit_data();
		echo $this->load->view("formEdit",$data);
	}
	function update_data()
	{
		$data=$this->mdl->update_data();
	 	echo json_encode($data);
	}
	function delete_item()
	{
		$data=$this->mdl->delete_item();
		echo json_encode($data);
	}
	function delete_permanent()
	{
		$data=$this->mdl->delete_permanent();
		echo json_encode($data);
	}
	function delete_sel()
	{
		$data=$this->mdl->delete_sel();
		echo json_encode($data);
	}
	function view_data()
	{
		$data["data"]=$this->mdl->edit_data();
		echo $this->load->view("formView",$data);
	}
	function history_data()
	{
		echo $this->load->view("tblHistory");
	}
	function history_all()
	{
		echo $this->load->view("tblHistory_all");
	}
	function import_Data()
	{
		$data=$this->mdl->import_Data();
	 	echo json_encode($data);
	}
	function downloadXL()
	{
		ob_start();
		$f1=$this->input->get("f1");
		if($f1)
		{
			$cf1 =$f1;
			//$this->db->where("level",$cf1);
		}
		
		//$this->db->where("level","3");
		$this->db->order_by("id","asc"); 
		$data["data"]=$this->db->get("pengumuman")->result();
		$this->load->view("downloadXL",$data);
	    return true;
	}


	function data_tables_history()
	{
		$list = $this->mdl->get_data_history();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {
			$id=isset($dataDB->id)?($dataDB->id):'';
			$code_object=isset($dataDB->code_object)?($dataDB->code_object):'';
			$kategori=isset($dataDB->kategori)?($dataDB->kategori):'';
			$status_data=isset($dataDB->status_data)?($dataDB->status_data):'';
			$name_object=isset($dataDB->name_object)?($dataDB->name_object):'';
			$no_object=isset($dataDB->no_object)?($dataDB->no_object):'';
			$date_detected=isset($dataDB->date_detected)?($dataDB->date_detected):'';
			$sts_object=isset($dataDB->sts_object)?($dataDB->sts_object):'';
			$type_object=isset($dataDB->type_object)?($dataDB->type_object):'';
			$nasionality=isset($dataDB->nasionality)?($dataDB->nasionality):'';
			$lat_object=isset($dataDB->lat)?($dataDB->lat):'';
			$lng_object=isset($dataDB->lng)?($dataDB->lng):'';
			$_tid=isset($dataDB->_tid)?($dataDB->_tid):'';
			$_ttime=isset($dataDB->_ttime)?($dataDB->_ttime):'';

			$user_detected=$this->m_konfig->goField('data_kri','profilename','id='.$_tid.'');
			$taggal_deteksi=$this->tanggal->inddatetime($date_detected,' ');
			$taggal_input=$this->tanggal->inddatetime($_ttime,' ');

			$dbkat=$this->db->get_where('tm_kategoriobject',array('kode'=>$kategori))->row();
			$iconobject=isset($dbkat->icon)?($dbkat->icon):'';
			$kategoriobject=isset($dbkat->kategori)?($dbkat->kategori):'';

			if($type_object!=''){
				$esmobject="<br>".$type_object." <br>".$nasionality."";
			}else{
				$esmobject="";
			}

			$row = array();
			$row[] = "<span class='size' >".$no++."</span>";	
			$row[] = "<span class='size' >".$name_object." <br><span class='text-muted'>".$code_object."</span> <br>".$no_object." <br><i>".$sts_object."</i>".$esmobject." </span>";
			$row[] = "<span class='size' >".$kategoriobject."</span>";
			$row[] = "<span class='size' ><i>".$status_data."</i></span>";
			$row[] = "<span class='size' >BY ".$user_detected." ".$taggal_deteksi."</span>";
			$row[] = "<span class='size' >BY ".$user_detected." ".$taggal_input."</span>";
			$row[] = "<span class='size' >".$lat_object.",".$lng_object."</span>";
			

			//add html for action
			$data[] = $row;
			}
			
		//$csrf_name = $this->security->get_csrf_token_name();
		//$csrf_hash = $this->security->get_csrf_hash(); 
		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $c=$this->mdl->count_data_history(),
		"recordsFiltered" =>$c,
		"data" => $data,
		);
		//output to json format
		//$output[$csrf_name] = $csrf_hash;
		echo json_encode($output);
	}


	function data_tables_historyAll()
	{
		$list = $this->mdl->get_data_historyAll();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {
			$id=isset($dataDB->id)?($dataDB->id):'';
			$code_object=isset($dataDB->code_object)?($dataDB->code_object):'';
			$kategori=isset($dataDB->kategori)?($dataDB->kategori):'';
			$status_data=isset($dataDB->status_data)?($dataDB->status_data):'';
			$name_object=isset($dataDB->name_object)?($dataDB->name_object):'';
			$no_object=isset($dataDB->no_object)?($dataDB->no_object):'';
			$date_detected=isset($dataDB->date_detected)?($dataDB->date_detected):'';
			$sts_object=isset($dataDB->sts_object)?($dataDB->sts_object):'';
			$type_object=isset($dataDB->type_object)?($dataDB->type_object):'';
			$nasionality=isset($dataDB->nasionality)?($dataDB->nasionality):'';
			$lat_object=isset($dataDB->lat)?($dataDB->lat):'';
			$lng_object=isset($dataDB->lng)?($dataDB->lng):'';
			$_tid=isset($dataDB->_tid)?($dataDB->_tid):'';
			$_ttime=isset($dataDB->_ttime)?($dataDB->_ttime):'';

			$user_detected=$this->m_konfig->goField('data_kri','profilename','id='.$_tid.'');
			$taggal_deteksi=$this->tanggal->inddatetime($date_detected,' ');
			$taggal_input=$this->tanggal->inddatetime($_ttime,' ');

			$dbkat=$this->db->get_where('tm_kategoriobject',array('kode'=>$kategori))->row();
			$iconobject=isset($dbkat->icon)?($dbkat->icon):'';
			$kategoriobject=isset($dbkat->kategori)?($dbkat->kategori):'';

			if($type_object!=''){
				$esmobject="<br>".$type_object." <br>".$nasionality."";
			}else{
				$esmobject="";
			}
			$row = array();
			$row[] = "<span class='size' >".$no++."</span>";	
			$row[] = "<span class='size' >".$name_object." <br><span class='text-muted'>".$code_object."</span> <br>".$no_object." <br><i>".$sts_object."</i>".$esmobject." </span>";
			$row[] = "<span class='size' >".$kategoriobject."</span>";
			$row[] = "<span class='size' ><i>".$status_data."</i></span>";
			$row[] = "<span class='size' >BY ".$user_detected." ".$taggal_deteksi."</span>";
			$row[] = "<span class='size' >BY ".$user_detected." ".$taggal_input."</span>";
			$row[] = "<span class='size' >".$lat_object.",".$lng_object."</span>";
			

			//add html for action
			$data[] = $row;
			}
			
		//$csrf_name = $this->security->get_csrf_token_name();
		//$csrf_hash = $this->security->get_csrf_hash(); 
		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $c=$this->mdl->count_data_historyAll(),
		"recordsFiltered" =>$c,
		"data" => $data,
		);
		//output to json format
		//$output[$csrf_name] = $csrf_hash;
		echo json_encode($output);
	}


	

	
}
