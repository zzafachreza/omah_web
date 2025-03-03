<?php

$sqlCom = "SELECT * FROM data_company limit 1";
$hasilCom = $this->db->query($sqlCom);

$comp = $hasilCom->result();


?>
<style>
  html{
    height: 100%;
  }
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;800&family=Poppins:wght@300;400;600&display=swap');
  a,h1,h6,i,p,span{
     font-family: 'Poppins', sans-serif;
 }
 .form-eza:focus {
      outline: none; 
  	 color: #000;
     border-bottom:1px solid #D01818;
     
     
 }
 

 
.form-eza {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border-bottom: 1px solid #ced4da;
    border-top: 0px;
    border-left: 0px;
    border-right: 0px;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-utama{
  background-color:<?php echo $comp[0]->warna_utama ?>;
  color:#FFF;
  order: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.btn-utama:hover{
  
  color:#FFF;
  }


 .bg-utama{
        background-color:<?php echo $comp[0]->warna_utama ?>;
        color:#FFF;
        border-radius:0px;
        
    }
    
    .text-utama{
        color:<?php echo $comp[0]->warna_utama ?>;
    }
    .bg-utama:hover{
       box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
       color:#FFF;
    }
    
  .bg-kedua{
        background-color:<?php echo $comp[0]->warna_kedua ?>;
        color:#FFF;
        border-radius:0px;
 
    }
    
    .text-kedua{
        color:<?php echo $comp[0]->warna_kedua ?>;
    }
    .bg-kedua:hover{
       box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }
    
    
    
    .bg-ketiga{
        background-color:<?php echo $comp[0]->warna_ketiga ?>;
        color:#FFF;
        border-radius:0px;
 
    }
    
    .text-ketiga{
        color:<?php echo $comp[0]->warna_ketiga ?>;
    }
    .bg-ketiga:hover{
        color:white;
       box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }
    
    

    
    .nav-item{
        padding-left:5%;
        /*border:1px solid black;*/
        margin-bottom:8%;
        border-radius:2px;
        font-size:small;
    }
    
</style> 
<body style="background-image: url('<?php echo  site_url("assets/images/bglogina.png") ?>');background-size: 100% 100%;background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
  
<div class="container-fluid"  >
    <?php if(!isDevice()){ ?>
<div class="row">

<div class="col col-sm-7" style="padding: 10px;display: flex;justify-content: center;align-items: center; ">
  <img src="<?php echo site_url('assets/images/loginic.svg') ?>" width="80%">
</div>
  <div class="col col-sm-5" id="myDiv" style="padding: 5%;background-color:<?php echo $comp[0]->warna_utama ?>;display: flex;align-items: center; ">
     <div class="card" style="padding: 20px;width: 100%">
        <center>
             <h2 class="text-utama">Masuk</h2>
      </center>

    <form id="newdataFormLogin"  >
      
      <div class="form-group">
        <label for="username" class="text-utama"><strong>Username</strong></label>
          <input required="required" type="text" name="username" autocomplete="off" autofocus="autofocus" class="form-control">
      </div>
       <div class="form-group">
        <label for="username" class="text-utama"><strong>Password</strong></label>
          <input required="required" type="password" name="password" autocomplete="off" class="form-control">
      </div>
    <div class="form-group">
        <button type="SUBMIT" class="btn btn-utama col-sm-12">Masuk</button>
        <p style="text-align: center;margin-top: 5%;margin-bottom: 5%;color: #ced4da">Atau</p>
        <a id="btnqr" class="btn btn-light col-sm-12">Masuk dengan QR COde</a>
        <!-- Index.html file -->
           <div id="my-qr-reader">
            </div>
    </div>
    </form> 
     </div>


  </div>
  
  </div>
<?php } ?>

 <?php if(isDevice()){ ?>

<div class="col col-sm-12" style="padding: 10px;display: flex;justify-content: center;align-items: center; ">
  <img src="<?php echo site_url('assets/images/loginic.svg') ?>" width="80%">
</div>
  <div class="col col-sm-12" id="myDiv" style="padding: 5%;background-color:<?php echo $comp[0]->warna_utama ?>;display: flex;align-items: center; ">
     <div class="card" style="padding: 20px;width: 100%">
        <center>
             <h2 class="text-utama">Masuk</h2>
      </center>

    <form id="newdataFormLogin"  >
      
      <div class="form-group">
        <label for="username" class="text-utama"><strong>Username</strong></label>
          <input required="required" type="text" name="username" autocomplete="off" autofocus="autofocus" class="form-control">
      </div>
       <div class="form-group">
        <label for="username" class="text-utama"><strong>Password</strong></label>
          <input required="required" type="password" name="password" autocomplete="off" class="form-control">
      </div>
    <div class="form-group">
        <button type="SUBMIT" class="btn btn-utama col-sm-12">Masuk</button>
        <p style="text-align: center;margin-top: 5%;margin-bottom: 5%;color: #ced4da">Atau</p>
        <a id="btnqr" class="btn btn-light col-sm-12">Masuk dengan QR COde</a>
        <!-- Index.html file -->
           <div id="my-qr-reader">
            </div>
    </div>
    </form> 
     </div>


  </div>
  
 
<?php } ?>
</div>
</body>
<script type="text/javascript">

   var tinggiLayar = $(window).innerHeight();


            // Mengatur tinggi div sesuai tinggi layar
            $('#myDiv').css({'height':tinggiLayar});

   function onScanSuccess(decodeText, decodeResult) {
        // alert("You Qr is : " + decodeText, decodeResult);

        $.ajax({
      method:'POST',
      url:'<?php echo site_url("loginuser/validasiqr") ?>',
      data:{
        nomor_id:decodeText
      },
      success:function(data){
        console.log(data)
        if(data==200){
       
        Swal.fire({
           position: "center",
          icon: "success",
          title:  "Berhasil masuk",
          showConfirmButton: false,
          timer: 1500
            })

        window.location.href='./';

        }else{
          Swal.fire({
           position: "center",
          icon: "error",
          title:  "QR Code tidak terdaftar !",
          showConfirmButton: false,
          timer: 1500
            })
        }
      }
    })

    }

   $("#btnqr").click(function(){
     let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbos: 250 }
    );
      htmlscanner.render(onScanSuccess);
   })


  $("#newdataFormLogin").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    console.log(data);
    $.ajax({
      method:'POST',
      url:'<?php echo site_url("loginuser/validasi") ?>',
      data:data,
      success:function(data){
        console.log(data)
        if(data==200){
       
        Swal.fire({
           position: "center",
          icon: "success",
          title:  "Berhasil masuk",
          showConfirmButton: false,
          timer: 1500
            })

        window.location.href='./';

        }else{
          Swal.fire({
           position: "center",
          icon: "error",
          title:  "Username atau password salah !",
          showConfirmButton: false,
          timer: 1500
            })
        }
      }
    })
  })
</script>