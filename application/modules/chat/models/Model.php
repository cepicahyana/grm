<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends ci_Model
{
 
	public function __construct() {
        parent::__construct();
    }
	function idu(){
			return $this->session->userdata("id");
	}
	function callChat(){
		$this->db->where("display",0);
		$this->db->where("(id_receiver='".$this->idu()."' )");
		return $this->db->get("data_chat")->row();
	 
	} 
	function lastChat(){
		$id_receiver = $this->input->post("id_kri");
		$id_sender   = $this->idu();
		$msg		 = $this->input->post("msg");
		$group_tgl	 = date("Y-m-d H:i");
		
		$this->db->where("(id_sender='".$id_sender."' and id_receiver='".$id_receiver."' )");
		//$this->db->where("substr(tgl,1,16)",$group_tgl);
		 $this->db->limit(1);
		 $this->db->order_by("tgl","DESC");
		return $this->db->get("data_chat")->result();
		
	}function lastChatKri(){
		$id_sender	   = $this->input->post("id_sender");
		$id_receiver   = $this->idu();
		$msg		   = $this->input->post("msg");
		 
		$this->db->where("(id_sender='".$id_sender."' and id_receiver='".$id_receiver."' )");
		 
		 $this->db->limit(1);
		 $this->db->order_by("tgl","DESC");
		return $this->db->get("data_chat")->result();
		
	}function chatReplay(){
		$id_receiver = $this->input->post("id_kri");
		$id_sender   = $this->idu();
		$msg		 = $this->input->post("msg");
		$group_tgl	 = date("Y-m-d H:i");
		
		$this->db->where("(id_sender='".$id_receiver."' and id_receiver='".$id_sender."' )");
		 $this->db->where("display",0);
		 $this->db->limit(1);
		 $this->db->order_by("tgl","DESC");
		return $this->db->get("data_chat")->result();
		
	}function chatReplayKri(){
		$id_sender     = $this->input->post("id_sender");
		$id_receiver   = $this->idu();
		$msg		   = $this->input->post("msg");
		$group_tgl	   = date("Y-m-d H:i");
		
		$this->db->where("(id_sender='".$id_sender."' and id_receiver='".$id_receiver."' )");
		 $this->db->where("display",0);
		 $this->db->limit(1);
		 $this->db->order_by("tgl","DESC");
		return $this->db->get("data_chat")->result();
		
	}function updateChatReplay(){
		$id_receiver = $this->input->post("id_kri");
		$id_sender   = $this->idu(); 
		$this->db->where("(id_sender='".$id_receiver."' and id_receiver='".$id_sender."' )");
		 $this->db->set("display",1); 
	 	return $this->db->update("data_chat");
		
	}function updateChatReplayKri(){
		$id_sender	   = $this->input->post("id_sender");
		$id_receiver   = $this->idu(); 
		$this->db->where("(id_sender='".$id_sender."' and id_receiver='".$id_receiver."' )");
		 $this->db->set("display",1); 
	  	return $this->db->update("data_chat");
		
	}function updateCallChat($id){ 
		$this->db->where("id",$id);
		 $this->db->set("display",1); 
	  	return $this->db->update("data_chat");
		
	}
	function saveChat(){
		$id_kri = $this->input->post("id_sender");
		$msg	= $this->input->post("msg");
		
		$this->db->set("id_sender",$this->idu());
		$this->db->set("id_receiver",$id_kri);
		$this->db->set("msg",$msg);
		$this->db->set("tgl",date('Y-m-d H:i:s'));
		return $this->db->insert("data_chat");
	}function saveChatKri(){
		$id_sender = $this->input->post("id_sender");
		$msg	   = $this->input->post("msg");
		
		$this->db->set("id_sender",$this->idu());
		$this->db->set("id_receiver",$id_sender);
		$this->db->set("msg",$msg);
		$this->db->set("tgl",date('Y-m-d H:i:s'));
		return $this->db->insert("data_chat");
	}
	function getSon($id_sender,$id_receiver,$group_tgl){
		$this->db->where("(id_sender='".$id_sender."' and id_receiver='".$id_receiver."' )");
		$this->db->order_by("id","asc");
		$this->db->where("substr(tgl,1,16)",$group_tgl);
		//$this->db->select("*,count(*) as jml");
		return $this->db->get("data_chat")->result();
	}
	function nama_kapal($id_sender){
	return	$this->m_global->goField("v_user","profilename","where id_admin='".$id_sender."'"); 
	}function profileimg($id_sender){
	return	$this->m_global->goField("v_user","profileimg","where id_admin='".$id_sender."'"); 
	}
	function stsAktif($id_sender){
			$date 	= date("Y-m-d H:i:s");
			$DBdate = 	$this->m_global->goField("v_user","set_aktif","where id_admin='".$id_sender."'"); 
		$selisih = $this->tanggal->hitungMenit($DBdate,$date);
											if($selisih<3){
											return	$sts="online";
											}else{
											return	$sts="offline";
											}
	}
	function getVicall(){
		$id_receiver	=	$this->input->post("id_receiver");
		$id_sender		=	$this->idu();
		$topik			=	$this->m_reff->acak(20);
		$this->db->set("id_sender",$id_sender);
		$this->db->set("sts",0);
		$this->db->set("id_receiver",$id_receiver);
		$this->db->set("topik","https://meet.jit.si/".$topik);
		$this->db->set("tgl",date('Y-m-d H:i:s'));
		return $this->db->insert("data_vicall");
	}
	
	function endVicall(){ 
		$id_sender		=	$this->idu(); 
		$this->db->where("id_sender",$id_sender); 
		return $this->db->delete("data_vicall");
	}
	function cekWaiting(){ 
		$id_sender		=	$this->idu(); 
		$this->db->order_by("id","DESC"); 
		$this->db->limit(1);  
		$this->db->where("id_sender",$id_sender); 
		return $this->db->get("data_vicall")->row();
		 
	}function cekVcKri(){ 
		$id_receiver		=	$this->idu(); 
		$this->db->order_by("id","DESC"); 
		$this->db->limit(1);  
		$this->db->where("id_receiver",$id_receiver); 
		return $this->db->get("data_vicall")->row();
		 
	}function terima_vc_kri(){ 
		$topik	=	$this->input->post("link");
		$this->db->where("topik",$topik); 
		$this->db->set("sts",1); 
		return $this->db->update("data_vicall");
		 
	}
}

?>