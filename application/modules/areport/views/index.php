                <div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Report</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?php echo base_url()?>dashboard">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Data Report</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col-6">
										<h4 class="card-title">Kelola data Report</h4>
										</div>
										<div class="col-6">
										<div class="float-right d-sm-inline-block">
										<a href="javascript:history_objectAll()" class="btn btn-primary">
											<i class="far fa-clock fa-lg"></i> History All
										</a>
										</div>
										</div>
									</div>
									
								</div>
								<div class="card-body">
									<div id="area_lod">
										<div class="table-responsive">
										<table id='table' class="tabel black table-bordered table-hover dataTable" style="font-size:12px;width:100%">
											<thead  class='sadow bg-light'>		
												<th class='thead' style="width:2px">&nbsp;NO</th>
												<th class='thead' style="min-width:50px">OBJECT</th>
                                                <th class='thead' style="min-width:50px">KATEGORI</th>
                                                <th class='thead' style="min-width:50px">STATUS OBJECT</th>
                                                <th class='thead' style="min-width:50px">STATUS DATA</th>
                                                <th class='thead' style="min-width:50px">DETECTED</th>
                                                <th class='thead' style="min-width:50px">INPUTED</th>
                                                <th class='thead' style="min-width:30px">LATLONG</th>
                                                <th class='thead' style="min-width:120px">AKSI</th>
											</thead>
										</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>


<script type="text/javascript">	
	var  dataTable = $('#table').DataTable({ 
	"paging": true,
	"processing": false, //Feature control the processing indicator.
	"language": {
	"sSearch": "Search",
	"processing": load_tbl,
		  "oPaginate": {
			"sFirst": "Page First",
			"sLast": "Page Last",
			 "sNext": "Next",
			 "sPrevious": "Previous"
			 },
		"sInfo": "Total :  _TOTAL_ , Row (_START_ - _END_)",
		 "sInfoEmpty": "No data displayed",
		   "sZeroRecords": "Data not available",
		  "lengthMenu": "&nbsp;Show _MENU_ entries",  
	}, 
	"serverSide": true, //Feature control DataTables' server-side processing mode.
	 "responsive": true,
	 "searching": true,
	 //"order": [[ 2, "desc" ]],
	 "lengthMenu":
	 [[10 , 30,50,100,200], 
	 [10 , 30,50,100,200]], 
	dom: 'Blfrtip',
	buttons: [],
	
	// Load data for the table's content from an Ajax source
	"ajax": {
		"url": "<?php echo site_url('areport/data_tables');?>",
		"type": "POST",
		"data": function ( data ) {
			data.f1 = $('#f1').val();
			//data.f2 = $('#f2').val();
	 },
	   beforeSend: function() {
			$('#area_lod').addClass('loading_area');
		},
		complete: function() {
			$('#area_lod').removeClass('loading_area');
		},
		
	},

	//Set column definition initialisation properties.
	"columnDefs": [
	{ 
	  "targets": [ 0,1,-1,-2,-3,-4,-5,-6,-7], //last column
	  "orderable": false, //set not orderable
	},
	],


});

	
function reload_table()
{
    dataTable.ajax.reload(null,false);
};
</script>  

<script>
function input()
{ 
	$("#title_mdl_input").html("INPUT DATA LANAL");
	$("#mdl_formSubmit_input").modal({backdrop: 'static', keyboard: false});
	$("#add_page").html('<center>Please wait..</center>');
	$("#formSubmit_input").attr("url","<?php echo base_url("dlanal/insert_data");?>");
	$.post("<?php echo site_url("dlanal/input_data"); ?>",function(data){
		$("#add_page").html(data);
		$("#formSubmit_input")[0].reset();
		$("#inputpreview_img").attr("src", '<?php echo base_url()?>theme/images/no-image.png');
	});	
}
function edit(id)
{	
	$("#title_mdl_edit").html("EDIT DATA LANAL");
	$("#mdl_formSubmit_edit").modal({backdrop: 'static', keyboard: false});
	$("#edit_page").html('<center>Please wait..</center>');
	$("#formSubmit_edit").attr("url","<?php echo base_url("dlanal/update_data");?>");
	$.post("<?php echo site_url("dlanal/edit_data"); ?>",{id:id},function(data){
		$("#edit_page").html(data);
	});
}
function priview(id)
{	
	$("#title_mdl_view").html("PRIVIEW DATA LANAL");    
    $("#mdl_formSubmit_view").modal({backdrop: 'static', keyboard: false});	
	$("#view_page").html('<center>Please wait..</center>');
	$.post("<?php echo site_url("dlanal/view_data"); ?>",{id:id},function(data){
		$("#view_page").html(data);
	});
}
function del(id,name){
   alertify.confirm("Delete","<center>Delete data <b>"+name+"</b>?</center>",function(){
		$.ajax({
			url:'<?php echo site_url("areport/delete_permanent"); ?>',
			data: 'id='+id,
			method:"POST",
		 	dataType:"JSON",
			beforeSend: function() {
				$('#area_lod').addClass('loading_area');
			},
			success: function(data)
			{ 	   	
				$('#area_lod').removeClass('loading_area');   
				if(data["table"]==true){
					toastr['success']("Successfully deleted permanently");
					reload_table();
				}else{
                    toastr['danger']("Delete Failed!!");
				}
			}		
		})
   }, function(){ });
}
function priviewPDF(id)
{	
	$("#title_mdl_view").html("PRINT ALL PRIVIEW");    
    $("#mdl_formSubmit_view").modal({backdrop: 'static', keyboard: false});	
	//$("#formSubmit_view").attr("url","<?php echo base_url("data_sertifikat/print_Sertifikat");?>");
	$("#_view").val(id);
	$.post("<?php echo site_url("data_sertifikat/priview_Sertifikat"); ?>",{id:id},function(data){
		//$("#view_page").html(data);
		$("#view_page").html('<iframe src="<?php echo base_url();?>data_sertifikat/priview_sertifikat?id='+id+'" style="width:100%;height:500px">'+data+'</iframe>');
	});
}

function import_data() 
{ 	//alert('');
    $("#formSubmitDown")[0].reset();
	$("#title_mdl_down").html("IMPORT DATA LANAL");
	//$("#isi").html(data);
	$("#mdl_formSubmitDown").modal('show');
	$("#formSubmitDown").attr("url","<?php echo base_url()?>dlanal/import_data");
}

function downloadXL()
{
	var f1 = $('#f1').val();		
	var s = $('.whatever').val();		
	 window.open(
	  "<?php echo base_url()?>data_member/downloadXL/?f1="+f1+"&s="+s,
	  '_blank' // <- This is what makes it open in a new window.
	 );
}

function history_object(kd,nm){ 
	$("#title_mdl_historyobject").html("HISTORY OBJECT "+nm+"");
	$("#mdl_formSubmit_historyobject").modal({backdrop: 'static', keyboard: false});
    $("#historyobject_page").html('<center>Please wait..</center>');
	$.post(base_url+"areport/history_data",{kd:kd},function(data){
        $("#historyobject_page").html(data);
	});	
}

function history_objectAll(){ 
	$("#title_mdl_historyobject").html("HISTORY OBJECT ALL");
	$("#mdl_formSubmit_historyobject").modal({backdrop: 'static', keyboard: false});
    $("#historyobject_page").html('<center>Please wait..</center>');
	$.post(base_url+"areport/history_all",function(data){
        $("#historyobject_page").html(data);
	});	
}
</script>
	
<script>
  $(function (){
	 /*$('.select2').select2({
      theme: 'bootstrap'
    });
	$('[data-mask]').inputmask();
	*/
  })
</script>


<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_input">
<div class="modal-dialog modal-lg" id="area_formSubmit_input">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_input">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_input" action="javascript:submitForm('formSubmit_input')" method="post">
	<div class="modal-body">
			<div id="add_page"></div>
	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button  title="Save" id="submit" onclick="submitForm('formSubmit_input')" class="btn btn-primary"><i id="msg_formSubmit_input"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_edit">
<div class="modal-dialog modal-lg" id="area_formSubmit_edit">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_edit">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_edit" action="javascript:submitForm('formSubmit_edit')" method="post" >
	<div class="modal-body">
			<div id="edit_page"></div>
	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button  title="Save" id="submit" onclick="submitForm('formSubmit_edit')" class="btn btn-primary"><i id="msg_formSubmit_edit"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_view">
<div class="modal-dialog" id="area_formSubmit_view">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_view">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_view" action="javascript:submitForm('formSubmit_view')" method="post" >
	<div class="modal-body">
			<div id="view_page"></div>
	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- modal -->
<div class="modal fade" id="mdl_formSubmitDown">
<div class="modal-dialog" id="area_formSubmitDown">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_down">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmitDown" action="javascript:submitForm('formSubmitDown')" method="post" >
	<div class="modal-body">
		
			<center> <a class="sound" href="<?php echo base_url('doc/format_lantamal.xlsx')?>">Download Format Upload</a> </center><br>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Cari File</label>
				<div class="col-md-9">
					<input type="file" accept="xlsx" class="form-control" name="file" required/>
				</div>
			</div>

	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button  title="Save" id="formSubmitDown" onclick="submitForm('formSubmitDown')" class="btn btn-primary"><i id="msg_formSubmitDown"></i>&nbsp;&nbsp;<i class='fa fa-upload'></i> Upload</button>
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_historyobject">
<div class="modal-dialog modal-lg" id="area_formSubmit_historyobject"> 
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_historyobject">Default Modal</h4>
	  <button type="button" onclick="close_modal()" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_historyobject" action="javascript:submitForm('formSubmit_historyobject')" method="post">
	<div class="modal-body">
        <div id="historyobject_page"></div>
	</div>
    <div class="modal-footer justify-content-between">
        <button type="button" onclick="close_modal()" class="btn btn-default mr-2" data-dismiss="modal">Close</button>
	    <!--button  title="Save" id="submit" onclick="submitForm('formSubmit_historyobject')" class="btn btn-primary"><i id="msg_formSubmit_historyobject"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button-->
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
