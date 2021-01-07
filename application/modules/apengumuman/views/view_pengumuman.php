<input type="hidden" value="n" id="modaltype">
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
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<h3 class="text-bold text-center">
				<?php echo $judul ?>
			</h3>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<?php 
					if($img!=''){
						$img_1='<a href="'.base_url().'theme/images/pengumuman/'.$img.'" download>
						<img style="vertical-align: text-top;" class="card-img-top rounded img-responsive" src="'.base_url().'theme/images/pengumuman/'.$img.'" class="img-fluid">
						</a>';
						
						
					}else{
						$img_1='<img style="vertical-align: text-top;" class="card-img-top rounded img-responsive" 
						src="'.base_url().'theme/images/no-image.png" class="img-fluid">';
					} 
				?>
				<?php echo $img_1 ?>
			</div>
			<div class="col-md-10  col-xs-12">
		
			<?php echo $isi ?>
			
			</div>
		</div>
	</div>
</div>


		
			
			
	

	