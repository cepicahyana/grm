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

		
		<div class="main-header" >
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="" style="background:#4C7797;">
				<?php $img1=$this->m_konfig->konfigurasi(4);
				if($img1!=''){
				$img_1=''.base_url().'theme/images/'.$img1.'';
				}else{
				$img_1='';
				}
				?>
				<a href="#" class="logo text-white">
					<img src="<?php echo $img_1; ?>" alt="<?php echo $headername; ?>" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle sidenav-overlay-toggler">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->



			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="" style="background:#4C7797;">
				
				<div class="container-fluid">
					<!--div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div-->
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<!--li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li-->
						
						<!--li class="nav-item">
							<a href="#" onclick="showPolyline()" class="nav-link" title="Update tracking KRI">
								<i class="fas fa-map-marker-alt"></i>
							</a>
						</li-->
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link"  data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification bg-danger">16</span>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn" style="width:400px">
								<div class="quick-actions-header" style="background:#6893B3;">
									<span class="title mb-1">Notification</span>
									<!--span class="subtitle op-8">Shortcuts</span-->
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<div class="col-6 col-md-6 col-xs-12 p-2">
												<h5>SEGERA</h5>
												<ul class="list-group list-group-bordered list">
													<li class="list-group-item" style="padding:4px 8px;">
													<a href="#">
													<span style="font-size:12px;">Langgar Batas <span class="badge bg-danger text-white">2</span></span>
													</a>
													</li>
													<li class="list-group-item" style="padding:4px 8px;">
													<a href="#">
													<span style="font-size:12px;">Distress Signal <span class="badge bg-danger text-white">2</span></span>
													</a>
													</li>
													<li class="list-group-item" style="padding:4px 8px;">
													<a href="#">
													<span style="font-size:12px;">Input Signal SSAT <span class="badge bg-danger text-white">2</span></span>
													</a>
													</li>
												</ul>
											</div>
											<div class="col-6 col-md-6 col-xs-12 p-2">
											<h5>RAHASIA</h5>
												<ul class="list-group list-group-bordered list">
													<li class="list-group-item" style="padding:4px 8px;">
													<a href="#">
													<span style="font-size:12px;">Update Konis <span class="badge bg-danger text-white">2</span></span>
													</a>
													</li>
													<li class="list-group-item" style="padding:4px 8px;">
													<a href="#">
													<span style="font-size:12px;">Update Konlog <span class="badge bg-danger text-white">2</span></span>
													</a>
													</li>
													<li class="list-group-item" style="padding:4px 8px;">
													<a href="#">
													<span style="font-size:12px;">Update Konpers <!--span class="badge bg-danger text-white">9</span--></span>
													</a>
													</li>
												</ul>
												<ul class="list-group list-group-bordered list mt-2">
													<li class="list-group-item" style="padding:4px 8px;">
													<a href="#">
													<span style="font-size:12px;">Laporan Ilo <span class="badge bg-danger text-white">2</span></span>
													</a>
													</li>
													<li class="list-group-item" style="padding:4px 8px;">
													<a href="#">
													<span style="font-size:12px;">Laporan Staf Intel <span class="badge bg-danger text-white">2</span></span>
													</a>
													</li>
													<li class="list-group-item" style="padding:4px 8px;">
													<a href="#">
													<span style="font-size:12px;">Laporan Eksternal <span class="badge bg-danger text-white">2</span></span>
													</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url()?>dashboard" class="nav-link" title="Admin Dashboard">
								<i class="fas fa-tachometer-alt"></i>
							</a>
						</li>
						<li class="nav-item">
							<a href="javascript:sidebar_right()" class="nav-link" title="History KRI">
								<i class="fa fa-calendar"></i>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link quick-sidebar-toggler">
								<i class="fa fa-th"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<?php $img2=$profileimg;
								if($img2!=''){
								$img_2=''.base_url().'theme/images/user/'.$img2.'';
								}else{
								$img_2=''.base_url().'theme/images/user/img_not.png';
								}
								?>
								<div class="avatar-sm">
									<img src="<?php echo $img_2?>" alt="Avatar" class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="<?php echo $img_2?>" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
											<h4><?php echo $profilename; ?></h4>
											<p class="text-muted"><?php echo $levelname; ?></p>
											</div>
										</div>
									</li>
									<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?php echo site_url('profile')?>">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?php echo site_url('profile/new_password')?>">New Password</a>
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


  
  
  
  

	
	
	
	
     
	
	