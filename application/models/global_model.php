<?php

/**
* 
*/
class Global_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function namaKantor( $kode = null )
	{

		$this->db->select('user_kodeKantor, user_namaKantor');
		$this->db->from('user');
		if ($kode != null) 
		{
			$this->db->where('user_kodeKantor',$kode);
		}
		$this->db->group_by('user_kodeKantor');
		return $this->db->get();
		
	}

	function agen()
	{
		$this->db->select('user_namaAgen, user_namaJabatanAgen, user_nomorLisensi');
		$this->db->from('user');
		$this->db->group_by('user_namaAgen');
		return $this->db->get();
	}

}