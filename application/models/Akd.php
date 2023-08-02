<?php

class Akd Extends CI_Model{ 

function __construct(){
	parent::__construct();
			$this->load->library('form_validation','session','database');
        	$this->load->helper(array('form','url'));
	}

	function standarBorang(){
		$this->db->select('*');
		$this->db->from('borang_akreditasi');
		return $data = $this->db->get();
	}
	function buktiborang($id){
		$this->db->select('*');
		$this->db->from('bukti_borang');
		$this->db->join('user','user.ID_PEGAWAI = bukti_borang.ID_PEGAWAI');
		$this->db->join('borang_akreditasi','borang_akreditasi.ID_BORANG = bukti_borang.ID_BORANG');
		$this->db->where('bukti_borang.ID_BORANG',$id);
		return $data = $this->db->get()->result();
	}
	function outdataborang($id){
		$this->db->select('*');
		$this->db->from('berkas_borang');
		$this->db->join('user','user.ID_PEGAWAI = berkas_borang.ID_PEGAWAI');
		$this->db->join('borang_akreditasi','borang_akreditasi.ID_BORANG = berkas_borang.ID_BORANG');
		$this->db->where('berkas_borang.ID_BORANG',$id);
		return $data = $this->db->get();
	}
	function arsipakademik(){
		$this->db->select('*');
		$this->db->from('bekas_akademik');
		$this->db->join('jenis_sk','jenis_sk.ID_JENIS_SK = bekas_akademik.ID_JENIS_SK');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = bekas_akademik.ID_PRODI');
		$this->db->order_by('TAHUN_AKD','DESC');
		$data = $this->db->get()->result_array();
		return $data;

	}
	function outallborang(){
		return $this->db->get('berkas_borang');
	}
	function outbuktiall(){
		return $this->db->get('bukti_borang');
	}
	function insertborang($data){
		return $this->db->insert('berkas_borang', $data);
	}
	function insertbuktiborang($data){
		return $this->db->insert('bukti_borang', $data);
	}

}

 ?>