<?php

class Yudisium Extends CI_Model{ 

	function __construct(){
	parent::__construct();
			$this->load->library('form_validation','session','database');
        	$this->load->helper(array('form','url'));
	}
	public function checkname($nama, $field_value, $table_name) {
        $this->db->where($field_name, $field_value);
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) {
            return true; // Field exists
        } else {
            return false; // Field does not exist
        }
    }
	function yudisiumpjk($idprodi, $idperiode){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('kaprodi','kaprodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('syarat_yudi_pajak','syarat_yudi_pajak.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->where('daftar_yudisium.ID_PRODI',$idprodi);
		$this->db->where('daftar_yudisium.ID_PERIODE',$idperiode);	
		return $this->db->get();
	}
	function yudisiummp($idprodi, $idperiode){
		$this->db->select('*');
		$this->db->from('daftar_yudisium');
		$this->db->join('user','user.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('periode_yudisium','periode_yudisium.ID_PERIODE = daftar_yudisium.ID_PERIODE');
		$this->db->join('kaprodi','kaprodi.ID_PRODI = daftar_yudisium.ID_PRODI');
		$this->db->join('syarat_yudi_mp','syarat_yudi_pajak.ID_PEGAWAI = daftar_yudisium.ID_PEGAWAI');
		$this->db->where('daftar_yudisium.ID_PRODI',$idprodi);
		$this->db->where('daftar_yudisium.ID_PERIODE',$idperiode);	
		return $this->db->get();
	}
	function updatedatayudisium($data,$id){
		$this->db->update('daftar_yudisium',$data,array('ID_DAFTAR_YUDISIUM' => $id));
	}
	function updatesyaratpjk($data,$id){
		$this->db->where('ID_SYARAT_YUDI',$id);
		$this->db->update('syarat_yudi_pajak',$data);
	} 
	function updatesyaratmp($data,$id){
		$this->db->where('ID_SYARAT_YUDI_MP',$id);
		$this->db->update('syarat_yudi_mp',$data);
	} 
	function update_bukti($data,$id){
		$this->db->update('bukti_yudisium',$data,array('ID_PEGAWAI'=>$id));
	}
	function checkyudi($id){
		$data = $this->db->get_where('daftar_yudisium',array('ID_PEGAWAI'=> $id));
		return $data;
	}


}

?>