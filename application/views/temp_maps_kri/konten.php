<div class="main-panel">
	<div class="container">
                  <?php echo $this->load->view("temp_maps_kri/sidebar_right");?>
                  
                  <div id="content">
                        <div id="area_lod"></div>
                        <?php if(isset($konten)){ 
                              echo $this->load->view($konten);
                        }else{ 
                              echo "File Konten Tidak Ada";} 
                        ?>
                        
                  </div>
                             
                  <?php echo $this->load->view("temp_maps_kri/quick_bar");?>
                  <?php echo $this->load->view("temp_maps_kri/toggle");?>
      </div>
</div>

