<?php
error_reporting(0);

$id = $this->uri->segment(3);
$data = $this->db->query("SELECT * FROM data_$modul a JOIN data_pengguna b ON a.fid_pengguna = b.id_pengguna LEFT JOIN data_bank c ON a.fid_bank = c.id_bank JOIN data_bahanhijab d ON a.fid_bahanhijab = d.id_bahanhijab JOIN data_motifhijab e ON a.fid_motifhijab = e.id_motifhijab JOIN data_alamatpengguna f ON b.id_pengguna = f.fid_pengguna WHERE id_$modul='$id'")->row_object();

$nomor_pesanan = $data->nomor_pesanan;



  function Indonesia3Tgl($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}

function angkaTerbilang($x){
  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return angkaTerbilang($x - 10) . " Belas";
  elseif ($x < 100)
    return angkaTerbilang($x / 10) . " Puluh" . angkaTerbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . angkaTerbilang($x - 100);
  elseif ($x < 1000)
    return angkaTerbilang($x / 100) . " Ratus" . angkaTerbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . angkaTerbilang($x - 1000);
  elseif ($x < 1000000)
    return angkaTerbilang($x / 1000) . " Ribu" . angkaTerbilang($x % 1000);
  elseif ($x < 1000000000)
    return angkaTerbilang($x / 1000000) . " Juta" . angkaTerbilang($x % 1000000);
}


$comp = $this->db->query("SELECT * FROM data_company limit 1")->row_object();



$params['data'] = site_url('transaksi/print/'.$id);
$params['level'] = 'H';
$params['size'] = 10;
$params['savename'] = FCPATH.'barcode.png';
$this->ciqrcode->generate($params);


  ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
<style>
body {
  font-family: "Rubik", sans-serif;
  color: #212529;
  background: #F4F4F4; 
}   

.page {
    position:relative;
  width: 21cm;
  min-height: 29.7cm;
  padding: 1cm;
  margin: 0.5cm auto;
  border-radius: 5px;
  background: #FFFFFF;

}

    .table{
        border:1px solid black;
        border-collapse:collapse;
        -webkit-print-color-adjust: exact;
    }
div{
    -webkit-print-color-adjust: exact;
}

#footer{
    position: absolute;
    bottom: 10;
}
</style>

<div class="page">

	<center>
		 <img src="<?php echo site_url().$comp->foto ?>" width="250" />
		 <p style="line-height:8px"><?php echo $comp->alamat ?></p>
		  <p style="line-height:8px">Telepon : <strong><?php echo $comp->tlp ?></strong> | Email : <strong><?php echo $comp->email ?></strong></p>
	</center>
<table  width="100%" style="margin-top:50px;font-size:small" cellpadding="3">
         <tr>
            <td  style="font-weight:bold" width="10%">Date</td>
            <td width="2%">:</td>
            <td style="font-weight:bold"><?php echo Indonesia3Tgl($data->tanggal) ?></td>
            <td width="40%" rowspan="3" align="right">
                <p  style="line-height:0px;font-size:30pt;font-weight:bolder" >I  N  V  O  I  C  E</p>
                <p style="line-height:0px;font-size:11pt" >[ <strong><?php echo $data->jenis ?></strong> ] <?php echo $data->nomor_pesanan ?></p>
            </td>
        </tr>
         <tr>
            <td style="font-weight:bold" width="10%">ID No.</td>
            <td width="2%">:</td>
            <td style="font-weight:bold" ><?php echo $data->nomor_pesanan ?></td>
        </tr>
         <tr>
            <td style="font-weight:bold" width="10%">Customer</td>
            <td width="2%">:</td>
            <td style="font-weight:bold" ><?php echo $data->nama_lengkap ?></td>
        </tr>
         <tr>
            <td style="font-weight:bold" width="10%">Phone</td>
            <td width="2%">:</td>
            <td style="font-weight:bold" ><?php echo $data->telepon ?></td>
        </tr>
         <tr>
            <td valign="0" style="font-weight:bold" width="10%">Address</td>
            <td valign="0" width="2%">:</td>
            <td  style="font-weight:bold" ><?php echo ucwords(strtolower($data->alamat_lengkap)) ?><br/><?php echo ucwords(strtolower($data->alamat_bawaan)) ?></td>
        </tr>
         
    </table>
<div style="height:10px;background-color:#CA1F7B;margin-top:30px"></div>
              <table style="font-size:small;border-collapse:collapse;border-color:#CDCDCD;border-radius:10px" width="100%" border="0" cellpadding="5">
                 <thead>
                      <tr style="background-color:#FFFFFF;color:black;border-bottom:2px solid #CA1F7B">
               
                      <th>Bahan</th>
                      <th>Ukuran</th>
                      <th>Motif</th>
                       <th>Jumlah</th>
                      <th width="100">Total (Rp.)</th>

                  </tr>
                 </thead>
                
            

                        <tr style="background-color:#FFFFFF;color:black;border-bottom:2px solid #CDCDCD">
                         
                            <td align="center"><?php echo $data->nama_bahan ?></td>
                             <td align="center"><?php echo $data->size ?></td>
                                             <td align="center">
                                              <p>(<?php echo $data->nama_motif ?>)</p>
                                <img src="<?php echo site_url().$data->file_motifhijab ?>" height="50">
                            </td>
                                       <td align="center"><?php echo $data->qty ?></td>


                                       <td align="right"><?php echo number_format($data->total) ?></td>

                                    

                                  
                        </tr>


                   <tr class="bg-light">
                        <th colspan="3" align="right">Total</th>
                        <th colspan="2" style="text-align: right;"><strong><?php echo number_format($data->total) ?></strong></th>
                 
                    </tr>
                        <tr class="bg-light">
                        <th colspan="3" align="right">Terbilang</th>
                        <td  colspan="2" style="text-align: right;"><i><?php echo angkaTerbilang($data->total) ?> Rupiah</i></td>
                 
                    </tr>


               </table>


   			  <div id="footer">
                  <table width="100%" style="font-size:small;">

                  	<tr>
                  		<td width="640">
                  			<table width="100%" style="font-size:small">
						        <tr>
						        	<td width="2%">
						                <div style="width:10px;height:120px;background-color:black"></div>
						            </td>
						            <td align="left">
						                <h3>Metode Pembayaran</h3>
						                <p style="line-height:8px">Transfer ke <strong><?php echo $data->nama_bank ?></strong></p>
						                <p style="line-height:8px">Nomor Rekening : <strong><?php echo $data->nomor_rekening ?></strong></p>
						                <p style="line-height:8px">Atas Nama : <strong><?php echo $data->atas_nama ?></strong></p>
						     
						            </td>
						            
						        </tr>
		       					</table>

                  		</td>
                  		
                  		<td width="20%" align="right"><img src="<?php echo site_url('barcode.png') ?>" width="120"/></td>

                  	</tr>
                  	
                  </table>
                  
                   
              </div>
</div>

<script>
    // window.print();
</script>