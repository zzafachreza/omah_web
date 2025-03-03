<?php

class Kategori_model extends CI_Model{

	function getData(){
		$sql ="SELECT * FROM data_kategori";
		$data = $this->db->query($sql);
		return $data;
	}

    function getId($id){
		$sql ="SELECT * FROM data_kategori WHERE id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}


	function insert(
	
	$nama_kategori,
        
    $foto
	
	){

	echo $sql ="INSERT INTO data_kategori(
	    
	    nama_kategori,
	    
        foto
	    ) values(
	        
	    '$nama_kategori',
                    
            '$foto'
            	        
	        )";

	 $this->db->query($sql);
	}

	function update($id,
	
	$nama_kategori,
	
    $foto
	
	,$foto_old){

		if(!empty($foto)){
			 $sql= "UPDATE data_kategori SET 
			 
		    nama_kategori='$nama_kategori',
			 
			 
			 foto='$foto' WHERE id='$id'";
		}else{

			echo $sql= "UPDATE data_kategori SET 
			
			    nama_kategori='$nama_kategori'
			
			WHERE id='$id'";
		}
		
		$this->db->query($sql);	
	}


	
	function delete($id){
		$sql="DELETE FROM data_kategori WHERE id='$id'";
		 $this->db->query($sql);
	}



	

}