<div class="row row-nav-line mt--3">
	<div class="col-12">
	<ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-4" role="tablist">
		<li class="nav-item submenu"> <a class="nav-link active show" data-toggle="tab" href="#akun" role="tab" aria-selected="true">Akun</a> </li>
		<li class="nav-item submenu"> <a class="nav-link" data-toggle="tab" href="#data" role="tab" aria-selected="false">Data KRI</a> </li>
	</ul>
	</div>
</div>
<div class="row">
	<div class="col-12">
	<div class="tab-content mt-2 mb-3" id="pills-tabContent">
		<div class="tab-pane fade show active" id="akun" role="tabpanel" aria-labelledby="pills-home-tab">
			<div class="form-group row">
				<label class="black col-md-3 control-label">Nama Profile</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="f[profilename]" placeholder="">
				</div>
			</div>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Email</label>
				<div class="col-md-9">
					<input type="email" class="form-control" name="f[email]" placeholder="">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Avatar</label>
				<div class="col-md-5">
					<input type="file" class="form-control" name="profileimg" id="inputprofileimg" onchange="inputpreviewFile(this)">
				</div>
				<div class="col-md-3">
					<img width="100px" height="90px" id="inputpreview_img">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Username</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[username]" placeholder="">
				</div>
			</div>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Password</label>
				<div class="col-md-9">
					<input required type="password" class="form-control" name="password" placeholder="">
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="pills-profile-tab">
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
						<input type="file" class="form-control" name="imgdata" id="inputimgdata" onchange="inputpreviewFile2(this)">
					</div>
					<div class="mt-2">
						<img class="rounded" width="140px" height="120px" id="inputpreview_img2">
					</div>
				</div>

				
			</div>
		</div>

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
	var extension = $('#inputprofileimg').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .png / .jpg");
			$('#inputprofileimg').val('');
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
function inputpreviewFile2(el) { 
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
              $("#inputpreview_img2").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
}
</script>			