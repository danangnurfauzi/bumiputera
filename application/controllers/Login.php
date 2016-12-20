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
	public function index()
	{
		
		$this->load->model('login_model');

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

}
