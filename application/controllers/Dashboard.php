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
				
				$data['sidebarAgen'] = 'active';

				$data['username'] = $_SESSION['username'];	

				$data['namaKantor'] = $this->Global_model->kantorWilayah(); 
				
				$this->load->view('dataAgenPusat_view',$data); 

				break;

			case '9':
				$kode = $_SESSION['kodeKantorWilayah'];
				$data['agen'] = $this->Global_model->agenWilayah( $kode );
				break;

			case '10':
				$kode = $_SESSION['kodeKantor'];
				
				$data['agen'] = $this->Global_model->agenCabang( $kode );
				
				$data['sidebarAgen'] = 'active';

				$data['username'] = $_SESSION['username'];	
				
				$this->load->view('dataAgen_view',$data); 
				break;
			
			default:
				$data['agen'] = $this->Global_model->agenPribadi( $_SESSION['idPusat'] );

				$data['sidebarAgen'] = 'active';

				$data['username'] = $_SESSION['username'];	
				
				$this->load->view('dataAgen_view',$data); 
				break;
		}
		
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
	
    	$this->load->view('pempolWilayah_view',$data); 
    }
    
    public function pempolCabang()
    {
	$data['username'] = $_SESSION['username'];
	$data['pempol'] = $this->db->query('SELECT * FROM report INNER JOIN user ON user_idPusat = r_userIdPusat WHERE r_kantorSKT = "'.$_SESSION['kodeKantor'].'"');
    	$this->load->view('pempolAgen_view',$data); 
    }
    
    public function jsonPempolWilayah( $kodeKantorWilayah )
    {
    	header('Content-Type: application/json');
        echo $this->Ssp_model->json( $kodeKantorWilayah );
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
	
	function filterCabang( $posisi , $kode )
	{
		//print_r($_POST);exit;
		$data['sidebarMain'] = 'active';

		$data['username'] = 'SUPERADMIN';

		switch ($posisi) {

			case 'wilayah':

				$data['namaKantor'] = $this->Global_model->kantorWilayah(); 

				$data['namaKantorCabang'] = $this->Global_model->dataKantorWilayah( $kode );

				$data['wilayah'] = $kode;

				$data['posisi'] = $posisi;
				
				break;
			
			case 'cabang':

				$data['namaKantor'] = $this->Global_model->kantorWilayah(); 

				$data['namaKantorCabang'] = $this->Global_model->dataKantorCabang( $kode );

				$data['wilayah'] = $kode;

				$data['posisi'] = $posisi;
				
				break;

		}
		
		$this->load->view('filterCabang_view',$data);  
	}

	function postFilterCabang()
	{
		
		//print_r( $_POST );exit;
		$wil = $_POST['wil'];

		if ( isset( $_POST['cab'] ) )
		{
			$cab = $_POST['cab'];
		}
		else
		{
			$cab = null;
		}

		if ( $cab == null)
		{
			redirect('dashboard/filterCabang/wilayah/'.$wil);
		}
		else
		{
			redirect('dashboard/filterCabang/cabang/'.$cab);
		}

	}

	function filterCabangAgen( $posisi , $kode )
	{
		$cabang = $kode;

		$data['cabang'] = $cabang;
				
		$data['sidebarAgen'] = 'active';

		$data['username'] = $_SESSION['username'];	

		$data['namaKantor'] = $this->Global_model->kantorWilayah(); 

		switch ($posisi){

			case 'wilayah':
				
				$data['agen'] = $this->Global_model->agenWilayah( $cabang );

				break;
			
			case 'cabang':

				$data['agen'] = $this->Global_model->agenCabang( $cabang );
				
				break;
		}
		
		$this->load->view('filterCabangAgen_view',$data);  
	}

	function postFilterCabangAgen()
	{
		
		$wil = $_POST['wil'];

		if ( isset( $_POST['cab'] ) )
		{
			$cab = $_POST['cab'];
		}
		else
		{
			$cab = null;
		}

		if ($cab == null)
		{
			redirect('dashboard/filterCabangAgen/wilayah/'.$wil);
		}
		else
		{
			redirect('dashboard/filterCabangAgen/cabang/'.$_POST['cab']);
		}

	}

	function jsonDataAgen()
	{
		header('Content-Type: application/json');
        echo $this->Ssp_model->jsonDataAgen();
	}

	function jsonDataAgenCabang($cab)
	{
		header('Content-Type: application/json');
        echo $this->Ssp_model->jsonDataAgenCabang($cab);
	}

	function linkAgenJumlahOrganisasi()
	{
		$id = $_POST['idPusat'];

		echo "<a data-toggle='modal' data-target='#myModal' href='".site_url('dashboard/modalAgenBawahan/'.$id)."' > ".jumlahOrganisasiAgen($id) ."</a>";
	}

	function linkAgenTotalProduksi()
	{
		$id = $_POST['idPusat'];

		echo totalProduksi($id);
	}

	function pencarianData()
	{
		$data['sidebarMain'] = 'active';

		$data['username'] = 'SUPERADMIN';

		$data['namaKantor'] = $this->Global_model->kantorWilayah(); 
		
		$this->load->view('pencarianData_view',$data);  
	}

	function berlaku( $jenis , $kode , $status )
	{
		$tanggal = $_POST['tanggal'];
		switch ($jenis) {
			case 'agen':
				
				if ( $status == 1 )
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "AGN" AND user_statusKadaluarsa = "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}
				else
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "AGN" AND user_statusKadaluarsa <> "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}

				if ($hasil->num_rows() > 0)
				{
					echo $hasil->row()->JUMLAH;
				}
				else
				{
					echo '0';
				}

				break;
			
			case 'ak':
				
				if ( $status == 1 )
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "AKO" AND user_statusKadaluarsa = "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}
				else
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "AKO" AND user_statusKadaluarsa <> "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}

				if ($hasil->num_rows() > 0)
				{
					echo $hasil->row()->JUMLAH;
				}
				else
				{
					echo '0';
				}

				break;

			case 'ram':
				
				if ( $status == 1 )
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "RAM" AND user_statusKadaluarsa = "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}
				else
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "RAM" AND user_statusKadaluarsa <> "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}

				if ($hasil->num_rows() > 0)
				{
					echo $hasil->row()->JUMLAH;
				}
				else
				{
					echo '0';
				}

				break;

			case 'sam':
				
				if ( $status == 1 )
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "SAM" AND user_statusKadaluarsa = "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}
				else
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "SAM" AND user_statusKadaluarsa <> "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}

				if ($hasil->num_rows() > 0)
				{
					echo $hasil->row()->JUMLAH;
				}
				else
				{
					echo '0';
				}

				break;

			case 'am':
				
				if ( $status == 1 )
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "AM" AND user_statusKadaluarsa = "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}
				else
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "AM" AND user_statusKadaluarsa <> "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}

				if ($hasil->num_rows() > 0)
				{
					echo $hasil->row()->JUMLAH;
				}
				else
				{
					echo '0';
				}

				break;

			case 'um':
				
				if ( $status == 1 )
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "UM" AND user_statusKadaluarsa = "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}
				else
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "UM" AND user_statusKadaluarsa <> "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}

				if ($hasil->num_rows() > 0)
				{
					echo $hasil->row()->JUMLAH;
				}
				else
				{
					echo '0';
				}

				break;

			case 'fc':
				
				if ( $status == 1 )
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "FC" AND user_statusKadaluarsa = "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}
				else
				{
					$hasil = $this->db->query('
												SELECT k_kode_kantor_wilayah, user_kodeJabatanAgen, COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_kodeJabatanAgen = "FC" AND user_statusKadaluarsa <> "BELUM KADALUARSA"
												GROUP BY k_kode_kantor_wilayah, user_kodeJabatanAgen
											');
				}

				if ($hasil->num_rows() > 0)
				{
					echo $hasil->row()->JUMLAH;
				}
				else
				{
					echo '0';
				}

				break;

			case 'jumlah':
				
				if ( $status == 1 )
				{
					$hasil = $this->db->query('
												SELECT COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_statusKadaluarsa = "BELUM KADALUARSA"
											');
				}
				else
				{
					$hasil = $this->db->query('
												SELECT COUNT(user_id) AS JUMLAH
												FROM user
												INNER JOIN master_kantor ON user_kodeKantor = k_kode
												WHERE "'.$tanggal.'" < user_tanggalLisensiAkhir AND k_kode_kantor_wilayah = "'.$kode.'"
												AND user_statusKadaluarsa <> "BELUM KADALUARSA"
											');
				}

				if ($hasil->num_rows() > 0)
				{
					echo $hasil->row()->JUMLAH;
				}
				else
				{
					echo '0';
				}

				break;
		}
	}

}
