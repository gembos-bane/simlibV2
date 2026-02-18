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
	function redudant($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = data_pkl.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->join('nama_dosen','nama_dosen.ID_NAMA_DOSEN = data_pkl.ID_NAMA_DOSEN');
		$this->db->where('data_pkl.RESPONS',$data);
		return $this->db->get()->result_array();
	}
	function delredudant($id){
		$this->db->delete('data_mahasiswa_pkl', array('ID_MHS_PKL' => $id));
	}
	function delredudantrespons($res){
		$this->db->delete('data_pkl', array('RESPONS' => $res));
	}
	function datapkl($id){
		$this->db->select('*');
		$this->db->from('data_mahasiswa_pkl');
		$this->db->where('data_mahasiswa_pkl.ID_MHS_PKL',$id);
		return $this->db->get()->result_array();
	}
	function updatePeriode($data,$id){
		$this->db->set('periode_yudisium.AKTIFASI',$data);
		$this->db->where('ID_PERIODE',$id);
		return $this->db->update('periode_yudisium');

	}
}

 ?>
