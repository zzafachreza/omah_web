<?php

class Content_model extends CI_Model{

	function getData(){
		$sql ="SELECT data_content.id,data_content.nama as nama_content,data_menu.nama as nama_menu,data_halaman.nama as nama_halaman,tipe,render,id_halaman FROM data_content JOIN data_halaman ON data_content.id_halaman = data_halaman.id JOIN data_menu ON data_menu.id = data_halaman.id_Menu";
		$data = $this->db->query($sql);
		return $data;
	}

	function insert($nama,$id_halaman,$tipe,$render){

	 $sql ="INSERT INTO data_content(nama,id_halaman,tipe,render) values('$nama','$id_halaman','$tipe','$render')";

	 $this->db->query($sql);
	}

	function delete($id){
		$sql="DELETE FROM data_content WHERE id='$id'";
		 $this->db->query($sql);
	}

	function getId($id){
		$sql ="SELECT data_content.id,data_content.nama as nama_content,data_menu.nama as nama_menu,data_halaman.nama as nama_halaman,tipe,render,id_halaman FROM data_content JOIN data_halaman ON data_content.id_halaman = data_halaman.id JOIN data_menu ON data_menu.id = data_halaman.id_Menu WHERE data_content.id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}

	function update($id,$nama,$id_halaman,$tipe,$render){

			$sql= "UPDATE data_content SET nama='$nama',id_halaman='$id_halaman',tipe='$tipe',render='$render' WHERE id='$id'";
	
		
		$this->db->query($sql);	
	}

}