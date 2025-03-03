<?php

class Hadiah_model extends CI_Model{

	function getData(){
		$sql ="SELECT * FROM data_hadiah";
		$data = $this->db->query($sql);
		return $data;
	}

    function getId($id){
		$sql ="SELECT * FROM data_hadiah WHERE id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}


	function insert(
	
	$nama,
    $point,
    $keterangan,
        
    $foto
	
	){

	echo $sql ="INSERT INTO data_hadiah(
	    
	    nama,
        point,
        keterangan,

        foto
	    ) values(
	        
	    '$nama',
        '$point',
        '$keterangan',
                    
            '$foto'
            	        
	        )";

	 $this->db->query($sql);
	}

	function update($id,
	
	$nama,
    $point,
    $keterangan,
                    
	
    $foto
	
	,$foto_old){

		if(!empty($foto)){
			 $sql= "UPDATE data_hadiah SET 
			 
		nama='$nama',
        point='$point',
        keterangan='$keterangan',
			 
			 
			 foto='$foto' WHERE id='$id'";
		}else{

			echo $sql= "UPDATE data_hadiah SET 
			
			    nama='$nama',
                point='$point',
                keterangan='$keterangan'
			
			WHERE id='$id'";
		}
		
		$this->db->query($sql);	
	}


	
	function delete($id){
		$sql="DELETE FROM data_hadiah WHERE id='$id'";
		 $this->db->query($sql);
	}



	

}