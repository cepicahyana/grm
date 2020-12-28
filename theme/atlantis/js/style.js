function login()
{
	console.log("excute");
	$.ajax({
	url:""+base_url+"auth/cekLogin",
	type: "POST",
	data: $('#formlogin').serialize(),
	dataType: "JSON",
	success: function(data)
		{
			
			$('#msg').html("");
		   if(data["upass"]==false){
				clearconsole();
			  	$('#msg_res').html("<div class='alert alert-danger alert-dismissible fade show' role='alert'><i class='fas fa-cancel-circle'></i>&nbsp;Username/Password Salah!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>"); 
			  	return false;
		   }

		   if(data["validasi"]==true){
				clearconsole();
				$('#msg_res').html("<div class='alert alert-success alert-dismissible fade show' role='alert'><i class='fas fa-cancel-circle'></i>&nbsp;Login Berhasil, Mohon Tunggu...<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");	
				window.location.href=""+base_url+""+data["direct"]; 
		   }else{
				window.location.href=""+base_url+"auth/logout"; 
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

function clearconsole() { 
	console.log(window.console);
	if(window.console || window.console.firebug) {
	 console.clear();
	}

}		
		
		
		