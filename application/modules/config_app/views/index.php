

<div class="headertitle">
	<div class="row mb-2">
	  <div class="col-sm-6">
		<h1>Config App</h1>
	  </div><!-- /.col -->
	  <!--div class="col-sm-6">
		  <a href="javascript:input()" class="btn btn-primary float-sm-right">
			<i class="fa fa-plus-circle fa-lg"></i> Add User
		  </a>
	  </div><!-- /.col -->
	</div><!-- /.row -->
</div>	

<!--h5 class="mb-2"></h5-->

<div class="row" >
<div class="col-md-12">
  <div class="card card-success">
	<div class="card-header">
	  <h3 class="card-title">App Configuration</h3>
	</div>
	<form class="form-horizontal" id="formSubmit_edit" action="javascript:submitFormRefresh('formSubmit_edit')" method="post" enctype="multipart/form-data">
	<!-- /.card-header -->
	<div id="area_lod" class="card-body">

		<div class="row" >
		<div class="col-md-6">

			<div class="form-group row">
				<label class="black col-md-4 control-label">Title Name</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="input13" value="<?php echo $this->m_konfig->konfigurasi(13);?>" placeholder="">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-4 control-label">Header Name</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="input14" value="<?php echo $this->m_konfig->konfigurasi(14);?>" placeholder="">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-4 control-label">Copyright</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="input9" value="<?php echo $this->m_konfig->konfigurasi(9);?>" placeholder="">
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
			
		</div>
		</div>

	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	  <button  title="Save" id="submit" onclick="submitFormRefresh('formSubmit_edit')" class="btn btn-success"><i id="msg_formSubmit_edit"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
	</div>
	</form>
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
	var extension = $('#loggo_file').val().split('.').pop().toLowerCase();
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

</script>
<script>
  $(function () {
    //$('[data-mask]').inputmask();
	$("#formSubmit_edit").attr("url","<?php echo base_url('config_app/update_Config');?>");
  });
</script>			
