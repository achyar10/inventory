<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		redirect('auth/login');	
	}

	// public function register(){
	// 	$data['user_name'] = $this->input->post('user_name');
	// 	$data['user_password'] = password_hash($this->input->post('user_password'), PASSWORD_DEFAULT);
	// 	$data['user_role'] = 'Super Admin';
	// 	$data['user_full_name'] = $this->input->post('user_full_name');
	// 	$data['branch_id'] = $this->input->post('branch_id');

	// 	$this->User_model->insert_user($data);

	// 	echo 'berhasil';
	// }

	function login(){

		// if($this->session->userdata('logged')){
		// 	redirect('dashboard');
		// }

		if($_POST){

			$username = $this->input->post('user_name', TRUE);
			$password = $this->input->post('user_password', TRUE);

			$user = $this->User_model->get_user(array('user_name'=> $username))->row();

			if(!empty($user) && password_verify($password, $user->user_password)){
				echo 'berhasil login';
			} else {
				// redirect('auth/login');
				echo 'gagal login';
			}

		} else {


			$data['title'] = 'Login';
			$this->load->view('login', $data);
		}
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */