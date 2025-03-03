<?php

class Company extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('Company_model');

	}

	function index(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Master Company';
			$data['company'] = $this->Company_model->getData();
			$this->load->view('header',$data);
			$this->load->view('company/data');
			$this->load->view('footer');
		}
	}

	function detail(){
		$id	= $this->uri->segment(3);
		$data['title']='FM | Master Company - Detail';
	

		$data['company'] = $this->db->query("SELECT * FROM data_company limit 1")->row_array();

		$this->load->view('header',$data);
		$this->load->view('company/view',$data);
		$this->load->view('footer');
	}




	function add(){
		$data['title']='FM | Master Company - Add';

		$this->load->view('header',$data);
		$this->load->view('company/add');
		$this->load->view('footer');
	}

	function insert(){

		$target_dir = "upload/";
		$target_file = $target_dir .date('ymdhis').basename($_FILES["foto"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		  $check = getimagesize($_FILES["foto"]["tmp_name"]);
		  if($check !== false) {
		    echo "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		  } else {
		    echo "File is not an image.";
		    $uploadOk = 0;
		  }
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		  echo "Sorry, file already exists.";
		  $uploadOk = 0;
		}

		// Check file size
		if ($_FILES["foto"]["size"] > 2000000) {
		  echo "Sorry, your file is too large.";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
		    echo "The file ". basename( $_FILES["foto"]["name"]). " has been uploaded.";
		  } else {
		    echo "Sorry, there was an error uploading your file.";
		  }
		}

		$nama = $this->input->post('nama');
		$ket = $this->input->post('ket');
		$foto =  $target_file;


		$tipe = $this->input->post('tipe');

		$this->Company_model->insert($nama,$ket,$foto,$tipe);
		redirect('company');
	}

	function delete(){
		$id = $this->uri->segment(3);
		$foto = $this->uri->segment(5);
		unlink('upload/'.$foto);
		$this->Company_model->delete($id);
		redirect('company');
	}

	function edit(){

		$id	= $this->uri->segment(3);

		$data['title']='FM | Master Company - Edit';
		$hasil = $this->Company_model->getId($id);

		$data['company'] = $hasil->row_array();

		$this->load->view('header',$data);
		$this->load->view('company/edit',$data);
		$this->load->view('footer');
	}

	



	function update(){


		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$tlp = $this->input->post('tlp');
		$foto_old = $this->input->post('foto_old');
		$deskripsi = $this->input->post('deskripsi');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		
		
		
		$website = $_POST['website'];


		$tipe = $this->input->post('tipe');

		if(empty($_FILES['foto']['name'])){
				
				// echo "tidak ada foto";
				$foto="";
				  	
					
		}else{

			// echo "ada foto";
				 $target_dir = "upload/";
				$target_file = $target_dir .date('ymdhis').basename($_FILES["foto"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				  $check = getimagesize($_FILES["foto"]["tmp_name"]);
				  if($check !== false) {
				    echo "File is an image - " . $check["mime"] . ".";
				    $uploadOk = 1;
				  } else {
				    echo "File is not an image.";
				    $uploadOk = 0;
				  }
				}

				// Check if file already exists
				if (file_exists($target_file)) {
				  echo "Sorry, file already exists.";
				  $uploadOk = 0;
				}

				// Check file size
				if ($_FILES["foto"]["size"] > 2000000) {
				  echo "Sorry, your file is too large.";
				  $uploadOk = 0;
				  die();
				}

				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				  $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				  echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				  if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
				 
				    echo "The file ". basename( $_FILES["foto"]["name"]). " has been uploaded.";
				    unlink($foto_old);	
				  } else {
				    echo "Sorry, there was an error uploading your file.";
				  }
				}
				 $foto = $target_file;
		}
	    
	    $warna_utama = $_POST['warna_utama'];
	     $warna_kedua = $_POST['warna_kedua'];
	      $warna_ketiga = $_POST['warna_ketiga'];

		if(!empty($foto)){
			 $sql= "UPDATE data_company SET website='$website',nama='$nama',foto='$foto',deskripsi='$deskripsi',tlp='$tlp',alamat='$alamat',email='$email',warna_utama='$warna_utama',warna_kedua='$warna_kedua',warna_ketiga='$warna_ketiga' WHERE id='$id'";
		}else{

			 $sql= "UPDATE data_company SET website='$website',nama='$nama',deskripsi='$deskripsi',tlp='$tlp',alamat='$alamat',email='$email',warna_utama='$warna_utama',warna_kedua='$warna_kedua',warna_ketiga='$warna_ketiga' WHERE id='$id'";
		}




		
		

		$this->db->query($sql);	
		redirect('company');
	}
	
}