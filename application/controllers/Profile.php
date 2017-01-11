<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller { 

	function __construct()
	{
		parent::__construct();	

		if ( ! isset($_SESSION['logged_in']) )
		{
			redirect();
		}

		$this->load->model(array('Global_model','Login_model'));
		
	}

	public function index()
	{

		$data['username'] = 'SUPERADMIN';

		$this->load->view('profile_view',$data); 

	}

	public function editPassword()
	{

		if ( $_POST['passwordBaru'] == $_POST['rePasswordBaru'] )
		{
			$checkPasswordLama = $this->Login_model->checkPasswordLama( $_POST['passwordLama'] );

			if ( $checkPasswordLama->num_rows() > 0 ) 
			{
				$this->db->trans_begin();

				$this->db->set('ua_password',md5($_POST['passwordBaru']));
				$this->db->set('ua_plaintext',$_POST['passwordBaru']);
				$this->db->where('ua_id',$_SESSION['userAuthId']);
				$this->db->update('user_auth');

				if ($this->db->trans_status() === FALSE)
				{
				    $this->db->trans_rollback();
				    $this->session->set_flashdata('error', 'Maaf Terjadi Kesalahan Sistem Saat Ubah Password, Harap Ulangi Kembali');
					redirect('profile');
				}
				else
				{
				    $this->db->trans_commit();
				    $this->session->set_flashdata('success', 'Ubah Password Anda Berhasil');
					redirect('profile');
				}

			}
			else
			{
				$this->session->set_flashdata('error', 'Maaf Password Lama Anda Salah');
				redirect('profile');
			}

		}
		else
		{
			$this->session->set_flashdata('error', 'Maaf Password Baru dan Re Type Password Baru Tidak Sama');
			redirect('profile');
		}

	}

}
