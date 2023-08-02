<?php

class DataEx Extends CI_Model{
	
	function __construct(){

		parent::__construct();
			$this->load->library('form_validation','session','database');
        	$this->load->helper(array('form','url'));
		
	}

	function UserSearch(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('login','login.ID_LOGIN = user.ID_LOGIN');
		$this->db->join('log_pas_rule','log_pas_rule.ID_RULE = login.ID_RULE');
		$data = $this->db->get()->result();
		return $data;
	}
	function UserProfile($user){
		$this->db->select('ID_LOGIN');
		$this->db->from('login');
		$this->db->where('LOGIN_USER',$user);
		$data = $this->db->get()->row();
		return $data;
	}
	function allDataProfile($id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('log_pas_rule','log_pas_rule.ID_RULE = user.ID_RULE');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = user.ID_PRODI');
		$this->db->where('ID_LOGIN',$id);
		$data = $this->db->get()->result_array();
		return $data;

	}
	function datauser($id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('log_pas_rule','log_pas_rule.ID_RULE = user.ID_RULE');
		$this->db->join('login','login.ID_LOGIN = user.ID_LOGIN');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = user.ID_PRODI');
		$this->db->where('ID_PEGAWAI',$id);
		$data = $this->db->get()->result_array();
		return $data;
	}
	function updateuser($id,$data){
		$this->db->where('ID_LOGIN',$id);
		$this->db->update('login',$data);
	}
	function SelectidPegawai($nama){
        $this->db->select('ID_PEGAWAI');
        $this->db->from('user');
        $this->db->where('NAMA_PEGAWAI', $nama);
        $id = $this->db->get()->row();
        return $id;
    }
    function dataLoginUser($id){
    	$this->db->select('*');
    	$this->db->from('login');
    	$this->db->where('ID_LOGIN',$id);
    	$userdata = $this->db->get()->result_array();
    	return $userdata;
    }
    function deleteUser($id){
    	$this->db->delete('user',array('ID_LOGIN' => $id));

    }
    function deleteLogin($id){
    	$this->db->delete('login',array('ID_LOGIN' => $id));
    }
    function datauserall(){
    	$this->db->select('*');
    	$this->db->from('user');
    	$this->db->join('login','user.ID_LOGIN = login.ID_LOGIN');
    	$this->db->limit(100);
    	$outuser = $this->db->get()->result_array();
    	return $outuser;
    }
    function dataskpegawai($id){
    	$this->db->select('*');
    	$this->db->from('user');
    	$this->db->where('user.ID_PEGAWAI', $id);
    	$data = $this->db->get()->result_array();
    	return $data;
    }
    function skoutpegawai($id){
    	$this->db->select('*');
    	$this->db->from('berkas_pegawai');
    	$this->db->where('berkas_pegawai.ID_PEGAWAI', $id);
    	$data = $this->db->get()->result_array();
    	return $data;
    }
    function outdatanamaprodi($idprodi){
    	$this->db->select('NAMA_PRODI');
    	$this->db->from('data_prodi');
    	$this->db->where('ID_PRODI',$idprodi);
    	$data = $this->db->get()->result();
    	return $data;
    }
    function outdataberkas($id){
    	$this->db->select('*');
    	$this->db->from('penelitian');
    	$this->db->where('ID_PRODI',$id);
    	$data = $this->db->get()->result_array();
    	return $data;
    }
    function outdataserdos($id){
    	$this->db->select('*');
    	$this->db->from('serdos');
    	$this->db->where('ID_PRODI',$id);
    	$data = $this->db->get()->result_array();
    	return $data;
    }
    function outdatapengmas($id){
    	$this->db->select('*');
    	$this->db->from('pengmas');
    	$this->db->where('ID_PRODI',$id);
    	$data = $this->db->get()->result_array();
    	return $data;
    }
    function updatetimelog($id, $date){
    	$this->db->set('TIME_LOG', $date );
    	$this->db->where('ID_LOGIN',$id);
    	$time = $this->db->update('login');
    	return $time;
    }
    function timeactivity($timeact){
    	$this->db->insert('time_activity',$timeact);
    }
    function controlactivity(){
    	$this->db->select('*');
    	$this->db->from('time_activity');
    	$this->db->join('user', 'user.ID_LOGIN = time_activity.ID_LOGIN');
    	$this->db->join('log_pas_rule', 'log_pas_rule.ID_RULE = user.ID_RULE');
    	$this->db->order_by('ID_TIME_ACTIVITY');
    	$data = $this->db->get()->result_array();
    	return $data;
    }
    function countuseractivity(){
    	$data = $this->db->count_all('time_activity');
    	return $data;
    }
    function outmhs($id){
    	$this->db->select('*');
    	$this->db->from('mahasiswa');
    	$this->db->where('ID_PRODI',$id);
    	$mhs = $this->db->get()->result_array();
    	return $mhs;
    }
    function idpegawai($id){
    	$this->db->select('ID_PEGAWAI');
    	$this->db->from('user');
    	$this->db->where('ID_LOGIN',$id);
    	$mhs = $this->db->get()->row();
    	return $mhs;
    }
    function request($req){
		$this->db->insert('mailing',$req);
	}
	function delmailing($id){
		$this->db->delete('mailing', array('ID_MAILING'=>$id));
	}
	function updateberkas($status,$idpegawai){
		$this->db->set('STATUS',$status);
		$this->db->update('berkas_pegawai');
		$this->db->where('ID_PEGAWAI',$idpegawai);
	}
	function autopegawai($pegawai){
		$this->db->select('*');
    	$this->db->from('user');
    	$this->db->where('NAMA_PEGAWAI',$pegawai);
    	$data = $this->db->get()->result_array();
    	return $data;
	}
	function lastdata($db1, $db2){
		$this->db->select('*');
		$this->db->from($db1);
		$this->db->limit(1);
		$this->db->order_by($db2,'DESC');
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
	function requestoutmail($id){
		$this->db->select('*');
		$this->db->from('mailing');
		$this->db->where('mailing.ID_PEGAWAI',$id);
		$out = $this->db->get()->result_array();
		return $out;
	}
	function deletedata($idberkas){
		$this->db->delete('berkas_pegawai',array('ID_BERKAS'=>$idberkas));

	}
	function delberkassk($idberkas){
		$this->db->delete('bekas_akademik',array('ID_BERKAS_AKD'=>$idberkas));
	}
	function jenissurat(){
		$this->db->select('*');
		$this->db->from('jenis_surat');
		$srt = $this->db->get()->result_array();
		return $srt;
	}
	function editsurat($id){
		$this->db->select('*');
		$this->db->from('persuratan');
		$this->db->join('jenis_surat','jenis_surat.ID_JENIS_SURAT = persuratan.ID_JENIS_SURAT');
		$this->db->join('data_prodi','data_prodi.ID_PRODI = persuratan.ID_PRODI');
		$this->db->where('ID_SURAT',$id);
		$query = $this->db->get()->result_array();
		return $query;
	}
}