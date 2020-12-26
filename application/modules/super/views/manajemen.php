			
				<div class="panel-header" style="background: rgb(104,147,179);
background: -moz-linear-gradient(90deg, rgba(104,147,179,1) 0%, rgba(76,119,151,1) 100%);
background: -webkit-linear-gradient(90deg, rgba(104,147,179,1) 0%, rgba(76,119,151,1) 100%);
background: linear-gradient(90deg, rgba(104,147,179,1) 0%, rgba(76,119,151,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#6893b3',endColorstr='#4c7797',GradientType=1);">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">User Group</h2>
								<h5 class="text-white op-7 mb-2">Manage level user</h5>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<a href="javascript:input()" class="btn btn-white btn-round">Add Group</a>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div id="area_lod" class="row mt--2">
					<?php
					$n=1;
					foreach($dataGroup as $data)
					{
					?>
					<div class="col-md-4 col-sm-6">
						<div class="card card-stats card-round">
							<div class="card-body">
								<div class="user-profile text-center">
									<div class="name mt-2"><h4 class="mb-1 fw-bold"><?php echo strtoupper($data->levelname); ?></h4></div>
									<div class="job">Direct : <?php echo $data->direct; ?></div>
									<div class="desc mb-2">Ket : <?php echo $data->ket; ?></div>
									
								</div>
							</div>
							<div class="card-footer">
								<div class="row user-stats text-center">
								<div class="col-sm-4 col-xs-4 border-right">
									<div class="description-block">
										<a href="<?php echo base_url()."super/menu/".$data->id_level;?>" class="menuclick">
										<span class="description-text">Menu</span>
										</a>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-4 col-xs-4 border-right">
									<div class="description-block">
										<a onclick="edit(<?php echo $data->id_level; ?>)" href="javascript:void(0);">
										<span class="description-text">Edit</span>
										</a>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-4 col-xs-4">
									<div class="description-block">
									<a onclick="del(<?php echo $data->id_level; ?>,'<?php echo strtoupper($data->levelname); ?>')" href="javascript:void(0);">
										<span class="description-text">Delete</span>
									</a>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								</div>
								<!-- /.row -->
							</div>
						</div>
					</div>
					<?php } ?>
					
						<!--div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-user-2 text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Level User</p>
												<h4 class="card-title"></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div-->
						
					</div>
				</div>





<script>
function input()
{ 
	$("#title_mdl_input").html("INPUT DATA");
	$("#mdl_formSubmit_input").modal({backdrop: 'static', keyboard: false});
	$("#add_page").html('<center>Please wait..</center>');
	$("#formSubmit_input").attr("url","<?php echo base_url("super/insert_UG");?>");
	$.post("<?php echo site_url("super/input_UG"); ?>",function(data){
		$("#add_page").html(data);
		$("#formSubmit_input")[0].reset();
	});
}
function edit(id)
{	
	$("#title_mdl_edit").html("EDIT DATA");
    $("#mdl_formSubmit_edit").modal({backdrop: 'static', keyboard: false});
	$("#edit_page").html('<center>Please wait..</center>');
	$("#formSubmit_edit").attr("url","<?php echo base_url("super/update_UG");?>");
	$.post("<?php echo site_url("super/edit_UG"); ?>",{id:id},function(data){
		$("#edit_page").html(data);
	});
}
function del(id,name){
   alertify.confirm("Delete","<center>Delete data : <b>`"+name+"`</b> ?</center>",function(){
	$.post("<?php echo site_url("super/delete_UG"); ?>",{id:id},function(){
	    alert("Successfully deleted permanently");
		reload_content();
	  })
   }, function(){ });
}
</script>




<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_input">
<div class="modal-dialog" id="area_formSubmit_input">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_input">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodal">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_input" action="javascript:submitForm('formSubmit_input')" method="post">
	<div class="modal-body">
			<div id="add_page"></div>
	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" class="btn btn-default" data-dismiss="modal" id="closemodal">Close</button>
	  <button  title="Save" id="submit" onclick="submitForm('formSubmit_input')" class="btn btn-primary"><i id="msg_formSubmit_input"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_edit">
<div class="modal-dialog" id="area_formSubmit_edit">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_edit">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodal">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_edit" action="javascript:submitForm('formSubmit_edit')" method="post">
	<div class="modal-body">
		
			<div id="edit_page"></div>

	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" class="btn btn-default" data-dismiss="modal" id="closemodal">Close</button>
	  <button  title="Save" id="submit" onclick="submitForm('formSubmit_edit')" class="btn btn-primary"><i id="msg_formSubmit_edit"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
$('#closemodal').click(function() {
    $('#modalwindow').modal('hide');
});
</script>




