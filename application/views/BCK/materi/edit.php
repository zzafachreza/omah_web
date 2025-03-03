
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
    	  			

    	  			
    	  			foreach($this->db->query("SHOW COLUMNS from `data_$modul` WHERE FIELD !='id_$modul'")->result() as $col){
    	  			?>
    	  	
    	  	
    	<?php 
    	  			
    	  			if($col->Field=="file_$modul"){
    	  			        ?>
    	  			        
    	
        			    <input type="hidden" name="file_<?php echo $modul ?>_old" class="form-control" value="<?php echo $data->{$col->Field} ?>" />
        	
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    <label class="AppLabel">
        			<?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> 
        			     </label>
        			    <input type="file" name="file_<?php echo $modul ?>" class="form-control" />
        		     </div>
        			  
        			  <?php 
    	  			    }elseif($col->Field=="icon_$modul"){
    	  			        ?>
    	  			        
    	
        			    <input type="hidden" name="icon_<?php echo $modul ?>_old" class="form-control" value="<?php echo $data->{$col->Field} ?>" />
        	
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    <label class="AppLabel">
        			<?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> 
        			     </label>
        			    <input type="file" name="icon_<?php echo $modul ?>" class="form-control" />
        		     </div>
        			  
        			  <?php 
    	  			    }elseif($col->Field=="tipe"){
    	  			        ?>
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    <label class="AppLabel">
        			      Tipe File
        			     </label>
        			   <select  name="<?php echo $col->Field ?>" class="form-control selectza">
        			      
        			        <option <?php echo $data->{$col->Field}=='PDF'?'selected':'' ?> value="PDF">PDF</option>
        			        <option <?php echo $data->{$col->Field}=='VIDEO'?'selected':'' ?> value="VIDEO">VIDEO</option>
        			       
        			     
        			   </select>
        		     </div>
        			  
        			  <?php 
    	  			    }else if($col->Field=="fid_menu"){
    	  			        ?>
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    
        			   
        		
        			    <label class="AppLabel">
        			      Menu
        			     </label>
        			   <select  name="<?php echo $col->Field ?>" class="form-control selectza">
        			       <?php 
        			       foreach($this->db->query("SELECT * FROM data_menu")->result() as $r){
        			       ?>
        			        <option  <?php echo $data->{$col->Field}==$r->id_menu?'selected':'' ?> value="<?php echo $r->id_menu ?>"><?php echo $r->judul ?></option>
        			       
        			       <?php
        			       
    	  			    }
        			       ?>
        			   </select>
        		     </div>
        			  
        			  <?php 
    	  			    }elseif($col->Type=='date'){
    	  			        ?>
    	  			        
    	  			         <div class="form-group col col-sm-6">
        			    <label for="<?php echo $col->Field ?>" class="AppLabel">
        			       <?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> 
        			     </label>
        			   
        			    <input autocomplete="off" type="date" name="<?php echo $col->Field ?>" value="<?php echo $data->{$col->Field} ?>" class="form-eza" id="<?php echo $col->Field ?>">
        			  </div>
        			  
        			  <?php 
    	  			    }elseif($col->Type=='time'){
    	  			        ?>
    	  			        
    	  			         <div class="form-group col col-sm-6">
        			    <label for="<?php echo $col->Field ?>" class="AppLabel">
        			       <?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> 
        			     </label>
        			   
        			    <input autocomplete="off" type="time" name="<?php echo $col->Field ?>" value="<?php echo $data->{$col->Field} ?>" class="form-eza" id="<?php echo $col->Field ?>">
        			  </div>
        			  
        			  <?php 
    	  			    }elseif($col->Type=='longtext'){
    	  			        ?>
    	  			        
    	  			         <div class="form-group col col-sm-6">
        			    <label for="<?php echo $col->Field ?>" class="AppLabel">
        			       <?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> 
        			     </label>
        			   <textarea class="summernote" name="<?php echo $col->Field ?>"><?php echo $data->{$col->Field} ?></textarea>
        			  </div>
        			  
        			  <?php 
    	  			    }else{
    	  			        ?>
    	  			        
    	  			        <div class="form-group col col-sm-6">
        			    <label class="AppLabel">
        			 		<?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> 
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



