

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

	<!-- Bootstrap Wizard 
	<script src="<.?php echo base_url(); ?>theme/atlantis/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>-->

	<!-- jQuery Validation 
	<script src="<.?php echo base_url(); ?>theme/atlantis/js/plugin/jquery.validate/jquery.validate.min.js"></script>-->

	<!-- Summernote 
	<script src="<.?php echo base_url(); ?>theme/atlantis/js/plugin/summernote/summernote-bs4.min.js"></script>-->

	<!-- Sweet Alert -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Owl Carousel -->
	<script src="<?php echo base_url(); ?>theme/atlantis/js/plugin/owl-carousel/owl.carousel.min.js"></script>

	<!-- Magnific Popup 
	<script src="<.?php echo base_url(); ?>theme/atlantis/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>-->

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
<script type="text/javascript">
	$(document).off("click",".menuclick").on("click",".menuclick",function (event, messages) {
		event.preventDefault()
		var url = $(this).attr("href");
		var title = $(this).attr("title");
		var target = $(this).attr("target");
		var session = "1";
		if(url=="<?php echo base_url()?>login/logout")
		{
			window.location.href=url;
		}
		if(target=="_blank")
		{
			window.open(url, '_blank');
			return false;
		}  
		$(this).parent().addClass('active').siblings().removeClass('active');
		$("#content").html(load_content);
		$.post(url,{ajax:"yes"},function(data){
			$('.modal.aside').remove();
			history.replaceState(title, title, url);
			$(".uri").val(url);
			$('title').html(title);
			$("#content").html(data);
			activemenu();
		})
	})
</script> 
		
<script>
jQuery(document).ready(function(){ 
	
});


var uri_1='<?php echo $this->uri->segment(1) ?>';
var uri_2='<?php echo $this->uri->segment(2) ?>';
var uri_='<?php echo $this->uri->segment(1) ?>/<?php echo $this->uri->segment(2) ?>';
$(window).on('load', function(){
	if(uri_1){$('.'+uri_1+'').addClass('submenu active'); }
});
</script>
<script>
  $(function () {
	activemenu();

  })
</script>

</body>
</html>






	