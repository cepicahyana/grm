
<?php 
$id=isset($data->id)?($data->id):'';
$img=isset($data->img)?($data->img):'';	
$judul=isset($data->judul)?($data->judul):'';			
$isi=isset($data->isi)?($data->isi):'';	
$sts=isset($data->sts)?($data->sts):'';	
$tanggal=isset($data->_ctime)?($data->_ctime):'';
if($tanggal!=''){$tanggal_=$this->tanggal->inddatetime($tanggal," ");}else{$tanggal_="";}
/*
$tgl=$this->tanggal->ind($tanggal,0);
$waktu=isset($data->waktu)?($data->waktu):'';
if($waktu!=''){
	$cwkt=explode(':',$waktu);
	$cwkt1=$cwkt[0];	
	$cwkt2=$cwkt[1];
	echo $wkt=''.$cwkt1.':'.$cwkt2.'';
}else{
	$wkt='';
}*/



if($img!=''){
	$img_1=''.base_url().'theme/images/pengumuman/'.$img.'';
}else{
	$img_1=''.base_url().'theme/images/no-image.png';
}				
?>
			<input name="id" type="hidden" value="<?php echo $id ?>">
			<input name="judul_b" type="hidden" value="<?php echo $judul ?>">
			<input name="img_b" type="hidden" value="<?php echo $img ?>">
			<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label class="black control-label">Judul</label>
					<div>
						<input required  type="text" class="form-control" name="f[judul]" value="<?php echo $judul ?>" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Isi</label>
					<div>
						<textarea id="ckeditorbasic2" class="form-control" rows="2" name="f[isi]" rows="45" placeholder=""><?php echo $isi ?></textarea>
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
						<input id="date2" name="tanggal_tayang" type="text" class="form-control form-control-inline date_posting" value="<.?php if($tgl!=''){echo $tgl;}else{echo date('d/m/Y');}  ?>">
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
						<input type="text" name="waktu_tayang" class="form-control" id="timepicker2" value="<.?php echo $wkt ?>">
						<div class="input-group-append">
							<span class="input-group-text">
								<i class="fa fa-clock"></i>
							</span>
						</div>
					</div>
				</div-->
				<div class="form-group">
					<label class="black control-label">Dibuat Tanggal</label>
					<div>
						<i class="text-muted"><?php echo $tanggal_ ?></i>
					</div>
				</div>
				<div class="form-group">
					<label class="black control-label">Status</label>
					<div>
						<label class="form-radio-label">
							<input class="form-radio-input" type="radio" name="f[sts]" value="Draft" <?php if($sts=='Draft'){echo 'checked';} ?>>
							<span class="form-radio-sign">Draft</span>
						</label>
						<label class="form-radio-label ml-3">
							<input class="form-radio-input" type="radio" name="f[sts]" value="Publish" <?php if($sts=='Publish'){echo 'checked';} ?>>
							<span class="form-radio-sign">Publish</span>
						</label>
					</div>
				</div>

				<div class="form-group">
					<label class="black control-label">Image</label>
					<div>
						<input type="file" class="form-control" name="img" id="editimgdata" onchange="editpreviewFile(this)">
					</div>
					<div class="mt-2">
						<img class="rounded" width="140px" height="120px" id="editpreview_img" src="<?php echo $img_1?>">
					</div>
				</div>

				
			</div>
		</div>
		

				
		<script>
  $(function () {
   // $('[data-mask]').inputmask();
   /*<.?php if($tgl!=''){?>
	var date = '<.?php echo $tanggal ?>';
   <.?php }else{ ?>
	var date = new Date();
   <.?php }  ?>
	$('#date2').daterangepicker({
		startDate: moment(date), 
		format: 'DD/MM/YYYY',	
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'),10)
	});
	$('#timepicker2').timepicker({
		timeFormat: 'HH:mm',
		minTime: '11:45',
		template: 'modal',
		defaultTIme: true,
		showInputs: true,
		showMeridian: false //24hr mode
	});*/
	CKEDITOR.replace( 'ckeditorbasic2', {
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
function editpreviewFile(el) {
	var extension = $('#editimgdata').val().split('.').pop().toLowerCase();
	if(extension != ''){
		if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
		{
			alert("Image File must be .png / .jpg");
			$('#editimgdata').val('');
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

	