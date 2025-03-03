 <?php
$sqlCom = "SELECT * FROM data_company limit 1";
$hasilCom = $this->db->query($sqlCom);

$comp = $hasilCom->row_object();

$jumlah = $this->db->query("SELECT (SELECT COUNT(*) FROM data_pengguna) AS pengguna,
  (SELECT COUNT(*) FROM data_pengguna) AS sewa,
  (SELECT COUNT(*) FROM data_pengguna) AS kendaraan;")->row_object();


                    
?>

<style>
   .box{
     
       padding-top:10px;
       padding-bottom:10px;
       /*height:200px;*/
   }
   .box-detail{
       
       position:relative;
       padding:12px;
        border-radius:10px;
       height:180px;
       box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
   }
   
   .box-title{
      
       font-size:25px;
       font-weight:500;
       line-height:36px;
   }
   
    .box-count{
       font-size:50px;
       font-weight:bold;
       line-height:40px;
   }
</style>

<div class="container" style="padding-top: 2%">
    
    <div class="row">
        <div class="col-sm-4 box">
            
            <div class="box-detail">
                
                <div class="row align-items-center" style="height:100%">
                    <div class="col-sm-7">
                        <p class="box-title">Data Pengguna</p>
                        <p class="box-count"><?php echo $jumlah->pengguna ?></p>
                    </div>
                    <div class="col-sm-5">
                         <center>
                             <img  src="<?php echo site_url('assets/images/user.png') ?>" width="75%" />
                         </center>
                    </div>
                </div>
               
            </div>
            
        </div>
         <div class="col-sm-4 box">
             <div class="box-detail">
                <div class="row align-items-center" style="height:100%">
                    <div class="col-sm-7 ">
                        <p class="box-title">Data Biaya Sewa</p>
                        <p class="box-count"><?php echo $jumlah->kendaraan ?></p>
                    </div>
                    <div class="col-sm-5">
                         <center>
                             <img  src="<?php echo site_url('assets/images/kendaraan.png') ?>" width="75%" />
                         </center>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-sm-4 box">
             <div class="box-detail">
                <div class="row align-items-center" style="height:100%">
                    <div class="col-sm-7 ">
                        <p class="box-title">Data Sewa</p>
                        <p class="box-count"><?php echo $jumlah->sewa ?></p>
                    </div>
                    <div class="col-sm-5">
                         <center>
                             <img  src="<?php echo site_url('assets/images/sewa.png') ?>" width="75%" />
                         </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

