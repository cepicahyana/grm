<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_super extends CI_Model
{
	var $main_level="main_level";
	var $main_menu="main_menu";
	var $data_user="admin";
	var $data_log="main_log";
	public function __construct() {
        parent::__construct();
    }
	
	function count_level()
	{	
		$this->db->from($this->main_level);
		$query = $this->db->get();
		return $query->num_rows();
	}
	function count_user($id)
	{	
		$this->db->from($this->data_user);
		if($id>=1){
			$this->db->where('sts_aktif',$id);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_log()
	{	
		$this->db->from($this->data_log);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	//------------------------------------------------------------------------
	function insert_UG()
	{
		$var=array();

		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);
		
		$levelname=$this->input->post("f[levelname]");
		$code_level=$this->input->post("f[code_level]");
		
		$this->db->where("levelname",$levelname);
		$cek=$this->db->get($this->main_level)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Not allowed, levelname already exists.";
			return $var;
		}
		
		$this->db->where("code_level",$code_level);
		$cek2=$this->db->get($this->main_level)->num_rows();
		if($cek2)
		{
			$var['gagal']=false;
			$var['info']="Not allowed, code level already exists.";
			return $var;
		}

			$ctime=date("Y-m-d H:i:s"); 
			$cid=$idu;

			$this->db->set("_ctime",$ctime);
			$this->db->set("_cid",$cid);
			$this->db->set($datainputan);
			$this->db->insert($this->main_level);
			return $var; 	 
	}
	function edit_UG()
	{
		$id=$this->input->post("id");
		$this->db->from($this->main_level);
		$this->db->where('id_level',$id);
		$query = $this->db->get();
		return $query->row();
	}
	function update_UG()
	{
		$var=array();

		$idu=$this->session->userdata("id");
		$id=$this->input->post("id_level");
		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);
		
		$levelname=$this->input->post("f[levelname]");
		$levelname_b=$this->input->post("levelname_b");
		
		$code_level=$this->input->post("f[code_level]");
		$code_level_b=$this->input->post("code_level_b");

		$this->db->where("levelname!=",$levelname_b);
		$this->db->where("levelname",$levelname);
		$cek=$this->db->get($this->main_level)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Not allowed, levelname already exists.";
			return $var;
		}
		
		$this->db->where("code_level!=",$code_level_b);
		$this->db->where("code_level",$code_level);
		$cek=$this->db->get($this->main_level)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Not allowed, code level already exists.";
			return $var;
		}
		
			$utime=date("Y-m-d H:i:s"); 
			$uid=$idu;

			$this->db->set("_utime",$utime);
			$this->db->set("_uid",$uid);
			$this->db->set($datainputan);  
			$this->db->where("id_level",$id);
			$this->db->update($this->main_level);
			return $var;

	}
	function delete_UG()
	{
		$id=$this->input->post("id");
		$this->db->where("id_level",$id);
		return $this->db->delete($this->main_level);
	}
	
	
	
	//-------------------------------------------------------------------------------
	function dataMenuLevel($id)
	{
		$this->db->from($this->main_menu);
		$this->db->where("hak_akses",$id);
		$this->db->order_by("id_menu","ASC");
		$query = $this->db->get();
		return $query->result();
	}
	function insert_Menu()
	{
		$var=array();

		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);
		
		$level=$this->input->post("f[level]");
		$main=$this->input->post("main");
		$name=$this->input->post("f[nama]");
		$hak=$this->input->post("f[hak_akses]");
		$cek=$this->db->query("select nama FROM ".$this->main_menu." WHERE nama='".$name."' AND hak_akses='".$hak."'")->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Not allowed, code or name already exists.";
			return $var;
		}

			$ctime=date("Y-m-d H:i:s"); 
			$cid=$idu;
			if($level=='2'){
				$this->db->set("dropdown","yes");  
				$this->db->where("id_menu",$main);
				$this->db->update($this->main_menu);
				$this->db->set("id_main",$main);
				}
			$this->db->set("_ctime",$ctime);
			$this->db->set("_cid",$cid);
			$this->db->set("dropdown","no");
			$this->db->set($datainputan);
			$this->db->insert($this->main_menu);
			return $var; 	 
	}
	function edit_Menu()
	{
		$id=$this->input->post("id");
		$this->db->from($this->main_menu);
		$this->db->where('id_menu',$id);
		$query = $this->db->get();
		return $query->row();
	}
	function update_Menu()
	{
		$var=array();

		$idu=$this->session->userdata("id");
		$id=$this->input->post("id_menu");
		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);
		
		$level=$this->input->post("f[level]");
		$dropdown=$this->input->post("f[dropdown]");
		$hak_akses=$this->input->post("f[hak_akses]");
		$main=$this->input->post("main");
		$name=$this->input->post("f[nama]");
		$name_b=$this->input->post("nama_b");
		$main_b=$this->input->post("main_b");

		$this->db->where("nama!=",$name_b);
		$this->db->where('nama',$name);
		$this->db->where('hak_akses',$hak_akses);
		$cek=$this->db->get($this->main_menu)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Not allowed, code or name already exists.";
			return $var;
		}
		
			$utime=date("Y-m-d H:i:s"); 
			$uid=$idu;
			if($level=='1'){
				$this->db->set("dropdown",$dropdown); 
				$this->db->set("id_main",0);
				$this->db->set("_utime",$utime);
				$this->db->set("_uid",$uid);
				$this->db->set($datainputan);  
				$this->db->where("id_menu",$id);
				$this->db->update($this->main_menu);
			}elseif($dropdown=='yes'){
				$this->db->set("dropdown",$dropdown); 
				$this->db->set("id_main",0);
				$this->db->set("_utime",$utime);
				$this->db->set("_uid",$uid);
				$this->db->set($datainputan);  
				$this->db->where("id_menu",$id);
				$this->db->update($this->main_menu);
			}elseif($level=='2'){
				$this->db->set("dropdown",$dropdown); 
				$this->db->set("id_main",$main);
				$this->db->set("_utime",$utime);
				$this->db->set("_uid",$uid);
				$this->db->set($datainputan);  
				$this->db->where("id_menu",$id);
				$this->db->update($this->main_menu);
			}
			return $var;
	}
	function delete_Menu()
	{
		$var=array();
		$id=$this->input->post("id");
		$level=$this->input->post("level");
		$sub=$this->db->get_where($this->main_menu,array('id_main'=>$id))->result();
		$jmlsub=$this->db->get_where($this->main_menu,array('id_main'=>$id))->num_rows();

		if($jmlsub>0){
			foreach($sub as $submenu)
			{
			$this->db->set("level","1");
			$this->db->set("id_main","0");	
			$this->db->where("id_menu",$submenu->id_menu);
			$this->db->update($this->main_menu);
			}
		}
		
		$this->db->where("id_menu",$id);
		$this->db->delete($this->main_menu);
		return $var;
		
	}
	
	
	
	//-------------------------------------------------------------------------------
	function get_data_user()
	{
		
		$this->_get_datatables_user();
		if($this->input->post("length") != -1) 
		$this->db->limit($this->input->post("length"),$this->input->post("start"));
	 	return $this->db->get()->result();
	}
	private function _get_datatables_user()
	{	
		 $this->db->where("level!=","1"); 
	 
		 if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"profilename"=>$searchkey,
				"username"=>$searchkey,
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}
		 
		$query=$this->db->from($this->data_user);
		return $query;
	
	}
	
	public function count_data_user()
	{		
		$this->_get_datatables_user();
		return $this->db->get()->num_rows();
	}
	function insert_User()
	{
		$var=array();

		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);
		
		$username=$this->input->post("f[username]");
		$password=md5($this->input->post("password"));
		//cek dulu
		$this->db->where("username",$username);
		$cek=$this->db->get($this->data_user)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Not allowed, username already exists.";
			return $var;
		}

		///
		$img=$this->m_reff->upload_file("profileimg","theme/images/user/","fileadmin","JPG,JPEG,PNG","500000",null);
		if($img['validasi']==true){
			$this->db->set("profileimg",$img['name']);
		}
		$this->db->set("password",$password);
		$this->db->set($datainputan);
		$this->db->insert($this->data_user);
		$var['table']=true;
		return $var; 
				 
	}
	function edit_User()
	{
		$id=$this->input->post("id");
		$this->db->from($this->data_user);
		$this->db->where('id_admin',$id);
		$query = $this->db->get();
		return $query->row();
	}
	function update_User()
	{
		$var=array();
		$id=$this->input->post("id_admin");
		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);
		
		$username=$this->input->post("f[username]");
		$username_b=$this->input->post("username_b");
		$profileimg_b=$this->input->post("profileimg_b");
		$password=$this->input->post("password");
		$passwordconvert=md5($password);

		$this->db->where("username!=",$username_b);
		$this->db->where('username',$username);
		$cek=$this->db->get($this->data_user)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Not allowed, Username already exists.";
			return $var;
		}
		///
		$img=$this->m_reff->upload_file("profileimg","theme/images/user/","fileadmin","JPG,JPEG,PNG","500000",$profileimg_b);
		if($img['validasi']==true){
			$this->db->set("profileimg",$img['name']);
		}
		$this->db->set($datainputan); 
		if($password!=''){$this->db->set("password",$passwordconvert);}
		$this->db->where("id_admin",$id);
		$this->db->update($this->data_user);
		$var['table']=true;
		return $var;
	}
	function delete_User()
	{
		$var=array();
	    $id=$this->input->post("id");
		$this->db->select("profileimg");
		$this->db->where("id_admin",$id);
		$del=$this->db->get($this->data_user)->row();
		$image=isset($del->profileimg)?($del->profileimg):'';
		$structure = './theme/images/user/'.$image.'';
		unlink($structure);
		if($del)
		{
			$this->db->where("id_admin",$id);
			$this->db->delete($this->data_user);
			$var['table']=true;
			return $var;
		}
	}
	
	//-------------------------------------------------------------------------------
	function update_Config()
	{
		$time=date('His');
		
		$var=array();
		$loggo=$this->input->post("loggo");
		$loggo_b=$this->input->post("loggo_b");
		$fav=$this->input->post("fav");
		$fav_b=$this->input->post("fav_b");
		$loggo_login=$this->input->post("loggo_login");
		$loggo_login_b=$this->input->post("loggo_login_b");
		$loggo_admin=$this->input->post("loggo_admin");
		$loggo_admin_b=$this->input->post("loggo_admin_b");
		//if($loggo){
			$img=$this->m_reff->upload_file("loggo","theme/images/","file_a","JPG,JPEG,PNG","500000",$loggo_b);
			if($img['validasi']==true){
				$data=array("value"=>$img['name']);
				$this->db->where("id_konfig","1");
				$this->db->update("main_konfig",$data);
			}
		//}
		//if($fav){
			$img2=$this->m_reff->upload_file("fav","theme/images/","file_b","ICO,PNG","100000",$fav_b);
			if($img2['validasi']==true){
				$data2=array("value"=>$img2['name']);
				$this->db->where("id_konfig","2");
				$this->db->update("main_konfig",$data2);
			}
		//}
		//if($loggo_login){
			$img3=$this->m_reff->upload_file("loggo_login","theme/images/","file_c","JPG,JPEG,PNG","100000",$loggo_login_b);
			if($img3['validasi']==true){
				$data3=array("value"=>$img3['name']);
				$this->db->where("id_konfig","3");
				$this->db->update("main_konfig",$data3);
			}
		//}
		//if($loggo_admin){
			$img4=$this->m_reff->upload_file("loggo_admin","theme/images/","file_d","JPG,JPEG,PNG","100000",$loggo_admin_b);
			if($img4['validasi']==true){
				$data4=array("value"=>$img4['name']);
				$this->db->where("id_konfig","4");
				$this->db->update("main_konfig",$data4);
			}
		//}
		////////////////////
		for($i=5;$i<=14;$i++)
		{
			$input=$this->input->post("input".$i);
			$this->db->where("id_konfig",$i);
			$array=array("value"=>$this->security->xss_clean($input));
			$this->db->update("main_konfig",$array);
		}
		return $var;
		
	}
	
	
	//-------------------------------------------------------------------------------
	function get_data_log()
	{
		
		$this->_get_datatables_log();
		if($this->input->post("length") != -1) 
		$this->db->limit($this->input->post("length"),$this->input->post("start"));
	 	return $this->db->get()->result();
	}
	private function _get_datatables_log()
	{	
		 //$this->db->where("level","2"); 
	 
		 if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"nama_user"=>$searchkey,
				"aksi"=>$searchkey,
				"tgl"=>$searchkey,
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}
		 
		$query=$this->db->from($this->data_log);
		return $query;
	
	}
	public function count_data_log()
	{		
		$this->_get_datatables_log();
		return $this->db->get()->num_rows();
	}
	function delete_Log()
	{
		$id=$this->input->post("id");
		$this->db->where("id_log",$id);
		return $this->db->delete($this->data_log);
	}








	public function updateMenu()
	{
	$data=array(
	"id_menu"=>$this->input->post("idmenu"),
	"nama"=>$this->input->post("Nama"),
	"level"=>$this->input->post("Level"),
	"icon"=>$this->input->post("Icon"),
	"hak_akses"=>$this->input->post("Hak"),
	"link"=>$this->input->post("Link"),
	);
	
	if($this->input->post("Level")==2){
	$data2=array("id_main"=>$this->input->post("Induk"));
	$data=array_merge($data,$data2);
	}
	
	$this->db->where("id_menu",$this->input->post("menuIdLama"));
	return $this->db->update("main_menu",$data);
	}
	
	
/*	
	function editMenu($id)
	{
	$this->db->where("id_menu",$id);
	return $this->db->get("main_menu")->row();
	}
	
	private function _cekDel($id)
	{
	$this->db->where("id_admin!=",$this->session->userdata('id'));
	$this->db->where("id_admin",$id);
	return $this->db->get("admin")->num_rows();
	}
	
	public function deleted_UG($id)
	{
	$daprof=$this->dataProfile($id);
	$path = "file_upload/dp/".$daprof->poto;
	
	$cekiddel=$this->_cekDel($id);	
	if($cekiddel){			 
				 if (file_exists($path)) {
					unlink($path);
				 }
	};			 
	
	$this->db->where("id_admin!=",$this->session->userdata('id'));
	$this->db->where("id_admin",$id);
	$data=$this->db->delete("admin");
	}
		
	public function deleted_log($id)
	{	
	$this->db->where("id_log",$id);
	return $this->db->delete("main_log");
	}
	
	public function HapusMenu($id)
	{
	$this->db->where("id_menu",$id);
	return $this->db->delete("main_menu");
	}	
	
	public function updateIdMain($id)
	{
	$this->db->where("id_menu",$id);
	return $this->db->update("main_menu",array("id_main"=>1));
	}	
	function simpanMenu()
	{
	$data=array(
	"id_menu"=>$this->input->post("idmenu"),
	"nama"=>$this->input->post("Nama"),
	"level"=>$this->input->post("Level"),
	"id_main"=>$this->input->post("Induk"),
	"icon"=>$this->input->post("Icon"),
	"hak_akses"=>$this->input->post("Hak"),
	"link"=>$this->input->post("Link"),
	);
	return $this->db->insert("main_menu",$data);
	}
	
	
	function dataProfile($id)
	{
	return $this->db->get_where("admin",array("id_admin"=>$id))->row();
	}
	
	function dataKonfig($id)
	{
	$data=$this->db->get_where("main_konfig",array("id_konfig"=>$id))->row();
	return $data->value;
	}

	
*/	
	
	
	
	
	
	
	
	function getUG($id)
	{
	$this->db->where("id_level",$id);
	return $this->db->get("main_level")->row();
	}
		
	///-----------------------------------ajax//
	private function _get_datatables_open()
	{
	$query="select *,b.nama as namaGroup from admin a,main_level b where a.level=b.id_level ";
	
	if($this->uri->segment(3))
		{
		$id=$this->uri->segment(3);
		$query.="AND a.level='".$id."' ";
		}
	
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			b.nama LIKE '%".$searchkey."%' or 
			nama LIKE '%".$searchkey."%' or 
			telp LIKE '%".$searchkey."%' or 
			email LIKE '%".$searchkey."%'
			) ";
		}

		$column = array('','poto','nama','telp','email','namaGroup');
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		//	$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			$query.=" order by ".$column[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir'] ;
		} 
		else if(isset($order))
		{
			$order = $order;
		//	$this->db->order_by(key($order), $order[key($order)]);
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
	private function _get_datatables_open_log()
	{
	$query="select * from main_log a LEFT JOIN main_level b ON a.id_admin=b.id_level WHERE 1=1 ";
	
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			nama LIKE '%".$searchkey."%' or 
			nama_user LIKE '%".$searchkey."%' or 
			table_updated LIKE '%".$searchkey."%' or 
			aksi LIKE '%".$searchkey."%' OR 
			tgl LIKE '%".$searchkey."%'  
			) ";
		}

		$column = array('','tgl','nama','nama_user','table_updated','aksi');
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		//	$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			$query.=" order by ".$column[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir'] ;
		} 
		else if(isset($order))
		{
			$order = $order;
		//	$this->db->order_by(key($order), $order[key($order)]);
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}
	
	function get_open()
	{
		
		$query=$this->_get_datatables_open();
		if($_POST['length'] != -1)
		//$this->db->limit($_POST['length'], $_POST['start']);
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		//if($keyword=$this->uri->segment(3)){ $this->db->like('TextDecoded',$keyword);};
		
		//$query = $this->db->get();
		return $this->db->query($query)->result();
	}
	
	function get_open_log()
	{
		
		$query=$this->_get_datatables_open_log();
		if($_POST['length'] != -1)
		//$this->db->limit($_POST['length'], $_POST['start']);
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		//if($keyword=$this->uri->segment(3)){ $this->db->like('TextDecoded',$keyword);};
		
		//$query = $this->db->get();
		return $this->db->query($query)->result();
	}
	public function count_file_log($tabel)
	{		
		
		$this->db->from($tabel);
		return $this->db->count_all_results();
	}
	
	public function count_file($tabel)
	{		
		
		$this->db->from($tabel);
		return $this->db->count_all_results();
	}
	function count_filtered($tabel)
	{
		$this->db->from($tabel);
		$query=$this->_get_datatables_open();
		return $this->db->query($query)->num_rows();
	}
	function getDataUser($id) //id_file
	{
	$this->db->where("id_admin",$id);
	$this->db->join("main_level b","a.level=b.id_level");
	$this->db->from("admin a");
	return $this->db->get()->row();
	}
	///////-----------------------------------------------------
	
}

?>