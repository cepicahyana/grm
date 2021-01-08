<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("super","kri","admin"));
		$this->load->model("model","mdl");		
		$this->load->model("m_global");		
		date_default_timezone_set('Asia/Jakarta');
	}
	function terima_vc_kri(){
		echo $this->mdl->terima_vc_kri();
	}function getVicall(){
		return $this->mdl->getVicall();
	}function endVicall(){
		return $this->mdl->endVicall();
	}function cekWaiting(){
		
		$data			=	$this->mdl->cekWaiting();
		$topik			=	isset($data->topik)?($data->topik):0;
		$var["link"]	= 	$topik;
		$topik			=	' 
							<iframe allow="camera; microphone; fullscreen; display-capture" src="'.$topik.'" style="height: 500px; width: 100%; border: 0px;"></iframe>
							 ';
		
		$var["sts"]		= 	$sts=isset($data->sts)?($data->sts):0;
		$var["frame"] 	=   $topik;
		if($sts==1){
			$this->db->set("sts",2);
			$this->db->where("id",$data->id);
			$this->db->update("data_vicall");
		}
		echo json_encode($var);
	}
	function cekVcKri(){
		
		$data			=	$this->mdl->cekVcKri();
		$topik			=	isset($data->topik)?($data->topik):0;
		$var["link"]	= 	$topik;
		$topik			=	' 
							<iframe allow="camera; microphone; fullscreen; display-capture" src="'.$topik.'" style="height: 500px; width: 100%; border: 0px;"></iframe>
							 ';
		$nm				=	isset($data->id_sender)?($data->id_sender):"";
		$var["nama_sender"]		= 	$this->mdl->nama_kapal($nm);
		$var["sts"]				= 	isset($data->sts)?($data->sts):0;
		$var["frame"] 			=   $topik;
		echo json_encode($var);
	}
	function getRecent(){
		$this->load->view("getRecentKri");
	}
	function idu(){
		return $this->session->userdata("id");
	}
	function callChat(){
			$db					=	$this->mdl->callChat();
			$id					=	isset($db->id)?($db->id):"";
			$id_sender			=	isset($db->id_sender)?($db->id_sender):"";
			$nama_sender		=	$this->m_global->goField("v_user","profilename","where id_admin='".$id_sender."'");
			$isi["isi"]			=	$id;
			$isi["id_sender"]	=	$id_sender;
			$isi["nama_sender"]	=	$nama_sender;
			echo json_encode($isi);
			 $this->mdl->updateCallChat($id);
	}
	function chatReplay(){
		$db		= $this->mdl->chatReplay();
		$date 	= date("Y-m-d H:i");
		$content	=	"";
		 
		foreach($db as $val){
			$group_tgl	=	substr($val->tgl,0,16);
			
			
			$content.='<div class="message-content">
							 <div class="content">
								 '.$val->msg.'
							 </div>
							 <span class="datezr"><i class="fa  fa-clock"></i> '.$group_tgl.'</span>
					   </div>';
		}
		
		$isi='
		<div class="message-content-wrapper" id="chat_group_sender" >
									<div class="message message-in">
										<div class="message-body">
											 '.$content.' 
										</div>
									</div>
								</div>
		';
		if($content){
			$var["isi"] = $isi; 
			 $this->mdl->updateChatReplay();
		}else{
			$var["isi"] = ""; 
		}
		echo json_encode($var);
		 
		
	}function chatReplayKri(){
		$db		= $this->mdl->chatReplayKri();
		$date 	= date("Y-m-d H:i");
		$content	=	"";
		 
		foreach($db as $val){
			$group_tgl	=	substr($val->tgl,0,16);
			
			
			$content.='<div class="message-content">
							 <div class="content">
								 '.$val->msg.'
							 </div>
							 <span class="datezr"><i class="fa  fa-clock"></i> '.$group_tgl.'</span>
					   </div>';
		}
		
		$isi='
		<div class="message-content-wrapper" id="chat_group_sender" >
									<div class="message message-in">
										<div class="message-body">
											 '.$content.' 
										</div>
									</div>
								</div>
		';
		if($content){
			$var["isi"] = $isi; 
			 $this->mdl->updateChatReplayKri();
		}else{
			$var["isi"] = ""; 
		}
		echo json_encode($var);
		 
		
	}
	function saveChat(){
				$this->mdl->saveChat();
		//$db	=	$this->mdl->lastChat();
		$group_tgl=$date = date("Y-m-d H:i");
		//$content	=	"";
		//$group_tgl	=	"";
		//foreach($db as $val){
			//$group_tgl	=	substr($val->tgl,0,16);
			 
			
			$content='<div class="message-content">
							 <div class="content">
								 '.$this->input->post("msg").'
							 </div>
							 <span class="datez"><i class="fa  fa-clock"></i> '.$group_tgl.'</span>
					   </div>';
		 
		$isi='
		<div class="message-content-wrapper" id="chat_group_sender" >
									<div class="message message-out">
										<div class="message-body">
											 '.$content.'
											
										</div>
									</div>
								</div>
		';
		$var["isi"] = $isi;
		
		 
		//$var["aksi"] =  $aksi;
	//	$var["groupDiv"] =  $groupDiv;
		echo json_encode($var);
		
	}
	function saveChatKri(){
				$this->mdl->saveChatKri(); 
		$group_tgl=$date = date("Y-m-d H:i");
		 	
			$content='<div class="message-content">
							 <div class="content">
								 '.$this->input->post("msg").'
							 </div>
							 <span class="datez"><i class="fa  fa-clock"></i> '.$group_tgl.'</span>
					   </div>';
		 
		
		$isi='
		<div class="message-content-wrapper" id="chat_group_sender" >
									<div class="message message-out">
										<div class="message-body">
											 '.$content.'
											
										</div>
									</div>
								</div>
		';
		$var["isi"] = $isi;
		
		 
		//$var["aksi"] =  $aksi;
	//	$var["groupDiv"] =  $groupDiv;
		echo json_encode($var);
		
	}
	public function getChat()
	{	
		$id_receiver	= $this->input->post("id");
		$nakal	= $this->m_global->goField("data_kri","profilename","where id='".$id_receiver."'");
		$this->db->where("(id_sender='".$this->idu()."' and id_receiver='".$id_receiver."' ) or (id_receiver='".$this->idu()."' and id_sender='".$id_receiver."' )");
		$this->db->order_by("tgl","asc");
		//$this->db->group_by("SUBSTR(tgl,1,16)");
		//$this->db->select("*,count(*) as jml");
		$data=$this->db->get("data_chat")->result();
		$isi	=	"";
		$group	=	"";
		foreach($data as $val){
			
			$tgl		=	$val->tgl;
			$group_tgl	=	substr($tgl,0,16);	//tgl - menit
			if($val->id_sender==$this->mdl->idu()){ 
			$content	=	"";
					 
						$content.='<div class="message-content">
												<div class="content">
													'.$val->msg.'
												</div>
													<div class="datez"><i class="fa  fa-clock"></i> '.$group_tgl.'</div>
											</div>';
					 
			
			$isi.='
				<div class="message-content-wrapper" id="chat_group_sender" >
									<div class="message message-out">
										<div class="message-body">
											 '.$content.'
										
										</div>
									</div>
								</div>
				'; 
			}else{ // balasan
				$content	=	"";
					 
								 
						$content.='<div class="message-content">
												<div class="content">
													'.$val->msg.'
												</div>
												<div class="datezr"><i class="fa fa-clock"></i> '.$group_tgl.'</div>
											</div>';
					 
			
			$isi.='
				<div class="message-content-wrapper" id="chat_group_receiver" >
									<div class="message message-in">
										<div class="message-body">
											 '.$content.'
											
										</div>
									</div>
								</div>
				'; 
				
				
			}
			
			
			 
		}
		 
		
		$var["nakal"]=$nakal;
		$var["isi"]=$isi;
		echo json_encode($var);
	} 
	
	public function getChatKri()
	{	
		$id_sender	= $this->input->post("id_sender"); 
		$this->db->where("(id_sender='".$id_sender."' and id_receiver='".$this->idu()."' ) or (id_receiver='".$id_sender."' and id_sender='".$this->idu()."' )");
		$this->db->order_by("tgl","asc"); 
		$data=$this->db->get("data_chat")->result();
		$isi	=	"";
		$group	=	"";
		foreach($data as $val){
			
			$tgl		=	$val->tgl;
			$group_tgl	=	substr($tgl,0,16);	//tgl - menit
			if($val->id_sender==$this->mdl->idu()){ 
			$content	=	"";
					 
						$content.='<div class="message-content">
												<div class="content">
													'.$val->msg.'
												</div>
													<div class="datez"><i class="fa  fa-clock"></i> '.$group_tgl.'</div>
											</div>';
					 
			
			$isi.='
				<div class="message-content-wrapper" id="chat_group_sender" >
									<div class="message message-out">
										<div class="message-body">
											 '.$content.'
										
										</div>
									</div>
								</div>
				'; 
			}else{ // balasan
				$content	=	"";
					 
								 
						$content.='<div class="message-content">
												<div class="content">
													'.$val->msg.'
												</div>
												<div class="datezr"><i class="fa fa-clock"></i> '.$group_tgl.'</div>
											</div>';
					 
			
			$isi.='
				<div class="message-content-wrapper" id="chat_group_receiver" >
									<div class="message message-in">
										<div class="message-body">
											 '.$content.'
											
										</div>
									</div>
								</div>
				'; 
				
				
			}
			
			
			 
		}
		 
		
		 
		$var["isi"]=$isi;
		echo json_encode($var);
	} 
 
	public function index()
	{	
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			$data['data']=$this->mdl->getLastKonis();
			echo $this->load->view("index",$data);
		}else{
			$data['konten']="index";
			$data['data']=$this->mdl->getLastKonis();
			$this->_template($data);
		}
		
	} 
	function set_aktif(){
		$this->db->where("id",$this->idu());
		$this->db->set("set_aktif",date("Y-m-d H:i:s"));
		$this->db->update("data_kri");
	}function set_aktif_admin(){
		$this->db->where("id_admin",$this->idu());
		$this->db->set("set_aktif",date("Y-m-d H:i:s"));
		$this->db->update("admin");
	}
	
}
