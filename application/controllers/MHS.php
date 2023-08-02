<?php 
class MHS extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('DataEx');
		$this->load->model('First');
		$this->load->library('form_validation','session','database','Pdf');
        $this->load->helper(array('form','url'));
    	}	

    function index(){
        $this->reportmhs();
    }
    function newmhs(){
    	$outdata['prodi'] = $this->First->nama_prodi();
    	$outdata['title'] = 'MSMHS_SIMLIBV2';
    	$this->load->view('login/headerlog',$outdata);
    	$this->load->view('mahasiswa/newaccount',$outdata);
    }
    function createaccount(){
        $username = $this->input->post('Username');
        $prodi_id = 6;
        $password = $this->input->post('Password');
        $password2 = $this->input->post('Password2');
        $nama = $this->input->post('Nama');
        $nip = $this->input->post('nim');
        $email = $this->input->post('email');
        $add = $this->input->post('alamat');
        $tlp = $this->input->post('tlp');
        $id_nama_prodi = $this->input->post('id_nam_prod');
        $tanggal = date('Y-m-d');

        if($password == $password2){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $data = array(
                'ID_LOGIN' => ' ',
                'LOGIN_USER' => $username,
                'LOGIN_PASS' => $password,
                'ID_RULE' => $prodi_id,
                'HASH_LOG' => $hash
            );
            $data_hash =  array(
                'ID_HASH' => ' ',
                'HASH_LOG' => $hash,
                'LOGIN_USER' => $username
                 );
            $this->load->model('First');
            $this->First->insertUser($data);
            $id_user = $this->First->selectId($username)->row();
            $cekId = $this->First->selectId($username);
                if($cekId->num_rows() > 0){
                    $datuser = array(
                        'ID_PEGAWAI' => ' ',
                        'NAMA_PEGAWAI' => $nama,
                        'NIP_PEGAWAI' => $nip,
                        'GOLONGAN' => ' ',
                        'ID_LOGIN' => $id_user->ID_LOGIN,
                        'ID_RULE'=> $prodi_id,
                        'ID_PRODI'=> $id_nama_prodi,
                        'NO_TLP' => $tlp,
                        'E_MAIL' => $email,
                        'ALAMAT' => $add,
                        'TMT' => $tanggal
                    );
                    $this->First->insertPegawai($datuser);
                    
                    echo '<script language="javascript">';
            		echo 'alert("data yang anda inputkan sukses mohon login dengan user dan password yang anda daftarkan")';
            		echo '</script>'; 
                    $this->load->model('DataEx');
                    $outadmin['login'] = $this->DataEx->UserSearch();
                    redirect(site_url('Home/index'));
            }

        }else{
            $errorpas = 'password not same, please insert corectly';
        }

    }
    function magang(){
    	$this->frontuimhs();
    	$this->load->model('DataEx');
    	$this->load->model('Mahasiswa');
    	$id = $_SESSION['idpegawai'];
    	$outdata['user'] = $this->DataEx->datauser($id);
    	$outdata['tujuan'] = $this->Mahasiswa->tujuan();
    	$this->load->view('mahasiswa/magang',$outdata);
    	$this->load->view('login/footer');
    }
    function magangpersonal(){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        $outdata['user'] = $this->DataEx->datauser($id);
        $outdata['tujuan'] = $this->Mahasiswa->tujuan();
        $this->load->view('mahasiswa/magangpersonal',$outdata);
        $this->load->view('login/footer');
    }
    function magangkelompok(){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        $outdata['user'] = $this->DataEx->datauser($id);
        $outdata['tujuan'] = $this->Mahasiswa->tujuan();
        $this->load->view('mahasiswa/magangkelompok',$outdata);
        $this->load->view('login/footer');
    }
    function pkl(){
    	$this->frontuimhs();
    	$this->load->model('DataEx');
    	$this->load->model('Mahasiswa');
    	$id = $_SESSION['idpegawai'];
    	$outdata['user'] = $this->DataEx->datauser($id);
    	$outdata['tujuan'] = $this->Mahasiswa->tujuan();
    	$this->load->view('mahasiswa/pkl',$outdata);
    	$this->load->view('login/footer');
    }
    function skripsi(){
    	$this->frontuimhs();
    	$this->load->model('DataEx');
    	$this->load->model('Mahasiswa');
    	$id = $_SESSION['idpegawai'];
    	$outdata['user'] = $this->DataEx->datauser($id);
    	$this->load->view('mahasiswa/skripsi', $outdata);
    	$this->load->view('login/footer');
    }
    
    function insertpkl(){

    	$data = array(

    		'ID_DATA_PKL' => ' ',
    		'ID_PEGAWAI' => $this->input->post('idmhs'),
    		'NAMA_MHS' => $this->input->post('nama'),
    		'NIM_MHS' => $this->input->post('nim'),
    		'NO_TLP_MHS' => $this->input->post('tlp'),
    		'ID_TUJUAN' => $this->input->post('tujuan'),
    		'NAMA_PERUSAHAAN' => $this->input->post('perusahaan'),
    		'ALAMAT_PERUSAHAAN' => $this->input->post('almtprsh'),
    		'KOTA' => $this->input->post('kota'),
    		'ALAMAT_MHS' => $this->input->post('almtmhs'),
    		'TGL_MULAI' => $this->input->post('waktumulai'),
    		'TGL_BERAKHIR' => $this->input->post('waktuakhir'),
    		'EMAIL_TLP' => $this->input->post('kps'),
    		'RESPONS' => ' ',
    		'VALUE_DATA' => $this->input->post('value')
    	);
    	
    	$this->load->model('Mahasiswa');
    	$this->Mahasiswa->insertpkl($data);
    	if(isset($data) == true){
    		echo '<script language="javascript">';
            echo 'alert("data yang anda inputkan sukses mohon ditunggu konfirmasi Admin untuk keberlanjutan proses cetak surat pengantar")';
            echo '</script>';
            redirect(site_url('MHS/index'));
    	}else{
    		echo '<script language="javascript">';
            echo 'alert("data yang anda inputkan tidak falid, mohon cek ulang kebenaran data anda")';
            echo '</script>';
            redirect(site_url('MHS/index'));
    	}
    }
    function reportmhs(){
    	$this->load->model('Mahasiswa');
    	$id = $this->Mahasiswa->iduser($_SESSION['user']);
    	$idmhs = $this->Mahasiswa->idmhs($id->ID_LOGIN);
    	foreach($idmhs as $row){
    		$id = $row->ID_PEGAWAI;
    	}
    	$outdata['report'] = $this->Mahasiswa->reportmhs($id);
    	$this->frontuimhs();
    	$this->load->view('mahasiswa/reportpengajuan',$outdata);
    	$this->load->view('login/footer');
    	
    }
    function reportpengajuan(){
        $this->load->model('Mahasiswa');
        $data = $this->uri->segment(3,0);
        $id = $this->Mahasiswa->iduser($_SESSION['user']);
        $idmhs = $this->Mahasiswa->idmhs($id->ID_LOGIN);
        foreach($idmhs as $row){
            $id = $row->ID_PEGAWAI;
        }
        //if($_SESSION['rule'] == 4){$data = 0;}else{$data = 1;}
        $outdata['report'] = $this->Mahasiswa->reportadminfak($data);
        $this->frontuimhs();
        $this->load->view('mahasiswa/reportpengajuanmhs',$outdata);
        $this->load->view('login/footer');
    }
    function prosespengajuan(){
        $this->load->model('Mahasiswa');
        $idberkas = $this->uri->segment(3,0);
        $namamhs = $this->uri->segment(4,0);
        //$a = 1;
        //$this->Mahasiswa->updatemagang($a);
        $outdata['berkas'] = $this->Mahasiswa->prosesberkas($idberkas); 
        $this->frontuimhs();
        $this->load->view('mahasiswa/prosespengajuan',$outdata);
        $this->load->view('login/footer');

    }
    function prosespdf(){
        $this->load->model('Mahasiswa');
        
        $idberkas = $this->uri->segment(3,0);
        $namamhs = $this->uri->segment(4,0);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename =$namamhs."_proses_magang.pdf";
        
        //$a = 1;
        //$this->Mahasiswa->updatemagang($a);
        $outdata['berkas'] = $this->Mahasiswa->prosesberkas($idberkas); 
        $this->pdf->load_view('mahasiswa/prosespdf',$outdata);
        //$html = $this->load->view('mahasiswa/prosespengajuan',$outdata);
        $this->Pdf->createPdf($html);
    }
    function frontuimhs(){
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

        if($_SESSION['rule'] == 6){
            $outdata['title'] = 'MSMHS_SIMLIBV2';
            $outdata['header'] = array('profile'); 
            $this->load->view('login/headerlog',$outdata);
            $this->load->view('login/sidebarmhs',$outdata);
            $this->load->view('login/topbar',$outdata); 

            }elseif($_SESSION['rule'] == 4){
                $outdata['title'] = 'simlib V2';
                $outdata['header'] = array('BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI');
                $outdata['head'] = array('SK_MENGAJAR','SK_DOSEN_WALI','SK_DOSEN_PJMK','SK_PEMBIMBING_TA','PLOTING_JADWAL','BEBAN_MENGAJAR');
                $this->load->view('login/headerlog',$outdata);
                $this->load->view('login/sidebarfakultas',$outdata);
                $this->load->view('login/topbar',$outdata); 
            }else{
                $outdata['title'] = 'simlib V2';
                $outdata['header'] = array('Profile','SK_PRODI', 'Kepegawaian'); 
                $this->load->view('login/headerlog',$outdata);
                $this->load->view('login/sidebar',$outdata);
                $this->load->view('login/topbar',$outdata);
            }
    	
    }
}
?>