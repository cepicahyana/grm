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
			<div class="logo-header" data-background-color="white" >
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
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="" style="background:#4C7797;">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">16</span>
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

						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-envelope"></i>
							</a>
							<ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
								<li>
									<div class="dropdown-title d-flex justify-content-between align-items-center">
										Messages 									
										<a href="#" class="small">Mark all as read</a>
									</div>
								</li>
								<li>
									<div class="message-notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="#">
												<div class="notif-img"> 
													<img src="<?php echo base_url(); ?>theme/atlantis/img/chadengle.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Chad</span>
													<span class="block">
														Ok, Thanks !
													</span>
													<span class="time">12 minutes ago</span> 
												</div>
											</a>											
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						
						<!--li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
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
													<div class="avatar-item bg-danger rounded-circle">
														<i class="far fa-calendar-alt"></i>
													</div>
													<span class="text">Calendar</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<div class="avatar-item bg-warning rounded-circle">
														<i class="fas fa-map"></i>
													</div>
													<span class="text">Maps</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<div class="avatar-item bg-info rounded-circle">
														<i class="fas fa-file-excel"></i>
													</div>
													<span class="text">Reports</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<div class="avatar-item bg-success rounded-circle">
														<i class="fas fa-envelope"></i>
													</div>
													<span class="text">Emails</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<div class="avatar-item bg-primary rounded-circle">
														<i class="fas fa-file-invoice-dollar"></i>
													</div>
													<span class="text">Invoice</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<div class="avatar-item bg-secondary rounded-circle">
														<i class="fas fa-credit-card"></i>
													</div>
													<span class="text">Payments</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li-->
						<li class="nav-item">
							<a href="<?php echo site_url('pengumuman')?>" class="nav-link menuclick">
								<i class="fas fa-bullhorn"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<?php $img2=$profileimg;
							if($img2!=''){
							$img_2=''.base_url().'theme/images/user/'.$img2.'';
							}else{
							$img_2=''.base_url().'theme/images/user/img_not.png';
							}
							?>
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
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

   
  
  
  
  

	
	
	
	
     
	
	