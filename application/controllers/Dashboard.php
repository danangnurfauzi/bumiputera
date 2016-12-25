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

		$this->load->model(array('global_model','pempol_model'));
		//print_r($_SESSION);exit;
	}

	public function index()
	{
		
		//$data['kantor'] = $this->global_model->namaKantor();

		$data['sidebarMain'] = 'active';

		$data['agen'] = $this->global_model->agen()->num_rows();

		$data['pempol'] = $this->global_model->listPempol();

        $this->load->view('dashboard_view',$data);    
		
	}

	function dataAgen()
	{

		$data['sidebarAgen'] = 'active';

		$data['agen'] = $this->global_model->agen();
		
		$this->load->view('dataAgen_view',$data); 
		
	}

	function logout()
	{
		session_destroy();
		redirect();
	}

	public function ajax_list()
    {
        $list = $this->pempol_model->get_datatables();
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
                        "recordsTotal" => $this->pempol_model->count_all(),
                        "recordsFiltered" => $this->pempol_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}
