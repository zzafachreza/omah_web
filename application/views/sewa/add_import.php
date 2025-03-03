

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url($modul) ?>"><?php echo ucfirst($judul) ?></a></li>
      <li class="breadcrumb-item active" aria-current="page">Import</li>
    </ol>
</nav>
<div class="container-fluid">

	<div class="card">
	  <div class="card-header">
	  		
	  <form action="<?php echo site_url($modul.'/import_proses') ?>" method="POST" enctype="multipart/form-data">

	<a href="<?php echo site_url($modul) ?>" class="btn bg-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
   	<button class="btn bg-utama" id="simpan" type="SUBMIT"><i class="flaticon2-files-and-folders"></i> Simpan</button>
	  </div>
	  	<div class="card-body">
	  		<form>
	  		    
	  	
			  

			  <div class="form-group col col-sm-6">
			    <label for="excel" class="AppLabel">Masukan Data Excel</label>
			    <input  type="file" name="excel"  id="excel" autofocus="autofocus">

			  </div>
			 
			  
			  
			  	

	
			   
			   
			
			</form>
		  </div>
		  <div class="card-footer">

		  </div>
	  </form>
	</div>


</div>



