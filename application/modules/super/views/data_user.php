				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Data User</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?php echo base_url()?>super/dashboard">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Data User</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex justify-content-between">
										<div class="d-md-inline-block">
										<h4 class="card-title">Kelola data user</h4>
										</div>
										<a href="javascript:input()" class="btn btn-primary d-none d-sm-inline-block">
											<i class="fa fa-plus-circle fa-lg"></i> Add User
										</a>
									</div>
								</div>
								<div class="card-body">
									<div id="area_lod">
										<div class="table-responsive">
										<table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
											<thead  class='sadow bg-teal'>			
												<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
												<th class='thead' >USER GROUP </th>
												<th class='thead' >PROFILE NAME </th>
												<th class='thead' >FOTO </th>
												<th class='thead' >USERNAME </th>
												<th class='thead' >AKTIF</th>
												<th class='thead' style="min-width:130px">PROCESS</th>
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
			  "lengthMenu": "&nbsp;Show _MENU_ entries",  
		}, 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": true,
		 "order": [[ 1, "desc" ]],
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500], 
		 [10 , 30,50,100,200,300,400,500]], 
		dom: 'Blfrtip',
		buttons: [],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('super/data_tables_user');?>",
            "type": "POST",
			"data": function ( data ) {
				//data.f1 = $('#f1').val();
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
          "targets": [ -1,-2,-3,-4,-5,-6,-7], //last column
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
	$("#title_mdl_input").html("INPUT DATA MEMBER");
	$("#mdl_formSubmit_input").modal({backdrop: 'static', keyboard: false});
	$("#add_page").html('<center>Please wait..</center>');
	$("#formSubmit_input").attr("url","<?php echo base_url("super/insert_User");?>");
	$.post("<?php echo site_url("super/input_User"); ?>",function(data){
		$("#add_page").html(data);
		$("#formSubmit_input")[0].reset();
		$("#inputpreview_img").attr("src", '<?php echo base_url()?>theme/images/user/img_not.png');
	});
	
}
function edit(id)
{	
	$("#title_mdl_edit").html("EDIT DATA MEMBER");
	$("#mdl_formSubmit_edit").modal({backdrop: 'static', keyboard: false});
	$("#edit_page").html('<center>Please wait..</center>');
	$("#formSubmit_edit").attr("url","<?php echo base_url("super/update_User");?>");
	$.post("<?php echo site_url("super/edit_User"); ?>",{id:id},function(data){
		$("#edit_page").html(data);
	});
}

function del(id,name){
   alertify.confirm("Delete","<center>Delete data <b>Name : "+name+"</b>?</center>",function(){
		$.ajax({
			 url:'<?php echo site_url("super/delete_User"); ?>',
			 data: 'id='+id,
			 method:"POST",
			 dataType:"JSON",
			 success: function(data)
				{ 	   	
					if(data["table"]==true){
						reload_table();
						toastr['success']("Successfully deleted permanently");
					}else{
					   notif("<b>Delete Failed!!</b>");
					}
				}		
		})
   }, function(){ });
}
</script>


<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_input">
<div class="modal-dialog" id="area_formSubmit_input">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_input">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_input" action="javascript:submitForm('formSubmit_input')" method="post" enctype="multipart/form-data">
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
<div class="modal-dialog" id="area_formSubmit_edit">
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_edit">Default Modal</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_edit" action="javascript:submitForm('formSubmit_edit')" method="post" enctype="multipart/form-data">
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


			
