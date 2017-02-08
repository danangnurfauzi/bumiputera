<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Ssp_model extends CI_Model
{
	function ssp($aColumns, $sWhere, $sOrder, $sLimit)
	{
	    $query = $this->db->query("
	        SELECT * FROM (
	            SELECT * FROM report INNER JOIN user ON user_idPusat = r_userIdPusat INNER JOIN master_kantor ON k_kode = r_kantorSKT WHERE k_kode_kantor_wilayah = '".$_SESSION['kodeKantorWilayah']."'
	        ) A
	        $sWhere
	        $sOrder
	        $sLimit
	    ");
	    
	    return $query;
	}
	
	function ssp_total($sIndexColumn, $sWhere, $sOrder){
	    $query = $this->db->query("
	        SELECT $sIndexColumn
	        FROM (
	           SELECT * FROM report INNER JOIN user ON user_idPusat = r_userIdPusat INNER JOIN master_kantor ON k_kode = r_kantorSKT WHERE k_kode_kantor_wilayah = '".$_SESSION['kodeKantorWilayah']."'
	        ) A
	        $sWhere
	        $sOrder
	    ");
	    
	    return $query;
	}
	
	function json( $kodeKantorWilayah ) {
        $this->datatables->select('r_nomorPolis, r_namaPempol, k_nama, r_cbPremi, r_tanggalMulai, r_premiPokok, r_premiAFYP, r_premiTopUp , (r_premiTopUp + r_premiPokok) AS PP');
        $this->datatables->from('report');
        $this->datatables->join('master_kantor','r_kantorSKT = k_kode');
        $this->datatables->where('k_kode_kantor_wilayah',$kodeKantorWilayah);
        //$this->datatables->add_column('view', '<a href="world/edit/$1">edit</a> | <a href="world/delete/$1">delete</a>', 'ID');
        return $this->datatables->generate();
    }

    function jsonDataAgen()
    {
    	$this->datatables->select('user_idPusat, user_namaAgen, user_namaJabatanAgen, user_nomorLisensi');
		$this->datatables->from('user');
		$this->datatables->join('master_kantor','k_kode = user_kodeKantor');
		$this->datatables->group_by('user_namaAgen');
		return $this->datatables->generate();
    }

    function jsonDataAgenCabang($cabang)
    {
    	$this->datatables->select('user_idPusat, user_namaAgen, user_namaJabatanAgen, user_nomorLisensi');
		$this->datatables->from('user');
		$this->datatables->join('master_kantor','k_kode = user_kodeKantor');
		$this->datatables->where('user_kodeKantor',$cabang);
		$this->datatables->group_by('user_namaAgen');
		return $this->datatables->generate();
    }
}
?>