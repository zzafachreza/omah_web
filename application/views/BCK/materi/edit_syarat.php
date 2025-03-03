
<?php

$id = $this->uri->segment(4);
$fid_materi = $this->uri->segment(3);

$data = $this->db->query("SELECT * FROM data_syarat WHERE id_syarat='$id'")->row_object();

?>

<div class="container-fluid">

	<div class="card">
	  <div class="card-header">
	  		
	  <form action="<?php echo site_url('materi/update_syarat') ?>" method="POST" enctype="multipart/form-data" >

	<a href="<?php echo site_url('materi/detail/'.$fid_materi) ?>" class="btn bg-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
  	<button class="btn bg-utama" type="SUBMIT"><i class="flaticon2-files-and-folders"></i> Simpan</button>
	  </div>
	  	<div class="card-body">
	  		<form>
	
                <input name="fid_materi" type="hidden" value="<?php echo $fid_materi ?>" />
                
                <input name="id_syarat" type="hidden" value="<?php echo $id ?>" />
	
			  
			  
			  
    	  			        <div class="form-group col col-sm-6">
        			    <label class="AppLabel">
        		            Nama Persyaratan
        			     </label>
        			    <input type="text" name="nama_syarat" class="form-control" value="<?php echo $data->nama_syarat ?>" />
        		     </div>
        			  
        			  

			 
			</form>
		  </div>
		  <div class="card-footer">

		  </div>
	  </form>
	</div>


</div>



