<?php 

class Page Extends CI_Model{

	function __construct(){
		
		parent::__construct();
			$this->load->library('form_validation','session','database','pagination');
        	$this->load->helper(array('form','url'));
	}
	
	function get_count(){
		$query = $this->db->count_all('user');
		return $query;
	}
	function get_limit($limit, $start){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = user.ID_PRODI');
		$this->db->order_by('ID_PEGAWAI', 'ASC');
		$this->db->limit($limit,$start);
		$data = $this->db->get()->result_array();
		return $data;

	}
	function count_skprodi($id){
		$data = $this->db->where('ID_PRODI',$id)->get('bekas_akademik');
		return $data->num_rows();
	}
	function get_limitsk($limit, $start,$id){
		$this->db->select('*');
		$this->db->from('bekas_akademik');
		$this->db->join('jenis_sk','jenis_sk.ID_JENIS_SK = bekas_akademik.ID_JENIS_SK');
		$this->db->where('ID_PRODI',$id);
		$this->db->order_by('ID_BERKAS_AKD', 'ASC');
		$this->db->limit($limit,$start);
		$data = $this->db->get()->result_array();
		return $data;
	}
	function count_persuratan($id){
		$data = $this->db->where('ID_PRODI',$id)->get('persuratan');
		return $data->num_rows();
	}
	function count_yudisium($id){
		$data = $this->db->where('ID_PRODI',$id)->get('daftar_yudisium');
		return $data->num_rows();
	}
	function count_persuratan_dep($id){
		$data = $this->db->where('ID_PENGIRIM',$id)->get('persuratan');
		return $data->num_rows();
	}
	function get_limit_surat($limit,$start,$id){
		$this->db->select('*');
        $this->db->from('persuratan');
        $this->db->join('jenis_surat', 'jenis_surat.ID_JENIS_SURAT = persuratan.ID_JENIS_SURAT');
        $this->db->where('persuratan.ID_PRODI',$id);
		$this->db->order_by('persuratan.ID_SURAT', 'DESC');
		$this->db->limit($limit,$start);
		$data = $this->db->get()->result_array();
		return $data;
	}
	function get_limit_surat_dep($limit,$start,$id){
		$this->db->select('*');
        $this->db->from('jenis_surat');
        $this->db->join('persuratan', 'persuratan.ID_JENIS_SURAT = jenis_surat.ID_JENIS_SURAT');
        $this->db->join('data_prodi','data_prodi.ID_PRODI = persuratan.ID_PRODI');
        $this->db->where('ID_PENGIRIM',$id);
		$this->db->order_by('ID_SURAT', 'DESC');
		$this->db->limit($limit,$start);
		$data = $this->db->get()->result_array();
		return $data;
	}
	function get_count_admin(){
		$data = $this->db->get('user');
		return $data->num_rows();
	}
	function get_count_pengajuan($id){
		$this->db->select('*');
		$this->db->from('data_mahasiswa_pkl');
		$this->db->where('ID_PRODI',$id);
		$data = $this->db->get()->num_rows();
		return $data;
	}
	function get_limit_pengajuan($limit,$start,$id){
		$this->db->select('*');
        $this->db->from('data_mahasiswa_pkl');
        $this->db->join('data_pkl', 'data_pkl.ID_DATA_PKL = data_mahasiswa_pkl.ID_DATA_PKL');
        $this->db->join('data_prodi','data_prodi.ID_PRODI = data_mahasiswa_pkl.ID_PRODI');
        $this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
        $this->db->join('user','user.ID_PEGAWAI=data_pkl.ID_PEGAWAI');
        $this->db->where('data_pkl.ID_PRODI',$id);
		$this->db->order_by('data_pkl.ID_DATA_PKL', 'ASC');
		$this->db->limit($limit,$start);
		$data = $this->db->get()->result_array();
		return $data;
	}
	function get_limit_report_fak($limit,$start,$data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = data_pkl.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->where('data_pkl.RESPONS',$data);
		$this->db->limit($limit,$start);
		return $data = $this->db->get()->result_array(); 
	}
	function get_limit_ambil_data($limit,$start,$data){
		$this->db->select('*');
		$this->db->from('ambil_data');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = ambil_data.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = ambil_data.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = ambil_data.ID_PRODI');
		$this->db->where('ambil_data.STATUS_PROSES',$data);
		$this->db->limit($limit,$start);
		return $data = $this->db->get()->result_array(); 
	}
	function searchname($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = data_pkl.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->like('data_pkl.NAMA_PEGAWAI',$data);
		$out = $this->db->get();

		$outsearch = array();
		foreach ($out->result() as $key) {
			$outsearch[] = $key->NAMA_PEGAWAI;
		}
		return $outsearch;
	}
	function get_count_report_fak($data){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->join('data_mahasiswa_pkl','data_mahasiswa_pkl.ID_DATA_PKL = data_pkl.ID_DATA_PKL');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = data_pkl.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = data_pkl.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = data_pkl.ID_PRODI');
		$this->db->where('data_pkl.RESPONS',$data);
		$data = $this->db->get()->num_rows();
		return $data;
	}
	function get_count_report_ambil_data($data){
		$this->db->select('*');
		$this->db->from('ambil_data');
		$this->db->join('tujuan','tujuan.ID_TUJUAN = ambil_data.ID_TUJUAN');
		$this->db->join('user','user.ID_PEGAWAI = ambil_data.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = ambil_data.ID_PRODI');
		$this->db->where('ambil_data.STATUS_PROSES',$data);;
		return $data = $this->db->get()->num_rows(); 

	}
	function get_limit_admin($limit, $start){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('login','login.ID_LOGIN = user.ID_LOGIN');
		$this->db->join('log_pas_rule','log_pas_rule.ID_RULE = login.ID_RULE');
		$this->db->order_by('ID_PEGAWAI','ASC');
		$this->db->limit($limit, $start);
		$data = $this->db->get()->result();
		return $data;
	}
	function findmail($id){
		$this->db->select('*');
		$this->db->from('mailing');
		$this->db->where('ID_PEGAWAI',$id);
		$data = $this->db->get();
		return $data;
	}
	function requestmail($req){
		$this->db->insert('mailing',$req);
	}
	function outmail($id){
		$this->db->select('*');
		$this->db->from('mailing');
		$this->db->where('ID_PEGAWAI',$id);
		$data = $this->db->get()->result_array();
		return $data;
	}
	function insertnews($data){
		$this->db->insert('informasi', $data);
	}
	function showalert($id){
		$this->db->select('*');
		$this->db->from('informasi');
		$this->db->where('ID_INFORMASI', $id);
		$data = $this->db->get()->result();
		return $data;
	}
	function editsurat($id){
		$this->db->select('*');
		$this->db->from('persuratan');
		$this->db->joint('data_prodi','data_prodi.ID_PRODI = persuratan.ID_PRODI');
		$this->db->where('ID_SURAT',$id);
		$query = $this->db->get()->result_array();
		return $query;
	}
	function countinfo(){
		$this->db->select('*');
		$this->db->from('informasi');
		$data = $this->db->get();
		return $data;
	}

	function deletedata($idberkas){
		$this->db->delete('berkas_pegawai',array('ID_BERKAS'=>$idberkas));

	}
	function delberkassk($idberkas){
		$this->db->delete('bekas_akademik',array('ID_BERKAS_AKD'=>$idberkasakd));
	}
	function alertMagang($dat){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->where('RESPONS',$dat);
		$data = $this->db->get();
		return $data;
	}
	function alertambildata($dat){
		$this->db->select('*');
		$this->db->from('ambil_data');
		$this->db->where('STATUS_PROSES',$dat);
		$data = $this->db->get();
		return $data;
	}
	function alertyudisiumdep($dat){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->where('PROSES',$dat);
		$this->db->where('ID_PRODI',$idprodi);
		$data = $this->db->get();
		return $data;
	}
	function alertambildataprodi($dat,$idprodi){
		$this->db->select('*');
		$this->db->from('ambil_data');
		$this->db->where('STATUS_PROSES',$dat);
		$this->db->where('ID_PRODI', $idprodi);
		$data = $this->db->get();
		return $data;
	}
	function alertyudisium($dat,$idprodi){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->where('PROSES',$dat);
		$this->db->where('ID_PRODI',$idprodi);
		$data = $this->db->get();
		return $data;
	}
	function alertmagangprodi($dat,$idprodi){
		$this->db->select('*');
		$this->db->from('data_pkl');
		$this->db->where('RESPONS',$dat);
		$this->db->where('ID_PRODI',$idprodi);
		$data = $this->db->get();
		return $data;
	}
	function periodeaktif($aktif){
		$this->db->select('*');
		$this->db->from('periode_yudisium');
		$this->db->where('AKTIFASI',$aktif);
		return $data = $this->db->get();
	}
	function rule($id){
		$this->db->select('*');
		$this->db->from('log_pas_rule');
		$this->db->where('ID_RULE', $id);
		return $this->db->get()->result();
	}
}
?>
