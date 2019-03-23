<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('User_model');
	}

	public function index()
	{
		if($_POST) {

			$params['user_full_name'] = $this->input->post('user_full_name');
			$this->User_model->update_user($params, ['user_id'=>$this->session->userdata('user_id')]);
		$this->session->set_flashdata('success', 'Edit profil berhasil');
			redirect('profile');

		} else {
			$data['user'] = $this->User_model->get_user(array('user_id'=>$this->session->userdata('user_id')))->row();
			$data['title'] = 'My Profile';
			$data['main'] = 'profile/index';
			$this->load->view('templates/layout', $data);
		}

		
		
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */