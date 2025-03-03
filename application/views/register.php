
<div class="container">
  
<div class="row">
  <div class="col col-sm-12" style="padding: 5%;padding-left: 15%;padding-top: 5%;">

     <blockquote class="blockquote" style="margin-top: 5%">
         <h1>REGISTER</h1>
        <footer class="blockquote-footer"><a href="./login" style="text-decoration: none;" class="text-danger"><strong>back to login</strong></a></footer>
      </blockquote>
  </div>
   <div class="col col-sm-6">
    <center>
      <img src="assets/images/register.svg" width="100%" height="300" class="img">
    </center>
  </div>
  <div class="col col-sm-6">
    <form id="dataFormRegister" >

    	<div class="form-group col-sm-9">
        <label for="username" class="AppLabel">Nama Lengkap</label>
          <input required="required" type="text" name="nama_lengkap" autocomplete="off" autofocus="autofocus" class="form-control" placeholder="Masukan nama lengkap">
      </div>
      
      <div class="form-group col-sm-9">
        <label for="username" class="AppLabel">Username</label>

          <input required="required" type="text" name="username" autocomplete="off" autofocus="autofocus" class="form-control" placeholder="Masukan username">
      </div>
       <div class="form-group col-sm-9">
        <label for="username" class="AppLabel">Password</label>

          <input required="required" type="password" name="password" autocomplete="off" class="form-control" placeholder="Masukan password">
      </div>
 <div class="form-group col-sm-9">
     
        <button type="submit" class="btn btn-danger col-sm-12">Regsiter</button>
    </div>

    </form> 

    <!--  <div class="form-group col-sm-9">

        <button class="AppButton-secondary col-sm-12" onclick="window.location.href='./register'">Register</button>
      </div> -->

  </div>
  <div class="col-sm-12">
   <center>
        <blockquote class="blockquote text-center" style="margin-top: 5%">
       <p class="mb-0">~<?php echo $company[0]['nama'] ?></p>
        <footer class="blockquote-footer">www.<?php echo $_SERVER['HTTP_HOST'] ?> &copy  <cite title="Source Title"><?php echo date('Y') ?></cite></footer>
      </blockquote>
  </center>
  </div>
</div>

