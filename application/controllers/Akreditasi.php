<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Passing
 *
 * @author D4 MB
 */
class Akreditasi extends CI_Controller{
    //put your code here
    function __construct(){
        parent::__construct();
        
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $this->load->model('Akd');
        $this->load->library("form_validation","session","database","pagination");
        $this->load->helper(array('form','url'));
        if(!isset($_SERVER['HTTP_REFERER'])){
                    $this->load->helper('url');
                    redirect(site_url('Backbone/index'));
                }
       
    }
    function index(){
        
    	$this->formUi();
        $outdata['std'] = $this->Akd->standarBorang()->result();
    	$idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['data'] = $this->DataEx->datauser($idpegawai->ID_PEGAWAI);
        $outdata['borang'] = $this->Akd->standarBorang()->result();
        $countrow = $this->Akd->standarBorang()->num_rows();
    	$this->load->view('akreditasi/akreditasiUi',$outdata);
        $this->load->view('login/footer');
    }
    function borangakk(){
        
        $this->formUi();
        $id = $this->uri->segment(3,0);
        $outborang['namaborang'] = $this->uri->segment(5,0);
        $outborang['std'] = $this->Akd->standarBorang()->result();
        $outborang['berkas_borang'] = $this->Akd->outdataborang($id)->result();
        $this->load->view('akreditasi/berkasborang',$outborang);
        $this->load->view('login/footer');

    }
    function buktiborang(){
        $this->formUi();
        $outdata['std'] = $this->Akd->standarBorang()->result();
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['data'] = $this->DataEx->datauser($idpegawai->ID_PEGAWAI);
        $outdata['borang'] = $this->Akd->standarBorang()->result();
        $this->load->view('akreditasi/buktiborang',$outdata);
        $this->load->view('login/footer');
        }
    function outbuktiakk(){
        $this->formUi();
        $outborang['std'] = $this->Akd->standarBorang()->result();
        $id = $this->uri->segment(3,0);
        $outborang['namaborang'] = $this->uri->segment(5,0);
        $outborang['bukti_borang'] = $this->Akd->buktiborang($id);
        $this->load->view('akreditasi/berkasbuktiborang',$outborang);
        $this->load->view('login/footer');
    }
    
    function formUi(){

        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $_SESSION['idpegawai'] = $idpegawai->ID_PEGAWAI; 
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'], $_SESSION['rule'],$_SESSION['idpegawai']);

        	$outdata['title'] = 'simlib V2';
            $outdata['header'] = array('Profile','persuratan'); 
            $this->load->view('login/headerlog',$outdata);
            $this->load->view('login/sidebardosen',$outdata);
            $this->load->view('login/topbar',$outdata);
    }
    function uploadberkasborang(){

        $count = $this->Akd->outallborang()->num_rows();
        $front = $count + 1;
        $idstd = $this->input->post('idstandar');
        $namaborang = $this->input->post('judul');
        $komen = $this->input->post('komen');
        $idpegawai = $this->input->post('idpegawai');
        $berkas = $this->input->post('berkas');
        $tipe = $this->input->post('btnradio');
        $namafile = $front.'_'.'borangakd'.'.'.$tipe;
        $tgl = date('Y-m-d');

        $databorang = array(
            'ID_BERKAS_BORANG' => ' ',
            'ID_BORANG' => $idstd,
            'ID_PEGAWAI' => $idpegawai,
            'JUDUL_BERKAS_BORANG' => $namaborang,
            'LOKASI_BORANG' => $namafile,
            'TGL_UPDATE' => $tgl,
            'HALAMAN' => ' ',
            'KOMENTAR' => $komen,
            'FILE_TYPE' => $tipe
            );
        
        if($this->input->method() === 'post'){
            
            $config['upload_path']      = 'upload\berkasAKD';
            $config['allowed_types']    = 'pdf|doc|docx|jpeg|JPEG';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 20240; //10MB
            $config['max_width']        = 1080;
            $config['max_height']       = 1080;

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if(!$this->upload->do_upload('berkas')){
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
            }else{
                $this->upload->do_upload('berkas');
                $insertdb = $this->Akd->insertborang($databorang);
                redirect(site_url('Akreditasi/index').'/berkasborang/#'.hash('sha256',$_SESSION['user']));
            }
            
        }
    }
    function uploadbuktiborang(){
        $count = $this->Akd->outbuktiall()->num_rows();
        $front = $count + 1;
        $idstd = $this->input->post('idstandar');
        $namaborang = $this->input->post('judul');
        $komen = $this->input->post('Komen');
        $idpegawai = $this->input->post('idpegawai');
        $berkas = $this->input->post('berkas');
        $tipe = $this->input->post('btnradio');
        $namafile = $front.'_'.'buktiakd'.'.'.$tipe;
        $tgl = date('Y-m-d');
         $databorang = array(
            'ID_BUKTI_BORANG' => ' ',
            'ID_BORANG' => $idstd,
            'LINK_BUKTI' => $namafile,
            'ID_PEGAWAI' => $idpegawai,
            'TGL_UPLOAD' => $tgl,
            'KETERANGAN' => $komen,
            'JUDUL_BUKTI' => $namaborang,
            'TYPE_FILE' => $tipe
            );
        
        if($this->input->method() === 'post'){
            
            $config['upload_path']      = 'upload\buktiAKD';
            $config['allowed_types']    = 'pdf|doc|docx|JPG|JPEG|jpeg|jpg';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 20240; //10MB
            $config['max_width']        = 6000;
            $config['max_height']       = 6000;

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if(!$this->upload->do_upload('berkas')){
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
            }else{
                $this->upload->do_upload('berkas');
                $insertdb = $this->Akd->insertbuktiborang($databorang);
                redirect(site_url('Akreditasi/index').'/buktiborang/#'.hash('sha256',$_SESSION['user']));
            }
            
        }
    }
    function download(){
        $this->load->library('zip','docx','doc','pdf','jpg','JPG');
        $this->load->helper('download');
        $url = $this->uri->segment(3,0);
        $file = $this->uri->segment(4,0);
        $type = $this->uri->segment(5,0);
        //$outdata['url'] = base_url()."upload"."/".$url."/".$file;
        $path = file_get_contents(base_url()."upload"."/".$url."/".$file);
        $filename = $url.'_'.'akd'.'.'.$type;
        $this->formUi();
        $outdata = force_download($filename,$path);
        $this->load->view('akreditasi/sucses');
        $this->load->view('login/footer');
    }
    
 }