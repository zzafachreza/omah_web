<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">company</li>
	  </ol>
</nav>
<div class="container-fluid">

    <?php
	      
	      $row = $this->db->query("SELECT * FROM data_company")->row_object();
	      
	      ?>
	<div class="card">
	  <div class="card-header">
	  	<a href="<?php echo site_url() ?>" class="btn bg-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
	  			<a href="<?php echo site_url('company/edit/'.$row->id) ?>" class="btn bg-kedua"><i class="flaticon-edit"></i> Pengaturan</a>
	    <!-- <a href="<?php echo site_url('company/add') ?>" class="AppButton-primary"><i class="flaticon-add"></i> Tambah</a> -->
	  </div>
	  <div class="card-body">
	      
	  
	     <center>
	          <img src="<?php echo $row->foto ?>" width="100">
	     </center>
	    <div class="form-group">
	        <label>Nama Aplikasi</label>
	        <p><strong><?php echo $row->nama ?></strong></p>
	    </div>
	    <hr />
	     <div class="form-group">
	        <label>Deskripsi Aplikasi</label>
	        <p><strong><?php echo $row->deskripsi ?></strong></p>
	    </div>
	     <hr />
	     <div class="form-group">
	        <label>Telepon</label>
	        <p><strong><?php echo $row->tlp ?></strong></p>
	    </div>
 		
 

	    
	    <hr />

        <div class="form-group">
	        <label>Warna</label>
	        <center>
		  				        <div class="row col col-sm-12">
    		  				        <div style="width:30px;margin:2%;height:30px;border-radius:15px;background-color:<?php echo $row->warna_utama ?>">&nbsp;</div>
        		  				    <div style="width:30px;margin:2%;height:30px;border-radius:15px;background-color:<?php echo $row->warna_kedua ?>">&nbsp;</div>
        		  				    <div style="width:30px;margin:2%;height:30px;border-radius:15px;background-color:<?php echo $row->warna_ketiga ?>">&nbsp;</div>
    		  				    </div>
		  				    </center>
	    </div>
	    <hr />
	    
	    


	  </div>
	</div>


</div>



