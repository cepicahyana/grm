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
		$this->db->order_by("id","DESC"); 
		$this->db->group_by("tanggal"); 
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
	function cekKonis($jml,$min){
		 if($jml>$min){
			 return "Siap";
		 }	return "Tidak siap";
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
				$nilai=""; $data=array();
				foreach ($sheets as $sheet) {
				
				if ($i > 1) 
				{
    				     $peralatan	=	isset($sheet[1])?($sheet[1]):"";
    				     $nilai		=	isset($sheet[2])?($sheet[2]):"";
						 $nilai		=	str_replace("%","",$nilai);
						 $ket		=	isset($sheet[3])?($sheet[3]):"";
						 
						 
						 $data[]=array(
							 "peralatan"	=>	$peralatan,
							 "nilai"		=>	$nilai, 
							 "ket"			=>	$ket
						 );	
						$nilai+=$nilai;
									$insert++;
									  
					 } //end if
					 $i++;
				} //end foreach

				if(isset($data)){
 

				$t_nilai=($nilai/$insert);
				if($t_nilai>80){
					$kondisi="Siap";
				}else//if($t_nilai>60){
					{
					$kondisi="Tidak siap";
				}
				 
					$ray=array(
						"tgl"=>date('Y-m-d H:i:s'),
						"data"=>$data
					);

					$data	= json_encode($ray);
					$dataray=array(
						"id_kri"=>$this->mdl->idu(),
						"tanggal"=>date('Y-m-d H:i:s'),
						"data"=>$data,
						"kondisi"=>$kondisi,
						"jml_peralatan"=>$insert,
						"t_nilai"=>$t_nilai,
						"_cid"=>$this->m_reff->idu(),
						"_ctime"=>date("Y-m-d H:i:s")
						);
					 
					$this->db->insert("data_konis",$dataray);
				}
 
				$i++;
             
		}else{
			 $var["file"]=false;
			 $var["type_file"]="xlsx";
		}
		//$var["import_data"]=true;
		$var["data_insert"]=$insert;
	 
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
	function idu(){
		return $this->session->userdata("id");
	}
	function getLastKonis(){
		$this->db->order_by("_ctime","desc");
		$this->db->where("id_kri",$this->idu());
		$this->db->limit(1);
		return $this->db->get("data_konis")->row();
	}
	function getKonisFile(){ 
		$this->db->order_by("_ctime","desc");
		$this->db->where("id_kri",$this->idu());
		$this->db->limit(1);
		$data=$this->db->get("data_konis")->row();
		   
        $objPHPExcel = new PHPExcel();
 
        $style = array(
            
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '6CCECB')
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
        );
		
		  
        		
			    $objPHPExcel->getActiveSheet(0)->setCellValue('A1',"NO");
			    $objPHPExcel->getActiveSheet(0)->setCellValue('B1',"PERALATAN");
			    $objPHPExcel->getActiveSheet(0)->setCellValue('C1',"NILAI (%)"); 
			    $objPHPExcel->getActiveSheet(0)->setCellValue('D1',"KETERANGAN");
			   
			 
			    $objPHPExcel->getActiveSheet(0)->getColumnDimension("A")->setAutoSize(true);
			    $objPHPExcel->getActiveSheet(0)->getColumnDimension("B")->setAutoSize(true);
			    $objPHPExcel->getActiveSheet(0)->getColumnDimension("C")->setAutoSize(true);
			    $objPHPExcel->getActiveSheet(0)->getColumnDimension("D")->setAutoSize(true);
			    
 
				$objPHPExcel->getActiveSheet(0)->getStyle("A1:D1")->applyFromArray($style);
		$dataray=	isset($data->data)?($data->data):"";
		$data	=	json_decode($dataray,TRUE);
		$data	=	isset($data["data"])?($data["data"]):"";
		 
		if($data){
	  
				$no=1;   $start=2;$r=0;
				foreach($data as $key=>$val)
				{ 
					 
					$objPHPExcel->getActiveSheet(0)->setCellValue("A".$start, $no++);
					$objPHPExcel->getActiveSheet(0)->setCellValue("B".$start, $val['peralatan']);
					$objPHPExcel->getActiveSheet(0)->setCellValue("C".$start, $val['nilai']);
					$objPHPExcel->getActiveSheet(0)->setCellValue("D".$start, $val['ket']);
				 
					$start++;
				 	$r++;
				}
			 

		}
		$nama_file="Data_konis";  
        $objPHPExcel->getActiveSheet(0)->setTitle($nama_file);
		
						
//<!-------------------------------------------------------------------------------  --->		
		//$nama_file=$this->m_reff->goField("data_acara","perihal","where kode='".$kode_acara."' ");
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$nama_file.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}

}

?>