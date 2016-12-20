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

}