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

    }
    public function index(){
        $outdata['title'] = 'SIMLIB_V2';
        $this->load->view('login/headerlog',$outdata);
        $this->load->view('login/login');
    }

    Public function LogAcc(){
        
    if(!isset($_SERVER['HTTP_REFERER'])){
        $this->load->helper('url');
        redirect(site_url('Backbone/index'));
    }
        $user = str_replace("'","",htmlspecialchars($this->input->post('Username'), ENT_QUOTES));
        $pass = str_replace("'","",htmlspecialchars($this->input->post('Password'), ENT_QUOTES));
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        
        if ($this->form_validation->run() == FALSE){
            $passing = $this->First->checkData($user, $pass)->row();
            $check = $this->First->checkData($user, $pass); 
            if ($check->num_rows() > 0){            
                return $this->sucsess($passing, $user);
                }else{
                        $data['warning'] = 'please contact your Administrator';
                        $this->load->view('app/LogApp_header');
                        $this->load->view('app/logApp_page_error',$data);
                      } 
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
        $date = date('Y-m-d');
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
        $out['data'] = array($user,$param->RULE_PROD, $ip_address);
          $this->session->set_flashdata($out);
          $_SESSION['idpegawai'] = $idlog->ID_LOGIN;
          $_SESSION['prodi'] = $param->RULE_PROD;
          $_SESSION['rule'] = $param->PAS_RULE;
          $_SESSION['user'] = $user;
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
        
        $id_link = $this->uri->segment(3,0);
        switch($id_link)
        {
            case 'profile':
                    $this->load->view('temp/user1');
                    $this->load->view('login/footer');
                break;
            case 'pegawai':
                $this->load->view('temp/pegawai',$outdata);
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

            default:
                $this->load->view('temp/user1');
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
            $this->load->view('login/sidebardosen',$outdata);
            $this->load->view('login/topbar',$outdata);
           }
            elseif ($_SESSION['rule'] == 4){
                $outdata['title'] = 'simlib V2';
                $outdata['header'] = array('BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI');
                $outdata['head'] = array('SK_MENGAJAR','SK_DOSEN_WALI','SK_DOSEN_PJMK','SK_PEMBIMBING_TA','PLOTING_JADWAL','BEBAN_MENGAJAR');
                $this->load->view('login/headerlog',$outdata);
                $this->load->view('login/sidebarfakultas',$outdata);
                $this->load->view('login/topbar',$outdata); 
                }
                elseif ($_SESSION['rule'] == 1){
                    $outdata['title'] = 'simlib V2';
                    $outdata['header'] = array('');
                    $this->load->view('login/headerlog',$outdata);
                    $this->load->view('admin/sidebaradmin',$outdata);
                    $this->load->view('login/topbar',$outdata);              
                    }
                    elseif ($_SESSION['rule'] == 5){
                        $outdata['title'] = 'simlib V2'; 
                        $this->load->view('login/headerlog',$outdata);
                        $this->load->view('login/sidebar',$outdata);
                        $this->load->view('login/topbar',$outdata);             
                        }
                        else{
                            $outdata['title'] = 'simlib V2';
                            $outdata['header'] = array('Profile','SK_PRODI', 'Kepegawaian'); 
                            $this->load->view('login/headerlog',$outdata);
                            $this->load->view('login/sidebar',$outdata);
                            $this->load->view('login/topbar',$outdata);
                            }
                            
    }
    
    public function logapp()
    {
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
        $out['login'] = $this->Page->get_limit_admin(8, $page);
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
                $this->session->unset_userdata($value);
            }
        }
    $this->session->sess_destroy($key);
    redirect(site_url('Backbone/index'));
    }
    function pagination($url, $counting){
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