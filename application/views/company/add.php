<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
	    <li class="breadcrumb-item"><a href="<?php echo site_url('company') ?>">company</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Add</li>
	  </ol>
</nav>
<div class="container-fluid">

	<div class="card">
	  <div class="card-header">
	  		
	  <form action="<?php echo site_url('company/insert') ?>" method="POST" enctype="multipart/form-data">

	<a href="<?php echo site_url('company') ?>" class="AppButton-dark"><i class="flaticon2-left-arrow-1"></i> Kembali</a>

		<button class="AppButton-secondary" type="RESET"><i class="flaticon2-refresh-button"></i> Reset</button>
  	<button  class="AppButton-primary" id="simpan" type="SUBMIT"><i class="flaticon2-files-and-folders"></i> Simpan</button>
	  </div>
	  	<div class="card-body">
	  		<form>
	  			<?php
	  			// print_r($halaman->result())

	  			?>
			  <div class="form-group col col-sm-6">
			    <label for="tipe">Tipe</label>
			    <select name="tipe" class="form-control  selectza" required="required">

			    	<option>BACKGROUND</option>
					<option>PORTOFOLIO</option>

		  	
			    	
			    
			    </select>
			  </div>

			  

			  <div class="form-group col col-sm-6">
			    <label for="nama" class="AppLabel">Nama</label>
			    <i class="flaticon2-file iconInput"></i>
			    <input autocomplete="off" required="required" type="text" name="nama" class="AppInput" id="nama" autofocus="autofocus">
			  </div>

			   <div class="form-group col col-sm-6">
			    <label for="foto" class="AppLabel">Foto</label>
			    <input autocomplete="off" required="required" type="file" name="foto" >
			  </div>

			   <div class="form-group col col-sm-6">
			    <label for="ket" class="AppLabel">Keterangan</label>
			    <i class="flaticon-imac iconInput"></i>
			   <textarea class="form-control AppInput" name="ket"></textarea>
			  </div>
			   
			   
			
			</form>
		  </div>
		  <div class="card-footer">

		  </div>
	  </form>
	</div>


</div>



