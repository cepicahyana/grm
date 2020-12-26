<div class="main-panel">
	<div class="container">
            
                  <div id="content">
                        
                        <?php if(isset($konten)){ 
                              echo $this->load->view($konten);
                        }else{ 
                              echo "File Konten Tidak Ada";} 
                        ?>
                  
                  </div>
            
      </div>
      <?php echo $this->load->view("temp_back/footer");?>
</div>

