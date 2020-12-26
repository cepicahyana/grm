
<?php 
$id=isset($data->id_admin)?($data->id_admin):'';
$username=isset($data->username)?($data->username):'';
$gender=isset($data->gender)?($data->gender):'';
$profileimg=isset($data->profileimg)?($data->profileimg):'';	
$profilename=isset($data->profilename)?($data->profilename):'';		
$wa=isset($data->wa)?($data->wa):'';	
$email=isset($data->email)?($data->email):'';
$level=isset($data->level)?($data->level):'';
$sts=isset($data->sts_aktif)?($data->sts_aktif):'';
$img=$profileimg;
if($img!=''){
	$img_=''.base_url().'theme/images/user/'.$img.'';
}else{
	$img_=''.base_url().'theme/images/user/img_not.png';
}		
?>
			<input name="id_admin" type="hidden" value="<?php echo $id ?>">
			<input name="username_b" type="hidden" value="<?php echo $username ?>">
			<input name="profileimg_b" type="hidden" value="<?php echo $profileimg ?>">

			<div class="form-group row">
				<label class="black col-md-3 control-label">User Group</label>
				<div class="col-md-9">
					<?php
						$dataray=array();
						$dataray['']="=== Choose ===";
						$db=$this->db->order_by("code_level","asc");
						$db=$this->db->get_where("main_level",array('code_level>'=>1))->result();
						foreach($db as $db)
						{
							$dataray[$db->code_level]='['.$db->code_level.'] - '.$db->levelname;
						}
						echo form_dropdown("f[level]",$dataray,$level,'class="form-control show-tick"');
					?>	
				</div>
			</div>
		
			<div class="form-group row">
				<label class="black col-md-3 control-label">Photo Profile</label>
				<div class="col-md-6">
					<input type="file" class="form-control" name="profileimg"  id="editprofileimg" onchange="editpreviewFile(this)">
				</div>
				<div class="col-md-2">
					<img width="80px" height="80px" id="editpreview_img" src="<?php echo $img_ ?>">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Profile name</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="f[profilename]" value="<?php echo $profilename ?>" placeholder="">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Gender</label>
				<div class="col-md-9">
					<label class="form-radio-label">
						<input class="form-radio-input" type="radio" name="f[gender]" value="Male" <?php if($gender=='Male'){echo 'checked';} ?>>
						<span class="form-radio-sign">Male</span>
					</label>
					<label class="form-radio-label ml-3">
						<input class="form-radio-input" type="radio" name="f[gender]" value="Fimale" <?php if($gender=='Fimale'){echo 'checked';} ?>>
						<span class="form-radio-sign">Fimale</span>
					</label>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Wahtsapp</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="f[wa]" value="<?php echo $wa ?>" data-inputmask="'mask': ['9999 9999 9999']" data-mask placeholder="">
				</div>
			</div>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Email</label>
				<div class="col-md-9">
					<input type="email" class="form-control" name="f[email]" value="<?php echo $email ?>" placeholder="">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Username</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[username]" value="<?php echo $username ?>" placeholder="">
				</div>
			</div>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Password</label>
				<div class="col-md-9">
					<input type="password" class="form-control" name="password" placeholder="(hanya di isi untuk password baru)">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Status Aktif</label>
				<div class="col-md-9">
					<label class="form-radio-label">
						<input class="form-radio-input" type="radio" name="f[sts_aktif]" value="1" <?php if($sts==1){echo 'checked';} ?>>
						<span class="form-radio-sign">Aktif</span>
					</label>
					<label class="form-radio-label ml-3">
						<input class="form-radio-input" type="radio" name="f[sts_aktif]" value="2" <?php if($sts==2){echo 'checked';} ?>>
						<span class="form-radio-sign">Tidak Aktif</span>
					</label>
				</div>
			</div>
			
	
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
	