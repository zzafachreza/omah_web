<div class="container" style="padding-top: 2%">
 
 <div class="p-3" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;border-radius: 10px;background-color: #F2F2F2">
  <h1 class="display-6">Selamat datang</h1>
 
 
</div>
<?php
	
	$pengguna = $this->db->query("SELECT * FROM data_pengguna a JOIN data_jenispekerjaan b ON a.fid_jenispekerjaan = b.id_jenispekerjaan WHERE a.id_pengguna='".$_SESSION['user']['id_pengguna']."'")->row_object();

	$point = $this->db->query("SELECT sum(point) as point FROM data_point WHERE fid_pengguna='".$_SESSION['user']['id_pengguna']."'")->row_object();

	if($point->point>0 && $point->point<=30){
              $icon = 'down';
            }elseif($point->point>30 && $point->point<=50){
              $icon = 'med';
            }if($point->point>50){
              $icon = 'up';
            }


?>
    
 <div class="row mt-4">
 		<div class="col-sm-8">
 			<table class="table table-responsive">
 				<tr>
 					<td rowspan="2" width="250"><img src="<?php echo site_url().$_SESSION['user']['foto'] ?>" width="250" height="300" style="border-radius: 10px"></td>
 					<td>
 						<h2><strong><?php echo $pengguna->nama ?></strong></h2>
 						<p style="font-size: 30px"><?php echo $pengguna->pekerjaan ?> - <?php echo $pengguna->nama_jenispekerjaan ?></p>
 						<p style="font-size: 30px">ID : <?php echo $pengguna->nomor_id ?></p>

 						<p style="font-size: 30px;font-weight: bold;color: #295882"><?php echo $pengguna->fbh ?></p>

 					</td>
 				</tr>

					
 			</table>
 		</div>
 		<div class="col-sm-4">
 			<table class="table table-responsive">
 				<tr>
 					<td>
 						<img src="<?php echo site_url('assets/images/').$icon.'.png' ?>" width="100%"> <?php echo $row->point ?>
 					</td>
 					<td>
 						<h2 style="text-align: center;"><strong>Point HSE</strong></h2>
 						<p style="font-size: 60px;color: red;text-align: center;font-weight: bolder;"><?php echo $point->point ?></p>
 					</td>
 				</tr>
 			</table>
 		</div>
 </div>

  <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2;padding: 5px">
                <div style="background-color: #EEBA00;color: white;text-align: center;border-radius: 20px;padding: 10px;font-size: 20px">
                   Jumlah Ketidaksesuaian yang Dilakukan
                </div>
                <div class="row" >
                  <div class="col-sm-6 pt-3">
                      <center>
                        <h4>Unsafe Action = <strong><span style="font-size: 30px"><?php echo number_format($this->db->query("SELECT * FROM `data_kondisi` WHERE jenis='Unsafe Action' AND fid_pengguna='".$_SESSION['user']['id_pengguna']."'")->num_rows())  ?></strong></span></h4>
                        
                      </center>

                        <table class="table table-striped">
                        	
							<?php
							$no=1;
							foreach ($this->db->query("SELECT * FROM data_info WHERE jenis='Unsafe Action'")->result() as $act) {


                $jml = $this->db->query("SELECT * FROM `data_kondisi` WHERE jenis='Unsafe Action' AND fid_pengguna='".$_SESSION['user']['id_pengguna']."' AND kategori='".$act->kategori."'")->num_rows();

							?>	

							<tr>
                        		<td><?php echo $no ?>. </td>
                        		<td><?php echo $act->kategori ?></td>
                        		<td style="color: <?php echo $jml>0?'red':'black'; ?>"><strong><?php echo number_format($jml) ?> </strong></td>
                        	</tr>

						<?php $no++; } ?>
                        </table>
						
						
						
						
						
						
						
                  </div>
                  <div class="col-sm-6 pt-3" style="border-left: 1px dashed #EEBA00">
                      <center>
                        <h4>Unsafe Condition = <strong><span style="font-size: 30px"><?php echo number_format($this->db->query("SELECT * FROM `data_kondisi` WHERE jenis='Unsafe Condition' AND fid_pengguna='".$_SESSION['user']['id_pengguna']."'")->num_rows())  ?></strong></span></h4>
                        
                      </center>

                        <table class="table table-striped">
                        	<?php
							$no=1;
							foreach ($this->db->query("SELECT * FROM data_info WHERE jenis='Unsafe Condition'")->result() as $act) {

                $jml = $this->db->query("SELECT * FROM `data_kondisi` WHERE jenis='Unsafe Condition' AND fid_pengguna='".$_SESSION['user']['id_pengguna']."' AND kategori='".$act->kategori."'")->num_rows();


							?>	

							<tr>
                        		<td><?php echo $no ?>. </td>
                        		<td><?php echo $act->kategori ?></td>
                        		<td style="color: <?php echo $jml>0?'red':'black'; ?>"><strong><?php echo number_format($jml) ?> </strong></td>
                        	</tr>

						<?php $no++; } ?>
                        </table>
                  </div>
                </div>
            </div>
          </div>

</div>