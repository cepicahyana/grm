				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Data Log login </h4>
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
								<a href="#">Data Log login</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex justify-content-between">
										<div class="d-md-inline-block">
										<h4 class="card-title">List Data Log</h4>
										</div>
										<!--a href="javascript:input()" class="btn btn-primary d-none d-sm-inline-block">
											<i class="fa fa-plus-circle fa-lg"></i> Add User
										</a-->
									</div>
								</div>
								<div class="card-body">
									<div id="area_lod">
										<div class="table-responsive">
										<table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
											<thead  class='sadow bg-teal'>			
												<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
												<th class='thead' >NAMA USER </th>
												<th class='thead' >TABLE UPDATE </th>
												<th class='thead' >AKSI </th>
												<th class='thead' >TANGGAL</th>
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
            "url": "<?php echo site_url('super/data_tables_log');?>",
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
          "targets": [ -1,-3,-4,-5,-6], //last column
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
function del(id,name){
   alertify.confirm("Delete","<center>Delete data : <b>`"+name+"`</b> ?</center>",function(){
	$.post("<?php echo site_url("super/delete_Log"); ?>",{id:id},function(){
		toastr['success']("Successfully deleted permanently");
		reload_table();
	  })
   }, function(){ });
}
</script>



