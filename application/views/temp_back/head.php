<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <title><?php echo $this->m_konfig->konfigurasi(13);?></title>
	<link rel="shortcut icon" href="<?php echo base_url()?>theme/images/<?php echo $this->m_konfig->konfigurasi(2);?>">
	<!-- style new -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>theme/style.css"/>

	<!-- Fonts and icons -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url(); ?>theme/atlantis/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>theme/atlantis/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>theme/atlantis/css/atlantis.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>theme/atlantis/css/demo.css">
	
<!-- notification -->
<link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugin/bootstrap-toastr/toastr.min.css"/>
<!-- alertifity -->
<link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugin/alertifyjs/css/alertify.min.css"/>
<!-- Sweetalert Css -->
<link rel="stylesheet" href="<?php echo base_url()?>theme/plugin/sweetalert/sweetalert.css" rel="stylesheet" />
<!-- datepicker -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>theme/plugin/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>theme/plugin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>theme/plugin/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<script src="../../assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
<!-- datatables -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>theme/plugin/datatables/css.css"/>
<!-- lightbox -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>theme/plugin/lightbox-master/dist/ekko-lightbox.css" rel="stylesheet">

  
<!-- jQuery -->
<script src="<?php echo base_url(); ?>theme/atlantis/js/core/jquery.3.2.1.min.js"></script>
<script type="text/javascript">
//var $=jQuery;
//var url = window.location;
var base_url = '<?php echo base_url(); ?>';
var site_url = '<?php echo site_url(); ?>';
var load_tbl = '<i class="fa fa-spinner fa-pulse fa-2x fa-fw text-success"></i><span class="sr-only"> Loading...</span> <br><b style="color:white;background:#33AFFF">Data sedang di tampilkan..</b>';
var load_content = '<div id="loading_content_area"><div class="loading_content"><h1>LOADING</h1><span></span><span></span><span></span></div></div>';

</script>


<!-- notification -->
<script type="text/javascript" src="<?php echo base_url(); ?>theme/plugin/bootstrap-toastr/toastr.min.js"></script>
<!-- alertifity -->
<script type="text/javascript" src="<?php echo base_url(); ?>theme/plugin/alertifyjs/alertify.min.js"></script>
<!-- Sweetalert -->
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/sweetalert/sweetalert.min.js"></script>
<!-- datatables -->
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/datatables/pdf.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/datatables/font.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/datatables/datatable.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/datatables/js/dataTables.checkboxes.min.js"></script> 
<!-- datepicker -->
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<!-- Select2 -->
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!---Texteditor-->
<script type="text/javascript" src="<?php echo base_url()?>/theme/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/theme/plugin/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/theme/plugin/ckfinder/ckfinder.js"></script>
</head>
<body>
	<div class="wrapper"> 