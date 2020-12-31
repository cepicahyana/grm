
<?php 
$id=isset($data->id)?($data->id):'';
$img=isset($data->img)?($data->img):'';	
$judul=isset($data->judul)?($data->judul):'';			
$isi=isset($data->isi)?($data->isi):'';	
$sts=isset($data->sts)?($data->sts):'';		
?>
<div class="row">
	<div class="col-6">
	<h4 class="card-title">Detail</h4>
	</div>
	<div class="col-6">
	<div class="float-right d-sm-inline-block">
	<a href="javascript:back()" class="btn btn-light btn-border btn-sm">
		Back
	</a>
	</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<?php 
			if($img!=''){
				$img_1=''.base_url().'theme/images/pengumuman/'.$img.'';
			}else{
				$img_1=''.base_url().'theme/images/no-image.png';
			} 
		?>
		
		<img class="card-img-top rounded img-responsive" src="<?php echo $img_1?>" class="img-fluid">
	</div>
</div>
<div class="row">
	<div class="col-md-12">
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
		
			
			
	

	