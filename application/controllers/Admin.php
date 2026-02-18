<?php

include_once (dirname(__FILE__)."\Backbone.php");

class Admin extends Passing{

	function __construct(){
		parent::__construct();
		$this->load->model(array('DataEx','Page','First','Akd'));
		$this->load->library('form_validation','session','database');
        $this->load->helper(array('form','url'));
        if(!isset($_SERVER['HTTP_REFERER'])){
                    $this->load->helper('url');
                    redirect(site_url('Backbone/index'));
                }
        error_reporting(0);
    	}	
    function first(){
        if(!isset($_SERVER['HTTP_REFERER'])){
                    $this->load->helper('url');
                    redirect(site_url('Backbone/index'));
                }
        $id_rule = $_SESSION['rule'];
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'], $id_rule);
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $outdata['prodi'] = $this->First->nama_prodi();
        $outdata['level'] = $this->First->prodi();
        // pagination start ..
        $this->load->model('Page');
        $url = base_url().'Admin/first';
        $counting = $this->Page->get_count_admin();
        $config['array']= array($this->paginationadmin($url, $counting));
        $this->pagination->initialize($config['array']);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
        $out['links'] = $this->pagination->create_links();
        $out['login'] = $this->Page->get_limit_admin(15, $page);
        //pagination end ..
        $out['title'] = 'Admin V2';
        $out['header'] = array('');
        $this->load->view('login/headerlog',$out);
        $this->load->view('admin/sidebaradmin',$out);
        $this->load->view('login/topbar',$outdata);
        $this->load->view('admin/createAcc',$outdata);
        $this->load->view('login/footer');
    }
    function useractivity(){
    	$id_rule = $_SESSION['rule'];
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'], $id_rule);
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $outadmin['activity'] = $this->DataEx->controlactivity();
        $out['title'] = 'Admin V2';
        $out['header'] = array('');
        $this->load->view('login/headerlog',$out);
        $this->load->view('admin/sidebaradmin',$out);
        $this->load->view('login/topbar',$outdata);
        $this->load->view('admin/activity', $outadmin);
        $this->load->view('login/footer');

    }
    function insertnews(){
        $user = $_SESSION['user'];
        $judul = $this->input->post('judul');
        $tanggal = $this->input->post('tanggal');
        $isi = $this->input->post('isiberita');

        $data = array(
            'ID_INFORMASI' => ' ',
            'JUDUL' => $judul,
            'INFORMASI' => $isi,
            'TANGGAL' => $tanggal,
            'PENULIS' => $user
        );
        $this->load->model('Page');
        $this->Page->insertnews($data);
        echo '<script>alert("TAMPILKAN BERITA INI SEKARANG ?");</script>';
                    redirect(site_url('Admin/first'), 'refresh');

    }
    function setperiode(){
        $this->frontview();
        $this->load->model('Mahasiswa');
        $outdata['periode'] = $this->Mahasiswa->periodeout()->result_array();
        $outdata['semester'] = $this->Mahasiswa->semester();
        $this->load->view('admin/setperiode',$outdata);
        $this->load->view('login/footer');
    }
    function setperiodeyudisium(){
        $this->load->model('Mahasiswa');
        $periode = $this->input->post('tglperiode');
        $tahun = $this->input->post('tahun');
        $semester = $this->input->post('semester');
        $gelombang = $this->input->post('gelombang');
        $aktif = 1;
        $close = $this->input->post('close');

        $data = array(
            'ID_PERIODE' => ' ',
            'TGL_PERIODE' => $periode,
            'ID_SEMESTER' => $semester,
            'GELOMBANG' => $gelombang,
            'TAHUN' => $tahun,
            'AKTIFASI' => $aktif,
            'CLOSE_PERIODE' => $close 
        );
        $this->Mahasiswa->insertperiode($data);
        return $this->setmemberperiode($periode);
        
    }
    function setmemberperiode($periode){
        $id_periode = $this->Mahasiswa->selectidperiode($periode);
        foreach($id_periode as $row){$idperiode = $row->ID_PERIODE;}
        $data = array(
            'ID_MEMBER' => ' ',
            'ID_PERIODE' => $idperiode,
            'SUM_MEMBER' => ' '
        );
        $this->Mahasiswa->insertmember($data);
        return $this->setperiode();
    }
    function createnews(){
        $this->frontview();
        $this->load->view('admin/createnews');
        $this->load->view('login/footer');
    }
    function edituser(){
        
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi']);
        $idUser = $this->uri->segment(4,0);
        $this->frontview();
        $outdata['datauser'] = $this->DataEx->allDataProfile($idUser);
        $outdata['userlog'] = $this->DataEx->dataLoginUser($idUser);
        $this->load->view('admin/editUserData',$outdata);
        $this->load->view('login/footer');
    }
    
    function frontview(){
        $id_rule = $_SESSION['rule'];
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'], $id_rule);
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $outdata['activity'] = $this->DataEx->controlactivity();
        $out['title'] = 'Admin V2';
        $out['header'] = array('');
        $this->load->view('login/headerlog',$out);
        $this->load->view('admin/sidebaradmin',$out);
        $this->load->view('login/topbar',$outdata);
    }
    function upperiode(){
        $id = $this->uri->segment(4,0);
        $up = $this->uri->segment(5,0);
        $data = $this->Akd->updatePeriode($up,$id);
        echo "
            <script type=\"text/javascript\">
                alert('periode sudah tidak aktif');
            </script>
        ";
        return $this->setperiode();
    }
    function redudant(){
        $redu = 3;
        $dataout['redu'] = $this->Akd->redudant($redu);
        $this->frontview();
        $this->load->view('admin/redudant',$dataout);
        $this->load->view('login/footer');
    }
    function delredudant(){
        $checkbox = $_POST['check']; 
        $redu = 3;       
        for($a = 0; $a < count($_POST['check']); $a++){
           $id = $checkbox[$a];
           $this->Akd->delredudant($id);
        }
            
            $this->Akd->delredudantrespons($redu);
            echo '<script> alert("Data Redudance berhasil terhapus")</script>';
            $this->first();
    }
    function paginationadmin($url, $counting){
        $config = array();
        $config["base_url"] = $url;
        $config["total_rows"] = $counting;
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close'] = '</span></li>';        
        $config['prev_link'] = '&laquo'.' '.'Previous';        
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close'] = '</span></li>';        
        $config['next_link'] = '&raquo'.' '.'Next';        
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close'] = '</span></li>';        
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close'] = '</span></li>';        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" >';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';
               
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
        }
    }




