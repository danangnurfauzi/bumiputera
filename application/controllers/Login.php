<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller { 

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */ 

	function __construct()
	{
		parent::__construct();

		if ( isset($_SESSION['logged_in']) )
		{
			redirect('dashboard');
		}

		$this->load->model(array('login_model','global_model'));
		
	}

	public function index()
	{

		if ($this->input->post('submit'))
		{
			
			$result = $this->login_model->verificationLogin( $_POST['username'] , $_POST['password'] );

			if ( $result->num_rows() > 0 )
			{
				
				$setData = array(
							'username'	=> $result->row()->ua_username,
							'roleId'	=> $result->row()->ua_userRoleId,
							'logged_in'	=> TRUE
							);

				$this->session->set_userdata($setData);

				redirect('dashboard');
			}else
			{
				$this->session->set_flashdata('error', 'Maaf Username atau Password Anda Salah');
				redirect();
			}
			
		}
        
        $this->load->view('login_view');

	}

	public function signUp()
	{

		$this->load->view('signUp_view');
	}

	public function registerAgen()
	{
		
		$result = $this->login_model->validasiAgen( $this->input->post('nomorIdPusat') );
		
		if ($result === TRUE)
		{
			$this->db->trans_begin();

			$dataAgen = $this->global_model->dataAgen( $this->input->post('nomorIdPusat') )->row();

			$jabatan = $this->global_model->jabatan( $dataAgen->user_kodeJabatanAgen )->row();

			$this->db->set('ua_username',$this->input->post('nomorIdPusat'));
			$this->db->set('ua_password', md5('12345'));
			$this->db->set('ua_plaintext','12345');
			$this->db->set('ua_userRoleId',$jabatan->j_id);
			$this->db->set('ua_userId',$dataAgen->user_id);
			$this->db->insert('user_auth');

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    $this->session->set_flashdata('error', 'Maaf Terjadi Kesalahan Sistem Saat Penyimpanan, Harap Ulangi Kembali');
				redirect('login/signUp');
			}
			else
			{
			    $this->db->trans_commit();
			    $this->session->set_flashdata('success', 'Register Anda Berhasil Silahkan Login Dengan Username: User ID Pusat dan Password: 12345');
				redirect('login');
			}
		}else{
			$this->session->set_flashdata('error', 'Maaf User ID Pusat Anda Salah');
			redirect('login/signUp');
		}
	}

}
