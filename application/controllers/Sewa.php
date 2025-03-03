<?php

class Sewa extends CI_Controller{

  

  function __construct(){
    parent::__construct();
    
      $this->load->library('excel');
  }
  
    
    function modul(){
        return 'sewa';
    }
      function judul(){
        return 'Transalksi Sewa Kendaraan';
    }

  function index(){

    if (!isset($_SESSION['username'])) {
      redirect('login');
    }else{
      $data['title']=$this->modul();
      $data['modul'] = $this->modul();
      $data['judul'] = $this->judul();
       $this->load->view('header',$data);
      $this->load->view($this->modul().'/data');
      $this->load->view('footer');
    }
  }





  function add(){
    $data['title']=$this->modul().' - Tambah';
    $data['modul'] = $this->modul();
 $data['judul'] = $this->judul();
    $this->load->view('header',$data);
    $this->load->view($this->modul().'/add');
    $this->load->view('footer');
  }
  
    function detail(){
    $data['title']=$this->modul().' - Detail';
    $data['modul'] = $this->modul();
     $data['judul'] = $this->judul();

    $this->load->view('header',$data);
    $this->load->view($this->modul().'/view');
    $this->load->view('footer');
  }
  
  
    function add_import(){
    $data['title']=$this->modul().' - Import Product';
    $data['modul'] = $this->modul();
     $data['judul'] = $this->judul();

    $this->load->view('header',$data);
    $this->load->view($this->modul().'/add_import');
    $this->load->view('footer');
  }
  
  function print(){
      $data['modul'] = $this->modul();
     $this->load->view($this->modul().'/print',$data); 
  }
  
  public function uploadFoto($name_data,$ref_user){

    error_reporting(0);
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
              
              
             
              
              
              
              if($col->Type=='varchar(444)'){
                  $data_field = $this->uploadFoto($col->Field,date('ymdhis'));
              }elseif($col->Type=='float'){
                  $data_field = str_replace(",","",$this->input->post($col->Field));
              }else{
                   if($data_field=="password"){
                       
                      
                        $data_field = sha1($_POST['password']);
                      

                      
                     
                  }elseif($data_field=="harga_".$this->modul()){
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
  

  function numberEXCEL($number) {
    $column = '';
    while ($number > 0) {
        $modulo = ($number - 1) % 26;
        $column = chr(65 + $modulo) . $column;
        $number = intval(($number - $modulo) / 26);
    }
    return $column;
}


  function download(){
      
error_reporting(E_ALL);
date_default_timezone_set('Asia/Jakarta');
// Create new PHPExcel object
set_time_limit(0);
error_reporting(0);
ob_start();
ob_clean();
ob_flush();
$objPHPExcel = new PHPExcel();



// Set properties
$objPHPExcel->getProperties()->setCreator("PT. Zavalabs Teknologi Indonesia")
               ->setLastModifiedBy("Zavalabs")
               ->setTitle("Laporan Excel")
               ->setSubject("Laporan Excel")
               ->setDescription("Laporan Excel")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");


// Add some data
   

               $no0=1;
              foreach($this->db->query("SHOW FULL COLUMNS from `data_".$this->modul()."` WHERE FIELD !='id_".$this->modul()."'")->result() as $col){

                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->numberEXCEL($no0).'1', $col->Comment);

                $no0++; 
              }
                    
                    
                    
                        $no=2;
            foreach($this->db->query("SELECT * FROM data_produk")->result() as $row){
          
            

                        $no1=1;
                  foreach($this->db->query("SHOW COLUMNS from `data_".$this->modul()."` WHERE FIELD !='id_".$this->modul()."'")->result() as $col){

                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->numberEXCEL($no1).$no, $row->{$col->Field});

                    $no1++; 
                  }
                   
                  
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
$objPHPExcel->getActiveSheet()->setTitle('Produk');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// // Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data_produk.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');


        

     
  
      
  }
  
  function delete_jawaban(){
        $id = $this->uri->segment(3);
    
    
    $sql = "SELECT * FROM data_jawab WHERE id_jawab='$id'";
    
     if($this->db->query($sql)){
                  
                     $this->session->set_flashdata('update', ' Data berhasil di hapus');
                   redirect($this->modul()); 
                }
                
  }

  function delete(){
    $id = $this->uri->segment(3);

         
          $sql="DELETE FROM data_".$this->modul()." WHERE id_".$this->modul()."='$id'";
                if($this->db->query($sql)){
                  
                     $this->session->set_flashdata('update', ' Data berhasil di hapus');
                   redirect($this->modul()); 
                }
                
                
    
        
      
  }


    function clear(){
    $id = $this->uri->segment(3);

         
          $sql="TRUNCATE data_".$this->modul()."";
                if($this->db->query($sql)){
                  
                     $this->session->set_flashdata('update', ' Data berhasil di bersihkan !');
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

    $id = $this->uri->segment(3);
    $data['title']=$this->modul().' - Edit';
    $data['id'] = $id;
     $data['judul'] = $this->judul();
    $data['modul'] = $this->modul();
    $this->load->view('header',$data);
    $this->load->view($this->modul().'/edit',$data);
    $this->load->view('footer');
  }
  
  
    function add_pdf(){

    $id = $this->uri->segment(3);
    $data['title']=$this->modul().' - Upload PDF';
    $data['id'] = $id;
    $data['modul'] = $this->modul();
     $data['judul'] = $this->judul();
    $this->load->view('header',$data);
    $this->load->view($this->modul().'/add_pdf',$data);
    $this->load->view('footer');
  }

  



  function update(){
      
        

      
      

    $id = $this->input->post('id_'.$this->modul());

        $sql="UPDATE data_".$this->modul()." SET ";
        
        
          
          
          
                  
            $jml =$this->db->query("SHOW COLUMNS from `data_".$this->modul()."` WHERE FIELD !='id_".$this->modul()."'")->num_rows();
 
          $no=1;
          
           foreach($this->db->query("SHOW COLUMNS from `data_".$this->modul()."` WHERE FIELD !='id_".$this->modul()."'")->result() as $col){
              
              
               $data_field = $col->Field;
  
              
                  
              if($col->Type=='varchar(444)'){



      
                  if(!empty($_FILES[$col->Field]['name'])){
                    
                      $data_field  = $this->uploadFoto($col->Field,date('ymdhis'));
                      unlink($_POST[$col->Field.'_old']);
                       
                  }else{
                      
                       $data_field  = $_POST[$col->Field.'_old'];
                  }
      
              }elseif($col->Type=='float'){
                  $data_field = str_replace(",","",$this->input->post($col->Field));
              }else{
                   if($data_field=="password"){
                       
                       if(!empty($_POST['newpassword'])){
                        $data_field = sha1($_POST['newpassword']);
                       }else{
                        $data_field = $_POST['password'];
                       }

                      
                     
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
 
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
          $totalrow = $worksheet->getHighestRow();
          for($row=2; $row<=$totalrow; $row++){
    
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
              
              
              $data_field = str_replace("'","\'",$worksheet->getCellByColumnAndRow($no2-1, $row)->getValue());
              
              
             
               if($jml==$no2){
                 $sql .= "'".$data_field."'";
               }else{
                   $sql .= "'".$data_field."',";
               }
             
             
             $no2++;

           }

           $sql .= ");";

           // echo $sql;
                             


                          
                             
                                                         
                              $this->db->db_debug = false;
                            
                                if(!@$this->db->query($sql))
                                {
                                    $error = $this->db->error();
                                        
                                        
                                        echo $error['message'];
                               
                                     
                                        $this->session->set_flashdata("error",str_replace("'",' ',$error['message']));
  
                                      redirect($this->modul()); 
                                    
                                    // die();
                                    // do something in error case
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