<?php

class Artikel_model extends CI_Model{

	function getData(){
		$sql ="SELECT *FROM data_artikel";
		$data = $this->db->query($sql);
		return $data;
	}

    function getId($id){
		$sql ="SELECT * FROM data_artikel WHERE id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}


	function insert($judul,$penulis,$foto,$render){

	echo $sql ="INSERT INTO data_artikel(tanggal,judul,penulis,foto,render) values(NOW(),'$judul','$penulis','$foto','$render')";

	 $this->db->query($sql);
	}

	function update($id,$judul,$penulis,$render,$foto,$foto_old){

		if(!empty($foto)){
			 $sql= "UPDATE data_artikel SET judul='$judul',penulis='$penulis',render='$render',foto='$foto' WHERE id='$id'";
		}else{

			echo $sql= "UPDATE data_artikel SET judul='$judul',penulis='$penulis',render='$render' WHERE id='$id'";
		}
		
		$this->db->query($sql);	
	}


	
	function delete($id){
		$sql="DELETE FROM data_artikel WHERE id='$id'";
		 $this->db->query($sql);
	}



	

}