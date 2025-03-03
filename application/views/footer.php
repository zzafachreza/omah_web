
<!-- IF DESKTOP -->
<?php if(!isDevice()){ ?>

    </div>
  </div>
</div>

  <script type="text/javascript">
      

  var height = window.innerHeight;
  let zoom = (( window.outerWidth - 10 ) / window.innerWidth) * 100;
    console.log(zoom);

    $(".SIDEMENU").css({height:height+'px',overflow:'auto'});
 
    </script>

 <?php } ?>
 <!-- END DEKTOP -->

</body>
   <script src="https://zavalabs.com/simple.money.format.js"></script>

</html>
<script>

	<?php if($this->session->flashdata('import')){ ?>


Swal.fire({
   position: "top-end",
  icon: "success",
  title: "<?php echo $this->session->flashdata('import'); ?>",
  showConfirmButton: false,
  timer: 1500
    })
<?php } ?>

<?php if($this->session->flashdata('update')){ ?>
Swal.fire({
   position: "center",
  icon: "success",
  title:  "<?php echo $this->session->flashdata('update'); ?>",
  showConfirmButton: false,
  timer: 1500
    })
<?php } ?>

<?php if($this->session->flashdata('pdf')){ ?>
Swal.fire(
     'Successfully',
      '<?php echo $this->session->flashdata('pdf'); ?>',
      'success'
    )
<?php } ?>

<?php if($this->session->flashdata('error')){ ?>
Swal.fire({
   position: "center",
  icon: "error",
  title:  "<?php echo $this->session->flashdata('error'); ?>",
  showConfirmButton: false,
  timer: 1500
    })
<?php } ?>


        $('.summernote').summernote();


 $('.uang').simpleMoneyFormat();
</script>