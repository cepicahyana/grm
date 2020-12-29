<!--?php $con=new konfig(); ?-->
<?php
$levelsession = $this->session->userdata("level");
$idsession = $this->session->userdata("id");
$dprofile = $this->m_konfig->dataProfile($idsession,$levelsession);
$dlevel = $this->m_konfig->dataLevel($levelsession);
if ($levelsession == '1' || $levelsession == '2') {
	$profilename = isset($dprofile->profilename) ? ($dprofile->profilename) : '';
	$levelname = isset($dlevel->levelname) ? ($dlevel->levelname) : '';
	$profileimg = isset($dprofile->profileimg) ? ($dprofile->profileimg) : '';
} elseif ($levelsession == '3') {
	$profilename = isset($dprofile->profilename) ? ($dprofile->profilename) : '';
	$levelname = isset($dlevel->levelname) ? ($dlevel->levelname) : '';
	$profileimg = isset($dprofile->profileimg) ? ($dprofile->profileimg) : '';
}
?>

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
				<label>Pilih KRI</label>
				<select id="basic" name="fkri" class="form-control" style="width:100%" required>
					<option value="">=== Choose ===</option>
					<?php 
					$db=$this->db->get_where("data_kri",array('level'=>3))->result();
					foreach($db as $val){
						echo "<option value='".$val->id."'>".$val->profilename."</option>";
					}
					?>
				</select>
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
