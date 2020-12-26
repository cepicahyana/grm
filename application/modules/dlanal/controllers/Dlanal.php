<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dlanal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("super","admin"));
		$this->load->model("model","mdl");		
		date_default_timezone_set('Asia/Jakarta');
	}
	 
	function _template($data)
	{
		$this->load->view('temp_back/main',$data);	
	}
	 
	public function index()
	{	
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo $this->load->view("index");
		}else{
			$data['konten']="index";
			$this->_template($data);
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
			$namadata=isset($dataDB->namadata)?($dataDB->namadata):'';
			$imgdata=isset($dataDB->imgdata)?($dataDB->imgdata):'';
			$descdata=isset($dataDB->descdata)?($dataDB->descdata):'';
			$lat=isset($dataDB->lat)?($dataDB->lat):'';
			$lng=isset($dataDB->lng)?($dataDB->lng):'';
			
			/*$tgl_lahir=isset($dataDB->tanggal_lahir)?($dataDB->tanggal_lahir):'';
			if($tgl_lahir!=''){$tanggal_lahir=$this->tanggal->ind($tgl_lahir,0);}else{$tanggal_lahir="";}*/
			/*$kelasDB=$this->db->where("kode",$kd_kelas);
			$kelasDB=$this->db->get("tm_kelas")->row();
			$kelas=isset($kelasDB->kelas)?($kelasDB->kelas):'';*/
			
			if($imgdata!=''){
				$img_1=''.base_url().'theme/images/data/'.$imgdata.'';
			}else{
				$img_1=''.base_url().'theme/images/no-image.png';
			}
			
			
			$tombol='
					<button type="button" onclick="edit(`'.$id.'`)" class="btn bg-info btn-sm">EDIT</button>
					<button type="button" onclick="del(`'.$id.'`,`'.$namadata.'`)" class="btn bg-danger btn-sm">DELETE</button>
			';
			$row = array();
			$row[] = "";
			$row[] = $id;	
			$row[] = "<span class='size' >".$no++."</span>";	
			$row[] = "<span class='size' ><a href='javascript:priview(".$id.")'>".$namadata."</a></span>";
			$row[] = "<span class='size' >".$descdata."</span>";
			$row[] = "<span class='size' >Lat : ".$lat." <br> Long : ".$lng."</span>";
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
		
		$this->db->where("level","3");
		//$this->db->order_by("id_admin","asc"); 
		$data["data"]=$this->db->get("data_member")->result();
		$this->load->view("downloadXL",$data);
	    return true;
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
