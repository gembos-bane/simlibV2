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
class Passing extends CI_Controller{
    //put your code here
    function __construct(){
        parent::__construct();
        
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $this->load->library('form_validation','session','database');
        $this->load->helper(array('form','url')); 
       
    }
    public function profile()
    {
            if(!isset($_SERVER['HTTP_REFERER'])){
                    $this->load->helper('url');
                    redirect(site_url('Backbone/index'));
                }
        
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $_SESSION['idpegawai'] = $idpegawai->ID_PEGAWAI;
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'], $_SESSION['rule'],$_SESSION['idpegawai']);
        //$outdata['data'] = array($profiledata);
        $this->frontendview($outdata,$out);
       
                    //$this->load->view('temp/header',$outdata);}
        $id_link = $this->uri->segment(3,0);
        $idberkas = $this->input->post('cari');
        switch($id_link)
        {
            case 'Profile':
                $this->load->view('temp/user1',$outdata);
                $this->load->view('login/footer',$outdata);
                break;
            case 'Kepegawaian':
                foreach($outdata['data'] as $row){$id = $row['ID_PEGAWAI']; }
                $this->load->model('First');
                $outdata['berkas'] = $this->First->outberkas($id);
                $this->load->view('temp/pegawai',$outdata);
                $this->load->view('login/footer',$outdata);
                break;
            case 'pengmas':
                $this->datapengmasout($out);
                break;
            case 'penelitian':
                $this->dataoutpenelitian($out);
                break;
            case 'serdos':
                $this->dataserdosout($out);
                break;
            case 'akademik':
                $this->load->model('First');
                $outdata['dataakd'] = $this->First->dataakademik();
                $outdata['semester'] = $this->First->outsemester();
                $outdata['outtahun'] = $this->First->outtahunakd();
                $outdata['outsk'] = $this->First->outjenissk();
                $this->load->view('temp/user2', $outdata);
                $this->load->view('login/footer',$outdata);
                break;
            case 'SK_PRODI':
                $this->load->model('First');
            // pagination start ..
                foreach($outdata['data'] as $row){ $id = $row['ID_PRODI'];}
                $this->load->model('Page');
                $url = base_url().'/Passing/profile/SK_PRODI';
                $counting = $this->Page->count_skprodi($id);
                $config['array']= array($this->page($url, $counting));
                $this->pagination->initialize($config['array']);
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4):0;
                $outdata['links'] = $this->pagination->create_links();
                $outdata['user'] = $this->Page->get_limitsk(8, $page,$id);
            //pagination end ..
                
                
                //$outdata['dataakd'] = $this->First->dataakademikprodi($id);
                $outdata['semester'] = $this->First->outsemester();
                $outdata['outtahun'] = $this->First->outtahunakd();
                $outdata['outsk'] = $this->First->outjenissk();
                $this->load->view('temp/userprodi', $outdata);
                $this->load->view('login/footer',$outdata);
                break;
            case 'persuratan':
                $this->load->model('First');
              
                foreach($outdata['data'] as $row){ $id = $row['ID_PRODI'];}
                $outdata['semester'] = $this->First->outsemester();
                $outdata['surat'] = $this->First->outjenissurat();
                $outdata['namaprodi'] = $this->First->nama_prodi();

                if($id == 15){
                        $this->load->model('Page');
                        $url = base_url().'Passing/profile/persuratan';
                        $counting2 = $this->Page->count_persuratan_dep($id);
                        $config['array']= array($this->page($url, $counting2));
                        $this->pagination->initialize($config['array']);
                        $page = ($this->uri->segment(4)) ? $this->uri->segment(4):0;
                        $outdata['links'] = $this->pagination->create_links();
                        $outdata['persuratan'] = $this->Page->get_limit_surat_dep(8, $page,$id);
                        $this->load->view('temp/persuratan_dep', $outdata);  
                        $this->load->view('login/footer',$outdata);
                    }else{
                        $this->load->model('Page');
                        $url = base_url().'Passing/profile/persuratan';                        
                        $counting = $this->Page->count_persuratan($id);
                        $config['array']= array($this->page($url, $counting));
                        $this->pagination->initialize($config['array']);
                        $page = ($this->uri->segment(4)) ? $this->uri->segment(4):0;
                        $outdata['links'] = $this->pagination->create_links();
                        $outdata['suratprodi'] = $this->Page->get_limit_surat(8, $page,$id);
                        $this->load->view('temp/persuratan', $outdata);
                        $this->load->view('login/footer',$outdata);
                    }
                
                break;
            case 'kemahasiswaan':
                $this->load->model('First');
                $this->load->model('Page');
                
                $outdata['prestasi'] = $this->First->selectprestasi($_SESSION['user']);
                $this->load->view('temp/kemahasiswaan',$outdata);
                break;
            case 'BerkasAll' :
                $this->BerkasAll($out,$outdata);
                break;
            case 'berkasFakultas':
                $namask = $this->uri->segment(4,0);
                foreach($outdata['data'] as $row){ $id = $row['ID_PRODI'];}
                $outdata['semester'] = $this->First->outsemester();
                $outdata['outtahun'] = $this->First->outtahunakd();
                $outdata['outsk'] = $this->First->outjenissk();
                $outdata['dataakd'] = $this->First->outidsk($namask,$id);
                //$this->frontendview($outdata,$out);
                $this->load->view('temp/user2', $outdata);
                $this->load->view('login/footer',$outdata);
                break;
            case 'search':
                $this->searchalldata($idberkas);
                break;
            case 'editsurat':                
                $this->editsurat($outdata);
                break;
            default:
                $this->load->view('temp/user1',$outdata );
                $this->load->view('login/footer',$outdata);
        }  
    }
    function editsurat($outdata){
        $this->load->model('DataEx');
        $this->load->model('First');
        foreach($outdata['data'] as $row){ $id = $row['ID_PRODI'];}
        $id_surat = $this->uri->segment(4,0);
        $outdata['edit'] = $this->DataEx->editsurat($id_surat);
        $outdata['prodi'] = $this->First->nama_prodi();
        $outdata['surat'] = $this->First->outjenissurat();
        $this->load->view('temp/editsurat',$outdata);
    }
    function pasingdatases(){
        
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $count = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['mail'] = $count;
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $_SESSION['idpegawai'] = $idpegawai->ID_PEGAWAI; 
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'], $_SESSION['rule'],$_SESSION['idpegawai']);
        $this->frontendview($outdata,$out);
    }
    function searchsurat(){
        
        //$outdata['data'] = array($profiledata);
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $out['prodi'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        
        //$outdata['data'] = array($profiledata);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $_SESSION['idpegawai'] = $idpegawai->ID_PEGAWAI;
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'],$_SESSION['idpegawai']);
        $this->frontendview($outdata,$out);
        foreach($outdata['data'] as $row){ $id = $row['ID_PRODI'];}
        $cari = $this->input->post('searchsurat');
        
        $outdata['semester'] = $this->First->outsemester();
        $outdata['surat'] = $this->First->outjenissurat();
        $outdata['namaprodi'] = $this->First->nama_prodi();
        if($id == 15){
            $outdata['persuratan'] = $this->First->suratdepartemen($id,$cari);
            $this->load->view('temp/searchsuratdep', $outdata); 
            $this->load->view('login/footer',$outdata); 
            }else{
                $outdata['suratprodi'] = $this->First->searchsurat($id,$cari);
                $this->load->view('temp/searchsuratprodi', $outdata);
                $this->load->view('login/footer',$outdata);
                }
        
    }
    public function logapp()
    {
        $this->load->view('app/LogApp_header');
        $this->load->view('app/LogApp_page');
        $this->load->view('home/footer');
    }
   
    public function adminPassing()
    {
        

        $id_link = $this->uri->segment(3,0);
        switch($id_link)
        {
            case 'create':
                $this->load->view('admin/createAcc', $outadmin);
                break;
            case 'editUpdate':
                $this->editDataUser();
                break;
            case 'delete' :
                $this->deleteDataUser();
                break;
            case 'pengmas':
                $this->datapengmasout($out);
                break;
            case 'penelitian':
                $this->dataoutpenelitian($out );
                break;
            case 'serdos':
                $this->dataserdosout($out);
                break;
            default:
                $this->load->view('admin/createAcc',$out );
          
        }
    }
    function editDataUser(){
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN); 
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi']);
        $idUser = $this->uri->segment(4,0);
        $this->frontendview($outdata, $out);
        $outdata['datauser'] = $this->DataEx->allDataProfile($idUser);
        $outdata['userlog'] = $this->DataEx->dataLoginUser($idUser);
        $this->load->view('admin/editUserData',$outdata);
        $this->load->view('login/footer');
    }
    function deleteDataUser(){
        $this->load->model('DataEx');
        $idLogin = $this->uri->segment(4,0);
        $this->DataEx->deleteUser($idLogin);
        $this->DataEx->deleteLogin($idLogin);
        redirect(site_url('Admin/first'));
    }
    function datapengmasout($out){
        $this->load->model('DataEx');
        $this->load->model('First');
        $idlogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->allDataProfile($idlogin->ID_LOGIN);
            foreach($idpegawai as $row){
                    $idpeg = $row['ID_PEGAWAI'];
                    }
        $out['pengmas'] = $this->First->selectpengmas($idpeg);
        $this->load->view('temp/pengmas',$out);
    }
    function dataoutpenelitian($out){
        $this->load->model('DataEx');
        $this->load->model('First');
        $idlogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->allDataProfile($idlogin->ID_LOGIN);
            foreach($idpegawai as $row){
                    $idpeg = $row['ID_PEGAWAI'];
                    }
        $out['teliti'] = $this->First->selectpenelitian($idpeg);
        $this->load->view('temp/penelitian',$out);
    }
    function dataserdosout($out){
        $this->load->model('DataEx');
        $this->load->model('First');
        $idlogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->allDataProfile($idlogin->ID_LOGIN);
        $id = $this->DataEx->idpegawai($idlogin->ID_LOGIN);
        $count = $this->Page->findmail($id->ID_PEGAWAI)->num_rows();
        $outdata['mail'] = $count;
            foreach($idpegawai as $row){
                    $idpeg = $row['ID_PEGAWAI'];
                    }
        $out['serdos'] = $this->First->selectserdos($idpeg);
        $this->load->view('temp/serdos',$out);
    }
    
    function Akademikdata(){
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $count = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['mail'] = $count;
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $fix = array($_SESSION['user'], $_SESSION['prodi']);
        $out['data'] = array($fix);
        $outdata['jenissk'] = $this->First->outjenissk1();
        //$outdata['data'] = array($profiledata);
         if ($_SESSION['rule'] == 2){$this->load->view('login/header',$outdata);}
            elseif ($_SESSION['rule'] == 4){
                $out['header'] = array('SK_MENGAJAR','BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI','BEBAN_MENGAJAR'); 
                $this->load->view('temp/header1',$outdata);}
                else {$this->load->view('temp/header',$outdata);}
        
        $this->load->view('temp/contenuser1',$outdata);
        $id_link = $this->uri->segment(3,0);
        
    }
    function datakemahasiswaan(){
        $this->load->model('DataEx');
        $this->load->model('Page');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $fix = array($_SESSION['user'], $_SESSION['prodi']);

        $out['data'] = array($fix);
        $outdata['mhs'] = $this->DataEx->outmhs($_SESSION['rule']);
        $outdata['title'] = 'simlib V2';
        $this->frontendview($outdata,$out);
        $this->load->view('temp/kemahasiswaan',$outdata);
        $id_link = $this->uri->segment(3,0);
        
    }
    function BerkasAll(){
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $out['prodi'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        
        //$outdata['data'] = array($profiledata);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $_SESSION['idpegawai'] = $idpegawai->ID_PEGAWAI;
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'],$_SESSION['idpegawai']);
        $this->frontendview($outdata,$out);
        $link = $this->uri->segment(3,0);
        $idprodi = 1;
        switch($link)
        {
            case 'SK_MENGAJAR':
                $out['header'] = "BERKAS SK MENGAJAR";
                $sk ='SK_MENGAJAR';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'SK_DOSEN_WALI':
                $out['header'] = "BERKAS SK DOSEN WALI";
                $sk ='SK_DOSEN_WALI';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'SK_DOSEN_PJMK' :
                $out['header'] = "BERKAS SK PJMK";
                $sk ='SK_DOSEN_PJMK';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'SK_PEMBIMBING_TA':
                $out['header'] = "BERKAS SK PEMBIMBING DAN PENGUJI TA";
                $sk ='SK_PEMBIMBING_TA';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'SK_PEMBIMBING_MAGANG':
                $out['header'] = "BERKAS SK PEMBIMBING MAGANG";
                $sk ='SK_PEMBIMBING_MAGANG';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'PLOTING_JADWAL':
                $out['header'] = "BERKAS PLOTING DOSEN";
                $sk ='PLOTING_JADWAL';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
             case 'BERKAS_MBKM':
                $out['header'] = "BERKAS_MBKM";
                $sk ='BERKAS_MBKM';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'PENGAMBILAN_DATA':
                $out['header'] = "PENGAMBILAN_DATA";
                $sk ='PENGAMBILAN_DATA';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'UNDUR_DIRI':
                $out['header'] = "UNDUR_DIRI";
                $sk ='UNDUR_DIRIL';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'CUTI':
                $out['header'] = "CUTI";
                $sk ='CUTI';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'BEBAN_MENGAJAR':
                $out['header'] = "BEBAN_MENGAJAR";
                $sk ='BEBAN_MENGAJAR';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'SERTIFIKAT_PEGAWAI':
                $out['header'] = "SERTIFIKAT_PEGAWAI";
                $sk ='SERTIFIKAT_PEGAWAI';
                $array = array('JENIS_SK'=>$sk, 'ID_PRODI'=>$idprodi);
                $out['data'] = $this->First->outidsk1($array);
                $this->load->view('content/inputSk', $out);
                break;
            case 'outallberkas':
            
               // pagination start ..
                $this->load->model('Page');
                $url = base_url().'Passing/BerkasAll/outallberkas';
                $counting = $this->Page->get_count();
                $config['array']= array($this->page($url, $counting));
                $this->pagination->initialize($config['array']);
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4):0;
                $out['links'] = $this->pagination->create_links();
                $out['user'] = $this->Page->get_limit(8, $page);
                //pagination end ..

                $out['data'] = $this->DataEx->datauserall();
                foreach($out['data'] as $row){
                    $out['dataprodi'] = $this->DataEx->outdatanamaprodi($row['ID_PRODI']);
                    }

                $out['teliti'] = array(
                    'PENELITIAN', 'PENGMAS','SERDOS'
                );
                //$this->load->view('content/searchdatauser',$out);
                $this->load->view('content/allinberkas',$out );
                break;
            case 'berkassurat':
                $out['user'] = $this->DataEx->datauserall();
                foreach($out['user'] as $row){
                    $out['idprodi'] = $row['ID_PRODI'];
                    $out['dataprodi'] = $this->DataEx->outdatanamaprodi($row['ID_PRODI']);
                    }
                
                $this->load->view('content/berkassurat',$out);
                break;
            default:
                $this->load->view('content/allinberkas',$out );
          
        }
    }
    function passingdatapegawai(){
        $this->load->model('DataEx');
        $this->load->model('First');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $berkas['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        
        $out['data'] = $fix = array($_SESSION['user'], $_SESSION['prodi']);
        if ($_SESSION['rule'] == 2){$this->load->view('temp/header',$outdata);$this->load->view('temp/user1Head',$out );}
            elseif ($_SESSION['rule'] == 4){
                $out['header'] = array('SK_MENGAJAR','BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI','BEBAN_MENGAJAR'); 
                $this->load->view('temp/header1',$outdata);               
                $this->load->view('temp/user3Head',$out );}
                else {$this->load->view('temp/header',$outdata);$this->load->view('temp/user2Head',$out);}
        $link = $this->uri->segment(3,0);
        $linkid = $this->uri->segment(4,0);

        $out['berkaspegawai'] = $this->DataEx->dataskpegawai($linkid);
        $out['berkasout'] = $this->DataEx->skoutpegawai($linkid);
        $this->load->view('content/berkasskpegawai', $out);
        
    }
    function berkasfakultas(){
        $namaberkas = $this->uri->segment();
    }
    function showall(){
        $this->load->library('zip');
        $url = $this->uri->segment(3,0);
        $file = $this->uri->segment(4,0);
        $type = $this->uri->segment(5,0);
        $outdata['url'] = base_url()."upload"."/".$url."/".$file;
        $path = base_url()."upload"."/".$url."/".$file;
        if($type === 'pdf'){ 
            $outdata['file'] ='pdf';
            $this->load->view('content/outpdf',$outdata);
        }
        else{
            $this->load->model('DataEx');
            $this->load->model('First');
            $this->load->model('Page');
            $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
            $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
            $outdata['info'] = $this->Page->countinfo()->num_rows();
            $outdata['berita'] = $this->Page->countinfo()->result();
            $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
            $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
            $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN); 
            $out['data'] = array($_SESSION['user'], $_SESSION['prodi']);
            $outdata['jenissk'] = $this->First->outjenissk1();
            //$outdata['data'] = array($profiledata);
             if ($_SESSION['rule'] == 2){$this->load->view('temp/header',$outdata);}
                elseif ($_SESSION['rule'] == 4){
                    $out['header'] = array('SK_MENGAJAR','BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI','BEBAN_MENGAJAR'); 
                    $this->frontendview($outdata,$out);}
                    //$this->load->view('temp/header1',$outdata);}
                    else {$this->load->view('temp/header',$outdata);}
                        $this->load->view('content/outzip',$outdata);
                        $this->load->view('login/footer');
        }
           
    }
    
    function searchpegawai(){
        $this->load->model('DataEx');
        if(isset($_GET['pegawai'])){
            $resultdata = $this->DataEx->autopegawai($_GET['pegawai']);
            if(count($resultdata) > 0 ){
                foreach($resultdata as $row ){
                    $arr_result['data'] = $row->NAMA_PEGAWAI;
                    echo json_decode($arr_result['data']);
                }
            }
        }

    }
    function searchalldata($idberkas){
        $data['jenissk'] = $this->First->outjenissk();


        if(empty($idberkas)){
             $this->load->view('content/searchdatauser',$data);        
         }
         else{
            $idprodi = 1;
            $array = array('JENIS_SK'=>$idberkas, 'ID_PRODI'=>$idprodi);
            $data['outsearch'] = $this->First->outsearch($array);
            $this->load->view('content/searchdatauser',$data);
            $this->load->view('content/tableout',$data); 
            $this->load->view('login/footer');
            
        }
        
    }
    function showberita(){
        $idberita = $this->uri->segment(3,0);
        $idprodi = $this->uri->segment(4,0);
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $out['prodi'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        
        //$outdata['data'] = array($profiledata);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $outdata['info'] = $this->Page->countinfo()->num_rows();
        $outdata['berita'] = $this->Page->countinfo()->result();
        $outdata['mail'] = $this->Page->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $outdata['surat'] = $this->Page->outmail($idpegawai->ID_PEGAWAI);
        $_SESSION['idpegawai'] = $idpegawai->ID_PEGAWAI;
        $out['data'] = array($_SESSION['user'], $_SESSION['prodi'],$_SESSION['idpegawai']);
        $outdata['berita'] = $this->Page->showalert($idberita);
        $this->frontendview($outdata, $out);
        $this->load->view('admin/showberita',$outdata);
        $this->load->view('login/footer');
    }
    function frontendview($outdata, $out){
        
        if ($_SESSION['rule'] == 2){
            $outdata['title'] = 'simlib V2';
            $outdata['header'] = array('Profile','persuratan'); 
            $this->load->view('login/headerlog',$outdata);
            $this->load->view('login/sidebardosen',$outdata);
            $this->load->view('login/topbar',$outdata);
           }
           elseif ($_SESSION['rule'] == 1){
                $outdata['title'] = 'simlib V2';
                $outdata['header'] = array(''); 
                $this->load->view('login/headerlog',$outdata);
                $this->load->view('admin/sidebaradmin',$outdata);
                $this->load->view('login/topbar',$outdata);              
            }
                elseif ($_SESSION['rule'] == 4){
                    $outdata['title'] = 'simlib V2';
                    $outdata['header'] = array('BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI','BEBAN_MENGAJAR'); 
                    $outdata['head'] = array('SK_MENGAJAR','SK_DOSEN_WALI','SK_DOSEN_PJMK','SK_PEMBIMBING_TA','PLOTING_JADWAL','BEBAN_MENGAJAR');
                    $this->load->view('login/headerlog',$outdata);
                    $this->load->view('login/sidebarfakultas',$outdata);
                    $this->load->view('login/topbar',$outdata);  
                }elseif ($_SESSION['rule'] == 5){
                        $outdata['title'] = 'simlib V2';
                        $outdata['header'] = array('Profile','persuratan'); 
                        $this->load->view('login/headerlog',$outdata);
                        $this->load->view('login/sidebar',$outdata);
                        $this->load->view('login/topbar',$outdata);               
                    }elseif ($_SESSION['rule'] == 6){
                        $outdata['title'] = 'simlib V2';
                        $outdata['header'] = array('Profile'); 
                        $this->load->view('login/headerlog',$outdata);
                        $this->load->view('login/sidebarmhs',$outdata);
                        $this->load->view('login/topbar',$outdata);               
                        }
                        else {
                            $outdata['title'] = 'simlib V2';
                            $outdata['header'] = array('Profile','SK_PRODI', 'Kepegawaian'); 
                            $this->load->view('login/headerlog',$outdata);
                            $this->load->view('login/sidebar',$outdata);
                            $this->load->view('login/topbar',$outdata);
                        }
    }
     function page($url, $counting){
        $config = array();
        $config["base_url"] = $url;
        $config["total_rows"] = $counting;
        $config["per_page"] = 7;
        $config["uri_segment"] = 4;
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
        $config['cur_tag_open'] = '<li class="page-item active"><a style="text-decoration: none" class="page-link" >';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';
               
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4):0;
    }
}