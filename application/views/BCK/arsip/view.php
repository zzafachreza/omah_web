
<div class="container-fluid" style="margin-top:2%">
 <div class="bg-white row" style="margin-top:2%;margin-bottom:2%">
     <div class="col col-sm-6">
         <a href="<?php echo site_url($modul) ?>" class="btn bg-white text-black col col-sm-12"><i class="flaticon2-left-arrow-1"></i> Back</a>
     </div>
 
   

    
  </div>
  
   <?php
	  		$id_arsip = $this->uri->segment(3);
	      	$row =	$this->db->query("SELECT *,(select count(*) from data_syarat WHERE fid_materi=a.fid_materi) jml_syarat FROM data_$modul a JOIN data_materi c ON a.fid_materi = c.id_materi JOIN data_menu b ON c.fid_menu = b.id_menu WHERE a.id_arsip='$id_arsip'")->row_object();
	     $id_materi = $row->fid_materi;
	  		$kode = $row->kode;
	  		?>
        
			   
			   <div class="row">
			       <div class="col-sm-6">
			            <h3><?php  echo $row->judul ?></h3>
        			    <h3 class="bg-utama"><?php  echo $row->kategori ?></h3>
        	<table class="table table-bordered" style="margin-top:2%">
			               <tr>
			                   <th>Nama</th>
			                    <td><?php echo $row->nama ?></td>
			               </tr>
			                <tr>
			                   <th>Alamat</th>
			                    <td><?php echo $row->alamat ?></td>
			               </tr>
			                <tr>
			                   <th>Nomor Surat</th>
			                    <td><?php echo $row->nomor_surat ?></td>
			               </tr>
			                <tr>
			                   <th>Persentase</th>
			                    <td><?php echo $row->persen ?>%</td>
			               </tr>
			         </table>
			         <hr />
			         <h4>FIle Berkas</h4>
        				<table class="table table-bordered" style="margin-top:2%">
			               <tr>
			                   <th>No</th>
    			                <th>Berkas</th>
    			                <th>Tipe File</th>
    			                <th>Aksi</th>
			               </tr>
			                <?php
			                $no=1;
			                foreach($this->db->query("SELECT * FROM data_berkas WHERE kode='$kode'")->result() as $berkas){
			               ?>
			               <tr>
			                   <td><?php echo $no ?></td>
			                   <td><?php echo $berkas->nama_berkas ?></td>
			                    
			                    <td><?php echo $berkas->tipe_berkas ?></td>
			                    <td><a class="btn btn-danger" target="_BLANK" href="<?php echo site_url().$berkas->berkas_file ?>"><i class="flaticon-search"></i> Detail File</a></td>
			                  
			               </tr>
			               
			               <?php $no++; } ?>
			               
			               
			         </table>
			       </div>
			       <div class="col-sm-6">
			   
			           <table class="table table-bordered" style="margin-top:2%">
			               <tr>
			                   <th>No</th>
			                   <th>Nama Persyaratan</th>
			                   <th>Status</th>
			               </tr>
			               <?php
			                $no=1;
			                foreach($this->db->query("SELECT *,(SELECT count(*) FROM data_cek WHERE kode='$kode' AND fid_syarat=a.id_syarat) cek FROM data_syarat a WHERE a.fid_materi='$id_materi' ORDER BY a.id_syarat*1 ASC")->result() as $syarat){
			               ?>
			               <tr>
			                   <td><?php echo $no ?></td>
			                   <td><?php echo $syarat->nama_syarat ?></td>
			           
			                         <td><?php echo $syarat->cek>0?'<i class="flaticon2-correct text-success"></i>':'<i class="flaticon2-cross text-danger"></i>' ?></td>
			                  
			               </tr>
			               
			               <?php $no++; } ?>
			           </table>
			       </div>
			   </div>
		
		    


 


</div>
<script>
    <?php if($this->session->flashdata('update')){ ?>
Swal.fire(
     'Successfully',
      '<?php echo $this->session->flashdata('update'); ?>',
      'success'
    )
<?php } ?>
</script>


