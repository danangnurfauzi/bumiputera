<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller { 

	function __construct()
	{
		parent::__construct();	

		if ($_SESSION['logged_in'] === FALSE)
		{
			redirect();
		}

		$this->load->model(array('global_model'));

	}

	public function index()
	{
		
		$data['kantor'] = $this->global_model->namaKantor();

		$data['agen'] = $this->global_model->agen()->num_rows();

        $this->load->view('dashboard_view',$data);    
		
	}

	function dataAgen()
	{

		$data['agen'] = $this->global_model->agen();
		
		$this->load->view('dataAgen_view',$data); 
		
	}

	function logout()
	{
		session_destroy();
		redirect();
	}

}
