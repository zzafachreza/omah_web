<?php
$id = $this->uri->segment(4);
$id_santri = $this->uri->segment(3);
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
                        <th>Jumlah Sakit</th>
                        <td><?php echo $this->db->query("SELECT * FROM data_sakit WHERE fid_santri='$id_santri'")->num_rows(); ?></td>
                      </tr>
                    
                  </table>
              </div>
              <div class="col-sm-6">
                 <table class="table table-bordered">
                      <tr class="bg-utama">
                        <th>No</th>
                        <th>Tanggal Sakit</th>
                        <th>Keterangan</th>
                      </tr>
                      <?php
                      $no=1;
                  foreach($this->db->query("SELECT * FROM data_sakit WHERE fid_santri='$id_santri'")->result() as $r){
                  ?>
                      <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo Indonesia3Tgl($r->tanggal) ?></td>
                          <td><?php echo $r->keterangan ?></td>
                          
                      </tr>
                  
                  <?php $no++; } ?>

                  </table>
              </div>
              <div class="col-sm-12">
                <h4>KEBERSIHAN PRIBADI SANTRI</h4>
         	  
                <form method="GET">
                  <div class="row" style="margin-bottom: 2%">
                    <div class="col-sm-3">
                      <label>Dari</label>
                      <input type="date" class="form-control" value="<?php echo !empty($_GET['awal'])?$_GET['awal']:date('Y-m-d') ?>"  name="awal">
                    </div>
                    <div class="col-sm-3">
                      <label>Dari</label>
                      <input type="date" class="form-control" value="<?php echo !empty($_GET['akhir'])?$_GET['akhir']:date('Y-m-d') ?>"  name="akhir">
                    </div>
                    <div class="col-sm-2">
                      <label>&nbsp;</label>
                     <button class="btn bg-utama col-sm-12"><i class="flaticon-search"></i> Filter</button>
                    </div>
                </div>
                </form>
                <table width="100%" class="tabza table table-bordered table-responsive nowrap">
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kondisi Rambut</th>
                        <th>Kondisi Kuku</th>
                        <th>Gigi dan Mulut</th>
                        <th>Wajah</th>
                        <th>Kulit Tangan</th>
                        <th>Kulit Kaki</th>
                        <th>Pakaian</th>
                        <th>Ranjang</th>
                      </tr>
                      <?php
                      $no=1;

                      if(!empty($_GET['awal'])){
                        $awal = $_GET['awal'];
                        $akhir = $_GET['akhir'];
                        $sqlBersih = "SELECT * FROM data_pribadi a WHERE a.tanggal BETWEEN '$awal' AND '$akhir' AND a.fid_kamar='".$fid_kamar."'";
                      }else{
                        $sqlBersih = "SELECT * FROM data_pribadi a WHERE a.fid_kamar='".$fid_kamar."'";
                      }
                  foreach($this->db->query($sqlBersih)->result() as $r){
                  ?>
                      <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo Indonesia3Tgl($r->tanggal) ?></td>
                          <td><?php echo  $r->h1 ?><br/>( <?php echo $r->n1 ?> )</td>
                          <td><?php echo  $r->h2 ?><br/>( <?php echo $r->n2 ?> )</td>
                          <td><?php echo  $r->h3 ?><br/>( <?php echo $r->n3 ?> )</td>
                          <td><?php echo  $r->h4 ?><br/>( <?php echo $r->n4 ?> )</td>
                          <td><?php echo  $r->h5 ?><br/>( <?php echo $r->n5 ?> )</td>
                          <td><?php echo  $r->h6 ?><br/>( <?php echo $r->n6 ?> )</td>
                          <td><?php echo  $r->h7 ?><br/>( <?php echo $r->n7 ?> )</td>
                          <td><?php echo  $r->h8 ?><br/>( <?php echo $r->n8 ?> )</td>
                        
                          
                      </tr>
                  
                  <?php $no++; } ?>

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



