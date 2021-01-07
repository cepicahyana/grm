

		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						
						<label>Pilih Kategori</label>
						<select id="f1" class="form-control" style="width:100%" onchange="reload_table()">
							<option value="">=== Choose ===</option>
							<?php 
							$db=$this->db->get("tm_kategoriobject")->result();
							foreach($db as $val){
								echo "<option value='".$val->kode."'>".$val->kategori."</option>";
							}
							?>
						</select>
						
					</div>
				</div>
				<hr>
				
				<div id="area_tblhistoryAll">
				<div class="table-responsive">
				<table id='table_historyAll' class="tabel table-bordered table-hover dataTable" style="font-size:12px;width:100%">
					<thead  class='sadow bg-light'>	
						<th class='thead' style="width:2px">&nbsp;NO</th>
						<th class='thead' style="min-width:50px">OBJECT</th>
						<th class='thead' style="min-width:50px">KATEGORI</th>
						<th class='thead' style="min-width:50px">STATUS DATA</th>
						<th class='thead' style="min-width:50px">DETECTED</th>
						<th class='thead' style="min-width:50px">INPUTED</th>
						<th class='thead' style="min-width:50px">LATLONG</th>
					</thead>
				</table>
				</div>
				</div>
			</div>
		</div>
			


<script type="text/javascript">
var  dataTable = $('#table_historyAll').DataTable({ 
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
		"url": "<?php echo site_url('areport/data_tables_historyAll');?>",
		"type": "POST",
		"data": function ( data ) {
			data.f1 = $('#f1').val();
			//data.f2 = $('#f2').val();
	 },
	   beforeSend: function() {
			$('#area_tblhistoryAll').addClass('loading_area');
		},
		complete: function() {
			$('#area_tblhistoryAll').removeClass('loading_area');
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
}
</script>
<script>
	
	$(function (){
	$('#f1').select2({
		theme: "bootstrap"
	});
  })
</script>
