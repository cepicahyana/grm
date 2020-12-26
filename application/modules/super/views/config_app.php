				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Config App</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?php echo base_url()?>super/dashboard">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Config App</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex justify-content-between">
										<div class="d-md-inline-block">
										<h4 class="card-title">Config App</h4>
										</div>
										<!--a href="javascript:input()" class="btn btn-primary d-none d-sm-inline-block">
											<i class="fa fa-plus-circle fa-lg"></i> Add User
										</a-->
									</div>
								</div>
								<form class="form-horizontal" id="formSubmit_edit" action="javascript:submitForm('formSubmit_edit')" method="post" enctype="multipart/form-data">
								<div class="card-body">
									<div id="area_lod">
									<div class="row" >
									<div class="col-md-6">
									
										<div class="form-group row">
											<label class="black col-md-4 control-label">Aplication Name</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input7" value="<?php echo $this->m_konfig->konfigurasi(7);?>" placeholder="">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-4 control-label">Client Name</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input6" value="<?php echo $this->m_konfig->konfigurasi(6);?>" placeholder="">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-4 control-label">Project Date</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input5" value="<?php echo $this->m_konfig->konfigurasi(5);?>" placeholder="">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-4 control-label">Product by</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input8" value="<?php echo $this->m_konfig->konfigurasi(8);?>"placeholder="">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-4 control-label">Copyright</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input9" value="<?php echo $this->m_konfig->konfigurasi(9);?>" placeholder="">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-4 control-label">Version App</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input11" value="<?php echo $this->m_konfig->konfigurasi(11);?>" placeholder="">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-4 control-label">Record Log</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input10" value="<?php echo $this->m_konfig->konfigurasi(10);?>" placeholder="">
											</div>
										</div>

									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="black col-md-3 control-label">Loggo</label>
											<div class="col-md-5">
												<input type="file" class="form-control" name="loggo" id="loggo_file" onchange="inputpreviewFileLoggo(this)">
												<input type="hidden" name="loggo_b" value="<?php echo $this->m_konfig->konfigurasi(1);?>">
											</div>
											<div class="col-md-3">
												<?php $img1=$this->m_konfig->konfigurasi(1);
												if($img1!=''){
													$img_1=''.base_url().'theme/images/'.$img1.'';
												}else{
													$img_1=''.base_url().'theme/images/no-image.png';
												}
												?>
												<img width="80px" height="80px" id="preview_loggo" src="<?php echo $img_1;?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-3 control-label">Favicon</label>
											<div class="col-md-5">
												<input type="file" class="form-control" name="fav" id="fav_file" onchange="inputpreviewFileFav(this)">
												<input type="hidden" name="fav_b" value="<?php echo $this->m_konfig->konfigurasi(2);?>">
											</div>
											<div class="col-md-3">
												<?php $img2=$this->m_konfig->konfigurasi(2);
												if($img2!=''){
													$img_2=''.base_url().'theme/images/'.$img2.'';
												}else{
													$img_2=''.base_url().'theme/images/no-image.png';
												}
												?>
												<img width="50px" height="50px" id="preview_fav" src="<?php echo $img_2;?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-3 control-label">Loggo Login</label>
											<div class="col-md-5">
												<input type="file" class="form-control" name="loggo_login" id="loggo_login" onchange="inputpreviewFileLoggoLogin(this)">
												<input type="hidden" name="loggo_login_b" value="<?php echo $this->m_konfig->konfigurasi(3);?>">
											</div>
											<div class="col-md-3">
												<?php $img3=$this->m_konfig->konfigurasi(3);
												if($img3!=''){
													$img_3=''.base_url().'theme/images/'.$img3.'';
												}else{
													$img_3=''.base_url().'theme/images/no-image.png';
												}
												?>
												<img width="100%" id="preview_loggo_login" src="<?php echo $img_3;?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-3 control-label">Loggo Admin</label>
											<div class="col-md-5">
												<input type="file" class="form-control" name="loggo_admin" id="loggo_admin" onchange="inputpreviewFileLoggoAdmin(this)">
												<input type="hidden" name="loggo_admin_b" value="<?php echo $this->m_konfig->konfigurasi(4);?>">
											</div>
											<div class="col-md-3">
												<?php $img4=$this->m_konfig->konfigurasi(4);
												if($img4!=''){
													$img_4=''.base_url().'theme/images/'.$img4.'';
												}else{
													$img_4=''.base_url().'theme/images/no-image.png';
												}
												?>
												<img width="100%" id="preview_loggo_admin" src="<?php echo $img_4;?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-3 control-label">Title Name</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input13" value="<?php echo $this->m_konfig->konfigurasi(13);?>" placeholder="">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-3 control-label">Header Name</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input14" value="<?php echo $this->m_konfig->konfigurasi(14);?>" placeholder="">
											</div>
										</div>
									</div>
									</div>
									</div>
								</div>
								<div class="card-footer">
								<button  title="Save" id="submit" onclick="submitForm('formSubmit_edit')" class="btn btn-primary"><i id="msg_formSubmit_edit"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
								</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>


<script>
function inputpreviewFileLoggo(el) { 
	var extension = $('#loggo_file').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .gif / .png / .jpg");
			$('#loggo_file').val('');
			return false;
		}
	}
	if (el.files && el.files[0]) {
         var FR= new FileReader();
         FR.onload = function(e) {
              $("#preview_loggo").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
}

function inputpreviewFileFav(el) { 
	var extension = $('#fav_file').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['ico','png']) == -1)
		{
			alert("Image File must be .ico / .png");
			$('#fav_file').val('');
			return false;
		}
	}
	if (el.files && el.files[0]) {
         var FR= new FileReader();
         FR.onload = function(e) {
              $("#preview_fav").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
}
function inputpreviewFileLoggoLogin(el) { 
	var extension = $('#loggo_login').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .gif / .png / .jpg");
			$('#loggo_login').val('');
			return false;
		}
	}
	if (el.files && el.files[0]) {
         var FR= new FileReader();
         FR.onload = function(e) {
              $("#preview_loggo_login").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
}
function inputpreviewFileLoggoAdmin(el) { 
	var extension = $('#loggo_admin').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .gif / .png / .jpg");
			$('#loggo_admin').val('');
			return false;
		}
	}
	if (el.files && el.files[0]) {
         var FR= new FileReader();
         FR.onload = function(e) {
              $("#preview_loggo_admin").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
}
</script>
<script>
  $(function () {
    //$('[data-mask]').inputmask();
	$("#formSubmit_edit").attr("url","<?php echo base_url("super/update_Config");?>");
  });
</script>			
