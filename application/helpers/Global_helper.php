<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function jumlahAgenPerWilayah( $kode )
{
    $ci=& get_instance();
    $ci->load->database(); 

    $sql = "SELECT COUNT(user_id) AS JUMLAH FROM master_kantor k INNER JOIN user u ON k.k_kode = u.user_kodeKantor WHERE k_kode = '".$kode."'"; 
    $query = $ci->db->query($sql);
    $row = $query->row()->JUMLAH;

    echo $row;
}  

function jumlahPremiAFYPPerWilayah( $kode )
{
    $ci=& get_instance();
    $ci->load->database(); 

    $sql = "SELECT SUM(r.r_premiAFYP) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode = '".$kode."'"; 
    $query = $ci->db->query($sql);
    $row = $query->row()->JUMLAH;

    return $row;
}

function jumlahSPPerWilayah( $kode )
{
    $ci=& get_instance();
    $ci->load->database(); 

    $sql = "SELECT COUNT(r.r_nomorPolis) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode = '".$kode."'"; 
    $query = $ci->db->query($sql);
    $row = $query->row()->JUMLAH;

    echo $row;
} 

function jumlahPremiPokokPerWilayah( $kode )
{
    $ci=& get_instance();
    $ci->load->database(); 

    $sql = "SELECT SUM(r.r_premiPokok) AS JUMLAH FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode = '".$kode."'"; 
    $query = $ci->db->query($sql);
    $row = $query->row()->JUMLAH;

    return $row;
} 

function jumlahPPPerWilayah( $kode )
{
    $ci=& get_instance();
    $ci->load->database(); 

    $sql = "SELECT SUM(r.r_premiPokok) AS JUMLAH_PREMI_POKOK , SUM(r.r_premiTopUp) AS JUMLAH_PREMI_TOP_UP FROM master_kantor k INNER JOIN report r ON k.k_kode = r.r_kantorSKT WHERE k_kode = '".$kode."'"; 
    $query = $ci->db->query($sql);
    $row = $query->row()->JUMLAH_PREMI_POKOK + $query->row()->JUMLAH_PREMI_TOP_UP;

    return $row;
}

function jumlahOrganisasiAgen( $idPusat )
{
	$ci=& get_instance();
	$ci->load->database();
	
	$sql = "SELECT COUNT(user_idPusat) AS JUMLAH FROM user WHERE user_nomorAgenInduk = ".$idPusat;
	$query = $ci->db->query($sql);
	$row = $query->row()->JUMLAH;

	return $row;
}

function totalProduksi( $idPusat )
{
	$ci=& get_instance();
	$ci->load->database();
	
	$sql = "SELECT COUNT(r_userIdPusat) AS JUMLAH FROM user INNER JOIN report ON r_userIdPusat = user_idPusat WHERE (user_nomorAgenInduk = ".$idPusat." OR user_idPusat = ".$idPusat.")";
	$query = $ci->db->query($sql);
    	$row = $query->row()->JUMLAH;

    	return $row;
}