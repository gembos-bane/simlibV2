<?php
class API extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('DataEx','First');
		$this->load->library('form_validation','session','database');
        $this->load->helper(array('form','url'));
    	}	

    function ApiUpload($file){

    		$namafile = $file.'_'.$tanggal . '_' . ($_SESSION['user']);
            $config['upload_path']      = 'upload\pengmas';
            $config['allowed_types']    = 'pdf';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 1024; //1MB
            $config['max_width']        = 1080;
            $config['max_height']       = 1080;

            $this->load->library('upload');
            $this->upload->initialize($config);
    }
    function controlactivity(){
        $user = $_SESSION['user'];
        if(!empty($user)){
            $this->DataEx->controlactivity();
        }
    }
    function reportarsip(){
        redirect (site_url('Home/backpass'));
    }
    function outreport(){
        $this->load->model('Akd');
        $outdata['report'] = $this->Akd->arsipakademik();
        $this->frontendui();
        $this->load->view('content/reportarsip',$outdata);
        $this->load->view('login/footer');

    }
    function printexcel(){
        $this->load->model('Akd');
        $outdata['report'] = $this->Akd->arsipakademik();
        $this->load->view('app/toexcel',$outdata);
    }
    function frontendui(){
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $_SESSION['idpegawai'] = $idpegawai->ID_PEGAWAI; 
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'], $_SESSION['rule'],$_SESSION['idpegawai']);
         if ($_SESSION['rule'] == 2){
            $outdata['title'] = 'simlib V2';
            $outdata['header'] = array('Profile','persuratan'); 
            $this->load->view('login/headerlog',$outdata);
           }
            elseif ($_SESSION['rule'] == 4){
                $outdata['title'] = 'simlib V2';
                $outdata['header'] = array('SK_MENGAJAR','BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI','BEBAN_MENGAJAR'); 
                }
                elseif ($_SESSION['rule'] == 1){
                    $outdata['title'] = 'simlib V2';
                    $outdata['header'] = array('');              
                    }
                    elseif ($_SESSION['rule'] == 5){
                        $outdata['title'] = 'simlib V2';              
                        }
                        else {
                            $outdata['title'] = 'simlib V2';
                            $outdata['header'] = array('Profile','SK_PRODI', 'Kepegawaian'); 
                            
                            }
                            $this->load->view('login/headerlog',$outdata);
                            $this->load->view('login/sidebar',$outdata);
                            $this->load->view('login/topbar',$outdata);
    }
   
}
