<?php

class MHS extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model(array('DataEx','First','Mahasiswa','Yudisium'));
        $this->load->library('form_validation','session','database','Pdf');
        $this->load->helper(array('form','url'));
        error_reporting(0);
    }  

    function index(){
        if(!isset($_SERVER['HTTP_REFERER'])){
                    $this->load->helper('url');
                    redirect(site_url('Backbone/index'));

                }
       
        $this->reportmhs();
    }

    function bypasmagang(){
        $magang = $this->input->post('magang');
        $jenismagang = $this->input->post('jenismagang');
        $modemagang = $this->input->post('modemagang');
        $jenis = $this->input->post('jenis');
        if($jenismagang == 1){
            $this->magangpersonal($magang,$jenis,$modemagang);
        }else{
            $this->magangkelompok($magang,$jenis,$modemagang);
        }
    }
    function newmhs(){
        $outdata['prodi'] = $this->First->nama_prodi();
        $outdata['title'] = 'MSMHS_SIMLIBV2';
        //$this->load->view('login/headerlog',$outdata);
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
        
        $check = $this->Check->checkname($nip)->num_rows();

        if($check != null){
            echo "<script type='text/javascript'>";
            echo "alert('Anda sudah memiliki account, mohon login dengan account yang sudah anda miliki')";
            echo "</script>";
            redirect(site_url('Home/index'));
        }else{
            
        
            if(empty($username && $password && $password2 && $nama && $nip)){
                echo '<script language="javascript">';
                echo 'alert("data yang anda inputkan tidak boleh kosong")';
                echo '</script>';
                $this->newmhs(); 
            }elseif($password == $password2){
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
                echo '<script language="javascript">';
                echo 'alert("password not same, please insert corectly")';
                echo '</script>'; 
                redirect(site_url('MHS/createaccount'));
            }
        }

    }
   function magang(){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        
        $cmagang = $this->Mahasiswa->countmg($id)->num_rows();
        $tglinput = $this->Mahasiswa->desctgl($id)->result();
        foreach($tglinput as $row){
            $dateup = $row->TANGGAL_MHS_INPUT;
                }
         if($cmagang >= 2){
                $tanggal = date('Y-m-d',strtotime('+30 day',strtotime($dateup)));
                $timestamp1 = strtotime($tanggal);
                $timestamp2 = strtotime(date('Y-m-d'));

                if($timestamp1 < $timestamp2){
                    $outdata['user'] = $this->DataEx->datauser($id);
                    $outdata['tujuan'] = $this->Mahasiswa->tujuan();
                    $this->load->view('mahasiswa/uimagang',$outdata);
                }else{
                    $outdata['pesan'] = $tanggal; 
                    $this->load->view('mahasiswa/report',$outdata);
                } 
         }else{ 
                $outdata['user'] = $this->DataEx->datauser($id);
                $outdata['tujuan'] = $this->Mahasiswa->tujuan();
                $this->load->view('mahasiswa/uimagang',$outdata);
                }

        /*$data = $this->Mahasiswa->countmsg($id)->result();
            foreach($data as $key){
                $tanggal = date('Y-m-d',strtotime('+30 day',strtotime('2025-11-22')));
                $idpkl = $key->ID_DATA_PKL;
            }
            $timestamp1 = strtotime($tanggal);
            $timestamp2 = strtotime(date('Y-m-d'));

        if($timestamp1 < $timestamp2){$this->Mahasiswa->countmsgdel($idpkl);}

        $mailing = $this->Mahasiswa->countmsg($id);
        if($mailing->num_rows() != 0){
            $outdata['pesan'] = $this->Mahasiswa->countmsg($id)->result();
            $this->load->view('mahasiswa/report',$outdata);
        }else{
            $outdata['user'] = $this->DataEx->datauser($id);
            $outdata['tujuan'] = $this->Mahasiswa->tujuan();

            $this->load->view('mahasiswa/magang',$outdata);
            
        }*/
        $this->load->view('login/footer');
        
    }
    
    /*function magangpersonal(){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        $idprodi = $this->DataEx->datauser($id);
        foreach($idprodi as $key){
            $idprod = $key['ID_PRODI'];
        }
        $outdata['namadosen'] = $this->DataEx->namadosen($idprod);
        $jenis = $this->uri->segment(3,0);

        if($jenis==1){
            $outdata['headerpos']  = 'Magang';
            $outdata['value']  = 1;
        }else{
            $outdata['headerpos'] = 'PKL';
            $outdata['value']  = 2;
        }

        $outdata['departemen'] = $this->Mahasiswa->departemen();
        $outdata['user'] = $this->DataEx->datauser($id);
        $outdata['tujuan'] = $this->Mahasiswa->tujuan();
        $this->load->view('mahasiswa/magangpersonal',$outdata);
        $this->load->view('login/footer');
    }*/
    function magangpersonal($magang,$jenis,$modemagang){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        $idprodi = $this->DataEx->datauser($id);
        foreach($idprodi as $key){
            $idprod = $key['ID_PRODI'];
        }
        $outdata['namadosen'] = $this->DataEx->namadosen($idprod);
        //$jenis = $this->uri->segment(3,0);
        $jenis;
        if($jenis == 1 && $modemagang == 1){
            $outdata['headerpos']  = 'Magang';
            $outdata['value']  = 1;
            $outdata['headmagang'] = 'Mandiri';
            }
        if($jenis == 1 && $modemagang == 2){
            $outdata['headerpos'] = 'Magang';
            $outdata['value']  = 1;
            $outdata['headmagang'] = 'Wajib';
        }else{
            $outdata['headerpos'] = 'PKL';
            $outdata['value']  = 2;
        }

        $outdata['departemen'] = $this->Mahasiswa->departemen();
        $outdata['user'] = $this->DataEx->datauser($id);
        $outdata['tujuan'] = $this->Mahasiswa->tujuan();
        $this->load->view('mahasiswa/magangpersonal',$outdata);
        $this->load->view('login/footer');
    }

     function magangkelompok($magang,$jenis,$modemagang){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        $idprodi = $this->DataEx->datauser($id);
        foreach($idprodi as $key){
            $idprod = $key['ID_PRODI'];
        }
        $outdata['namadosen'] = $this->DataEx->namadosen($idprod);
        //$jenis = $this->uri->segment(3,0);
        if($jenis == 1 && $modemagang == 1){
            $outdata['headerpos']  = 'Magang';
            $outdata['value']  = 1;
            $outdata['headmagang'] = 'Mandiri';
        }elseif($jenis == 1 && $modemagang == 2){
            $outdata['headerpos'] = 'Magang';
            $outdata['value']  = 1;
            $outdata['headmagang'] = 'Wajib';
        }else{
            $outdata['headerpos'] = 'PKL';
            $outdata['value']  = 2;
        }
        $outdata['departemen'] = $this->Mahasiswa->departemen();
        $outdata['user'] = $this->DataEx->datauser($id);
        $outdata['tujuan'] = $this->Mahasiswa->tujuan();
        $this->load->view('mahasiswa/magangkelompok',$outdata);
        $this->load->view('login/footer');
    }
   /*function magangkelompok(){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        $idprodi = $this->DataEx->datauser($id);
        foreach($idprodi as $key){
            $idprod = $key['ID_PRODI'];
        }
        $outdata['namadosen'] = $this->DataEx->namadosen($idprod);
        $jenis = $this->uri->segment(3,0);
        if($jenis==1){
            $outdata['headerpos']  = 'Magang';
            $outdata['value']  = 1;
        }else{
            $outdata['headerpos'] = 'PKL';
            $outdata['value']  = 2;
        }
        $outdata['departemen'] = $this->Mahasiswa->departemen();
        $outdata['user'] = $this->DataEx->datauser($id);
        $outdata['tujuan'] = $this->Mahasiswa->tujuan();
        $this->load->view('mahasiswa/magangkelompok',$outdata);
        $this->load->view('login/footer');
    }*/
    function pkl(){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        
        $cmagang = $this->Mahasiswa->countmg($id)->num_rows();
        $tglinput = $this->Mahasiswa->desctgl($id)->result();
        foreach($tglinput as $row){
            $dateup = $row->TANGGAL_MHS_INPUT;
                }
         if($cmagang >= 2){
                $tanggal = date('Y-m-d',strtotime('+30 day',strtotime($dateup)));
                $timestamp1 = strtotime($tanggal);
                $timestamp2 = strtotime(date('Y-m-d'));

                if($timestamp1 < $timestamp2){
                    $outdata['user'] = $this->DataEx->datauser($id);
                    $outdata['tujuan'] = $this->Mahasiswa->tujuan();
                    $this->load->view('mahasiswa/magang',$outdata);
                }else{
                    $outdata['pesan'] = $tanggal; 
                    $this->load->view('mahasiswa/report',$outdata);
                } 
         }else{ 
                $idprodi = $this->DataEx->datauser($id);
                $outdata['user'] = $this->DataEx->datauser($id);
                $outdata['tujuan'] = $this->Mahasiswa->tujuan();
                $this->load->view('mahasiswa/uipkl',$outdata);
                }


            /*$data = $this->Mahasiswa->countmsg($id)->result();
            foreach($data as $key){
                $tanggal = date('Y-m-d',strtotime('+30 day',strtotime($key->TIME_SEND)));
                $idpkl = $key->ID_DATA_PKL;
            }

            $timestamp1 = strtotime($tanggal);
            $timestamp2 = strtotime(date('Y-m-d'));

        if($timestamp1 < $timestamp2){ $this->Mahasiswa->countmsgdel($idpkl);}
        $mailing = $this->Mahasiswa->countmsg($id);
        if($mailing->num_rows() != 0){
            $outdata['pesan'] = $this->Mahasiswa->countmsg($id)->result();
            
                $this->load->view('mahasiswa/report',$outdata);
                
        }else{
        $idprodi = $this->DataEx->datauser($id);
        $outdata['user'] = $this->DataEx->datauser($id);
        $outdata['tujuan'] = $this->Mahasiswa->tujuan();
        $this->load->view('mahasiswa/pkl',$outdata);
        
        }*/
        $this->load->view('login/footer');
    }
    function bukti(){
        $file = $this->uri->segment(4,0);
        $url = $this->uri->segment(3,0);
        $outdata['file'] = 'pdf';
        $outdata['url'] = base_url()."upload"."/".$url."/".$file;
        $path = base_url()."upload"."/".$url."/".$file;
        $this->load->view('content/outpdf',$outdata);
    }
    function skripsi(){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        $idprodi = $this->DataEx->datauser($id);
        foreach($idprodi as $row){ $idprod = $row['ID_PRODI'];}

        $outdata['dosen'] = $this->Mahasiswa->namadosen($idprod);
        $outdata['user'] = $this->DataEx->datauser($id);
        $this->load->view('mahasiswa/skripsi', $outdata);
        $this->load->view('login/footer');
    }
    function insertpkl(){
        $this->load->model('Mahasiswa');
        $this->load->model('DataEx');
        $thn = date('Y');
        $tahunakd = $this->Mahasiswa->settahunakd($thn)->result();
        foreach($tahunakd as $row){$thun = $row->ID_TAHUN_AKD;}
        
        $id_mhs = $this->input->post('idmhs');
        $buktiPerusahaan = $this->input->post('bukti');
        $date = date("Y-m-d");
        $id = $_SESSION['idpegawai'];
        $idprodi = $this->DataEx->datauser($id);
        $datapengajuan = $this->input->post('jml');
        foreach($idprodi as $row){ $idprod = $row['ID_PRODI'];}

        $datapkl = array(

            'ID_DATA_PKL' => ' ',
            'ID_PEGAWAI' => $this->input->post('idmhs'),
            'ID_TUJUAN' => $this->input->post('tujuan'),
            'NAMA_PERUSAHAAN' => $this->input->post('perusahaan'),
            'ALAMAT_PERUSAHAAN' => $this->input->post('almtprsh'),
            'KOTA' => ' ',
            'TGL_MULAI' => $this->input->post('waktumulai'),
            'TGL_BERAKHIR' => $this->input->post('waktuakhir'),
            'EMAIL_TLP' => $this->input->post('kps'),
            'RESPONS' => ' ',
            'VALUE_DATA' => $this->input->post('value'),
            'ID_DEPARTEMEN' => $this->input->post('departemen'),
            'ID_NAMA_DOSEN' => $this->input->post('dosen'),
            'JENIS_MAGANG' => $this->input->post('jenis'),
            'ID_PRODI' => $idprod,
            'TYPE' => ' ',
            'ID_SEMESTER' => 1,
            'ID_TAHUN_AKD' => $thun,
            'TANGGAL_MHS_INPUT'=> $date
        );
        
        $this->Mahasiswa->insertpkl($datapkl);
        $iddatapkl = $this->Mahasiswa->selectdatapkl($id_mhs);
        foreach($iddatapkl as $row){
            $idpkl = $row->ID_DATA_PKL;
        }

        if($datapengajuan == 1){
            $type = 1;
            $data = array(
                'ID_MHS_PKL' => ' ',
                'ID_DATA_PKL' => $idpkl,
                'NAMA_MHS' => $this->input->post('nama'),
                'NIM_MHS' => $this->input->post('nim'),
                'NO_TLP_MHS' => $this->input->post('tlp'),
                'ID_PRODI' => $idprod,
                'TYPE_PENGAJUAN' => $type,
                'ID_SEMESTER' => 1,
                'ID_TAHUN_AKD' => 8
            );
            $this->Mahasiswa->insertpklkelompok($data);
            $datamail = array(
                'ID_MAILING' => ' ',
                'MAILING' => 'Data Masih dalam proses PAA AKADEMIK',
                'ID_PEGAWAI' => $this->input->post('idmhs'),
                'TIME_SEND' => date('Y-m-d'),
                'SENDER' => ' ',
                'TUJUAN_MAGANG' => $this->input->post('perusahaan'),
                'ID_DATA_PKL' => $idpkl
            );
            $this->Mahasiswa->insertmailing($datamail);
        }else{
           
            $type = 2;
            for($a=1;$a<=$datapengajuan;$a++){
                $data = array(
                    'ID_MHS_PKL' => ' ',
                    'ID_DATA_PKL' => $idpkl,
                    'NAMA_MHS' => $this->input->post('nm'.$a),
                    'NIM_MHS' => $this->input->post('nim'.$a),
                    'NO_TLP_MHS' => $this->input->post('tlp'.$a),
                    'ID_PRODI' => $idprod,
                    'TYPE_PENGAJUAN' => $type,
                    'ID_SEMESTER' => 1,
                    'ID_TAHUN_AKD' => 8
                );
                $this->Mahasiswa->insertpklkelompok($data);
                /* edited in october 2024 */
                /*$nimcheck = $this->input->post('nim'.$a);
                $result = $this->Mahasiswa->countnim($nimcheck)->num_rows();
                    if($result > 2){
                        $namamhs = $this->Mahasiswa->countnim($nimcheck)->result();
                            foreach($namamhs as $row){
                                $outname = $row->NAMA_MHS;
                                echo '<script type="text/javascript">';
                                echo 'alert("Mohon maaf'.$outname.' sudah lebih dari 2x mengajukan permohonan magang")';
                                echo '</script>';
                                redirect(site_url('MHS/index'));
                            }
                        }else{$this->Mahasiswa->insertpklkelompok($data); }*/
                        /* ----- end edited --- */
            }

                $datamail = array(
                'ID_MAILING' => ' ',
                'MAILING' => 'Data Masih dalam proses PAA AKADEMIK',
                'ID_PEGAWAI' => $this->input->post('idmhs'),
                'TIME_SEND' => date('Y-m-d'),
                'SENDER' => ' ',
                'TUJUAN_MAGANG' => $this->input->post('perusahaan'),
                'ID_DATA_PKL' => $idpkl
                );
                $this->Mahasiswa->insertmailing($datamail);
        }
           
       /*  upload berkas bukti; */
        if($this->input->method() === 'post'){
            $namafile = $idpkl.'_'.'bukti_perusahaan';
            $config['upload_path']      = 'upload\buktiDiterima';
            $config['allowed_types']    = 'pdf|jpeg|PDF|JPG';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 10240; //1MB
            $config['max_width']        = 1440;
            $config['max_height']       = 1440;
           
            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('bukti')) {
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
                
            }else{
                $buktiup= array(
                    'ID_BUKTI_TERIMA' => ' ',
                    'NAMA_BUKTI' => $config['file_name'].".pdf",
                    'ID_DATA_PKL'  => $idpkl
                );
                $data['sucsess'] = array($namaberkas, $tahunberkas, $namafile, $_SESSION['user'] );
                $this->upload->do_upload('bukti');
                $this->Mahasiswa->insertbuktiterima($buktiup);

           }
        }
        /* end upload bukti */
        
       if(isset($data) === true){
            echo '<script type="text/javascript">';
            echo 'alert("data yang anda inputkan sukses mohon ditunggu konfirmasi Admin untuk keberlanjutan proses cetak surat pengantar")';
            echo '</script>';
            redirect(site_url('MHS/index'));
        }else{
            echo '<script type=text/javascript">';
            echo 'alert("data yang anda inputkan tidak falid, mohon cek ulang kebenaran data anda")';
            echo '</script>';
            redirect(site_url('MHS/index'));
        }

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
    function pengambilandata(){
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $id = $_SESSION['idpegawai'];
        $idprodi = $this->DataEx->datauser($id);
        $outdata['user'] = $this->DataEx->datauser($id);
        $outdata['tujuan'] = $this->Mahasiswa->tujuan();
        $outdata['departemen'] = $this->Mahasiswa->departemen();
        $this->load->view('mahasiswa/ambildata',$outdata);
        $this->load->view('login/footer');
    }
    function insertpengambilandata(){
        $this->load->model('DataEx');
        $id = $_SESSION['idpegawai'];
        $idprod = $this->DataEx->datauser($id);
        foreach($idprod as $row){ $idprodi = $row['ID_PRODI'];}
        $data = array(
            'ID_AMBIL_DATA' => ' ',
            'ID_PEGAWAI' => $this->input->post('idmhs'),
            'ID_TUJUAN' => $this->input->post('tujuan'),
            'NAMA_PERUSAHAAN' => $this->input->post('perusahaan'),
            'ALAMAT_PERUSAHAAN' => $this->input->post('almtprsh'),
            'KOTA' => $this->input->post('kota'),
            'ID_PRODI' => $idprodi,
            'STATUS_PROSES' => ' ',
            'ID_DEPARTEMEN' => $this->input->post('departemen'),
            'ID_SEMESTER' => 2,
            'ID_TAHUN_AKD' => 8
        );
        $this->load->model('Mahasiswa');
        $this->Mahasiswa->insertambildata($data);
        if(isset($data) === true){
            echo '<script type="text/javascript">';
            echo 'alert("data yang anda inputkan sukses mohon ditunggu konfirmasi Admin untuk keberlanjutan proses cetak surat pengantar")';
            echo '</script>';
            redirect(site_url('MHS/index'));
        }else{
            echo '<script type="text/javascript">';
            echo 'alert("data yang anda inputkan tidak falid, mohon cek ulang kebenaran data anda")';
            echo '</script>';
            redirect(site_url('MHS/index'));
        }

    }
    
    
   /* function Fjuanambildata(){
        $this->load->model('Mahasiswa');
        $idberkas = $this->uri->segment(3,0);
        //$idmhs = $this->uri->segment(4,0);
        $outdata['proses'] = 'Permohonan Pengambilan Data';
        $outdata['berkas'] = $this->Mahasiswa->pengambilandata($idberkas);
        $outdata['isi'] = $this->Mahasiswa->pengambilandata($idberkas);
        $this->frontuimhs();
        $this->load->view('mahasiswa/pengambilandata',$outdata);
        $this->load->view('login/footer');
    }*/
    function revisipengajuan(){
        $this->load->model('Mahasiswa');
        $tujuan = $this->input->post('tujuan');
        $namaperusahaan = $this->input->post('perusahaan');
        $alamat = $this->input->post('alamat');
        $kota = $this->input->post('kota');
        $id = $this->input->post('id');
        $data = array(

        );
        $this->Mahasiswa->revisidatapkl();
    }
    function prosespengajuan(){
        $this->load->model('Mahasiswa');
        if(date('m')>=7){ $outdata['sems'] = 'Gasal';}else{$outdata['sems'] = 'Genap';}
        $idberkas = $this->uri->segment(3,0);
        //$namamhs = $this->uri->segment(4,0);
        $peng = $this->uri->segment(6,0);
        $jenis = $this->uri->segment(7,0);
        if($peng == 1){$outdata['proses'] = 'Magang';}else{$outdata['proses'] = 'Praktek Kerja Lapangan (PKL)';}

        if($jenis == 1){
            $outdata['berkas'] = $this->Mahasiswa->prosesberkas($idberkas);
            //$outdata['isi'] = $this->Mahasiswa->prosesberkasberkelompok($idberkas);
            $outdata['mhs'] = $this->Mahasiswa->prosesdatapkl($idberkas);
        }else{
            $outdata['berkas'] = $this->Mahasiswa->pengajuanberkelompok($idberkas);
            //$outdata['isi'] = $this->Mahasiswa->prosesberkasberkelompok($idberkas);
            $outdata['mhs'] = $this->Mahasiswa->prosesdatapkl($idberkas);
        }
        foreach($outdata['mhs'] as $row ){
            $nimcheck = $row['NIM_MHS'];
        }
         $result = $this->Mahasiswa->countnim($nimcheck)->num_rows();
         if($result >= 2){
            $outdata['check'] = 1;
         }else{ $outdata['check'] = 0; }

        $outdata['bukti'] = $this->Mahasiswa->outbukti($idberkas);

        //$outdata['prodi'] =$this->Mahasiswa->dataprodi($idberkas);
        $this->frontuimhs();
        $this->load->view('mahasiswa/prosespengajuan',$outdata);
        $this->load->view('login/footer');

    }
    function prosespdf(){
        $this->load->model('Mahasiswa');
        $day = date('m');
        if($day >= 7){
            $outdata['sems'] = 'Gasal';
        }else{$outdata['sems'] = 'Genap';}
        $idberkas = $this->uri->segment(3,0);
        $namaberkas = $this->uri->segment(4,0);
        $peng = $this->uri->segment(6,0);
        $jenis = $this->uri->segment(7,0);

        $pesan = 'Pengajuan Berhasil, Mohon Ditunggu Via WA';
        $this->Mahasiswa->updatemailing($pesan,$idberkas);

        if($peng == 1){$outdata['proses'] = 'Magang';}else{$outdata['proses'] = 'Praktek Kerja Lapangan (PKL)';}
        $this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled',TRUE);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename =$namaberkas."_proses_magang.pdf";
        $up = 1;
        $this->Mahasiswa->updatedatapkl($up,$idberkas);
        if($jenis == 1){
            $outdata['berkas'] = $this->Mahasiswa->prosesberkas($idberkas);
            $outdata['isi'] = $this->Mahasiswa->prosesberkasberkelompok($idberkas);
            $outdata['mhs'] = $this->Mahasiswa->prosesdatapkl($idberkas);
        }else{
            $outdata['berkas'] = $this->Mahasiswa->pengajuanberkelompok($idberkas);
            $outdata['isi'] = $this->Mahasiswa->prosesberkasberkelompok($idberkas);
            $outdata['mhs'] = $this->Mahasiswa->prosesdatapkl($idberkas);
        }
        $this->pdf->load_view('mahasiswa/prosespdf',$outdata);
        $this->Pdf->createPdf($html);
    }
    function prosespdfambildata(){

        $this->load->model('Mahasiswa');
        $idberkas = $this->uri->segment(3,0);
        //$namaberkas = $this->uri->segment(4,0);
        $peng = $this->uri->segment(5,0);
        $jenis = $this->uri->segment(6,0);
        $this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled',TRUE);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename =$idberkas."_ambilberkas"."."."pdf";
        $up = 1;
        $this->Mahasiswa->updateambildata($up,$idberkas);
        $outdata['proses'] = 'Permohonan Pengambilan Data';
        $outdata['berkas'] = $this->Mahasiswa->pengambilandatapdf($idberkas);
        $outdata['isi'] = $this->Mahasiswa->pengambilandatapdf($idberkas);
        $this->pdf->load_view('mahasiswa/prosespdfambildata',$outdata);
        $this->Pdf->createPdf($html);
    }
    function reportmhs(){

        $this->load->model('Mahasiswa');
        //$id = $this->Mahasiswa->iduser($_SESSION['user']);
        $idsess = $_SESSION['idpegawai'];

        $idmhs = $this->Mahasiswa->idmhs($id->ID_LOGIN);
       /* foreach($idmhs as $row){
            $id = $row->ID_PEGAWAI;
        }*/
        $countid = $this->Mahasiswa->countmagang($idsess)->num_rows();
        
             if($countid >= 2){
                           $outdata['msg'] = 'Pengajuan permohonan magang anda lebih dari 2x yang disetujui, mohon maaf anda bisa mengajukan lagi setelah 2 minggu. dan data yang sudah masuk akan ditolak'; 
                                }else{ $outdata['msg'] = 'mohon untuk mengingat pengajuan permohonan magang dan PKL sebelumnya sudah dinyatakan diterima oleh perusahaan bukan untuk mencari tempat magang';
                            }
            $outdata['skripsi'] = $this->Mahasiswa->outskripsi($idsess);
            $outdata['report'] = $this->Mahasiswa->reportmhs($idsess);
            $outdata['pengambilandata'] = $this->Mahasiswa->pengambilandata($idsess);
            $outdata['yudisium'] = $this->Mahasiswa->reportmahasiswayudisium($idsess);
            $this->frontuimhs();
            $this->load->view('mahasiswa/reportpengajuan',$outdata);
            $this->load->view('login/footer'); 
        
    }
    
    function reportpengajuan(){
        $this->load->model('Mahasiswa');
        $this->load->model('Page');
        $data = $this->uri->segment(3,0);
        $level = $this->uri->segment(4,0);
        $outdata['level'] = $this->uri->segment(4,0);
        $id = $this->Mahasiswa->iduser($_SESSION['user']);
        $idmhs = $this->Mahasiswa->idmhs($id->ID_LOGIN);
        foreach($idmhs as $row){
            $idmahasiswa = $row->ID_PEGAWAI;
        }
        // pagination 
        $url = base_url().'MHS/reportpengajuan/'.$data.'/'.$level.'/';
        $counting = $this->Page->get_count_report_fak($data);
        $config['array']= array($this->pagination($url,$counting));
        $this->pagination->initialize($config['array']);
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5):0;
        $outdata['links'] = $this->pagination->create_links();
        $outdata['report'] = $this->Page->get_limit_report_fak(10,$page,$data);
        //end pagination

        //if($_SESSION['rule'] == 4){$data = 0;}else{$data = 1;}
        //$outdata['tujuan'] = $this->Mahasiswa->tujuan();
        //$outdata['report'] = $this->Mahasiswa->reportadminfak($data);
        $this->frontuimhs();
        $this->load->view('mahasiswa/reportpengajuanmhs',$outdata);
        $this->load->view('login/footer');
    }
    function reportambildata(){
        $this->load->model('Mahasiswa');
        $this->load->model('Page');
        $data = $this->uri->segment(3,0);
        $level = $this->uri->segment(4,0);
        $outdata['level'] = $this->uri->segment(4,0);
        $id = $this->Mahasiswa->iduser($_SESSION['user']);
        $idmhs = $this->Mahasiswa->idmhs($id->ID_LOGIN);
        foreach($idmhs as $row){
            $idmahasiswa = $row->ID_PEGAWAI;
        }
        // pagination 
        $url = base_url().'MHS/reportpengambilandata/'.$data.'/'.$level.'/';
        $counting = $this->Page->get_count_report_ambil_data($data);
        $config['array']= array($this->pagination($url,$counting));
        $this->pagination->initialize($config['array']);
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5):0;
        $outdata['links'] = $this->pagination->create_links();
        $outdata['report'] = $this->Page->get_limit_ambil_data(10,$page,$data);
        //end pagination

        //if($_SESSION['rule'] == 4){$data = 0;}else{$data = 1;}
        //$outdata['tujuan'] = $this->Mahasiswa->tujuan();
        //$outdata['report'] = $this->Mahasiswa->reportambildata($data);
        $this->frontuimhs();
        $this->load->view('mahasiswa/reportpengambilandata',$outdata);
        $this->load->view('login/footer');
    }
    function prosespengajuanambildata(){
        $this->load->model('Mahasiswa');
        $idberkas = $this->uri->segment(3,0);
        $idmhs = $this->uri->segment(4,0);
        $outdata['proses'] = 'Permohonan Pengambilan Data';
        $outdata['berkas'] = $this->Mahasiswa->prosespengambilandata($idberkas);
        $outdata['isi'] = $this->Mahasiswa->pengambilandata($idberkas);
        $this->frontuimhs();
        $this->load->view('mahasiswa/pengambilandata',$outdata);
        $this->load->view('login/footer');
    }
    function reportpengambilandata(){
        $this->load->model('Mahasiswa');
        $this->load->model('Page');
        $data = $this->uri->segment(3,0);        
        $level = $this->uri->segment(4,0);
        $outdata['level'] = $this->uri->segment(4,0);
        $id = $this->Mahasiswa->iduser($_SESSION['user']);
        $idmhs = $this->Mahasiswa->idmhs($id->ID_LOGIN);
        foreach($idmhs as $row){
            $idmahasiswa = $row->ID_PEGAWAI;
        }
        // pagination 
        $url = base_url().'MHS/reportpengambilandata/'.$data.'/'.$level.'/';
        $counting = $this->Page->get_count_report_ambil_data($data);
        $config['array']= array($this->pagination($url,$counting));
        $this->pagination->initialize($config['array']);
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5):0;
        $outdata['links'] = $this->pagination->create_links();
        $outdata['report'] = $this->Page->get_limit_ambil_data(10,$page,$data);
        //end pagination

        //if($_SESSION['rule'] == 4){$data = 0;}else{$data = 1;}
        //$outdata['tujuan'] = $this->Mahasiswa->tujuan();
        //$outdata['report'] = $this->Mahasiswa->reportambildata($data);
        $this->frontuimhs();
        $this->load->view('mahasiswa/reportpengambilandata',$outdata);
        $this->load->view('login/footer');
    }
    function tolakpengajuan(){
        $this->load->model('Mahasiswa');
        $int = $this->uri->segment(3,0);
        $idpkl = $this->uri->segment(4,0);
        $this->Mahasiswa->updatedatapkl($int,$idpkl);
        echo "<script>alert('pengajuan berhasil ditolak')</script>";
        redirect(site_url('Backbone/detailpengajuan'));
        
    }
    function bataspengajuan(){
        $this->load->model('Mahasiswa');
        $int = $this->uri->segment(3,0);
        $idpkl = $this->uri->segment(4,0);
        $this->Mahasiswa->updatedatapkl($int,$idpkl);
        echo "<script>alert('pengajuan berhasil ditolak')</script>";
        redirect(site_url('Backbone/detailpengajuan'));
    }
    function uploadberkas(){
        $this->load->model('Mahasiswa');
        $id = $this->uri->segment(3,0);
        $dataout['datapkl'] = $this->Mahasiswa->uploadmagang($id);
        $this->frontuimhs();
        $this->load->view('mahasiswa/upload',$dataout);
        $this->load->view('login/footer');
    }
    function insertskripsi(){
       $idprodi = $this->input->post('idprodi');
       $nim = $this->input->post('nim');
       $idmhs = $this->input->post('idmhs');
       $judul = $this->input->post('judul');
       $pembimbing1 = $this->input->post('pembimbing1');
       $pembimbing2 = $this->input->post('pembimbing2');
       $bidangmk = $this->input->post('MK');
       $date = date('Y-m-d');
       $respons = ' ';
       $data = array('ID_SKRIPSI'=>' ' , 'ID_PEGAWAI'=>$idmhs, 'ID_PRODI' => $idprodi,'NIM_MHS'=> $nim, 'JUDUL'=> $judul, 'PEMBIMBING1'=> $pembimbing1, 'PEMBIMBING2'=>$pembimbing2, 'MK_ACUAN'=>$bidangmk, 'DATE_SKRIPSI'=>$date, 'RESPONS'=>$respons);
       $this->load->model('Mahasiswa');
       $output = $this->Mahasiswa->insertskripsi($data);

       if(isset($output) == true){
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
    function get_autocomplete(){
        if(isset($_GET['term'])){
            $result = $this->Mahasiswa->namadosen($_GET['term']);
            if(count($result) > 0) {
                foreach($result as $row){
                    $arr_result[] = $row['NAMA_DOSEN'];
                    echo json_encode($arr_result);
                }
            }
        }
    }
    function frontuimhs(){
        //countdown time active
           /* $end_time = strtotime("2024-02-29 23:59:59"); // Countdown end time
            $current_time = time(); // Current timestamp
            $time_left = $end_time - $current_time; // Time remaining in seconds

            $days = floor($time_left / 86400); // 86400 seconds in a day
            $time_left = $time_left % 86400;
            $outdata['timeleft'] = $days;*/
        //
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $this->autoclose();
        
        $aktif = 1;
        $outdata['periode'] = $this->Page->periodeaktif($aktif)->num_rows();
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
            $outdata['title'] = 'MSMHS_ADEMI';
            $outdata['header'] = array('ProfilMhs'); 
            $this->load->view('login/headerlog',$outdata);
            $this->load->view('login/sidebarmhs',$outdata);
            $this->load->view('login/topbar',$outdata); 

            }elseif($_SESSION['rule'] == 4){
                $this->load->model('Page');
                    $dat = 0;
                    $outdata['alertmagangprodi'] = $this->Page->alertMagang($dat)->num_rows();
                    $outdata['alertambildata'] = $this->Page->alertambildata($dat)->num_rows();
                    $outdata['alertyudisium'] = $this->Page->alertyudisiumdep($dat)->num_rows();
                $outdata['title'] = 'MSMHS_ADEMI';
                $outdata['header'] = array('BERKAS_MBKM','PENGAMBILAN_DATA','UNDUR_DIRI','CUTI');
                $outdata['head'] = array('SK_MENGAJAR','SK_DOSEN_WALI','SK_DOSEN_PJMK','SK_PEMBIMBING_TA','PLOTING_JADWAL','BEBAN_MENGAJAR');
                //$this->timelaps();
                $this->load->view('login/headerlog',$outdata);
                $this->load->view('login/sidebarfakultas',$outdata);
                $this->load->view('login/topbar',$outdata); 
            }else{
                
                $this->load->model('Page');
                $this->load->model('DataEx');
                $dataidprod = $this->DataEx->allDataProfile($idLogin->ID_LOGIN);
                foreach($dataidprod as $keys){
                $idprodi = $keys['ID_PRODI'];
                }
                $dat = 0;
                $outdata['header'] = array('Profile','SK_PRODI', 'Kepegawaian'); 
                $outdata['alertambildata'] = $this->Page->alertambildataprodi($dat,$idprodi)->num_rows();
                $outdata['alertmagangprodi'] = $this->Page->alertmagangprodi($dat,$idprodi)->num_rows();
                $outdata['alertyudisium'] = $this->Page->alertyudisium($dat,$idprodi)->num_rows();
                $outdata['title'] = 'MSMHS_ADEMI';
                //$this->timelaps();
                $this->load->view('login/headerlog',$outdata);
                $this->load->view('login/sidebar',$outdata);
                $this->load->view('login/topbar',$outdata);
            }
        
    }
    function downloadberkas(){
        $this->load->model('Mahasiswa');
        $id = $this->uri->segment(4,0);
        $databerkas = $this->Mahasiswa->downberkas($id);
        foreach($databerkas as $value){
            $nam = $value->LINK_BERKAS;
        }
        
        $outdata['url'] = base_url()."upload/berkasmhs"."/".$nam;
        
        $outdata['file'] ='pdf';
        $this->load->view('content/outpdf',$outdata);
    }
    function deletdatapkl(){
        $this->load->model('Mahasiswa');
        $idpkl = $this->uri->segment(3,0);
        $this->Mahasiswa->delmhspkl($idpkl);
        $this->Mahasiswa->delmhssecond($idpkl);

        $this->index();
        
    }
    function delmagpkl(){
        $id = $this->uri->segment(4,0);
        $this->Mahasiswa->delmhspkl($id);
        $this->redierect();
    }
    function redierect(){
        redirect(site_url('Backbone/detailpengajuan'));
    }
    function openlinkyudisium(){
        $this->frontuimhs();
        $this->load->view('yudisium/firstyudi');
        $this->load->view('login/footer');
    }
    function yudisium(){
        
        $this->frontuimhs();
        $this->load->model('DataEx');
        $this->load->model('Mahasiswa');
        $outdata['periode1'] = '2';
        $id = $_SESSION['idpegawai'];
        $idprodi = $this->DataEx->datauser($id);
        foreach($idprodi as $key){
            $idprod = $key['ID_PRODI'];
        }

        $check = $this->Yudisium->checkyudi($id)->num_rows();

        if($check == 1){
            echo "<script> 
            alert('Mohon maaf anda sudah mengajukan pendaftaran skripsi, mohon cek di report pengajuan');
            </script>";
            
            $this->load->view('yudisium/firstyudi');
            
        }else{
        $x = 1;
        $outdata['periode'] = $this->Mahasiswa->periodeaktiv($x);
        $outdata['namadosen'] = $this->DataEx->namadosen($idprod);
        $jenis = $this->uri->segment(3,0);
        //$outdata['periode'] = $this->Mahasiswa->setperiode();
        $outdata['user'] = $this->DataEx->datauser($id);

        if($idprod == 3){
            $this->load->view('yudisium/daf_yud_pajak',$outdata);
        }elseif($idprod == 10){
            $this->load->view('yudisium/daf_yud_pasar',$outdata);
        }else{$this->load->view('mahasiswa/daftarYudisium',$outdata);}
        
        $this->load->view('login/footer');
        }
    }
    
    function yudisiumInsert(){
        $nim = $this->input->post('nim');
        $idmhs = $this->input->post('idmhs');
        $berkas = $this->input->post('berkas');
        $idprodi = $this->input->post('idprodi');     
        $pesan = "Proses Pengajuan Di Akademik Prodi";  
        
        $countnim = $this->Mahasiswa->checknim($nim)->num_rows();

        if($countnim > 0){
            echo "<script>
                alert('Anda Sudah mendaftar dengan nim ini mohon ditunggu proses di akademik, jika bukan anda mohon login dengan account baru');
            </script>";
            return $this->index();
        }else{ 
            if($this->input->method() === 'post'){
            $namafile = $nim.'_'.'yudisium';
            $config['upload_path']      = 'upload\yudisium';
            $config['allowed_types']    = 'pdf|jpeg|PDF|JPG';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 100240; //10MB
            $config['max_width']        = 1440;
            $config['max_height']       = 1440;
           
            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('berkas')) {
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
                
            }else{
                $bukti= array(
                    'ID_BUKTI_YUDISIUM' => ' ',
                    'ID_PEGAWAI'  => $idmhs,
                    'NAMA_BUKTI_YUDISIUM' => $config['file_name'].".pdf",
                    'PESAN' => $pesan                    
                );
                $this->upload->do_upload('berkas');
                $this->Mahasiswa->buktiyudisium($bukti);
           }
        }

        /* end upload bukti */
        $dataupload = array(
             'ID_DAFTAR_YUDISIUM' => ' ',
             'ID_PEGAWAI' => $idmhs,
             'ID_PRODI' => $idprodi,
             'NIK' => $this->input->post('nik'),
             'TEMPAT_LAHIR' => $this->input->post('tempat'),
             'TANGGAL_LAHIR' => $this->input->post('tanggal'),
             'NO_HP' => $this->input->post('nohp'),
             'SKS' => $this->input->post('sks'),
             'IPK' => $this->input->post('ipk'),
             'NILAI_D' => $this->input->post('nilai'),
             'TOEFL' => $this->input->post('toefl'),
             'SKP' => $this->input->post('SKP'),
             'ID_PERIODE' => $this->input->post('periode'),
             'PROSES' => ' '
        );

        $countmember = $this->Mahasiswa->countdaftaryudis($this->input->post('periode'));
        $updatemember = $countmember + 1;
        $datamember = array(
            'SUM_MEMBER' => $updatemember
            );
        
        $this->Mahasiswa->updatemember($datamember,$this->input->post('periode'));

        $this->Mahasiswa->daftar_yudisium($dataupload); 

        if($idprodi == 3){

            $datasyarat = array(
                'ID_SYARAT_YUDI' => ' ',
                'ID_PEGAWAI' => $idmhs,
                'SYARAT_KUP' => $this->input->post('KUP'),
                'SYARAT_POTPUTPPH' => $this->input->post('poptut'),
                'SYARAT_PPH' => $this->input->post('PPh'),
                'SYARAT_PPNBM' => $this->input->post('PPNBM')
            );
            $this->Mahasiswa->insertsyaratyudipajak($datasyarat);
        }elseif($idprod == 7){

            $datasyarat = array(
                'ID_SYARAT_YUDI_MP' =>' ',
                'ID_PEGAWAI' => $idmhs,
                'SYARAT_PGN_PEMASARAN' => $this->input->post('pasar'),
                'SYARAT_PGN_MANAJEMEN' => $this->input->post('manajemen')
            );
            $this->Mahasiswa->insertsyaratyudimp($datasyarat);
        }
        echo '<script type="text/javascript">
                alert("Pengajuan anda sukses, mohon untuk aktif memperhatikan update dari akademik");
                </script>';       
        $this->index();
        }

             /*  upload berkas bukti yudisium; */
        
    }
    function uiupdateyudisium(){
        $idmhs = $this->uri->segment(4,0);
        $iddaftaryudi = $this->uri->segment(3,0);
        $idprodi = $this->uri->segment(7,0);
        $namaprodi = $this->uri->segment(6,0);
        $this->frontuimhs();
        if($idprodi == 3){
            $outdata['upyudipjk'] = $this->Mahasiswa->getupdatayudimhspjk($iddaftaryudi);
            $this->load->view('yudisium/up_yudpajak',$outdata);
        }elseif($idprodi == 7){
            $outdata['upyudimp'] = $this->Mahasiswa->getupdateyudimhsmp($iddaftaryudi);
            $this->load->view('yudisium/up_yudpasar',$outdata);
        }else{
            $outdata['yudiumum'] = $this->Mahasiswa->getupdateyudimhs($iddaftaryudi);
            $this->load->view('yudisium/up_yudiumum',$outdata);
        }
        $this->load->view('login/footer');

    }

    function yudisiumupdate(){
        $idprodi = $this->input->post('idprodi');
        $iddaftaryudi = $this->input->post('idyudi');
        $idmhs = $this->input->post('idmhs');

        $dataup = array(
                'NIK' => $this->input->post('nik'),
                'TEMPAT_LAHIR' => $this->input->post('tempat'),
                'TANGGAL_LAHIR' => $this->input->post('tanggal'),
                'SKS' => $this->input->post('sks'),
                'IPK' => $this->input->post('ipk'),
                'NILAI_D' => $this->input->post('nilai'),
                'TOEFL' => $this->input->post('toefl'),
                'SKP' => $this->input->post('skp')
            );

        if($idprodi == 3){
            
            $datasyarat = array(
                'SYARAT_KUP' => $this->input->post('KUP'),
                'SYARAT_POTPUTPPH' => $this->input->post('poptut'),
                'SYARAT_PPH' => $this->input->post('PPH'),
                'SYARAT_PPNBM' => $this->input->post('PPNBM')
            );

            $this->Yudisium->updatedatayudisium($dataup,$iddaftaryudi);
            $this->Yudisium->updatesyaratpjk($datasyarat,$iddaftaryudi);

        }elseif($idprodi == 7){

            $datasyarat = array(
                'SYARAT_PGN_PEMASARAN' => $this->input->post('pasar'),
                'SYARAT_PGN_MANAJEMEN' => $this->input->post('Manajemen')
            );
            $this->yudisium->updatedatayudisium($dataup,$iddaftaryudi);
            $this->Yudisium->updatesyaratpjk($datasyarat,$iddaftaryudi);

        }else{
            $this->Yudisium->updatedatayudisium($dataup,$iddaftaryudi);
        }
         $pesan = "Upload data revisi";
        if($this->input->method() === 'post'){
            $namafile = $nim.'_'.'yudisium_update';
            $config['upload_path']      = 'upload\yudisium';
            $config['allowed_types']    = 'pdf|jpeg|PDF|JPG';
            $config['file_name']        = $namafile;
            $config['overwrite']        = true;
            $config['max_size']         = 100240; //10MB
            $config['max_width']        = 1440;
            $config['max_height']       = 1440;
           
            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('berkas')) {
                $error = array("error"=> $this->upload->display_errors());
                $this->load->view('upload_form',$error);
                
            }else{
                $bukti= array(
                    
                    'NAMA_BUKTI_YUDISIUM' => $config['file_name'].".pdf",
                    'PESAN' => $pesan                    
                );
                $this->upload->do_upload('berkas');
                $this->Yudisium->update_bukti($bukti,$idmhs);
           }

        }else{
            echo '<script type="text/javascript">
                alert("Update data gagal - mohon upload ulang");
                </script>'; 
                $this->index();
        }
        redirect('MHS/index','refresh');

    }
    
    function pagination($url, $counting){
        $config = array();
        $config["base_url"] = $url;
        $config["total_rows"] = $counting;
        $config["per_page"] = 10;
        $config["uri_segment"] = 5;
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
                $page = ($this->uri->segment(5)) ? $this->uri->segment(5):0;
        }
    function logOut(){
        
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($value != $_SESSION['user'] && $value != $_SESSION['prodi'] && $value != 'user_agent' && $value != $_SESSION['rule']) {
                $this->CI=& get_instance();
                $this->CI->session->sess_destroy();
                $this->session->unset_userdata($value);
            }
        }
            $this->session->sess_destroy($key);
            redirect(site_url('Backbone/index'));
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
?> 
