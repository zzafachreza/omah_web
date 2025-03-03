<?php

class Company_model extends CI_Model{

	function getData(){
		$sql ="SELECT *FROM data_company";
		$data = $this->db->query($sql);
		return $data;
	}

    function getId($id){
		$sql ="SELECT * FROM data_company WHERE id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}


	function update($id,$nama,$foto,$deskripsi,$tlp,$foto_old,$alamat,$email){

		if(!empty($foto)){
			 $sql= "UPDATE data_company SET nama='$nama',foto='$foto',deskripsi='$deskripsi',tlp='$tlp',alamat='$alamat',email='$email' WHERE id='$id'";
		}else{

			echo $sql= "UPDATE data_company SET nama='$nama',deskripsi='$deskripsi',tlp='$tlp',alamat='$alamat',email='$email',toleransi='$toleransi' WHERE id='$id'";
		}
		

		$this->db->query($sql);	
	}


	
	function delete($id){
		$sql="DELETE FROM data_company WHERE id='$id'";
		 $this->db->query($sql);
	}



	

}