<div class="wrapper wrapper-login wrapper-login-full p-0">

<?php 
if(isset($konten)){
echo $this->load->view($konten); 
}else{	echo "File Konten Tidak Ada";}; ?>
