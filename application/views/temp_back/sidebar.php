<!--?php $con=new konfig(); ?-->
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
?>   

    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2" >			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
            <?php $img2=$profileimg;
            if($img2!=''){
              $img_2=''.base_url().'theme/images/user/'.$img2.'';
            }else{
              $img_2=''.base_url().'theme/images/user/img_not.png';
            }
            ?>
						<div class="avatar-sm float-left mr-2">
							<img src="<?php echo $img_2;?>" alt="Logo" class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a href="javascript:void(0)" aria-expanded="true">
								<span>
                  					<?php echo $profilename;?> 
									<span class="user-level"><?php echo $levelname;?></span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-primary">

<?php
$aktif="";
$uri1=$this->uri->segment(1);
$uri2=$this->uri->segment(2);
$uri=$uri1."/".$uri2;
	 
$this->db->where("hak_akses",$levelsession);
$this->db->order_by("id_menu","ASC");
$menu=$this->db->get_where("main_menu",array());

foreach($menu->result() as $level1)
{ 
	
$aktif=""; 
$sa="";
$sb="";
?>
	<?php
	$id_main1=$level1->id_main;
	$id_menu1=$level1->id_menu;
	?>
		
	<?php 
	$aktif="";
	$sa="";
	$sb=""; 
	/*if($level1->link==$uri1 || $level1->link==$uri){ 
		$aktif="active";
		$sa="submenu";
		$sb="show"; 
	}*/
	?>
	<?php if($level1->level==1 && $level1->dropdown=='no'){?>	
		
		<li class='nav-item <?php echo $level1->link ?> <?php echo $aktif; ?>' >
			<a class="menuclick" href="<?php echo base_url().$level1->link;?>" <?php if($level1->target=='newtab'){ echo "target='_blank'";}?> >
      		<i class="<?php echo $level1->icon;?>"></i>
			<p><?php echo $level1->nama;?></p>
			</a>
		</li>
	<?php } ?>
	
	<?php if($level1->level==1 && $level1->dropdown=='yes'){ ?>
		
		<li class='nav-item <?php echo $level1->link ?> <?php echo $sa; ?> <?php echo $aktif; ?>'>
			<a data-toggle="collapse" href="#nu<?php echo $id_menu1?>">
			<i class="<?php echo $level1->icon;?>"></i>
			<p><?php echo $level1->nama;?></p>
			<span class="caret"></span>
			</a>
			<div class="collapse <?php echo $level1->link ?> <?php echo $sb; ?>" id="nu<?php echo $id_menu1?>">
				<ul class="nav nav-collapse">
				<?php
				$this->db->where("hak_akses",$this->m_konfig->getIdUG($this->session->userdata("level")));
				$this->db->order_by("id_menu","ASC");
				$menu2=$this->db->get_where("main_menu",array("level"=>2,"id_main"=>$id_menu1));
				foreach($menu2->result() as $level2){
				?>
				<li class="nav-sub <?php echo $level2->link ?> <?php echo $sa; ?> <?php echo $aktif; ?>">
				<a style="padding-left:48px" class="menuclick" href="<?php echo base_url().$level2->link;?>" <?php if($level1->target=='newtab'){ echo "target='_blank'";}?>>
				<span class="sub-item"><?php echo $level2->nama;?></span>
				</a>
				</li>
				<?php } ?>	
				</ul>
			</div>
		</li>
	<?php }; ?>
	
<?php }; ?>


					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->