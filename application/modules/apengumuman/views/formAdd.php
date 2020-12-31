			
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label class="black control-label">Judul</label>
					<div>
						<input required  type="text" class="form-control" name="f[judul]" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Isi</label>
					<div>
						<textarea id="ckeditorbasic1" class="form-control" rows="2" name="f[isi]" rows="45" placeholder=""></textarea>
					</div>
				</div>
				<!--div class="form-group">
					<label class="black control-label">Tujuan</label>
					<div>
						<select name="tujuan[]" multiple="multiple" class="select2" data-placeholder="" style="width: 100%;">                              
						<.?php $db=$this->db->get_where("data_kri",array('level'=>3))->result();
						foreach($db as $us){?>                                              
							<option value="<.?php echo $us->id ?>"><.?php echo $us->profilename ?>
							</option>                              
						<.?php } ?>
						</select>    
					</div>
				</div-->
			</div>
			<div class="col-md-4">
				<!--div class="form-group">
					<label class="black control-label">Tanggal Tayang</label>
					<div class="input-group">
						<input id="date1" name="tanggal_tayang" type="text" class="form-control form-control-inline date_posting" value="<?php echo date('d/m/Y'); ?>">
						<div class="input-group-append">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Waktu Tayang</label>
					<div class="input-group">
						<input type="text" name="waktu_tayang" class="form-control" id="timepicker1" >
						<div class="input-group-append">
							<span class="input-group-text">
								<i class="fa fa-clock"></i>
							</span>
						</div>
					</div>
				</div-->

				<div class="form-group">
					<label class="black control-label">Status</label>
					<div>
						<label class="form-radio-label">
							<input class="form-radio-input" type="radio" name="f[sts]" value="Publish">
							<span class="form-radio-sign">Publish</span>
						</label>
						<label class="form-radio-label ml-3">
							<input class="form-radio-input" type="radio" name="f[sts]" value="Draft">
							<span class="form-radio-sign">Draft</span>
						</label>
					</div>
				</div>

				<div class="form-group">
					<label class="black control-label">Image</label>
					<div>
						<input type="file" class="form-control" name="img" id="inputimgdata" onchange="inputpreviewFile(this)">
					</div>
					<div class="mt-2">
						<img class="rounded" width="140px" height="120px" id="inputpreview_img">
					</div>
				</div>

				
			</div>
		</div>

			
<script>
  $(function () {
	//$('[data-mask]').inputmask();
	//$('.select2').select2();
	/*var date = new Date();
	$('#date1').daterangepicker({
		startDate: moment(date), 
		format: 'DD/MM/YYYY',	
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'),10)
	});
	$('#timepicker1').timepicker({
		timeFormat: 'HH:mm',
		minTime: '11:45',
		template: 'modal',
		defaultTIme: true,
		showInputs: true,
		showMeridian: false //24hr mode
	});*/
	CKEDITOR.replace( 'ckeditorbasic1', {
		uiColor: '#f4f4f4',
		toolbar: [
		['Format','Font','FontSize'],
		['Bold','Italic','Underline','StrikeThrough','-'],
		['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Link','Smiley','TextColor','BGColor']
		]
	});
  });  
</script>	

<script>
function inputpreviewFile(el) { 
	var extension = $('#inputimgdata').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .png / .jpg");
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