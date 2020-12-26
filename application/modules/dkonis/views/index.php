					<div class="row">
						<div class="col-12">
							<div class="row align-items-center mb-3">
								<div class="col">
									<!--h6 class="page-pretitle">
										Kondisi
									</h6>
									<h4 class="page-title">BAIK</h4>-->
								</div>
								<div class="col-auto">
									<a href="javascript:history()" class="btn btn-light btn-border btn-sm">
										<i class="fas fa-clock"></i> History
									</a>
									<a href="javascript:import_data()" class="btn btn-primary btn-sm">
										<i class="fas fa-download"></i> Import Data
									</a>
								</div>
							</div>

							<div id="area_import" class="row">
								<div class="col-md-12">

									<div class="card">
										<div class="card-header" style="padding:2px 8px 2px 2px">
											<div class="row align-items-center">
												<div class="col">
													<p class="mt-1 ml-2 text-muted">
														FORM IMPORT</p>
												</div>
												<div class="col-auto">
													<a href="javascript:cancel_area_import()" class="btn btn-light btn-border btn-sm">
														Cancel
													</a>
												</div>
											</div>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
												<form class="form-horizontal" id="formSubmitImport" action="javascript:submitForm('formSubmitImport')" method="post" >
													<div class="form-group row">
														<label class="black col-md-3 control-label">Download Data Terakhir</label>
														<div class="col-md-9">
														<a class="sound" href="<?php echo base_url('doc/data_konis.xlsx')?>">Data_konis.xlsx</a>
														</div>
													</div>
													<div class="form-group row">
														<label class="black col-md-3 control-label">Cari File</label>
														<div class="col-md-6">
															<input type="file" accept="xlsx" class="form-control input-sm" name="file" required/>
														</div>
														<div class="col-md-3">
															<button  title="Save" id="formSubmitImport" onclick="submitForm('formSubmitImport')" class="btn btn-sm btn-primary"><i id="msg_formSubmitImport"></i>&nbsp;&nbsp;<i class='fa fa-upload'></i> Upload</button>
														</div>
													</div>
												</form>
												</div>
											</div>

										</div>
									</div>

								</div>
							</div>
				
							<div class="row">
								<div class="col-md-12">
								<div id="area_lod">
									<div class="card">
										<div class="card-body">
										
											
											<div class="row">
												<div class="col-md-4 info-invoice">
													<h5 class="sub">Update Terakhir</h5>
													<p>18/12/2020 10:15</p>
												</div>
												<div class="col-md-4 info-invoice">
													<h5 class="sub">Nilai rata-rata</h5>
													<p>80</p>
												</div>
												<div class="col-md-4 info-invoice">
													<h5 class="sub">Kondisi</h5>
													<p class="fw-bold">BAIK</p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="separator-solid  mb-3"></div>
													<div class="invoice-detail">
														<div class="invoice-top">
															<h3 class="title"><strong>Details</strong></h3>
														</div>
														<div class="invoice-item">
															<div class="tborder">
																<table>
																	<thead>
																		<tr>
																			<th class="text-center" style="width:10%"><strong>No</strong></tthd>
																			<th class="text-center" style="width:60%"><strong>Nama Peralatan</strong></td>
																			<th class="text-center" style="width:20%"><strong>Keterangan</strong></th>
																			<th class="text-center" style="width:30%"><strong>Nilai (%)</strong></th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td class="text-center">1</td>
																			<td class="text-center">Pistol</td>
																			<td class="text-center">baru</td>
																			<td class="text-right">80</td>
																		</tr>
																		<tr>
																			<td class="text-center">2</td>
																			<td class="text-center">Granat</td>
																			<td class="text-center">baru</td>
																			<td class="text-right">80</td>
																		</tr>
																		<tr>
																			<td class="text-right" colspan="3"><strong>Total</strong></td>
																			<td class="text-right"><strong>160</strong></td>
																		</tr>
																		<tr>
																			<td class="text-right" colspan="3"><strong>Nilai rata-rata</strong></td>
																			<td class="text-right"><strong>80</strong></td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>	
													<div class="separator-solid  mb-3"></div>
													<h6 class="text-uppercase mt-4 mb-3 fw-bold">
														*Notes
													</h6>
													<p class="text-muted text-sm mb-0">
														Nilai 0-60 (TIDAK SIAP)<br>
														Nilai 60-80 (SIAP TERBATAS)<br>
														Nilai 80-100 (SIAP)
													</p>
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
function history()
{ 
	$("#area_lod").html('<center>Please wait..</center>');
	$.post("<?php echo site_url("dkonis/history"); ?>",function(data){
		$("#area_lod").html(data);
	});	
}
function back(){
	$("#area_lod").html('<center>Please wait..</center>');
	$.post("<?php echo site_url("dkonis/page_index"); ?>",function(data){
		$("#area_lod").html(data);
	});	
}

function import_data() 
{ 	
    $("#formSubmitImport")[0].reset();
	$("#area_import").show();
	$("#formSubmitImport").attr("url","<?php echo base_url()?>dbrigif/import_data");
}
function cancel_area_import() 
{ 	
    $("#formSubmitImport")[0].reset();
	$("#area_import").hide();
}

</script>
	
	
<script>
  $(function (){
	$("#area_import").hide();
	/*$('.select2').select2({
      theme: 'bootstrap'
    });
	$('[data-mask]').inputmask();
	$(".tanggal_mulai").on("change keyup paste keypress", function(data){
		var tgl_1 = $(this).val();
		var tgl_2 = $(".tanggal_selesai").val();
		durasiBln(tgl_1,tgl_2);
	});*/
  })
</script>


<!-- modal --
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
   /.modal-content --
</div>
/.modal-dialog --
</div>
 /.modal -->


