<input type="hidden" value="n" id="modaltype">	
<?php 
$username=isset($data->username)?($data->username):'';
$gender=isset($data->gender)?($data->gender):'';
$profileimg=isset($data->profileimg)?($data->profileimg):'';	
$profilename=isset($data->profilename)?($data->profilename):'';		
$wa=isset($data->wa)?($data->wa):'';	
$email=isset($data->email)?($data->email):'';
$profileaddress=isset($data->profileaddress)?($data->profileaddress):'';	
$idlevel=isset($data->level)?($data->level):'';
$level=$this->m_konfig->getNamaUG($idlevel);

if($profileimg!=''){
	$img_1=''.base_url().'theme/images/user/'.$profileimg.'';
}else{
	$img_1=''.base_url().'theme/images/no-image.png';
}				
?>
				
					<div id="area_lod" class="row">
						<div class="col-md-8">
							<div class="card card-with-nav">
							<form class="form-horizontal" id="formSubmit_edit" action="javascript:submitFormRefresh('formSubmit_edit')" method="post" enctype="multipart/form-data">
							<input name="username_b" type="hidden" value="<?php echo $username ?>">
							<input name="profileimg_b" type="hidden" value="<?php echo $profileimg ?>">
								<div class="card-body">
									<div class="row mt-3">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Profile Name</label>
												<input type="text" class="form-control" name="f[profilename]" placeholder="Profile Name" value="<?php echo $profilename ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Email</label>
												<input type="email" class="form-control" name="f[email]" placeholder="name@mail.com" value="<?php echo $email ?>">
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Whatsapp</label>
												<input type="text" class="form-control" name="f[wa]" data-inputmask="'mask': ['9999 9999 9999']" data-mask placeholder="Profile Name" value="<?php echo $wa ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Email</label>
												<input type="text" class="form-control" name="f[username]" placeholder="Username" value="<?php echo $username ?>">
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-12">
											<div class="form-group form-group-default">
												<label>Address</label>
												<input type="text" class="form-control" name="f[profileaddress]" value="<?php echo $profileaddress ?>" name="address" placeholder="Address">
											</div>
										</div>
									</div>
									<div class="text-right mt-3 mb-3">
										<button  title="Save" id="submit" onclick="submitFormRefresh('formSubmit_edit')" class="btn btn-primary"><i id="msg_formSubmit_edit"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
										<!--button class="btn btn-danger">Reset</button-->
									</div>
								</div>
							</form>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-profile">
								
								<img id="editpreview_img" src="<?php echo $img_1;?>" alt="Avatar" class="avatar-img">
										
								
								<div class="card-body mt--5">
									<div class="user-profile text-center pd-4">
										<div class="name"><?php echo $profilename;?></div>
										<div class="job">Group User : <?php echo $level;?></div>
										<div class="mt-3">
										<input type="file" class="form-control form-control-file btn btn-sm btn-default btn-round btn-lg" onchange="editpreviewFile(this)" id="editprofileimg" name="editprofileimg" accept="image/*" required="">
										</div>
									</div>
								</div>
								<!--div class="card-footer">
									<div class="row user-stats text-center">
										<div class="col">
											<div class="number">125</div>
											<div class="title">Post</div>
										</div>
										<div class="col">
											<div class="number">25K</div>
											<div class="title">Followers</div>
										</div>
										<div class="col">
											<div class="number">134</div>
											<div class="title">Following</div>
										</div>
									</div>
								</div-->
							</div>
						</div>
					</div>
			





<script>
function editpreviewFile(el) {
	var extension = $('#editprofileimg').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
		{
			alert("Image File must be  .png / .jpg");
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
    $('[data-mask]').inputmask();
	$("#formSubmit_edit").attr("url","<?php echo base_url("uprofile/update_Profile");?>");
  });
</script>			
