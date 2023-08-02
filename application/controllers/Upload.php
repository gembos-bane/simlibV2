<?php
class Upload extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('DataEx','First');
        $this->load->library('form_validation','session','database');
        $this->load->helper(array('form','url'));
        if(!isset($_SERVER['HTTP_REFERER'])){
                    $this->load->helper('url');
                    redirect(site_url('Backbone/index'));
                }

        }   

    function Apiheader(){
        $this->load->model('DataEx');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $fix = array($_SESSION['user'], $_SESSION['prodi']);
        $out['data'] = array($fix);
        if ($_SESSION['rule'] == 2){$this->load->view('temp/header',$outdata);$this->load->view('temp/user1Head',$out );}
            elseif ($_SESSION['rule'] == 4){
                $out['header'] = array('SK_MENGAJAR','SK_DOSEN_WALI','SK_DOSEN_PJMK','SK_PEMBIMBING_TA','PLOTING_JADWAL','BEBAN_MENGAJAR','BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI'); 
                $this->load->view('temp/header1',$outdata);               
                $this->load->view('temp/user3Head',$out );}

                elseif ($_SESSION['rule'] == 5){
                    $out['header'] = array('profile','persuratan'); 
                    $this->load->view('temp/header2',$outdata);               
                    $this->load->view('temp/user5Head',$out );}

                    else {$this->load->view('temp/header',$outdata);$this->load->view('temp/user2Head',$out);}
       
        $action = $this->uri->segment(3,0);
        $idsurat = $this->uri->segment(4,0);
        switch($action){
            case 'edit':
                $jenissurat = $this->input->post('jenissurat');
                $tanggal = $this->input->post('tanggal');
                $no_surat = $this->input->post('nomorsurat');
                $perihal = $this->input->post('perihal');
                $idprodi = $this->input->post('idprodi');
                $idpengirim = $this->input->post('idpengirim');
                $berkassurat = $this->input->post('berkassurat');
                $outdata['dbupdate'] = array('ID_JENIS_SURAT'=>$jenissurat, 'TANGGAL_SURAT'=>$tanggal, 'NO_SURAT'=>$no_surat, 'PERIHAL_SURAT'=>$perihal, 'ID_PRODI'=>$idprodi,'ID_PENGIRIM'=>$idpengirim);
                return $this->editsurat($idsurat, $outdata,$idpengirim);
                break;
            default: 
                $this->load->view('temp/persuratan_dep', $outdata); 
            }
    }
    
    function editsurat($idsurat, $outdata,$idpengirim){
        $this->load->library('user_agent');
        //$this->load->model('First');
        //$this->First->editsurat($outdata, $idsurat);
        ?>
        <script type="text/javascript">
                alert('Edit Data success, Please check your list data');
                location.replace("<?php echo site_url('Passing/profile/persuratan/'.$idpengirim.'/profile')?>");
        </script>
        <?php

        

    }
}
