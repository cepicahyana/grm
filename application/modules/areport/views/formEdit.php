<input type="hidden" value="m" id="modaltype">
<?php 
$id_object=isset($data->id)?($data->id):'';
$name_object=isset($data->name_object)?($data->name_object):'';
$no_object=isset($data->no_object)?($data->no_object):'';
$code_object=isset($data->code_object)?($data->code_object):'';
$date_detected=isset($data->date_detected)?($data->date_detected):'';
$imgobject=isset($data->imgobject)?($data->imgobject):'';
$sts_object=isset($data->sts_object)?($data->sts_object):'';
$type_object=isset($data->type_object)?($data->type_object):'';
$nasionality=isset($data->nasionality)?($data->nasionality):'';
$_cid=isset($data->_cid)?($data->_cid):'';
$_ctime=isset($data->_ctime)?($data->_ctime):'';

$kategori=isset($data->kategori)?($data->kategori):'';
$lat_object=isset($data->lat)?($data->lat):'';
$lng_object=isset($data->lng)?($data->lng):'';
$LLlatobject=json_encode($lat_object);	
$LLlngobject=json_encode($lng_object);	

$user_detected=$this->m_konfig->goField('data_kri','profilename','id='.$_cid.'');
$taggal_deteksi=$this->tanggal->inddatetime($date_detected,' ');
$taggal_input=$this->tanggal->inddatetime($_ctime,' ');

$dbicon=$this->db->get_where('tm_kategoriobject',array('kode'=>$kategori))->row();
$iconobject=isset($dbicon->icon)?($dbicon->icon):'';
$kategoriobject=isset($dbicon->kategori)?($dbicon->kategori):'';

if($iconobject!=''){
	$iconobject_1=''.base_url().'theme/images/marker_object/'.$iconobject.'';
}else{
	$iconobject_1='';
}

if($imgobject!=''){
	$imgobject_1=''.base_url().'theme/images/object/'.$imgobject.'';
}else{
	$imgobject_1=''.base_url().'theme/images/no-image.png';
} 
				
?>
		
						
		<div class="row">
			<div class="col-md-12">
				<style>
				#map_canvas_edit {
				height:400px;
				width: 100%;
				border :1px solid #000;
				}
				</style>
				<div id="map_canvas_edit"></div>
			</div>
		</div>
	
		<input name="id" type="hidden" value="<?php echo $id_object ?>">
		<input name="imgobject_b" type="hidden" value="<?php echo $imgobject ?>">
		<div class="row">
		<div class="col-md-12">
			<div class="card">
			<div class="card-body">
				<p class="card-text">Keterangan marker : <?php 
				$dba=$this->db->get("tm_kategoriobject")->result();
				foreach($dba as $vala){
					echo "<img width='18px' src='".base_url()."theme/images/marker_object/".$vala->icon."'> ".$vala->kategori." &nbsp;&nbsp;&nbsp;&nbsp;";
				}
				?></p>
			</div>
			</div>
		</div>	
		</div>
		<div class="row">
			<div class="col-md-7">
				<div class="form-group">
					<label class="black control-label">Kode Object</label>
					<div>
						<input type="text" class="form-control"  value="<?php echo $code_object; ?>" disabled>
						<input type="hidden" class="form-control" name="f[code_object]" value="<?php echo $code_object; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Kategori Object</label>
					<div>
						<input type="text" class="form-control"  value="<?php echo $kategoriobject ?>" disabled>
						<input type="hidden" class="form-control" name="f[kategori]" value="<?php echo $kategori ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">No Object</label>
					<div>
						<input type="text" class="form-control" name="f[no_object]" value="<?php echo $no_object ?>" placeholder="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Nama Object</label>
					<div>
						<input type="text" class="form-control" name="f[name_object]" value="<?php echo $name_object ?>" placeholder="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Tanggal & Waktu Terdeteksi</label>
					<div>
					<div class="input-group">
						<input type="text" class="form-control" id="editdatetime" name="date_detected" value="<?php echo date("d/m/Y H:i")?>" required>
						<div class="input-group-append">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
						</div>
					</div>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Status Object</label>
					<div>
						<input type="text" class="form-control" name="f[sts_object]" value="<?php echo $sts_object ?>" placeholder="" required>
					</div>
				</div>

				<?php if($kategori==3){?>		
				<div class="form-group">
					<label class="black control-label">Type Object</label>
					<div>
						<input type="text" class="form-control" name="f[type_object]" value="<?php echo $type_object ?>" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Nasionality</label>
					<div>
						<input type="text" class="form-control" name="f[nasionality]" value="<?php echo $nasionality ?>" placeholder="">
					</div>
				</div>
				<?php }?>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="black control-label">Latitude</label>
					<div>
						<input required id="editlat" type="text" class="form-control" name="f[lat]" value="<?php echo $lat_object ?>" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Longitude</label>
					<div>
						<input required id="editlng" type="text" class="form-control" name="f[lng]" value="<?php echo $lng_object ?>" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label class="black control-label">Image</label>
					<div>
						<input type="file" class="form-control" name="imgobject" id="editimgdata" onchange="editpreviewFile(this)">
					</div>
					<div class="mt-2">
						<img class="rounded" width="140px" height="120px" id="editpreview_img" src="<?php echo $imgobject_1 ?>">
					</div>
				</div>
			</div>

		</div>

		
	
<?php 
$data=$this->db->get_where("data_kri",array("id"=>$this->session->userdata("id")))->row();
$id=isset($data->id)?($data->id):'';
$namadata=isset($data->namadata)?($data->namadata):'';	
$level=isset($data->level)?($data->level):'';	
$lat=isset($data->lat)?($data->lat):'';	
$lng=isset($data->lng)?($data->lng):'';	
$LLlat=json_encode($lat);	
$LLlng=json_encode($lng);	
$dbicon=$this->db->get_where('tm_iconmarker',array('level'=>$level))->row();
    $icon=isset($dbicon->icon)?($dbicon->icon):'';

    if($icon!=''){
        $icon_1=''.base_url().'theme/images/marker/'.$icon.'';
    }else{
        $icon_1=''.base_url().'theme/images/marker/default.png';
    }             		
?>
<!-- google maps key -->
<script
	src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->m_konfig->konfigmaps(1)?>&callback=initMapEdit&libraries=&v=weekly"
	defer
></script>	

<script type="text/javascript">
var map_edit;
var myCenterLatLng_edit;

window.onload = function () {
	initMapEdit();
};

function initMapEdit() {
	var myCenterLatLng_edit = { lat: <?php echo json_decode($LLlatobject) ?>, lng: <?php echo json_decode($LLlngobject) ?> };
	map_edit = new google.maps.Map(document.getElementById('map_canvas_edit'), {
		zoom: 10,
		center: myCenterLatLng_edit,
		scaleControl: true,
		mapTypeId: google.maps.MapTypeId.CLOUDMADE,
		streetViewControl: false,
	});
	const marker_1 = new google.maps.Marker({
		position: { lat: <?php echo json_decode($LLlat) ?>, lng: <?php echo json_decode($LLlng) ?> },
		icon: {
			url: '<?php echo $icon_1 ?>',
			labelOrigin: new google.maps.Point(16,-10),
			size: new google.maps.Size(35,35),
			anchor: new google.maps.Point(16,32)
		},
		label: {
			text: '<?php echo $namadata ?>',
			color: '#C70E20',
			background: "#000000",
			fontSize: '10px',
			fontWeight: "bold"
		},
		map: map_edit
	});
	var objectLatLng = { lat: <?php echo json_decode($LLlatobject) ?>, lng: <?php echo json_decode($LLlngobject) ?> };
	const marker_2 = new google.maps.Marker({
		position: objectLatLng,
		icon: {
			url: '<?php echo $iconobject_1 ?>',
			labelOrigin: new google.maps.Point(16,-10),
			size: new google.maps.Size(35,35),
			anchor: new google.maps.Point(16,32)
		},
		draggable:true,
		map: map_edit
	});
	google.maps.event.addListener(marker_2,'drag',function(event) {
		document.getElementById('editlat').value = event.latLng.lat();
		document.getElementById('editlng').value = event.latLng.lng();
	});
	
}
</script>			
		
<script>
  $(function () {
	$('#editdatetime').datetimepicker({
		format: 'MM/DD/YYYY H:mm',
	});
  });
</script>	


		
<script>
function editpreviewFile(el) {
	var extension = $('#editimgdata').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .png / .jpg");
			$('#editimgdata').val('');
			return false;
		}
	}
	if (el.files && el.files[0]) {
         var FR= new FileReader();
         FR.onload = function(e) {
              $("#editpreview_img").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
}
</script>

	