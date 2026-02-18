<?php


class API extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model(array('DataEx','First','Mahasiswa','Page'));
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
    function magangtoexcel(){
        $idprod = $this->uri->segment(3,0);
        $this->load->model('Mahasiswa');
        $outdata['prodi'] = $this->Mahasiswa->prodi($idprod);
        $outdata['judul'] = 'PKL-MAGANG';
        $outdata['report'] = $this->Mahasiswa->outpaamagang($idprod);
        $this->load->view('app/magangtoexcelprodi',$outdata);
    }
    function toExcelyudisium(){
        $this->load->model('Mahasiswa');
        $idprodi = $this->uri->segment(4,0);
        $idperiode = $this->uri->segment(3,0);
        $outdata['ket'] = 'ada';
        $outdata['datamhs'] = $this->Mahasiswa->setexcel($idprodi,$idperiode);
        $this->load->view('app/toExcelyudisium',$outdata);
    }
    function controlmagang(){
        $this->load->model('Mahasiswa');
        $data = $this->uri->segment(3,0);

        $outprodi = $this->Mahasiswa->outdataprodi($data)->result();
        
        foreach($outprodi as $row){
            $idprodi = $row->ID_PRODI;
        }
        $outdata['magang'] = $this->Mahasiswa->controlmagang($idprodi);
        $this->justheader();
        $this->load->view('content/controlmagang',$outdata);
        $this->load->view('login/footer');
    }
    function excelSkripsi(){
        
    }
    /*function timelaps(){
        $end_time = strtotime("2024-02-28 23:59:59"); // Countdown end time
        $current_time = time(); // Current timestamp
        $time_left = $end_time - $current_time; // Time remaining in seconds

        $days = floor($time_left / 86400); // 86400 seconds in a day
        $time_left = $time_left % 86400;

        $hours = floor($time_left / 3600); // 3600 seconds in an hour
        $time_left = $time_left % 3600;

        $minutes = floor($time_left / 60); // 60 seconds in a minute
        $seconds = $time_left % 60;
        $outdata['timeleft'] = $days;
        $outdata['hours'] = $hours;
        $outdata['minute'] = $minutes;
        $outdata['seconds'] = $seconds;

        $this->load->view('login/alertmodal',$outdata);
    }*/
    function frontendui(){
       
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
                            //$this->timelaps();
                            $this->load->view('login/headerlog',$outdata);
                            $this->load->view('login/sidebar',$outdata);
                            $this->load->view('login/topbar',$outdata);
    }
    function mailingMhs(){
        $mail = $this->input->post('alasan');
        $idpeg = $this->input->post('idmhs_tolak');
        $idpkl = $this->input->post('idpkl');
        $time = date('Y-m-d');
        $sender = $this->input->post('idtendik');
        $tujuan = $this->input->post('perusahaan');


        $this->Mahasiswa->updatemailing($mail,$idpkl);
        redirect(site_url('MHS/tolakpengajuan').'/3/'.$idpkl);

    }
    function pembatasan(){
        $id = $this->uri->segment(3,0);
        $sender = $this->uri->segment(4,0);
        $time = date('Y-m-d');
        $tujuan = $this->uri->segment(5,0);
        $idpkl = $this->uri->segment(6,0);
        $mail = "Batas pengajuan Magang / PKL pada tanggal"." ".date('Y-m-d');
        
        $this->Mahasiswa->updatemailing($mail,$idpkl);
        
        redirect(site_url('MHS/bataspengajuan').'/4/'.$idpkl);

    }
    function justheader(){
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
                            //$this->timelaps();
                            $this->load->view('login/headerlog',$outdata);
    }
    
   
   
}
