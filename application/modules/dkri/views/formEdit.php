
<?php 
$id=isset($data->id)?($data->id):'';
$username=isset($data->username)?($data->username):'';
$profileimg=isset($data->profileimg)?($data->profileimg):'';	
$profilename=isset($data->profilename)?($data->profilename):'';	
$namadata=isset($data->namadata)?($data->namadata):'';
$descdata=isset($data->descdata)?($data->descdata):'';
$imgdata=isset($data->imgdata)?($data->imgdata):'';	
$wa=isset($data->wa)?($data->wa):'';	
$email=isset($data->email)?($data->email):'';
$level=isset($data->level)?($data->level):'';
$sts=isset($data->sts_aktif)?($data->sts_aktif):'';

$lat=isset($data->lat)?($data->lat):'';	
$lng=isset($data->lng)?($data->lng):'';
$LLlat=json_encode($lat);	
$LLlng=json_encode($lng);

if($profileimg!=''){
	$img_1=''.base_url().'theme/images/user/'.$profileimg.'';
}else{
	$img_1=''.base_url().'theme/images/no-image.png';
}	

if($imgdata!=''){
	$img_2=''.base_url().'theme/images/data/'.$imgdata.'';
}else{
	$img_2=''.base_url().'theme/images/no-image.png';
}					
?>
<div class="row row-nav-line mt--3">
	<div class="col-12">
	<ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-4" role="tablist">
		<li class="nav-item submenu"> <a class="nav-link active show" data-toggle="tab" href="#akun2" role="tab" aria-selected="true">Akun</a> </li>
		<li class="nav-item submenu"> <a class="nav-link" data-toggle="tab" href="#data2" role="tab" aria-selected="false">Data KRI</a> </li>
	</ul>
	</div>
</div>
<div class="row">
	<div class="col-12">
	<div class="tab-content mt-2 mb-3" id="pills-tabContent">
		<div class="tab-pane fade show active" id="akun2" role="tabpanel" aria-labelledby="pills-home-tab">
			<input name="id" type="hidden" value="<?php echo $id ?>">
			<input name="username_b" type="hidden" value="<?php echo $username ?>">
			<input name="email_b" type="hidden" value="<?php echo $email ?>">
			<input name="profileimg_b" type="hidden" value="<?php echo $profileimg ?>">
			<input name="imgdata_b" type="hidden" value="<?php echo $imgdata ?>">

			<div class="form-group row">
				<label class="black col-md-3 control-label">Nama Profile</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="f[profilename]" value="<?php echo $profilename ?>" placeholder="">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Email</label>
				<div class="col-md-8">
					<input type="email" class="form-control" name="f[email]" value="<?php echo $email ?>" placeholder="">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Avatar</label>
				<div class="col-md-4">
					<input type="file" class="form-control mb-2" name="profileimg"  id="editprofileimg" onchange="editpreviewFile(this)">
				</div>
				<div class="col-md-3">
					<img width="100px" height="80px" id="editpreview_img" src="<?php echo $img_1?>">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Username</label>
				<div class="col-md-8">
					<input required type="text" class="form-control" name="f[username]" value="<?php echo $username ?>" placeholder="">
				</div>
			</div>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Password</label>
				<div class="col-md-8">
					<input type="password" class="form-control" name="password" placeholder="(hanya di isi untuk password baru)">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Status Aktif</label>
				<div class="col-md-8">
					<label class="form-radio-label">
						<input class="form-radio-input" type="radio" name="f[sts_aktif]" value="1" <?php if($sts=='1'){echo 'checked';} ?>>
						<span class="form-radio-sign">Aktif</span>
					</label>
					<label class="form-radio-label ml-3">
						<input class="form-radio-input" type="radio" name="f[sts_aktif]" value="2" <?php if($sts=='2'){echo 'checked';} ?>>
						<span class="form-radio-sign">Tidak Aktif</span>
					</label>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="data2" role="tabpanel" aria-labelledby="pills-profile-tab">
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
					<label class="black control-label">Nama KRI</label>
					<div>
						<input type="text" class="form-control" name="f[namadata]" value="<?php echo $namadata ?>" placeholder="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Deskripsi KRI</label>
					<div>
						<textarea class="form-control" rows="3" name="f[descdata]" placeholder=""><?php echo $descdata ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="black control-label">Image KRI</label>
					<div>
						<input type="file" class="form-control" name="imgdata" id="editimgdata" onchange="editpreviewFile2(this)">
					</div>
					<div class="mt-2">
						<img class="rounded" width="140px" height="120px" id="editpreview_img2" src="<?php echo $img_2?>">
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
	<?php if($lat!='' && $lng!=''){?>
        var myCenterLatLng = { lat: <?php echo json_decode($LLlat) ?>, lng: <?php echo json_decode($LLlng) ?> };
    <?php }else{?>
        var myCenterLatLng = { lat: -0.038302, lng: 120.060753 };
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
	var extension = $('#editprofileimg').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .gif / .png / .jpg");
			$('#editprofileimg').val('');
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
	