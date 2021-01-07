<input type="hidden" value="m" id="modaltype">	
		<div class="row">
			<div class="col-md-12">
				<style>
				#map_canvas_add {
				height:400px;
				width: 100%;
				border :1px solid #000;
				}
				</style>
				<div id="map_canvas_add"></div>
			</div>
		</div>
		<form class="form-horizontal" id="formSubmit_page" action="javascript:submitForm('formSubmit_page')" method="post">
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
						<?php 
						$datetimenow=date('dmYHis');
						$acak=$this->m_reff->acak(4);
						?>
						<input type="text" class="form-control"  value="<?php echo 'OBJ'.$datetimenow.$acak; ?>" disabled>
						<input type="hidden" class="form-control" name="f[code_object]" value="<?php echo $datetimenow.$acak; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Kategori Object</label>
					<div>
					<select id="inputbasic" name="f[kategori]" class="form-control" onchange="choose_category()" style="width:100%" required>
						<option value="">=== Choose ===</option>
						<?php 
					    $db=$this->db->get("tm_kategoriobject")->result();
					    foreach($db as $val){
						   echo "<option value='".$val->kode."'> ".$val->kategori."</option>";
					    }
					    ?>
				    </select>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">No Object</label>
					<div>
						<input type="text" class="form-control" name="f[no_object]" placeholder="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Nama Object</label>
					<div>
						<input type="text" class="form-control" name="f[name_object]" placeholder="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Tanggal & Waktu Terdeteksi</label>
					<div>
					<div class="input-group">
						<input type="text" class="form-control" id="inputdatetime" name="date_detected" value="<?php echo date("d/m/Y H:i")?>" required>
						<div class="input-group-append">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
						</div>
					</div>
					</div>
				</div>
				<div id="group_a">
				<div class="form-group">
					<label class="black control-label">Status Object</label>
					<div>
						<input type="text" class="form-control" name="f[sts_object]" placeholder="">
					</div>
				</div>
				</div>

				<div id="group_b" style="display:none;">		
				<div class="form-group">
					<label class="black control-label">Type Object</label>
					<div>
						<input type="text" class="form-control" name="f[type_object]" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Nasionality</label>
					<div>
						<input type="text" class="form-control" name="f[nasionality]" placeholder="">
					</div>
				</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="black control-label">Latitude</label>
					<div>
						<input required id="inputlat" type="text" class="form-control" name="f[lat]" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Longitude</label>
					<div>
						<input required id="inputlng" type="text" class="form-control" name="f[lng]" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label class="black control-label">Image</label>
					<div>
						<input type="file" class="form-control" name="imgobject" id="inputimgdata" onchange="inputpreviewFile(this)">
					</div>
					<div class="mt-2">
						<img class="rounded" width="140px" height="120px" id="inputpreview_img">
					</div>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-md-12">
				<hr>
				<div class="pull-right">
				<button type="button" onclick="close_modal()" class="btn btn-default mr-2" data-dismiss="modal">Close</button>
	  			<button  title="Save" id="submit" onclick="submitForm('formSubmit_page')" class="btn btn-primary"><i id="msg_formSubmit_page"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
				</div>
			</div>
		</div>
		</form>
		
<?php 
$data=$this->db->get_where("data_kri",array("id"=>$this->session->userdata("id")))->row();
$id=isset($data->id)?($data->id):'';
$imgdata=isset($data->imgdata)?($data->imgdata):'';	
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
	src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->m_konfig->konfigmaps(1)?>&callback=initMapAdd&libraries=&v=weekly"
	defer
></script>
<script type="text/javascript">
var map_add;
var myCenterLatLng;

window.onload = function () {
	initMapAdd();
};

function initMapAdd() {
	var myCenterLatLng = { lat: <?php echo json_decode($LLlat) ?>, lng: <?php echo json_decode($LLlng) ?> };
	map_add = new google.maps.Map(document.getElementById('map_canvas_add'), {
		zoom: 7,
		center: myCenterLatLng,
		scaleControl: true,
		mapTypeId: google.maps.MapTypeId.CLOUDMADE,
		streetViewControl: false,
	});
	const marker = new google.maps.Marker({
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
		map: map_add
	});
	const marker_2 = new google.maps.Marker({
		position: myCenterLatLng,
		draggable:true,
		map: map_add
	});
	google.maps.event.addListener(marker_2,'drag',function(event) {
		document.getElementById('inputlat').value = event.latLng.lat();
		document.getElementById('inputlng').value = event.latLng.lng();
	});
	$("#formSubmit_page").attr("url","<?php echo base_url("areport/insert_data");?>");
	$("#formSubmit_page")[0].reset();
	$("#inputpreview_img").attr("src", '<?php echo base_url()?>theme/images/no-image.png');
}
</script>			
<script>
function choose_category()
{
	var kode = $("#basic").val();
	if(kode==3)
	{
		$("#group_a").hide();
		$("#group_b").show();
	}else{
		$("#group_a").show();
		$("#group_b").hide();
	}
}
</script>			
<script>
  $(function () {
	$('#inputdatetime').datetimepicker({
		format: 'MM/DD/YYYY H:mm',
	});
	$('#inputbasic').select2({
		theme: "bootstrap"
	});
  });
</script>	


<script>
function inputpreviewFile(el) { 
	var extension = $('#inputimgdata').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .png / .jpg");
			$('#inputimgdata').val('');
			return false;
		}
	}
	if (el.files && el.files[0]) {
         var FR= new FileReader();
         FR.onload = function(e) {
              $("#inputpreview_img").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
}
</script>			