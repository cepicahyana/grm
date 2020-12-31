
					<div class="row">
						<div class="col-md-12">

						
								<div class="table-responsive">
								<table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
									<thead  class='sadow bg-light'>		
										<th class='thead' style="width:2px">&nbsp;NO</th>
										<th class='thead' style="min-width:600px">JUDUL</th>
									</thead>
								</table>
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
		"url": "<?php echo site_url('apengumuman/data_tables_pengumuman');?>",
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
	  "targets": [ 0,1], //last column
	  "orderable": false, //set not orderable
	},
	],

});


function reload_table()
{
	dataTable.ajax.reload(null,false);
}


function detail(id)
{	
	$("#title_mdl_view").html("DETAIL PENGUMUMAN");  
	$("#add_page").html('<center>Please wait..</center>');
    //$("#mdl_formSubmit_view").modal({backdrop: 'static', keyboard: false});	
	$.post("<?php echo site_url("apengumuman/view_pengumuman"); ?>",{id:id},function(data){
		$("#add_page").html(data);
	});
}
function back(){
	$("#add_page").html('<center>Please wait..</center>');
	$.post("<?php echo site_url("apengumuman"); ?>",{ajax:"yes"},function(data){
		$("#add_page").html(data);
	});	
}
</script>

