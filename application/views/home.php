 <?php
$sqlCom = "SELECT * FROM data_company limit 1";
$hasilCom = $this->db->query($sqlCom);

$comp = $hasilCom->row_object();

$jumlah = $this->db->query("SELECT (SELECT COUNT(*) FROM data_pengguna) AS pengguna,
  (SELECT COUNT(*) FROM data_destinasi) AS a,
  (SELECT COUNT(*) FROM data_umkm) AS b,
  (SELECT COUNT(*) FROM data_kuliner) AS c,
  (SELECT COUNT(*) FROM data_sewa) AS d,
  (SELECT COUNT(*) FROM data_panduan) AS e

  ")->row_object();


                    
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
            <div class="col-md-4" style="margin-bottom:2%">
                <div class="card">
                    <div class="card-body">
                        <table><tr><td>
                                    <h5 class="card-title">Destinasi Wisata</h5>
                                    <p class="card-text" style="font-size: 30px;font-weight: bold;"><?php echo $jumlah->a ?></p>
                                </td><td width="30%"> 
                                    <img src="<?php echo site_url('assets/images/icon_menu1.png') ?>" class="card-img-top" alt="Image 1">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom:2%">
                <div class="card">
                    <div class="card-body">
                        <table><tr><td>
                                    <h5 class="card-title">Oleh-Oleh UMKM</h5>
                                    <p class="card-text" style="font-size: 30px;font-weight: bold;"><?php echo $jumlah->b ?></p>
                                </td><td width="30%"> 
                                    <img src="<?php echo site_url('assets/images/icon_menu2.png') ?>" class="card-img-top" alt="Image 1">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom:2%">
                <div class="card">
                    <div class="card-body">
                        <table><tr><td>
                                    <h5 class="card-title">Rekomendasi Kuliner</h5>
                                    <p class="card-text" style="font-size: 30px;font-weight: bold;"><?php echo $jumlah->c ?></p>
                                </td><td width="30%"> 
                                    <img src="<?php echo site_url('assets/images/icon_menu3.png') ?>" class="card-img-top" alt="Image 1">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="margin-bottom:2%">
                <div class="card">
                    <div class="card-body">
                        <table><tr><td>
                                    <h5 class="card-title">Sewa Transport & Penginapan</h5>
                                    <p class="card-text" style="font-size: 30px;font-weight: bold;"><?php echo $jumlah->d ?></p>
                                </td><td width="12%"> 
                                    <img src="<?php echo site_url('assets/images/icon_menu4.png') ?>" class="card-img-top" alt="Image 1">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4" style="margin-bottom:2%">
                <div class="card">
                    <div class="card-body">
                        <table><tr><td>
                                    <h5 class="card-title">Info Panduan Wisata</h5>
                                    <p class="card-text" style="font-size: 30px;font-weight: bold;"><?php echo $jumlah->e ?></p>
                                </td><td width="30%"> 
                                    <img src="<?php echo site_url('assets/images/icon_menu6.png') ?>" class="card-img-top" alt="Image 1">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>



           
        </div>
</div>

