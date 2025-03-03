<div class="container-fluid" style="padding-top:2%">
 <div class="bg-white row" style="margin-top:0%;margin-bottom:2%">
     <div class="col col-sm-2">
         <a href="<?php echo site_url() ?>" class="btn bg-white text-black col col-sm-12"><i class="flaticon2-left-arrow-1"></i> Back</a>
     </div>
      <div class="col col-sm-2">
         <a href="<?php echo site_url($modul.'/add') ?>" class="btn bg-utama col col-sm-12"><i class="flaticon-add"></i> Add</a>
     </div>
 </div>

	  	<table class="table table-bordered table-striped table-hover tabza nowrap display"  style="width:100%">
	  		<thead class="bg-utama" style="color:white">
	  			<tr>
    	            <th>No</th>
    	            <th>Tanggal</th>
    	            <th>Posisi</th>
    	            <th>Bidang</th>
    	  			<th>Kategori</th>
    	  			<th>Nama</th>
    	  			<th>Alamat</th>
    	  			<th>Nomor Surat</th>
    	  			<th>Persentase</th>
    	  			  <th>Aksi</th>
    
    	  	

    	  		</tr>
	  		</thead>
	  		<tbody>
	  			<?php
	  				$no=0;
	                $sql = "SELECT *,(select count(*) from data_syarat WHERE fid_materi=a.fid_materi) jml_syarat FROM data_$modul a JOIN data_materi c ON a.fid_materi = c.id_materi JOIN data_menu b ON c.fid_menu = b.id_menu JOIN data_user d ON a.fid_user = d.id ORDER BY a.id_arsip*1 DESC";
	  				foreach($this->db->query($sql)->result() as $row){
	  				$no++;
	  			
		  		?>
		  			<tr>
		  			    <td><?php echo $no; ?></td>
		  			     <td><?php echo Indonesia3Tgl($row->tanggal) ?></td>
		  			     <td><?php echo $row->nama_lengkap ?></td>
		  			    <td><?php echo $row->judul ?></td>
		  				<td><?php echo $row->kategori ?> <span class="badge badge-<?php echo $row->jml_syarat>0?'success':'danger' ?>"><?php echo $row->jml_syarat ?> Persyaratan</span></td>
		                
		      <td><?php echo $row->nama ?></td>
		      <td><?php echo $row->alamat ?></td>
		      <td><?php echo $row->nomor_surat ?></td>
		      <td><?php echo $row->persen ?>%</td>
		  			  	<td>
		  				    
		  		
		  			
		  				 <?php if($_SESSION['level']=="Admin") { ?>
		  				 <a href="<?php echo site_url($modul.'/detail/'.$row->{'id_' . $modul}) ?>" class="btn bg-utama"><i class="flaticon-search"></i> Detail</a>
		  					<a href="<?php echo site_url($modul.'/edit/'.$row->{'id_' . $modul}) ?>" class="btn bg-kedua"><i class="flaticon-edit"></i></a>

		  					<a onClick="return confirm('Apakah kamu yakin akan hapus ini ?')" href="<?php echo site_url($modul.'/delete/'.$row->{'id_' . $modul}) ?>" class="btn bg-danger text-white"><i class="flaticon-delete"></i></a>	
                         <?php } ?>

		  				</td>
		  			

		  	        
		  			
		  				
		  			</tr>

		  	<?php } ?>
		  			
	  		</tbody>
	  	</table>



</div>

<script type="text/javascript">

<?php if($this->session->flashdata('import')){ ?>
Swal.fire(
     'Successfully',
      '<?php echo $this->session->flashdata('import'); ?>',
      'success'
    )
<?php } ?>

<?php if($this->session->flashdata('update')){ ?>
Swal.fire(
     'Successfully',
      '<?php echo $this->session->flashdata('update'); ?>',
      'success'
    )
<?php } ?>

<?php if($this->session->flashdata('pdf')){ ?>
Swal.fire(
     'Successfully',
      '<?php echo $this->session->flashdata('pdf'); ?>',
      'success'
    )
<?php } ?>

<?php if($this->session->flashdata('error')){ ?>
Swal.fire(
     'Gagal Upload',
      '<?php echo $this->session->flashdata('error'); ?>',
      'error'
    )
<?php } ?>




	function copyToClipboard(element) {
	  var $temp = $("<input>");
	  $("body").append($temp);
	  $temp.val($(element).text()).select();
	  document.execCommand("copy");
	  $temp.remove();
	}


	$(".alink").click(function(e){
		e.preventDefault();
		var link = $(this).attr('data-id');
		$("#p1").text(link);
		copyToClipboard("#p1");
		$(this).removeClass('btn-success');
		$(this).addClass('btn-secondary');

		$(this).text('Copied');
	})
	
	$(document).ready(function() {
    $('.tabza2').DataTable( {
        "paging":false,
        "searching":false,
        "scrollX": true
    } );
    
    
} );
</script>



