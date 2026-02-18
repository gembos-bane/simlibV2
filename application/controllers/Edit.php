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
class Edit extends CI_Controller{
    //put your code here
    function __construct(){
        parent::__construct();
        
        $this->load->model(array('DataEx','First','Page','mahasiswa');
        $this->load->library('form_validation','session','database');
        $this->load->helper(array('form','url')); 
        if(!isset($_SERVER['HTTP_REFERER'])){
                    $this->load->helper('url');
                    redirect(site_url('Backbone/index'));
                }
                error_reporting(0);
       
    }
    function changeuserpas(){
        $check = $this->input->post('confirm');
        $passold = $this->input->post('password');
        $newone = $this->input->post('password1');
        $newtwo = $this->input->post('password2');

        $idpegawai = $_SESSION['idpegawai'];
        $datauser = $this->DataEx->datauser($idpegawai);

        foreach($datauser as $row){
            $oldpass1 = $row['LOGIN_PASS'];
            $idlog = $row['ID_LOGIN'];
        }

        if($check == 1){
            if($passold == $oldpass1){
                $dataupdate = array('LOGIN_PASS' => $newone);
                $this->DataEx->updateuser($idlog, $dataupdate);
                echo '<script>alert("Anda Sukses Melakukan Pergantian Password anda. Mohon diingat ");
                </script>';
                    redirect(site_url('Backbone/editprofile'), 'refresh');

            }
        }else{
            echo '<script>alert("MAAF PASSWORD YANG ANDA MASUKKAN TIDAK SAMA ");
                </script>';
                    redirect(site_url('Backbone/editprofile'), 'refresh');
        }
    }
    function ssoedit(){
        $idmahasiswa = $this->uri->segment(4,0);
        $outdata['data'] = $this->Mahasiswa->datauser($idmahasiswa);
        $outdata['sso'] = array(
            'Proses Jadwal Ujian',
            'Undangan Ujian Skripsi/TA',
            'Input Nilai Ujian'
        );
        $outdata['ket'] = array(
            'Mohon untuk dicek kelengkapan pengajuan sidang skripsi sebelum memulai Proses Penjadwalan',
            'Mohon dicek dan pastikan penjadwalan ujian TA/Skripsi',
            'Pastikan Nilai Ujian yang diperoleh sudah valid dan benar karene berhubungan dengan cybercampus'
            );
        //$this->timelaps();
        $this->frontendui();
        $this->load->view('login/sso',$outdata);
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
                $outdata['alert'] = $this->Page->alertMagang($dat)->num_rows();
                $outdata['alertambil'] = $this->Page->alertambildata($dat)->num_rows();
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
                            $outdata['header'] = array('Profile'); 
                           // $this->timelaps();
                            $this->load->view('login/headerlog',$outdata);
                            $this->load->view('login/sidebar',$outdata);
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
                                }
                            else{
                                
                                $outdata['title'] = 'Ademi';
                                $outdata['header'] = array('Profile','SK_PRODI', 'Kepegawaian'); 
                                //$this->timelaps();
                                $this->load->view('login/headerlog',$outdata);
                                $this->load->view('login/topbar',$outdata);
                                }
                            
    }
}


