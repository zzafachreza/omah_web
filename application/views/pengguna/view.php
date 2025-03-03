<?php
$id = $this->uri->segment(3);
$data = $this->db->query("SELECT * FROM data_$modul WHERE id_$modul='$id'")->row_object();

?>
<nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url($modul) ?>"><?php echo ucfirst($judul) ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
      </ol>
</nav>
<div class="container-fluid">

    <div class="card">
      <div class="card-header">
            
    
    <a href="<?php echo site_url($modul) ?>" class="btn btn-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
    <a href="<?php echo site_url($modul.'/edit/'.$id) ?>" class="btn btn-utama"><i class="flaticon2-edit"></i> Edit</a>
    
  </div>
        <div class="card-body">

              
           <div class="row">
             <div class="col-sm-8">
                <table class="table table-bordered">
                  <tr style="background-color: #295882">
                    <th colspan="2" style="color:white">Identitas Diri</th>
                  </tr>
                   <?php
                    

                    
                    foreach($this->db->query("SHOW FULL COLUMNS from `data_$modul` WHERE FIELD NOT IN('id_$modul','password','file_pengguna')")->result() as $col){
                    
                    ?>
            
            
    
                  <tr>
                     <td width="40%"><?php echo $col->Comment ?></td>
                      <td><?php

                        if($col->Field=='fid_jenispekerjaan'){
                           echo $data->nama_jenispekerjaan;
                        }elseif($col->Type=='date'){
                           echo Indonesia3Tgl($data->{$col->Field});
                        }elseif($col->Type=='float'){
                           echo number_format($data->{$col->Field});
                        }else{
                          echo $data->{$col->Field};
                        }

                     ?></td>
                  </tr>

                   <?php }  ?>
                </table>



               
             </div>
             <div class="col-sm-4">
               <img src="<?php echo site_url().$data->{'file_'.$modul} ?>" width="100%" height="auto" style="border-radius: 20px;box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;" />


               
             </div>



           </div>



        </div>
    
          </div>
          <div class="card-footer">

          </div>
    
    </div>


</div>



