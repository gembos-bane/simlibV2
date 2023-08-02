<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of First
 *
 * @author D4 MB
 */
class First extends CI_Model{
    //put your code here
    protected $table = 'data_simlib';
    function __construct(){
        parent::__construct();
            $this->load->library('form_validation','session','database');
            $this->load->helper(array('form','url'));
        
    }
    function insertUser($account){
        $this->db->insert('login',$account);
    }
    function checkData($user, $pass){
        
        $this->db->select('ID_RULE');
        $this->db->from('login');
        $this->db->Where('LOGIN_USER',$user);
        $this->db->Where('LOGIN_PASS',$pass);
        $OUT = $this->db->get();
        return $OUT;
    }
    function checkProd($id){
        
        $this->db->select('*');
        $this->db->from('log_pas_rule');
        $this->db->Where('ID_RULE',$id);
        $in = $this->db->get()->row();
        return $in;
    }
    function prodi(){
        $this->db->select('*');
        $this->db->from('log_pas_rule');
        $data = $this->db->get()->result();
        return $data;
    }
    function nama_prodi(){
        $this->db->select('*');
        $this->db->from('data_prodi');
        $data_prodi = $this->db->get()->result();
        return $data_prodi;
    }
    function hasing($user, $pass){
        $this->db->select('HASH_LOG');
        $this->db->from('login');
        $this->db->Where('LOGIN_USER',$user);
        $this->db->Where('LOGIN_PASS',$pass);
        $data = $this->db->get();
        return $data;

    }
    function selectId($username){
        $this->db->select('ID_LOGIN');
        $this->db->from('login');
        $this->db->where('LOGIN_USER', $username);
        $id = $this->db->get();
        return $id;
    }
    function insertPegawai($datuser){
        $this->db->insert('user',$datuser);
    }
    function insertDataPegawai($datapegawai){
        $this->db->insert('data_pegawai',$datapegawai);
    }
    function uploadberkassk($berkas){
        $this->db->insert('berkas_pegawai',$berkas);
    }
    function outberkas($id){
    
        $this->db->select('*');
        $this->db->from('berkas_pegawai');
        $this->db->where('ID_PEGAWAI',$id);
        $data = $this->db->get()->result_array();
        return $data;
    }
    function UpdateUser($data,$id){
        $this->db->where('ID_PEGAWAI',$id);
        $this->db->update('user',$data);
    }
    function insertdatapengmas($data){
        $this->db->insert('pengmas',$data);
    }
    function selectpengmas($id){
        $this->db->select('*');
        $this->db->from('pengmas');
        $this->db->where('ID_PEGAWAI',$id);
        $data = $this->db->get()->result_array();
        return $data;
    }
    function insertdatapenelitian($data){
        $this->db->insert('penelitian',$data);
    }
    function selectpenelitian($id){
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->where('ID_PEGAWAI',$id);
        $data = $this->db->get()->result_array();
        return $data;
    }
    function insertserdos($data){
        $this->db->insert('serdos',$data);
    }
    function selectserdos($id){
        $this->db->select('*');
        $this->db->from('serdos');
        $this->db->where('ID_PEGAWAI',$id);
        $data = $this->db->get()->result_array();
        return $data;
    }
    function dataakademik(){
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->join('jenis_sk', 'jenis_sk.ID_JENIS_SK = bekas_akademik.ID_JENIS_SK');
        $data = $this->db->get()->result_array();
        return $data;
    }
    function dataakademikprodi($id){
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->join('jenis_sk', 'jenis_sk.ID_JENIS_SK = bekas_akademik.ID_JENIS_SK');
        $this->db->where('ID_PRODI',$id);
        $data = $this->db->get()->result_array();
        return $data;
    }
    function persuratan($id){
        $this->db->select('*');
        $this->db->from('jenis_surat');
        $this->db->join('persuratan', 'persuratan.ID_JENIS_SURAT = jenis_surat.ID_JENIS_SURAT');
        $this->db->where('ID_PRODI',$id);
        $data = $this->db->get()->result_array();
        return $data;
    }
    function persuratandep($id){
        $this->db->select('*');
        $this->db->from('jenis_surat');
        $this->db->join('persuratan', 'persuratan.ID_JENIS_SURAT = jenis_surat.ID_JENIS_SURAT');
        $this->db->join('data_prodi','data_prodi.ID_PRODI = persuratan.ID_PRODI');
        $this->db->where('ID_PENGIRIM',$id);
        $data = $this->db->get()->result_array();
        return $data;
    }
    function searchsurat($id,$idsurat){
        $this->db->select('*');
        $this->db->from('persuratan');
        $this->db->where('ID_JENIS_SURAT',$idsurat);
        $this->db->where('ID_PRODI',$id);
        $data = $this->db->get()->result_array();
        return $data;
    }
    function suratdepartemen($id,$idsurat){
        $this->db->select('*');
        $this->db->from('persuratan');
        $this->db->join('data_prodi','data_prodi.ID_PRODI = persuratan.ID_PRODI');
        $this->db->where('ID_JENIS_SURAT',$idsurat);
        $this->db->where('ID_PENGIRIM',$id);
        $data = $this->db->get()->result_array();
        return $data;
    }
    function outsemester(){
        $this->db->select('*');
        $this->db->from('semester');
        $data = $this->db->get()->result();
        return $data;
    }
    function outtahunakd(){
        $this->db->select('*');
        $this->db->from('tahun_akadaemik');
        $data = $this->db->get()->result();
        return $data;
    }
    function outjenissk(){
        $this->db->select('*');
        $this->db->from('jenis_sk');
        $data = $this->db->get()->result();
        return $data;
    }
    function outjenissk1(){
        $this->db->select('*');
        $this->db->from('jenis_sk');
        $data = $this->db->get()->result_array();
        return $data;
    }
    function outsk($idjenissk){
        $this->db->select('JENIS_SK');
        $this->db->from('jenis_sk');
        $this->db->where('ID_JENIS_SK',$idjenissk);
        $data = $this->db->get()->result();
        return $data;
    }
    function outjenissurat(){
        $this->db->select('*');
        $this->db->from('jenis_surat');
        $data = $this->db->get()->result();
        return $data;
    }
    function insertsurat($data){
        $this->db->insert('persuratan',$data);
    }
    function insertdatask($data){
        $this->db->insert('bekas_akademik',$data);
    }

    function outskmengajar($data){
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->where('ID_JENIS_SK',$data);
        $outdata = $this->db->get()->result_array();
        return $outdata;
    }

    function outskpjmk($data){
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->where('ID_JENIS_SK',$data);
        $outdata = $this->db->get()->result_array();
        return $outdata;
    }
    function outskdosenwali($data){
    
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->where('ID_JENIS_SK',$data);
        $outdata = $this->db->get()->result_array();
        return $outdata;
    }
    function outskta($data){
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->where('ID_JENIS_SK',$data);
        $outdata = $this->db->get()->result_array();
        return $outdata;
    }
    function outskploting($data){
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->where('ID_JENIS_SK',$data);
        $outdata = $this->db->get()->result_array();
        return $outdata;
    }
    function outskmagang($data){
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->where('ID_JENIS_SK',$data);
        $outdata = $this->db->get()->result_array();
        return $outdata;
    }
    function inserthash($hash){
        $this->db->insert('has_log_pass',$hash);
    }
    function outnamaprodi($data){
        $this->db->select('NAMA_PRODI');
        $this->db->from('data_prodi');
        $this->db->where('ID_PRODI',$data);
        $outdata = $this->db->get()->result();
        return $outdata;
    }
    function insertdatamhs($data){
        $this->db->insert('mahasiswa',$data);
    }
    function selectprestasi($id){
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->where('ID_PEGAWAI',$id);
        $data = $this->db->get()->result_array();
    }
    function outidsk($namask,$id){
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->join('jenis_sk','jenis_sk.ID_JENIS_SK  = bekas_akademik.ID_JENIS_SK');
        $this->db->where('JENIS_SK',$namask);
        $this->db->where('ID_PRODI',$id);
        return $this->db->get()->result_array();

    }
    function outidsk1($data){
        $this->db->select('*');
        $this->db->from('bekas_akademik');
        $this->db->join('jenis_sk','jenis_sk.ID_JENIS_SK  = bekas_akademik.ID_JENIS_SK');
        $this->db->where($data);
        return $this->db->get()->result_array();

    }
    function outsearch($data){
        $this->db->select('*');
        $this->db->from('jenis_sk');
        $this->db->join('bekas_akademik','bekas_akademik.ID_JENIS_SK  = jenis_sk.ID_JENIS_SK');
        $this->db->where($data);
        return $this->db->get()->result_array();
    }
    function editsurat($data, $id){
        $this->db->replace('persuratan',$data);
        return $this->db->where('ID_SURAT', $id);
    }
}