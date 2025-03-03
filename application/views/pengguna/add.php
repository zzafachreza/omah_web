
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url($modul) ?>"><?php echo ucfirst($judul) ?></a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
</nav>
<div class="container-fluid">
 <form action="<?php echo site_url($modul.'/insert') ?>" method="POST" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
          <a href="<?php echo site_url($modul) ?>"class="btn btn-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>

          <button  class="btn btn-utama" id="simpan" type="SUBMIT"><i class="flaticon2-files-and-folders"></i> Simpan</button>



        </div>
        <div class="card-body">

             <?php
                    
date_default_timezone_set('Asia/Jakarta');
                    
                    foreach($this->db->query("SHOW FULL COLUMNS from `data_$modul` WHERE FIELD !='id_$modul'")->result() as $col):
                    ?>
                    
                    <?php 
                    
                        if($col->Type=="varchar(222)"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                         Jenis Kelamin
                         </label>
                       <select  name="<?php echo $col->Field ?>" class="form-control selectza">
                       
            
            
                          <option>Laki-laki</option>
                          <option>Perempuan</option>
            


                         
                       </select>
                     </div>
                      
                      <?php 
                        }else if($col->Field=="tipe"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                         Tipe
                         </label>
                       <select  name="<?php echo $col->Field ?>" class="form-control selectza">
                       
            
            
                          <option>Gain</option>
                          <option>Loss</option>


                         
                       </select>
                     </div>
                      
                      <?php 
                        }else if($col->Field=="status_kesehatan"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                         Status Kesehatan
                         </label>
                       <select  name="<?php echo $col->Field ?>" class="form-control selectza">
                       
            
            
                          <option>Fit</option>
                          <option>Unfit</option>
                          <option>Observ</option>
            


                         
                       </select>
                     </div>
                      
                      <?php 
                        }elseif($col->Field=="fbh"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                         FBH PASS
                         </label><br/>
                        <label style="margin-right: 10px;font-weight: bold">
                          <input type="radio" name="<?php echo $col->Field ?>" value="FBH PASS">
                          FBH PASS
                        </label>
                          <label style="margin-right: 10px;font-weight: bold">
                          <input type="radio" name="<?php echo $col->Field ?>" value="NON FBH PASS">
                          NON FBH PASS
                        </label>
                     </div>
                      
                      <?php 
                        }elseif(substr($col->Field, 0,4) =="fid_"){

                                $tabel_nama = explode("_", $col->Field)[1];   
                                $tabel = 'data_'.$tabel_nama;

                            ?>
                            
                          <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                       <?php echo ucfirst($col->Comment) ?> 
                         </label>
                       <select required  name="<?php echo $col->Field ?>" class="form-control selectza">
                          <option></option>
                        <?php  foreach ($this->db->query("SELECT * FROM $tabel")->result() as $tt) { ?>




                            <option value="<?php echo $tt->{'id_'.$tabel_nama} ?>" >

                              <?php

                                if ($tabel_nama=='pengguna') {
                                  
                                  echo $tt->nama_lengkap.' / '.$tt->username;
                                }else  if ($tabel_nama=='jenispekerjaan') {
                                  
                                  echo $tt->nama_jenispekerjaan;
                                }



                                   ?>
                                


                              </option>

                        <?php } ?>
                           
                         
                       </select>
                     </div>
                    
                      
                      <?php 
                        }elseif($col->Field=="foto_$modul"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                            <?php echo ucfirst(str_replace("_"," ",str_replace("asset","provider",$col->Comment))) ?> 
                         </label>
                        <input type="file" name="foto_<?php echo $modul ?>" class="form-control" />
                     </div>
                      
                      <?php 
                        }elseif($col->Type=="varchar(444)"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                            <?php echo ucfirst(str_replace("_"," ",str_replace("asset","provider",$col->Comment))) ?> 
                         </label>
                        <input type="file" name="<?php echo $col->Field ?>" class="form-control" />
                     </div>
                      
                      <?php 
                        }elseif($col->Type=="float"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                            <?php echo ucfirst($col->Comment); ?>
                         </label>
                        <input autocomplete="off" type="text" name="<?php echo $col->Field ?>" class="form-eza uang" id="<?php echo $col->Field ?>" />
                     </div>
                      
                      <?php 
                        }elseif($col->Type=='date'){
                            ?>
                            
                             <div class="form-group col col-sm-6">
                        <label for="<?php echo $col->Field ?>" class="AppLabel">
                           <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> 
                         </label>
                       
                        <input autocomplete="off" type="date" name="<?php echo $col->Field ?>" value="<?php echo date('Y-m-d') ?>" class="form-eza" id="<?php echo $col->Field ?>">
                      </div>
                      
                      <?php 
                        }elseif($col->Type=='time'){
                            ?>
                            
                             <div class="form-group col col-sm-6">
                        <label for="<?php echo $col->Field ?>" class="AppLabel">
                           <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> 
                         </label>
                       
                        <input autocomplete="off" type="time" name="<?php echo $col->Field ?>" value="<?php echo date('H:i:s') ?>" class="form-eza" id="<?php echo $col->Field ?>">
                      </div>
                      
                      <?php 
                        }elseif($col->Type=='longtext'){
                            ?>
                            
                             <div class="form-group col col-sm-6">
                        <label for="<?php echo $col->Field ?>" class="AppLabel">
                           <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> 
                         </label>
                       
                        <textarea name="<?php echo $col->Field ?>" class="summernote"></textarea>
                      </div>
                      
                      <?php 
                        }else{
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label for="nama_kecamatan" class="AppLabel">
                           <?php echo ucfirst(str_replace("_"," ",str_replace("asset","provider",$col->Comment))) ?> 
                         </label>
                       
                        <input autocomplete="off" type="<?php echo $col->Type=='date'?'date':'' ?>" name="<?php echo $col->Field ?>" class="form-eza <?php echo $col->Field=='harga_'.$modul?'uang':'' ?>" id="<?php echo $col->Field ?>" autofocus="autofocus">
                      </div>
                            
                            <?php
                        }
                    ?>
                
                    
                      
                    
                    <?php
                    
                    endforeach;
                    ?>
                


        </div>

    </div>
  </div>
</form>






