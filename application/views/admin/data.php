<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($judul) ?></li>
    </ol>
</nav>
<div class="container-fluid">

  <div class="card">
    <div class="card-header">
      <a href="<?php echo site_url() ?>" class="btn btn-ketiga"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
      <a href="<?php echo site_url($modul.'/add') ?>" class="btn btn-utama"><i class="flaticon-add"></i> Tambah</a>
    </div>
    <div class="card-body">

 
 <?php 
 
 $sqlKolom = "SHOW FULL COLUMNS FROM data_$modul WHERE FIELD NOT IN('id_$modul','password')";
 
 ?>

      <table class="table table-bordered table-striped table-hover nowrap tabza display <?php echo isDevice()?'table-responsive':'' ?>"  style="width:100%">
        <thead class="bg-utama" style="color:white">
          <tr>
                  <th>No</th>
                  <?php 
                      foreach($this->db->query($sqlKolom)->result() as $k){
                  ?>
                  
                  <th><?php echo $k->Comment ?></th>
                  
                  
                  <?php } ?>
              <th>Aksi</th>
    
          

            </tr>
        </thead>
        <tbody>
      
            <?php
            $no=0;
                  $sql = "SELECT * FROM data_$modul a";
            foreach($this->db->query($sql)->result() as $row){
            $no++;
          
          ?>
            <tr>
                  <td><?php echo $no; ?></td>

                  
                  
                   <?php 
                      foreach($this->db->query($sqlKolom)->result() as $k){

                          if($k->Type=='varchar(444)'){

                          
                          ?>
                           <td><img src="<?php echo site_url().$row->{$k->Field} ?>" width="100" /></td>

                           <?php }elseif($k->Field=='tanggal_lahir'){

                          
                          ?>
                            <td><?php echo Indonesia3Tgl($row->{$k->Field}) ?> ( <?php echo umur($row->{$k->Field}) ?> )</td>

                           <?php }elseif($k->Type=='float'){

                          
                          ?>
                            <td><?php echo number_format($row->{$k->Field}) ?></td>

                           <?php }elseif(substr($k->Field, 0,4) =="fid_"){ 

                      $tabel_nama = explode("_", $k->Field)[1];

                      if($tabel_nama=='sekolah'){
                        $showRelation = $row->nama_sekolah;
                      } elseif($tabel_nama=='bank'){
                        $showRelation = $row->nama_bank.' / '.$row->nomor_rekening;
                      } elseif($tabel_nama=='bahanhijab'){
                        $showRelation = $row->nama_bahan.' / '.$row->size;
                      } 
                      elseif($tabel_nama=='kategori'){
                        $showRelation = $row->nama_kategori;
                      }   

                ?>



                  <td><?php echo $showRelation?></td>
              <?php } else{ ?>

                  <td><?php echo $row->{$k->Field} ?></td>
              <?php }?>
                         
                          
                          
                 <?php } ?>
                  
                  
                  
                  
    
            
                <td>
                  
          
            
               <?php if($_SESSION['level']=="Admin") { ?>
            
          <a href="<?php echo site_url($modul.'/detail/'.$row->{'id_' . $modul}) ?>" class="btn btn-utama"><i class="flaticon-search"></i></a>
               
                <a href="<?php echo site_url($modul.'/edit/'.$row->{'id_' . $modul}) ?>" class="btn btn-kedua"><i class="flaticon-edit"></i></a>

                <a onClick="return confirm('Apakah kamu yakin akan hapus ini ?')" href="<?php echo site_url($modul.'/delete/'.$row->{'id_' . $modul}) ?>" class="btn btn-ketiga"><i class="flaticon-delete"></i></a> 
                         <?php } ?>

              </td>
            

                
            
              
            </tr>

        <?php } ?>
            
        </tbody>
      </table>



    </div>
  </div>


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



