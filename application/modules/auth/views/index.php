		<div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center" style=" background: rgb(104,147,179);
background: -moz-linear-gradient(180deg, rgba(104,147,179,1) 0%, rgba(76,119,151,1) 100%);
background: -webkit-linear-gradient(180deg, rgba(104,147,179,1) 0%, rgba(76,119,151,1) 100%);
background: linear-gradient(180deg, rgba(104,147,179,1) 0%, rgba(76,119,151,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#6893b3',endColorstr='#4c7797',GradientType=1); ">
			<?php $img3=$this->m_konfig->konfigurasi(1);
			if($img3!=''){
				$img_3=''.base_url().'theme/images/'.$img3.'';
			}else{
				$img_3='';
			}
			?>
			<img class="text-white pb-4" src="<?php echo $img_3;?>" alt="Logo" style="max-width:200px">
			<h1 class="title fw-bold text-white mb-3">JALA WIBAWA GUNDALA</h1>
			<p class="subtitle text-white op-7">GUGUS TEMPUR LAUT</p>
		</div>
		<div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
			<div class="container container-login container-transparent animated fadeIn">
				<?php $img4=$this->m_konfig->konfigurasi(3);
				if($img4!=''){
					$img_4=''.base_url().'theme/images/'.$img4.'';
				}else{
					$img_4='';
				}
				?>
				
				<h3 class="text-center"><img class="text-white pb-4" src="<?php echo $img_4;?>" alt="Logo" style="max-width:180px;margin:0 auto;"><br>Sign In To App</h3>
				<div id="msg_res" ></div>
				<form id="formlogin" method="POST" action="javascript:login()">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" >
				<div class="login-form">
					<div class="form-group">
						<label for="username" class="placeholder"><b>Username</b></label>
						<input id="username" name="username" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password" class="placeholder"><b>Password</b></label>
						<div class="position-relative">
							<input id="password" name="password" type="password" class="form-control" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="form-group mb-3">
						<div class="row">
							<div class="col-md-7">
							<div class="mt-3" id="msg"></div>
							</div>
							<div class="col-md-5">
							<button type="submit" class="btn btn-primary btn-block float-right mt-3 mt-sm-0 fw-bold">Sign In</button>
							</div>
						</div>
					</div>
					
				</div>
				</form>
			</div>

		</div>
  
		<!--div class="input-group mb-3" id="show_hide_password">
		  <input type="password" class="form-control" name="password" placeholder="Password" required>
		  <span class="input-group-append" style="width:45px;">
			<a href="javascript:show_hide_password()" class="btn btn-default">
				<i class="fa fa-eye-slash" aria-hidden="true"></i>
			</a>
		  </span>
		</div-->
				
        





<script>
/*function show_hide_password() {
	if($('#show_hide_password input').attr("type") == "text"){
		$('#show_hide_password input').attr('type', 'password');
		$('#show_hide_password i').addClass( "fa-eye-slash" );
		$('#show_hide_password i').removeClass( "fa-eye" );
	}else if($('#show_hide_password input').attr("type") == "password"){
		$('#show_hide_password input').attr('type', 'text');
		$('#show_hide_password i').removeClass( "fa-eye-slash" );
		$('#show_hide_password i').addClass( "fa-eye" );
	}
}*/

function login()
{
	$('#msg').html("<img src='<?php echo base_url();?>theme/images/loader/loadingblue.gif'> Please wait...");
	$.ajax({
	url:"<?php echo base_url();?>auth/cekLogin",
	type: "POST",
	data: $('#formlogin').serialize(),
	dataType: "JSON",
	success: function(data)
		{
			$('#msg').html("");
		   //if success close modal and reload ajax table
		   if(data["upass"]==false){
			  $('#msg_res').html("<div class='alert alert-danger alert-dismissible fade show' role='alert'><i class='fas fa-cancel-circle'></i>&nbsp;Username/Password Salah!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>"); 
			  return false;
		   }

		   

		   if(data["validasi"]==true){
			$('#msg_res').html("<div class='alert alert-success alert-dismissible fade show' role='alert'><i class='fas fa-cancel-circle'></i>&nbsp;Login Berhasil, Mohon Tunggu...<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");	
				window.location.href="<?php echo base_url();?>"+data["direct"]; 
		   }else{
				window.location.href="<?php echo base_url();?>auth/logout"; 
		   }
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Try Again!');
			$('#msg').html("");
			return false;
		}
	});
 
}
</script>


 	
 	
 	
 	

 
            