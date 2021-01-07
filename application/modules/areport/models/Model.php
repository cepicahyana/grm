<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends ci_Model
{
	var $tbl="data_object";
	var $tbl_history="tr_object";
	public function __construct() {
        parent::__construct();
    }
	
	
	/*===================================*/
	public function get_data()
	{
		$this->_get_datatables();
		if($this->input->post("length") != -1) 
		$this->db->limit($this->input->post("length"),$this->input->post("start"));
	 	return $this->db->get()->result();
	}
	private function _get_datatables()
	{	
		$f1=$this->input->post("f1");
		if($f1!=''){
			$this->db->where("code_object",$f1); 
		}
		 
		 if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
					"code_object"=>$searchkey,
					"name_object"=>$searchkey,
					"no_object"=>$searchkey
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}
		$this->db->order_by("id","asc"); 
		$query=$this->db->from($this->tbl);
		return $query;
	
	}	
	public function count_data()
	{		
		$this->_get_datatables();
		return $this->db->get()->num_rows();
	}
	

	function insert_data()
	{
		$var=array();

		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);

		$tanggal_deteksi=$this->input->post("date_detected");
		$date_detected=$this->tanggal->engdatetime($tanggal_deteksi," ");
		//$judul=$this->input->post("f[judul]");
		//cek dulu
		/*$this->db->where("judul",$judul);
		$cek=$this->db->get($this->tbl)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Tidak diizinkan, judul sudah dibuat.";
			return $var;
		}*/
		$act="insert";
		$ctime=date("Y-m-d H:i:s"); 
		$img=$this->m_reff->upload_file("imgobject","theme/images/object/","object","JPG,JPEG,PNG","1000000",null);
		if($img['validasi']==true){
			$this->db->set("imgobject",$img['name']);
		}
		$this->db->set("date_detected",$date_detected);
		$this->db->set("status_data",$act);
		$this->db->set("_ctime",$ctime);
		$this->db->set("_cid",$idu);
		$this->db->set($datainputan);
		$this->db->insert($this->tbl);
		$this->update_historiobject($id=null,$datainputan,$date_detected,$idu,$ctime,$act);
		$var['object']=true;
		return $var; 	 
	}	
	function edit_data()
	{
		$id=$this->input->post("id");
		$this->db->from($this->tbl);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	function update_data()
	{
		$var=array();

		$idu=$this->session->userdata("id");
		$id=$this->input->post("id");
		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);
		
		$tanggal_deteksi=$this->input->post("date_detected");
		$date_detected=$this->tanggal->engdatetime($tanggal_deteksi," ");
		$imgobject_b=$this->input->post("imgobject_b");

		//$tanggal_lahir=$this->input->post("tanggal_lahir");
		//$tgl_lahir=$this->tanggal->eng_($tanggal_lahir,0);
		//cek dulu
		/*$this->db->where("judul!=",$judul_b);
		$this->db->where('judul',$judul);
		$cek=$this->db->get($this->tbl)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Tidak diizinkan, judul sudah dibuat.";
			return $var;
		}*/
		$act="update";
		$ctime=date("Y-m-d H:i:s"); 
		$img=$this->m_reff->upload_file("imgobject","theme/images/object/","object","JPG,JPEG,PNG","1000000",$imgobject_b);
		if($img['validasi']==true){
			$this->db->set("imgobject",$img['name']);
		}

		$this->db->set("date_detected",$date_detected);
		$this->db->set("status_data",$act);
		$this->db->set("_ctime",$ctime);
		$this->db->set("_cid",$idu);
		$this->db->set($datainputan);  
		$this->db->where("id",$id);
		$this->db->update($this->tbl);
		$this->update_historiobject($id,$datainputan,$date_detected,$idu,$ctime,$act);
		$var['object']=true;
		return $var;
	}
	function update_historiobject($id,$datainputan,$date_detected,$idu,$itime,$act)
	{
		//$var=array();
		$date_detected	=isset($date_detected)?($date_detected):'';
		$_tid			=isset($idu)?($idu):'';
		$_ttime			=isset($itime)?($itime):'';

		$this->db->set("date_detected",$date_detected);
		$this->db->set("status_data",$act);
		$this->db->set($datainputan);
		$this->db->set("_tid",$_tid);
		$this->db->set("_ttime",$_ttime);
		$this->db->insert($this->tbl_history);
		//$var['table']=true;
		//return $var;
	}
	function count_pengumuman()
	{
		//$id=$this->input->post("id");
		$total=$this->db->get_where($this->tbl,array('sts'=>'Publish'))->num_rows();
		$totalRow=isset($total)?($total):'0';

		$idsession=$this->session->userdata("id");
		$this->db->from($this->tbl);
		$this->db->like('viewer', $idsession);
		$this->db->where('sts','Publish');
		$query = $this->db->get();
		$rowread=$query->num_rows();

		$hasil=$totalRow-$rowread;

		return $hasil;
	}
	
	function delete_item()
	{
		$var=array();
		$idu=$this->session->userdata("id");
		$id=$this->input->get_post("id");
		$dataDB=$this->db->get_where($this->tbl,array('id'=>$id))->row();
			$id_object=isset($dataDB->id)?($dataDB->id):'';
			$code_object=isset($dataDB->code_object)?($dataDB->code_object):'';
			$kategori=isset($dataDB->kategori)?($dataDB->kategori):'';
			$name_object=isset($dataDB->name_object)?($dataDB->name_object):'';
			$no_object=isset($dataDB->no_object)?($dataDB->no_object):'';
			$date_detected=isset($dataDB->date_detected)?($dataDB->date_detected):'';
			$sts_object=isset($dataDB->sts_object)?($dataDB->sts_object):'';
			$type_object=isset($dataDB->type_object)?($dataDB->type_object):'';
			$nasionality=isset($dataDB->nasionality)?($dataDB->nasionality):'';
			$lat_object=isset($dataDB->lat)?($dataDB->lat):'';
			$lng_object=isset($dataDB->lng)?($dataDB->lng):'';
			$_cid=isset($dataDB->_cid)?($dataDB->_cid):'';
			$_ctime=isset($dataDB->_ctime)?($dataDB->_ctime):'';
			$datainputan=array(
				"code_object"=>$code_object,
				"kategori"=>$kategori,
				"name_object"=>$name_object,
				"no_object"=>$no_object,
				"sts_object"=>$sts_object,
				"type_object"=>$type_object,
				"nasionality"=>$nasionality,
				"lat"=>$lat_object,
				"lng"=>$lng_object
			);
		$act="trash";
		$ctime=date("Y-m-d H:i:s"); 
		$this->db->set("status_data",$act);
		$this->db->set("_ctime",$ctime);
		$this->db->set("_cid",$idu);
		$this->db->where("id",$id);
		$this->db->update($this->tbl);
		$this->update_historiobject($id,$datainputan,$date_detected,$idu,$ctime,$act);
		$var['object']=true;
		return $var;
	}
	function delete_permanent()
	{
		$var=array();
		$idu=$this->session->userdata("id");
	    $id=$this->input->get_post("id");
		$dataDB=$this->db->get_where($this->tbl,array('id'=>$id))->row();
			$image=isset($dataDB->imgobject)?($dataDB->imgobject):'';
			$id_object=isset($dataDB->id)?($dataDB->id):'';
			$code_object=isset($dataDB->code_object)?($dataDB->code_object):'';
			$kategori=isset($dataDB->kategori)?($dataDB->kategori):'';
			$name_object=isset($dataDB->name_object)?($dataDB->name_object):'';
			$no_object=isset($dataDB->no_object)?($dataDB->no_object):'';
			$date_detected=isset($dataDB->date_detected)?($dataDB->date_detected):'';
			$sts_object=isset($dataDB->sts_object)?($dataDB->sts_object):'';
			$type_object=isset($dataDB->type_object)?($dataDB->type_object):'';
			$nasionality=isset($dataDB->nasionality)?($dataDB->nasionality):'';
			$lat_object=isset($dataDB->lat)?($dataDB->lat):'';
			$lng_object=isset($dataDB->lng)?($dataDB->lng):'';
			$_cid=isset($dataDB->_cid)?($dataDB->_cid):'';
			$_ctime=isset($dataDB->_ctime)?($dataDB->_ctime):'';
			$datainputan=array(
				"code_object"=>$code_object,
				"kategori"=>$kategori,
				"name_object"=>$name_object,
				"no_object"=>$no_object,
				"sts_object"=>$sts_object,
				"type_object"=>$type_object,
				"nasionality"=>$nasionality,
				"lat"=>$lat_object,
				"lng"=>$lng_object
			);
		$act="delete";
		$ctime=date("Y-m-d H:i:s"); 
		$this->update_historiobject($id,$datainputan,$date_detected,$idu,$ctime,$act);
		if($image!=null){
			$structure = './theme/images/object/'.$image.'';
			if(file_exists($structure)){
				unlink($structure);
			}
		}
		$this->db->where("id",$id);
		$this->db->delete($this->tbl);
		$var['table']=true;
		return $var;
	}
	
	function import_Data()
	{	
		$var=array();
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		 
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["file"]['tmp_name']))
		{
			return $this->importFile("file");
			 
		}else{
			return $var;
		}
		
	}
	function importFile($file_form)
	{		
		$this->load->library("PHPExcel");
		$insert=0;$gagal=0;$edit=0;$validasi=true;
		$file   = explode('.',$_FILES[$file_form]['name']);
		$length = count($file);
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){
         $tmp    = $_FILES[$file_form]['tmp_name']; 
	 
			    $load = PHPExcel_IOFactory::load($tmp);
                $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
				$i=1;$no=0;
				    	 //$kode_korwil=$this->input->get_post("f[kode_korwil]");
				foreach ($sheets as $sheet) {
				if ($i > 1) 
				{
    				     //$nis=$this->mdl->innis(); 
						  //$tanggal_lahir = PHPExcel_Style_NumberFormat::toFormattedString($sheet[4],  'YYYY-MM-DD');
						 $namadata=isset($sheet[1])?($sheet[1]):"";
    				     $descdata=isset($sheet[2])?($sheet[2]):"";
    				     $lat=isset($sheet[3])?($sheet[3]):"";
    				     $lng=isset($sheet[4])?($sheet[4]):"";
						 
						//$tgl=str_replace("/","-",$tanggal_lahir);
						/*$pecah=explode("/",$tanggal_lahir);
						$y=isset($pecah[2])?($pecah[2]):'';
						$m=isset($pecah[1])?($pecah[1]):'';
						$d=isset($pecah[0])?($pecah[0]):'';
						$tgl_lahir=$y.'-'.$m.'-'.$d;

						$kelasDB=$this->db->where("kelas",$kelas);
						$kelasDB=$this->db->get("tm_kelas")->row();
						$kd_kelas=isset($kelasDB->kode)?($kelasDB->kode):'';

						 //$tgl_berlaku=$this->tanggal->format($tgl_berlaku); 
						 //$tgl_kadaluarsa=$this->tanggal->addBulan($tgl_berlaku,36);
						 /*$cek_ktp=$this->db->query("select * from data_kartu where ktp='$ktp' ")->num_rows();
						 if($cek_ktp)
						 {
                			  $var["info"]="KTP ada yang sama di nomor urut :".($i-1);
                			  $var["gagal"]=false;
								return $var;
						 }*/

				   
							if($namadata)
							{
							//	 $kode_gardu=isset($sheet[$no++])?($sheet[$no]):"";
							//	 $kode_gardu=str_replace("`","",$kode_gardu);
							//	 $kode_gardu=str_replace("'","",$kode_gardu);
							//	 $kode_gardu=sprintf("%03s", $kode_gardu);
							
								$cek1=$this->db->get_where($this->tbl,array("namadata"=>$namadata))->num_rows();
								if($cek1){	
									$dataray=array(
										"namadata"=>$namadata,
										"descdata"=>$descdata,
										"lat"=>$lat,
										"lng"=>$lng,
										"_uid"=>$this->m_reff->idu(),
										"_utime"=>date("Y-m-d H:i:s")
									);
									$this->update_dataExcel($dataray);
									$edit++;
									//$this->qr($noida);
								}else{
									$dataray=array(
										"namadata"=>$namadata,
										"descdata"=>$descdata,
										"lat"=>$lat,
										"lng"=>$lng,
										"_cid"=>$this->m_reff->idu(),
										"_ctime"=>date("Y-m-d H:i:s")
										);
										//if($nis){
									$this->insert_dataExcel($dataray);
									$insert++;
									//$this->qr($noida);
										//}
								}
							}
					
				}
				$i++;
                }
		}else{
			 $var["file"]=false;
			 $var["type_file"]="xlsx";
		}
		$var["import_data"]=true;
		$var["data_insert"]=$insert;
		$var["data_gagal"]=$gagal;
		$var["data_edit"]=$edit;
		$var["validasi"]=$validasi;
		return $var;
	}
	function update_dataExcel($dataray)
	{
		$this->db->where("namadata",$dataray['namadata']);
		return	$this->db->update($this->tbl,$dataray);
	}
	function insert_dataExcel($dataray)
	{
		return	$this->db->insert($this->tbl,$dataray);
	}
	/*function innia(){
	    //if(!$val){	return false;	}
	    $t=$this->db->query("SELECT(MAX(SUBSTR(noida,4,5))+1) as noida FROM data_member")->row();
		$idv=isset($t->noida)?($t->noida):''; 
		if(!$idv){     return "00001"; }
		return  	sprintf("%05s", $idv);
	}
	/*
	function kode_sistem(){
	    //if(!$val){	return false;	}
	    $t=$this->db->query("SELECT(MAX(SUBSTR(kode_sistem,4,5))+1) as kode_sistem FROM data_member")->row();
		$idv=isset($t->kode_sistem)?($t->kode_sistem):''; 
		if(!$idv){     return "SE00001"; }
		return  	sprintf("%05s", $idv); 
	}

	/*function qr($id)
	{
			
		 if($id){
			$filename = 'qr/'.$id;
			if (!file_exists($filename)) { 
					$this->load->library('ciqrcode');
					$params['data'] = $id;
					$params['level'] = 'H';
					$params['size'] = 10;
					$params['savename'] = FCPATH.'qr/'.$id.".png";
					return	$this->ciqrcode->generate($params);
			}
		 }
	 }*/




	/*===================================*/
	public function get_data_history()
	{
		$this->_get_datatables_history();
		if($this->input->post("length") != -1) 
		$this->db->limit($this->input->post("length"),$this->input->post("start"));
	 	return $this->db->get()->result();
	}
	private function _get_datatables_history()
	{	
		$f1=$this->input->post("f1");
		if($f1!=''){
			$this->db->where("code_object",$f1); 
		}
		 
		 if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"code_object"=>$searchkey,
				"name_object"=>$searchkey,
				"no_object"=>$searchkey
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}
		$this->db->order_by("id","asc"); 
		$query=$this->db->from($this->tbl_history);
		return $query;
	
	}	
	public function count_data_history()
	{		
		$this->_get_datatables_history();
		return $this->db->get()->num_rows();
	}



	public function get_data_historyALl()
	{
		$this->_get_datatables_historyAll();
		if($this->input->post("length") != -1) 
		$this->db->limit($this->input->post("length"),$this->input->post("start"));
	 	return $this->db->get()->result();
	}
	private function _get_datatables_historyAll()
	{	
		$f1=$this->input->post("f1");
		if($f1!=''){
			$this->db->where("kategori",$f1); 
		}
		 
		 if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"code_object"=>$searchkey,
				"name_object"=>$searchkey,
				"no_object"=>$searchkey
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}
		$this->db->order_by("id","asc"); 
		$query=$this->db->from($this->tbl_history);
		return $query;
	
	}	
	public function count_data_historyAll()
	{		
		$this->_get_datatables_historyAll();
		return $this->db->get()->num_rows();
	}
	
	 
	 



}

?>