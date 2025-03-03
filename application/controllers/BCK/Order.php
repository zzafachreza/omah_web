<?php

class Order extends CI_Controller{

  

	function __construct(){
		parent::__construct();
		
	    $this->load->library('excel');
	}
	
    
    function modul(){
        return 'order';
    }

	function index(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']=$this->modul();
			$data['modul'] = $this->modul();
			$this->load->view('header',$data);
			$this->load->view($this->modul().'/data');
			$this->load->view('footer');
		}
	}





	function add(){
		$data['title']=$this->modul().' - Tambah';
		$data['modul'] = $this->modul();

		$this->load->view('header',$data);
		$this->load->view($this->modul().'/add');
		$this->load->view('footer');
	}
	
		function detail(){
		$data['title']=$this->modul().' - Detail';
		$data['modul'] = $this->modul();

		$this->load->view('header',$data);
		$this->load->view($this->modul().'/view');
		$this->load->view('footer');
	}
	
	
		function add_import(){
		$data['title']=$this->modul().' - Import Product';
		$data['modul'] = $this->modul();

		$this->load->view('header',$data);
		$this->load->view($this->modul().'/add_import');
		$this->load->view('footer');
	}
	
	function print(){
	    $data['modul'] = $this->modul();
	   $this->load->view($this->modul().'/print',$data); 
	}
	
	public function uploadFoto($name_data,$ref_user){
		     $target_dir = "datafoto/";
    	
    		$ext = $target_dir .date('ymdhis').basename($_FILES[$name_data]["name"]);
    		$uploadOk = 1;
    		$imageFileType = strtolower(pathinfo($ext,PATHINFO_EXTENSION));
    		
    			$target_file = $target_dir .sha1(md5(date('ymdhis').$ref_user.$name_data)).'.'.$imageFileType;
    
    		// Check if image file is a actual image or fake image
    		if(isset($_POST["submit"])) {
    		  $check = getimagesize($_FILES[$name_data]["tmp_name"]);
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
    		if ($_FILES[$name_data]["size"] > 12000000) {
    		  echo "Sorry, your file is too large.";
    		  $uploadOk = 0;
    		}
    
    	
    
    		// Check if $uploadOk is set to 0 by an error
    		if ($uploadOk == 0) {
    		  echo "Sorry, your file was not uploaded.";
    		// if everything is ok, try to upload file
    		} else {
    		  if (move_uploaded_file($_FILES[$name_data]["tmp_name"], $target_file)) {
    		  //  echo "The file ". basename( $_FILES["foto"]["name"]). " has been uploaded.";
    		    return $target_file;
    		  } else {
    		    echo "Sorry, there was an error uploading your file.";
    		  }
    		}
		}
		

	function insert(){
	    
	    

           $myFoto = $this->uploadFoto('file_'.$this->modul(),date('ymdhis'));
   
        
        
        $sql="INSERT INTO data_".$this->modul()."
        
                (";
                
                
            $no=1;
                 
            $jml =$this->db->query("SHOW COLUMNS from `data_".$this->modul()."` WHERE FIELD !='id_".$this->modul()."'")->num_rows();
        foreach($this->db->query("SHOW COLUMNS from `data_".$this->modul()."` WHERE FIELD !='id_".$this->modul()."'")->result() as $col){
        	    
        	   
        	   
        	   if($jml==$no){
        	       $sql .= $col->Field;
        	   }else{
        	       $sql .= $col->Field.",";
        	   }
        	   
        	   
        	   $no++;
        	    
        	}
                
                
                
                    
          $sql .=") VALUES(";
          
          $no2=1;
          
           foreach($this->db->query("SHOW COLUMNS from `data_".$this->modul()."` WHERE FIELD !='id_".$this->modul()."'")->result() as $col){
        	    
        	    
        	    $data_field = $col->Field;
        	    
        	    
        	   
        	    
        	    
        	    
        	    if($data_field=="file_".$this->modul()){
        	        $data_field = $myFoto;
        	    }else{
        	         if($data_field=="harga_".$this->modul()){
        	             $data_field = str_replace(",","",$this->input->post($col->Field));
        	           
            	    }else{
            	        $data_field = $this->input->post($col->Field);
            	    }
        	    }
        	    
        	      
        	    
        	    
        	    
        	    
        	     if($jml==$no2){
        	       $sql .= "'".$data_field."'";
        	   }else{
        	       $sql .= "'".$data_field."',";
        	   }
        	   
        	   
        	   $no2++;
        	   
        	   
        	   
        	    
        	}
        	
                
            
                
          $sql .=");";
            
      
            
   
            if($this->db->query($sql)){
                 $this->session->set_flashdata('update', ' Data berhasil di simpan');
              redirect($this->modul()); 
           
            }
		
	}
	
	function download(){
	    
error_reporting(E_ALL);
date_default_timezone_set('Asia/Jakarta');
// Create new PHPExcel object
  ob_clean();
$objPHPExcel = new PHPExcel();



// Set properties
$objPHPExcel->getProperties()->setCreator("PT. Zavalabs Teknologi Indonesia")
							 ->setLastModifiedBy("Zavalabs")
							 ->setTitle("Laporan Excel Espt")
							 ->setSubject("Laporan Excel Espt")
							 ->setDescription("Laporan Excel Espt")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
   $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Nama Wajib Pajak')
                    ->setCellValue('B1', 'NPWP')
                    ->setCellValue('C1', 'Nomor Ketetapan')
                    ->setCellValue('D1', 'Tahun Pajak')
                    ->setCellValue('E1', 'Tanggal Penerbitan')
                    ->setCellValue('F1', 'Tanggal Jatuh Tempo')
                    ->setCellValue('G1', 'Tanggal Kirim')
                    ->setCellValue('H1', 'Penerbit')
                    ->setCellValue('I1', 'Status');
                    
                    
                    
                    		$no=2;
	  				foreach($this->db->query("SELECT * FROM data_espt")->result() as $row){
	  			
	  				
	  				    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$no,$row->nama )
                        ->setCellValue('B'.$no,$row->npwp )
                        ->setCellValue('C'.$no,$row->nomor )
                        ->setCellValue('D'.$no,$row->tahun_pajak )
                        ->setCellValue('E'.$no,$row->tanggal_penerbitan )
                        ->setCellValue('F'.$no,$row->tanggal_jatuh_tempo )
                        ->setCellValue('G'.$no,$row->tanggal_kirim )
                        ->setCellValue('H'.$no,$row->penerbit )
                        ->setCellValue('I'.$no,$row->status );
		              		$no++;
		              
	  				}

                // Auto-size columns for all worksheets
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    foreach ($worksheet->getColumnIterator() as $column) {
        $worksheet
            ->getColumnDimension($column->getColumnIndex())
            ->setAutoSize(true);
    } 
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Laporan');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data_espt'.date('ymdhis').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

        

		 
  
	    
	}

	function delete(){
		$id = $this->uri->segment(3);
		
		
		$sqlFoto = "SELECT file_".$this->modul()." FROM data_".$this->modul()." WHERE id_".$this->modul()."='$id'";
		$fotoDelete = $this->db->query($sqlFoto)->row_object();

		     
		      $sql="DELETE FROM data_".$this->modul()." WHERE id_".$this->modul()."='$id'";
                if($this->db->query($sql)){
                    unlink($fotoDelete->{'file_'.$this->modul()});
                     $this->session->set_flashdata('update', ' Data berhasil di hapus');
                   redirect($this->modul()); 
                }
                
                
		
        
      
	}
	
	function import_pdf(){
	    
	    $target_dir = "mypdf/";
	    
	    print_r($_FILES["pdf"]["name"]);
	    
	    for($i=0;$i<count($_FILES["pdf"]["name"]);$i++){
	        
    	    $target_file = $target_dir . basename($_FILES["pdf"]["name"][$i]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            move_uploaded_file($_FILES["pdf"]["tmp_name"][$i], $target_file);   
	        
	    }
	    
        
        
        
        $this->session->set_flashdata('pdf', 'Pdf berhasil diupload !');
	     redirect($this->modul()); 
	    
	    
	}

	function edit(){

		$id	= $this->uri->segment(3);
		$data['title']=$this->modul().' - Edit';
		$data['id'] = $id;
		$data['modul'] = $this->modul();
		$this->load->view('header',$data);
		$this->load->view($this->modul().'/edit',$data);
		$this->load->view('footer');
	}
	
	
		function add_pdf(){

		$id	= $this->uri->segment(3);
		$data['title']=$this->modul().' - Upload PDF';
		$data['id'] = $id;
		$data['modul'] = $this->modul();
		$this->load->view('header',$data);
		$this->load->view($this->modul().'/add_pdf',$data);
		$this->load->view('footer');
	}

	



	function update(){
	    
	      $foto_old = $_POST['file_'.$this->modul().'_old'];

      
      if(!empty($_FILES['file_'.$this->modul()]['name'])){
        
          $myFoto = $this->uploadFoto('file_'.$this->modul(),date('ymdhis'));
          unlink($foto_old);
           
      }else{
          
           $myFoto =$foto_old;
      }
      

      
      

		$id = $this->input->post('id_'.$this->modul());

        $sql="UPDATE data_".$this->modul()." SET ";
        
        
        	
        	
        	
        	        
            $jml =$this->db->query("SHOW COLUMNS from `data_".$this->modul()."` WHERE FIELD !='id_".$this->modul()."'")->num_rows();
 
        	$no=1;
          
           foreach($this->db->query("SHOW COLUMNS from `data_".$this->modul()."` WHERE FIELD !='id_".$this->modul()."'")->result() as $col){
        	    
        	    
        	     $data_field = $col->Field;
  
        	    
        	   	    
        	    if($data_field=='file_'.$this->modul()){
        	        $data_field = $myFoto;
        	    }else{
        	         if($data_field=="harga_".$this->modul()){
        	             $data_field = str_replace(",","",$this->input->post($col->Field));
        	           
            	    }else{
            	        $data_field = $this->input->post($col->Field);
            	    }
        	    }
        	    
        	    
        	    
        	    
        	    
        	    
        	     if($jml==$no){
        	        $sql .= "".$col->Field."='".$data_field."'";
        	   }else{
        	      $sql .= "".$col->Field."='".$data_field."',";
        	   }
        	   
        	   
        	   $no++;
        	   
        	   
        	   
        	    
        	}
        	
                
                
        $sql .=" WHERE id_".$this->modul()."='$id'";
        
        
              
        
            
            if($this->db->query($sql)){
                $this->session->set_flashdata('update', ' Data berhasil diupdate');
              redirect($this->modul()); 
            }
	    
	    
	}
	
	
	function import_proses(){
	       error_reporting(0);

	$values = end(explode(".", $_FILES["excel"]["name"])); // Mendapatkan semua value yang ada di tag input file excel
    $format = array("xls", "xlsx", "csv"); //pilihan format file
    if(in_array($values, $format)) {//mengecek format file yang di import
    $file = $_FILES["excel"]["tmp_name"]; // mendapatkan temporary source dari file excel
    $objPHPExcel = PHPExcel_IOFactory::load($file); // membuat objek dari library PHPExcel menggunakan metode load() untuk menemukan path dari file yang dipilih
    // Looping worksheet
 

   if($_POST['jenis']=='UPDATE'){
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
          $totalrow = $worksheet->getHighestRow();
          for($row=2; $row<=$totalrow; $row++){
    
                         echo $q = "INSERT INTO data_espt(
                            
                            nama,
                            npwp,
                            nomor,
                            tahun_pajak,
                            tanggal_penerbitan,
                            tanggal_jatuh_tempo,
                            tanggal_kirim,
                            penerbit
                            
                         ) 
                             VALUES ( 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(0, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(1, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(2, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(3, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(4, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(5, $row)->getValue())."', 
                              '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(6, $row)->getValue()).",
                              '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(7, $row)->getValue())."
                             ) ON DUPLICATE KEY UPDATE 
                              tahun_pajak = '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(3, $row)->getValue())."', 
                              tanggal_penerbitan = '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(4, $row)->getValue())."', 
                              tanggal_jatuh_tempo = '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(5, $row)->getValue())."',
                              tanggal_kirim = '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(6, $row)->getValue())."'
                             
                              
                              
                              
                              ";
                              $this->db->query($q);
    
          }
    
        }
   }elseif($_POST['jenis']=='INSERT'){
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
          $totalrow = $worksheet->getHighestRow();
          for($row=2; $row<=$totalrow; $row++){
    
                          $q = "INSERT INTO data_espt(
                             nama,
                            npwp,
                            nomor,
                            tahun_pajak,
                            tanggal_penerbitan,
                            tanggal_jatuh_tempo,
                            tanggal_kirim,
                            penerbit
                          ) 
                             VALUES ( 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(0, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(1, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(2, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(3, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(4, $row)->getValue())."', 
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(5, $row)->getValue())."',
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(6, $row)->getValue())."',
                             '".str_replace("'","\'",$worksheet->getCellByColumnAndRow(7, $row)->getValue())."'
                             )";
                             
                             
                            //   $this->db->query($q);
                              
                              $this->db->db_debug = false;
                            
                                if(!@$this->db->query($q))
                                {
                                    $error = $this->db->error();
                                        
                                        
                                        echo $error['message'];
                               
                                     
                                        $this->session->set_flashdata("error",str_replace("'",' ',$error['message']));
  
                                      redirect($this->modul()); 
                                    
                                    die();
                                    // do something in error case
                                }
                                                       

                           
    
          }
          
    
        }
        

   }elseif($_POST['jenis']=='DELETE'){
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
          $totalrow = $worksheet->getHighestRow();
          for($row=2; $row<=$totalrow; $row++){
    
                          $q = "DELETE FROM data_espt WHERE nomor='".str_replace("'","\'",$worksheet->getCellByColumnAndRow(2, $row)->getValue())."'";
                              $this->db->query($q);
    
          }
    
        }
   }

    

 
 
    $this->session->set_flashdata('import', 'Import Excel berhasil diupload !');
  
  redirect($this->modul()); 
  
  
  
  
  
  
  
  

  }else{

    $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
    die();

  }
	   
	  
	    
	}
	
}