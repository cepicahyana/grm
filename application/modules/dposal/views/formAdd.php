			
		<div class="row">
			<div class="col-md-7">
				<style>
				#map_canvas_add {
				height:400px;
				width: 100%;
				border :1px solid #000;
				}
				</style>
				<div id="map_canvas_add"></div>
				<div class="form-group">
					<label class="black control-label">Latitude</label>
					<div>
						<input required id="mlat" type="text" class="form-control" name="f[lat]" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Longitude</label>
					<div>
						<input required id="mlng" type="text" class="form-control" name="f[lng]" placeholder="">
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="black control-label">Nama</label>
					<div>
						<input type="text" class="form-control" name="f[namadata]" placeholder="" required>
					</div>
				</div>

				<div class="form-group">
					<label class="black control-label">Deskripsi</label>
					<div>
						<textarea class="form-control" rows="2" name="f[descdata]" placeholder=""></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="black control-label">Image</label>
					<div>
						<input type="file" class="form-control" name="imgdata" id="inputimgdata" onchange="inputpreviewFile(this)">
					</div>
					<div class="mt-2">
						<img class="rounded" width="140px" height="120px" id="inputpreview_img">
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
	var myCenterLatLng = { lat: <?php echo $this->m_konfig->konfigmaps(2)?>, lng: <?php echo $this->m_konfig->konfigmaps(3)?> };
	map = new google.maps.Map(document.getElementById('map_canvas_add'), {
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
  $(function () {
    $('[data-mask]').inputmask()
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