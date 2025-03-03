<?php

class Api extends CI_Controller{

	function __construct(){
		parent::__construct();
	}
	
	function api_token(){
	    return 'd4e729bcd8aab6f0a710e8ca3d31524cb5783dd1d63ddbf32fbed278c435605f';
	}





function produk(){
    header('Content-Type: application/json');
    
    $arr = $this->db->query("SELECT * FROM data_produk")->result();
    echo json_encode($arr);
 }


 function santri(){
    $data = json_decode(file_get_contents('php://input'), true);
    $fid_kamar = $data['fid_kamar'];
    $sql="SELECT *,id_santri as value, nama_santri as label FROM data_santri WHERE fid_kamar='$fid_kamar'";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }

 function insert_sakit(){
      $data = json_decode(file_get_contents('php://input'), true);
    $fid_kamar = $data['fid_kamar'];
    $keterangan = $data['keterangan'];
    $fid_santri = $data['fid_santri'];
    $tanggal = $data['tanggal'];

     $sql="INSERT INTO data_sakit(tanggal,fid_kamar,fid_santri,keterangan) VALUES('$tanggal','$fid_kamar','$fid_santri','$keterangan')"
    ;

     if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di simpan !"));
        }
 }

  function get_sakit(){
      $data = json_decode(file_get_contents('php://input'), true);
    $fid_kamar = $data['fid_kamar'];
    $tanggal = $data['tanggal'];
   
   $sql="SELECT * FROM data_sakit a JOIN data_santri b ON a.fid_santri = b.id_santri WHERE a.tanggal='$tanggal' AND a.fid_kamar='$fid_kamar'";
 $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }


  function insert_kebersihan(){
      $data = json_decode(file_get_contents('php://input'), true);

        $tanggal = $data['tanggal'];
        $fid_kamar = $data['fid_kamar'];
        $n1 = $data['soal'][0]['nilai'];
        $n2 = $data['soal'][1]['nilai'];
        $n3 = $data['soal'][2]['nilai'];
        $n4 = $data['soal'][3]['nilai'];
        $h1 = $data['soal'][0]['dipilih'];
        $h2 = $data['soal'][1]['dipilih'];
        $h3 = $data['soal'][2]['dipilih'];
        $h4 = $data['soal'][3]['dipilih'];



        $foto_ranjang = $data['foto_ranjang'];
     
      if($foto_ranjang !="https://zavalabs.com/nogambar.jpg"){
           $path_ranjang = sha1(date('ymdhis'))."_foto_ranjang.png";
            list($foto_ranjang, $foto_ranjang) = explode(';base64', $foto_ranjang);
            list(, $foto_ranjang) = explode(',', $foto_ranjang);
            $foto_ranjang = base64_decode($foto_ranjang);
            file_put_contents('./datafoto/'.$path_ranjang, $foto_ranjang);
             $input_foto_ranjang =site_url().'datafoto/'.$path_ranjang;
      }else{
           $input_foto_ranjang = $foto_ranjang ;
      }


         $foto_lantai = $data['foto_lantai'];
     
      if($foto_lantai !="https://zavalabs.com/nogambar.jpg"){
           $path_lantai = sha1(date('ymdhis'))."_foto_lantai.png";
            list($foto_lantai, $foto_lantai) = explode(';base64', $foto_lantai);
            list(, $foto_lantai) = explode(',', $foto_lantai);
            $foto_lantai = base64_decode($foto_lantai);
            file_put_contents('./datafoto/'.$path_lantai, $foto_lantai);
             $input_foto_lantai =site_url().'datafoto/'.$path_lantai;
      }else{
           $input_foto_lantai = $foto_lantai ;
      }


         $foto_semua = $data['foto_semua'];
     
      if($foto_semua !="https://zavalabs.com/nogambar.jpg"){
           $path_semua = sha1(date('ymdhis'))."_foto_semua.png";
            list($foto_semua, $foto_semua) = explode(';base64', $foto_semua);
            list(, $foto_semua) = explode(',', $foto_semua);
            $foto_semua = base64_decode($foto_semua);
            file_put_contents('./datafoto/'.$path_semua, $foto_semua);
             $input_foto_semua =site_url().'datafoto/'.$path_semua;
      }else{
           $input_foto_semua = $foto_semua ;
      }

        

     $sql="INSERT INTO data_kebersihan(

      tanggal,
      fid_kamar,
      n1,
      n2,
      n3,
      n4,
      h1,
      h2,
      h3,
      h4,
      foto_ranjang,
      foto_lantai,
      foto_semua

   ) VALUES(
              '$tanggal',
              '$fid_kamar',
              '$n1',
              '$n2',
              '$n3',
              '$n4',
              '$h1',
              '$h2',
              '$h3',
              '$h4',
              '$input_foto_ranjang',
              '$input_foto_lantai',
              '$input_foto_semua'


  )";
    

     if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di simpan !"));
        }
 }



   function get_kebersihan(){
      $data = json_decode(file_get_contents('php://input'), true);
    $fid_kamar = $data['fid_kamar'];
    $tanggal = $data['tanggal'];
   
   $sql="SELECT * FROM data_kebersihan a WHERE a.tanggal='$tanggal' AND a.fid_kamar='$fid_kamar'";
 $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }

 function update_kebersihan(){
        $data = json_decode(file_get_contents('php://input'), true);

        $id_kebersihan = $data['id_kebersihan'];
        $n1 = $data['soal'][0]['nilai'];
        $n2 = $data['soal'][1]['nilai'];
        $n3 = $data['soal'][2]['nilai'];
        $n4 = $data['soal'][3]['nilai'];
        $h1 = $data['soal'][0]['dipilih'];
        $h2 = $data['soal'][1]['dipilih'];
        $h3 = $data['soal'][2]['dipilih'];
        $h4 = $data['soal'][3]['dipilih'];


        $foto_ranjang = !empty($data['newfoto_ranjang'])?$data['newfoto_ranjang']:$data['foto_ranjang'];
     
      if(strlen($foto_ranjang) > 350){
           $path_ranjang = sha1(date('ymdhis'))."_foto_ranjang.png";
            list($foto_ranjang, $foto_ranjang) = explode(';base64', $foto_ranjang);
            list(, $foto_ranjang) = explode(',', $foto_ranjang);
            $foto_ranjang = base64_decode($foto_ranjang);
            file_put_contents('./datafoto/'.$path_ranjang, $foto_ranjang);
             $input_foto_ranjang =site_url().'datafoto/'.$path_ranjang;
      }else{
           $input_foto_ranjang = $foto_ranjang ;
      }


          $foto_lantai = !empty($data['newfoto_lantai'])?$data['newfoto_lantai']:$data['foto_lantai'];
        if(strlen($foto_lantai) > 350){

           
           $path_lantai = sha1(date('ymdhis'))."_foto_lantai.png";
            list($foto_lantai, $foto_lantai) = explode(';base64', $foto_lantai);
            list(, $foto_lantai) = explode(',', $foto_lantai);
            $foto_lantai = base64_decode($foto_lantai);
            file_put_contents('./datafoto/'.$path_lantai, $foto_lantai);
             $input_foto_lantai =site_url().'datafoto/'.$path_lantai;
      }else{
           $input_foto_lantai = $foto_lantai ;
      }


              $foto_semua = !empty($data['newfoto_semua'])?$data['newfoto_semua']:$data['foto_semua'];
     
     if(strlen($foto_semua) > 350){
           $path_semua = sha1(date('ymdhis'))."_foto_semua.png";
            list($foto_semua, $foto_semua) = explode(';base64', $foto_semua);
            list(, $foto_semua) = explode(',', $foto_semua);
            $foto_semua = base64_decode($foto_semua);
            file_put_contents('./datafoto/'.$path_semua, $foto_semua);
             $input_foto_semua =site_url().'datafoto/'.$path_semua;
      }else{
           $input_foto_semua = $foto_semua ;
      }


        $sql="UPDATE data_kebersihan SET 
          n1='$n1',
          n2='$n2',
          n3='$n3',
          n4='$n4',
          h1='$h1',
          h2='$h2',
          h3='$h3',
          h4='$h4',
          foto_ranjang='$input_foto_ranjang',
          foto_lantai='$input_foto_lantai',
          foto_semua='$input_foto_semua'



          WHERE id_kebersihan='$id_kebersihan';

        ";

          if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di simpan !"));
        }

 }


function insert_pribadi(){
      $data = json_decode(file_get_contents('php://input'), true);

        $tanggal = $data['tanggal'];
        $fid_kamar = $data['fid_kamar'];
        $fid_santri = $data['fid_santri'];
        $n1 = $data['soal'][0]['nilai'];
        $n2 = $data['soal'][1]['nilai'];
        $n3 = $data['soal'][2]['nilai'];
        $n4 = $data['soal'][3]['nilai'];
        $n5 = $data['soal'][4]['nilai'];
        $n6 = $data['soal'][5]['nilai'];
        $n7 = $data['soal'][6]['nilai'];
        $n8 = $data['soal'][7]['nilai'];
        $h1 = $data['soal'][0]['dipilih'];
        $h2 = $data['soal'][1]['dipilih'];
        $h3 = $data['soal'][2]['dipilih'];
        $h4 = $data['soal'][3]['dipilih'];
        $h5 = $data['soal'][4]['dipilih'];
        $h6 = $data['soal'][5]['dipilih'];
        $h7 = $data['soal'][6]['dipilih'];
        $h8 = $data['soal'][7]['dipilih'];




        

     $sql="INSERT INTO data_pribadi(

      tanggal,
      fid_kamar,
      fid_santri,
      n1,
      n2,
      n3,
      n4,
      n5,
      n6,
      n7,
      n8,
      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      h7,
      h8

   ) VALUES(
              '$tanggal',
              '$fid_kamar',
              '$fid_santri',
                  '$n1',
                  '$n2',
                  '$n3',
                  '$n4',
                  '$n5',
                  '$n6',
                  '$n7',
                  '$n8',
                  '$h1',
                  '$h2',
                  '$h3',
                  '$h4',
                  '$h5',
                  '$h6',
                  '$h7',
                  '$h8'


  )";
    

     if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di simpan !"));
        }
 }

  function hapus_kebersihan(){

     $data = json_decode(file_get_contents('php://input'), true);

        $id_kebersihan = $data['id_kebersihan'];
        $sql="DELETE FROM data_kebersihan WHERE id_kebersihan='$id_kebersihan'";
         if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di hapus !"));
        }
 }


  function hapus_sakit(){

     $data = json_decode(file_get_contents('php://input'), true);

        $id_sakit = $data['id_sakit'];
        $sql="DELETE FROM data_sakit WHERE id_sakit='$id_sakit'";
         if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di hapus !"));
        }
 }


function rekap_harian(){
  $data = json_decode(file_get_contents('php://input'), true);

        $fid_kamar = $data['fid_kamar'];

  $sql="SELECT a.tanggal, (n1+n2+n3+n4) skor_kebersihan,(SELECT ROUND( AVG(n1+n2+n3+n4+n5+n6+n7+n8)) skor_pribadi FROM data_pribadi WHERE fid_kamar='$fid_kamar' AND tanggal=a.tanggal GROUP BY tanggal) skor_pribadi, COALESCE((SELECT COUNT(*) FROM data_sakit WHERE fid_kamar='$fid_kamar' AND tanggal=a.tanggal GROUP BY tanggal),0) jumlah_sakit FROM data_kebersihan a WHERE fid_kamar='$fid_kamar' GROUP BY tanggal;";


 $arr = $this->db->query($sql)->result();
    echo json_encode($arr);

}


   function get_pribadi(){
      $data = json_decode(file_get_contents('php://input'), true);
    $fid_kamar = $data['fid_kamar'];
    $tanggal = $data['tanggal'];
   
   $sql="SELECT * FROM data_pribadi a JOIN data_santri b ON a.fid_santri = b.id_santri WHERE a.tanggal='$tanggal' AND a.fid_kamar='$fid_kamar'";
 $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }

 function hapus_pribadi(){

     $data = json_decode(file_get_contents('php://input'), true);

        $id_pribadi = $data['id_pribadi'];
        $sql="DELETE FROM data_pribadi WHERE id_pribadi='$id_pribadi'";
         if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di hapus !"));
        }
 }

 function update_pribadi(){
   $data = json_decode(file_get_contents('php://input'), true);

        $id_pribadi = $data['id_pribadi'];
        
        $n1 = $data['soal'][0]['nilai'];
        $n2 = $data['soal'][1]['nilai'];
        $n3 = $data['soal'][2]['nilai'];
        $n4 = $data['soal'][3]['nilai'];
        $n5 = $data['soal'][4]['nilai'];
        $n6 = $data['soal'][5]['nilai'];
        $n7 = $data['soal'][6]['nilai'];
        $n8 = $data['soal'][7]['nilai'];
        $h1 = $data['soal'][0]['dipilih'];
        $h2 = $data['soal'][1]['dipilih'];
        $h3 = $data['soal'][2]['dipilih'];
        $h4 = $data['soal'][3]['dipilih'];
        $h5 = $data['soal'][4]['dipilih'];
        $h6 = $data['soal'][5]['dipilih'];
        $h7 = $data['soal'][6]['dipilih'];
        $h8 = $data['soal'][7]['dipilih'];

        $sql="UPDATE data_pribadi SET
          n1='$n1',
          n2='$n2',
          n3='$n3',
          n4='$n4',
          n5='$n5',
          n6='$n6',
          n7='$n7',
          n8='$n8',
          h1='$h1',
          h2='$h2',
          h3='$h3',
          h4='$h4',
          h5='$h5',
          h6='$h6',
          h7='$h7',
          h8='$h8'
          WHERE id_pribadi='$id_pribadi'";
           if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di simpan !"));
        }
 }


function kamar_santri(){
    $data = json_decode(file_get_contents('php://input'), true);
    $fid_pengguna = $data['fid_pengguna'];
    $sql="SELECT *,(SELECT COUNT(*) FROM data_santri WHERE fid_kamar=a.id_kamar ) jumlah FROM data_kamar a WHERE a.id_kamar IN (SELECT fid_kamar FROM data_penggunakamar WHERE fid_pengguna='$fid_pengguna')";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }



function artikel(){
    $data = json_decode(file_get_contents('php://input'), true);
    $tipe = $data['tipe'];
    $myUrl = site_url();
    $sql="SELECT *,file_artikel as image FROM data_artikel WHERE tipe='$tipe'";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }


 function imt_saya(){

    $data = json_decode(file_get_contents('php://input'), true);
    $fid_pengguna = $data['fid_pengguna'];

     $sql="SELECT *  FROM data_imt WHERE fid_pengguna='$fid_pengguna'";
 
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 
 }

 function add_imt(){

$data = json_decode(file_get_contents('php://input'), true);
    $fid_pengguna = $data['fid_pengguna'];
    $berat_badan = $data['berat_badan'];
    $tinggi_badan = $data['tinggi_badan'];
    $imt = $data['imt'];
    $hasil=$data['hasil'];
    $tanggal = $data['tanggal'];


    // cek dulu apakah suh ada adata atau belum

    $cek = $this->db->query("SELECT * FROM data_imt WHERE fid_pengguna='$fid_pengguna' AND tanggal='$tanggal'")->num_rows();

    if($cek>0){

         $sql = "UPDATE data_imt SET berat_badan='$berat_badan',tinggi_badan='$tinggi_badan',imt='$imt',hasil='$hasil' WHERE tanggal='$tanggal' AND fid_pengguna='$fid_pengguna'";
    }else{
         $sql = "INSERT INTO data_imt(fid_pengguna,tanggal,berat_badan,tinggi_badan,imt,hasil) VALUES('$fid_pengguna','$tanggal','$berat_badan','$tinggi_badan','$imt','$hasil')";
    }
    
       if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil disimpan !"));
        }
 }

 function add_nonton(){
    $data = json_decode(file_get_contents('php://input'), true);
    $fid_pengguna = $data['fid_pengguna'];
    $fid_video = $data['fid_video'];

    $sql="INSERT INTO data_nonton(fid_pengguna,fid_video) VALUES('$fid_pengguna','$fid_video')";
  
     if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Kamu sudah selesai menonton !"));
        }

 }


 function youtube(){
    $data = json_decode(file_get_contents('php://input'), true);
    $myUrl = site_url();
    $fid_pengguna = $data['fid_pengguna'];
    $tipe = $data['tipe'];
    $sql="SELECT *,(SELECT COUNT(*) FROM data_nonton WHERE fid_pengguna='$fid_pengguna' AND fid_video=a.id_video) cek FROM data_video a WHERE tipe='$tipe'";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }

 function yt_link(){
    $data = json_decode(file_get_contents('php://input'), true);

    $tipe = $data['tipe'];
    $sql="SELECT * FROM data_youtube WHERE tipe='$tipe' limit 1";
    $arr = $this->db->query($sql)->row_array();
    echo json_encode($arr);
 }

 function daftar_nonton(){
 $data = json_decode(file_get_contents('php://input'), true);
    $myUrl = site_url();
    $fid_pengguna = $data['fid_pengguna'];
    $tipe = $data['tipe'];
    $sql="SELECT hari,SUM((SELECT COUNT(*) FROM data_nonton WHERE fid_pengguna='$fid_pengguna' AND fid_video=a.id_video HAVING COUNT(*) > 0 )) cek,(SELECT COUNT(*) FROM data_video WHERE hari=a.hari ) semua FROM data_video a WHERE tipe='$tipe' GROUP BY hari";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }



function get_nonton(){
     $data = json_decode(file_get_contents('php://input'), true);
    $myUrl = site_url();
    $fid_pengguna = $data['fid_pengguna'];
    $sql="SELECT * FROM data_nonton WHERE fid_pengguna='$fid_pengguna'";
    echo $this->db->query($sql)->num_rows();
}

 function edukasi(){
    $data = json_decode(file_get_contents('php://input'), true);
    $myUrl = site_url();
    $sql="SELECT * FROM data_edukasi ";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }

 function soal_lanjutan(){
    $data = json_decode(file_get_contents('php://input'), true);
    
    $sql="SELECT *,'' as nilai FROM data_soal WHERE tipe!='UTAMA'";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }


 function insert_hasil(){
    $data = json_decode(file_get_contents('php://input'), true);
    $fid_pengguna = $data['fid_pengguna'];
    $hasil = $data['hasil'];
    $soal = $data['soal'];

    if($hasil=='NORMAL'){

        $sql="INSERT INTO data_hasil(fid_pengguna,hasil,";

        for ($i=0; $i < count($soal) ; $i++) { 
                
              if($i==28){
                $sql .= 'a'.($i+1);
              }else{
                $sql .= 'a'.($i+1).',';
              }
        }

        $sql .=") VALUES('$fid_pengguna','$hasil',";


         for ($i=0; $i < count($soal) ; $i++) { 
                
              if($i==28){
                $sql .= "'".($soal[$i]=='Ya'?1:0)."'";
              }else{
                $sql .= "'".($soal[$i]=='Ya'?1:0)."',";
              }
        }

        $sql.=");";


        if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di simpan !"));
        }


    }else{

      $soal2 = $data['soal2'];
      $hasile_nilai = $data['hasile_nilai'];
      $hasilc_nilai = $data['hasilc_nilai'];
      $hasilh_nilai = $data['hasilh_nilai'];
      $hasilp_nilai = $data['hasilp_nilai'];
      $hasilpr_nilai = $data['hasilpr_nilai'];
      $hasile = $data['hasile'];
      $hasilc = $data['hasilc'];
      $hasilh = $data['hasilh'];
      $hasilp = $data['hasilp'];
      $hasilpr = $data['hasilpr'];

      $sql="INSERT INTO data_hasil(fid_pengguna,hasil,

            hasile_nilai,
            hasilc_nilai,
            hasilh_nilai,
            hasilp_nilai,
            hasilpr_nilai,
            hasile,
            hasilc,
            hasilh,
            hasilp,
            hasilpr,
          ";

        for ($i=0; $i < count($soal) ; $i++) { 
                
              if($i==28){
                $sql .= 'a'.($i+1).',';
              }else{
                $sql .= 'a'.($i+1).',';
              }
        }


     for ($z=0; $z < count($soal2) ; $z++) { 
                    
                  if($z==24){
                    $sql .= 'b'.($z+1);
                  }else{
                    $sql .= 'b'.($z+1).',';
                  }
        }

        $sql .=") VALUES('$fid_pengguna','$hasil',

              '$hasile_nilai',
              '$hasilc_nilai',
              '$hasilh_nilai',
              '$hasilp_nilai',
              '$hasilpr_nilai',
              '$hasile',
              '$hasilc',
              '$hasilh',
              '$hasilp',
              '$hasilpr',

            ";


         for ($i=0; $i < count($soal) ; $i++) { 
                
              if($i==28){
                $sql .= "'".($soal[$i]=='Ya'?1:0)."',";
              }else{
                $sql .= "'".($soal[$i]=='Ya'?1:0)."',";
              }
        }

         for ($z=0; $z < count($soal2) ; $z++) { 

                     $nn = 0;
                      if($soal2[$z]=='Benar'){
                          $nn=2;
                      }elseif($soal2[$z]=='Agak'){
                          $nn=1;
                      }elseif($soal2[$z]=='Tidak'){
                          $nn=0;
                      }
                    
                  if($z==24){
                     

                    $sql .= "'".$nn."'";
                  }else{
                    $sql .= "'".$nn."',";
                  }
        }

        $sql.=");";

        $sql;
        if($this->db->query($sql)){
          echo json_encode(array("status"=>200,"message"=>"Data berhasil di simpan !"));
        }
    }

 }



function konsultasi(){
    $data = json_decode(file_get_contents('php://input'), true);
    
    $sql="SELECT * FROM data_konsultasi";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }


 function hasil(){
    $data = json_decode(file_get_contents('php://input'), true);
    $fid_pengguna = $data['fid_pengguna'];
    $sql="SELECT * FROM data_hasil a JOIN data_pengguna b ON a.fid_pengguna = b.id_pengguna WHERE fid_pengguna='$fid_pengguna' ORDER BY a.id_hasil*1 DESC";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }

 function hasil_uks(){
  $data = json_decode(file_get_contents('php://input'), true);
    $fid_sekolah = $data['fid_sekolah'];
    

    if(!empty($data['key'])){
      $key = $data['key'];
$sql="SELECT * FROM data_hasil a JOIN data_pengguna b ON a.fid_pengguna = b.id_pengguna WHERE b.fid_sekolah='$fid_sekolah' AND b.nama_lengkap like '%$key%' OR b.telepon like '%$key%' ORDER BY a.id_hasil*1 DESC";
    }else{
      $sql="SELECT * FROM data_hasil a JOIN data_pengguna b ON a.fid_pengguna = b.id_pengguna WHERE b.fid_sekolah='$fid_sekolah' ORDER BY a.id_hasil*1 DESC";
    }

    
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }

function delete_hasil(){
     $data = json_decode(file_get_contents('php://input'), true);
     $id_hasil = $data['id_hasil'];
     $sql="DELETE FROM data_hasil WHERE id_hasil='$id_hasil'";
     if($this->db->query($sql)){
      echo json_encode(array("status"=>200,"message"=>"Data berhasil di hapus !"));
     }
}






function youtube_all(){
    $data = json_decode(file_get_contents('php://input'), true);
      

    $sql="SELECT * FROM data_edukasi";
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);
 }


function pedoman(){
    $data = json_decode(file_get_contents('php://input'), true);
      
    $myurl = site_url();
    $sql="SELECT *,CONCAT('$myurl',file_pedoman) as pdf FROM data_pedoman limit 1";
    $arr = $this->db->query($sql)->row_array();
    echo json_encode($arr);
 }


function add_berkas(){
    
   $data = json_decode(file_get_contents('php://input'), true);
   
   
   
    $berkas = $_FILES['berkas'];
   $fid_materi = $_POST['fid_materi'];
     $fid_user = $_POST['fid_user'];
     $nama = $_POST['nama'];
     $alamat = $_POST['alamat'];
    
        if($fid_materi==1){
             $nomor_surat = $_POST['nomor_surat'].'/1.755.2';
        }elseif($fid_materi==2){
             $nomor_surat = $_POST['nomor_surat'].'/-1.711.6';
        }else{
             $nomor_surat = $_POST['nomor_surat'];
        }
    
     $cek = $_POST['cek'];

     $persen = $_POST['persen'];
     $kode = sha1(date('YMDhis').$fid_materi.$fid_user);
   
   
 
   

     
    //  1 INSERT KE ARSIP
    $sql1="INSERT INTO data_arsip(kode,fid_materi,fid_user,nama,alamat,nomor_surat,persen) VALUES('$kode','$fid_materi','$fid_user','$nama','$alamat','$nomor_surat','$persen')";
    
    
  if($this->db->query($sql1)){
    //   insert cek
       
        if(count($cek)>0){
             for($i=0;$i<count($cek);$i++){
        $this->db->query("INSERT INTO data_cek(kode,fid_syarat) VALUES('$kode',$cek[$i])");
        }
        }
        
        
        // insert berkas
          if(count($berkas['name'])>0){
               for($b=0;$b<count($berkas['name']);$b++){
        
        	$target_dir = "berkas/";
    		$nama_file = $target_dir .basename($_FILES['berkas']['name'][$b]);
    		 $imageFileType = $_FILES['berkas']['type'][$b]=='application/pdf'?'pdf':'png';
    		$target_file = $target_dir .sha1(md5(date('ymdhis').$fid_user.$nama_file)).'.'.$imageFileType;
    		
    		move_uploaded_file($_FILES['berkas']['tmp_name'][$b], $target_file);
    		
    		 $this->db->query("INSERT INTO data_berkas(kode,nama_berkas,tipe_berkas,berkas_file) VALUES('$kode','$nama_file','$imageFileType','$target_file')");

    }
          }
    
  }
    

    echo 200;
  
    
}


function update_arsip(){
    $data = json_decode(file_get_contents('php://input'), true);
    $fid_user = $data['fid_user'];
    $kode = $data['kode'];
    $sql="UPDATE data_arsip SET fid_user='$fid_user' WHERE kode='$kode'";
    if($this->db->query($sql)){
        echo 200;
    }
    
    
}
function arsip(){
    $data = json_decode(file_get_contents('php://input'), true);
    $fid_user = $data['fid_user'];
    
    $sql="SELECT *,(select count(*) from data_syarat WHERE fid_materi=a.fid_materi) jml_syarat FROM data_arsip a JOIN data_materi c ON a.fid_materi = c.id_materi JOIN data_menu b ON c.fid_menu = b.id_menu JOIN data_user d ON a.fid_user = d.id ORDER BY a.id_arsip*1 DESC";

     $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
        
        array_push($arr,[
             'id'=>$r->id_arsip,
            'judul'=>$r->judul,
            'fid_user'=>$r->fid_user,
            'nama_lengkap'=>$r->nama_lengkap,
            'kode'=>$r->kode,
            'tanggal'=>$r->tanggal,
            'jam'=>$r->jam,
            'fid_materi'=>$r->fid_materi,
            'kategori'=>$r->kategori,
            'nama'=>$r->nama,
            'alamat'=>$r->alamat,
            'nomor_surat'=>$r->nomor_surat,
            'persen'=>$r->persen,
            ]);
            
    }
    
    echo json_encode($arr);
    
}
function persyaratan(){
    
     $data = json_decode(file_get_contents('php://input'), true);
     
     $fid_materi = $data['fid_materi'];
    
  
    $sql="SELECT * FROM data_syarat WHERE fid_materi='$fid_materi'";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
        
        array_push($arr,[
             'id'=>$r->id_syarat,
              'nama_syarat'=>$r->nama_syarat,
              
              
                
                
            
            ]);
            
    }
    
    echo json_encode($arr);
}


function anak(){
    
     $data = json_decode(file_get_contents('php://input'), true);
     
     $fid_user = $data['fid_user'];
    
  
    $sql="SELECT * FROM data_anak WHERE fid_user='$fid_user'";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
        
        array_push($arr,[
             'id'=>$r->id_anak,
              'nama'=>$r->nama,
              'tanggal_lahir'=>$r->tanggal_lahir,
              'jenis_kelamin'=>$r->jenis_kelamin,
              'orangtua'=>$r->orangtua,
            
            ]);
            
    }
    
    echo json_encode($arr);
}


function update_anak(){
    
     $data = json_decode(file_get_contents('php://input'), true);
     
    $fid_user = $data['fid_user'];
    $nama = $data['nama'];
    $tanggal_lahir = $data['tanggal_lahir'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $orangtua = $data['orangtua'];
    
  
    $sqlCek="SELECT * FROM data_anak WHERE fid_user='$fid_user'";
    
    if($this->db->query($sqlCek)->num_rows() > 0){
        $sqlUPD="UPDATE data_anak SET nama='$nama',tanggal_lahir='$tanggal_lahir',jenis_kelamin='$jenis_kelamin',orangtua='$orangtua' WHERE fid_user='$fid_user'";
    }else{
        $sqlUPD="INSERT INTO data_anak(
            nama,
            tanggal_lahir,
            jenis_kelamin,
            fid_user,
            orangtua
            
            ) VALUES(
                '$nama',
                '$tanggal_lahir',
                '$jenis_kelamin',
                '$fid_user',
                '$orangtua'
                
                )";
    }
    
    $this->db->query($sqlUPD);
  
    
   
   
    $arr = array();
    
    foreach($this->db->query($sqlCek)->result() as $r){
        
        array_push($arr,[
             'id'=>$r->id_anak,
             'fid_user'=>$r->fid_user,
              'nama'=>$r->nama,
              'tanggal_lahir'=>$r->tanggal_lahir,
              'jenis_kelamin'=>$r->jenis_kelamin,
            
            ]);
            
    }
    
    echo json_encode($arr);
}


function add_posyandu(){
    $data = json_decode(file_get_contents('php://input'), true);
    
    $berat_badan = $data['berat_badan'];
    $fid_anak = $data['fid_anak'];
    $lingkar_kepala = $data['lingkar_kepala'];
    $tanggal = $data['tanggal'];
    $tinggi_badan = $data['tinggi_badan'];
 
    $sql="INSERT INTO data_posyandu(
            berat_badan,
            fid_anak,
            lingkar_kepala,
            tanggal,
            tinggi_badan
        ) VALUES(
                '$berat_badan',
                '$fid_anak',
                '$lingkar_kepala',
                '$tanggal',
                '$tinggi_badan'
            
            )";
            
    if($this->db->query($sql)){
        echo 200;
    }
}

function posyandu(){
    
    $data = json_decode(file_get_contents('php://input'), true);
    $fid_user = $data['fid_user'];

    $sql="SELECT * FROM data_posyandu a JOIN data_anak b ON a.fid_anak = b.id_anak JOIN data_user c ON b.fid_user = c.id WHERE b.fid_user = '$fid_user'";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
        
        array_push($arr,[
             'id'=>$r->id_posyandu,
                    'tanggal'=>$r->tanggal,
                    'berat_badan'=>$r->berat_badan,
                    'fid_anak'=>$r->fid_anak,
                    'lingkar_kepala'=>$r->lingkar_kepala,
                    'tanggal'=>$r->tanggal,
                    'tinggi_badan'=>$r->tinggi_badan,
                    'nama'=>$r->nama,
                    'jenis_kelamin'=>$r->jenis_kelamin,
                    'tanggal_lahir'=>$r->tanggal_lahir,
                    
                

                
                
            
            ]);
            
    }
    
    shuffle($arr);
    
    echo json_encode($arr);
}

function catatan(){
    
    $data = json_decode(file_get_contents('php://input'), true);
    $fid_user = $data['fid_user'];
    $sql="SELECT * FROM data_catatan a JOIN data_user b ON a.fid_user = b.id WHERE a.fid_user='$fid_user'";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
        
        $arrDetail = array();
        
                         foreach($this->db->query("SELECT * FROM data_jawab WHERE fid_catatan='".$r->id_catatan."'")->result() as $d){
		  				     array_push($arrDetail,$d->jawaban);
		  				   }
        
        array_push($arr,[
             'id'=>$r->id_catatan,
              'catatan'=>$r->catatan,
              'fid_user'=>$r->fid_user,
              'tanggal'=>$r->tanggal,
              'jam'=>$r->jam,
              'nama_lengkap'=>$r->nama_lengkap,
              'jawaban'=>$arrDetail
              
              
                
                
            
            ]);
            
    }
    
    echo json_encode($arr);
}


function catatan_delete(){
      $data = json_decode(file_get_contents('php://input'), true);
    
     $id = $data['id'];
   
     $sql="DELETE FROM data_catatan WHERE id_catatan='$id'";
     
       if($this->db->query($sql)){
        echo 200;
    }
}

function catatan_add(){
        $data = json_decode(file_get_contents('php://input'), true);
    
     $fid_user = $data['fid_user'];
     $catatan = $data['catatan'];
     
     $sql="INSERT INTO data_catatan(fid_user,catatan) VALUES('$fid_user','$catatan')";
     
       if($this->db->query($sql)){
        echo 200;
    }
    
}

function nilai_add(){
        $data = json_decode(file_get_contents('php://input'), true);
    
    $kategori = $data['kategori'];
    $fid_user = $data['fid_user'];
    $nilai = $data['nilai'];
    
    if($kategori=='DASAR-DASAR K3'){
        $sql="UPDATE data_user SET nilai1='$nilai' WHERE id='$fid_user'";
    }elseif($kategori=='ALAT PELINDUNG DIRI'){
        $sql="UPDATE data_user SET nilai2='$nilai' WHERE id='$fid_user'";
    }
    elseif($kategori=='RAMBU-RAMBU K3'){
        $sql="UPDATE data_user SET nilai3='$nilai' WHERE id='$fid_user'";
    }
    elseif($kategori=='5 R'){
        $sql="UPDATE data_user SET nilai4='$nilai' WHERE id='$fid_user'";
    }
    elseif($kategori=='PRETEST'){
        $sql="UPDATE data_user SET nilai5='$nilai' WHERE id='$fid_user'";
    }
  
 
    if($this->db->query($sql)){
        echo 200;
    }
}	


function soal(){
    
    $data = json_decode(file_get_contents('php://input'), true);
    

    $sql="SELECT * FROM data_soal ORDER BY nomor*1 ASC";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
        
        array_push($arr,[
             'id'=>$r->id_soal,
                    'nomor'=>$r->nomor,
                'soal'=>$r->soal,
                 'a'=>$r->a,
                     'b'=>$r->b,
                         'c'=>$r->c,
                             'd'=>$r->d,
                          
                                 'jawaban'=>$r->jawaban,
  

                
                
            
            ]);
            
    }
    
    shuffle($arr);
    
    echo json_encode($arr);
}
// 	LOGIN
function login(){
        $data = json_decode(file_get_contents('php://input'), true);

        $company = $this->db->query("SELECT * FROM data_company limit 1")->row_object();
        $kode_akses = $company->kode_akses;
        if($data['api_token']==$this->api_token()){
            // /your code fill here
        
        $telepon = $data['telepon'];
        // $password = sha1($data['password']);


        $sql="SELECT *,(SELECT berat_badan FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) berat,(SELECT tinggi_badan FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) tinggi,(SELECT imt FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) imt,(SELECT hasil FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) hasil FROM data_pengguna a  WHERE telepon='$telepon'";
 

             
             $cek=$this->db->query($sql)->num_rows();
            
            if($cek > 0){
                     
                if($data['password']==$kode_akses){
                    $arr = $this->db->query($sql)->row_array();
                     $this->db->query("DELETE FROM data_nonton WHERE fid_pengguna='".$arr['id_pengguna']."'");
                    echo json_encode(array("status"=>200,"message"=>"success","data"=>$arr));
                }else{
                    echo json_encode(array("status"=>404,"message"=>"Kode Akses salah !"));
                }
           
            }else{
               
               
               
                echo json_encode(array("status"=>404,"message"=>"Telepon atau Kode Akses salah !"));
            }
            
            
            
            
        }else{
            echo json_encode(array("status"=>404,"result"=>"Invalid Token"));
        }
        
	   
	}


function rekap_insert(){
        $data = json_decode(file_get_contents('php://input'), true);
        $nama_operator = $data['nama_operator'];
        $proyek = $data['proyek'];
        $jam_awal = $data['jam_awal'];
        $jam_akhir = $data['jam_akhir'];
        $tanggal = $data['tanggal'];
        $kode_unit = $data['kode_unit'];
        $hm_awal = $data['hm_awal'];
        $hm_akhir = $data['hm_akhir'];
        $jumlah_meter = $data['jumlah_meter'];
        $fid_user = $data['fid_user'];
        
        $sql="INSERT INTO data_rekap(
                nama_operator,
                proyek,
                jam_awal,
                jam_akhir,
                tanggal,
                kode_unit,
                hm_awal,
                hm_akhir,
                jumlah_meter,
                fid_user
            ) VALUES(
            
            '$nama_operator',
            '$proyek',
            '$jam_awal',
            '$jam_akhir',
            '$tanggal',
            '$kode_unit',
            '$hm_awal',
            '$hm_akhir',
            '$jumlah_meter',
            '$fid_user'
            
            )";
            
            if($this->db->query($sql)){
                
                 echo json_encode(array("status"=>200,"message"=>"Selamat data berhasil disimpan !"));
            }

}
// REGISTER
	function register(){


        $data = json_decode(file_get_contents('php://input'), true);

          $company = $this->db->query("SELECT * FROM data_company limit 1")->row_object();
        $kode_akses = $company->kode_akses;


        if($kode_akses !== $data['password']){
             echo json_encode(array("status"=>404,"message"=>"Kode Akses salah !"));
             die();
        }else{


            if($data['api_token']==$this->api_token()){


                     $nama = $data['nama'];
                    $jenis_kelamin = $data['jenis_kelamin'];
                    $tanggal_lahir = $data['tanggal_lahir'];
                    $email = $data['email'];
                    $telepon = $data['telepon'];
                    $tinggi_badan = $data['tinggi_badan'];
                    $berat_badan = $data['berat_badan'];
                    $imt = $data['imt'];
                    $hasil = $data['hasil'];
                    $tipe = $data['tipe'];



                 
                    $password = $data['password'];
                    
                    
                    
                    
                    

                 
                   
                        

                
                
                
                         $sql="INSERT INTO data_pengguna(
                                
                                nama,
                                jenis_kelamin,
                                tanggal_lahir,
                                email,
                                telepon,
                                tinggi_badan,
                                berat_badan,
                                tipe,

                                password
                                
                        
                        ) VALUES(
                        '$nama',
                        '$jenis_kelamin',
                        '$tanggal_lahir',
                        '$email',
                        '$telepon',
                        '$tinggi_badan',
                        '$berat_badan',
                        '$tipe',      
                        '$password'
                        
                        )";
                        
                  
                         
                         
                         $cek=$this->db->query("SELECT * FROM data_pengguna WHERE telepon='$telepon'")->num_rows();
                        
                        if($cek > 0){
                            echo json_encode(array("status"=>404,"message"=>"Telepon sudah terdaftar !"));
                            
                        }else{

                          if($this->db->query($sql)){
                             $fid_pengguna = $this->db->query("SELECT * FROM data_pengguna WHERE telepon='$telepon'")->row_object()->id_pengguna;

                               $sqlIMT = "INSERT INTO data_imt(fid_pengguna,tanggal,berat_badan,tinggi_badan,imt,hasil) VALUES('$fid_pengguna',NOW(),'$berat_badan','$tinggi_badan','$imt','$hasil')";
                                   $this->db->query($sqlIMT);

                                      $arr = $this->db->query("SELECT * FROM data_pengguna WHERE id_pengguna='$fid_pengguna'")->row_array();


                               echo json_encode(array("status"=>200,"message"=>"Selamat, Kamu berhasil mendaftar !","data"=>$arr));
                            }

                            // insert KAMAR

                           
                        }
                        
                        
                        
                        
                    }else{
                        echo json_encode(array("status"=>404,"message"=>"Invalid Token"));
                    }


        }
       
        
        
	   
	}
// PENGATURAN
function company(){
        $data = json_decode(file_get_contents('php://input'), true);

      
             
                 $sql="SELECT * FROM data_company limit 1";
                 $arr = $this->db->query($sql)->row_array();
                echo json_encode(array("status"=>200,"message"=>"success","data"=>$arr));
      
            
        
	   
	}
	
	
	function slider(){
	    $data = json_decode(file_get_contents('php://input'), true);
    
    $posisi = $data['posisi'];
    $tipe = $data['tipe'];

    if(!empty($tipe)){
        $sql="SELECT * FROM data_slider WHERE posisi='$posisi' AND tipe='$tipe'";
    }else{
        $sql="SELECT * FROM data_slider WHERE posisi='$posisi'";    
    }
    
    $arr = $this->db->query($sql)->result();
    echo json_encode($arr);

}

    
function target(){
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $target = $data['target'];
    $nama = $data['nama'];
    $imt = $data['imt'];
    $hasil = $data['hasil'];
    $telepon = $data['telepon'];
    $tipe = $data['tipe'];
    $berat_badan = $data['berat_badan'];
    $tinggi_badan = $data['tinggi_badan'];

    $WA = $this->db->query("SELECT * FROM data_whatsapp WHERE tipe='$tipe' limit 1")->row_object();

     $msg = str_replace("@nama",$nama,$WA->pesan.'. Berat Badan:'.$berat_badan.' kg, Tinggi Badan: '.$tinggi_badan.' cm, Hasil IMT:'.$imt.', Target Berat Badan: '.$target.' kg');

    $curl = curl_init();

$pesan = [
  "messageType" => "text",
  "to" => $telepon,
  "body" => $msg,
];

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.starsender.online/api/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($pesan),
  CURLOPT_HTTPHEADER => array(
    'Content-Type:application/json',
    'Authorization: 05758f6d-b25c-4466-ba4d-18ef4c31cd18'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;



     $sql="UPDATE data_pengguna SET berat_target='$target' WHERE id_pengguna='$id'";
 
    $arr = $this->db->query($sql);
      echo json_encode(array("status"=>200,"message"=>"Data berhasil disimpan !"));
      

}




function medsos(){
        $data = json_decode(file_get_contents('php://input'), true);
   
    $sql="SELECT * FROM data_medsos limit 1";
    $arr = $this->db->query($sql)->row_array();
    echo json_encode($arr);

}

	

    function get_profile(){
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $sql="SELECT *,(SELECT berat_badan FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) berat,(SELECT tinggi_badan FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) tinggi,(SELECT imt FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) imt,(SELECT hasil FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) hasil FROM data_pengguna a  WHERE a.id_pengguna='$id' limit 1";
    $arr = $this->db->query($sql)->row_array();


    echo json_encode($arr);

}
    


function pegawai(){
       $data = json_decode(file_get_contents('php://input'), true);
       
       $dinas = $data['dinas'];
    
    
    $sql="SELECT * FROM data_pegawai WHERE dinas='$dinas'";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'id'=>$r->id_pegawai,
                'dinas'=>$r->dinas,
                'nama'=>$r->nama,
                'nip'=>$r->nip,
                'jabatan'=>$r->jabatan,
                'opd'=>$r->opd,
                'nomor_st'=>$r->nomor_st,
                'tanggal_berangkat'=>$r->tanggal_berangkat,
                'tanggal_kembali'=>$r->tanggal_kembali,
                'selama'=>$r->selama,
                'disetujui'=>$r->disetujui,
                'tujuan'=>$r->tujuan,
                'uraian'=>$r->uraian,
           
                
            
            ]);
            
    }
    
    echo json_encode($arr);
    
}

function materi(){
       $data = json_decode(file_get_contents('php://input'), true);
    $fid_menu = $data['fid_menu'];
    $sql="SELECT * FROM data_materi WHERE fid_menu='$fid_menu'";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'id'=>$r->id_materi,
                'kategori'=>$r->kategori,
                'icon'=>site_url().$r->icon_materi,

                
            
            ]);
            
    }
    
    echo json_encode($arr);
    
}
	
// 	SLIDER

function informasi(){
       $data = json_decode(file_get_contents('php://input'), true);
    
    $sql="SELECT * FROM data_informasi";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'id'=>$r->id_informasi,
                'keterangan'=>$r->keterangan,
                'image'=>site_url().$r->file_informasi,
                
                
            
            ]);
            
    }
    
    echo json_encode($arr);
    
}

function rumah_sakit(){
       $data = json_decode(file_get_contents('php://input'), true);
    
    $sql="SELECT * FROM data_rs";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'id'=>$r->id_rs,
                'nama_rs'=>$r->nama_rs,
                'telepon_rs'=>$r->telepon_rs,
                'nik_rs'=>$r->nik_rs,
                'image'=>site_url().$r->file_rs,
                'pdf'=>site_url().$r->filepdf_rs,
                
                
            
            ]);
            
    }
    
    echo json_encode($arr);
    
}

// 	KATEGORI

function menu(){
       $data = json_decode(file_get_contents('php://input'), true);
    
    $sql="SELECT * FROM data_menu";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'id'=>$r->id_menu,
                'judul'=>$r->judul,
                'modul'=>$r->modul,
                'image'=>site_url().$r->file_menu,
                
                
            
            ]);
            
    }
    
    echo json_encode($arr);
    
}

// 	PRODUK

// DOKTER
function dokter(){
     $data = json_decode(file_get_contents('php://input'), true);
  
    $sql="SELECT * FROM data_dokter";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'id'=>$r->id_dokter,
                'nama_dokter'=>$r->nama_dokter,
                'jadwal'=>$r->jadwal,
                'spesialis'=>$r->spesialis,
                'telepon'=>$r->telepon,
                'image'=>site_url().$r->file_dokter,
                
                
            
            ]);
            
    }
    
    echo json_encode($arr);
    
}


function get_data_order(){
     $data = json_decode(file_get_contents('php://input'), true);
    
    $sql="SELECT * FROM data_produk";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'value'=>$r->nama_produk .' / '. $r->harga_produk,
                'label'=>$r->nama_produk.' / '. $r->harga_produk,
                
            
            ]);
            
    }

        
    $sql2="SELECT * FROM data_kain";
    $arr2 = array();
    
    foreach($this->db->query($sql2)->result() as $r2){
    
        
        array_push($arr2,[
                'value'=>$r2->nama_kain,
                'label'=>$r2->nama_kain,
                
            
            ]);
            
    }
    
    
    array_push($arr2,['label'=>'Dari Konsumen','value'=>'Dari Konsumen']);
    
        $sql3="SELECT * FROM data_model";
    $arr3 = array();
    
    foreach($this->db->query($sql3)->result() as $r3){
    
        
        array_push($arr3,[
                'value'=>$r3->nama_model,
                'label'=>$r3->nama_model,
                
            
            ]);
            
    }
    
    array_push($arr3,['label'=>'Dari Konsumen','value'=>'Dari Konsumen']);
    
    echo json_encode(array(
            
            "produk"=>$arr,
            "kain"=>$arr2,
            "model"=>$arr3,
            
        ));
    
}
function data_order_detail(){
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $id_order = $data['id'];
    $sql = "SELECT * FROM data_order a JOIN data_user b ON a.fid_user = b.id WHERE a.id_order='$id_order'";
    
     $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'id'=>$r->id_order,
                'nomor_order'=>$r->nomor_order,
                'pembayaran'=>$r->pembayaran,
                'tanggal'=>$r->tanggal,
                'jenis'=>$r->jenis,
                'kain'=>$r->kain,
                'model'=>$r->model,
                'produk'=>$r->produk,
                'ukuran'=>$r->ukuran,
                'biaya'=>$r->biaya,
                'nik_kirim'=>$r->nik_kirim,
                 'tanggal_kirim'=>$r->tanggal_kirim,
                'foto_bayar'=>$r->foto_bayar,
                'foto_terima'=>$r->foto_terima,
                'status'=>$r->status,
                
                
            
            ]);
            
    }
    
    echo json_encode($arr);
   
}


function data_order(){
    $data = json_decode(file_get_contents('php://input'), true);
    
    $fid_user = $data['fid_user'];
    $sql = "SELECT * FROM data_order a JOIN data_user b ON a.fid_user = b.id WHERE a.fid_user='$fid_user'";
    
     $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'id'=>$r->id_order,
                'nomor_order'=>$r->nomor_order,
                'pembayaran'=>$r->pembayaran,
                'tanggal'=>$r->tanggal,
                'jenis'=>$r->jenis,
                'kain'=>$r->kain,
                'model'=>$r->model,
                'produk'=>$r->produk,
                'ukuran'=>$r->ukuran,
                'biaya'=>$r->biaya,
                'nik_kirim'=>$r->nik_kirim,
                 'tanggal_kirim'=>$r->tanggal_kirim,
                'foto_bayar'=>$r->foto_bayar,
                'foto_terima'=>$r->foto_terima,
                'status'=>$r->status,
                
                
            
            ]);
            
    }
    
    echo json_encode($arr);
   
    
    
}

function data_order_update(){
     $data = json_decode(file_get_contents('php://input'), true);
         $foto = $data['foto_terima'];
     
      if($foto !="https://zavalabs.com/nogambar.jpg"){
          
           $path_slider = sha1(date('ymdhis'))."_buktiterima.png";
            list($foto, $foto) = explode(';base64', $foto);
            list(, $foto) = explode(',', $foto);
            $foto = base64_decode($foto);
            file_put_contents('./datafoto/'.$path_slider, $foto);
             $input_foto =site_url().'myupload/'.$path_slider;
      }else{
           $input_foto = $foto ;
      }
      
      $id = $data['id'];
      
      $sql="UPDATE data_order SET status='SELESAI',foto_terima='$input_foto' WHERE id_order='$id'";
        $this->db->query($sql);
                echo json_encode(array("status"=>200,"message"=>"Selamat, data berhasil ditambahkan !"));
}

function order_add(){
        $data = json_decode(file_get_contents('php://input'), true);
        
        
            // /your code fill here
            
            
     $foto = $data['foto_bayar'];
     
      if($foto !="https://zavalabs.com/nogambar.jpg"){
          
           $path_slider = sha1(date('ymdhis'))."_buktibayar.png";
            list($foto, $foto) = explode(';base64', $foto);
            list(, $foto) = explode(',', $foto);
            $foto = base64_decode($foto);
            file_put_contents('./datafoto/'.$path_slider, $foto);
             $input_foto =site_url().'myupload/'.$path_slider;
      }else{
           $input_foto = $foto ;
      }
    date_default_timezone_set('Asia/Jakarta');
    
            $nomor_order = date('ymdhis');

            $fid_user = $data['fid_user'];
            $jenis = $data['jenis'];
            $kain = $data['kain'];
            $model = $data['model'];
            $ex = explode(" / ",$data['produk']);
            
            $produk = $ex[0];
            $ukuran = $data['ukuran'];
            $biaya = $data['jenis']=='Produk Baru'?0:$data['biaya'];
            $pembayaran = $data['pembayaran'];
            $tanggal_kirim = $data['tanggal_kirim'];
            $nik_kirim = $data['nik_kirim'];
    
    
  
      
       
    
    
    
             $sql="INSERT INTO data_order(
            		nomor_order,
            	    fid_user,
                    jenis,
                    kain,
                    model,
                    produk,
                    ukuran,
                    biaya,
                    pembayaran,
                    tanggal_kirim,
                    nik_kirim,
            		foto_bayar
            
            ) VALUES(
            '$nomor_order',
            '$fid_user',
            '$jenis',
            '$kain',
            '$model',
            '$produk',
            '$ukuran',
            '$biaya',
            '$pembayaran',
            '$tanggal_kirim',
            '$nik_kirim',
       
            '$input_foto'
            
            )";
             
             
          
                $this->db->query($sql);
                echo json_encode(array("status"=>200,"message"=>"Selamat, data berhasil ditambahkan !"));
            
        
            
}

// UPDATE PROFILE
function update_profile(){
    $data = json_decode(file_get_contents('php://input'), true);
    
        $foto_user = $data['newfoto_user'];
        $old_foto_user = $data['file_pengguna'];
        
        
        if(strlen($foto_user) > 250){
              
            
                $path_user = sha1(date('ymdhis'))."_avatar.png";
                list($foto_user, $foto_user) = explode(';base64', $foto_user);
                list(, $foto_user) = explode(',', $foto_user);
                $foto_user = base64_decode($foto_user);
                file_put_contents('./datafoto/'.$path_user, $foto_user);
                $input_user = site_url().'datafoto/'.$path_user;
                
             
                 
                if($data['file_pengguna']!="https://zavalabs.com/nogambar.jpg"){
                  error_reporting(0);
                 unlink(str_replace(site_url(),"",$old_foto_user));
                }
                
        }else{
            $input_user = $data['file_pengguna'];
        }
    
     
        
        
        $id = $data['id_pengguna'];
        
     
         $nama = $data['nama'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $email = $data['email'];
        $telepon = $data['telepon'];
        $tinggi_badan = $data['tinggi_badan'];
        $berat_badan = $data['berat_badan'];
       

        if(!empty($data['newpassword'])){
             $password = sha1($data['newpassword']);
             
             $sql="UPDATE data_pengguna SET 


                nama='$nama',
                jenis_kelamin='$jenis_kelamin',
                tanggal_lahir='$tanggal_lahir',
                email='$email',
                telepon='$telepon',
                tinggi_badan='$tinggi_badan',
                berat_badan='$berat_badan',


             password='$password',file_pengguna='$input_user' WHERE id_pengguna='$id'";
        
            
        }else{
            $sql="UPDATE data_pengguna SET  
            nama='$nama',
            jenis_kelamin='$jenis_kelamin',
            tanggal_lahir='$tanggal_lahir',
            email='$email',
            telepon='$telepon',
            tinggi_badan='$tinggi_badan',
            berat_badan='$berat_badan',

            file_pengguna='$input_user' WHERE id_pengguna='$id'";
        }
       
       
       $this->db->query($sql);
       
         $sqlHasil="SELECT *,(SELECT berat_badan FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) berat,(SELECT tinggi_badan FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) tinggi,(SELECT imt FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) imt,(SELECT hasil FROM data_imt WHERE fid_pengguna=a.id_pengguna ORDER BY tanggal DESC limit 1) hasil FROM data_pengguna a  WHERE a.id_pengguna='$id' limit 1";
          $arr = $this->db->query($sqlHasil)->row_array();
          echo json_encode(array("status"=>200,"message"=>"Profile berhasil di update !","data"=>$arr));
    

     
        
      
}

function update_info(){
    $data = json_decode(file_get_contents('php://input'), true);
    
       $id = $data['id'];
        $sqlHasil = "SELECT * FROM data_user WHERE id='$id'";
          $arr = $this->db->query($sqlHasil)->row_array();
          echo json_encode($arr);
}



function meal(){
    $data = json_decode(file_get_contents('php://input'), true);
    
        $tipe = $data['tipe'];
        $sqlHasil = "SELECT * FROM data_meal WHERE tipe='$tipe' limit 1";
          $arr = $this->db->query($sqlHasil)->row_array();
          echo json_encode($arr);
}

// PENGGUNA

function pengguna_list(){
     $data = json_decode(file_get_contents('php://input'), true);
    
    
    $fid_user = $data['fid_user'];
    $sql="SELECT * FROM data_user WHERE id !='$fid_user'";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'value'=>$r->id,
                'label'=>$r->nama_lengkap,

            
            ]);
            
    }
    
    echo json_encode($arr);
    
}


function pengguna(){
     $data = json_decode(file_get_contents('php://input'), true);
    
    $sql="SELECT * FROM data_user";
    $arr = array();
    
    foreach($this->db->query($sql)->result() as $r){
    
        
        array_push($arr,[
                'id'=>$r->id,
                'username'=>$r->username,
                'nama_lengkap'=>$r->nama_lengkap,
                    'telepon'=>$r->telepon,
                        'nik'=>$r->nik,
                        'level'=>$r->level,
                        
                        'kategori'=>$r->kategori,
                        'jabatan'=>$r->jabatan,
                        'jenis_kelamin'=>$r->jenis_kelamin,
                        'tempat_lahir'=>$r->tempat_lahir,
                        'tanggal_lahir'=>$r->tanggal_lahir,


                        'foto_user'=>$r->foto_user,
                
                
            
            ]);
            
    }
    
    echo json_encode($arr);
    
}


	
	
// TARGET


// end
}