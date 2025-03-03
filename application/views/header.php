<?php

// echo "<center><h1>APLIKASI SUDAH READY</h1></center>";
// echo "<center><h1>SILAHKAN HUBUNGI ADMIN ZAVALABS</h1></center>";
// die();

$sqlCom = "SELECT * FROM data_company limit 1";
$hasilCom = $this->db->query($sqlCom);

$comp = $hasilCom->result();

function urlutama(){
  echo 'http://localhost/rentorbarokah/';
}
function isDevice(){
    //-- Very simple way
    $useragent = $_SERVER['HTTP_USER_AGENT']; 
    $iPod = stripos($useragent, "iPod"); 
    $iPad = stripos($useragent, "iPad"); 
    $iPhone = stripos($useragent, "iPhone");
    $Android = stripos($useragent, "Android"); 
    $iOS = stripos($useragent, "iOS");
    //-- You can add billion devices 

    $DEVICE = ($iPod||$iPad||$iPhone||$Android||$iOS);
    if($DEVICE){
      return true;
    }else{
      return false;
    }
  }

function Indonesia3Tgl($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}


  function IDRtgl($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal =$tgl.'/'.$bln.'/'.$thn;
  return $tanggal;
}


function format_hari($waktu){
    
   $hari =  date('D', strtotime($waktu));
    
    
    switch($hari){
    case 'Sun':
      $hari_ini = "Minggu";
    break;
 
    case 'Mon':     
      $hari_ini = "Senin";
    break;
 
    case 'Tue':
      $hari_ini = "Selasa";
    break;
 
    case 'Wed':
      $hari_ini = "Rabu";
    break;
 
    case 'Thu':
      $hari_ini = "Kamis";
    break;
 
    case 'Fri':
      $hari_ini = "Jumat";
    break;
 
    case 'Sat':
      $hari_ini = "Sabtu";
    break;
    
    default:
      $hari_ini = "Tidak di ketahui";   
    break;
  }
  
  return $hari_ini;
}

function umur($tanggal){
   $tanggal_lahir = new DateTime($tanggal);
    $sekarang = new DateTime("today");
    if ($tanggal_lahir > $sekarang) { 
    $thn = "0";
    $bln = "0";
    $tgl = "0";
    }
    $thn = $sekarang->diff($tanggal_lahir)->y;
    $bln = $sekarang->diff($tanggal_lahir)->m;
    $tgl = $sekarang->diff($tanggal_lahir)->d;
    return $thn." Tahun ";
}
?>

<!DOCTYPE html>
<html>
<head>
	<base href="">
	<meta charset="utf-8" />
	<title><?php echo $comp[0]->nama ?></title>
	<meta name="description" content="<?php echo $comp[0]->nama ?>">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- area css -->
    <link href="<?php echo site_url() ?>assets/css/pagePreloaders.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/selectize.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/app.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/chart.css" rel="stylesheet" type="text/css" />  
    <link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css"/>
        
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    

      <script type="text/javascript" src="<?php echo site_url() ?>assets/js/jquery.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/dataTables.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/notify.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/pagePreloaders.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/popper.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/selectize.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/bootstrap-datepicker.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/moment.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/chart.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/app.js"></script>
     
 <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

         
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
     
    <!-- <link rel="manifest" href="<?php echo site_url() ?>manifest.json"> -->

    <!-- area icon -->

  <link rel="shortcut icon" href="<?php echo site_url() ?><?php echo $comp[0]->foto ?>" />
</head>

<div id="loader">
 <div class="lds-ripple"><div></div><div></div></div>
 
</div>

<div id="flash-message-error">
  test
</div>
<div id="flash-message-success">
  test
</div>

<style>

#loader{
  display: none;
  position: absolute;
  justify-content: center;
  align-items: center;
  align-content: center;
  z-index: 99;
  width: 100%;
  height: 100%;
  padding-left: 46%;
  padding-top: 20%;
  background-color:white;
  opacity: 0.9;
}

/*loader automatic*/
.lds-ripple,
.lds-ripple div {
  box-sizing: border-box;
}
.lds-ripple {
  display: inline-block;
  position: relative;
  width: 300px;
  height: 300px;
}
.lds-ripple div {
  position: absolute;
  border:7px solid <?php echo $comp[0]->warna_utama ?>;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 8px;
    height: 8px;
    opacity: 0;
  }
  4.9% {
    top: 36px;
    left: 36px;
    width: 8px;
    height: 8px;
    opacity: 0;
  }
  5% {
    top: 36px;
    left: 36px;
    width: 8px;
    height: 8px;
    opacity: 1;
  }
  100% {
    top: 0;
    left: 0;
    width: 80px;
    height: 80px;
    opacity: 0;
  }
}

@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;800&family=Poppins:wght@300;400;600&display=swap');
  a,h1,h6,i,p,span{
     font-family: 'Poppins', sans-serif;
 }
 .form-eza:focus {
      outline: none; 
  	 color: #000;
     border-bottom:1px solid #D01818;
     
     
 }
 

 
.form-eza {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border-bottom: 1px solid #ced4da;
    border-top: 0px;
    border-left: 0px;
    border-right: 0px;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}


 .bg-utama{
        background-color:<?php echo $comp[0]->warna_utama ?>;
        color:#FFF;
        border-radius:0px;
        
    }
    
    .text-utama{
        color:<?php echo $comp[0]->warna_utama ?>;
    }
    .bg-utama:hover{
       box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
       color:#FFF;
    }


    .btn-utama{
  background-color:<?php echo $comp[0]->warna_utama ?>;
  color:#FFF;
  order: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.btn-utama:hover{
  
  color:#FFF;
  }
    
  .bg-kedua{
        background-color:<?php echo $comp[0]->warna_kedua ?>;
        color:#FFF;
        border-radius:0px;
 
    }
    
    .text-kedua{
        color:<?php echo $comp[0]->warna_kedua ?>;
    }
    .bg-kedua:hover{
       box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }


    .btn-kedua{
  background-color:<?php echo $comp[0]->warna_kedua ?>;
  color:#FFF;
  order: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.btn-ketiga:hover{
  
  color:#FFF;
  }
    

     .btn-ketiga{
  background-color:<?php echo $comp[0]->warna_ketiga ?>;
  color:#FFF;
  order: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.btn-ketiga:hover{
  
  color:#FFF;
  }
    
    
    
    .bg-ketiga{
        background-color:<?php echo $comp[0]->warna_ketiga ?>;
        color:#FFF;
        border-radius:0px;
 
    }
    
    .text-ketiga{
        color:<?php echo $comp[0]->warna_ketiga ?>;
    }
    .bg-ketiga:hover{
        color:white;
       box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }
    
    

    
    .nav-item{
        padding-left:0%;
        /*border:1px solid black;*/
        margin-bottom:0%;
        border-radius:2px;
        font-size:normal;
    }

 .nav-item{
      border-bottom: 2px solid transparent;
    }

    p{
      font-family: 'PT Sans', sans-serif;
    }

    
</style> 


<?php

error_reporting(0);
    if(isset($_SESSION['username'])){

 
 $nav = explode("/", $_SERVER['REQUEST_URI']);

$menu = $nav[1];
$menu2 = $nav[2];



?>

<body style="font-family: 'PT Sans', sans-serif;">



 <!-- if DEVICE -->

  <?php if(isDevice()){ ?>

    <style type="text/css">
      .navbar-light .navbar-nav .nav-link {
        font-family: 'PT Sans', sans-serif;
        color: white;
      }

       .navbar-light .navbar-nav .nav-link:hover {
        color: white;
      }

      .navbar-toggler:focus{
        outline: 0px;
      }
    </style>

     <nav class="navbar navbar-expand-lg navbar-light" style="padding: 1rem 0.5rem;border-bottom:0px solid <?php echo $comp[0]->warna_utama ?>;background-image: linear-gradient(<?php echo $comp[0]->warna_utama ?>, <?php echo $comp[0]->warna_kedua ?>);">
  <a class="navbar-brand" href="<?php echo site_url() ?>">
   <span style="font-family: 'PT Sans', sans-serif;font-size: normal;color: white;font-weight: normal;"><img style="filter: grayscale(0) contrast(0) brightness(100);" height="40" src="<?php echo site_url().$comp[0]->foto ?>" /></span>
  </a>
  <button class="navbar-toggler" style="padding:0px;border: 0px" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="flaticon-menu-2" style="color: white;font-size: 22pt "></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav" style="padding-top:10px">
    <ul class="navbar-nav">
      

        <?php if($_SESSION['level']=='Admin'){?>

 <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url() ?>"><i class="flaticon-dashboard"></i> Dashboard</a><li>


                

              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('pengguna') ?>"><i class="flaticon-users"></i> Pengguna</a>
              </li>

 <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('slider') ?>"><i class="flaticon-web"></i> Slider Informasi</a>
              </li>
   <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('destinasi') ?>"><i class="flaticon-list"></i> Destinasi Wisata</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('umkm') ?>"><i class="flaticon-list"></i> Oleh-Oleh UMKM</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('kuliner') ?>"><i class="flaticon-list"></i> Rekomendasi Kuliner</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('sewa') ?>"><i class="flaticon-list"></i> Sewa Transport & Penginapan</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('panduan') ?>"><i class="flaticon-list"></i> Info Panduan Wisata</a>
              </li>

      

        

 
          
       <?php } ?>
   
      
      
   

 
    
    </ul>
    <ul class="navbar-nav ml-auto">

                  <li class="nav-item dropdown" >
                    <a class="nav-link dropdown-toggle" style="color:white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong><?php echo $_SESSION['level']=='User'?'Pengguna':'Admin' ?></strong></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if($_SESSION['level']=='Admin'){?>
                        <a class="dropdown-item" href="<?php echo site_url('company') ?>"><i class="flaticon-settings-1"></i> Pengaturan</a>
                        <a class="dropdown-item" href="<?php echo site_url('admin') ?>"><i class="flaticon-user-settings"></i> User Admin</a>
                      <?php } ?>
                      <a class="dropdown-item" href="<?php echo site_url('login/logout') ?>"><i class="flaticon-logout"></i> Logout</a>
                    </div>
                  </li>
                </ul>
  </div>
</nav>

  <?php } ?>
  <!-- end MOBILE -->


<!-- IF DESKTOP -->
<?php if(!isDevice()){ ?>

   <style type="text/css">
     .navbar-nav .nav-link {
        font-family: 'PT Sans', sans-serif;
        color: white;
      }

      .navbar-nav .nav-item {
        margin-bottom: 15px
      }

     .navbar-nav .nav-link:hover {
        color: white;
      }

      .navbar-toggler:focus{
        outline: 0px;
      }
    </style>



<div class="container-fluid">
    <div class="row">



        <?php if($_SESSION['level']=='Admin'){?>

          <div  class="SIDEMENU col-sm-2" style="padding:20px;box-shadow: rgba(0, 0, 0, 0.35) 10px 0 10px -10px; background-image: linear-gradient(<?php echo $comp[0]->warna_utama ?>, <?php echo $comp[0]->warna_kedua ?>);">

             <center>
              <img style="filter: grayscale(0)contrast(0) brightness(100);margin-bottom: 20%;" height="100" src="<?php echo site_url().$comp[0]->foto ?>" />
          
              </center>
          
            <ul class="navbar-nav">
         <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url() ?>"><i class="flaticon-dashboard"></i> Dashboard</a><li>                

              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('pengguna') ?>"><i class="flaticon-users"></i> Pengguna</a>
              </li>

 <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('slider') ?>"><i class="flaticon-web"></i> Slider Informasi</a>
              </li>
   <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('destinasi') ?>"><i class="flaticon-map-location"></i> Destinasi Wisata</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('umkm') ?>"><i class="flaticon-interface-9"></i> Oleh-Oleh UMKM</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('kuliner') ?>"><i class="flaticon-pie-chart"></i> Rekomendasi Kuliner</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('sewa') ?>"><i class="flaticon-list"></i> Sewa Transport & Penginapan</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('panduan') ?>"><i class="flaticon-notes"></i> Info Panduan Wisata</a>
              </li>


          
            </ul>
        </div>

        <?php } ?>










        <div class="SIDEMENU col-sm-10 bg-white" style="padding: 0px">
          <div style="margin:0px;border-bottom:0px solid <?php echo $comp[0]->warna_utama ?>;background-image: linear-gradient(to right,<?php echo $comp[0]->warna_utama ?>, <?php echo $comp[0]->warna_kedua ?>);">
            <nav class="navbar navbar-expand-lg navbar-light" >
                <a class="navbar-brand" href="<?php echo site_url() ?>">
                 <span style="font-family: 'PT Sans', sans-serif;font-size: xx-large;color: white;font-weight: normal;"><?php echo $comp[0]->deskripsi ?></span>
                </a>
                <button class="navbar-toggler" style="padding:0px;border: 0px" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="flaticon-menu-2" style="color: white;font-size: 22pt "></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav" style="padding-top:10px">
                 
                  <ul class="navbar-nav ml-auto">

                  <li class="nav-item dropdown" >
                    <a class="nav-link dropdown-toggle" style="color:white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $_SESSION['level']=='User'?'Pengguna':'Admin' ?></strong></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <?php if($_SESSION['level']=='Admin'){?>
                        <a class="dropdown-item" href="<?php echo site_url('company') ?>"><i class="flaticon-settings-1"></i> Pengaturan</a>
                        <a class="dropdown-item" href="<?php echo site_url('admin') ?>"><i class="flaticon-user-settings"></i> User Admin</a>
                      <?php } ?>
                      <a class="dropdown-item" href="<?php echo site_url('login/logout') ?>"><i class="flaticon-logout"></i> Logout</a>
                    </div>
                  </li>
                </ul>
                </div>
              </nav>
          </div>

 <?php } ?>
 <!-- END DEKTOP -->

<?php
  }


  
 
?>
