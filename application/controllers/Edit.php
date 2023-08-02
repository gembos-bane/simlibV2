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
        
        $this->load->model('DataEx');
        $this->load->model('First');
        $this->load->model('Page');
        $this->load->library('form_validation','session','database');
        $this->load->helper(array('form','url')); 
        if(!isset($_SERVER['HTTP_REFERER'])){
                    $this->load->helper('url');
                    redirect(site_url('Backbone/index'));
                }
       
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
}

