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
		$this->login();	
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

		if($this->session->userdata('logged')) redirect('dashboard');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button position="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');

		if($_POST AND $this->form_validation->run() == TRUE){

			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);

			$user = $this->User_model->get_user(array('user_name'=> $username))->row();

			if(!empty($user) && password_verify($password, $user->user_password)){

				$session = array(
					'user_data' => array(
						'username'							=> $user->user_name,
						'full_name'							=> $user->user_full_name,
						'roluser_role'					=> $user->user_role,
						'branch_id'							=> $user->branch_id
					),
					'logged' 											=> TRUE
				);
				$this->session->set_userdata($session);

				redirect('dashboard');
			} else {
				redirect('auth/login');

			}

		} else {

			$data['title'] = 'Login';
			$this->load->view('login', $data);
		}
	}

	function logout(){
		$sessions_items = array('user_data','logged');
		$this->session->unset_userdata($sessions_items);
		redirect('auth/login');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */