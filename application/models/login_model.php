<?php

/**
* 
*/
class Login_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function verificationLogin( $username , $password )
	{

		$this->db->select();
		$this->db->from('user_auth');
		$this->db->where('ua_username',$username);
		$this->db->where('ua_password',md5($password));
		return $this->db->get();
		
	}

	function validasiAgen( $nomorLisensi )
	{
		$this->db->select();
		$this->db->from('user');
		$this->db->where('user_nomorLisensi',$nomorLisensi);
		$result = $this->db->get();

		if ($result->num_rows() > 0)
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function checkUser( $userId )
	{
		$this->db->select();
		$this->db->from('user_auth');
		$this->db->where('ua_userId',$userId);
		return $this->db->get(); 
	}

	function dataUserId( $userId )
	{
		$this->db->select();
		$this->db->from('user');
		$this->db->where('user_id',$userId);
		return $this->db->get();
	}

}