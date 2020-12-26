
<?php 
$id=isset($data->id)?($data->id):'';
$icon=isset($data->icon)?($data->icon):'';	
$nama=isset($data->nama)?($data->nama):'';	


if($icon!=''){
	$icon_1=''.base_url().'theme/images/marker/'.$icon.'';
}else{
	$icon_1=''.base_url().'theme/images/no-image.png';
}				
?>
			<input name="id" type="hidden" value="<?php echo $id ?>">
			<input name="nama_b" type="hidden" value="<?php echo $nama ?>">
			<input name="icon_b" type="hidden" value="<?php echo $icon ?>">

		
			<div class="form-group row">
				<label class="black col-md-3 control-label">Nama</label>
				<div class="col-md-8">
					<input type="text" class="form-control"  value="<?php echo $nama ?>" disabled>
					<input type="hidden" class="form-control" name="f[nama]" value="<?php echo $nama ?>" placeholder="">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Icon</label>
				<div class="col-md-4">
					<input type="file" class="form-control mb-2" name="icon"  id="editicon" onchange="editpreviewFile(this)">
				</div>
				<div class="col-md-3">
					<img width="100px" id="editpreview_img" src="<?php echo $icon_1?>">
				</div>
			</div>

			
	
<script>
function editpreviewFile(el) {
	var extension = $('#editicon').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['png']) == -1)
		{
			alert("Image File must be .png");
			$('#editicon').val('');
			return false;
		}
	}
	if (el.files && el.files[0]) {
         var FR= new FileReader();
         FR.onload = function(e) {
              $("#editpreview_img").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
}
</script>
<!--script>
  $(function () {
    $('[data-mask]').inputmask()
  });
</script-->	
	