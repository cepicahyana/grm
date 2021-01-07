<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends ci_Model
{
	var $data_kri="data_kri";
	var $data_lantamal="data_lantamal";
	var $data_lanal="data_lanal";
	var $data_brigif="data_brigif";
	var $data_posal="data_posal";
	var $data_satrad="data_satrad";
	var $data_object="data_object";

	var $tm_iconmarker="tm_iconmarker";

	var $tracking_kri="tracking_kri";

	var $data_konlog="data_konlog";
	var $data_konis="data_konis";
	var $data_pengumuman="pengumuman";
	public function __construct() {
        parent::__construct();
    }
	
	
	/*===================================*/
	public function get_fm1()
	{
		$this->db->from($this->data_kri);
	 	return $this->db->get()->result();
	}
	public function get_fm2()
	{
		$this->db->from($this->data_lantamal);
	 	return $this->db->get()->result();
	}
	public function get_fm3()
	{
		$this->db->from($this->data_lanal);
	 	return $this->db->get()->result();
	}
	public function get_fm4()
	{
		$this->db->from($this->data_brigif);
	 	return $this->db->get()->result();
	}
	public function get_fm5()
	{
		$this->db->from($this->data_posal);
	 	return $this->db->get()->result();
	}
	public function get_fm6()
	{
		$this->db->from($this->data_satrad);
	 	return $this->db->get()->result();
	}
	public function get_fm7()
	{
		$this->db->from($this->data_lantamal);
	 	return $this->db->get()->result();
	}
	public function get_fm8()
	{
		$this->db->from($this->data_lantamal);
	 	return $this->db->get()->result();
	}
	public function get_fm9()
	{
		$this->db->from($this->data_object);
		$this->db->where('status_data!=','trash');
		$this->db->where('status_data!=','delete');
	 	return $this->db->get()->result();
	}
	


	
	/*----------tracking kri -----------
	function update_tracking_kri()
	{
		$var=array();

		/*$idu=$this->session->userdata("id");
		$id=$this->input->post("id");
		$input=$this->input->post("f");
		$datainputan=$this->security->xss_clean($input);*
		
		$lat=$this->input->post('track_lat');
		$lng=$this->input->post('track_lng');
		$tanggal=date("Y-m-d");
		$utime=date("Y-m-d H:i:s"); 
		$a[$utime] = array(
			"lat" => $lat,
			"lng" => $lng
		);	 
		$latLong=json_encode($a);

		//$tanggal_lahir=$this->input->post("tanggal_lahir");
		//$tgl_lahir=$this->tanggal->eng_($tanggal_lahir,0);
		//cek dulu
		
		$this->db->set("latlng",$latLong);
		$this->db->where("tanggal",$tanggal);
		$this->db->update($this->tracking_kri);
		$var['table']=true;
		return $var;
	}*/

	function history_range_kri()
	{
		$id=$this->session->userdata("id");
		$datenow=date('Y-m-d');
		$dateawal=$this->input->post('fdate_awal');
		$dateakhir=$this->input->post('fdate_akhir');
		$dateFisrt=$this->tanggal->eng_($dateawal,'-');
		$dateLast=$this->tanggal->eng_($dateakhir,'-');
	
		$this->db->from($this->tracking_kri);
		$this->db->where('idkri',$id);
		$this->db->where('(tanggal>="'.$dateFisrt.'" and tanggal<="'.$dateLast.'")');
		$query = $this->db->get();
		return $query;
	}
	function history_track_kri()
	{
		$id=$this->input->post("id");
		//$datenow=date('2020-12-16');
		$datenow=date('Y-m-d');
		$this->db->from($this->tracking_kri);
		$this->db->where('idkri',$id);
		$this->db->where('tanggal',$datenow);
		$query = $this->db->get();
		return $query;
	}




	/*===================================*/
	public function get_data_konlog()
	{
		$this->_get_datatables_konlog();
		if($this->input->post("length") != -1) 
		$this->db->limit($this->input->post("length"),$this->input->post("start"));
	 	return $this->db->get()->result();
	}
	private function _get_datatables_konlog()
	{	
		 //$this->db->where("level","3"); 
		 /*if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"namadata"=>$searchkey
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}*/
		$this->db->order_by("id","asc"); 
		$query=$this->db->from($this->data_konlog);
		return $query;
	
	}	
	public function count_data_konlog()
	{		
		$this->_get_datatables_konlog();
		return $this->db->get()->num_rows();
	}


	/*===================================*/
	public function get_data_konis()
	{
		$this->_get_datatables_konis();
		if($this->input->post("length") != -1) 
		$this->db->limit($this->input->post("length"),$this->input->post("start"));
	 	return $this->db->get()->result();
	}
	private function _get_datatables_konis()
	{	
		 //$this->db->where("level","3"); 
		 /*if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"namadata"=>$searchkey
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}*/
		$this->db->order_by("id","asc"); 
		$query=$this->db->from($this->data_konis);
		return $query;
	
	}	
	public function count_data_konis()
	{		
		$this->_get_datatables_konis();
		return $this->db->get()->num_rows();
	}



	/*===================================*/
	public function get_data_pengumuman()
	{
		$this->_get_datatables_pengumuman();
		if($this->input->post("length") != -1) 
		$this->db->limit($this->input->post("length"),$this->input->post("start"));
	 	return $this->db->get()->result();
	}
	private function _get_datatables_pengumuman()
	{	
		 //$this->db->where("level","3"); 
		 /*if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				  
				$query=array(
				"namadata"=>$searchkey
				);
				$this->db->group_start()
                        ->or_like($query)
                ->group_end();
				  
			}*/
		$this->db->order_by("id","asc"); 
		$query=$this->db->from($this->data_pengumuman);
		return $query;
	
	}	
	public function count_data_pengumuman()
	{		
		$this->_get_datatables_pengumuman();
		return $this->db->get()->num_rows();
	}
	

    


}
//End of file data_param.php