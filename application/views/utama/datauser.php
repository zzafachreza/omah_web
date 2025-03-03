
<?php

  
  

    $id = $_SESSION['user']['id_pengguna'];
    $data = $this->db->query("SELECT * FROM data_pengguna a JOIN data_jenispekerjaan b ON a.fid_jenispekerjaan = b.id_jenispekerjaan WHERE id_pengguna='$id'")->row_object();

    $point = $this->db->query("SELECT sum(point) as point FROM data_point WHERE fid_pengguna='".$_SESSION['user']['id_pengguna']."'")->row_object();

  if($point->point>0 && $point->point<=30){
              $icon = 'Platinum';
            }elseif($point->point>30 && $point->point<=50){
              $icon = 'Silver';
            }if($point->point>50){
              $icon = 'Gold';
            }

$unsafe = $this->db->query("SELECT jenis,COUNT(*) jumlah FROM `data_kondisi` WHERE fid_pengguna='".$_SESSION['user']['id_pengguna']."' GROUP BY jenis")->result();





?>

<div class="container-fluid">

  <div class="row">



    <div class="col-sm-6">
       
       <div style="padding: 10px;margin-bottom: 20px;">
            <div style=";box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2;">
                <div style="background-color: #295882;color: white;text-align: center;border-radius: 20px;padding: 10px;">
                    Identitas Diri
                </div>
                <div style="padding: 10px">
                 <table class="table table-striped" style="width: 100%">
                 
                   <?php
                    

                    
                    foreach($this->db->query("SHOW FULL COLUMNS from `data_pengguna` WHERE FIELD IN('nama',
                  'fid_jenispekerjaan',
                  'pekerjaan',
                  'perusahaan',
                  'tanggal_lahir',
                  'alamat',
                  'nomor_id',
                  'pendidikan_terakhir',
                  'riwayat_penyakit',
                  'status_kesehatan')")->result() as $col){
                    
                    ?>
            
            
    
                  <tr>
                     <td width="40%"><?php echo $col->Comment ?></td>
                      <td><?php

                        if($col->Field=='fid_jenispekerjaan'){
                           echo $data->nama_jenispekerjaan;
                        }elseif($col->Type=='date'){
                           echo Indonesia3Tgl($data->{$col->Field});
                        }else{
                          echo $data->{$col->Field};
                        }

                     ?></td>
                  </tr>

                   <?php }  ?>

                   <?php
                    

                    
                    foreach($this->db->query("SHOW FULL COLUMNS from `data_pengguna` WHERE TYPE IN('varchar(444)') AND FIELD IN('sertifikat')")->result() as $col){
                    
                    ?>
            
            
    
                  <tr>
                     <td width="40%"><?php echo $col->Comment ?></td>
                      <td><a href="<?php echo site_url().$data->{$col->Field} ?>" class="btn btn-danger">Lihat File</a></td>
                  </tr>

                   <?php }  ?>
                </table>
                </div>
            </div>
          </div>



         


    </div>


    <div class="col-sm-6" style="align-items:center;display: flex;justify-content: center;">

        <img src="<?php echo site_url().$data->foto ?>" width="80%" style="border-radius: 20px;box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;" />

    


   
        



             



             










    </div>
  </div>

   <div class="row">
      <div class="col-sm-4">
          <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2">
                <div style="background-color: #EEBA00;color: white;text-align: center;border-radius: 20px;padding: 10px;">
                    Jumlah Ketidaksesuaian
                </div>
               <div>
                  <canvas id="myChart2"></canvas>
                </div>
            </div>
          </div>
      </div>
      <div class="col-sm-4">
        <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2">
                <div style="background-color: #90DE64;color: white;text-align: center;border-radius: 20px;padding: 10px;">
                   Training : 
                </div>
                <div class="p-1">
                  <table class="table">
                      <?php $no=1;
                          foreach ($this->db->query("SELECT * FROM data_training WHERE fid_pengguna='$id'")->result() as $act) {
                          ?>  

                          <tr><td><?php echo $act->judul_training ?></td></tr>

                        <?php $no++; } ?>
                  </table>
                </div>
            </div>
          </div>
        
      </div>
      <div class="col-sm-4">
        <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2">
                <div style="background-color: #66BFFF;color: white;text-align: center;border-radius: 20px;padding: 10px;">
                   Program Kerja : 
                </div>
                <div class="p-1">
                  <table class="table">
                      <?php $no=1;
                          foreach ($this->db->query("SELECT * FROM data_prokerhse a JOIN data_proker b ON a.fid_proker = b.id_proker WHERE fid_pengguna='$id'")->result() as $act) {
                          ?>  

                          <tr><td><?php echo $act->nama_proker ?></td></tr>

                        <?php $no++; } ?>
                  </table>
                </div>
            </div>
          </div>
      </div>
      <div class="col-sm-12 p-4">
         <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2;overflow: hidden;">
              

                <div class="row" >
                  <div class="col-sm-3 pt-0" style="background-color: #FF6258;border-radius: 20px">
                       <div style="color: white;text-align: center;border-radius: 20px;padding: 10px;height: 100%;font-size: 30px">
                      Rewarding :
                </div>
                  </div>
                  <div class="col-sm-9 p-2" style="">
                     <span style="color: black;font-size: 30px;margin-left: 5%">
                          <?php echo $icon ?> : 
                     </span>
                     <span style="color: red;font-size: 30px"><?php echo $point->point ?></span>
                  </div>
                </div>
            </div>
      </div>
    </div>

</div>

<?php

$arrLab = array();
$arrVal = array();
foreach ($this->db->query("SELECT nama_jenispekerjaan as lab,(SELECT count(*) FROM data_pengguna WHERE fid_jenispekerjaan=a.id_jenispekerjaan) as val FROM data_jenispekerjaan a")->result() as $r) {
  
 
  array_push($arrLab, $r->lab);
  array_push($arrVal, $r->val);

  }
$LABELA = "['".implode("','", $arrLab)."']";
$VALUEA = "[".implode(",", $arrVal)."]";
// $VALUEA = implode(",", $arrLab[1]);

?>

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




  const ctx = document.getElementById('myChart');





new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo $LABELA ?>,
      datasets: [{
        label: 'Manpower',
        data: <?php echo $VALUEA ?>,
        borderColor: '#90DE64',
        backgroundColor: '#CCEABB',
        borderWidth: 1
      }]
    },
    options: {
         indexAxis: 'x',
             responsive: true,
        legend:{
            display:false
        }
  }
    
   

  });


  const ctx2 = document.getElementById('myChart2');

const config = {
  type: 'pie',
  data: {
    labels: [
    'Unsafe Action',
    'Unsafe Condition',
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [<?php echo $unsafe[0]->jumlah ?>, <?php echo $unsafe[1]->jumlah ?>],
    backgroundColor: ['#FF5F5F','#FFE898'],
    hoverOffset: 4
  }]
  },
  options: {
        plugins: {
          legend:true,
          datalabels: {
            // Position of the labels 
            // (start, end, center, etc.)
            anchor: 'end',
            // Alignment of the labels 
            // (start, end, center, etc.)
            align: 'end',
            // Color of the labels
            color: 'blue',
            font: {
              weight: 'bold',
            },
            formatter: function (value, context) {
              // Display the actual data value
              return value;
            }
          }
        }
      }

};

  var Chart2 = new Chart(ctx2,config);

 
</script>



