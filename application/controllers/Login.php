<?php

class Login extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
    }

    function index(){
        
        $sql = "SELECT * FROM data_company limit 1";
         $dataCom = $this->db->query($sql);
         $data['company'] = $dataCom->result_array();

        $data['title'] = 'FM | Login';
        $this->load->view('header',$data);
        $this->load->view('login');
        
     
    }

    function validasi(){
        
      
       $username = urldecode($this->input->post('username'));
        $password = sha1($this->input->post('password'));

        $hasil = $this->db->query("SELECT * FROM data_admin WHERE username='$username' AND password='$password'");

        if ($hasil->num_rows()>0) {
            # code...
             $i = $hasil->row_array();

             $_SESSION['nama_lengkap'] = $i['nama_lengkap'];
             $_SESSION['username'] = $i['username'];
             $_SESSION['level'] = 'Admin';
             $_SESSION['admin'] = $i;
                      
            echo 200;
        }
        else{

            echo 600;
        }
       





    }

    function validasiqr(){
        
      
       $nomor_id = $this->input->post('nomor_id');
        

        $hasil = $this->db->query("SELECT * FROM data_admin WHERE nomor_id='$nomor_id'");

        if ($hasil->num_rows()>0) {
            # code...
             $i = $hasil->row_array();

             $_SESSION['nama_lengkap'] = $i['nama_lengkap'];
             $_SESSION['username'] = $i['username'];
             $_SESSION['level'] = 'Admin';
             $_SESSION['admin'] = $i;
                      
            echo 200;
        }
        else{

            echo 600;
        }
       





    }

    function logout(){

        unset($_SESSION['username']);
        unset($_SESSION['level']);
        session_destroy(); 

         redirect('login');


    }
}