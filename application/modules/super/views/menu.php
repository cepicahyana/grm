<?php $uri=$this->uri->segment(3); ?>

				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Menu</h4>
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
								<a href="#">Menu</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex justify-content-between">
										<div class="d-md-inline-block">
										<h4 class="card-title">Menu</h4>
										</div>
										<div class="d-none d-sm-inline-block">
										<a href="javascript:input()" class="btn btn-primary">
											<i class="fa fa-plus-circle fa-lg"></i> Add Menu
										</a>
										<a href="<?php echo site_url('super/manajemen')?>" class="menuclick btn btn-primary btn-border">
											<i class="fa fa-chevron-left fa-lg"></i> Back
										</a>
										</div>
									</div>
								</div>

								<div class="card-body">
									
									<div id="area_lod">
									<h5 class="mb-4">Manajemen Menu Level <?php echo $Menu ?></h5>
									<div id="area_lod">
									<div class="row" >
										<div class="col-md-9">
										<ul class="list-group">
										<?php  
										foreach($dataMenu as $level1)
										{
										?>
											<?php if($level1->level==1 && $level1->dropdown=='no'){?>
												<li class="list-group-item d-flex justify-content-between align-items-center">
													<div class="pull-left">
													<span class="btn-sm btn-info mr-3">
														<i class="<?php echo $level1->icon;?>"></i>
													</span>
													<?php echo "[".$level1->id_menu."] ".$level1->nama;?>
													</div>
													<div class="pull-right">
													<a href="javascript:void(0);" onclick="edit(<?php echo $level1->id_menu;?>)" class="btn btn-sm btn-primary btn-border"><i class="fa fa-edit"></i></a>
													
													<a href="javascript:void(0);" onclick="del(<?php echo $level1->id_menu;?>,'<?php echo $level1->nama;?>')" class="btn btn-sm btn-danger btn-border"><i class="fa fa-trash"></i></a>
													</div>
												</li>

											<?php }elseif($level1->level==1 && $level1->dropdown=='yes'){ ?>
												<li class="list-group-item d-flex justify-content-between align-items-center">
													<div class="pull-left">
													<span class="btn-sm btn-info mr-3">
														<i class="<?php echo $level1->icon;?>"></i>
													</span>
													<?php echo "[".$level1->id_menu."] ".$level1->nama;?>
													</div>
													<div class="pull-right">
													<a href="javascript:void(0);" onclick="edit(<?php echo $level1->id_menu;?>)" class="btn btn-sm btn-primary btn-border"><i class="fa fa-edit"></i></a>
													
													<a href="javascript:void(0);" onclick="del(<?php echo $level1->id_menu;?>,'<?php echo $level1->nama;?>','<?php echo $level1->level;?>')" class="btn btn-sm btn-danger btn-border"><i class="fa fa-trash"></i></a>
													</div>
												</li>
												
												
													<ul>
													<?php
													$uri=$this->uri->segment(3);
													$this->db->order_by("id_menu","ASC");
													$this->db->where("hak_akses",$uri);
													$menu2=$this->db->get_where("main_menu",array("level"=>2,"id_main"=>$level1->id_menu));
													foreach($menu2->result() as $level2){
													?>

													<li class="ml-3 list-group-item d-flex justify-content-between align-items-center">
													<div class="pull-left">
													<!--span class="stamp stamp-md mr-3">
														<i class="<.?php echo $level2->icon;?>"></i>
													</span-->
													<?php echo "[".$level2->id_menu."] ".$level2->nama;?>
													</div>
													<div class="pull-right">
													<a href="javascript:void(0);" onclick="edit(<?php echo $level2->id_menu;?>)" class="btn btn-sm btn-primary btn-border"><i class="fa fa-edit"></i></a>
													
													<a href="javascript:void(0);" onclick="del(<?php echo $level2->id_menu;?>,'<?php echo $level2->nama;?>','<?php echo $level2->level;?>')" class="btn btn-sm btn-danger btn-border"><i class="fa fa-trash"></i></a>
													</div>
													</li>

													<?php } ?>	
													</ul>	
												</li>	
											<?php } ?>	
										<?php }; ?>
										</ul>

										
										</div>
									</div>
									</div>

									</div>
								
								</div>
		
							</div>
						</div>
						
					</div>
				</div>



<script>
function input()
{ 
	var uri = '<?php echo $uri ?>';
	$("#title_mdl_input").html("INPUT DATA");
	$("#mdl_formSubmit_input").modal({backdrop: 'static', keyboard: false});
	$("#add_page").html('<center>Please wait..</center>');
	$("#formSubmit_input").attr("url","<?php echo base_url("super/insert_Menu");?>");
	$.post("<?php echo site_url("super/input_Menu"); ?>",{uri:uri},function(data){
		$("#add_page").html(data);
		$("#formSubmit_input")[0].reset();
		$(".menuInduk").hide();
	});
}
function edit(id)
{	
	$("#title_mdl_edit").html("EDIT DATA");
    $("#mdl_formSubmit_edit").modal({backdrop: 'static', keyboard: false});
	$("#edit_page").html('<center>Please wait..</center>');
	$("#formSubmit_edit").attr("url","<?php echo base_url("super/update_Menu");?>");
	$.post("<?php echo site_url("super/edit_Menu"); ?>",{id:id},function(data){
		$("#edit_page").html(data);
	});
}
function del(id,name,level){
   alertify.confirm("Delete","<center>Delete data : <b>`"+name+"`</b> ?</center>",function(){
	$.post("<?php echo site_url("super/delete_Menu"); ?>",{id:id,level:level},function(){
	    toastr['success']("Successfully deleted permanently");
		reload_content();
	  })
   }, function(){ });
}

function radioLevel(id,val)
{
	if(id!=1)
	{
		$(".menuInduk").show();
	}else{
		$("#Induk").val('');
		$(".menuInduk").hide();
	}
}
</script>


<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_input">
<div class="modal-dialog" id="area_formSubmit_input">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_input">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_input" action="javascript:submitForm('formSubmit_input')" method="post">
	<div class="modal-body">
		<div id="add_page"></div>
	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_edit" action="javascript:submitForm('formSubmit_edit')" method="post">
	<div class="modal-body">
		<div id="edit_page"></div>
	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button  title="Save" id="submit" onclick="submitForm('formSubmit_edit')" class="btn btn-primary"><i id="msg_formSubmit_edit"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


