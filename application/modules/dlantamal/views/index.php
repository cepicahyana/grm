				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Data LANTAMAL</h4>
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
								<a href="#">Data LANTAMAL</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col-6">
										<h4 class="card-title">Kelola data LANTAMAL</h4>
										</div>
										<div class="col-6">
										<div class="float-right d-sm-inline-block">
										<a href="javascript:input()" class="btn btn-primary">
											<i class="fa fa-plus-circle fa-lg"></i> Add Data
										</a>
										<a href="javascript:import_data()" class="btn btn-primary">
											<i class="fas fa-download"></i> Import Data
										</a>
										</div>
										</div>
									</div>
									
								</div>
								<div class="card-body">
									<div id="area_lod">
										<div class="table-responsive">
										<table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
											<thead  class='sadow bg-teal'>
												<th class='thead' >&nbsp;</th>
												<th class='thead' style="width:2px">ID</th>			
												<th class='thead' style="width:2px">&nbsp;NO</th>
												<th class='thead' style="min-width:70px">NAMA</th>
												<th class='thead' style="min-width:120px">DESKRIPSI </th>
												<th class='thead' style="min-width:60px">LATLONG </th>
												<th class='thead' style="min-width:150px">AKSI</th>
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
        "processing": true, //Feature control the processing indicator.
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
			  "lengthMenu": "&nbsp;&nbsp; Show _MENU_ entries", 
				"select": {
					rows: ''
				}			  
		}, 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"responsive": false,
		"searching": true,
		 'columnDefs': [{
			    'targets': [0],
				'orderable': false,
				'searchable': false,
                'width': '1%',
				'checkboxes': {
					'selectRow': true,
				},
			},
			{
                "targets": [1],
                "visible": false,
                "searchable": false
			},{ 
			  "targets": [ 0,-1,-2,-3,-4,-5,-6], //last column
			  "orderable": false, //set not orderable
			}],
			"select": {
				style:    'multi',
				selector: 'td:first-child'
			},
		 "order": [[ 1, "desc" ]],
		 "lengthMenu":
		 [[10 , 30,50,100,200,300], 
		 [10 , 30,50,100,200,300]], 
		dom: 'Blfrtip',
		buttons: [
			{
				text:'<span class="fas fa-trash"></span> Delete Selected',
				className :"btn btn-default btn-sm delsel"
			},
			{
                text: '<span class="fas fa-file-excel"></span> Download Excell',
				className :"btn btn-default btn-sm",
                action: function ( e, dt, node, config ) {
                   downloadXL();
                }
            },
			{
                text: '<span class="fas fa-sync-alt"></span> Refresh',
				className :"btn btn-default btn-sm",
                action: function ( e, dt, node, config ) {
                   reload_table();
                }
            },
			/*{
				extend: 'excelHtml5',
				exportOptions: { columns: [2,3,4,5,6] },
				text:'<span class="fas fa-file-excel"></span> Download Excell',
				className :"btn btn-default btn-sm",
				title: 'DATA SERTIFIKAT',
				messageTop: 'EXPORT DATA SERTIFIKAT | <.?php echo date("d/m/Y H:i");?>',
				filename: 'Export-DATA-SERTIFIKAT',
				customize: function( xlsx ) 
				{
					var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
					source.setAttribute('name','DATA SERTIFIKAT');
				}
			},*/
        ],
		/*fixedHeader: [{
            header: true,
            footer: true
        }],*/
        
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": "<?php echo site_url('dlantamal/data_tables');?>",
			"type": "POST",
			"data": function ( data ) {
				//data.f1 = $('#f1').val();
			 },
			beforeSend: function() {
				$('#area_lod').addClass('loading_area');
            },
			complete: function() {
				$('#area_lod').removeClass('loading_area');
            },
        },
		/*Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1,-2,-3,-4,-5,-6,-7], //last column
          "orderable": false, //set not orderable
        },
        ],*/
		//data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash() ?>';
		//data.f1 = $('#f1').val();
    });

	
	function reload_table()
	{
		dataTable.ajax.reload(null,false);
		//$('input[type="checkbox"]', dataTable.cells().nodes()).prop('checked',false);
	};
</script>  

<script>
function input()
{ 
	$("#title_mdl_input").html("INPUT DATA LANTAMAL");
	$("#mdl_formSubmit_input").modal({backdrop: 'static', keyboard: false});
	$("#add_page").html('<center>Please wait..</center>');
	$("#formSubmit_input").attr("url","<?php echo base_url("dlantamal/insert_data");?>");
	$.post("<?php echo site_url("dlantamal/input_data"); ?>",function(data){
		$("#add_page").html(data);
		$("#formSubmit_input")[0].reset();
		$("#inputpreview_img").attr("src", '<?php echo base_url()?>theme/images/no-image.png');
	});	
}
function edit(id)
{	
	$("#title_mdl_edit").html("EDIT DATA LANTAMAL");
	$("#mdl_formSubmit_edit").modal({backdrop: 'static', keyboard: false});
	$("#edit_page").html('<center>Please wait..</center>');
	$("#formSubmit_edit").attr("url","<?php echo base_url("dlantamal/update_data");?>");
	$.post("<?php echo site_url("dlantamal/edit_data"); ?>",{id:id},function(data){
		$("#edit_page").html(data);
	});
}
function wilayahkerja(id)
{	
	$("#title_mdl_wk").html("EDIT WILAYAH KERJA");    
    $("#mdl_formSubmit_wk").modal({backdrop: 'static', keyboard: false});
	$("#mdl_formSubmit_wk").removeAttr('style');	
	$("#wk_page").html('<center>Please wait..</center>');
	$("#formSubmit_wk").attr("url","<?php echo base_url("dlantamal/update_wilayah_kerja");?>");
	$.post("<?php echo site_url("dlantamal/wilayah_kerja"); ?>",{id:id},function(data){
		$("#wk_page").html(data);
	});
}
function priview(id)
{	
	$("#title_mdl_view").html("PRIVIEW DATA LANTAMAL");    
    $("#mdl_formSubmit_view").modal({backdrop: 'static', keyboard: false});	
	$("#view_page").html('<center>Please wait..</center>');
	$.post("<?php echo site_url("dlantamal/view_data"); ?>",{id:id},function(data){
		$("#view_page").html(data);
	});
}
function del(id,name){
   alertify.confirm("Delete","<center>Delete data <b>Name : "+name+"</b>?</center>",function(){
		$.ajax({
			url:'<?php echo site_url("dlantamal/delete_item"); ?>',
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
					notif("<b>Delete Failed!!</b>");
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
	$("#title_mdl_down").html("IMPORT DATA LANTAMAL");
	//$("#isi").html(data);
	$("#mdl_formSubmitDown").modal('show');
	$("#formSubmitDown").attr("url","<?php echo base_url()?>dlantamal/import_data");
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

</script>
<script>	
	$('.delsel').on('click', function(e){ 
		var oData = dataTable.rows({selected:  true}).data();
		var newarray=[];       
			for (var i=0; i < oData.length ;i++){
			   //alert("id: " + oData[i][0] + " no: " + oData[i][1] );
			   newarray.push(oData[i][1]);
			}
		var sData = newarray.join();
		//alert(sData);
		if(sData!=''){
			alertify.confirm("Delete selected","<center>Delete "+oData.length+" data ?</center>",function(){
					$.ajax({
						url:'<?php echo site_url("dlantamal/delete_sel"); ?>',
						data: 'ct='+sData,
						method:"POST",
						dataType:"JSON",
						beforeSend: function() {
							$('#area_lod').addClass('loading_area');
						},
						success: function(data)
						{ 	
							$('#area_lod').removeClass('loading_area');   	
							if(data["table"]==true){
								reload_content();
								toastr['success']("Successfully deleted permanently");
							}else{
								notif("<b>Delete Failed!!</b>");
							}
						}		
					})
			}, function(){ });
		}else{
			toastr['warning']("No column selected, cannot continue"); return false;
		}
	});
</script>	
	
<script>
  $(function (){
	 $('.select2').select2({
      theme: 'bootstrap'
    });
	/*$('[data-mask]').inputmask();
	$(".tanggal_mulai").on("change keyup paste keypress", function(data){
		var tgl_1 = $(this).val();
		var tgl_2 = $(".tanggal_selesai").val();
		durasiBln(tgl_1,tgl_2);
	});*/
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
	<form class="horizontal-form" id="formSubmit_input" action="javascript:submitForm('formSubmit_input')" method="post">
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
	<form class="horizontal-form" id="formSubmit_edit" action="javascript:submitForm('formSubmit_edit')" method="post" >
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


<!-- modal --
<div class="modal fade" id="mdl_formSubmit_wk">
<div class="modal-dialog modal-lg" id="area_formSubmit_wk">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_wk">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_wk" action="javascript:submitForm('formSubmit_wk')" method="post" >
	<div class="modal-body">
			<div id="wk_page"></div>
	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button  title="Save" id="submit" onclick="submitForm('formSubmit_wk')" class="btn btn-primary"><i id="msg_formSubmit_wk"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
	</div>
	</form>
  </div>
   /.modal-content --
</div>
 /.modal-dialog --
</div>
 /.modal -->

<style>
/*modal fullwidth*/
.modal-dialog-full-width {
	width: 100% !important;
	height: 100% !important;
	margin: 0 !important;
	padding: 0 !important;
	max-width:none !important;
}
.modal-content-full-width  {
	height: auto !important;
	min-height: 100% !important;
	border-radius: 0 !important;
	background-color: #fff !important 
}
.modal-header-full-width  {
	border-bottom: 1px solid #9ea2a2 !important;
}
.modal-footer-full-width  {
	border-top: 1px solid #9ea2a2 !important;
}
</style>

<!-- modal -->
<div class="modal fade right" id="mdl_formSubmit_wk" tabindex="-1" role="dialog" aria-labelledby="title_mdl_wk" aria-hidden="true">
    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document" id="area_formSubmit_wk">
        <div class="modal-content-full-width modal-content ">
            <div class=" modal-header-full-width   modal-header text-center">
                <h5 class="modal-title w-100" id="title_mdl_wk">Material Design  Full Screen Modal</h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
                </button>
			</div>
			<form class="form-horizontal" id="formSubmit_wk" action="javascript:submitForm('formSubmit_wk')" method="post" >
            <div class="modal-body">
				<div id="wk_page"></div>
            </div>
            <div class="modal-footer-full-width  modal-footer">
                <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                <button  title="Save" id="submit" onclick="submitForm('formSubmit_wk')" class="btn btn-primary btn-rounded"><i id="msg_formSubmit_wk"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button>
			</div>
			</form>
        </div>
    </div>
</div>
<!-- /.modal -->
