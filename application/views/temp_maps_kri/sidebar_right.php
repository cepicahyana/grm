

<!-- Sidebar -->
<div class="sidebar-maps-right sidebar-right displaynone">
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content p-3">
			<div class="row">
				<div class="col-12">
				<h4 class="float-left">HISTORY KRI</h4>
				<a href="#" onclick="sidebar_right()" class="float-right close-quick-sidebar text-grey">
					<i class="flaticon-cross"></i>
				</a>
				</div>
			</div>
			<form id="formSubmit_History" action="javascript:history_range_kri('formSubmit_History')" method="post">
			<div class="form-group">
				<label>Tanggal awal</label>
				<div class="input-group">
					<input id="date_1" name="fdate_awal" type="text" class="form-control form-control-inline date_posting" value="<?php echo date('d/m/Y'); ?>">
					<div class="input-group-append">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Tanggal akhir</label>
				<div class="input-group">
					<input id="date_2" name="fdate_akhir" type="text" class="form-control form-control-inline date_posting" value="<?php echo date('d/m/Y'); ?>">
					<div class="input-group-append">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
			<button  title="Proses" id="submit"  class="btn btn-primary mt-2"><i id="msg_formSubmit_History"></i>&nbsp;&nbsp; Proses</button>
			<a href="javascript:void(0)" title="Reset" class="btn btn-light btn-border mt-2 ml-3" onclick="removeLine()"> Reset </a>
			</div>
			</form>										
		</div>
	</div>
</div>
<!-- End Sidebar -->
<script>

</script>
<script>
	var date = new Date();
	$('#date_1').daterangepicker({
		startDate: moment(date), 
		format: 'DD/MM/YYYY',	
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'),10)
	});
	$('#date_2').daterangepicker({
		startDate: moment(date), 
		format: 'DD/MM/YYYY',	
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'),10)
	});
	$('#basic').select2({
		theme: "bootstrap"
	});
</script>
