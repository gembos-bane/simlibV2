<?php
class Source_in_out extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model("DataEx","Page");
		$this->load->library("form_validation","session","database","pagination");
        $this->load->helper(array('form','url'));
        if(!isset($_SERVER['HTTP_REFERER'])){
                    $this->load->helper('url');
                    redirect(site_url('Backbone/index'));
                }
    	}	

    function Form_pegawai(){
    	$this->load->model('DataEx');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $outdata['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $fix = array($_SESSION['user'], $_SESSION['prodi']);
        $out['data'] = array($fix);
    	$this->load->view('temp/header',$outdata);
    	$this->load->view('pegawai/create_data_pegawai',$out);
    }
    function doupload(){
        $this->load->model('First');
        $this->load->model('DataEx');
        $db1 = 'berkas_pegawai';
        $db2 = 'ID_BERKAS';
        $namaberkas = $this->input->post('Namask');
        $tahunberkas = $this->input->post('tahunSK');
        $berkas = $this->input->post('berkas');
        $idpegawai = $this->input->post('idpegawai');
        $data['id'] = $this->DataEx->lastdata($db1,$db2);
        foreach ($data['id']  as $value){
            $id = ($value->ID_BERKAS) + 1;
        }
        
        if($this->input->method() === 'post'){
            $namafile = $id.'_'.$tahunberkas . '_' . ($idpegawai);
            $config['upload_path']      = 'upload\sk';
            $config['allowed_types']    = 'pdf|zip|jpeg|docx';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 20240; //1MB
            $config['max_width']        = 1440;
            $config['max_height']       = 1440;
           
            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('berkas')) {
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
                
            }else{
                $dataupbase = array(
                    'ID_BERKAS' => ' ',
                    'NAMA_BERKAS' => $namaberkas,
                    'TAHUN_SK'  => $tahunberkas,
                    'FCPATH' => $config['file_name'].".pdf" ,
                    'ID_PEGAWAI' => $idpegawai
                );
                $data['sucsess'] = array($namaberkas, $tahunberkas, $namafile, $_SESSION['user'] );
                $this->upload->do_upload('berkas');
                $this->First->uploadberkassk($dataupbase);

                redirect(site_url('Passing/profile'));

           }
        }
        
    }
    function updatedata(){
        
        $namapegawai = $this->input->post('Nama');
        $nip = $this->input->post('Nip');
        $pangkat = $this->input->post('Pangkat');
        $prodi = $this->input->post('Prodi');
        $tlp = $this->input->post('tlp');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $tanggal = $this->input->post('tanggal');
        $idpegawai = $this->DataEx->SelectidPegawai($namapegawai);
        $idpegawaiup = $idpegawai->ID_PEGAWAI;
        $dataupdate = array(
            'NAMA_PEGAWAI' => $namapegawai,
            'NIP_PEGAWAI' => $nip,
            'GOLONGAN' => $pangkat,
            'NO_TLP' => $tlp,
            'E_MAIL' => $email,
            'ALAMAT' => $alamat,
            'TMT' => $tanggal
        );
        $this->load->model('First');
        $this->First->UpdateUser($dataupdate,$idpegawaiup);

          redirect(site_url('passing/profile'));   
    }
    function inputdatapengmas(){
        $this->load->model('First');
        $this->load->model('DataEx');
        $judul = $this->input->post('Judul');
        $tanggal = $this->input->post('tanggal');
        $Nosk = $this->input->post('NoSK');
        $Lokasi = $this->input->post('Lokasi');
        $berkas = $this->input->post('berkas');
        $idlogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->allDataProfile($idlogin->ID_LOGIN);
        foreach($idpegawai as $row){
            $idpeg = $row['ID_PEGAWAI'];
            $idprodi = $row['ID_PRODI'];
        }

        if($this->input->method() === 'post'){
            $namafile = 'pengmas'.'_'.$tanggal . '_' . ($_SESSION['user']);
            $config['upload_path']      = 'upload\pengmas';
            $config['allowed_types']    = 'pdf|zip';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 20240; //1MB
            $config['max_width']        = 1080;
            $config['max_height']       = 1080;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('berkas')){
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
            }else{

                $datainsertpengmas = array(
                    'ID_PENGMAS' => ' ',
                    'ID_PEGAWAI' => $idpeg,
                    'JUDUL_PENGMAS' => $judul,
                    'NO_SK' => $Nosk,
                    'TANGGAL_PELAKSANAAN' => $tanggal,
                    'BUKTI' => $config['file_name'].".pdf",
                    'LOKASI' => $Lokasi,
                    'ID_PRODI' => $idprodi
                );
                $this->upload->do_upload('berkas');
                $insertdb = $this->First->insertdatapengmas($datainsertpengmas);
                redirect(site_url('passing/profile').'/pengmas');
            }
            
        }
    }
    function inputpenelitian(){
        $this->load->model('First');
        $this->load->model('DataEx');
        $judul = $this->input->post('judulpenelitian');
        $tanggal = $this->input->post('tanggalpenulisan');
        $Nosk = $this->input->post('NoSK');
        $namajurnal = $this->input->post('jurnal');
        $berkas = $this->input->post('berkas');
        $idlogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->allDataProfile($idlogin->ID_LOGIN);
        foreach($idpegawai as $row){
            $idpeg = $row['ID_PEGAWAI'];
            $idprodi = $row['ID_PRODI'];
        }
        if($this->input->method() === 'post'){
            $namafile = $namajurnal.'_'.$tanggal. '_' . ($_SESSION['user']);
            $config['upload_path']      = 'upload\penelitian';
            $config['allowed_types']    = 'pdf|zip';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 20240; //1MB
            $config['max_width']        = 1080;
            $config['max_height']       = 1080;

            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if(!$this->upload->do_upload('berkas')){
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
            }else{

                $datainsertpenelitian = array(
                    'ID_PENELITIAN' => ' ',
                    'JUDUL_PENELITIAN' => $judul,
                    'NO_SK_PENELITIAN' => $Nosk,
                    'NAMA_JURNAL' => $namajurnal,
                    'TGL_PENELITIAN' => $tanggal,
                    'BERKAS_PENELITIAN' => $config['file_name'].".pdf",
                    'ID_PEGAWAI' => $idpeg,
                    'ID_PRODI' => $idprodi
                );
                $this->upload->do_upload('berkas');
                $insertdb = $this->First->insertdatapenelitian($datainsertpenelitian);
                redirect(site_url('passing/profile').'/penelitian');
            }
            
        }
    }
    function inputserdos(){
        $this->load->model('First');
        $this->load->model('DataEx');
        $judul = $this->input->post('sertifikat');
        $nosertifikat = $this->input->post('nosertifikat');
        $tanggal = $this->input->post('tanggal');
        $intansi = $this->input->post('intansi');
        $berkas = $this->input->post('berkas');
        $idlogin = $this->DataEx->UserProfile($_SESSION['user']);
        $idpegawai = $this->DataEx->allDataProfile($idlogin->ID_LOGIN);
        foreach($idpegawai as $row){
            $idpeg = $row['ID_PEGAWAI'];
            $idprodi = $row['ID_PRODI'];
        }
        if($this->input->method() === 'post'){
            $namafile = $intansi.'_'.$tanggal. '_' . ($_SESSION['user']);
            $config['upload_path']      = 'upload\serdos';
            $config['allowed_types']    = 'pdf|zip';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 20240; //1MB
            $config['max_width']        = 1080;
            $config['max_height']       = 1080;

            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if(!$this->upload->do_upload('berkas')){
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
            }else{

                $dataserdos = array(
                    'ID_SERDOS' => ' ',
                    'ID_PEGAWAI' => $idpeg,
                    'NAMA_SERTIFIKAT' => $judul,
                    'NO_SERTIFIKAT' => $nosertifikat,
                    'TGL_PELAKSANAAN_SERDOS' => $tanggal,
                    'INTANSI' => $intansi,
                    'LOKASI_BERKAS' => $config['file_name'].".pdf",
                    'ID_PRODI' => $idprodi
                    
                );
                $this->upload->do_upload('berkas');
                $insertdb = $this->First->insertserdos($dataserdos);
                redirect(site_url('passing/profile').'/serdos');
            }
            
        }
    }
    function insertdatask(){
        $this->load->model('First');
        $this->load->model('DataEx');
        $db1 = 'bekas_akademik';
        $db2 = 'ID_BERKAS_AKD';
        $idjenissk = $this->input->post('jenissk');
        $tahun = $this->input->post('tahun');
        $semester = $this->input->post('semester');
        $berkas = $this->input->post('berkassk');
        $tipe = $this->input->post('tipe');
        $namask = $this->First->outsk($idjenissk);
        $idprodi = $this->input->post('idprodi');

        $data['id'] = $this->DataEx->lastdata($db1,$db2);
        foreach ($data['id']  as $value){
            $id = ($value->ID_BERKAS_AKD) + 1;
        }


        if($this->input->method() === 'post'){
            $namafile = $id.'_'.$idjenissk.'_'.$tahun;
            $config['upload_path']      = 'upload\skmengajar';
            $config['allowed_types']    = 'pdf|zip';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 20240; //10MB
            $config['max_width']        = 1080;
            $config['max_height']       = 1080;

            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if(!$this->upload->do_upload('berkassk')){
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
            }else{

                $datask = array(
                    'ID_BERKAS_AKD' => ' ',
                    'ID_JENIS_SK' => $idjenissk,
                    'TAHUN_AKD' => $tahun,
                    'SEMESTER' => $semester,
                    'LOKASI_BERKAS' => $config['file_name'].'.'.$tipe,
                    'NAMA_MHS' => ' ',
                    'TYPE_FILE' => $tipe,
                    'ID_PRODI' => $idprodi
                    
                );
                $this->upload->do_upload('berkas');
                $insertdb = $this->First->insertdatask($datask);
                redirect(site_url('passing/profile').'/akademikprodi/#'.hash('sha256',$_SESSION['user']));
            }
            
        }
    }
    function insertsurat(){
        $this->load->model('First');
        $this->load->model('DataEx');
        $db1 = 'persuratan';
        $db2 = 'ID_SURAT';
        $idjenissurat = $this->input->post('jenissurat');
        $tanggal = $this->input->post('tanggal');
        $nomorsurat = $this->input->post('nomor_surat');
        $perihal = $this->input->post('perihal');
        $berkas = $this->input->post('berkassurat');
        $tipe = $this->input->post('tipe');
        $idpengirim = $this->input->post('idpengirim');
        $idprodi = $this->input->post('idprodi');
        $data['id'] = $this->DataEx->lastdata($db1,$db2);
        foreach ($data['id']  as $value){
            $idnumber = ($value->ID_SURAT) + 1;
        }
        
        if($this->input->method() === 'post'){
            $namafile = $idnumber.'_'.$idjenissurat.'_'.$db1;
            $config['upload_path']      = 'upload\persuratan';
            $config['allowed_types']    = 'pdf|zip';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 20240; //10MB
            $config['max_width']        = 1080;
            $config['max_height']       = 1080;

            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if(!$this->upload->do_upload('berkassurat')){
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
            }else{

                $datasurat = array(
                    'ID_SURAT' => ' ',
                    'ID_JENIS_SURAT' => $idjenissurat,
                    'ID_PRODI' => $idprodi,
                    'ID_PENGIRIM' => $idpengirim,
                    'PERIHAL_SURAT' => $perihal,
                    'NO_SURAT' => $nomorsurat,
                    'TANGGAL_SURAT' => $tanggal,
                    'LOKASI_SURAT' => $config['file_name'].'.'.$tipe,
                    'TYPE_FILE_SURAT' => $tipe
                    
                );
                $this->upload->do_upload('berkas');
                $insertdb = $this->First->insertsurat($datasurat);
                redirect(site_url('passing/profile').'/persuratan/#'.hash('sha256',$_SESSION['user']));
            }
            
        }
    }
    
    function outdataallberkas(){
        $this->load->library('pagination');
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $idLogin = $this->DataEx->UserProfile($_SESSION['user']);
        $berkas['data'] = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
        $fix = array($_SESSION['user'], $_SESSION['prodi']);
        $idpegawai = $this->DataEx->idpegawai($idLogin->ID_LOGIN);
        $berkas['mail'] = $this->DataEx->findmail($idpegawai->ID_PEGAWAI)->num_rows();
        $out['data'] = array($fix);
        $this->load->view('temp/header',$berkas);
        $link = $this->uri->segment(3,0);
        $berkas = $this->uri->segment(4,0);
        
        switch($berkas){
            case 'PENELITIAN':
                $outberkas['content'] = array('TGL_PENELITIAN','JUDUL_PENELITIAN','NAMA_JURNAL','NO_SK_PENELITIAN');
                $outberkas['berkas'] = $this->DataEx->outdataberkas($link);
                $this->load->view('content/outberkasall',$outberkas);
                break;
            case 'SERDOS':
                $outberkas['berkas'] = $this->DataEx->outdataserdos($link);
                $this->load->view('content/dataoutserdos',$outberkas);
                break;
            case 'PENGMAS':
                $item = 'Source_in_out/outdataallberkas/2/PENGMAS';
                $this->pageging($item,$idLogin,$link);
                break;
            case 'REQUEST':
                $this->outrequest($idpegawai->ID_PEGAWAI);
                break;
            case 'RESPONS':
                $this->respons();
                break;
            case 'persuratan':
                $this->persuratan();
                break;
            default:
        }
    }
    function persuratan(){
        $this->load->model('DataEx');
        $data['surat'] = $this->DataEx->jenissurat();
        echo $idprodi = $_SESSION['rule'];
        echo $owner = $this->uri->segment(3,0);
        echo $idjenissk = $this->uri->segment(4,0);
        echo $idrequestor = $this->uri->segment(5,0);
        
    }
    function pageging($item,$idLogin,$link){
        $perpage = 6;
        $offset = $this->uri->segment(1,0);
        $config['base_url'] = site_url('Source_in_out/outdataallberkas');
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Page->outberkaspengmas($perpage,$offset,$link)->num_rows(); 
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);
        $outberkas['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $outberkas['berkas'] = $this->DataEx->outdatapengmas($link);
        $outberkas['pagination'] = $this->pagination->create_links(); 
        $this->load->view('content/dataoutpengmas',$outberkas);
    }
    function insertkemahasiswaan(){
        $this->load->model('First');
        $this->load->model('DataEx');
        $idpegawai = $this->input->post('idpegawai');
        $nama = $this->input->post('namamhs');
        $nim = $this->input->post('nim');
        $ketprestasi = $this->input->post('katagori');
        $berkas = $this->input->post('berkas');
        $idprodi = $_SESSION['rule']; 

        if($this->input->method() === 'post'){
            $namafile = 'kemahasiswaan'.'_'.$idpegawai.'_'.$nim;
            $config['upload_path']      = 'upload\mahasiswa';
            $config['allowed_types']    = 'pdf|zip';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 20240; //10MB
            $config['max_width']        = 1080;
            $config['max_height']       = 1080;

            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if(!$this->upload->do_upload('berkas')){
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
            }else{

                $datamhs = array(
                    'ID_KEGIATAN_MHS' => ' ',
                    'NAMA_MAHASISWA' => $nama,
                    'NIM_MHS' => $nim,
                    'KET_PRESTASI' => $ketprestasi,
                    'BERKAS_MHS' => $config['file_name'].".pdf",
                    'ID_PEGAWAI' => $idpegawai,
                    'ID_PRODI' => $idprodi
                    
                );
                $this->upload->do_upload('berkas');
                $insertdb = $this->First->insertdatamhs($datamhs);
                redirect(site_url('passing/profile').'/akademik');
            }
            
        }

    }
    function request(){
        
        $this->load->model('DataEx');
        $owner = $this->uri->segment(3,0);
        $idjenissk = $this->uri->segment(4,0);
        $idrequestor = $this->uri->segment(5,0);
        $berkas = " berkas kepegawaian dan sertifikast";
        $now = date("y-m-d");
        $req = array(
            'ID_MAILING' => ' ',
            'MAILING' => $berkas,
            'ID_PEGAWAI' => $owner,
            'TIME_SEND' => $now,
            'SENDER' => $idrequestor,
            'ID_JENIS_SK' => $idjenissk
        );
        
        $this->DataEx->request($req);
       
        redirect(site_url('Passing/BerkasAll').'/outallberkas/');
    }
    function outrequest($id){
        $this->load->model('DataEx');
        $this->load->model('Page');
        
        $outdata['request'] = $this->Page->requestoutmail($id);
        $this->load->view('content/request',$outdata);
    }
    function respons(){
        $this->load->model('DataEx');
        $this->load->model('Page');
        $status = $this->uri->segment(4,0);
        $idrequest = $this->uri->segment(3,0);
        $idpegawai = $this->uri->segment(5,0);

        if ($status == 2){
            $this->DataEx->delmailing($idrequest);
            $this->outdataallberkas();
        }
        else{
            $this->DataEx->updateberkas($status,$idpegawai);
            redirect(site_url('Passing/profile'));
        }
    }
    function deldata(){
        $this->load->model('DataEx');
        $idberkas = $this->uri->segment(3,0);
        $file = $this->uri->segment(4,0);
        $jenisberkas = $this->uri->segment(5,0);

        if(empty($jenisberkas)){
            $target = base_url().'upload/sk/'.$file;
            echo '<script language="javascript">';
            echo 'alert("Anda akan menghapus data ini yakin?")';
            echo '</script>';
            $this->DataEx->deletedata($idberkas);
        }else{
            $target = base_url().'upload/skmengajar/'.$file;
            echo '<script language="javascript">';
            echo 'alert("Anda akan menghapus berkas sk ini.... yakin?")';
            echo '</script>';
            $this->DataEx->delberkassk($idberkas);
            $this->deldatask($target);
        }
        
        
    }
    function deldatask($target){
        if(file_exists($target)){
            unlink($target);
             echo '<script language="javascript">';
            echo 'alert("file anda berhasil dihapus")';
            echo '</script>';
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("mohon cek kembali permasalahan  dari file anda")';
            echo '</script>';
        
        }
        redirect(site_url('Passing/profile').'/pegawai/'.hash('sha256',$_SESSION['user']));
    }
    

}