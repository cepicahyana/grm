
<?php 
$id=isset($data->id)?($data->id):'';
$imgdata=isset($data->imgdata)?($data->imgdata):'';	
$namadata=isset($data->namadata)?($data->namadata):'';	
$descdata=isset($data->descdata)?($data->descdata):'';
		
$lat=isset($data->lat)?($data->lat):'';	
$lng=isset($data->lng)?($data->lng):'';
$LLlat=json_encode($lat);	
$LLlng=json_encode($lng);	

if($imgdata!=''){
	$img_1=''.base_url().'theme/images/data/'.$imgdata.'';
}else{
	$img_1=''.base_url().'theme/images/no-image.png';
}				
?>
			<input name="id" type="hidden" value="<?php echo $id ?>">
			<input name="namadata_b" type="hidden" value="<?php echo $namadata ?>">
			<input name="imgdata_b" type="hidden" value="<?php echo $imgdata ?>">

		
			<div class="row">
			<div class="col-md-7">
				<style>
				#map_canvas_edit {
				height:400px;
				width: 100%;
				border :1px solid #000;
				}
				</style>
				<div id="map_canvas_edit"></div>
				<div class="form-group">
					<label class="black control-label">Latitude</label>
					<div>
						<input required id="mlat" type="text" class="form-control" name="f[lat]" value="<?php echo $lat ?>" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Longitude</label>
					<div>
						<input required id="mlng" type="text" class="form-control" name="f[lng]" value="<?php echo $lng ?>" placeholder="">
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="black control-label">Nama</label>
					<div>
						<input type="text" class="form-control" name="f[namadata]" value="<?php echo $namadata ?>" placeholder="" required>
					</div>
				</div>

				<div class="form-group">
					<label class="black control-label">Deskripsi</label>
					<div>
						<textarea class="form-control" rows="2" name="f[descdata]" placeholder=""><?php echo $descdata ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="black control-label">Image</label>
					<div>
						<input type="file" class="form-control" name="imgdata" id="editimgdata" onchange="editpreviewFile(this)">
					</div>
					<div class="mt-2">
						<img class="rounded" width="140px" height="120px" id="editpreview_img" src="<?php echo $img_1?>">
					</div>
				</div>

				
			</div>
		</div>
			
<!-- google maps key -->
<script
	src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->m_konfig->konfigmaps(1)?>&callback=initMap&libraries=&v=weekly"
	defer
></script>		

<script type="text/javascript">
var map;
window.onload = function () {
	initMap();
};
function initMap() {
	<?php if($lat!='' && $lng!=''){?>
        var myCenterLatLng = { lat: <?php echo json_decode($LLlat) ?>, lng: <?php echo json_decode($LLlng) ?> };
    <?php }else{?>
        var myCenterLatLng = { lat: <?php echo $this->m_konfig->konfigmaps(2)?>, lng: <?php echo $this->m_konfig->konfigmaps(3)?> };
    <?php }?>

	map = new google.maps.Map(document.getElementById('map_canvas_edit'), {
		zoom: 5,
		center: myCenterLatLng,
		scaleControl: true,
		mapTypeId: google.maps.MapTypeId.CLOUDMADE,
		streetViewControl: false,
	});
	
	const marker = new google.maps.Marker({
		position: myCenterLatLng,
		draggable:true,
		map: map
	});
	google.maps.event.addListener(marker,'drag',function(event) {
		document.getElementById('mlat').value = event.latLng.lat();
		document.getElementById('mlng').value = event.latLng.lng();
	});
} 
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
<script>
  $(function () {
    $('[data-mask]').inputmask()
  });
</script>	
	