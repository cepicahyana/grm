			<div class="form-group row">
				<label class="black col-md-3 control-label">User Group</label>
				<div class="col-md-9">
					<select class="form-control show-tick" name="f[level]" data-live-search="true">
						<option value="">=== Choose ===</option>
						<?php 
					    $db=$this->db->get_where("main_level",array('code_level>'=>1))->result();
					    foreach($db as $val){
						   echo "<option value='".$val->code_level."'>[".$val->code_level."] - ".$val->levelname."</option>";
					    }
					    ?>
				    </select>
				</div>
			</div>
		
			<div class="form-group row">
				<label class="black col-md-3 control-label">Photo Profile</label>
				<div class="col-md-6">
					<input type="file" class="form-control" name="profileimg" id="inputprofileimg" onchange="inputpreviewFile(this)">
				</div>
				<div class="col-md-2">
					<img width="80px" height="90px" id="inputpreview_img">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Profile name</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="f[profilename]" placeholder="">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Gender</label>
				<div class="col-md-9">
					<label class="form-radio-label">
						<input class="form-radio-input" type="radio" name="f[gender]" value="Male">
						<span class="form-radio-sign">Male</span>
					</label>
					<label class="form-radio-label ml-3">
						<input class="form-radio-input" type="radio" name="f[gender]" value="Fimale">
						<span class="form-radio-sign">Fimale</span>
					</label>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Wahtsapp</label>
				<div class="col-md-9">
					<input type="text" class="form-control" data-inputmask="'mask': ['9999 9999 9999']" data-mask name="f[wa]" placeholder="">
				</div>
			</div>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Email</label>
				<div class="col-md-9">
					<input type="email" class="form-control" name="f[email]" placeholder="">
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
			
<script>
function inputpreviewFile(el) { 
	var extension = $('#inputprofileimg').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .gif / .png / .jpg");
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


</script>
<script>
  $(function () {
    $('[data-mask]').inputmask()
  });
</script>			