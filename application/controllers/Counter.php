<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Counter extends CI_Controller { 

	function __construct()
	{
		parent::__construct();
		
	}

	function jumlahAgenWilayah( $kode )
	{
		
		$query = $this->db->query('SELECT COUNT(user_id) AS JUMLAH FROM master_kantor INNER JOIN user ON k_kode = user_kodeKantor WHERE k_kode_kantor_wilayah = "'.$kode.'"');

		echo $query->row()->JUMLAH ;
	}

	function jumlahSPWilayah( $kode )
	{
		$query = $this->db->query("SELECT COUNT(r.r_nomorPolis) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode_kantor_wilayah = '".$kode."'");

		echo number_format($query->row()->JUMLAH);
	}

	function jumlahUPWilayah( $kode )
	{
		$query = $this->db->query("SELECT SUM(r.r_premiPokok) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode_kantor_wilayah = '".$kode."'");

		echo number_format($query->row()->JUMLAH);
	}

	function jumlahPPWilayah( $kode )
	{
		$query = $this->db->query("SELECT SUM(r.r_premiPokok) AS JUMLAH_PREMI_POKOK , SUM(r.r_premiTopUp) AS JUMLAH_PREMI_TOP_UP FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode_kantor_wilayah = '".$kode."'");

		echo number_format($query->row()->JUMLAH_PREMI_POKOK + $query->row()->JUMLAH_PREMI_TOP_UP);
	}

	function jumlahAgenCabang( $kode )
	{
		
		$query = $this->db->query('SELECT COUNT(user_id) AS JUMLAH FROM master_kantor INNER JOIN user ON k_kode = user_kodeKantor WHERE k_kode = "'.$kode.'"');

		echo $query->row()->JUMLAH ;
	}

	function jumlahSPCabang( $kode )
	{
		$query = $this->db->query("SELECT COUNT(r.r_nomorPolis) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode = '".$kode."'");

		echo number_format($query->row()->JUMLAH);
	}

	function jumlahUPCabang( $kode )
	{
		$query = $this->db->query("SELECT SUM(r.r_premiPokok) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode = '".$kode."'");

		echo number_format($query->row()->JUMLAH);
	}

	function jumlahPPCabang( $kode )
	{
		$query = $this->db->query("SELECT SUM(r.r_premiPokok) AS JUMLAH_PREMI_POKOK , SUM(r.r_premiTopUp) AS JUMLAH_PREMI_TOP_UP FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode = '".$kode."'");

		echo number_format($query->row()->JUMLAH_PREMI_POKOK + $query->row()->JUMLAH_PREMI_TOP_UP);
	}

	function jumlahAgenPusat( $kode = '' )
	{
		
		if ( $kode == '') 
		{
			$query = $this->db->query('SELECT COUNT(user_id) AS JUMLAH FROM master_kantor INNER JOIN user ON k_kode = user_kodeKantor');
		}
		else
		{
			$query = $this->db->query('SELECT COUNT(user_id) AS JUMLAH FROM master_kantor INNER JOIN user ON k_kode = user_kodeKantor WHERE k_kode_kantor_wilayah = "'.$kode.'"');
		}

		echo $query->row()->JUMLAH ;
	}

	function jumlahSPPusat( $kode = '' )
	{
		
		if ( $kode == '')
		{
			$query = $this->db->query("SELECT COUNT(r.r_nomorPolis) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT");
		}
		else
		{
			$query = $this->db->query("SELECT COUNT(r.r_nomorPolis) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode_kantor_wilayah = '".$kode."'");
		}

		echo number_format($query->row()->JUMLAH);
	}

	function jumlahUPPusat( $kode = '' )
	{
		
		if ( $kode == '') 
		{
			$query = $this->db->query("SELECT SUM(r.r_premiPokok) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT");
		}
		else
		{
			$query = $this->db->query("SELECT SUM(r.r_premiPokok) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode_kantor_wilayah = '".$kode."'");
		}
		

		echo number_format($query->row()->JUMLAH);
	}

	function jumlahPPPusat( $kode = '' )
	{
		
		if ( $kode == '' ) 
		{
			$query = $this->db->query("SELECT SUM(r.r_premiPokok) AS JUMLAH_PREMI_POKOK , SUM(r.r_premiTopUp) AS JUMLAH_PREMI_TOP_UP FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT");
		}
		else
		{
			$query = $this->db->query("SELECT SUM(r.r_premiPokok) AS JUMLAH_PREMI_POKOK , SUM(r.r_premiTopUp) AS JUMLAH_PREMI_TOP_UP FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode_kantor_wilayah = '".$kode."'");
		}

		echo number_format($query->row()->JUMLAH_PREMI_POKOK + $query->row()->JUMLAH_PREMI_TOP_UP);
	}

	function jumlahSPTenagaPemasar( $nomorLisensi )
	{
		
		$query = $this->db->query("SELECT COUNT(r.r_nomorPolis) AS JUMLAH FROM report r WHERE r_nomorLisensi = ".$nomorLisensi);

		echo number_format($query->row()->JUMLAH);
	}

	function jumlahUPTenagaPemasar( $nomorLisensi = '' )
	{
		
		$query = $this->db->query("SELECT SUM(r.r_premiPokok) AS JUMLAH FROM report r WHERE r_nomorLisensi = ".$nomorLisensi);
		
		echo number_format($query->row()->JUMLAH);
	}

}
