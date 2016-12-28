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

	function listPempol()
	{
		$this->db->select();
		$this->db->from('report');
		$this->db->limit('1000');
		return $this->db->get();
	}

	function dataAgen( $nomorLisensi = null )
	{
		$this->db->select();
		$this->db->from('user');
		if ($nomorLisensi != null) 
		{
			$this->db->where('user_nomorLisensi',$nomorLisensi);
		}
		return $this->db->get();
	}

	function jabatan( $kode = null )
	{
		$this->db->select();
		$this->db->from('jabatan');
		if ($id != null)
		{
			$this->db->where('j_kode',$kode);
		}
		return $this->db->get();
	}

}