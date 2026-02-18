<?php

class Mahasiswa Extends CI_Model{ 

function __construct(){
	parent::__construct();
			$this->load->library('form_validation','session','database');
        	$this->load->helper(array('form','url'));
	}
	function insertbuktiterima($data){
		return $this->db->insert('bukti_perusahaan',$data);
	}
	function insertpkl($data){
		return $this->db->insert('data_pkl',$data);
	}
	function insertpklkelompok($entry){
		return $this->db->insert('data_mahasiswa_pkl',$entry);
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
	function insertambildata($data){
		return $this->db->insert('ambil_data',$data);
	}
	function buktiyudisium($data){
		return $this->db->insert('bukti_yudisium',$data);
	}
	function daftar_yudisium($data){
		return $this->db->insert('daftar_yudisium',$data);
	}
	function insertsyaratyudipajak($data){
		return$this->db->insert('syarat_yudi_pajak',$data);
	}
	function insertsyaratyudimp($data){
		return$this->db->insert('syarat_yudi_mp',$data);
	}
	function setperiode(){
		$this->db->select('*');
		$this->db->from('periode_yudisium');
		return $data = $this->db->get()->result();
	}
	function fixyudisium($id,$status){
		
		$data = array(
			'PROSES' =>$status
		);
		$this->db->where('daftar_yudisium.ID_PEGAWAI',$id);
		return $this->db->update('daftar_yudisium',$data);
	}
	function selectidperiode($periode){
		$this->db->select('*');
		$this->db->from('periode_yudisium');
		$this->db->where('periode_yudisium.TGL_PERIODE',$periode);
		return $this->db->get()->result();
	}
	function insertmember($data){
		return $this->db->insert('member_yudisium',$data);
	}

	function updatePesanyudisium($id,$pesan){
		$dataup = array(
			'PESAN' => $pesan
		);
		$this->db->where('bukti_yudisium.ID_PEGAWAI',$id);
		return $this->db->update('bukti_yudisium',$dataup);
	}
	function daftaryudisium($id){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->where('daftar_yudisium.ID_PRODI',$id);
		return $data = $this->db->get();
	}
	function reportYudisium($id,$idperiode){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->where('daftar_yudisium.ID_PRODI',$id);
		$this->db->where('daftar_yudisium.ID_PERIODE',$idperiode);
		$this->db->order_by('daftar_yudisium.ID_PERIODE','DESC');
		return $this->db->get();

	}
	function reportmahasiswayudisium($id){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->where('daftar_yudisium.ID_PEGAWAI',$id);
		return $this->db->get()->result_array();
	}
	function choutbukti($idpegawai){
		$this->db->select('*');
		$this->db->from('bukti_yudisium');
		$this->db->where('bukti_yudisium.ID_PEGAWAI',$idpegawai);
		return $data = $this->db->get()->result_array();
	}
	function outyudisiummhs($id,$proses){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->where('daftar_yudisium.ID_PEGAWAI',$id);
		$this->db->where('daftar_yudisium.PROSES',$proses);
		return $this->db->get();

	}
	function outyudisiummhspjk($id,$proses){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('syarat_yudi_pajak','syarat_yudi_pajak.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->where('daftar_yudisium.ID_PEGAWAI',$id);
		$this->db->where('daftar_yudisium.PROSES',$proses);
		return $this->db->get();

	}
	function outyudisiummhsmp($id,$proses){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('syarat_yudi_mp','syarat_yudi_mp.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->where('daftar_yudisium.ID_PEGAWAI',$id);
		$this->db->where('daftar_yudisium.PROSES',$proses);
		return $this->db->get();

	}
	function periodeaktiv($aktif){
		$this->db->select('*');
		$this->db->from('periode_yudisium');
		$this->db->where('periode_yudisium.AKTIFASI',$aktif);
		return $this->db->get()->result();
	}
	function setexcel($idprodi,$idperiode){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('kaprodi','kaprodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->where('daftar_yudisium.ID_PRODI',$idprodi);
		$this->db->where('daftar_yudisium.ID_PERIODE',$idperiode);	
		return $this->db->get();
	}
	function countprosesyudisium($x,$idprod){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE=daftar_yudisium.ID_PERIODE');
		$this->db->where('daftar_yudisium.PROSES',$x);
		$this->db->where('daftar_yudisium.ID_PRODI',$idprod);
		return $this->db->get();
	}
	function countmagang($id){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->where('data_pkl.ID_PEGAWAI',$id);
		return $this->db->get();
	}
	function controlmagang($idprodi){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = data_pkl.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->join('nama_dosen','nama_dosen.ID_NAMA_DOSEN = data_pkl.ID_NAMA_DOSEN');
		$this->db->where('data_pkl.ID_PRODI',$idprodi);
		$this->db->where('data_pkl.ID_TAHUN_AKD','9');
		$this->db->order_by('data_mahasiswa_pkl.NAMA_MHS','desc');
		return $this->db->get()->result_array();
	}
	function downberkas($id){
		$this->db->select('*');
		$this->db->from('berkas_mahasiswa');
		$this->db->where('berkas_mahasiswa.ID_DATA_PKL',$id);
		return $this->db->get()->result();
	}
	function datauser($idpegawai){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('ID_PEGAWAI',$idpegawai);
		return $this->db->get()->result();
	}
	function countnim($nimcheck){
		$this->db->select('*');
		$this->db->from('data_mahasiswa_pkl');
		$this->db->where('data_mahasiswa_pkl.NIM_MHS',$nimcheck);
		return $this->db->get();
	}
	function outbukti($id){
		$this->db->select('*');
		$this->db->from('bukti_perusahaan');
		$this->db->where('bukti_perusahaan.ID_DATA_PKL',$id);
		return $this->db->get()->result();
	}
	function outpaamagang($idprod){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = data_pkl.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->join('nama_dosen','nama_dosen.ID_NAMA_DOSEN = data_pkl.ID_NAMA_DOSEN');
		$this->db->where('data_pkl.ID_PRODI',$idprod);
		return $this->db->get()->result_array();
	}
	function outpengajuanprodi($idprod){
		$this->db->select('*');
		$this->db->from('ambil_data');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = ambil_data.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = ambil_data.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = ambil_data.ID_PRODI');
		$this->db->join('departemen','departemen.ID_DEPARTEMEN = ambil_data.ID_DEPARTEMEN');
		$this->db->where('ambil_data.ID_PRODI',$idprod);
		return $data = $this->db->get()->result_array(); 
	}
	function prosesberkas($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		//$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->join('nama_dosen','nama_dosen.ID_NAMA_DOSEN = data_pkl.ID_NAMA_DOSEN');
		$this->db->join('departemen','departemen.ID_DEPARTEMEN = data_pkl.ID_DEPARTEMEN');
		$this->db->join('semester','semester.ID_SEMESTER = data_pkl.ID_SEMESTER');
		$this->db->join('tahun_akadaemik','tahun_akadaemik.ID_TAHUN_AKD = data_pkl.ID_TAHUN_AKD');
		$this->db->where('data_pkl.ID_DATA_PKL',$data);
		return $data = $this->db->get()->result_array(); 
	}
	function settahunakd($thn){
		$this->db->select('ID_TAHUN_AKD');
		$this->db->from('tahun_akadaemik');
		$this->db->where('TAHUN_AKADEMIK_SET',$thn);
		return $this->db->get();
	}
	function pesan($data){
		return $this->db->insert('mailing',$data);
	}
	function uploadmagang($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = data_pkl.ID_PEGAWAI');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->where('data_mahasiswa_pkl.ID_MHS_PKL',$data);
		return $dataex = $this->db->get()->result_array(); 
	}
	function autosearch($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = data_pkl.ID_PEGAWAI');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->where('data_mahasiswa_pkl.NAMA_MHS',$data);
		return $dataex = $this->db->get()->result_array(); 
	}
	
	function pengambilandata($id){
		$this->db->select('*');
		$this->db->from('ambil_data');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = ambil_data.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = ambil_data.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = ambil_data.ID_PRODI');
		$this->db->join('departemen','departemen.ID_DEPARTEMEN = ambil_data.ID_DEPARTEMEN');
		$this->db->where('ambil_data.ID_AMBIL_DATA',$id);
		return $data = $this->db->get()->result_array(); 
	}
	function prosespengambilandata($id){
		$this->db->select('*');
		$this->db->from('ambil_data');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = ambil_data.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = ambil_data.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = ambil_data.ID_PRODI');
		$this->db->join('departemen','departemen.ID_DEPARTEMEN = ambil_data.ID_DEPARTEMEN');
		$this->db->where('ambil_data.ID_AMBIL_DATA',$id);
		return $data = $this->db->get()->result_array(); 
	}
	function pengambilandatapdf($id){
		$this->db->select('*');
		$this->db->from('ambil_data');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = ambil_data.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = ambil_data.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = ambil_data.ID_PRODI');
		$this->db->join('departemen','departemen.ID_DEPARTEMEN = ambil_data.ID_DEPARTEMEN');
		$this->db->where('ambil_data.ID_AMBIL_DATA',$id);
		return $data = $this->db->get()->result_array(); 
	}
	function prosesberkasberkelompok($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->join('departemen','departemen.ID_DEPARTEMEN = data_pkl.ID_DEPARTEMEN');
		$this->db->join('nama_dosen','nama_dosen.ID_NAMA_DOSEN = data_pkl.ID_NAMA_DOSEN');
		$this->db->join('semester','semester.ID_SEMESTER = data_pkl.ID_SEMESTER');
		$this->db->join('tahun_akadaemik','tahun_akadaemik.ID_TAHUN_AKD = data_pkl.ID_TAHUN_AKD');
		$this->db->where('data_pkl.ID_DATA_PKL',$data);
		return $data = $this->db->get()->result_array(); 
	}
	function pengajuanberkelompok($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		//$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->join('departemen','departemen.ID_DEPARTEMEN = data_pkl.ID_DEPARTEMEN');
		$this->db->join('nama_dosen','nama_dosen.ID_NAMA_DOSEN = data_pkl.ID_NAMA_DOSEN');
		$this->db->join('semester','semester.ID_SEMESTER = data_pkl.ID_SEMESTER');
		$this->db->join('tahun_akadaemik','tahun_akadaemik.ID_TAHUN_AKD = data_pkl.ID_TAHUN_AKD');
		$this->db->where('data_pkl.ID_DATA_PKL',$data);
		return $data = $this->db->get()->result_array(); 
	}
	function prosesdatapkl($data){
		$this->db->select('*');
		$this->db->from('data_mahasiswa_pkl');
		$this->db->join('data_pkl','data_pkl.ID_DATA_PKL = data_mahasiswa_pkl.ID_DATA_PKL');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_mahasiswa_pkl.ID_PRODI');
		$this->db->where('data_mahasiswa_pkl.ID_DATA_PKL',$data);
		return $data = $this->db->get()->result_array(); 
	}
	function pklprodi($id){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_mahasiswa_pkl.ID_PRODI');
		$this->db->join('departemen','departemen.ID_DEPARTEMEN = data_pkl.ID_DEPARTEMEN');
		$this->db->join('semester','semester.ID_SEMESTER = data_pkl.ID_SEMESTER');
		$this->db->join('tahun_akadaemik','tahun_akadaemik.ID_TAHUN_AKD = data_pkl.ID_TAHUN_AKD');
		$this->db->where('data_pkl.ID_DATA_PKL',$id);
		return $this->db->get()->result_array();
	}
	function revisidatapkl($pesan){
		return $this->db->update('bukti_yudisium','PESAN' -> $pesan);
	}
	function pesanyudisium($pesan,$id){
		$this->db->set('bukti_yudisium.PESAN',$pesan);
		$this->db->where('bukti_yudisium.ID_BUKTI_YUDISIUM',$id);
		return $this->db->update('bukti_yudisium');
	}
	function revisiresyudi($respon,$id){
		$this->db->set('daftar_yudisium.PROSES',$respon);
		$this->db->where('daftar_yudisium.ID_PEGAWAI',$id);
		return $this->db->update('daftar_yudisium');
	}
	function delmhspkl($id){
		$this->db->where('data_pkl.ID_DATA_PKL',$id);
		return $this->db->delete('data_pkl');
	}
	function delmhssecond($id){
		$this->db->where('data_mahasiswa_pkl.ID_DATA_PKL',$id);
		return $this->db->delete('data_mahasiswa_pkl');
	}
	function reportmhs($idpegawai){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('mailing','mailing.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->where('data_pkl.ID_PEGAWAI',$idpegawai);
		return $data = $this->db->get()->result_array(); 
	}
	function insertmailing($datamail){
		return $this->db->insert('mailing',$datamail);
	}
	function reportadminfak($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = data_pkl.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->where('data_pkl.RESPONS',$data);
		return $data = $this->db->get()->result_array(); 
	}
	function reportambildata($data){
		$this->db->select('*');
		$this->db->from('ambil_data');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = ambil_data.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = ambil_data.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = ambil_data.ID_PRODI');
		$this->db->where('ambil_data.STATUS_PROSES',$data);
		return $data = $this->db->get()->result_array(); 
	}
	function departemen(){
		$this->db->select('*');
		$this->db->from('departemen');
		return $this->db->get()->result();
	}
	function setdepartemen($id){
		$this->db->select('*');
		$this->db->from('departemen');
		$this->db->where('departemen.ID_DEPARTEMEN',$id);
		return $this->db->get()->result();
	}
	
	function namadosen($id){
		$this->db->select('*');
		$this->db->from('nama_dosen');
		$this->db->where('ID_PRODI',$id);
		return $this->db->get()->result_array();
	}
	function insertskripsi($data){
		return $this->db->insert('skripsi_mhs', $data);
	}
	function selectdatapkl($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->where('ID_PEGAWAI',$data);
		return $this->db->get()->result();
	}
	function skripsiprodi($id){
		$this->db->select('*');
		$this->db->from('skripsi_mhs');
		$this->db->join('user','user.ID_PEGAWAI = skripsi_mhs.ID_PEGAWAI');
		$this->db->where('skripsi_mhs.ID_PRODI', $id);
		return $this->db->get()->result_array();
	}
	function outskripsi($id){
		$this->db->select('*');
		$this->db->from('skripsi_mhs');
		$this->db->join('user','user.ID_PEGAWAI= skripsi_mhs.ID_PEGAWAI');
		$this->db->where('skripsi_mhs.ID_PEGAWAI',$id);
		return $this->db->get()->result_array();
	}
	function outdataprodi($data){
		$this->db->select('ID_PRODI');
		$this->db->from('user');
		$this->db->where('ID_PEGAWAI', $data);
		return $this->db->get();
	}
	function prodi($id){
		$this->db->select('NAMA_PRODI');
		$this->db->from('data_prodi');
		$this->db->where('data_prodi.ID_PRODI',$id);
		return $this->db->get()->result();
	}
	function updatedatapkl($up,$id){
		$data = array(
			'RESPONS' =>$up
		);
		$this->db->where('data_pkl.ID_DATA_PKL',$id);
		return $this->db->update('data_pkl',$data);
	}
	function uploadberkasmhs($data){
		return $this->db->insert('berkas_mahasiswa',$data);
	}
	function updateberkas($up){
		return $this->db->replace('data_pkl','RESPONS'->$up);
	}
	function updatemailing($pesan,$idberkas){
		$data = array(
			'MAILING' => $pesan
		);
		$this->db->where('mailing.ID_DATA_PKL',$idberkas);
		return $this->db->update('mailing',$data);
	}
	function updateambildata($up,$id){
		$data = array(
			'STATUS_PROSES' =>$up
		);
		$this->db->where('ambil_data.ID_AMBIL_DATA',$id);
		return $this->db->update('ambil_data',$data);
	}
	function countmg($id){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->where('data_pkl.ID_PEGAWAI',$id);
		return $this->db->get();
	}
	function desctgl($id){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->where('data_pkl.ID_PEGAWAI',$id);
		$this->db->order_by('TANGGAL_MHS_INPUT','DESC');
		$this->db->limit(1);
		return $this->db->get();

	}
	function countmsg($id){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('mailing','mailing.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->where('data_pkl.ID_PEGAWAI', $id);
		return $this->db->get();
	}
	function countmsgdel($idpkl){
		$this->db->where('mailing.ID_DATA_PKL',$idpkl);
		return $this->db->delete('mailing');
	}
	/*tes looping data count yudisium */

	function countperiode(){
		$this->db->select('*');
		$this->db->from('periode_yudisium');
		return $this->db->get();
	}
	function periodeout(){
		$this->db->select('*');
		$this->db->from('periode_yudisium');
		$this->db->join('semester','semester.ID_SEMESTER = periode_yudisium.ID_SEMESTER');
		$this->db->join('member_yudisium','member_yudisium.ID_PERIODE = periode_yudisium.ID_PERIODE');
		//$this->db->where('daftar_yudisium.ID_PRODI',$prodi);
		$this->db->order_by('periode_yudisium.ID_PERIODE','ASC');
		return $data = $this->db->get();
	}
	function daftaryudisiumtest($id,$idperiode){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->where('daftar_yudisium.ID_PRODI',$id);
		$this->db->where('daftar_yudisium.ID_PERIODE',$idperiode);
		return $data = $this->db->get();
	}
	function countprosesyudisiumtest($idprod,$idperiode){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE=daftar_yudisium.ID_PERIODE');
		$this->db->where('daftar_yudisium.ID_PRODI',$idprod);
		$this->db->where('daftar_yudisium.ID_PERIODE',$idperiode);
		return $this->db->get();
	}
	function semester(){
		$this->db->select('*');
		$this->db->from('semester');
		return $this->db->get()->result_array();
	}
	function insertperiode($data){
		return $this->db->insert('periode_yudisium',$data);
	}
	function checknim($nim){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('daftar_yudisium','daftar_yudisium.ID_PEGAWAI = user.ID_PEGAWAI');
		$this->db->where('user.NIP_PEGAWAI',$nim);
		return $this->db->get();
	}
	function checkoutyudisiummhs($idmhs){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('member_yudisium','member_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->where('daftar_yudisium.ID_PEGAWAI',$idmhs);
		return $this->db->get()->result_array();
	}
	function getupdatayudimhspjk($id){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('member_yudisium','member_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('syarat_yudi_pajak','syarat_yudi_pajak.ID_PEGAWAI=daftar_yudisium.ID_PEGAWAI');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->where('daftar_yudisium.ID_DAFTAR_YUDISIUM',$id);
		return $this->db->get()->result_array();
	}
	function getupdateyudimhsmp($id){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('member_yudisium','member_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('syarat_yudi_mp','syarat_yudi_mp.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->where('daftar_yudisium.ID_DAFTAR_YUDISIUM',$id);
		return $this->db->get()->result_array();
	}
	function getupdateyudimhs($id){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('member_yudisium','member_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->where('daftar_yudisium.ID_DAFTAR_YUDISIUM',$id);
		return $this->db->get()->result_array();
	}
	function checkoutyudisiummhspjk($idmhs){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('member_yudisium','member_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('syarat_yudi_pajak','syarat_yudi_pajak.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->where('daftar_yudisium.ID_PEGAWAI',$idmhs);
		return $this->db->get()->result_array();
	}
	function checkoutyudisiummhsmp($idmhs){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('bukti_yudisium','bukti_yudisium.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('member_yudisium','member_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('syarat_yudi_mp','syarat_yudi_mp.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->where('daftar_yudisium.ID_PEGAWAI',$idmhs);
		return $this->db->get()->result_array();
	}
	function countdaftaryudis($id){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->where('daftar_yudisium.ID_PERIODE',$id);
		return $this->db->get()->num_rows();
	}
	function updatemember($data,$id){
		$this->db->where('ID_PERIODE',$id);
		return $this->db->update('member_yudisium',$data);
	}
}
