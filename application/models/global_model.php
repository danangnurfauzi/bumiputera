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
	
	function kantorWilayah()
	{
		$this->db->select();
		$this->db->from('master_kantor');
		$this->db->group_by('k_kode_kantor_wilayah');
		return $this->db->get();
	}

	function agen()
	{
		$this->db->select('user_idPusat, user_namaAgen, user_namaJabatanAgen, user_nomorLisensi');
		$this->db->from('user');
		$this->db->join('master_kantor','k_kode = user_kodeKantor');
		$this->db->group_by('user_namaAgen');
		return $this->db->get();
	}

	function agenWilayah( $kode )
	{
		$this->db->select('user_idPusat, user_namaAgen, user_namaJabatanAgen, user_nomorLisensi');
		$this->db->from('user');
		$this->db->join('master_kantor','k_kode = user_kodeKantor');
		$this->db->where('k_kode_kantor_wilayah',$kode);
		$this->db->group_by('user_namaAgen');
		return $this->db->get();
	}

	function agenCabang( $kode )
	{
		$this->db->select('user_idPusat, user_namaAgen, user_namaJabatanAgen, user_nomorLisensi');
		$this->db->from('user');
		$this->db->where('user_kodeKantor',$kode);
		$this->db->group_by('user_namaAgen');
		return $this->db->get();
	}

	function agenPribadi( $id )
	{
		$this->db->select('user_namaAgen, user_namaJabatanAgen, user_nomorLisensi');
		$this->db->from('user');
		$this->db->where('user_idPusat',$id);
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

	function dataBawahan( $idPusat )
	{
		$this->db->select();
		$this->db->from('user');
		$this->db->where('user_nomorAgenInduk',$idPusat);
		return $this->db->get();
	}

	function dataKantorWilayah( $kode )
	{
		$this->db->select();
		$this->db->from('master_kantor');
		$this->db->where('k_kode_kantor_wilayah',$kode);
		return $this->db->get();
	}

	function dataKantorCabang( $kode )
	{
		$this->db->select();
		$this->db->from('master_kantor');
		$this->db->where('k_kode',$kode);
		return $this->db->get();
	}

}