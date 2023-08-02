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
	function count_persuratan_dep($id){
		$data = $this->db->where('ID_PENGIRIM',$id)->get('persuratan');
		return $data->num_rows();
	}
	function get_limit_surat($limit, $start,$id){
		$this->db->select('*');
        $this->db->from('persuratan');
        $this->db->join('jenis_surat', 'jenis_surat.ID_JENIS_SURAT = persuratan.ID_JENIS_SURAT');
        $this->db->where('persuratan.ID_PRODI',$id);
		$this->db->order_by('persuratan.ID_SURAT', 'ASC');
		$this->db->limit($limit,$start);
		$data = $this->db->get()->result_array();
		return $data;
	}
	function get_limit_surat_dep($limit, $start,$id){
		$this->db->select('*');
        $this->db->from('jenis_surat');
        $this->db->join('persuratan', 'persuratan.ID_JENIS_SURAT = jenis_surat.ID_JENIS_SURAT');
        $this->db->join('data_prodi','data_prodi.ID_PRODI = persuratan.ID_PRODI');
        $this->db->where('ID_PENGIRIM',$id);
		$this->db->order_by('ID_SURAT', 'ASC');
		$this->db->limit($limit,$start);
		$data = $this->db->get()->result_array();
		return $data;
	}
	function get_count_admin(){
		$data = $this->db->get('user');
		return $data->num_rows();
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
	
}
?>