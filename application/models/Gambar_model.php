<?php

class Gambar_model extends CI_Model{

	function getData(){
		$sql ="SELECT *FROM data_gambar";
		$data = $this->db->query($sql);
		return $data;
	}

    function getId($id){
		$sql ="SELECT * FROM data_gambar WHERE id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}


	function insert($nama,$ket,$foto,$tipe){

	echo $sql ="INSERT INTO data_gambar(nama,ket,foto,tipe) values('$nama','$ket','$foto','$tipe')";

	 $this->db->query($sql);
	}

	function update($id,$nama,$foto,$ket,$tipe,$foto_old){

		if(!empty($foto)){
			 $sql= "UPDATE data_gambar SET nama='$nama',foto='$foto',ket='$ket',tipe='$tipe' WHERE id='$id'";
		}else{

			echo $sql= "UPDATE data_gambar SET nama='$nama',ket='$ket',tipe='$tipe' WHERE id='$id'";
		}
		
		$this->db->query($sql);	
	}


	
	function delete($id){
		$sql="DELETE FROM data_gambar WHERE id='$id'";
		 $this->db->query($sql);
	}



	

}