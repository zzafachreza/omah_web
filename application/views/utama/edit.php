
<?php

$data = $this->db->query("SELECT * FROM data_$modul WHERE id_$modul='$id'")->row_object();

?>
<nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url($modul) ?>"><?php echo ucfirst($modul) ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
</nav>
<div class="container-fluid">

    <div class="card">
      <div class="card-header">
            
      <form action="<?php echo site_url($modul.'/update') ?>" method="POST" enctype="multipart/form-data" >

    <a href="<?php echo site_url($modul) ?>" class="btn bg-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
    <button class="btn bg-utama" type="SUBMIT"><i class="flaticon2-files-and-folders"></i> Simpan</button>
      </div>
        <div class="card-body">
            <form>
    
                <input name="id_<?php echo $modul ?>" type="hidden" value="<?php echo $id ?>" />
    
              
              
              
                <?php
                    

                    
                    foreach($this->db->query("SHOW FULL COLUMNS from `data_$modul` WHERE FIELD !='id_$modul'")->result() as $col){
                    ?>
            
            
        <?php 
                    
                    if($col->Field=="file_$modul"){
                            ?>
                            
        
                        <input type="hidden" name="file_<?php echo $modul ?>_old" class="form-control" value="<?php echo $data->{$col->Field} ?>" />
            
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                    <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> 
                         </label>
                        <input type="file" name="file_<?php echo $modul ?>" class="form-control" />
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
                       <select  name="<?php echo $col->Field ?>" class="form-control selectza">
                          <option></option>
                        <?php  foreach ($this->db->query("SELECT * FROM $tabel")->result() as $tt) { ?>




                            <option <?php echo $tt->{'id_'.$tabel_nama}==$data->{$col->Field}?'selected':'' ?> value="<?php echo $tt->{'id_'.$tabel_nama} ?>" >

                              <?php

                                if ($tabel_nama=='pengguna') {
                                  
                                  echo $tt->nama_lengkap.' / '.$tt->username;
                                }else  if ($tabel_nama=='kamar') {
                                  
                                  echo $tt->nama_kamar.'/'.$tt->nomor_kamar;
                                }
else  if ($tabel_nama=='bahanhijab') {
                                  
                                  echo $tt->nama_bahan.' - '.$tt->size;
                                }else  if ($tabel_nama=='kategori') {
                                  
                                  echo $tt->nama_kategori;
                                }





                                   ?>
                                


                              </option>

                        <?php } ?>
                           
                         
                       </select>
                     </div>
                    
                      
                      <?php 
                        }elseif($col->Type=="float"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                            <?php echo ucfirst($col->Comment); ?>
                         </label>
                        <input autocomplete="off" type="text" name="<?php echo $col->Field ?>" value="<?php echo $data->{$col->Field} ?>" class="form-eza uang" id="<?php echo $col->Field ?>" />
                     </div>
                      
                      <?php 
                        }elseif($col->Field=="roadmap"){
                            ?>
                            
        
                        <input type="hidden" name="roadmap_old" class="form-control" value="<?php echo $data->{$col->Field} ?>" />
            
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                    <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> 
                         </label>
                        <input type="file" name="roadmap" class="form-control" />
                     </div>
                      
                      <?php 
                        }else if($col->Field=="jenis_kelamin"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                          Status
                         </label>


                       <select  name="<?php echo $col->Field ?>" class="form-control selectza">

                      
                        <option <?php echo $data->{$col->Field}=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
                        <option <?php echo $data->{$col->Field}=='Selesai'?'selected':'' ?>>Selesai</option>


                     
                         
                       </select>
                     </div>
                      
                      <?php 
                        }elseif($col->Type=='date'){
                            ?>
                            
                             <div class="form-group col col-sm-6">
                        <label for="<?php echo $col->Field ?>" class="AppLabel">
                           <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> 
                         </label>
                       
                        <input autocomplete="off" type="date" name="<?php echo $col->Field ?>" value="<?php echo $data->{$col->Field} ?>" class="form-eza" id="<?php echo $col->Field ?>">
                      </div>
                      
                      <?php 
                        }elseif($col->Type=='time'){
                            ?>
                            
                             <div class="form-group col col-sm-6">
                        <label for="<?php echo $col->Field ?>" class="AppLabel">
                           <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> 
                         </label>
                       
                        <input autocomplete="off" type="time" name="<?php echo $col->Field ?>" value="<?php echo $data->{$col->Field} ?>" class="form-eza" id="<?php echo $col->Field ?>">
                      </div>
                      
                      <?php 
                        }elseif($col->Type=='longtext'){
                            ?>
                            
                             <div class="form-group col col-sm-6">
                        <label for="<?php echo $col->Field ?>" class="AppLabel">
                           <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> 
                         </label>
                       <textarea class="summernote" name="<?php echo $col->Field ?>"><?php echo $data->{$col->Field} ?></textarea>
                      </div>
                      
                      <?php 
                        }else{
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                            <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> 
                         </label>
                       
                        <input autocomplete="off" value="<?php echo $data->{$col->Field} ?>" type="<?php echo $col->Type=='date'?'date':'text' ?>" name="<?php echo $col->Field ?>" class="form-eza <?php echo $col->Field=='harga_'.$modul?'uang':'' ?>" id="<?php echo $col->Field ?>" autofocus="autofocus">
                      </div>
                            
                            <?php
                        }
                    ?>
                    
                    
            
                    
                    
                    <?php } ?>


             
            </form>
          </div>
          <div class="card-footer">

          </div>
      </form>
    </div>


</div>



