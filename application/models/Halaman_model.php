<?php

class Halaman_model extends CI_Model{

	function getData(){
		$sql ="SELECT data_halaman.id,data_halaman.nama as nama_halaman,data_menu.nama as nama_menu FROM data_halaman JOIN data_menu ON data_halaman.id_menu = data_menu.id WHERE data_halaman.id_Menu";
		$data = $this->db->query($sql);
		return $data;
	}

	function getDataProduct(){
		$sql ="SELECT data_halaman.id,data_halaman.nama as nama_halaman,data_menu.nama as nama_menu FROM data_halaman JOIN data_menu ON data_halaman.id_menu = data_menu.id WHERE data_halaman.id_Menu";
		$data = $this->db->query($sql);
		return $data;
	}

	function insert($nama,$id_menu){

	 $sql ="INSERT INTO data_halaman(nama,id_menu) values('$nama','$id_menu')";

	 $this->db->query($sql);
	}

	function delete($id){
		$sql="DELETE FROM data_halaman WHERE id='$id'";
		 $this->db->query($sql);
	}

	function getId($id){
		$sql = "SELECT * FROM data_halaman WHERE  id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}

	function update($id,$nama,$id_menu){

			$sql= "UPDATE data_halaman SET nama='$nama',id_menu='$id_menu' WHERE id='$id'";
	
		
		$this->db->query($sql);	
	}

}