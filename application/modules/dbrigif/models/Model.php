<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends ci_Model
{
	var $tbl="data_brigif";
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
		 //$this->db->where("level","3"); 
		 if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"namadata"=>$searchkey
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
		
		//$tanggal_lahir=$this->input->post("tanggal_lahir");
		//$tgl_lahir=$this->tanggal->eng_($tanggal_lahir,0);
		$namadata=$this->input->post("f[namadata]");
		//cek dulu
		$this->db->where("namadata",$namadata);
		$cek=$this->db->get($this->tbl)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Tidak diizinkan, nama sudah ada.";
			return $var;
		}
		$ctime=date("Y-m-d H:i:s"); 
		//$kode_sistem=$this->mdl->kode_sistem(); 
		//$this->db->set("tanggal_selesai",$tgl_selesai);

		$img=$this->m_reff->upload_file("imgdata","theme/images/data/","filelantamal","JPG,JPEG,PNG","10000",null);
		if($img['validasi']==true){
			$this->db->set("imgdata",$img['name']);
		}
		$this->db->set("level","6");
		$this->db->set("_ctime",$ctime);
		$this->db->set("_cid",$idu);
		$this->db->set($datainputan);
		$this->db->insert($this->tbl);
		$var['table']=true;
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
		
		$namadata=$this->input->post("f[namadata]");
		$namadata_b=$this->input->post("namadata_b");
		$imgdata_b=$this->input->post("imgdata_b");

		//$tanggal_lahir=$this->input->post("tanggal_lahir");
		//$tgl_lahir=$this->tanggal->eng_($tanggal_lahir,0);
		//cek dulu
		$this->db->where("namadata!=",$namadata_b);
		$this->db->where('namadata',$namadata);
		$cek=$this->db->get($this->tbl)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Tidak diizinkan, nama sudah ada.";
			return $var;
		}

		$utime=date("Y-m-d H:i:s"); 
		$img=$this->m_reff->upload_file("imgdata","theme/images/data/","filelantamal","JPG,JPEG,PNG","10000",$imgdata_b);
		if($img['validasi']==true){
			$this->db->set("imgdata",$img['name']);
		}
		$this->db->set("level","6");
		$this->db->set("_utime",$utime);
		$this->db->set("_uid",$idu);
		$this->db->set($datainputan);  
		$this->db->where("id",$id);
		$this->db->update($this->tbl);
		$var['table']=true;
		return $var;
	}
	
	
	function delete_item()
	{
		$var=array();
	    $id=$this->input->get_post("id");
		$this->db->select("imgdata");
		$this->db->where("id",$id);
		$del=$this->db->get($this->tbl)->row();
		$image=isset($del->imgdata)?($del->imgdata):'';
		
		if($image!=null){
			$structure = './theme/images/data/'.$image.'';
			if(file_exists($structure)){
				unlink($structure);
			}
		}

		$this->db->where("id",$id);
		$this->db->delete($this->tbl);
		$var['table']=true;
		return $var;
	}
	function delete_sel()
	{
		$var=array();
		$ct=$this->input->post('ct');
		$arrayct=explode(",",$ct); //potong
		$a = '';
		foreach($arrayct as $i=>$arrayctlist):
			 $a .= ",'".$arrayctlist."'";
		endforeach;
		$arrayct_a = substr($a,1); //convert
		
		$arrayct1=$arrayct[0]; //array awal
		$jmlrowct=count($arrayct); //jumlah row

		$del=$this->db->query("SELECT * FROM ".$this->tbl." WHERE id IN (".$arrayct_a.")")->result();
		foreach($del as $d){
			$image=isset($d->imgdata)?($d->imgdata):'';
			if($image!=null){
				$structure = './theme/images/data/'.$image.'';
				if(file_exists($structure)){
					unlink($structure);
				}
			}
		}
		if($del){
			$sql=$this->db->query("DELETE FROM ".$this->tbl." WHERE id IN (".$arrayct_a.")");
			$var['table']=true;
			return $var;
		}
		
		/*if($del){
			$this->db->where_in("id",[$arrayct_a]);
			$this->db->delete($this->tbl);
			$var['table']=true;
			return $var;
		}*/
		
	}
	
	/*
	function update_Print()
	{
		$var=array();

		$idu=$this->session->userdata("id");
		$id=$this->input->post("id");
		
		
		if($id=='')
		{
			$var['gagal']=false;
			$var['info']="Not allowed, code or name already exists.";
			return $var;
		}
		
		$arrayct=explode(",",$id); //potong
		$a = "";
		foreach($arrayct as $i=>$arrayctlist):
			 $a .= ",'".$arrayctlist."'";
		endforeach;
		$arrayct_a = substr($a,1); //convert
		$jmlrowct=count($arrayct); //jumlah row
		$arrayct1=$arrayct[0]; //array awal
		for($x=0;$x<$jmlrowct;$x++){
			$getid=isset($arrayct[$x])?($arrayct[$x]):0;
			$utime=date("Y-m-d H:i:s"); 
			$uid=$idu;
			$maxDB=$this->db->query("SELECT CONCAT(MAX(count_print)+1) AS MAXC FROM data_member WHERE id='".$getid."'")->row();
			$max=isset($maxDB->MAXC)?($maxDB->MAXC):0;
			$this->db->set("_utime",$utime);
			$this->db->set("_uid",$uid);
			$this->db->set('count_print',$max);  
			$this->db->where("id",$getid);
			$this->db->update($this->tbl);
		}
			$var['table']=true;
			return $var;

	}*/
	

	
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
	 
	 



}

?>