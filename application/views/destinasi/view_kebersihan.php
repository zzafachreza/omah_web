<?php
$id = $this->uri->segment(4);
$tanggal = $this->uri->segment(3);
$row = $this->db->query("SELECT *,(SELECT count(*) FROM data_santri WHERE fid_kamar=c.id_kamar) as jumlah_siswa FROM data_$modul a JOIN data_pengguna b ON a.fid_pengguna = b.id_pengguna JOIN data_kamar c ON a.fid_kamar = c.id_kamar WHERE id_$modul='$id'")->row_object();
$fid_kamar = $row->fid_kamar;
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
            
    
    <a href="<?php echo site_url($modul.'/detail/'.$id) ?>" class="btn bg-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
    
  </div>
        <div class="card-body">
          <div class="row">
              <div class="col-sm-6">
                  <table class="table table-bordered">
                  	   <tr>
                        <th>Tanggal</th>
                        <td><?php echo Indonesia3Tgl($tanggal) ?></td>
                      </tr>
                      <tr>
                        <th width="30%">Nama kelas / Kamar</th>
                        <td><?php echo $row->nama_kamar ?></td>
                      </tr>
                       <tr>
                        <th>Nomor Kamar</th>
                        <td><?php echo $row->nomor_kamar ?></td>
                      </tr>
                       <tr>
                        <th>Musyrif</th>
                        <td><?php echo $row->nama_lengkap ?></td>
                      </tr>
                       <tr>
                        <th>Jumlah Santri</th>
                        <td><?php echo $row->jumlah_siswa ?></td>
                      </tr>
                    
                  </table>
              </div>
              <div class="col-sm-6">
                  <table class="table table-bordered">
                      <tr class="bg-utama">
                        <th>No</th>
                        <th>Nama Santri yang Sakit</th>
                        <th>Keterangan</th>
                      </tr>
                      <?php
                      $no=1;
                  foreach($this->db->query("SELECT * FROM data_sakit a JOIN data_santri b ON a.fid_santri = b.id_santri WHERE tanggal='$tanggal' AND a.fid_kamar='".$fid_kamar."' GROUP BY a.fid_santri")->result() as $r){
                  ?>
                      <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo $r->nama_santri ?></td>
                          <td><?php echo $r->keterangan ?></td>
                          
                      </tr>
                  
                  <?php $no++; } ?>

                  </table>
              </div>
              <div class="col-sm-6">
                <h4>KEBERSIHAN KAMAR</h4>
         			
         			<?php 

         			$sqlBersih = "SELECT *,(SELECT COUNT(*) FROM data_sakit WHERE fid_kamar = a.fid_kamar AND tanggal=a.tanggal) jumlah_sakit FROM data_kebersihan a WHERE a.tanggal='$tanggal' AND a.fid_kamar='".$fid_kamar."'";
         			$bersih = $this->db->query($sqlBersih)->row_object();
         			 ?>
                <table class="table table-bordered">
                      <tr class="bg-utama">
                        <th>No</th>
                        <th>Penilaian</th>
                        <th>Hasil</th>
                        <th>Skor</th>
                      </tr>

                        <tr>
                        	<td>1</td>
                        	<td>Kondisi Lantai</td>
                        	<td><?php echo $bersih->h1 ?></td>
                        	<td><?php echo $bersih->n1 ?></td>
                        </tr>
						<tr>
							<td>1</td>
							<td>Kondisi Kamar Mandi</td>
							<td><?php echo $bersih->h2 ?></td>
							<td><?php echo $bersih->n2 ?></td>
						</tr>
						<tr>
							<td>1</td>
							<td>Kondisi Lemari</td>
							<td><?php echo $bersih->h3 ?></td>
							<td><?php echo $bersih->n3 ?></td>
						</tr>
						<tr>
							<td>1</td>
							<td>Gantungan Baju</td>
							<td><?php echo $bersih->h4 ?></td>
							<td><?php echo $bersih->n4 ?></td>
						</tr>
                     
                  </table>
              </div>
              <div class="col-sm-6">
              		<h4>FOTO KONDISI KAMAR</h4>

              		<table class="table table-bordered">
              			<tr class="bg-utama">
              				<th>Ranjang</th>
              				<th>Lantai</th>
              				<th>Keseluruhan</th>
              			</tr>
              			<tr >
              				<th>
              					
              					<a href="<?php echo $bersih->foto_ranjang ?>"><img src="<?php echo $bersih->foto_ranjang ?>" width="200" height="200"></a>
              				</th>
              				<th>
              					<a href="<?php echo $bersih->foto_lantai ?>"><img src="<?php echo $bersih->foto_lantai ?>" width="200" height="200"></a></th>
              				<th>
              					<a href="<?php echo $bersih->foto_semua ?>"><img src="<?php echo $bersih->foto_semua ?>" width="200" height="200"></a></th>
              			</tr>
              		</table>
              </div>
          </div>
              
                
<hr />



</div>
    
          </div>
          <div class="card-footer">

          </div>
    
    </div>


</div>



