<?php

class Transaksi_model extends CI_Model{

	function getData(){
		$sql ="select penjualan_header.id,kode,tanggal,nama_bank,foto_bank,nama_pemesan,alamat_pemesan,telepon_pemesan,ongkir,grand,penjualan_header.bayar,total,token,penjualan_header.id_member,status from penjualan_header join member on member.id = penjualan_header.id_member ORDER BY penjualan_header.id DESC";
		$data = $this->db->query($sql);
		return $data;
	}

	function insert($nama_lengkap,$username,$password,$level){

	 $sql ="INSERT INTO transaksi(nama_lengkap,username,password,level) values('$nama_lengkap','$username','$password','$level')";

	 $this->db->query($sql);
	}

	function delete($kode){
		 $sql="DELETE FROM penjualan_header WHERE kode='$kode'";
		 $sql2="DELETE FROM penjualan_detail WHERE kode='$kode'";
		 $this->db->query($sql);
		 $this->db->query($sql2);
	}
	
	function updateStatus($kode){
// 		$sql="UPDATE penjualan_header SET status='SELESAI' WHERE kode='$kode'";
// 		 $this->db->query($sql);

            
            $sqlUpdStock="select * from penjualan_detail WHERE kode='$kode'";
            foreach($this->db->query($sqlUpdStock)->result() as $upd){
                $id_barang = $upd->id_barang;
                $qty = $upd->qty;
                $this->db->query("UPDATE data_barang SET stok=stok-$qty WHERE id='$id_barang'");
            }
            
        
	}
	
    
    function SimpanNotifikasi($id_member,$judul,$keterangan){
		$sql="INSERT INTO notifikasi(tanggal,judul,keterangan,id_member) VALUES(NOW(),'$judul','$keterangan','$id_member')";
		 $this->db->query($sql);
	}
	
	function updatePoint($id_member,$point){
	    $sql="UPDATE member SET point=point+$point WHERE id='$id_member'";
		 $this->db->query($sql);
	}
	
	

	function getId($id){
		$sql = "select penjualan_detail.id,penjualan_detail.kode,penjualan_detail.id_barang,penjualan_header.bayar,uom,ongkir,penjualan_detail.harga,penjualan_detail.qty,penjualan_detail.total subtotal,penjualan_header.foto as foto_bayar,data_barang.foto,nama_barang,uom,tanggal,nama_pemesan,alamat_pemesan,telepon_pemesan,status,penjualan_header.total from penjualan_detail join data_barang on data_barang.id = penjualan_detail.id_barang join penjualan_header on penjualan_header.kode = penjualan_detail.kode WHERE penjualan_detail.kode='$id'";
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