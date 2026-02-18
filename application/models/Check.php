<?php 

class Check extends CI_MODEL{
	
	function __construct(){
	parent::__construct();
			$this->load->library('form_validation','session','database');
        	$this->load->helper(array('form','url'));
	}

	public function checkname($nip){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('NIP_PEGAWAI',$nip);
		return $this->db->get();
	}
}
?>