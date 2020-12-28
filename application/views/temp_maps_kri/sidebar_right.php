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
	<!--div class="sidebar-wrapper scrollbar scrollbar-inner"-->
		<div class="sidebar-content p-3">
			<a href="#" class="pull-right text-muted">
				<i class="flaticon-cross"></i>
			</a>
			<h4>SIDEBAR RIGHT</h4>
			<div class="row">
				
					
			
			</div>	

		</div>
	<!--/div-->
</div>
<!-- End Sidebar -->


