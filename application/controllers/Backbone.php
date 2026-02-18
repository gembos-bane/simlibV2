<?php
include 'Passing.php';
include_once (dirname(__FILE__)."\Admin.php");

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Backbone
 *
 * @author D4 MB
 */
class Backbone extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();

        $this->load->model('First');
        $this->load->library('form_validation','session','database');
        $this->load->helper(array('form','url'));
        $_SESSION['time_map'] = time();
          session_start();
             $idle_time = 180000;

             if(time() - $_SESSION['time_map'] > $idle_time ){
                session_destroy();
                session_unset();
                redirect(site_url('Backbone/index'));
             }else{
                $_SESSION['time_map'] = time();
             }
    }  
    public function index(){
        
        $outdata['title'] = base_url().'ADEMI';
        $this->load->view('login/headerlog',$outdata);
        //$this->timelaps();
        $this->load->view('login/login');
        
    
    }
   /* function timelaps(){
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


    Public function LogAcc(){
        
        if(!isset($_SERVER['HTTP_REFERER'])){
            $this->load->helper('url');
            redirect(site_url('Backbone/index'));
        }

        $this->load->helper('url','form');
        $this->load->library('form_validation');
        $user = $this->input->post('Username');
        $pass = $this->input->post('Password');
        $datalogin = array(
            'LOGIN_USER' => $user,
            'LOGIN_PASS' => $pass
            );
        $this->form_validation->set_data($datalogin);
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required',array('required' => 'You must provide a %s.'));
        
        /*$date = date("Y-m-d");
        if($date >= "2024-03-29"){
            $user = " ";
            $pass = " ";
            $data['warning'] = 'This App Has Been Locked, Please Activated';
                                $this->load->view('app/LogApp_header');
                                $this->load->view('app/logApp_page_error',$data);
                                $this->load->view('login/footer');
            
        }else{
            $user = $this->input->post('Username');
            $pass =$this->input->post('Password');
        }*/
        
        if ($this->form_validation->run() == FALSE ){
            $passing = $this->First->checkData($user,$pass)->row();
            $check = $this->First->checkData($user,$pass);
            //$checkpass = $this->First->checkpass($user);
            
                if ($check->num_rows() > 0){
                    return $this->sucsess($passing, $user);
                            }else{

                                $data['warning'] = 'please contact your Administrator';
                                $this->load->view('app/LogApp_header');
                                $this->load->view('app/logApp_page_error',$data);
                                $this->load->view('login/footer');
                              } 
                 
            }else{
                    $data['warning'] = 'please Insert your username And password correctly';
                    $this->load->view('app/LogApp_header');
                    $this->load->view('app/logApp_page_error',$data);
            }

        }
    
    function get_ip_user(){
        if (isset($_SERVER)) { 
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                return $_SERVER["HTTP_X_FORWARDED_FOR"]; 
                if (isset($_SERVER["HTTP_CLIENT_IP"]))
                    return $_SERVER["HTTP_CLIENT_IP"]; 
                        return $_SERVER["REMOTE_ADDR"];
        }
     
        if (getenv('HTTP_X_FORWARDED_FOR')){
            return getenv('HTTP_X_FORWARDED_FOR');
            if (getenv('HTTP_CLIENT_IP'))
                return getenv('HTTP_CLIENT_IP');
                return getenv('REMOTE_ADDR');
        }
    }   
    function sucsess($passing, $user){
        $this->load->model('DataEx');
        $this->load->model('Page');
        $idlog = $this->First->selectId($user)->row();
        $idlogon = $idlog->ID_LOGIN;
        $date = date('Y-m-d H:i:s') ;
        $idpegawai = $this->DataEx->allDataProfile($idlog->ID_LOGIN);
        $ip_address = $this->get_ip_user();
        $this->DataEx->updatetimelog($idlogon,$date);
        $this->DataEx->timeactivity(array('ID_TIME_ACTIVITY'=> ' ', 'ID_LOGIN' => $idlogon,'TIME' => $date, 'IP_ADDRESS' => $ip_address));

        $param = $this->First->checkProd($passing->ID_RULE);

        $this->session->set_userdata($user,$param->RULE_PROD);
        //$outadmin['info'] = $this->Page->countinfo();
        $outadmin['set'] = $this->First->prodi();
        $outadmin['data'] = $this->First->nama_prodi();
        $outadmin['login'] = $this->DataEx->UserSearch();
        $out['data'] = array($user,$param->RULE_PROD, $ip_address,time());
          $this->session->set_flashdata($out);
          $_SESSION['idpegawai'] = $idlog->ID_LOGIN;
          $_SESSION['prodi'] = $param->RULE_PROD;
          $_SESSION['rule'] = $param->PAS_RULE;
          $_SESSION['user'] = $user;
          $_SESSION['time_map'] = time();
          session_start();
             $idle_time = 180000;

             if(time() - $_SESSION['time_map'] > $idle_time ){
                session_destroy();
                session_unset();
                redirect(site_url('Backbone/index'));
             }else{
                $_SESSION['time_map'] = time();
             }

            switch ($passing->ID_RULE){
                case 1:
                    $outadmin['set'] = $this->First->prodi();
                    $id = $_SESSION['rule'];
                    $this->adminLogin($outadmin);
                    break;
                case 2:
                    $this->profile($_SESSION['rule']);
                    break;
                case 3:
                    $this->profile($_SESSION['rule']);
                    ;
                    break;
                case 4:
                    $this->profile($_SESSION['rule']);
                    break; 
                case 5:
                    $this->profile($_SESSION['rule']);
                    break;
                case 6:
                    redirect(site_url('MHS/index'));
                    break; 
                case 7:
                    $this->profile($_SESSION['rule']);
                    break;
                case 8:
                    $this->profile($_SESSION['rule']);
                    break;                
                return $this->viewLog();
            }
        
        }

   
    function createUser(){
        $username = $this->input->post('Username');
        $prodi_id = $this->input->post('Prodi');
        $password = $this->input->post('Password');
        $password2 = $this->input->post('Password2');
        $nama = $this->input->post('Nama');
        $nip = $this->input->post('Nip');
        $email = $this->input->post('email');
        $add = $this->input->post('alamat');
        $tlp = $this->input->post('tlp');
        $id_nama_prodi = $this->input->post('id_nam_prod');

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
                        'E_MAIL' => $email
                    );
                    $this->First->insertPegawai($datuser);
                    
                    echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Succesfully Insert New User');
                        </script>");
                            $fix = array($_SESSION['user'], $_SESSION['prodi']);
                            $out['data'] = array($fix);
                            $outadmin['set'] = $this->First->prodi();
                            $this->load->model('DataEx');
                            $outadmin['login'] = $this->DataEx->UserSearch();
                                return $this->adminLogin($outadmin);
            }

        }else{
            $errorpas = 'password not same, please insert corectly';
        }

    }
    function pasingdatases(){
        
        $this->frontendui($outdata,$out);
    }
    public function profile($id_rule)
    {

        $this->frontendui();
        $rule_pass = $this->Page->rule($id_rule);
        foreach($rule_pass as $keys){$rule = $keys->RULE_PROD;}
        
        //$id_link = $this->uri->segment(3,0);
        switch($rule)
        {
            case 'profile':
                    $dataidprod = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
                    foreach($dataidprod as $keys){
                    $idprodi = $keys['ID_PRODI'];
                    }
                    $dat = 0;

                   /* $outdata['alertambildata'] = $this->Page->alertambildataprodi($dat,$idprodi)->num_rows();
                    $outdata['alertmagangprodi'] = $this->Page->alertmagangprodi($dat,$idprodi)->num_rows();
                    $outdata['alertyudisium'] = $this->Page->alertyudisium($dat,$idprodi)->num_rows();*/
                    $outdata['alertambildata'] = $this->Page->alertambildata($dat)->num_rows();
                    $outdata['alertmagangprodi'] = $this->Page->alertMagang($dat)->num_rows();
                    $outdata['alertyudisium'] = $this->Page->alertyudisiumdep($dat)->num_rows();
                    $this->load->view('temp/user1',$outdata);
                    $this->load->view('login/footer');
                break;
            case 'pegawai':
                $this->load->view('temp/pegawai',$outdata);
                $this->load->view('login/footer');
                break;
            case 'pengmas':
                $this->load->view('temp/pengmas',$out );
                break;
            case 'penelitian':
                $this->load->view('temp/penelitian',$out );
                break;
            case 'serdos':
                $this->load->view('temp/serdos',$out );
                break;
            case 'admin':
                $this->load->view('admin/createAcc',$outdata);
                $this->load->view('login/footer');
                break;
            case 'PIC':
                $this->load->view('controling/report_activity',$outdata);
                $this->load->view('login/footer'); 
            case 'KEPEGAWAIAN':
                echo '<script type="text/javascript">
                     window.location.href = "http://10.11.8.50/dapegV2/" ; 
                     </script>';
                break;
            default:
                $this->load->view('temp/user1');
                $this->load->view('login/footer');
        }  
    }
    function editprofile(){
        $this->frontendui();

        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['data'] = $this->DataEx->datauser($idpegawai->ID_PEGAWAI);
        $this->load->view('app/editprofile',$outdata);
        $this->load->view('login/footer');

    }

    function frontendui(){
            
        //
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
        

        /*
            $end_time = strtotime("2024-02-28 23:59:59"); 
            $current_time = time(); 
            $time_left = $end_time - $current_time; 
            $days = floor($time_left / 86400); 
            $time_left = $time_left % 86400;
            $outdata['timeleft'] = $days; */
         if ($_SESSION['rule'] == 2){
            $outdata['title'] = 'simlib V2';
            $outdata['header'] = array('Profile','persuratan'); 
            $this->load->view('login/headerlog',$outdata);
            $this->load->view('login/sidebardosen',$outdata);
            $this->load->view('login/topbar',$outdata);
           }
            elseif ($_SESSION['rule'] == 4){
                $this->load->model('Page');
                $dat = 0;
                $outdata['alertmagangprodi'] = $this->Page->alertMagang($dat)->num_rows();
                $outdata['alertambildata'] = $this->Page->alertambildata($dat)->num_rows();
                $outdata['alertyudisium'] = $this->Page->alertyudisiumdep($dat)->num_rows();
                $outdata['title'] = 'Ademi';
                $outdata['header'] = array('BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI');
                $outdata['head'] = array('SK_MENGAJAR','SK_DOSEN_WALI','SK_DOSEN_PJMK','SK_PEMBIMBING_TA','PLOTING_JADWAL','BEBAN_MENGAJAR');

                //$this->timelaps();
                $this->load->view('login/headerlog',$outdata);
                $this->load->view('login/sidebarfakultas',$outdata);
                $this->load->view('login/topbar',$outdata); 
                }
                elseif ($_SESSION['rule'] == 1){
                    $outdata['title'] = 'Ademi';
                    $outdata['header'] = array('');
                    //$this->timelaps();
                    $this->load->view('login/headerlog',$outdata);
                    $this->load->view('admin/sidebaradmin',$outdata);
                    $this->load->view('login/topbar',$outdata);              
                    }
                    elseif ($_SESSION['rule'] == 5){
                        $outdata['title'] = 'Ademi'; 
                        $outdata['header'] = array('profile','persuratan');
                       // $this->timelaps();
                        $this->load->view('login/headerlog',$outdata);
                        $this->load->view('login/sidebar',$outdata);
                        $this->load->view('login/topbar',$outdata);             
                        }
                        elseif($_SESSION['rule'] == 6){

                            $outdata['title'] = 'Ademi';
                            $outdata['header'] = array('ProfilMhs'); 
                           // $this->timelaps();
                            $this->load->view('login/headerlog',$outdata);
                            $this->load->view('login/sidebarmhs',$outdata);
                            $this->load->view('login/topbar',$outdata);
                            }elseif ($_SESSION['rule'] == 7){
                                $this->load->model('Page');
                                $dat = 0;
                                $outdata['alert'] = $this->Page->alertMagang($dat)->num_rows();
                                $outdata['alertambil'] = $this->Page->alertambildata($dat)->num_rows(); 
                                $outdata['head'] = array('SK_MENGAJAR','SK_DOSEN_WALI','SK_DOSEN_PJMK','SK_PEMBIMBING_TA','PLOTING_JADWAL','BEBAN_MENGAJAR');   
                                $outdata['title'] = 'Ademi';
                                $outdata['header'] = array('Profile'); 
                                //$this->timelaps();
                                $this->load->view('login/headerlog',$outdata);
                                $this->load->view('controling/sidebar_pic',$outdata);
                                $this->load->view('login/topbar',$outdata);               
                                }elseif ($_SESSION['rule'] == 8){
                                    $this->load->model('Page');
                                    $dat = 0; 
                                    $outdata['title'] = 'Ademi';
                                    $outdata['header'] = array('Profile'); 
                                    //$this->timelaps();
                                    $this->load->view('login/headerlog',$outdata);
                                    $this->load->view('login/sidebarkepeg',$outdata);
                                    $this->load->view('login/topbar',$outdata);               
                                    }else{
                                    
                                        $dataidprod = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
                                        foreach($dataidprod as $keys){
                                        $idprodi = $keys['ID_PRODI'];
                                        }
                                        $dat = 0;

                                        $outdata['alertambildata'] = $this->Page->alertambildataprodi($dat,$idprodi)->num_rows();
                                        $outdata['alertmagangprodi'] = $this->Page->alertmagangprodi($dat,$idprodi)->num_rows();
                                        $outdata['alertyudisium'] = $this->Page->alertyudisium($dat,$idprodi)->num_rows();
                                        $outdata['title'] = 'Ademi';
                                        $outdata['header'] = array('Profile','SK_PRODI', 'Kepegawaian'); 
                                        //$this->timelaps();
                                        $this->load->view('login/headerlog',$outdata);
                                        $this->load->view('login/sidebar',$outdata);
                                        $this->load->view('login/topbar',$outdata);
                                        }
                                
    }
    
    public function logapp()
    {
        $this->timelaps();
        $this->load->view('app/LogApp_header');
        $this->load->view('app/LogApp_page');
        $this->load->view('home/footer');
    }
    function adminLogin($outadmin){
        $this->load->model('Page');
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
        
        $url = base_url().'Admin/first';
        $counting = $this->Page->get_count_admin();
        $config['array']= array($this->pagination($url, $counting));
        $this->pagination->initialize($config['array']);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
        $out['links'] = $this->pagination->create_links();
        $out['login'] = $this->Page->get_limit_admin(10, $page);
        //pagination end ..
        $out['title'] = 'Admin V2';
        $out['header'] = array('');
        $this->load->view('login/headerlog',$out);
        $this->load->view('admin/sidebaradmin',$out);
        $this->load->view('login/topbar',$outdata);
        $this->load->view('admin/createAcc',$outdata);
        $this->load->view('login/footer');
        }
    function fakLogin($outadmin,$out){
        $this->load->view('temp/header',$out);
        $this->load->view('temp/user1',$outadmin);
        $this->load->view('login/footer');
    }
    function depLogin($out){
        $this->load->view('temp/header',$out);
        $this->load->view('temp/firstAdmin',$out );
        $this->load->view('login/footer');
    }
    function viewLog($out){
        $this->load->view('temp/header',$out);
        $this->load->view('temp/firstAdmin',$out );
        $this->load->view('login/footer');
    }
    function logOut(){
        
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($value != $_SESSION['user'] && $value != $_SESSION['prodi'] && $value != 'user_agent' && $value != $_SESSION['rule']) {
                $this->CI=& get_instance();
                $this->CI->session->sess_destroy();
                $this->session->unset_userdata($value);
                $this->clear_chace();
            }
        }
    $this->session->sess_destroy($key);
    redirect(site_url('Backbone/index'));
    }
    function clear_chace(){
         $CI =& get_instance();
        $path = $CI->config->item('cache_path');
        //path of cache directory
        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

        $uri =  $CI->config->item('base_url').
        $CI->config->item('index_page').
        $uri;
        $cache_path .= md5($uri);

        return @unlink($cache_path);
    }
    function detailpengajuan(){
        $this->load->model('Mahasiswa');
        $this->load->model('Page');
        $idpegawai =$_SESSION['idpegawai'];
        $idprodi = $this->Mahasiswa->datauser($idpegawai);
        foreach($idprodi as $row)
            {$idprod = $row->ID_PRODI;}
        $url = base_url().'Backbone/detailpengajuan/';
        $counting = $this->Page->get_count_pengajuan($idprod);
        $config['array']= array($this->pagination($url,$counting));
        $this->pagination->initialize($config['array']);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
        $outdata['link'] = $this->pagination->create_links();
        $outdata['data'] = $this->Page->get_limit_pengajuan(10,$page,$idprod);
        $outdata['idprod'] = $idprod;
        //$outdata['data'] = $this->Mahasiswa->outpaamagang($idprod);
        
        $this->frontendui();
        $this->load->view('mahasiswa/reportpaa',$outdata);
        $this->load->view('login/footer');
    }
    function adminyudisium(){
        $this->load->model('Mahasiswa');
        $this->load->model('Page');
        $idpegawai =$_SESSION['idpegawai'];
        $idprodi = $this->Mahasiswa->datauser($idpegawai);
        foreach($idprodi as $row)
            {$idprod = $row->ID_PRODI;}
        
        /*$url = base_url().'Backbone/adminyudisium/';
        $counting = $this->Page->count_yudisium($idprod);
        $config['array']= array($this->pagination($url,$counting));
        $this->pagination->initialize($config['array']);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
        $outdata['link'] = $this->pagination->create_links();
        $outdata['data'] = $this->Page->get_limit_pengajuan(10,$page,$idprod);*/
        $outdata['idprod'] = $idprod;
        $outdata['reportYudisium'] = $this->Mahasiswa->daftaryudisium($idprod)->result_array();
        $outdata['periode'] = $this->Mahasiswa->setperiode();
        $outdata['jumlah'] = $this->Mahasiswa->daftaryudisium($idprod)->num_rows();
        $x = 1;
        $outdata['terproses'] = $this->Mahasiswa->countprosesyudisium($x,$idprod)->num_rows();
        $x = 3;
        $outdata['kembali'] = $this->Mahasiswa->countprosesyudisium($x,$idprod)->num_rows();
        
        $this->frontendui();
        $this->load->view('mahasiswa/reportyudisium',$outdata);
        $this->load->view('login/footer');
        
    }
    /*function uiyudisium(){
        $this->frontendui();
        $iddep = $this->uri->segment(5,0);
        $this->load->model('First');
        $this->load->model('DataEx');
        $outdata['periode'] = $this->DataEx->periodeyudi()->result();
        $outdata['prod'] = $this->First->prodidep($iddep)->result();
        $this->load->view('mahasiswa/uiyuddep',$outdata);
        $this->load->view('login/footer');

    } */
    function uiyudisium(){
        $this->frontendui();
        $idperiod = $this->uri->segment(4,0);
        $iddep = $this->uri->segment(5,0);
        $this->load->model('First');
        $this->load->model('DataEx');
        //$outdata['periode'] = $this->DataEx->periodeyudi()->result();
        $outdata['periode'] = $this->DataEx->periodout($idperiod);
        $outdata['yudidep'] = $this->DataEx->outyudis($iddep, $idperiod);
        //$outdata['prod'] = $this->First->prodidep($iddep)->result();
        $this->load->view('mahasiswa/uiyuddep',$outdata);
        $this->load->view('login/footer');
    }
    function yudiprodi(){
        $this->frontendui();
        $prodi_id = $this->uri->segment(4,0);
        $this->load->model('DataEx');
        $periode = $this->DataEx->periodeyudout()->result_array();
        foreach($periode as $data){
            $outdata['yudprodi'] = $this->DataEx->yudprodi($prodi_id,$data->ID_PERIODE);
        }
        
        $this->load->view('yudisium/yudprodi',$outdata);
        $this->load->view('login/footer');
    }
    function outcountdatayudisium(){
        $this->load->model('Mahasiswa');
        //$idprod = $this->uri->segment(4,0);
        $iddep = $this->uri->segment(3,0);
        $idpegawai =$_SESSION['idpegawai'];
        $idprodi = $this->Mahasiswa->datauser($idpegawai);
        $count = $this->Mahasiswa->countperiode()->num_rows();
        foreach($idprodi as $row)
            {$idprod = $row->ID_PRODI;}
        
        $i = 1;
        while($i<=$count): $i; $i++; 
             $outdata['periode'] = $this->Mahasiswa->periodeout($idprod)->result_array();
        endwhile;
        $outdata['dep'] = $this->Mahasiswa->setdepartemen($iddep);
        $outdata['idprod'] = $idprod;
        $this->frontendui();
        $this->load->view('mahasiswa/reportyudisium',$outdata);
        $this->load->view('login/footer');
    }
    function yudisiumcheck(){
        $idpegawai = $this->uri->segment(4,0);
        $proses = $this->uri->segment(5,0);
        $this->load->model('Mahasiswa');
        $pesan = "selamat anda telah dinyatakan lulus administrasi, mohon ditunggu kelanjutan proses";
        $this->Mahasiswa->updatePesanyudisium($idpegawai,$pesan);
        $bukti = $this->Mahasiswa->fixyudisium($idpegawai,$proses);
        return $this->outcountdatayudisium();
    }
    function yudisiumrepair(){
        $this->load->model('Mahasiswa');
        $idpegawai = $this->input->post('idmhs');
        $idbukti = $this->input->post('idbukti');
        $pesan = $this->input->post('pesan');
        $respon = $this->input->post('respon');
        $this->Mahasiswa->pesanyudisium($pesan,$idbukti);
        $this->Mahasiswa->revisiresyudi($respon,$idpegawai);
        $this->adminyudisium();
    }
    function yudisium_cekdata(){
        $this->load->model('Mahasiswa');
        $idpegawai = $this->uri->segment(4,0);
        $proses = $this->uri->segment(5,0);
        $idprodi = $this->uri->segment(6,0);
        $bukti = $this->Mahasiswa->choutbukti($idpegawai);
        $url = 'yudisium';
        foreach($bukti as $value){
          $file = $value['NAMA_BUKTI_YUDISIUM']; 
        }

        $outdata['file'] ='pdf';
        $outdata['url'] = base_url()."upload"."/".$url."/".$file;
        $this->load->view('login/headerlog',$outdata);

        if($idprodi == 3){
            $outdata['outyudisium'] = $this->Mahasiswa->outyudisiummhspjk($idpegawai,$proses)->result_array();
            $this->load->view('yudisium/checkdatapjk',$outdata);
        }elseif($idprodi == 7){
            $outdata['outyudisium'] = $this->Mahasiswa->outyudisiummhsmp($idpegawai,$proses)->result_array();
            $this->load->view('yudisium/checkdatamp',$outdata);
        }else{
            $outdata['outyudisium'] = $this->Mahasiswa->outyudisiummhs($idpegawai,$proses)->result_array();
            $this->load->view('yudisium/checkdata',$outdata);
        }
        
        $this->load->view('login/footer');
    }
    function yudisiumreport(){
        $this->load->model('Mahasiswa');
        $this->load->model('Page');
        $idpegawai =$_SESSION['idpegawai'];
        $idprodi = $this->Mahasiswa->datauser($idpegawai);
        $idperiode = $this->uri->segment(4,0);
        foreach($idprodi as $row){$idprod = $row->ID_PRODI;}
        $outdata['idprod'] = $idprod;
        $outdata['reportYudisium'] = $this->Mahasiswa->reportYudisium($idprod,$idperiode)->result_array();
        $outdata['count'] = $this->Mahasiswa->countprosesyudisiumtest($idprod,$idperiode)->num_rows();
        
        $this->frontendui();
        $this->load->view('yudisium/outusulan',$outdata);
        $this->load->view('login/footer');
        
        
    }
    function depyudisium(){
        $this->load->model('Mahasiswa');
        $this->load->model('Page');
        $idprod = $this->uri->segment(4,0);
        $idperiode = $this->uri->segment(3,0);
        $namprod = $this->uri->segment(5,0);
        $outdata['nama_prodi'] = str_replace('%20',' ',$namprod);
        //foreach($idprodi as $row){$idprod = $row->ID_PRODI;}
        //$outdata['idprod'] = $idprod;
        $outdata['reportYudisium'] = $this->Mahasiswa->reportYudisium($idprod,$idperiode)->result_array();
        $outdata['count'] = $this->Mahasiswa->countprosesyudisiumtest($idprod,$idperiode)->num_rows();
        
        $this->frontendui();
        $this->load->view('yudisium/outusulan',$outdata);
        $this->load->view('login/footer');
    }
    function prosesyudisium(){
        $this->load->model('Mahasiswa');
        $this->load->model('Page');
        $idmhs = $this->uri->segment(4,0);
        $proses = $this->uri->segment(5,0);
        $outdata['datamahasiswa'] = $this->Mahasiswa->outyudisiummhs($idmhs,$proses);
        $this->frontendui();
        $this->load->view('yudisium/outusulan',$outdata);
        $this->load->view('login/footer');
    }
    function get_user(){
        $id = $_SESSION['idpegawai'];
        $nama = $_SESSION['user'];
        $dataout = $this->DataEx->datauser($id);
        foreach($dataout as $row){$hash = $row->HASH_LOG;}

        $data = array(
            'md5' => $hash,
            'nama' => $nama);

    }
    
    function pengajuansuratmhs(){
        $this->load->model('Mahasiswa');
        $this->load->model('Page');
        $idpegawai = $this->uri->segment(4,0);
        $idprodi = $this->Mahasiswa->datauser($idpegawai);
        foreach($idprodi as $value){$idprod = $value->ID_PRODI;}
        $outdata['idprod'] = $value->ID_PRODI;
        $outdata['level'] = 1;
        $outdata['report'] = $this->Mahasiswa->outpengajuanprodi($idprod);
        $this->frontendui();
        $this->load->view('mahasiswa/reportambildataprodi',$outdata);
        $this->load->view('login/footer');
    }
    function pagination($url, $counting){
        $config = array();
        $config["base_url"] = $url;
        $config["total_rows"] = $counting;
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';        
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
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" style="text-decoration:none"  >';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';
               
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
        }
        function autoclose(){
            session_start();
            $inactivity_limit = 900;

            if(isset($_SESSION['Last_activity']) && (time() - $_SESSION['Last_activity']) > $inactivity_limit){
                session_unset();
                session_destroy();
                $this->logOut();
                exit();
            }else{
                $_SESSION['Last_activity'] = time();
            }

        }

} 
