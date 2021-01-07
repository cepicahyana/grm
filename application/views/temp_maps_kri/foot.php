

	</div>
	<!--   Core JS Files   -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/core/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>theme/atlantis/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	
	<!-- Bootstrap Notify -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- Bootstrap Toggle -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>



	<!-- Bootstrap Tagsinput -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

	<!-- Bootstrap Wizard -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

	<!-- jQuery Validation -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/jquery.validate/jquery.validate.min.js"></script>

	<!-- Summernote -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/summernote/summernote-bs4.min.js"></script>

	<!-- Sweet Alert -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Owl Carousel -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/owl-carousel/owl.carousel.min.js"></script>

	<!-- Magnific Popup -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>

	<!-- Atlantis JS -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/atlantis.min.js"></script>

	

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/setting-demo.js"></script>
	<script src="<?php echo base_url(); ?>theme/atlantis/js/demo.js"></script>


<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/jqueryform/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>theme/plugin/jqueryform/jquery.form.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>theme/act/function.js"></script>	
<script type="text/javascript" src="<?php echo base_url()?>theme/act/proses.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>theme/act/toastrconfig.js"></script>

		
<!--script>
jQuery(document).ready(function(){ 
   
});
$(window).on('load', function(){

});
</script-->
<script>
  $(function () {
	activemenu();
	count();
  })
</script>
<script>
	setInterval(function(){ count(); }, 30000);
	function count(){
		$.ajax({
		  type: "GET",
		  url: site_url+"apengumuman/count_pengumuman",
		  success: function(data){ $(".amount_a").html(data);},
		  error: function(jqXHR, textStatus, errorThrown){ return false; }                  
		}); 
	}
</script>	
<script>
		function notifin(msg){
			$("#notifin_msg").html(msg);
			 alertify.genericDialog || alertify.dialog('genericDialog',function(){
		return {
			main:function(content){
				this.setContent(content);
			},
			setup:function(){
				return {
					focus:{
						element:function(){
							return this.elements.body.querySelector(this.get('selector'));
						},
						select:true
					},
					options:{
						basic:true,
						maximizable:false,
						resizable:false,
						padding:false
					}
				};
			},
			settings:{
				selector:undefined
			}
		};
	});
	alertify.genericDialog ($('#notifin')[0]).set('selector', '');
		  };
	</script>
	<div style="display:none">
		<div class="modal-body" id="notifin">
			<Center> <p id="notifin_msg"></p></center>
		</div>
	</div>  

</body>
</html>






	