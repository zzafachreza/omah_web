<?php

class Menu_model extends CI_Model{

	function getData(){
		$sql ="SELECT * FROM data_menu";
		$data = $this->db->query($sql);
		return $data;
	}

	function insert($nama){

	 $sql ="INSERT INTO data_menu(nama) values('$nama')";

	 $this->db->query($sql);
	}

	function delete($id){
		$sql="DELETE FROM data_menu WHERE id='$id'";
		 $this->db->query($sql);
	}

	function getId($id){
		$sql = "SELECT * FROM data_menu WHERE  id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}

	function update($id,$nama){

			$sql= "UPDATE data_menu SET nama='$nama' WHERE id='$id'";
	
		
		$this->db->query($sql);	
	}

}