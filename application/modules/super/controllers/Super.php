<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {


	function __construct()
	{
		parent::__construct();	
		$this->load->model('m_super','super');
		$this->load->model('m_profile','profile');
		$this->m_konfig->validasi_session(array("super"));
	}
	
	function _template($data)
	{
	$this->load->view('temp_back/main',$data);
	}
	
	public function index()
	{
		$this->dashboard();
	}
	
	function dashboard()
	{ 	
		$data['ttl_level']=$this->super->count_level();
		$data['ttl_useraktif']=$this->super->count_user(1);
		$data['ttl_usernonaktif']=$this->super->count_user(2);
		$data['ttl_user']=$this->super->count_user(0);
		$data['ttl_log']=$this->super->count_log();
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo $this->load->view("dashboard",$data);
		}else{
			$data['konten']="dashboard";
			$this->_template($data);
		}
		
	}
	
	///-----------------------------------
	function manajemen()
	{
		$ajax=$this->input->get_post("ajax");
		$data['dataGroup']=$this->m_konfig->getDataUG();
		if($ajax=="yes")
		{
			echo $this->load->view("manajemen",$data);
		}else{
			$data['konten']="manajemen";
			$this->_template($data);
		}
	}
	function input_UG()
	{
		echo $this->load->view("add_manajemen");
	}
	function insert_UG()
	{
		$data=$this->super->insert_UG();
		echo json_encode($data);
	}
	function edit_UG()
	{
		$data["data"]=$this->super->edit_UG();
		echo $this->load->view("edit_manajemen",$data);
	}
	function update_UG()
	{
		$data=$this->super->update_UG();
	 	echo json_encode($data);
	}
	function delete_UG()
	{	
		echo $this->super->delete_UG();
	}
	
	//----------------------------------------------------
	function menu($id)
	{
		$ajax=$this->input->get_post("ajax");
		$data['dataMenu']=$this->super->dataMenuLevel($id);
		$data['Menu']=$this->m_konfig->getNamaUG($id);
		if($ajax=="yes")
		{
			echo $this->load->view("menu",$data);
		}else{
			$data['konten']="menu";
			$this->_template($data);
		}
	}
	function input_Menu()
	{
		$data["uri"]=$this->input->post("uri");
		echo $this->load->view("add_menu",$data);
	}
	function insert_Menu()
	{
		$data=$this->super->insert_Menu();
		echo json_encode($data);
	}
	function edit_Menu()
	{
		$data["data"]=$this->super->edit_Menu();
		echo $this->load->view("edit_menu",$data);
	}
	function update_Menu() //belumselesai
	{
		$data=$this->super->update_Menu();
	 	echo json_encode($data);
	}
	function delete_Menu()
	{	
		echo $this->super->delete_Menu();
	}
	
	//--------------------------------------------------------------------
	function data_user()
	{
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo $this->load->view("data_user");
		}else{
			$data['konten']="data_user";
			$this->_template($data);
		}
	}
	function data_tables_user()
	{
		$list = $this->super->get_data_user();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {

			$id=isset($dataDB->id_admin)?($dataDB->id_admin):'';
			$ug=$this->m_konfig->getNamaUG($dataDB->level);
			$profilename=isset($dataDB->profilename)?($dataDB->profilename):'';
			$username=isset($dataDB->username)?($dataDB->username):'';
			$img=isset($dataDB->profileimg)?($dataDB->profileimg):'';
			if($img!=''){$img=$img;}else{$img='img_not.png';}
			$sts_aktif=isset($dataDB->sts_aktif)?($dataDB->sts_aktif):'';
			if($sts_aktif=='1'){$sts='<i>Aktif</i>';}else{$sts='<i>Tidak Aktif</i>';}

			$tombol='
					<button type="button" onclick="edit(`'.$id.'`)" class="btn bg-info btn-sm">EDIT</button>
					<button type="button" onclick="del(`'.$id.'`,`'.$username.'`)" class="btn bg-danger btn-sm">DELETE</button>
			';
			$row = array();
			$row[] = "<span class='size linehover'  >".$no++."</span>";	
			$row[] = "<span class='size' >".$ug."</span>";
			$row[] = "<span class='size' >".$profilename."</span>";
			$row[] = "<span class='size linehover' > <img alt='Photo' class='img-responsive' width='50px' src='".base_url()."theme/images/user/".$img."'>  </img></span>";
			$row[] = "<span class='size' >  ".$username." </span>";	
			$row[] = "<span class='size text-center' >  ".$sts." </span>";			
			$row[] = $tombol ;
			//add html for action
			
			$data[] = $row;
			}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c=$this->super->count_data_user(),
			"recordsFiltered" =>$c,
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);

	}
	function input_User()
	{
		echo $this->load->view("add_data_user");
	}
	function insert_User()
	{
		$data=$this->super->insert_User();
		echo json_encode($data);
	}
	function edit_User()
	{
		$data["data"]=$this->super->edit_User();
		echo $this->load->view("edit_data_user",$data);
	}
	function update_User() 
	{
		$data=$this->super->update_User();
	 	echo json_encode($data);
	}
	function delete_User()
	{	
		$data=$this->mdl->delete_item();
		echo json_encode($data);
	}
	
	
	//--------------------------------------------------------------------
	function config_app()
	{
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo $this->load->view("config_app");
		}else{
			$data['konten']="config_app";
			$this->_template($data);
		}
	}
	function update_Config() 
	{
		$data=$this->super->update_Config();
	 	echo json_encode($data);
	}
	
	//--------------------------------------------------------------------
	function data_log()
	{
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo $this->load->view("data_log");
		}else{
			$data['konten']="data_log";
			$this->_template($data);
		}
	}
	function data_tables_log()
	{
		$list = $this->super->get_data_log();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {

			$id=isset($dataDB->id_log)?($dataDB->id_log):'';
			$nama_user=isset($dataDB->nama_user)?($dataDB->nama_user):'';
			$table_update=isset($dataDB->table_updated)?($dataDB->table_updated):'';
			$aksi=isset($dataDB->aksi)?($dataDB->aksi):'';
			$tgl=isset($dataDB->tgl)?($dataDB->tgl):'';
			$tombol='
					<button type="button" onclick="del(`'.$id.'`,`'.$aksi.$tgl.'`)" class="btn bg-danger btn-sm">DELETE</button>
			';
			$row = array();
			$row[] = "<span class='size linehover'  >".$no++."</span>";	
			$row[] = "<span class='size' >".$nama_user."</span>";
			$row[] = "<span class='size' >".$table_update."</span>";
			$row[] = "<span class='size' >".$aksi."</span>";
			$row[] = "<span class='size' >  ".$tgl." </span>";			
			$row[] = $tombol ;
			 
			  
			//add html for action
			
			$data[] = $row;
			}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c=$this->super->count_data_log(),
			"recordsFiltered" =>$c,
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
	}
	function delete_Log()
	{	
		echo $this->super->delete_Log();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	
	
	function konfig()
	{
		$data['konten']="konfig";
		$data['dataProfil']=$this->super->dataProfile($this->session->userdata("id"));
		$this->_template($data);
	}
	
	
	
	
	
	
	
	function cekID($id)
	{
		$this->db->where("id_menu",$id);
		echo $this->db->get("main_menu")->num_rows();
	}
	function updateKonfig()
	{
		$this->super->updateKonfig();
		redirect("super/konfig");
	}	
	function editMenu($id)
	{
		$data=$this->super->editMenu($id);
		echo json_encode($data);
	}
	
	function updateMenu()
	{
		$level=$this->input->post("Level");
		if($level==2){	$this->super->updateIdMain($this->input->post("Induk")); }
		echo $this->super->updateMenu();
	}
	
	function HapusMenu($id)
	{
		$this->super->HapusMenu($id);
	}
	
	function simpanMenu()
	{
		$level=$this->input->post("Level");
		if($level==2){	$this->super->updateIdMain($this->input->post("Induk")); }
		echo $this->super->simpanMenu();
	}
	
	function menuLevel1($id,$val)
	{
	$dataMenu=$this->db->query("select * from main_menu where level='1' and hak_akses ='".$id."' ");
		  $dt="";
		  foreach($dataMenu->result() as $op)
		  {
		  $dt[$op->id_menu]=$op->nama;
		  }
		  $array=$dt;
	echo form_dropdown("Induk",$array,$val,"class='form-control'");
	}
	
	function profile_admin()
	{
	$data['konten']="profile_admin";
	$data['dataProfil']=$this->profile->dataProfile(3);
	$this->_template($data);
	}
	
	function add_dataUser()
	{
	$data=$this->profile->add_dataUser();
	echo json_encode($data);
	}
	
	function update_profile($id)
	{
	$data=$this->profile->update($id);
	echo json_encode($data);
	}
	public function upload_img()
	{
	$this->profile->upload_img(3);
	redirect("super/profile_admin");
	}
	
	
	
	
	
	
	
	
	function getUG($id)
	{
		$data=$this->super->getUG($id);
		echo json_encode($data);
	}
	/*
	function getDataUg($id)
	{
	 $dataMenu=$this->db->get("main_level");
		  $dt="";
		  foreach($dataMenu->result() as $op)
		  {
		  $dt[$op->id_level]=$op->nama;
		  }
		  $array=$dt;
	echo form_dropdown("Hak",$array,$id,'style="width:380px" id="sel2"');
	}
	function data_user()
	{
	$data['konten']="data_user";
	$data['dataProfil']=$this->profile->dataProfile(3);
	$this->_template($data);
	}
	
	function control_sys()
	{
	$data['konten']="control";
	$data['dataProfil']=$this->profile->dataProfile(3);
	$this->_template($data);
	}
	
	function log()
	{
	$data['konten']="log";
	$data['dataProfil']=$this->profile->dataProfile(3);
	$this->_template($data);
	}
	
	function ajax_open()
	{
			
		$list = $this->super->get_open();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {
		////
			$row = array();
			$row[] = "<span class='size'>".$no++."</span>";
			$row[] = "<span class='size'><img width='30px' src='".base_url()."/file_upload/dp/".$dataDB->poto."'></span>";
			$row[] = "<span class='size'>".$dataDB->owner."</a></span>";
			$row[] = "<span class='size'>".$dataDB->telp."</span>";
			$row[] = "<span class='size'>".$dataDB->email."</span>";
			$row[] = "<span class='size'>".$dataDB->namaGroup."</span>";
					
			//add html for action
			$row[] = '
			
			<a class="table-link" href="javascript:void()" title="Edit" onclick="edit('.$dataDB->id_admin.')">
			<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
			</span> </a>
			
			
			<a class="table-link danger" href="javascript:void()" title="Hapus" onclick="deleted('.$dataDB->id_admin.')">
			<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
			</span> </a>';		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->super->count_file("admin"),
						"recordsFiltered" =>$this->super->count_filtered('admin'),
						"data" => $data,
						);
		//output to json format
		echo json_encode($output);

	}
	
	function ajax_open_log()
	{
			
		$list = $this->super->get_open_log();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {
		////
			$row = array();
			$row[] = "<span class='size'>".$no++."</span>";
			$row[] = "<span class='size'>".$dataDB->tgl."</a></span>";
			$row[] = "<span class='size'>".$dataDB->nama."</a></span>";
			$row[] = "<span class='size'>".$dataDB->nama_user."</span>";
			$row[] = "<span class='size'>".$dataDB->table_updated."</span>";
			$row[] = "<span class='size'>".$dataDB->aksi."</span>";
					
			//add html for action
			$row[] = '
		
			
			<a class="table-link danger" href="javascript:void()" title="Hapus" onclick="deleted('.$dataDB->id_log.')">
			<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
			</span> </a>';		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->super->count_file_log("main_log"),
						"recordsFiltered" =>$this->super->count_file_log('main_log'),
						"data" => $data,
						);
		//output to json format
		echo json_encode($output);

	}
	
	function ajax_edit($id)
	{
	$data=$this->super->getDataUser($id);
	echo json_encode($data);
	}	
	
	function deleted_UG($id)
	{
	$data=$this->super->deleted_UG($id);
	echo json_encode($data);
	}
	
	
	function deleted_log($id)
	{
	$data=$this->super->deleted_log($id);
	echo json_encode($data);
	}
	//----------------------------------------------------------->
	function dropdownHak($id)
	{
	$val=$this->super->dataProfile($id);
	$dataMenu=$this->db->query("select * from main_level");
		  $dt="";
		  foreach($dataMenu->result() as $op)
		  {
		  $dt[$op->id_level]=$op->nama;
		  }
		  $array=$dt;
	echo form_dropdown("level",$array,isset($val->level)?($val->level):"","class='form-control'");
	}*/
}

