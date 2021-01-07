	<div class="messages-contact" style="padding-left:10px">
							<div class="quick-wrapper">
								<div class="quick-scroll scrollbar-outer">
									<div class="quick-content contact-content">
									 
										<span class="category-title">Terbaru</span>
										<div class="contact-list contact-list-recent">
										<?php
										error_reporting(0);
										$db=$this->db->query("
										SELECT * FROM data_chat WHERE (id_receiver='".$this->mdl->idu()."'
										or id_sender='".$this->mdl->idu()."') 
										 ORDER BY tgl DESC
										limit 35")->result();
										$listnakal="__";
										foreach($db as $val){
											
											if($val->id_sender==$this->mdl->idu())
											{
												$id_sender=$val->id_receiver;
											}else{
												$id_sender=$val->id_sender;
											}
										$profileimg	=	$this->mdl->profileimg($id_sender);
										$img		=	 "theme/images/user/".$profileimg;
										if(!file_exists($img)  or !$profileimg){
										$img	=	base_url()."theme/images/user/img_not.png";
										}
										$nama_kapal = $this->mdl->nama_kapal($id_sender); 
										$sts=$this->mdl->stsAktif($id_sender);
										 if(strpos($listnakal,$nama_kapal)===FALSE){
										?> 
											<div class="user"  onclick="chat(``,`<?php echo $id_sender?>`,`<?php echo $nama_kapal?>`)">
												<a href="#">
													<div class="avatar avatar-<?php echo $sts;?>">
														<img src="<?php echo $img?> " alt="..." class="avatar-img rounded-circle border border-white">
													</div>
													<div class="user-data">
														<span class="name"><?php echo $nama_kapal;?></span>
														<span class="message"><?php echo $val->msg;?></span>
													</div>
												</a>
											</div>
										 <?php }
										$listnakal.=$nama_kapal;
										 } ?>	 
										</div>
										<span class="category-title">Kontak</span>
										<?php
										$db=$this->db->get_where("v_user",array("id_admin!="=>$this->mdl->idu()))->result();
										foreach($db as $val){
											$date = date("Y-m-d H:i:s");
											$DBdate = $val->set_aktif;
											$selisih = $this->tanggal->hitungMenit($DBdate,$date);
											if($selisih<3){
												$sts="online";
											}else{
												$sts="offline";
											}
											
										$profileimg	=	$this->mdl->profileimg($val->id_admin);
										$img		=	 "theme/images/user/".$profileimg;
										if(!file_exists($img) or !$profileimg){
										$img	=	base_url()."theme/images/user/img_not.png";
										}
										 
										?>
										<div class="contact-list">
											<div class="user"  onclick="chat(``,`<?php echo $val->id_admin?>`,`<?php echo $val->profilename?>`)">
												<a href="#">
													<div class="avatar avatar-<?php echo $sts;?>">
														<img src="<?php echo $img?> " alt="..." class="avatar-img rounded-circle border border-white">
													</div>
													<div class="user-data2">
														<span class="name"><?php echo $val->profilename;?></span>
														<span class="status"><?php echo $sts; ?></span>
													</div>
												</a>
											</div>
										<?php } ?>	 
											 
										</div>
									</div>
								</div>
							</div>
	 </div>