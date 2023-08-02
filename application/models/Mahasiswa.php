<?php

class Mahasiswa Extends CI_Model{ 

function __construct(){
	parent::__construct();
			$this->load->library('form_validation','session','database');
        	$this->load->helper(array('form','url'));
	}
	function insertpkl($data){
		return $this->db->insert('data_pkl',$data);
	}
	function tujuan(){
		$this->db->select('*');
		$this->db->from('tujuan');
		return $this->db->get()->result();
	}
	function iduser($nama){
		$this->db->select('ID_LOGIN');
		$this->db->from('login');
		$this->db->where('LOGIN_USER',$nama);
		return $this->db->get()->row();
	}
	function idmhs($id){
		$this->db->select('ID_PEGAWAI');
		$this->db->from('user');
		$this->db->where('ID_LOGIN',$id);
		return $this->db->get()->result();
	}
	function reportmhs($idpegawai){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->where('data_pkl.ID_PEGAWAI',$idpegawai);
		return $data = $this->db->get()->result_array(); 
	}
	function reportadminfak($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->where('RESPONS',$data);
		return $data = $this->db->get()->result_array(); 
	}
	function prosesberkas($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->where('ID_DATA_PKL',$data);
		return $data = $this->db->get()->result_array(); 
	}
	function updateberkas($up){
		return $this->db->replace('data_pkl','RESPONS'->$up);
	}
}