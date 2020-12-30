function submitFormRefresh(id)
{		
		var form = $("#"+id);
		var link = $(form).attr("url");
		$(form).ajaxForm({
		 url:link,
		 data: $(form).serialize(),
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
			$('#area_lod').addClass('loading_area');
		    $('#msg_'+id+'').addClass('fa fa-spinner fa-spin');
		},
		 success: function(data)
				{ 	
					$('#area_lod').removeClass('loading_area');
					$('#msg_'+id+'').removeClass('fa fa-spinner fa-spin');
					if(data["gagal"]==false)
					{	  
						toastr['warning'](data["info"]);
					}else{
						//$("#"+id)[0].reset();
						window.location.reload();
						reload_content();
						toastr['success']("Successfully Saved");
					} 		 
				}		
		}); 
	
}; 
 
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
					if(data["gagal"]==false)
					{	  
							notif(data["info"]);
					}else if(data["import_data"]==true)
					{
						$("#"+id)[0].reset();
						  $("#mdl_"+id).modal("hide"); 
						  reload_table();
						notif_success("<span class='sadow white'><div class='demo-google-material-icon'> <i class='material-icons'>done_all</i> <span class='icon-name'>Berhasil disimpan</span><br> - Ditambahkan "+data['data_insert']+" data<br> - Diperbaharui "+data['data_edit']+" data</div></span>");
					 		
						$("#mdl_"+id).modal("hide");
					}else{
					  $("#"+id)[0].reset();
					  $("#mdl_"+id).modal("hide"); 
					  reload_table();
					  berhasil_disimpan();
					 		
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
		    $('#area_lod').addClass('loading_area');
		    $('#msg_'+id+'').addClass('fa fa-spinner fa-spin');
		},
		 success: function(data)
				{ 	  
					$('#area_lod').removeClass('loading_area');
					$('#msg_'+id+'').removeClass('fa fa-spinner fa-spin');
					if(data["gagal"]==false)
					{	  
						toastr['warning'](data["info"]);
					}else if(data["table"]==true)
					{	  
						$("#"+id)[0].reset();
						$("#mdl_"+id).modal("hide");
						toastr['success']("Successfully Saved");
						reload_table();
					}else if(data["validasi_upload"]==true)
					{	  
						notif(data["info"]);
						$("#"+id)[0].reset();
						$("#mdl_"+id).modal("hide"); 
					}else if(data["import_data"]==true)
					{
						$("#"+id)[0].reset();
						$("#mdl_"+id).modal("hide");
						reload_table();
						toastr['success']("<span class='sadow white'> <i class='fas fa-check'></i> <span class='icon-name'>Berhasil disimpan</span><br> - Ditambahkan "+data['data_insert']+" data<br> - Diperbaharui "+data['data_edit']+" data</span>");
					}else{
						$("#"+id)[0].reset();
						toastr['success']("Successfully Saved");
						$("#mdl_"+id).modal('hide');
						$('body').removeClass('modal-open');
						$('body').removeAttr('style');
						$('.modal-backdrop').remove();
						reload_content();
						
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
			$('#area_lod').addClass('loading_area');
		    $('#msg_'+id+'').addClass('fa fa-spinner fa-spin');
        },
		 success: function(data)
				{ 	  
					$('#area_lod').removeClass('loading_area');
					$('#msg_'+id+'').removeClass('fa fa-spinner fa-spin');
					if(data["gagal"]==false)
					{	  
						toastr['warning'](data["info"]);
					}else if(data["import_data"]==true){
						toastr['success']("<span class='sadow white'><div class='demo-google-material-icon'> <i class='material-icons'>done_all</i> <span class='icon-name'>Berhasil disimpan</span><br> - Ditambahkan "+data['data_insert']+" data<br> - Diperbaharui "+data['data_edit']+" data</div></span>");
						reload_table();
						//$("[name='f[nama]']").val("");
					}else{
						//reload_content();
						//reload_table();
						//$("[name='f[nama]']").val("");
						toastr['success']("Successfully Saved");
					}
					 			
				}
		});     
};

/*
function submitFmaps(id)
{		
		var form = $("#"+id);
		var link = $(form).attr("url");
		$(form).ajaxForm({
		 url:link,
		 data: $(form).serialize(),
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
		    $('#area_lod').addClass('loading_area');
		    $('#msg_'+id+'').addClass('fa fa-spinner fa-spin');
		},
		 success: function(data)
				{ 	  
					$('#area_lod').removeClass('loading_area');
					$('#msg_'+id+'').removeClass('fa fa-spinner fa-spin');
					if(data["gagal"]==false)
					{	  
						toastr['warning'](data["info"]);
					}else if(data["table"]==true)
					{	  
						$("#"+id)[0].reset();
						$("#mdl_"+id).modal("hide");
						toastr['success']("Successfully Saved");
						reload_table();
					}else{
						$("#"+id)[0].reset();
						toastr['success']("Successfully Saved");
						reload_content();
						$("#mdl_"+id).modal('hide');
						$('body').removeClass('modal-open');
						$('.modal-backdrop').remove();
					} 		 
				}		
		}); 
	
};
*/




 
