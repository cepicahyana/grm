<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps_grims extends MX_Controller 
{
	public function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("super","admin"));
		$this->load->model("model","mdl");
		date_default_timezone_set('Asia/Jakarta');
	}
	 
	function _template($data)
	{
		$this->load->view('temp_maps/main',$data);	
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
				$infomarker.="<div style='min-height:320px;padding:18px;'><h3 class='text-white'>".strval($namadata)."</h3>
				<table style='width:100%;'>
				<tr>
					<td colspan='2' class='text-left text-white'>
						<p style='font-size:11px;font-weight:bold'>Latlong ".$lat.", ".$lng."</p>
					</td>
				</tr>
				<tr valign='top'>
					<td style='width:45%'><img style='width:95%;margin:0 auto;' class='card-img-top rounded' src='".$img_1."'></td>
					<td style='width:55%'>
						<button class='btn btn-primary btn-block btn-sm' onclick='konis()'>KONIS</button>
						<button class='btn btn-primary btn-block btn-sm' onclick='konlog()'>KONLOG</button>
						<button class='btn btn-primary btn-block btn-sm'>KONPERS</button></td>
				</tr>
				</table>

				<table style='width:100%;margin-top:5px;'>
				<tr valign='top'>
					<td><button class='btn btn-black btn-block btn-sm'>RADAR</button>
						<button class='btn btn-black btn-block btn-sm'>AIS</button>
						<button class='btn btn-black btn-block btn-sm'>CAMERA</button></td>
					<td style='padding-left:6px;padding-right:6px;'>
						<button class='btn btn-secondary btn-block btn-sm' onclick='history_track_kri(".$id.")'>HISTORY</button>
						<button class='btn btn-secondary btn-block btn-sm'>COVERAGE</button></td>
					<td><button class='btn btn-success btn-block btn-sm' onclick='chat(`".$id."`,`".$id."`,`".$namadata."`)'>CHAT</button>
						<button class='btn btn-success btn-block btn-sm' onclick='vicall(`".$id."`,`".$namadata."`)'>VICALL</button>
						<button class='btn btn-success btn-block btn-sm'>VOIP</button>
						<button class='btn btn-success btn-block btn-sm'>ROIP</button></td>
				</tr>
				</table>
					
				</div>";
			}else if($dbicon->nama=='lantamal'){
				$wilayah_kerja=isset($dataDB->wilayah_kerja)?($dataDB->wilayah_kerja):'';
				$luas_wilayah=isset($dataDB->luas_wilayah)?($dataDB->luas_wilayah):'';
				$batas_wilayah=isset($dataDB->batas_wilayah)?($dataDB->batas_wilayah):'';
				$LLpolygon=json_encode($wilayah_kerja);
				$dgon_nd=json_encode($namadata);
				$dgon_lw=json_encode($luas_wilayah);
				$dgon_bw=json_encode($batas_wilayah);
				$infomarker.="<div style='min-height:260px;padding:18px;'><h3 class='text-white'>".strval($namadata)."</h3>
				<table style='width:100%;'>
				<tr>
					<td colspan='2' class='text-left text-white'>
						<p style='font-size:11px;font-weight:bold'>Latlong ".$lat.", ".$lng."</p>
					</td>
				</tr>
				<tr valign='top'>
					<td style='width:45%'><img style='width:95%;margin:0 auto;' class='card-img-top rounded' src='".$img_1."'></td>
					<td style='width:55%'><button class='btn btn-primary btn-block btn-sm'>DETAIL</button>
						<button class='btn btn-primary btn-block btn-sm' onclick='showPgon(".$LLpolygon.",".$dgon_nd.",".$dgon_lw.",".$dgon_bw.")'>WILAYAH KERJA</button>
						<button class='btn btn-primary btn-block btn-sm' >KONLOG</button></td>
				</tr>
				</table>

				<!--table style='width:100%;margin-top:5px;'>
				<tr valign='top'>
					<td><button class='btn btn-success btn-block btn-sm'>VOIP</button>
						<button class='btn btn-success btn-block btn-sm'>ROIP</button></td>
					<td style='padding-left:6px;padding-right:6px;'><button class='btn btn-success btn-block btn-sm'>VICALL</button></td>
					<td>
						<button class='btn btn-success btn-block btn-sm'>CHAT</button>
					</td>
				</tr>
				</table-->

				</div>";
			}else{
				$infomarker.="<div style='min-height:260px;padding:18px;'><h3 class='text-white'>".strval($namadata)."</h3>
				<table style='width:100%;'>
				<tr>
					<td colspan='2' class='text-left text-white'>
						<p style='font-size:11px;font-weight:bold'>Latlong ".$lat.", ".$lng."</p>
					</td>
				</tr>
				<tr valign='top'>
					<td style='width:45%'><img style='width:95%;margin:0 auto;' class='card-img-top rounded' src='".$img_1."'></td>
					<td style='width:55%'><button class='btn btn-primary btn-block btn-sm'>DETAIL</button>
						<button class='btn btn-primary btn-block btn-sm' onclick='showPgon()'>WILAYAH KERJA</button>
						<button class='btn btn-primary btn-block btn-sm'>KONLOG</button></td>
				</tr>
				</table>

				<!--table style='width:100%;margin-top:5px;'>
				<tr valign='top'>
					<td><button class='btn btn-success btn-block btn-sm'>VOIP</button>
						<button class='btn btn-success btn-block btn-sm'>ROIP</button></td>
					<td style='padding-left:6px;padding-right:6px;'><button class='btn btn-success btn-block btn-sm'>VICALL</button></td>
					<td>
						<button class='btn btn-success btn-block btn-sm'>CHAT</button>
					</td>
				</tr>
				</table-->

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

	function get_object(){
		$fm=$this->input->post('fm');
		$list ='';

		if($fm==9){//object
			$list = $this->mdl->get_fm9();
		}
		
		foreach ($list as $dataDB) {
			$id=isset($dataDB->id)?($dataDB->id):'';
			$code_object=isset($dataDB->code_object)?($dataDB->code_object):'';
			$name_object=isset($dataDB->name_object)?($dataDB->name_object):'';
			$no_object=isset($dataDB->no_object)?($dataDB->no_object):'';
			$date_detected=isset($dataDB->date_detected)?($dataDB->date_detected):'';
			$imgobject=isset($dataDB->imgobject)?($dataDB->imgobject):'';
			$sts_object=isset($dataDB->sts_object)?($dataDB->sts_object):'';
			$type_object=isset($dataDB->type_object)?($dataDB->type_object):'';
			$nasionality=isset($dataDB->nasionality)?($dataDB->nasionality):'';
			$_cid=isset($dataDB->_cid)?($dataDB->_cid):'';
			$_ctime=isset($dataDB->_ctime)?($dataDB->_ctime):'';
			$kategori=isset($dataDB->kategori)?($dataDB->kategori):'';
			$lat=isset($dataDB->lat)?($dataDB->lat):'';
			$lng=isset($dataDB->lng)?($dataDB->lng):'';

			$user_detected=$this->m_konfig->goField('data_kri','profilename','id='.$_cid.'');
			$taggal_deteksi=$this->tanggal->inddatetime($date_detected,' ');
			$taggal_input=$this->tanggal->inddatetime($_ctime,' ');

			$dbicon=$this->db->get_where('tm_kategoriobject',array('kode'=>$kategori))->row();
			$icon=isset($dbicon->icon)?($dbicon->icon):'';
			$kategoriobject=isset($dbicon->kategori)?($dbicon->kategori):'';

			if($icon!=''){
				$icon_1=''.base_url().'theme/images/marker_object/'.$icon.'';
			}else{
				$icon_1='';
			}

			if($imgobject!=''){
				$img_1=''.base_url().'theme/images/object/'.$imgobject.'';
			}else{
				$img_1=''.base_url().'theme/images/no-image.png';
			} 
			$infomarker='';

			if($dbicon->kode!='3'){
				$infomarker.="<div style='min-height:230px;padding:18px;'>
				<h3 class='text-white'>".strval($kategoriobject)."</h3>
				<div class='tborder_2'>
				<table style='width:100%;color:#fff;'>
				<tr valign='top'>
					<td style='width:30%'>OBJECT</td>
					<td style='width:5%'>:</td>
					<td style='width:65%'>".$kategoriobject."</td>
				</tr>
				<tr valign='top'>
					<td>NO OBJECT</td>
					<td>:</td>
					<td>".$no_object."</td>
				</tr>
				<tr valign='top'>
					<td>NAME</td>
					<td>:</td>
					<td>".$name_object."</td>
				</tr>
				<tr valign='top'>
					<td>DETECTED</td>
					<td>:</td>
					<td>BY ".$user_detected." ".$taggal_deteksi."</td>
				</tr>
				<tr valign='top'>
					<td>INPUTED</td>
					<td>:</td>
					<td>BY ".$user_detected." ".$taggal_input."</td>
				</tr>
				<tr valign='top'>
					<td>STATUS</td>
					<td>:</td>
					<td>".$sts_object."</td>
				</tr>
				<tr valign='top'>
					<td>LATLONG</td>
					<td>:</td>
					<td>".$lat.", ".$lng."</td>
				</tr>
				</table>
				</div>
				<table style='width:100%' class='mt-2'>
				<tr valign='top'>
					<td style='width:45%'><img style='max-height:120px;width:95%;margin:0 auto;' class='card-img-top rounded' src='".$img_1."'></td>
					<td style='width:25%;padding-right:6px;'>
						<button class='btn btn-warning btn-block btn-sm' onclick='history_object(`".$code_object."`,`".$name_object."`)'>HISTORY</button>
					</td>
					<td style='width:25%'>&nbsp;</td>
				</tr>
				</table>
				</div>";
			}else{
				$infomarker.="<div style='min-height:230px;padding:18px;'>
				<h3 class='text-white'>".strval($kategoriobject)."</h3>
				<div class='tborder_2'>
				<table style='width:100%;color:#fff;'>
				<tr valign='top'>
					<td style='width:30%'>OBJECT</td>
					<td style='width:5%'>:</td>
					<td style='width:65%'>".$kategoriobject."</td>
				</tr>
				<tr valign='top'>
					<td>NO OBJECT</td>
					<td>:</td>
					<td>".$no_object."</td>
				</tr>
				<tr valign='top'>
					<td>DETECTED</td>
					<td>:</td>
					<td>BY ".$user_detected." ".$taggal_deteksi."</td>
				</tr>
				<tr valign='top'>
					<td>INPUTED</td>
					<td>:</td>
					<td>BY ".$user_detected." ".$taggal_input."</td>
				</tr>
				<tr valign='top'>
					<td colspan='3'>BY RADAR & VISUAL or FLIR/LONG RANGE/ AI CAMERA :</td>
				</tr>
				<tr valign='top'>
					<td>NAME</td>
					<td>:</td>
					<td>".$name_object."</td>
				</tr>
				<tr valign='top'>
					<td>TYPE</td>
					<td>:</td>
					<td>".$type_object."</td>
				</tr>
				<tr valign='top'>
					<td>NASIONALITY</td>
					<td>:</td>
					<td>".$nasionality."</td>
				</tr>
				<tr valign='top'>
					<td>LATLONG</td>
					<td>:</td>
					<td>".$lat.", ".$lng."</td>
				</tr>
				</table>
				</div>
				<table style='width:100%' class='mt-2'>
				<tr valign='top'>
					<td style='width:45%'><img style='max-height:120px;width:95%;margin:0 auto;' class='card-img-top rounded' src='".$img_1."'></td>
					<td style='width:25%;padding-right:6px;'>
						<button class='btn btn-info btn-block btn-sm'>DETAILS</button>
						<button class='btn btn-warning btn-block btn-sm' onclick='history_object(`".$code_object."`,`".$name_object."`)'>HISTORY</button>
					</td>
					<td style='width:25%'>
						&nbsp;
					</td>
				</tr>
				</table>
				</div>";
			}

			$row[] = array(
				"placeName" => strval($name_object),
				"infoMarker" => $infomarker,
				"level" => "object",
				"icons" => $icon_1,
				"LatLng" => array(
					"lat" => $lat,
					"lng" => $lng
				),
			);	 
		}
		echo json_encode($row);
	}

	/*public function update_tracking_kri(){
		
		$data=$this->mdl->update_tracking_kri();
		echo json_encode($data);

	}*/

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


	public function history_range_kri(){
		$list=$this->mdl->history_range_kri();
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



	function page_konlog()
	{
		echo $this->load->view("page_konlog");
	}
	function history_konlog()
	{
		echo $this->load->view("history_konlog");
	}
	function data_tables_konlog()
	{
		$list = $this->mdl->get_data_konlog();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {

			$id=isset($dataDB->id)?($dataDB->id):'';
			$tanggal=isset($dataDB->tanggal)?($dataDB->tanggal):'';
			//$namadata=isset($dataDB->namadata)?($dataDB->namadata):'';
			
			/*$tgl_lahir=isset($dataDB->tanggal_lahir)?($dataDB->tanggal_lahir):'';
			if($tgl_lahir!=''){$tanggal_lahir=$this->tanggal->ind($tgl_lahir,0);}else{$tanggal_lahir="";}*/
			/*$kelasDB=$this->db->where("kode",$kd_kelas);
			$kelasDB=$this->db->get("tm_kelas")->row();
			$kelas=isset($kelasDB->kelas)?($kelasDB->kelas):'';*/

			$tombol='
					<button type="button" onclick="edit(`'.$id.'`)" class="btn bg-info btn-sm">EDIT</button>
					<button type="button" onclick="del(`'.$id.'`)" class="btn bg-danger btn-sm">DELETE</button>
			';
			$row = array();
			$row[] = "<span class='size' >".$no++."</span>";	
			$row[] = "<span class='size' ></span>";
			$row[] = "<span class='size' ></span>";
			$row[] = "<span class='size' ></span>";
			//$row[] = $tombol ;
			 
			  
			//add html for action
			$data[] = $row;
			}
			
		//$csrf_name = $this->security->get_csrf_token_name();
		//$csrf_hash = $this->security->get_csrf_hash(); 
		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $c=$this->mdl->count_data_konlog(),
		"recordsFiltered" =>$c,
		"data" => $data,
		);
		//output to json format
		//$output[$csrf_name] = $csrf_hash;
		echo json_encode($output);
	}



	function page_konis()
	{
		echo $this->load->view("page_konis");
	}
	function history_konis()
	{
		echo $this->load->view("history_konis");
	}
	function data_tables_konis()
	{
		$list = $this->mdl->get_data_konis();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {

			$id=isset($dataDB->id)?($dataDB->id):'';
			$tanggal=isset($dataDB->tanggal)?($dataDB->tanggal):'';
			//$namadata=isset($dataDB->namadata)?($dataDB->namadata):'';
			
			/*$tgl_lahir=isset($dataDB->tanggal_lahir)?($dataDB->tanggal_lahir):'';
			if($tgl_lahir!=''){$tanggal_lahir=$this->tanggal->ind($tgl_lahir,0);}else{$tanggal_lahir="";}*/
			/*$kelasDB=$this->db->where("kode",$kd_kelas);
			$kelasDB=$this->db->get("tm_kelas")->row();
			$kelas=isset($kelasDB->kelas)?($kelasDB->kelas):'';*/

			$tombol='
					<button type="button" onclick="edit(`'.$id.'`)" class="btn bg-info btn-sm">EDIT</button>
					<button type="button" onclick="del(`'.$id.'`)" class="btn bg-danger btn-sm">DELETE</button>
			';
			$row = array();
			$row[] = "<span class='size' >".$no++."</span>";	
			$row[] = "<span class='size' ></span>";
			$row[] = "<span class='size' ></span>";
			$row[] = "<span class='size' ></span>";
			//$row[] = $tombol ;
			 
			  
			//add html for action
			$data[] = $row;
			}
			
		//$csrf_name = $this->security->get_csrf_token_name();
		//$csrf_hash = $this->security->get_csrf_hash(); 
		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $c=$this->mdl->count_data_konis(),
		"recordsFiltered" =>$c,
		"data" => $data,
		);
		//output to json format
		//$output[$csrf_name] = $csrf_hash;
		echo json_encode($output);
	}

}
