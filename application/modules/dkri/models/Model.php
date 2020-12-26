<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends ci_Model
{
	var $tbl="data_kri";
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
		if($f1)
		{
            $this->db->where('level',$f1);
		}
		 $this->db->where("level","3"); 
		 if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"username"=>$searchkey,
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
		
		$email=$this->input->post("f[email]");
		$namadata=$this->input->post("f[namadata]");
		//$tanggal_lahir=$this->input->post("tanggal_lahir");
		//$tgl_lahir=$this->tanggal->eng_($tanggal_lahir,0);
		$username=$this->input->post("f[username]");
		$password=md5($this->input->post("password"));
		//cek dulu
		$this->db->where("username",$username);
		$this->db->where('email',$email);
		$cek=$this->db->get($this->tbl)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Tidak diizinkan, Username or email sudah ada.";
			return $var;
		}
		$this->db->where("namadata",$namadata);
		$cek2=$this->db->get($this->tbl)->num_rows();
		if($cek2)
		{
			$var['gagal']=false;
			$var['info']="Tidak diizinkan, Nama data sudah ada.";
			return $var;
		}
		$ctime=date("Y-m-d H:i:s"); 
		//$kode_sistem=$this->mdl->kode_sistem(); 
		//$this->db->set("tanggal_selesai",$tgl_selesai);

		$img=$this->m_reff->upload_file("profileimg","theme/images/user/","fileuser","JPG,JPEG,PNG","100000",null);
		if($img['validasi']==true){
			$this->db->set("profileimg",$img['name']);
		}
		$img2=$this->m_reff->upload_file("imgdata","theme/images/data/","filekri","JPG,JPEG,PNG","100000",null);
		if($img2['validasi']==true){
			$this->db->set("imgdata",$img2['name']);
		}
		$this->db->set("level","3");
		$this->db->set("password",$password);
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
		
		$email=$this->input->post("f[email]");
		$email_b=$this->input->post("email_b");
		$username=$this->input->post("f[username]");
		$username_b=$this->input->post("username_b");
		$profileimg_b=$this->input->post("profileimg_b");
		$password=$this->input->post("password");
		$passwordconvert=md5($password);
		//$tanggal_lahir=$this->input->post("tanggal_lahir");
		//$tgl_lahir=$this->tanggal->eng_($tanggal_lahir,0);
		//cek dulu
		$this->db->where("email!=",$email_b);
		$this->db->where('email',$email);
		$cek=$this->db->get($this->tbl)->num_rows();
		if($cek)
		{
			$var['gagal']=false;
			$var['info']="Tidak diizinkan, email sudah ada.";
			return $var;
		}

		$this->db->where("username!=",$username_b);
		$this->db->where('username',$username);
		$cek2=$this->db->get($this->tbl)->num_rows();
		if($cek2)
		{
			$var['gagal']=false;
			$var['info']="Tidak diizinkan, username sudah ada.";
			return $var;
		}
		
		$utime=date("Y-m-d H:i:s"); 
		$img=$this->m_reff->upload_file("profileimg","theme/images/user/","filekri","JPG,JPEG,PNG","10000",$profileimg_b);
		if($img['validasi']==true){
			$this->db->set("profileimg",$img['name']);
		}
		$this->db->set("level","3");
		$this->db->set("_utime",$utime);
		$this->db->set("_uid",$idu);
		$this->db->set($datainputan);  
		if($password!=''){$this->db->set("password",$passwordconvert);}
		$this->db->where("id_admin",$id);
		$this->db->update($this->tbl);
		$var['table']=true;
		return $var;
	}
	
	
	function delete_item()
	{
		$var=array();
	    $id=$this->input->post("id");
		$this->db->select("profileimg");
		$this->db->where("id_admin",$id);
		$del=$this->db->get($this->tbl)->row();
		$image=isset($del->profileimg)?($del->profileimg):'';
		$structure = './theme/images/user/'.$image.'';
		unlink($structure);
		if($del)
		{
			$this->db->where("id_admin",$id);
			$this->db->delete($this->tbl);
			$var['table']=true;
			return $var;
		}
	}
	function delete_sel()
	{
		
		$ct=$this->input->post('ct');
		$arrayct=explode(",",$ct); //potong
		$a = "";
		foreach($arrayct as $i=>$arrayctlist):
			 $a .= ",'".$arrayctlist."'";
		endforeach;
		$arrayct_a = substr($a,1); //convert
		
		$arrayct1=$arrayct[0]; //array awal
		$jmlrowct=count($arrayct); //jumlah row

		$this->db->where_in("id_admin",[$arrayct_a]);
		$del=$this->db->get($this->tbl)->result();
		foreach($del as $d){
			$image=isset($d->profileimg)?($d->profileimg):'';
			$structure = './theme/images/user/'.$image.'';
			unlink($structure);
			
		}
		$this->delsel($arrayct_a);
	}
	function delsel($arrayct_a){
		$var=array();
		$this->db->where_in("id_admin",[$arrayct_a]);
		$this->db->delete($this->tbl);
		$var['table']=true;
		return $var;
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
						 $npa=isset($sheet[1])?($sheet[1]):"";
    				     $namalengkap=isset($sheet[2])?($sheet[2]):"";
    				     $asalwilayah=isset($sheet[3])?($sheet[3]):"";
    				     $asalcabang=isset($sheet[4])?($sheet[4]):"";
						 $username=isset($sheet[5])?($sheet[5]):"";
						 $password=isset($sheet[6])?($sheet[6]):"";
						 
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

					if($npa)
					{	     
							//if($nis)
							//{
							//	 $kode_gardu=isset($sheet[$no++])?($sheet[$no]):"";
							//	 $kode_gardu=str_replace("`","",$kode_gardu);
							//	 $kode_gardu=str_replace("'","",$kode_gardu);
							//	 $kode_gardu=sprintf("%03s", $kode_gardu);
							/*
								$cek_nis=$this->db->get_where($this->tbl,array("nis"=>$nis))->num_rows();
								if($cek_nis){
										
										$dataray=array(
										"nis"=>$nis,
										"nama"=>$nama,
										"tempat_lahir"=>$tempat_lahir,
										"tanggal_lahir"=>$tgl_lahir,
										"kelas"=>$kd_kelas,
										"program_keahlian"=>$kd_program_keahlian,
										"kompetensi_keahlian"=>$kd_kompetensi_keahlian,
										"sekolah_asal"=>$sekolah_asal
										);
	
									$this->update_dataExcel($dataray);
									$edit++;
									//$this->qr($noida);
								}else{*/
									$dataray=array(
										"npa"=>$npa,
										"profilename"=>$namalengkap,
										"from_provincy"=>$asalwilayah,
										"from_branch"=>$asalcabang,
										"username"=>$username,
										"password"=>md5($password),
										"level"=>"3",
										"_cid"=>$this->m_reff->idu(),
										"_ctime"=>date("Y-m-d H:i:s")
										);
										//if($nis){
									$this->insert_dataExcel($dataray);
									$insert++;
									//$this->qr($noida);
										//}
								//}
							//}
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
		$this->db->where("npa",$dataray['npa']);
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