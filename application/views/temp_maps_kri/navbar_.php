<?php 
$levelsession=$this->session->userdata("level");
$idsession=$this->session->userdata("id");
$dprofile=$this->m_konfig->dataProfile($idsession,$levelsession);
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
$headername=$this->m_konfig->konfigurasi(14);
?>		



		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="white">
				<?php $img1=$this->m_konfig->konfigurasi(4);
				if($img1!=''){
				$img_1=''.base_url().'theme/images/'.$img1.'';
				}else{
				$img_1='';
				}
				?>
				<a href="#" class="logo ml-auto mr-auto text-white">
					<img src="<?php echo $img_1; ?>" alt="<?php echo $headername; ?>" class="navbar-brand" style="max-width:120px">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="" style="background:#4C7797;">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" onclick="open_notif()" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">1</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have 1 new notification</div>
								</li>
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="#">
												<div class="notif-icon notif-primary"> <i class="fa fa-edit"></i> </div>
												<div class="notif-content">
													<span class="block">
														Update Konlog now
													</span>
													<span class="time">5 minutes ago</span> 
												</div>
											</a>
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>

						
						<li class="nav-item">
							<a href="#" class="nav-link menuclick" url="<?php echo site_url('pengumuman')?>" title="PENGUMUMAN">
								<i class="fa fa-bullhorn"></i><span class="notification"><span class="amount_a"></span></span>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link quick" data-toggle="dropdown" href="#" onclick="open_quick()" aria-expanded="false">
								<i class="fas fa-grip-horizontal"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Quick Actions</span>
									<span class="subtitle op-8">Shortcuts</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<div class="avatar-item bg-warning rounded-circle">
														<i class="fas fa-video"></i>
													</div>
													<span class="text">Vicall</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<div class="avatar-item bg-info rounded-circle">
														<i class="fas fa-phone-volume"></i>
													</div>
													<span class="text">Voip</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<div class="avatar-item bg-black rounded-circle">
														<i class="fas fa-memory"></i>
													</div>
													<span class="text">Roip</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a href="#" onclick="sidebar_right()" class="nav-link">
								<i class="fa fa-calendar"></i>
							</a>
						</li>				
						<li class="nav-item">
							<a href="#" class="nav-link quick-sidebar-toggler">
								<i class="fa fa-comments"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fa fa-user"></i>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
									<a class="dropdown-item menuclick" url="<?php echo site_url('profile')?>" title="PROFILE" href="#">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item menuclick" url="<?php echo site_url('profile/new_password')?>" title="PROFILE" href="#">New Password</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?php echo site_url('login/logout')?>">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>


  
  
  
  

	
	
	
	
     
	
	