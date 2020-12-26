				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Setting Maps</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?php echo base_url()?>dashboard">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Setting Maps</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex justify-content-between">
										<div class="d-md-inline-block">
										<h4 class="card-title">Setting Maps</h4>
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
									<div class="col-md-10">
									
										<div class="form-group row">
											<label class="black col-md-3 control-label">API KEY MAPS</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="input1" value="<?php echo $this->m_konfig->konfigmaps(1);?>" placeholder="">
											</div>
										</div>
										<div class="form-group row">
											<label class="black col-md-3 control-label">CENTER LATLONG</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="input2" value="<?php echo $this->m_konfig->konfigmaps(2);?>" placeholder="">
											</div>
											<div class="col-md-4">
												<input type="text" class="form-control" name="input3" value="<?php echo $this->m_konfig->konfigmaps(3);?>" placeholder="">
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
	$("#formSubmit_edit").attr("url","<?php echo base_url("Asettingmaps/update_Config");?>");
  });
</script>			
