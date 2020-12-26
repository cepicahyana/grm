
<?php 
$id=isset($data->id_admin)?($data->id_admin):'';
$username=isset($data->username)?($data->username):'';
//$gender=isset($data->gender)?($data->gender):'';
$profileimg=isset($data->profileimg)?($data->profileimg):'';	
$profilename=isset($data->profilename)?($data->profilename):'';
//$wa=isset($data->wa)?($data->wa):'';	
$email=isset($data->email)?($data->email):'';
$level=isset($data->level)?($data->level):'';
$sts=isset($data->sts_aktif)?($data->sts_aktif):'';			
?>

<div class="row">
	<div class="col-md-4">
	<?php 
		if($profileimg!=''){
			$img_1=''.base_url().'theme/images/user/'.$profileimg.'';
		}else{
			$img_1=''.base_url().'theme/images/user/img_not.png';
		} 
	?>
	<a href="<?php echo $img_1?>" data-toggle="lightbox" data-title="<?php echo $profilename ?>" data-footer="<?php echo $profilename ?>">
		<img class="card-img-top rounded img-responsive img-thumbnail imageval" src="<?php echo $img_1?>" class="img-fluid">
	</a>
	</div>
	<div class="col-md-8">
		<div class="card-pricing mt--4">
		<ul class="specification-list">
			<li>
				<span class="name-specification">Nama KRI</span>
				<span class="status-specification"><?php echo $profilename ?></span>
			</li>
			<li>
				<span class="name-specification">Email KRI</span>
				<span class="status-specification"><?php echo $email ?></span>
			</li>
			<li>
				<span class="name-specification">Username</span>
				<span class="status-specification"><?php echo $username ?></span>
			</li>
			<li>
				<span class="name-specification">Status Akun</span>
				<span class="status-specification"><?php if($sts=='l'){echo 'Aktif';}else{echo 'Tidak Aktif';}?></span>
			</li>
		</ul>
		</div>
	</div>
</div>
			
			
	

	