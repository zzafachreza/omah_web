<?php
$id = $this->uri->segment(3);
$data = $this->db->query("SELECT * FROM data_$modul WHERE id_$modul='$id'")->row_object();

?>
<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
	    <li class="breadcrumb-item"><a href="<?php echo site_url($modul) ?>"><?php echo ucfirst($modul) ?></a></li>
	    <li class="breadcrumb-item active" aria-current="page">Detail</li>
	  </ol>
</nav>
<div class="container-fluid">

	<div class="card">
	  <div class="card-header">
	  		
	
	<a href="<?php echo site_url($modul) ?>" class="btn bg-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
	
    <?php if(strlen($data->{'file_'.$modul}) > 10){ ?>
	<a href="<?php echo site_url().$data->{'file_'.$modul} ?>" class="btn bg-utama"><i class="flaticon2-print"></i> Print</a>
    <?php } ?>
    
     <?php if(strlen($data->{'file_'.$modul}) < 10){ ?>
	<a href="<?php echo site_url($modul.'/print/'.$id) ?>" class="btn bg-utama"><i class="flaticon2-print"></i> Print</a>
    <?php } ?>
		  </div>
	  	<div class="card-body">

	  		  
			    <?php
    	  			

    	  			
    	  			foreach($this->db->query("SHOW COLUMNS from `data_$modul` WHERE FIELD !='id_$modul'")->result() as $col){
    	  			?>
    	  	
    	  	
    	<?php 
    	  			
    	  			if($col->Field=="file_$modul"){
    	  			        ?>
    	  			        
    	
        			         <!--<div class="form-group col col-sm-6">-->
                			 <!--   <label><strong>	<?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> </strong></label>-->
                    <!--			  <div>-->
                    <!--			       <a href="<?php echo site_url().$data->{$col->Field} ?>"><img src="<?php echo site_url().$data->{$col->Field} ?>" width="200" /></a>-->
                    <!--			  </div>-->
                			 <!--</div>-->
        			  
        			  <?php 
    	  			    }else{
    	  			        ?>
    	  			        
    	  			        <div class="form-group col col-sm-6">
                			    <label><strong>	<?php echo ucfirst(str_replace("_"," ",$col->Field)) ?> </strong></label>
                			   <p><?php echo $data->{$col->Field} ?></p>
                			 </div>
    	  			        
    	  			        <?php
    	  			    }
    	  			?>
    	  			
    	  			
    	  	
    	  			
    	  			
    	  			<?php } ?>


	
		  </div>
		  <div class="card-footer">

		  </div>
	
	</div>


</div>



