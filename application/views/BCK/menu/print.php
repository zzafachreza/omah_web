

<style>
    .page {
  width: 21cm;
  min-height: 29.7cm;
  padding: 2cm;
  margin: 1cm auto;
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
</style>

<div class="page">
    <?php
$id = $this->uri->segment(3);
$data = $this->db->query("SELECT * FROM data_$modul WHERE id_$modul='$id'")->row_object();

echo $data->render;
?>
</div>

<script>
    window.print();
</script>