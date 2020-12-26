<!--?php $con=new konfig(); ?-->
<?php 
$levelsession=$this->session->userdata("level");
$idsession=$this->session->userdata("id");
$dprofile=$this->m_konfig->dataProfile($idsession);
$dlevel=$this->m_konfig->dataLevel($levelsession);
if($levelsession=='1' || $levelsession=='2'){
  $profilename=isset($dprofile->profilename)?($dprofile->profilename):'';
  $levelname=isset($dlevel->levelname)?($dlevel->levelname):'';
	$profileimg=isset($dprofile->profileimg)?($dprofile->profileimg):'';
}elseif($levelsession=='3'){
	$profilename=isset($dprofile->profilename)?($dprofile->profilename):'';
  $levelname=isset($dlevel->levelname)?($dlevel->levelname):'';
	$profileimg=isset($dprofile->profileimg)?($dprofile->profileimg):'';
}
?>   

		<!-- Sidebar -->
		<div class="sidebar-maps-left sidebar-left">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content" style="padding:10px">
					
					<table style="width:100%;">
					<tr valign="top">
						<td><img style="width:95%;margin:0 auto;" class='card-img-top rounded' src='<?php echo base_url() ?>theme/images/data/filekri_09122020211152.jpg'></td>
						<td><button class='btn btn-primary btn-block btn-sm'>KONIS</button>
							<button class='btn btn-primary btn-block btn-sm'>KONLOG</button>
							<button class='btn btn-primary btn-block btn-sm'>KONPERS</button></td>
					</tr>
					<tr>
						<td colspan="2" class="text-center">
							<h4 class="mt-2 fw-bold z">USH-359</h4>
							<p class="mt--2" style="font-size:12px">Lat -5.005893238065995, <br> Long 111.79301164548704 </p>
						</td>
					</tr>
					</table>

					<table style="width:100%;">
					<tr valign="top">
						<td><button class='btn btn-black btn-block btn-sm'>RADAR</button>
							<button class='btn btn-black btn-block btn-sm'>AIS</button>
							<button class='btn btn-black btn-block btn-sm'>CAMERA</button></td>
						<td style="padding-left:4px;padding-right:4px;"><button class='btn btn-secondary btn-block btn-sm' onclick='history_track_kri(".$id.")'>HISTORY</button>
							<button class='btn btn-secondary btn-block btn-sm'>COVERAGE</button></td>
						<td><button class='btn btn-success btn-block btn-sm'>CHAT</button>
							<button class='btn btn-success btn-block btn-sm'>VICALL</button>
							<button class='btn btn-success btn-block btn-sm'>VOIP</button>
							<button class='btn btn-success btn-block btn-sm'>ROIP</button></td>
					</tr>
					
					</table>
						
				
						
						

			
				</div>
			</div>
		</div>
		<!-- End Sidebar -->