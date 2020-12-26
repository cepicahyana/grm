<div class="card">
	<div class="card-header" style="padding:2px 8px 2px 2px">
		<div class="row align-items-center">
			<div class="col">
				<p class="mt-1 ml-2 text-muted">
					<b>History update</b></p>
			</div>
			<div class="col-auto">
				<a href="javascript:back()" class="btn btn-light btn-border btn-sm">
					Back
				</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
				<table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
					<thead  class='sadow bg-teal'>	
						<th class='thead' style="width:2px">&nbsp;NO</th>
						<th class='thead' style="min-width:200px">TANGGAL</th>
						<th class='thead' style="min-width:60px">PUKUL </th>
						<th class='thead' style="min-width:60px">KONDISI </th>
						<!--th class='thead' style="min-width:100px">AKSI</th-->
					</thead>
				</table>
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
		 "searching": false,
		 "lengthMenu":
		 [[10 , 30,50,100], 
		 [10 , 30,50,100]], 
		dom: 'Blfrtip',
		buttons: [ 
			/*{
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
            },{
				extend: 'colvis',
				exportOptions: {
				columns:[ 0,1,2,3,4,5,6,7,8]
				},text:' Coloumn',className :"btn bg-blue-grey btn-sm",	
			},*/		
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
			"url": "<?php echo site_url('dkonlog/data_tables');?>",
			"type": "POST",
			"data": function ( data ) {
				//data.f1 = $('#f1').val();
			 },
			beforeSend: function() {
				loading('area_lod');
            },
			complete: function() {
				unblock('area_lod');
            },
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });

	function reload_table()
	{
		dataTable.ajax.reload(null,false);
		//$('input[type="checkbox"]', dataTable.cells().nodes()).prop('checked',false);
	};
</script>  