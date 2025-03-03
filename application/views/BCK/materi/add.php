<div class="container-fluid">


	  <form action="<?php echo site_url($modul.'/insert') ?>" method="POST" enctype="multipart/form-data">

    <div class="row" style="margin-top:2%;margin-bottom:2%">
        <div class="col col-sm-6">
            	<a href="<?php echo site_url($modul) ?>" class="btn bg-white col col-sm-12"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
  
        </div>
        <div class="col col-sm-6">
            	<button class="btn bg-utama col col-sm-12" id="simpan" type="SUBMIT"><i class="flaticon2-files-and-folders"></i> Simpan</button>
        </div>
    </div>
	
	  		<form>
	  		    
	  		    
	  		   <?php
    	  			
date_default_timezone_set('Asia/Jakarta');
    	  			
    	  			foreach($this->db->query("SHOW COLUMNS from `data_$modul` WHERE FIELD !='id_$modul'")->result() as $col):
    	  			?>
    	  			
    	  			<?php 
    	  			
    	  			    if($col->Field=="fid_menu"){
    	  			        ?>
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    <label class="AppLabel">
        			      Menu
        			     </label>
        			   <select  name="<?php echo $col->Field ?>" class="form-control selectza">
        			       <?php 
        			       foreach($this->db->query("SELECT * FROM data_menu")->result() as $r){
        			       ?>
        			        <option value="<?php echo $r->id_menu ?>"><?php echo $r->judul ?></option>
        			       
        			       <?php
        			       
    	  			    }
        			       ?>
        			   </select>
        		     </div>
        			  
        			  <?php 
    	  			    }elseif($col->Field=="tipe"){
    	  			        ?>
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    <label class="AppLabel">
        			      Tipe File
        			     </label>
        			   <select  name="<?php echo $col->Field ?>" class="form-control selectza">
        			      
        			        <option value="PDF">PDF</option>
        			        <option value="VIDEO">VIDEO</option>
        			       
        			     
        			   </select>
        		     </div>
        			  
        			  <?php 
    	  			    }elseif($col->Field=="foto_$modul"){
    	  			        ?>
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    <label class="AppLabel">
        			        <?php echo ucfirst(str_replace("_"," ",str_replace("asset","provider",$col->Field))) ?> 
        			     </label>
        			    <input type="file" name="foto_<?php echo $modul ?>" class="form-control" />
        		     </div>
        			  
        			  <?php 
    	  			    }elseif($col->Field=="file_$modul"){
    	  			        ?>
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    <label class="AppLabel">
        			        <?php echo ucfirst(str_replace("_"," ",str_replace("asset","provider",$col->Field))) ?> 
        			     </label>
        			    <input type="file" name="file_<?php echo $modul ?>" class="form-control" />
        		     </div>
        			  
        			  <?php 
    	  			    }elseif($col->Type=='date'){
    	  			        ?>
    	  			        
    	  			         <div class="form-group col col-sm-6">
        			    <label for="<?php echo $col->Field ?>" class="AppLabel">
        			       <?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> 
        			     </label>
        			   
        			    <input autocomplete="off" type="date" name="<?php echo $col->Field ?>" value="<?php echo date('Y-m-d') ?>" class="form-eza" id="<?php echo $col->Field ?>">
        			  </div>
        			  
        			  <?php 
    	  			    }elseif($col->Type=='time'){
    	  			        ?>
    	  			        
    	  			         <div class="form-group col col-sm-6">
        			    <label for="<?php echo $col->Field ?>" class="AppLabel">
        			       <?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> 
        			     </label>
        			   
        			    <input autocomplete="off" type="time" name="<?php echo $col->Field ?>" value="<?php echo date('H:i:s') ?>" class="form-eza" id="<?php echo $col->Field ?>">
        			  </div>
        			  
        			  <?php 
    	  			    }elseif($col->Type=='longtext'){
    	  			        ?>
    	  			        
    	  			         <div class="form-group col col-sm-6">
        			    <label for="<?php echo $col->Field ?>" class="AppLabel">
        			       <?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> 
        			     </label>
        			   
        			    <textarea name="<?php echo $col->Field ?>" class="summernote"></textarea>
        			  </div>
        			  
        			  <?php 
    	  			    }else{
    	  			        ?>
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    <label for="nama_kecamatan" class="AppLabel">
        			       <?php echo ucfirst(str_replace("_"," ",str_replace("asset","provider",$col->Field))) ?> 
        			     </label>
        			   
        			    <input autocomplete="off" type="<?php echo $col->Type=='date'?'date':'' ?>" name="<?php echo $col->Field ?>" class="form-eza <?php echo $col->Field=='harga_'.$modul?'uang':'' ?>" id="<?php echo $col->Field ?>" autofocus="autofocus">
        			  </div>
    	  			        
    	  			        <?php
    	  			    }
    	  			?>
    	  		
    	  			
    	  			  
    	  			
    	  			<?php
    	  			
    	  			endforeach;
    	  			?>
	  		    

			

	
			   
			   
			
			</form>





</div>



