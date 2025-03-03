<?php

class Pelamar_model extends CI_Model{

	function getData(){
		$sql ="SELECT * FROM pelamar";
		$data = $this->db->query($sql);
		return $data;
	}

	function insert(
	    
	        $nama_lengkap,
            $nama_panggilan,
            $email,
            $tempat_lahir,
            $tanggal_lahir,
            $nomor_ktp,
            $nomor_kk,
            $alamat,
            $alamat_sekarang,
            $profesi,
            $telepon,
            $tinggi_badan,
            $berat_badan,
            $umur,
            $mau_kerja_dimana,
            $takut_anjing,
            $kerja_diluar_negri,
            $pendidikan,
            $pengalaman,
            $pernikahan,
            $punya_anak,
            $agama,
            $suku,
            $inggris,
            $naik_motor,
            $bisa_masak,
            $bisa_asuh,
            $sebagai_apa,
            $hp_dapat_dihubungi,
            $referral,
            $gaji,
            $foto,
            $foto2
	    
	    ){

	 $sql ="INSERT INTO pelamar(
	        nama_lengkap,
            nama_panggilan,
            email,
            tempat_lahir,
            tanggal_lahir,
            nomor_ktp,
            nomor_kk,
            alamat,
            alamat_sekarang,
            profesi,
            telepon,
            tinggi_badan,
            berat_badan,
            umur,
            mau_kerja_dimana,
            takut_anjing,
            kerja_diluar_negri,
            pendidikan,
            pengalaman,
            pernikahan,
            punya_anak,
            agama,
            suku,
            inggris,
            naik_motor,
            bisa_masak,
            bisa_asuh,
            sebagai_apa,
            hp_dapat_dihubungi,
            referral,
            gaji,
            foto1,
            foto2
	        
	     ) values(
	         
	        '$nama_lengkap',
            '$nama_panggilan',
            '$email',
            '$tempat_lahir',
            '$tanggal_lahir',
            '$nomor_ktp',
            '$nomor_kk',
            '$alamat',
            '$alamat_sekarang',
            '$profesi',
            '$telepon',
            '$tinggi_badan',
            '$berat_badan',
            '$umur',
            '$mau_kerja_dimana',
            '$takut_anjing',
            '$kerja_diluar_negri',
            '$pendidikan',
            '$pengalaman',
            '$pernikahan',
            '$punya_anak',
            '$agama',
            '$suku',
            '$inggris',
            '$naik_motor',
            '$bisa_masak',
            '$bisa_asuh',
            '$sebagai_apa',
            '$hp_dapat_dihubungi',
            '$referral',
            '$gaji',
            '$foto',
            '$foto2'
            	         
	         
	         
	         )";

	 $this->db->query($sql);
	}

	function delete($id){
		$sql="DELETE FROM pelamar WHERE id='$id'";
		 $this->db->query($sql);
	}

	function getId($id){
		$sql = "SELECT * FROM pelamar WHERE  id='$id'";
		$data = $this->db->query($sql);
		return $data;
	}

	function update($id,$nama_lengkap,$username,$password,$level){

		if(!empty($password)){
			echo $sql= "UPDATE pelamar SET nama_lengkap='$nama_lengkap',username='$username',password='".sha1($password)."',level='$level' WHERE id='$id'";
		}else{
			echo $sql= "UPDATE pelamar SET nama_lengkap='$nama_lengkap',username='$username',level='$level' WHERE id='$id'";
		}
		
		$this->db->query($sql);	
	}

}