
<?php 
$id=isset($data->id)?($data->id):'';
$img=isset($data->img)?($data->img):'';	
$judul=isset($data->judul)?($data->judul):'';			
$isi=isset($data->isi)?($data->isi):'';	
$sts=isset($data->sts)?($data->sts):'';		
?>

<div class="row">
	<div class="col-md-5">
		<?php 
			if($img!=''){
				$img_1=''.base_url().'theme/images/pengumuman/'.$img.'';
			}else{
				$img_1=''.base_url().'theme/images/no-image.png';
			} 
		?>
		
		<img class="card-img-top rounded img-responsive" src="<?php echo $img_1?>" class="img-fluid">
	</div>
	<div class="col-md-7">
			<div class="form-group">
				<label class="black control-label">Judul</label>
				<div class="">
					<?php echo $judul ?>
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="black control-label">Isi</label>
				<div class="">
				<?php echo $isi ?>
				</div>
			</div>

		
	</div>
</div>
			
			
	

	