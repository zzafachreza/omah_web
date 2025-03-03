<?php

class Sub_kategori_model extends CI_Model{

	function getData(){
		$sql ="SELECT data_sub_kategori.id, nama_kategori,nama_sub_kategori,data_sub_kategori.foto,data_kategori.foto foto_kategori FROM data_sub_kategori join data_kategori on data_sub_kategori.id_kategori = data_kategori.id";
		$data = $this->db->query($sql);
	
		return $data;
	}

    function getId($id){
		$sql ="SELECT data_sub_kategori.id, nama_kategori,nama_sub_kategori,data_sub_kategori.foto,data_kategori.foto foto_kategori,data_kategori.id as id_kategori FROM data_sub_kategori join data_kategori on data_sub_kategori.id_kategori = data_kategori.id WHERE data_sub_kategori.id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}


	function insert(
	$id_kategori,
	$nama_sub_kategori,
        
    $foto
	
	){

	echo $sql ="INSERT INTO data_sub_kategori(
	     id_kategori,
	    nama_sub_kategori,
	   
	    
        foto
	    ) values(
	        '$id_kategori',
	    '$nama_sub_kategori',
                    
            '$foto'
            	        
	        )";
	        

	 $this->db->query($sql);
	}

	function update($id,
	$id_kategori,
	$nama_sub_kategori,
	
	
    $foto
	
	,$foto_old){

		if(!empty($foto)){
			 echo $sql= "UPDATE data_sub_kategori SET 
			 
			 id_kategori='$id_kategori',
		    nama_sub_kategori='$nama_sub_kategori',
			 
			 
			 foto='$foto' WHERE id='$id'";
		}else{


			echo $sql= "UPDATE data_sub_kategori SET 
			id_kategori='$id_kategori',
			    nama_sub_kategori='$nama_sub_kategori'
			
			WHERE id='$id'";
		}
		
		$this->db->query($sql);	  

	}
    
    
 
	
	function delete($id){
		$sql="DELETE FROM data_sub_kategori WHERE id='$id'";
		 $this->db->query($sql);
	}



	

}