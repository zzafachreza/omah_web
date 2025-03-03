
<?php
       // GET MAN OUR
            $sqlMAN = "SELECT *,IF(jam_masuk >='08:00:00' AND jam_pulang <='22:00:00','NORMAL',IF(jam_masuk >'22:00:00' AND jam_pulang <='24:00:00','LEMBUR 1',IF(jam_masuk >'00:00:00' AND jam_pulang <='05:00:00','LEMBUR 2',''))) as kategori FROM data_absen a JOIN data_pengguna b ON a.fid_pengguna = b.id_pengguna JOIN data_jenispekerjaan c ON b.fid_jenispekerjaan = c.id_jenispekerjaan";

         $JUMLAH_MAN = $this->db->query("SELECT fid_pengguna FROM data_absen GROUP BY fid_pengguna,tanggal")->num_rows();

           $manJAM = 0;
            foreach($this->db->query($sqlMAN)->result() as $row){
            $no++;

        

              // $awal=$row->tanggal.' '.$row->jam_masuk;
              //   $waktuawal  = date_create($awal); //waktu di setting
              //   $akhir=$row->tanggal_pulang.' '.$row->jam_pulang;
              //   $waktuakhir = date_create($akhir); //2019-02-21 09:35 waktu sekarang
                
              //   $diff  = date_diff($waktuawal, $waktuakhir);
                          
              //   $manJAM += $row->jam_pulang==null?0:$diff->h+round($diff->i/60,2);

              if($row->kategori=='NORMAL'){
                $manJAM +=14;
              }elseif($row->kategori=='LEMBUR 1'){
                $manJAM +=2;
              }elseif($row->kategori=='LEMBUR 2'){
                $manJAM +=5;
              }else{
                 $manJAM +=0;
              }


              }


             $TOTAL_MANHOURS = $manJAM*$JUMLAH_MAN;
  
  

  $totalA = $this->db->query("SELECT * FROM data_pengguna a JOIN data_jenispekerjaan b ON a.fid_jenispekerjaan = b.id_jenispekerjaan WHERE nama_jenispekerjaan='Karyawan'")->num_rows();
  $totalB = $this->db->query("SELECT * FROM data_pengguna a JOIN data_jenispekerjaan b ON a.fid_jenispekerjaan = b.id_jenispekerjaan WHERE nama_jenispekerjaan!='Karyawan'")->num_rows();



  $totalAA = $this->db->query("SELECT * FROM data_pengguna a JOIN data_jenispekerjaan b ON a.fid_jenispekerjaan = b.id_jenispekerjaan WHERE fbh='FBH PASS' AND nama_jenispekerjaan='Karyawan'")->num_rows();
  $totalBB = $this->db->query("SELECT * FROM data_pengguna a JOIN data_jenispekerjaan b ON a.fid_jenispekerjaan = b.id_jenispekerjaan WHERE fbh='FBH PASS' AND nama_jenispekerjaan!='Karyawan'")->num_rows();


    $totalSEHATA = $this->db->query("SELECT * FROM data_pengguna a JOIN data_jenispekerjaan b ON a.fid_jenispekerjaan = b.id_jenispekerjaan WHERE status_kesehatan='Fit'")->num_rows();
  $totalSEHATB = $this->db->query("SELECT * FROM data_pengguna a JOIN data_jenispekerjaan b ON a.fid_jenispekerjaan = b.id_jenispekerjaan WHERE status_kesehatan='Unfit'")->num_rows();

    $totalSEHATC = $this->db->query("SELECT * FROM data_pengguna a JOIN data_jenispekerjaan b ON a.fid_jenispekerjaan = b.id_jenispekerjaan WHERE status_kesehatan='Observ'")->num_rows();



$unsafe = $this->db->query("SELECT jenis,COUNT(*) jumlah FROM `data_kondisi` GROUP BY jenis")->result();


  $totalRA = $this->db->query("SELECT * FROM data_request WHERE status_request='Sudah Verifikasi'")->num_rows();
  $totalRB = $this->db->query("SELECT * FROM data_request WHERE status_request='Belum Verifikasi'")->num_rows();



?>

<div class="container-fluid">

  <div class="row">



    <div class="col-sm-6">
       
       <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2">
                <div style="background-color: #295882;color: white;text-align: center;border-radius: 20px;padding: 10px;">
                    Jumlah Manpower
                </div>
                <div>
                  <canvas id="myChart"></canvas>
                </div>
            </div>
          </div>



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


    <div class="col-sm-6">

     <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2;overflow: hidden;">
              

                <div class="row" >
                  <div class="col-sm-6 pt-0" style="background-color: #658354;border-radius: 20px">
                       <div style="color: white;text-align: center;border-radius: 20px;padding: 10px;height: 100%;font-size: 30px">
                         Total Manhours : 
                </div>
                  </div>
                  <div class="col-sm-6 pt-3">
                      <center>
                        <strong><p style="font-size: 30px"><?php echo number_format($TOTAL_MANHOURS)  ?> Hours</strong>
                      </center>
                  </div>
                </div>
            </div>
          </div>
      
        <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2">
                <div style="background-color: #66BFFF;color: white;text-align: center;border-radius: 20px;padding: 10px;">
                   Total User : 
                </div>
                <div class="row" >
                  <div class="col-sm-6 pt-3">
                      <center>
                        <h4>Karyawan</h4>
                        <strong><p style="font-size: 30px"><?php echo number_format($totalA)  ?></strong>
                      </center>
                  </div>
                  <div class="col-sm-6 pt-3" style="border-left: 1px dashed #66BFFF">
                      <center>
                        <h4>Pekerja</h4>
                        <strong><p style="font-size: 30px"><?php echo number_format($totalB)  ?></strong>
                      </center>
                  </div>
                </div>
            </div>
          </div>



             <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2">
                <div style="background-color: #FF6258;color: white;text-align: center;border-radius: 20px;padding: 10px;">
                   FBH Pass :
                </div>
                <div class="row" >
                  <div class="col-sm-6 pt-3">
                      <center>
                        <h4>Karyawan</h4>
                        <strong><p style="font-size: 30px"><?php echo number_format($totalAA)  ?></strong>
                      </center>
                  </div>
                  <div class="col-sm-6 pt-3" style="border-left: 1px dashed #FF6258">
                      <center>
                        <h4>Pekerja</h4>
                        <strong><p style="font-size: 30px"><?php echo number_format($totalBB)  ?></strong>
                      </center>
                  </div>
                </div>
            </div>
          </div>


             <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2">
                <div style="background-color: #90DE64;color: white;text-align: center;border-radius: 20px;padding: 10px;">
                  Status Kesehatan :                </div>
                <div class="row" >
                  <div class="col-sm-4 pt-3">
                      <center>
                        <h4>Fit</h4>
                        <strong><p style="font-size: 30px"><?php echo number_format($totalSEHATA) ?></strong>
                      </center>
                  </div>
                  <div class="col-sm-4 pt-3" style="border-left: 1px dashed #90DE64">
                      <center>
                        <h4>Unfit</h4>
                        <strong><p style="font-size: 30px"><?php echo number_format($totalSEHATB) ?></strong>
                      </center>
                  </div>
                   <div class="col-sm-4 pt-3" style="border-left: 1px dashed #90DE64">
                       <center>
                        <h4>Observ</h4>
                        <strong><p style="font-size: 30px"><?php echo number_format($totalSEHATC) ?></strong>
                      </center>
                  </div>
                </div>
            </div>
          </div>




          <div style="padding: 10px;margin-bottom: 20px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 20px;background-color: #F2F2F2">
                <div style="background-color: #AB00BA;color: white;text-align: center;border-radius: 20px;padding: 10px;">
                  HSE Induction :

                               </div>
                <div class="row" >
                  <div class="col-sm-6 pt-3">
                      <center>
                        <h4>Diterima</h4>
                        <strong><p style="font-size: 30px"><?php echo number_format($totalRA) ?></strong>
                      </center>
                  </div>
                  <div class="col-sm-6 pt-3" style="border-left: 1px dashed #AB00BA">
                      <center>
                        <h4>Ditolak</h4>
                        <strong><p style="font-size: 30px"><?php echo number_format($totalRB) ?></strong>
                      </center>
                  </div>
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
print_r($LABELA);
print_r($VALUEA);
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



