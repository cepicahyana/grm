<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Apengumuman extends CI_Controller {

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
			$ajax=$this->input->get_post("ajax");
			if($ajax=="yes")
			{
				echo $this->load->view("pengumuman");
			}else{
				$data['konten']="pengumuman";
				$this->_template($data);
			}
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
			$judul=isset($dataDB->judul)?($dataDB->judul):'';
			$sts=isset($dataDB->sts)?($dataDB->sts):'';
			$isi=isset($dataDB->isi)?($dataDB->isi):'';
			$viewer=isset($dataDB->viewer)?($dataDB->viewer):'0';

			$arraysatu=explode(",",$viewer); //potong
			$d = "";
			foreach($arraysatu as $i=>$array_satu):
				$d .= ",'".$array_satu."'";
			endforeach;
			$arraysatu_d = substr($d,1); //convert
			
			$arraysatu1=$arraysatu[0]; //array awal
			if($viewer>0){
				$jmlrow=count($arraysatu); //jumlah row	
				$jmlrowsatu=$jmlrow-1;
			}else{
				$jmlrowsatu='0'; //jumlah row	
			}
			
			/*if($tanggal!=''){$tanggal_=$this->tanggal->ind($tanggal,0);}else{$tanggal_="";}
			if($waktu!=''){
				$cwkt=explode(':',$waktu);
				$cwkt1=$cwkt[0];	
				$cwkt2=$cwkt[1];
				$wkt=''.$cwkt1.':'.$cwkt2.'';
			}else{
				$wkt='';
			}
			/*$kelasDB=$this->db->where("kode",$kd_kelas);
			$kelasDB=$this->db->get("tm_kelas")->row();
			$kelas=isset($kelasDB->kelas)?($kelasDB->kelas):'';
			if($imgdata!=''){
				$img_1=''.base_url().'theme/images/data/'.$imgdata.'';
			}else{
				$img_1=''.base_url().'theme/images/no-image.png';
			}*/
			
			
			$tombol='
					<button type="button" onclick="edit(`'.$id.'`)" class="btn bg-info btn-sm">EDIT</button>
					<button type="button" onclick="del(`'.$id.'`,`'.$judul.'`)" class="btn bg-danger btn-sm">DELETE</button>
			';
			$row = array();
			$row[] = "";
			$row[] = $id;	
			$row[] = "<span class='size' >".$no++."</span>";	
			$row[] = "<span class='size' ><a href='#' onclick='priview(".$id.")'>".$judul."</a></span>";
			$row[] = "<span class='size' >".$sts."</span>";
			$row[] = "<span class='size' ><a href='#' onclick='viewer(".$id.")'>Viewer (".$jmlrowsatu.")</a></span>";
			$row[] = $tombol ;
			 
			  
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
	function viewer_data()
	{
		$data["data"]=$this->mdl->edit_data();
		echo $this->load->view("formViewer",$data);
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

	/*--------------------------member------------------------*/
	function data_tables_pengumuman()
	{
		$list = $this->mdl->get_data_pengumuman();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {

			$id=isset($dataDB->id)?($dataDB->id):'';
			$judul=isset($dataDB->judul)?($dataDB->judul):'';
			$sts=isset($dataDB->sts)?($dataDB->sts):'';
			$isi=isset($dataDB->isi)?($dataDB->isi):'';
			$viewer=isset($dataDB->viewer)?($dataDB->viewer):'0';
			$idsession=$this->session->userdata('id');

			$arraysatu=explode(",",$viewer); //potong
			$d = "";
			foreach($arraysatu as $i=>$array_satu):
				$d .= ",'".$array_satu."'";
			endforeach;
			$arraysatu_d = substr($d,1); //convert
			
			$arraysatu1=$arraysatu[0]; //array awal
			if($viewer>0){
				$jmlrow=count($arraysatu); //jumlah row	
				$jmlrowsatu=$jmlrow-1;
			}else{
				$jmlrowsatu='0'; //jumlah row	
			}
			$colRow='read';
			if (strpos($viewer, $idsession.",") !== false) {
				$colRow='read';
			}else{
				$colRow='no';
			}
			
			//$tombol='
					//<button type="button" onclick="edit(`'.$id.'`)" class="btn bg-info btn-sm">EDIT</button>
					//<button type="button" onclick="del(`'.$id.'`,`'.$judul.'`)" class="btn bg-danger btn-sm">DELETE</button>
			//';
			$row = array();
			$row[] = $colRow;
			$row[] = "<span class='size' >".$no++."</span>";	
			$row[] = "<span class='size' ><a href='#' onclick='detail(".$id.")'>".$judul."</a></span>";
			$row[] = "<span class='size text-muted' ><i>".$colRow."</i></span>";
			//$row[] = $tombol ;
 
			//add html for action
			$data[] = $row;
			}
			
		//$csrf_name = $this->security->get_csrf_token_name();
		//$csrf_hash = $this->security->get_csrf_hash(); 
		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $c=$this->mdl->count_data_pengumuman(),
		"recordsFiltered" =>$c,
		"data" => $data,
		);
		//output to json format
		//$output[$csrf_name] = $csrf_hash;
		echo json_encode($output);
	}
	function view_pengumuman()
	{
		$this->mdl->update_viewer();
		$data["data"]=$this->mdl->edit_data();
		echo $this->load->view("view_pengumuman",$data);
	}
/*	
	function priview_PDF()
	{

		ob_start();
		$id=$this->input->get("id");
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
		$this->db->where("id",$getid);
		$data["data"]=$this->db->get("data_sertifikat")->row();
		$isi=$this->load->view("priview_sertifikat",$data);
		}
		//   return true;
		$isi = ob_get_clean();
	 	require_once('static/html2pdf/html2pdf.class.php');
	 	try{
	 	  $html2pdf = new HTML2PDF('L','A4', 'en', true, '', array(0,0, 0, 0));
		  $html2pdf->AddFont('monotypecorsiva', 'bold', 'monotypecorsiva.php');
		  //$html2pdf->AddFont('robotomedium', 'normal', 'robotomedium.php');
		  $html2pdf->setDefaultFont('times');
	 	  $html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
	 	  $html2pdf->Output('view.pdf','FI');
	 	}
	 	catch(HTML2PDF_exception $e){
			echo $e;
    	}
		
		/*
		$this->load->library('Pdf');
		$id=$this->input->get('id');
		$this->db->where("id",$id);
		$data["data"]=$this->db->get("data_sertifikat")->row();
		$isi=$this->load->view("priview_sertifikat",$data,true);
		
		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('My Title');
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('TCPDF Example 002');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(0);
		$pdf->SetTopMargin(0);
		$pdf->setFooterMargin(0);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetDisplayMode('real', 'default');
		$pdf->SetCellPadding(0);
		
		$pdf->AddPage('L', 'A4');
		// -- set new background ---
		// get the current page break margin
		$bMargin = $pdf->getBreakMargin(0,0,0,0);
		// get current auto-page-break mode
		$auto_page_break = $pdf->getAutoPageBreak();
		// disable auto-page-break
		$pdf->SetAutoPageBreak(true, 0);
		// set bacground image
		$img_file = base_url().'theme/images/sertifikat/sertifikat.jpg';
		$pdf->Image($img_file, 0, 0, 420, 297, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$pdf->setPageMark();

		$pdf->WriteHTMLCell(0, 0,'','', $isi, 0, 1, 0, true, '', true);
		$pdf->Output('My-File-Name.pdf', 'I');
		

	}
*/	
	
	
	/*function get_kk()
	{
		$val=$this->input->post("id");
		$db=$this->db->where("kd_pk","".$val."");
		$db=$this->db->order_by("kode","asc");
		$db=$this->db->get("tm_kompetensi_keahlian")->result();
		$list="<option value=''>=== Choose === </option>";
		foreach($db as $val){
			$list.="<option value='".$val->kode."'>".$val->kompetensi_keahlian."</option>";
		}
		echo $list;
	}*/


	
}
