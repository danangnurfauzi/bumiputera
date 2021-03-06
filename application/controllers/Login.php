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

		$this->load->model(array('Login_model','Global_model'));

	}

	public function index()
	{

		if ($this->input->post('submit'))
		{
			
			switch ($_POST['jenisUser']) {
				
				case '0':
					
					$result = $this->Login_model->verificationLogin( $_POST['username'] , $_POST['password'] );

					if ( $result->num_rows() > 0 )
					{
						
						if( $result->row()->ua_isLogin == '0' )
						{
							$this->db->set('ua_isLogin','1');
							$this->db->where('ua_id',$result->row()->ua_id);
							$this->db->update('user_auth');
							
							$setData = array(
									'userAuthId' => $result->row()->ua_id,
									'username' => 'SUPERADMIN',
									'roleId' => '0',
									'logged_in'	=> TRUE
									);

							$this->session->set_userdata($setData);
							redirect('dashboard');
						}
						else
						{
							$this->session->set_flashdata('error', 'Maaf Anda Sudah Login pada Device Lain');
							redirect('login');
						}
						
					}else
					{
						$this->session->set_flashdata('error', 'Maaf Username atau Password Anda Salah');
						redirect('login');
					}

					break;

				case '1': 
					
					$result = $this->Login_model->verificationLogin( $_POST['username'] , $_POST['password'] );

					if ( $result->num_rows() > 0 )
					{
						
						if( $result->row()->ua_isLogin == '0' )
						{
							$this->db->set('ua_isLogin','1');
							$this->db->where('ua_id',$result->row()->ua_id);
							$this->db->update('user_auth');
							
							$data = $this->Login_model->loginDataKantor( $_POST['username'] )->row();
							$setData = array(
										'userAuthId' => $result->row()->ua_id,
										'username' => $data->k_kantor_wilayah,
										'kodeKantor' => $data->k_kode,
										'namaKantor' => $data->k_nama,
										'kodeKantorWilayah'	=> $data->k_kode_kantor_wilayah,
										'namaKantorWilayah' => $data->k_kantor_wilayah,
										'divisi' => $data->k_divisi,
										'distribusi'	=> $data->k_distribusi,
										'roleId' => '9',
										'logged_in'	=> TRUE
										);
	
							$this->session->set_userdata($setData);
							redirect('dashboard');
						}
						else
						{
							$this->session->set_flashdata('error', 'Maaf Anda Sudah Login pada Device Lain');
							redirect('login');
						} 
						
					}else
					{
						$this->session->set_flashdata('error', 'Maaf Username atau Password Anda Salah');
						redirect('login');
					}

					break;

				case '2': 
					
					$result = $this->Login_model->verificationLogin( $_POST['username'] , $_POST['password'] );

					if ( $result->num_rows() > 0 )
					{
						
						if( $result->row()->ua_isLogin == '0' )
						{
							$this->db->set('ua_isLogin','1');
							$this->db->where('ua_id',$result->row()->ua_id);
							$this->db->update('user_auth');
							
							$data = $this->Login_model->loginDataKantorCabang( $_POST['username'] )->row();
							$setData = array(
										'userAuthId' => $result->row()->ua_id, 
										'username' => $data->k_nama,
										'kodeKantor' => $data->k_kode,
										'namaKantor' => $data->k_nama,
										'kodeKantorWilayah'	=> $data->k_kode_kantor_wilayah,
										'namaKantorWilayah' => $data->k_kantor_wilayah,
										'divisi' => $data->k_divisi,
										'distribusi'	=> $data->k_distribusi,
										'roleId' => '10',
										'logged_in'	=> TRUE
										);
	
							$this->session->set_userdata($setData);
							redirect('dashboard');
						}
						else
						{
							$this->session->set_flashdata('error', 'Maaf Anda Sudah Login pada Device Lain');
							redirect('login');
						}
						
					}else
					{
						$this->session->set_flashdata('error', 'Maaf Username atau Password Anda Salah');
						redirect('login');
					}

					break;

				case '3':
					
					$result = $this->Login_model->verificationLogin( $_POST['username'] , $_POST['password'] );

					if ( $result->num_rows() > 0 )
					{
						
						if( $result->row()->ua_isLogin == '0' )
						{
							$this->db->set('ua_isLogin','1');
							$this->db->where('ua_id',$result->row()->ua_id);
							$this->db->update('user_auth');
							
							$userId = $result->row()->ua_userId;

							$data = $this->Login_model->dataUserId( $userId )->row();
	
							$setData = array(
										'userAuthId' => $result->row()->ua_id,
										'username' => $data->user_namaAgen,
										'idPusat' => $data->user_idPusat,
										'nomorLisensi' => $data->user_nomorLisensi,
										'nama'	=> $data->user_namaAgen,
										'jabatan' => $data->user_namaJabatanAgen,
										'jabatanKode' => $data->user_kodeJabatanAgen,
										'roleId'	=> $result->row()->ua_userRoleId,
										'logged_in'	=> TRUE
										);
	
							$this->session->set_userdata($setData);
	
							redirect('dashboard');
						}
						else
						{
							$this->session->set_flashdata('error', 'Maaf Anda Sudah Login pada Device Lain');
							redirect('login');
						}
						
						
					}else
					{
						$this->session->set_flashdata('error', 'Maaf Username atau Password Anda Salah');
						redirect('login');
					}

					break;
				
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
		
		$result = $this->Login_model->validasiAgen( $_POST['nomorLisensi'] );
		
		if ($result === TRUE)
		{
			
			$dataAgen = $this->Global_model->dataAgen( $this->input->post('nomorLisensi') )->row();

			$checkRegisterAgen = $this->Login_model->checkUser( $dataAgen->user_id );

			if ( $checkRegisterAgen->num_rows() > 0 )
			{
				
				$this->session->set_flashdata('error', 'Anda Sudah Pernah Melakukan Register');
				redirect('login');

			}else{

				$this->db->trans_begin();

				$jabatan = $this->Global_model->jabatan( $dataAgen->user_kodeJabatanAgen )->row();

				$this->db->set('ua_username',$this->input->post('nomorLisensi'));
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
				    $this->session->set_flashdata('success', 'Register Anda Berhasil Silahkan Login Dengan Username: Nomor Lisensi dan Password: 12345');
					redirect('login');
				}

			}

		}else{
			$this->session->set_flashdata('error', 'Maaf Nomor Lisensi Anda Salah');
			redirect('login/signUp');
		}
	}

}
