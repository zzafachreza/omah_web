
<?php
$id = $this->uri->segment(3);
$id_detail = $this->uri->segment(4);
$data = $this->db->query("SELECT * FROM data_".$modul."detail WHERE id_".$modul."detail='$id_detail'")->row_object();

?>
<nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url($modul.'/detail/'.$id) ?>"><?php echo ucfirst($modul) ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
</nav>
<div class="container-fluid">

    <div class="card">
      <div class="card-header">
            
      <form action="<?php echo site_url($modul.'/update_detail') ?>" method="POST" enctype="multipart/form-data" >

    <a href="<?php echo site_url($modul.'/detail/'.$id) ?>" class="btn bg-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
    <button class="btn bg-utama" type="SUBMIT"><i class="flaticon2-files-and-folders"></i> Simpan</button>
      </div>
        <div class="card-body">
            <form>
    
                <input name="id_<?php echo $modul ?>" type="hidden" value="<?php echo $id ?>" />
                <input name="id_<?php echo $modul ?>detail" type="hidden" value="<?php echo $id_detail ?>" />
    
              
              
              
                <?php
                    

                    
                    foreach($this->db->query("SHOW FULL COLUMNS from `data_".$modul."detail` WHERE FIELD !='".$modul."detail'")->result() as $col){
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
                       <select disabled name="<?php echo $col->Field ?>" class="form-control selectza">
                          <option></option>
                        <?php  foreach ($this->db->query("SELECT * FROM $tabel")->result() as $tt) { ?>




                            <option <?php echo $tt->{'id_'.$tabel_nama}==$data->{$col->Field}?'selected':'' ?> value="<?php echo $tt->{'id_'.$tabel_nama} ?>" >

                              <?php echo $tt->nama_bahan ?>
                                


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
                        }elseif($col->Field=="id_".$modul."detail"){
                            ?>
                            
        
                        <input type="hidden" name="<?php echo $col->Field ?>" class="form-control" value="<?php echo $data->{$col->Field} ?>" />
            
                        
                      
                      <?php 
                        }elseif($col->Field=="nomor_pesanan"){
                            ?>
                            
        
                         <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                            <?php echo ucfirst($col->Comment); ?>
                         </label>
                        <input disabled type="text" name="<?php echo $col->Field ?>" value="<?php echo $data->{$col->Field} ?>" class="form-control" id="<?php echo $col->Field ?>" />
                     </div>
                        
                      
                      <?php 
                        }else if($col->Field=="status"){
                            ?>
                            
                            <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                          Status
                         </label>


                       <select  name="<?php echo $col->Field ?>" class="form-control selectza">

                        <option <?php echo $data->{$col->Field}=='Proses Desain'?'selected':'' ?>>Proses Desain</option>
                        <option <?php echo $data->{$col->Field}=='ACC Desain'?'selected':'' ?>>ACC Desain</option>
                        <option <?php echo $data->{$col->Field}=='Print'?'selected':'' ?>>Print</option>
                        <option <?php echo $data->{$col->Field}=='Pengiriman'?'selected':'' ?>>Pengiriman</option>
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



