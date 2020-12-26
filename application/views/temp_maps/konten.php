<!--div class="main-panel"-->
	<!--div class="container"-->
                  <?php echo $this->load->view("temp_maps/sidebar_right");?>
                  <!--?php echo $this->load->view("temp_maps/sidebar");?-->
                  <div id="content">
                        <?php if(isset($konten)){ 
                              echo $this->load->view($konten);
                        }else{ 
                              echo "File Konten Tidak Ada";} 
                        ?>
                        
                  </div>
                             
                  <?php echo $this->load->view("temp_maps/quick_bar");?>
                  <?php echo $this->load->view("temp_maps/toggle");?>
      <!--/div-->
<!--/div-->

