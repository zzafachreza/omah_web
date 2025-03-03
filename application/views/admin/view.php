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
    
  </div>
        <div class="card-body">

              
                <?php
                    

                    
                    foreach($this->db->query("SHOW FULL COLUMNS from `data_$modul` WHERE FIELD NOT IN('id_$modul','password')")->result() as $col){
                    ?>
            
            
        <?php 
                    
                    if($col->Field=="file_$modul" || $col->Field=='roadmap'){
                            ?>
                            
        
                             <div class="form-group col col-sm-6">
                              <label><strong><?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> </strong></label>
                              <div>
                                       <a href="<?php echo site_url().$data->{$col->Field} ?>"><img src="<?php echo site_url().$data->{$col->Field} ?>" width="200" /></a>
                              </div>
                             </div>
                      
                      <?php 
                        }elseif($col->Type=="float"){
                            ?>
                            
        
                             <div class="form-group col col-sm-6">
                              <label><strong><?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> </strong></label>
                              <div>
                                    <p><?php echo number_format($data->{$col->Field}) ?></p>
                              </div>
                             </div>
                      
                      <?php 
                        }elseif(substr($col->Field, 0,4) =="fid_"){

                                $tabel_nama = explode("_", $col->Field)[1];   
                                $tabel = 'data_'.$tabel_nama;

                            ?>
                            
                          <div class="form-group col col-sm-6">
                        <label class="AppLabel">
                          <strong>      <?php echo ucfirst($col->Comment) ?> </strong>
                         </label>
                        <p>   <?php

                                if ($tabel_nama=='pengguna') {
                                  
                                  echo $data->nama_lengkap.' / '.$data->username;
                                }else  if ($tabel_nama=='kategori') {
                                  
                                  echo $data->nama_kategori;
                                }





                                   ?></p>
                     </div>
                    
                      
                      <?php 
                        }else{
                            ?>
                            
                            <div class="form-group col col-sm-6">
                                <label><strong> <?php echo ucfirst(str_replace("_"," ",$col->Comment)) ?> </strong></label>
                               <p><?php echo $data->{$col->Field} ?></p>
                             </div>
                            
                            <?php
                        }
                    ?>
                    
                    
            
                    
                    
                    <?php } ?>
<hr />



</div>
    
          </div>
          <div class="card-footer">

          </div>
    
    </div>


</div>



