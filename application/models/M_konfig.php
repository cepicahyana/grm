<?php

class M_konfig extends CI_Model  {

		
	function __construct()
    {
        parent::__construct();
		
    }
	///konfig zai	
	function goField($tbl,$select,$where=null)
	{
		$this->db->from($tbl);
		$where;
	    $data=$this->db->get()->row();
		return isset($data->$select)?($data->$select):"";
	}
	
	function goResult($tbl,$select,$where=null)
	{
		return $data=$this->db->query("SELECT $select from $tbl $where ");  
	}
	
	function konfigurasi($id)
    {
		$this->db->select("value");
		$this->db->where("id_konfig",$id);
		$data=$this->db->get("main_konfig")->row();
		return isset($data->value)?($data->value):'';
	}
	
	function cekMaxIdTable($field,$table)
	{
		$db=$this->db->query("select CONCAT(MAX(".$field.")+1) as max from ".$table."")->row();
		return isset($db->max)?($db->max):'1';
	}
	function cekIdTable($field,$table,$id)
	{
		$db=$this->db->query("select ".$field." AS id from ".$table." where ".$field."=$id ")->row();
		return isset($db->id)?($db->id):'';
	}

	//MAPS KONFIG
	function konfigmaps($id)
    {
		$this->db->select("value");
		$this->db->where("id_konfig",$id);
		$data=$this->db->get("tm_maps")->row();
		return isset($data->value)?($data->value):'';
	}
	
	//PROFILE-----------------------------------------------
	function dataProfile($id,$level)
	{
		if($level<=2){
			return $this->db->get_where("admin",array("id_admin"=>$id))->row();
		}elseif($level==3){
			return $this->db->get_where("data_kri",array("id"=>$id))->row();
		}elseif($level==4){
			return $this->db->get_where("data_lantamal",array("id"=>$id))->row();
		}elseif($level==5){
			return $this->db->get_where("data_lanal",array("id"=>$id))->row();
		}elseif($level==6){
			return $this->db->get_where("data_brigif",array("id"=>$id))->row();
		}elseif($level==7){
			return $this->db->get_where("data_posal",array("id"=>$id))->row();
		}elseif($level==8){
			return $this->db->get_where("data_satrad",array("id"=>$id))->row();
		}
		
	}
	function dataLevel($id)
	{
		return $this->db->get_where("main_level",array("id_level"=>$id))->row();
	}
	function cekMaxIdAdmin()
	{
		$db=$this->db->query("select CONCAT(MAX(id_admin)+1) as max from admin")->row();
		return $db->max;
	}
	//END PROFILE-----------------------------------------------
	//LOGIN-----------------------------------------------
	function logSave($tabel,$aksi,$profilename)
	{	
		$idu=$this->session->userdata("id");
		$this->_hapusLog();
		$data=array(
		"id_admin"=>$idu,
		"nama_user"=>$profilename,
		"table_updated"=>$tabel,
		"aksi"=>$aksi,
		"tgl"=>date('Y-m-d H:i:s'),
		);
		return $this->db->insert("main_log",$data);
	}
	private function _hapusLog()
	{
		$jmlLog=$this->db->get("main_log")->num_rows();
		$batasLog=$this->konfigurasi(10);
		if($batasLog<$jmlLog)
		{
		return $this->db->truncate("main_log");
		}
	}
	function getAdmin($id)
	{
		$data=$this->dataProfile($id);
		return $data;
	}
	function getOwner($id,$getTable)
	{
		$this->db->where("id_admin",$id);
		$this->db->select("profilename");
		return $this->db->get($getTable)->row();	
	}
	//END LOGIN--------------------------------------
	//UG-----------------------------------------------
	function getDataUG()
	{
		$this->db->order_by("id_level","ASC");
		return $this->db->get("main_level")->result();
	}
	function getIdUG($id)//id_level
	{
		$this->db->where("id_level",$id);
		$data=$this->db->get("main_level")->row();
		return $data->id_level;
	}
	function getNamaUG($id)
	{
		$this->db->where("id_level",$id);
		$data=$this->db->get("main_level")->row();
		return strtoupper($data->levelname);
	}
	//END UG-----------------------------------------------
	function validasi_session($id)
	{
		$sesi=$this->session->userdata("level");
		$this->db->where_not_in("levelname",$id);
		foreach($this->getDataUG() as $data)
		{
			if(strtolower($sesi)==strtolower($data->code_level)){
			redirect($data->direct); 
			}
		}
		if(!$sesi){ redirect("login/logout");  };
	}
	
	/*
	
	///////////////////Golongan validasi
	function validasi_global()
	{
		$sesi=$this->session->userdata("level");
		if(!$sesi)
		{
		redirect("login/logout");
		}
	}
	
	function validasi_login()
	{
	$this->db->order_by("id_level","ASC");
	$db=$this->db->get("main_level")->result();
		$sesi=$this->session->userdata("level");
		foreach($db as $data)
		{
		if($sesi==$data->nama){
		redirect($data->direct); 
		}
		}
	  
	}
	//-------------------------------------------------------------------------------------//
	function logMasuk($tabel,$aksi,$nama=null)
	{	
		if($nama==null){	$admin=$this->getAdminMasuk($id=$this->session->userdata("id"),$tabel); $nama=$admin->nama;};
		$id=$this->session->userdata("id");
		$this->_hapusLog();
		$data=array(
		"id_admin"=>$id,
		"nama_user"=>$nama,
		"table_updated"=>$tabel,
		"aksi"=>$aksi,
		"tgl"=>date('Y-m-d H:i:s'),
		);
		return $this->db->insert("main_log",$data);
	}
	
	
	function getAdminMasuk($id,$tabel)
	{
	return $this->db->get_where($tabel,array("id"=>$id))->row();
	}
	
	
	
	
	
	
	
	
	function dataKonfig($id)
	{
	$data=$this->db->get_where("main_konfig",array("id_konfig"=>$id))->row();
	return $data->value;
	}
	function maxMenu()
	{
	$db=$this->db->query("select MAX(id_menu) as max from main_menu")->row();
	return $db->max+1;
	}
	
	
	
	
	
	
	
	
	
	
	function namaAplikasi()
	{	$this->db->where("id_pengaturan","3");
		$data=$this->db->get("pengaturan")->row();
		return isset($data->val)?($data->val):"";
	}
	function headerText()
	{
	$ID=$this->session->userdata("id");
	$this->db->where("ID",$ID);
	$data=$this->db->get("pbk_groups")->row();
	$datax=isset($data->Name)?($data->Name):"0";
		if($datax){
			return $data->Name;
		}else
		{
			return $this->namaAplikasi();
		}
	}
	function kodeAkun()
	{
	$ID=$this->session->userdata("id");
	$this->db->where("ID",$ID);
	$data=$this->db->get("pbk_groups")->row();
	return isset($data->key)?($data->key):"";
	}
	
	function kodeApi()
	{
	$ID=$this->session->userdata("id");
	$this->db->where("id_admin",$ID);
	$data=$this->db->get("admin")->row();
	return isset($data->key)?($data->key):"";
	}
	
	function nomorBlokir()
	{
	$ID=$this->session->userdata("id");
	$this->db->where("ID",$ID);
	$data=$this->db->get("pbk_groups")->row();
	return isset($data->blokir)?($data->blokir):"";
	}
	
	function jmlSMSskrg($id)
	{
	$this->db->where("CreatorID",$id);
	$data=$this->db->get("inbox")->num_rows();
	return $data;
	}
	
	function smsReg()
	{
	$ID=$this->session->userdata("id");
	$this->db->where("ID",$ID);
	$data=$this->db->get("pbk_groups")->row();
	return $data->sms_reg;
	}
	
	function no_center()
	{
	$ID=$this->session->userdata("id");
	$this->db->where("ID",$ID);
	$data=$this->db->get("pbk_groups")->row();
	return $data->no_center;
	}
	function batasInbox()
	{
	$this->m_konfig->validasi_session(array("user","admin"));
	$id=$this->session->userdata("id");
	$this->db->where("ID",$id);
	$data=$this->db->get("pbk_groups")->row();
	echo $data->batas_inbox;
		
	}
	function batasOutbox()
	{
	$this->m_konfig->validasi_session(array("user","admin"));
	$id=$this->session->userdata("id");
	$this->db->where("ID",$id);
	$data=$this->db->get("pbk_groups")->row();
	echo $data->batas_outbox;
		
	}
	function smsUnReg()
	{
	$ID=$this->session->userdata("id");
	$this->db->where("ID",$ID);
	$data=$this->db->get("pbk_groups")->row();
	return $data->sms_unreg;
	}
	function getTitle()
	{	
		$ID=$this->session->userdata("id");	
		$this->db->where("ID",$ID);
		$this->db->select("title");
		$data=$this->db->get("pbk_groups")->row();
		$title=explode("_:|:_",$data->title);
		$no=2;
		$kode="";
		foreach($title as $title)
		{
		$kode.=$title."#";
		}
	echo substr($kode,0,-1);	
	}
	
 
	function namaSub($id)
	{
		$this->db->where("id",$id);
		$data=$this->db->get("sub_group")->row();
		return isset($data->nama_sub_group)?($data->nama_sub_group):"";
	}*/
  
}