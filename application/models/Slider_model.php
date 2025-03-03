<?php

class Slider_model extends CI_Model{

	function getData(){
		$sql ="SELECT *FROM data_slider";
		$data = $this->db->query($sql);
		return $data;
	}

    function getId($id){
		$sql ="SELECT * FROM data_slider WHERE id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}


	function insert($keterangan1,$keterangan2,$foto){

	echo $sql ="INSERT INTO data_slider(keterangan1,keterangan2,foto) values('$keterangan1','$keterangan2','$foto')";

	 $this->db->query($sql);
	}

	function update($id,$keterangan1,$keterangan2,$foto,$foto_old){

		if(!empty($foto)){
			 $sql= "UPDATE data_slider SET keterangan1='$keterangan1',keterangan2='$keterangan2',foto='$foto' WHERE id='$id'";
		}else{

			echo $sql= "UPDATE data_slider SET keterangan1='$keterangan1',keterangan2='$keterangan2' WHERE id='$id'";
		}
		
		$this->db->query($sql);	
	}


	
	function delete($id){
		$sql="DELETE FROM data_slider WHERE id='$id'";
		 $this->db->query($sql);
	}



	

}