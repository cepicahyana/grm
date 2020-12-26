			

			<div class="form-group row">
				<label class="black col-md-3 control-label">Nama</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="f[namadata]" placeholder="" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Deskripsi</label>
				<div class="col-md-9">
					<textarea class="form-control" rows="3" name="f[descdata]" placeholder=""></textarea>
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Image</label>
				<div class="col-md-5">
					<input type="file" class="form-control" name="imgdata" id="inputimgdata" onchange="inputpreviewFile(this)">
				</div>
				<div class="col-md-3">
					<img width="100px" height="90px" id="inputpreview_img">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Latitude</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[lat]" placeholder="">
				</div>
			</div>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Longitude</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[lng]" placeholder="">
				</div>
			</div>
			
<script>
  $(function () {
    $('[data-mask]').inputmask()
  });
</script>	

<script>
function inputpreviewFile(el) { 
	var extension = $('#inputimgdata').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .gif / .png / .jpg");
			$('#inputimgdata').val('');
			return false;
		}
	}
	if (el.files && el.files[0]) {
         var FR= new FileReader();
         FR.onload = function(e) {
              $("#inputpreview_img").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
}
</script>			