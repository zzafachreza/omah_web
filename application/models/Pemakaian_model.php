<?php

class Pemakaian_model extends CI_Model{

	function getData(){
		$sql ="select data_pemakaian.id,tanggal,data_pemakaian.id_barang,data_pemakaian.harga,data_pemakaian.qty,data_pemakaian.total,nama_barang,uom,foto from data_pemakaian join data_barang on data_barang.id = data_pemakaian.id_barang";
		$data = $this->db->query($sql);
		return $data;
	}

	function insert($nama_lengkap,$username,$password,$level){

	 $sql ="INSERT INTO transaksi(nama_lengkap,username,password,level) values('$nama_lengkap','$username','$password','$level')";

	 $this->db->query($sql);
	}

	function delete($kode){
		 $sql="DELETE FROM data_pemakaian WHERE id='$kode'";
		 $this->db->query($sql);
	}
	
	function updateStatus($kode){
		$sql="UPDATE penjualan_header SET status='SELESAI' WHERE kode='$kode'";
		 $this->db->query($sql);
	}
	
    
    function SimpanNotifikasi($id_member,$judul,$keterangan){
		$sql="INSERT INTO notifikasi(tanggal,judul,keterangan,id_member) VALUES(NOW(),'$judul','$keterangan','$id_member')";
		 $this->db->query($sql);
	}
	
	

	function getId($id){
		$sql = "select penjualan_detail.id,penjualan_detail.kode,penjualan_detail.id_barang,uom,penjualan_detail.harga,penjualan_detail.qty,penjualan_detail.total subtotal,data_barang.foto,nama_barang,uom,tanggal,nama_pemesan,alamat_pemesan,telepon_pemesan,status,penjualan_header.total,penjualan_header.foto foto_bukti from penjualan_detail join data_barang on data_barang.id = penjualan_detail.id_barang join penjualan_header on penjualan_header.kode = penjualan_detail.kode WHERE penjualan_detail.kode='$id'";
		$data = $this->db->query($sql);
		return $data;
	}

	function update($id,$nama_lengkap,$username,$password,$level){

		if(!empty($password)){
			echo $sql= "UPDATE transaksi SET nama_lengkap='$nama_lengkap',username='$username',password='".sha1($password)."',level='$level' WHERE id='$id'";
		}else{
			echo $sql= "UPDATE transaksi SET nama_lengkap='$nama_lengkap',username='$username',level='$level' WHERE id='$id'";
		}
		
		$this->db->query($sql);	
	}

}