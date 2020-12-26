<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends ci_Model
{
	var $tbl="data_konis";
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
		 /*if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"namadata"=>$searchkey
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}*/
		$this->db->order_by("id","asc"); 
		$query=$this->db->from($this->tbl);
		return $query;
	
	}	
	public function count_data()
	{		
		$this->_get_datatables();
		return $this->db->get()->num_rows();
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
	

}

?>