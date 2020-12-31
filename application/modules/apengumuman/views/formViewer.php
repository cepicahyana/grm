
<?php 
$id=isset($data->id)?($data->id):'';
$img=isset($data->img)?($data->img):'';	
$judul=isset($data->judul)?($data->judul):'';			
$isi=isset($data->isi)?($data->isi):'';	
$sts=isset($data->sts)?($data->sts):'';	
$viewer=isset($data->viewer)?($data->viewer):'0';


?>

<div class="row">
	<div class="col-md-12">
		<div class="form-group row">
			<label class="black col-md-2 control-label">Judul</label>
			<div class="col-md-10">
				<?php echo $judul ?>
			</div>
		</div>
		<hr>
	</div>
	<div class="col-md-12">
		<table class="tborder" style="width:100%">
			<tr>
				<th class="text-center" style="width:5px">NO</th>
				<th class="text-center">KRI</th>
				<th class="text-center">STATUS</th>
			</tr>
			<?php 
			$no=1;
			$db=$this->db->get('data_kri')->result();
			foreach($db as $list){
				$idd=isset($list->id)?($list->id):'';
				$p=isset($list->profilename)?($list->profilename):'';
				$sr='<span class="text-danger">No</span>';
	
				if (strpos($viewer, $idd.",") !== false) {
					$sr='<span class="text-success">Read</span>';
				}
				
			?>
			<tr>
				<td class="text-center"><?php echo $no++;?></td>
				<td class="text-center"><?php echo $p?></td>
				<td class="text-center"><?php echo $sr?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>
			
			
	

	