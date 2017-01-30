<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller { 

	function __construct()
	{
		parent::__construct();	

		if ( ! isset($_SESSION['logged_in']) )
		{
			redirect();
		}

		$this->load->model(array('Global_model','Pempol_model','Kantor_model','Ssp_model'));

		$this->load->helper('Global_helper');
		
		$this->load->library('datatables');
		
		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{

		$role = $_SESSION['roleId'];

		$data['role'] = $role;

		switch ($role) {
			case '0':
				//print_r($_SESSION);
				$data['sidebarMain'] = 'active';

				$data['username'] = 'SUPERADMIN';

				$data['agen'] = $this->Global_model->agen()->num_rows(); 

				$data['namaKantor'] = $this->Global_model->kantorWilayah(); 
				
				$this->load->view('dashboard_pusat_view',$data);  

				break;

			case '9':

				$data['sidebarMain'] = 'active';

				$data['username'] = $_SESSION['username'];

				$data['namaKantor'] = $this->Global_model->dataKantorWilayah( $_SESSION['kodeKantorWilayah'] );
				
				$this->load->view('dashboard_wilayah_view',$data); 

				break;

			case '10':

				$data['sidebarMain'] = 'active';

				$data['username'] = $_SESSION['username'];

				$data['namaKantor'] = $this->Global_model->dataKantorCabang( $_SESSION['kodeKantor'] );
				
				$this->load->view('dashboard_cabang_view',$data); 

				break;
			
			default:

				$data['sidebarMain'] = 'active';

				$data['username'] = $_SESSION['username'];

				$data['bawahan'] = $this->Global_model->dataBawahan($_SESSION['idPusat']);

				$data['agen'] = $this->Global_model->agen()->num_rows();
				
				$data['namaAtasan'] = $this->Global_model->dataAgen( $_SESSION['nomorLisensi'] );
				
				$this->load->view('dashboard_view',$data);  
				
				break;
		}

		  
	}

	public function pempol()
	{
		
		//$data['kantor'] = $this->global_model->namaKantor();

		$data['username'] = $_SESSION['username'];

		$data['sidebarMain'] = 'active';

		$data['agen'] = $this->Global_model->agen()->num_rows();

		$data['pempol'] = $this->Global_model->listPempol();

        	$this->load->view('pempol_view',$data);    
		
	}

	function dataAgen()
	{

		$role = $_SESSION['roleId'];

		$data['role'] = $role;

		switch ($role) {
			case '0':
				$data['agen'] = $this->Global_model->agen();
				break;

			case '9':
				$kode = $_SESSION['kodeKantorWilayah'];
				$data['agen'] = $this->Global_model->agenWilayah( $kode );
				break;

			case '10':
				$kode = $_SESSION['kodeKantor'];
				$data['agen'] = $this->Global_model->agenCabang( $kode );
				//echo $this->db->last_query();exit;
				break;
			
			default:
				$data['agen'] = $this->Global_model->agenPribadi( $_SESSION['idPusat'] );
				break;
		}

		$data['sidebarAgen'] = 'active';

		$data['username'] = $_SESSION['username'];	
		
		$this->load->view('dataAgen_view',$data); 
		
	}

	function logout()
	{
		$this->db->set('ua_isLogin','0');
		$this->db->where('ua_id',$_SESSION['userAuthId']);
		$this->db->update('user_auth');
		
		session_destroy();
		redirect();
	}

	public function ajax_list()
    {
        $list = $this->Pempol_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pempol) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $pempol->r_nomorPolis;
            $row[] = $pempol->r_namaPempol;
            $row[] = $pempol->r_tanggalMulai;
            $row[] = $pempol->r_cbPremi;
            $row[] = $pempol->r_premiTopUp;
            $row[] = $pempol->r_premiAFYP;
            $row[] = $pempol->r_premiPokok;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Pempol_model->count_all(),
                        "recordsFiltered" => $this->Pempol_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_kantor()
    {
        $list = $this->Kantor_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kantor) {
            $no++;
            $row = array();
            $row[] = $kantor->k_kode;
            $row[] = $kantor->k_nama;
            $row[] = $kantor->k_kantor_wilayah;
            $row[] = $kantor->k_kode_kantor_wilayah;
            $row[] = $kantor->k_divisi;
            $row[] = $kantor->k_distribusi;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Kantor_model->count_all(),
                        "recordsFiltered" => $this->Kantor_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function modalPempol( $idPusat )
    {
    	$data['pempol'] = $this->db->query('SELECT * FROM report WHERE r_userIdPusat = '.$idPusat);
    	$this->load->view('modalPempol_view',$data); 
    }
    
    public function modalAgenWilayah( $kodeKantor )
    {
    	
    	$data['agen'] = $this->db->query('SELECT * FROM user WHERE user_kodeKantor = "'.$kodeKantor.'" GROUP BY user_idPusat');
    	$this->load->view('modalAgenWilayah_view',$data); 
    }
    
    public function modalAgenBawahan( $idPusat )
    {
    	$data['bawahan'] = $this->db->query('SELECT * FROM user WHERE user_nomorAgenInduk = "'.$idPusat.'"');
    	$this->load->view('modalAgenBawahan_view',$data);
    }
    
    public function modalAgenPempol( $idPusat )
    {
    	$data['pempol'] = $this->db->query('SELECT * FROM report INNER JOIN user ON user_idPusat = r_userIdPusat WHERE r_userIdPusat = '.$idPusat);
    	//echo $this->db->last_query();exit;
    	$this->load->view('modalAgenPempol_view',$data);
    }
    
    public function modalWilayahPempol( $kode )
    {
    	$data['pempol'] = $this->db->query('SELECT * FROM report LEFT JOIN user ON user_idPusat = r_userIdPusat WHERE r_kantorSKT = "'.$kode.'"');
    	//echo $this->db->last_query();exit;
    	$this->load->view('modalAgenPempol_view',$data);
    }
    
    public function pempolAgen()
    {
	$data['username'] = $_SESSION['username'];
	$data['pempol'] = $this->db->query('SELECT * FROM report INNER JOIN user ON user_idPusat = r_userIdPusat WHERE r_userIdPusat = '.$_SESSION['idPusat']);
    	$this->load->view('pempolAgen_view',$data); 
    }
    
    public function pempolWilayah()
    {
	$data['username'] = $_SESSION['username'];
	//$data['pempol'] = $this->db->query('SELECT * FROM report INNER JOIN user ON user_idPusat = r_userIdPusat INNER JOIN master_kantor ON k_kode = r_kantorSKT WHERE k_kode_kantor_wilayah = "'.$_SESSION['kodeKantorWilayah'].'"');
    	$this->load->view('pempolWilayah_view',$data); 
    }
    
    public function pempolCabang()
    {
	$data['username'] = $_SESSION['username'];
	$data['pempol'] = $this->db->query('SELECT * FROM report INNER JOIN user ON user_idPusat = r_userIdPusat WHERE r_kantorSKT = "'.$_SESSION['kodeKantor'].'"');
    	$this->load->view('pempolAgen_view',$data); 
    }
    
    public function jsonPempolWilayah()
    {
    	header('Content-Type: application/json');
        echo $this->Ssp_model->json();
    }
    
    function optionCabang()
	{
		$kodeWilayah = $_POST['kodeWilayah'];
		$data = $this->db->query("SELECT * FROM master_kantor WHERE k_kode_kantor_wilayah = '".$kodeWilayah."'");
		$html = '';
		$html = '<option></option>';
		foreach ($data->result() as $value)
		{
			$html .= '<option value='.$value->k_kode.'>'.$value->k_nama.'</option>';
		}
		echo $html;
	}
	
	function filterCabang()
	{
		//print_r($_POST);exit;
		$data['sidebarMain'] = 'active';

		$data['username'] = 'SUPERADMIN';

		$data['agen'] = $this->Global_model->agen()->num_rows(); 
		
		$data['namaKantor'] = $this->Global_model->kantorWilayah(); 

		$data['namaKantorCabang'] = $this->Global_model->dataKantorWilayah( $_POST['wil'] );
		
		
		$this->load->view('filterCabang_view',$data);  
	}

}
