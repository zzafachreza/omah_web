
<div class="container-fluid" style="margin-top:2%">
 <div class="bg-white row" style="margin-top:2%;margin-bottom:2%">
     <div class="col col-sm-6">
         <a href="<?php echo site_url($modul) ?>" class="btn bg-white text-black col col-sm-12"><i class="flaticon2-left-arrow-1"></i> Back</a>
     </div>
 
   

    
  </div>
  
   <?php
	  		$id_materi = $this->uri->segment(3);
	      	$row =	$this->db->query("SELECT * FROM data_$modul a JOIN data_menu b ON a.fid_menu = b.id_menu WHERE a.id_materi='$id_materi' ORDER BY a.fid_menu*1 ASC")->row_object();
	     
	  		
	  		?>
        
			   
			   <div class="row">
			       <div class="col-sm-6">
			            <h3><?php  echo $row->judul ?></h3>
        			    <h3 class="bg-utama"><?php  echo $row->kategori ?></h3>
        	
        			
        			    <img src="<?php  echo  site_url().$row->icon_materi ?>" height="100" />
			       </div>
			       <div class="col-sm-6">
			           <form method="POST" action="<?php echo site_url('materi/insert_syarat') ?>">
			               <div class="row">
			                   <div class="col-sm-8">
			                       <input type="hidden" name="fid_materi" value="<?php echo $id_materi ?>" />
			                       <input type="text" placeholder="masukan persyaratan baru" required name="nama_syarat" class="form-control" />
			                   </div>
			                   <div class="col-sm-4">
			                       <button class="btn bg-utama">Tambah Persyaratan</button>
			                   </div>
			               </div>
			           </form>
			           <table class="table table-bordered" style="margin-top:2%">
			               <tr>
			                   <th>No</th>
			                   <th>Nama Persyaratan</th>
			                   <th>Aksi</th>
			               </tr>
			               <?php
			                $no=1;
			                foreach($this->db->query("SELECT * FROM data_syarat WHERE fid_materi='$id_materi'")->result() as $syarat){
			               ?>
			               <tr>
			                   <td><?php echo $no ?></td>
			                   <td><?php echo $syarat->nama_syarat ?></td>
			                   <td width="30%">
			                       <a class="btn bg-utama" href="<?php echo site_url('materi/edit_syarat/'.$id_materi.'/'.$syarat->id_syarat) ?>"><i class="flaticon-edit"></i> Edit</a>
			                       <a class="btn btn-danger" onClick="return confirm('Apakah kamu akan hapus persyarat ini ?')" href="<?php echo site_url('materi/delete_syarat/'.$id_materi.'/'.$syarat->id_syarat) ?>"><i class="flaticon-delete"></i></a>
			                       
			                       </td>
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


