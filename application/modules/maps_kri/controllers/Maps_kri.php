<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps_kri extends MX_Controller 
{
	public function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("kri"));
		$this->load->model("model","mdl");
		date_default_timezone_set('Asia/Jakarta');
	}
	 
	function _template($data)
	{
		$this->load->view('temp_maps_kri/main',$data);	
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

	function get_fm(){
		$fm=$this->input->post('fm');
		$list ='';
		if($fm=='fm'){//akun kri
			$list = $this->mdl->get_fm();
		}
		if($fm==1){//kri
			$list = $this->mdl->get_fm1();
		}
		if($fm==2){//lantamal
			$list = $this->mdl->get_fm2();
		}
		if($fm==3){//lanal
			$list = $this->mdl->get_fm3();
		}
		if($fm==4){//brigif
			$list = $this->mdl->get_fm4();
		}
		if($fm==5){//posal
			$list = $this->mdl->get_fm5();
		}
		if($fm==6){//satrad
			$list = $this->mdl->get_fm6();
		}

		
		
		foreach ($list as $dataDB) {
			$id=isset($dataDB->id)?($dataDB->id):'';
			$namadata=isset($dataDB->namadata)?($dataDB->namadata):'';
			$descdata=isset($dataDB->descdata)?($dataDB->descdata):'';
			$level=isset($dataDB->level)?($dataDB->level):'';
			$lat=isset($dataDB->lat)?($dataDB->lat):'';
			$lng=isset($dataDB->lng)?($dataDB->lng):'';
			$imgdata=isset($dataDB->imgdata)?($dataDB->imgdata):'';

			$dbicon=$this->db->get_where('tm_iconmarker',array('level'=>$level))->row();
			$icon=isset($dbicon->icon)?($dbicon->icon):'';

			if($icon!=''){
				$icon_1=''.base_url().'theme/images/marker/'.$icon.'';
			}else{
				$icon_1=''.base_url().'theme/images/marker/default.png';
			}

			if($imgdata!=''){
				$img_1=''.base_url().'theme/images/data/'.$imgdata.'';
			}else{
				$img_1=''.base_url().'theme/images/no-image.png';
			} 
			$infomarker='';
			if($dbicon->nama=='kri'){
				$infomarker.="<div style='min-height:70px;'><h3>".strval($namadata)."</h3>
				<table style='width:100%;'>
				<tr>
					<td colspan='2' class='text-left'>
						<p style='font-size:12px'>Latlong ".$lat.", ".$lng."</p>
					</td>
				</tr>
				</table>
				</div>";
			}else{
				$infomarker.="<div style='min-height:240px;'><h3>".strval($namadata)."</h3>
				<table style='width:100%;'>
				<tr>
					<td colspan='2' class='text-left'>
						<p style='font-size:12px'>Latlong ".$lat.", ".$lng."</p>
					</td>
				</tr>
				<tr valign='top'>
					<td style='width:45%'><img style='width:95%;margin:0 auto;' class='card-img-top rounded' src='".$img_1."'></td>
					<td style='width:55%'><button class='btn btn-primary btn-block btn-sm'>DETAIL</button>
						<button class='btn btn-primary btn-block btn-sm'>WILAYAH KERJA</button>
						<button class='btn btn-primary btn-block btn-sm'>KONLOG</button></td>
				</tr>
				</table>

				<table style='width:100%;margin-top:5px;'>
				<tr valign='top'>
					<td><button class='btn btn-success btn-block btn-sm'>VOIP</button>
						<button class='btn btn-success btn-block btn-sm'>ROIP</button></td>
					<td style='padding-left:6px;padding-right:6px;'><button class='btn btn-success btn-block btn-sm'>VICALL</button></td>
					<td>
						<button class='btn btn-success btn-block btn-sm'>CHAT</button>
					</td>
				</tr>
				</table>

				</div>";
			}

			$row[] = array(
				"placeName" => strval($namadata),
				"descCription" => strval($descdata),
				"infoMarker" => $infomarker,
				"level" => $level,
				"icons" => $icon_1,
				"LatLng" => array(
					"lat" => $lat,
					"lng" => $lng
				),
			);	 
		}
		echo json_encode($row);
	}

	public function update_tracking_kri(){
		
		$data=$this->mdl->update_tracking_kri();
		echo json_encode($data);

	}

	public function history_track_kri(){
		
		$list=$this->mdl->history_track_kri();
		$length=$list->num_rows();
		if($length>=1){
		foreach ($list->result() as $dataDB) {
			$id=isset($dataDB->id)?($dataDB->id):'';
			$idkri=isset($dataDB->idkri)?($dataDB->idkri):'';
			$tanggal=isset($dataDB->tanggal)?($dataDB->tanggal):'';
			$latlng=isset($dataDB->latlng)?($dataDB->latlng):'';
			$arr = json_decode($latlng, true);

			$DBkri=$this->db->get_where('data_kri',array('id'=>$idkri))->row();
				$namadata=isset($DBkri->namadata)?($DBkri->namadata):'';
				$descdata=isset($DBkri->descdata)?($DBkri->descdata):'';
				$level=isset($DBkri->level)?($DBkri->level):'';
				$imgdata=isset($DBkri->imgdata)?($DBkri->imgdata):'';

				$dbicon=$this->db->get_where('tm_iconmarker',array('level'=>$level))->row();
				$icon=isset($dbicon->icon)?($dbicon->icon):'';
					if($icon!=''){
						$icon_1=''.base_url().'theme/images/marker/'.$icon.'';
					}else{
						$icon_1=''.base_url().'theme/images/marker/default.png';
					}

					if($imgdata!=''){
						$img_1=''.base_url().'theme/images/data/'.$imgdata.'';
					}else{
						$img_1=''.base_url().'theme/images/no-image.png';
					} 


			if($arr==true){
				//$n=1; $countarr=count($arr); $countlist=$countarr-1;
				foreach ($arr as $k=>$v){
					$key=$k;
					$lat=$v['lat'];
					$lng=$v['lng'];
					$row_b[$key] = array(
						"lat" => $lat,
						"lng" => $lng
					);	
				}
			}
			$row[] = array(
				"idkri" => $idkri,
				"tanggal" => $tanggal,

				"placeName" => strval($namadata),
				"level" => $level,
				"icons" => $icon_1,

				"LatLng" => $row_b,
			);	 
		}
		echo json_encode($row);
		}else{
			$row='';
			echo json_encode($row);
		}

	}

}
