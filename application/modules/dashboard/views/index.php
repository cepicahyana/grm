<?php 
$levelsession=$this->session->userdata("level");
if($levelsession=='2'){
  	echo $this->load->view('dashboard_admin');
}elseif($levelsession=='3'){
	echo $this->load->view('dashboard_kri');
}

?>