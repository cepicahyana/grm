 
function submitFormAkun(id)
{		
		var form = $("#"+id);
		var link = $(form).attr("url");
	 
		$(form).ajaxForm({
		 url:link,
		 data: $(form).serialize(),
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
               loading("area_"+id);
            },
		 success: function(data)
				{ 	   unblock("area_"+id); 	
					if(data["gagal"]==true)
					{	  
							notif(data["info"]);
					} else{
					  $("#"+id)[0].reset();
					  $("#mdl_"+id).modal("hide"); 
					  reload_table();
					  		
					  $("#mdl_"+id).modal("hide");
					}
					 			
				}
		});     
};



function submitForm(id)
{		
		var form = $("#"+id);
		var link = $(form).attr("url");
	 
		$(form).ajaxForm({
		 url:link,
		 data: $(form).serialize(),
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
               loading("area_"+id);
            },
		 success: function(data)
				{ 	   unblock("area_"+id); 	
					if(data["gagal"]==true)
					{	  
							notif(data["info"]);
					} else{
					  $("#"+id)[0].reset();
					  $("#mdl_"+id).modal("hide"); 
					  reload_table();
					  		
					  $("#mdl_"+id).modal("hide");
					}
					 			
				}
		});     
};



function submitFormNoResset(id)
{		
		var form = $("#"+id);
		var link = $(form).attr("url");
	 
		$(form).ajaxForm({
		 url:link,
		 data: $(form).serialize(),
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
               loading("area_"+id);
            },
		 success: function(data)
				{ 	   unblock("area_"+id); 	
					if(data["gagal"]==true)
					{	  
							notif(data["info"]);
					}  else{
						  
						  reload_table();
					   
					}
					 			
				}
		});     
};

 
function saveModal(id)
{
 
		 blok("f_"+id);
		 var link = $("#f_"+id).attr("url");
		 $('#f_'+id).ajaxForm({
		 url:link,
		 data: $('#f_'+id).serialize(),
		 method:"POST",
		 dataType:"JSON",
		 success: function(data)
				{ 	 
				 
				$('#f_'+id).unblock(); 
					if(data["validasi"]==false)
					{	  
							notif("<b>Gagal memposting!</b><br>- Upload File Maksimal 3MB. <br> - File yang diizinkan adalah JPG/PNG.");
					}else if(data["token"]==false)
					{
						notif_error("<span class='col-white'><b>Gagal!</b>  Silahkan coba lagi.</span>");
							$("#f_"+id).modal("hide");
							$("#ff_"+id).modal("hide");
					}else{
					  $('#f_'+id)[0].reset();
					  $('#'+id).modal("hide"); 
					  reload_table();
				//	 berhasil_disimpan();
					 	$("#f_"+id).modal("hide");
					$("#ff_"+id).modal("hide");
					}
				
				}
		});     
 

}

 

function save_profile(id){
	 blok("area_"+id);
	var link = $("#"+id).attr("url");
    $('#'+id).ajaxForm({
	 url:link,
     data: $('#'+id).serialize(),
	 method:"POST",
	 dataType: "JSON",
	 beforeSend: function() {
               loading("area_"+id);
            },
     success: function(data)
            {
					
			
				if(data["validasi"]==true){
				    //berhasil_disimpan();
				    location.reload();
				}else if(data["password"]==false){
				    alertify.error("<span class='sadow white'><b>Gagal!</b><br>Silahkan cari user /password lain.</span>");
				 }else if(data["file"]==false){
				    alertify.error("<span class='sadow white'><b>Gagal!</b><br>Silahkan gunakan file gambar (jpg).</span>");
				 }else if(data["size"]==false){
				    alertify.error("<span class='sadow white'><b>Gagal!</b><br>Maksimum upload gambar 3 Mb.</span>");
				 }
				 
				 unblock("area_"+id); 	
            }
           
    });  
    	 
}

 
