<?php

class Home extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Home';
			$this->load->view('header',$data);
			if($_SESSION['level']=='Admin'){
				$this->load->view('home');
			}else{
				$this->load->view('homepengguna');
			}
			$this->load->view('footer');
		}
	}
	function download(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Download';
			$this->load->view('download');
		}
	}
	
	function map(){

	
			$this->load->view('map');
		
	}
}