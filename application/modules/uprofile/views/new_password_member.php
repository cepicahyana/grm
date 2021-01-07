<input type="hidden" value="n" id="modaltype">
					<div id="area_lod" class="row">
						<div class="col-md-12">
							<div class="card">
							<form class="form-horizontal" id="formSubmit_edit" action="javascript:submitFormRefresh('formSubmit_edit')" method="post">

								<div class="card-body">
									<div class="form-group row">
										<label class="black col-md-3 control-label">Current Password</label>
										<div class="col-md-8">
											<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-key"></i></span>
											</div>
											<input type="password" id="passold" name="passold" class="form-control" />
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="black col-md-3 control-label">New Password</label>
										<div class="col-md-8">
											<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-key"></i></span>
											</div>
											<input type="password" id="passnew" name="passnew" class="form-control" />
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="black col-md-3 control-label">Re-type New Password</label>
										<div class="col-md-8">
											<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-key"></i></span>
											</div>
											<input type="password" id="retpass" name="retpass" class="form-control" />
											</div>
										</div>
									</div>
									
								</div>
								<div class="card-footer">
									<div class="row">
										<div class="col-12">
											<div class="text-right mt-3 mb-3">
											<button  title="Save" id="submit" onclick="submitFormRefresh('formSubmit_edit')" class="btn btn-primary"><i id="msg_formSubmit_edit"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
											<!--button class="btn btn-danger">Reset</button-->
											</div>
										</div>
									</div>
								</div>
							</form>
							</div>
						</div>
						
					</div>
				
	
  

<script>
  $(function () {
	$("#formSubmit_edit").attr("url","<?php echo base_url("uprofile/update_Password");?>");
  });
</script>			
