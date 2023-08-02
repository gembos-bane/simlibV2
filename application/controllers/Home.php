<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Home
 *
 * @author D4 MB
 */
class Home extends CI_Controller{
    //put your code here
    function index(){
        $outdata['title'] = 'SIMLIB_V2';
        $this->load->view('login/headerlog',$outdata);
        $this->load->view('login/login');
       
    }
    function backpass(){
        if(isset($_SESSION['rule']) == FALSE){
            $this->load->vie('errors/cli');
            $this->index();
        }else{
            redirect(site_url('API/outreport'));
        }
    }
}
