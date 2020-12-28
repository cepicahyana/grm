			
				<div class="panel-header" style="background: rgb(104,147,179);
background: -moz-linear-gradient(90deg, rgba(104,147,179,1) 0%, rgba(76,119,151,1) 100%);
background: -webkit-linear-gradient(90deg, rgba(104,147,179,1) 0%, rgba(76,119,151,1) 100%);
background: linear-gradient(90deg, rgba(104,147,179,1) 0%, rgba(76,119,151,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#6893b3',endColorstr='#4c7797',GradientType=1);">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
								<h5 class="text-white op-7 mb-2">welcome to app <?php echo $this->m_konfig->konfigurasi(7); ?></h5>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-xs-6 col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-placeholder text-primary"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">KRI</p>
												<h4 class="card-title"><?php echo $this->m_total->ttl_fm1();?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-placeholder text-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">LANTAMAL</p>
												<h4 class="card-title"><?php echo $this->m_total->ttl_fm2();?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-placeholder text-danger"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">LANAL</p>
												<h4 class="card-title"><?php echo $this->m_total->ttl_fm3();?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-placeholder text-secondary"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">BRIGIF</p>
												<h4 class="card-title"><?php echo $this->m_total->ttl_fm4();?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-placeholder text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">POSAL</p>
												<h4 class="card-title"><?php echo $this->m_total->ttl_fm5();?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-placeholder text-default"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">SATRAD</p>
												<h4 class="card-title"><?php echo $this->m_total->ttl_fm6();?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row mt--2">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="card card-stats card-round">
								<div class="card-header">
									<div class="card-title">Status</div>
								</div>
								<div class="card-body ">
									<div id="area_lod">
										<div class="table-responsive">
										<table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
											<thead  class='sadow bg-default'>	
												<th class='thead' style="width:2px">&nbsp;NO</th>
												<th class='thead' style="min-width:70px">NAMA KRI</th>
												<th class='thead' style="min-width:60px">KONLOG </th>
												<th class='thead' style="min-width:60px">KONIS </th>
												<th class='thead' style="min-width:60px">KONPERS</th>
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
	"processing": ' <span class="sr-only dataTables_processing">Loading...</span> <br><b style="color:black;background:white">Process of displaying data<br> Please wait..</b>',
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
	 "order": [[ 2, "desc" ]],
	 "lengthMenu":
	 [[10 , 30,50,100,200,300,400,500], 
	 [10 , 30,50,100,200,300,400,500]], 
	dom: 'Blfrtip',
	buttons: [],
	
	// Load data for the table's content from an Ajax source
	"ajax": {
		"url": "<?php echo site_url('dashboard/data_tables_statuskri');?>",
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
	  "targets": [ 0,1,-1,-2,-3,-4 ], //last column
	  "orderable": false, //set not orderable
	},
	],

});


function reload_table()
{
	dataTable.ajax.reload(null,false);
};
</script>
