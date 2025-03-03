<?php

class Brand_model extends CI_Model{

	function getData(){
		$sql ="SELECT * FROM data_brand";
		$data = $this->db->query($sql);
		return $data;
	}

    function getId($id){
		$sql ="SELECT * FROM data_brand WHERE id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}


	function insert(
	
	$nama,
        
    $foto
	
	){

	echo $sql ="INSERT INTO data_brand(
	    
	    nama,
	    
        foto
	    ) values(
	        
	    '$nama',
                    
            '$foto'
            	        
	        )";

	 $this->db->query($sql);
	}

	function update($id,
	
	$nama,
	
    $foto
	
	,$foto_old){

		if(!empty($foto)){
			 $sql= "UPDATE data_brand SET 
			 
		    nama='$nama',
			 
			 
			 foto='$foto' WHERE id='$id'";
		}else{

			echo $sql= "UPDATE data_brand SET 
			
			    nama='$nama'
			
			WHERE id='$id'";
		}
		
		$this->db->query($sql);	
	}


	
	function delete($id){
		$sql="DELETE FROM data_brand WHERE id='$id'";
		 $this->db->query($sql);
	}



	

}