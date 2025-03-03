<?php

class Barang_model extends CI_Model{

	function getData(){
		$sql ="SELECT * FROM data_barang";
		$data = $this->db->query($sql);
		return $data;
	}

    function getId($id){
		$sql ="SELECT * FROM data_barang WHERE id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}


	function insert(
	
	$nama_barang,
	$stok,
    $foto
	
	){

	echo $sql ="INSERT INTO data_barang(
	    nama_barang,
	    stok,
        foto
	    ) values(
	        
	        '$nama_barang',
	        '$stok',
            '$foto'
            	        
	        )";

	 $this->db->query($sql);
	}

	function update($id,
	
	$nama_barang,
	$stok,
    $foto
	
	,$foto_old){

		if(!empty($foto)){
			 $sql= "UPDATE data_barang SET 
			 
			nama_barang='$nama_barang',
						stok='$stok',
      
			 
			 
			 foto='$foto' WHERE id='$id'";
		}else{

			echo $sql= "UPDATE data_barang SET 
			
			    	nama_barang='$nama_barang',
			    	stok='$stok'
			    	
			WHERE id='$id'";
		}
		
		$this->db->query($sql);	
	}


	
	function delete($id){
		$sql="DELETE FROM data_barang WHERE id='$id'";
		 $this->db->query($sql);
	}



	

}