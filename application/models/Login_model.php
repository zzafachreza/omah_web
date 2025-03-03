<?php

class Login_model extends CI_Model{

	function getUser($username,$password){

		$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
		$data = $this->db->query($sql);
		return $data;

	}

	



}