
<?php 
$id=isset($data->id)?($data->id):'';
$lat=isset($data->lat)?($data->lat):'';
//$gender=isset($data->gender)?($data->gender):'';
$imgdata=isset($data->imgdata)?($data->imgdata):'';	
$namadata=isset($data->namadata)?($data->namadata):'';
//$wa=isset($data->wa)?($data->wa):'';	
$descdata=isset($data->descdata)?($data->descdata):'';
$lng=isset($data->lng)?($data->lng):'';
//$sts=isset($data->sts_aktif)?($data->sts_aktif):'';			
?>

<div class="row">
	<div class="col-md-4">
	<?php 
		if($imgdata!=''){
			$img_1=''.base_url().'theme/images/data/'.$imgdata.'';
		}else{
			$img_1=''.base_url().'theme/images/no-image.png';
		} 
	?>
	
	<img class="card-img-top rounded" src="<?php echo $img_1?>" class="img-fluid">
	
	</div>
	<div class="col-md-8">
			<div class="form-group row">
				<label class="black col-md-3 control-label">Nama</label>
				<div class="col-md-9">
					<?php echo $namadata ?>
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Deskripsi</label>
				<div class="col-md-9">
				<?php echo $descdata ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Latitude</label>
				<div class="col-md-9">
				<?php echo $lat ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Longitude</label>
				<div class="col-md-9">
				<?php echo $lng ?>
				</div>
			</div>

		
	</div>
</div>
			
			
	

	