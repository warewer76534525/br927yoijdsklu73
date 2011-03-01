<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// auth the user
		if(! $this->session->userdata('logged_auth')){
			redirect('login', true);
		}

		if($this->session->userdata('logged_auth')){
			$sess_id = $this->session->userdata('session_id');
			$this->load->model('mwp_session');
			$result = $this->mwp_session->get($sess_id)->result_array();

			if(count($result) == 0){
				$this->mwp_session->delete(array('session_id' => $sess_id));
				redirect('home', true);
			}
		}

		

		//load the model
		$this->load->model('mwp_users');
	}

	function index()
	{ 
		if($this->session->userdata('logged_group') == 0){
			redirect('home', true);
		}

		$data = $this->mwp_users->get_all()->result_array();
		$this->load->helper('string');
		
		$content_data = array(
			'data' => $data,
		);

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/users', '', true),
			'page' => "VIew All News",
			'content' => $this->load->view('content/users/view_all', $content_data, true),
			);

		$this->load->view('layout/default', $data);
	}

	function add()
	{
		if($this->session->userdata('logged_group') == 0){
			redirect('home', true);
		}

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/users', '', true),
			'page' => "Add New User",
			'content' => $this->load->view('content/users/add', '', true),
			);

		$this->load->view('layout/default', $data);
	}

	function process_add()
	{
		if($this->input->post("__submit")){
			$data = array();		
		
			foreach($_POST as $key => $value) {
				if (strcmp(substr($key, 0, 2), "__") != 0) {
					$data[$key] = $value;
				}
			}

			$data['password']	= md5($data['password']);
		
			$this->mwp_users->insert($data);
		}

		redirect('users', true);
	}

	function update($id="")
	{
		if($this->session->userdata('logged_group') == 0){
			redirect('home', true);
		}

		if($id == ""){
			redirect('users');
		}

		$result = $this->mwp_users->get(decode_for_uri($id))->result_array();

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/users', '', true),
			'page' => 'Update Users',
			'content' => $this->load->view('content/users/update', $result[0], true),
			);

		$this->load->view('layout/default', $data);
	}

	function process_update($id)
	{
		if($this->input->post("__submit")){
			$data = array();		
		
			foreach($_POST as $key => $value) {
				if (strcmp(substr($key, 0, 2), "__") != 0) {
					$data[$key] = $value;
				}
			}

			//load the date helper
			$this->load->helper('date');

			if($data['password'] == ""){
				unset($data['password']);
			}else{
				$data['password'] = md5($data['password']);
			}
		
			$this->mwp_users->update($data, array('id' => decode_for_uri($id)));
		}

		redirect('users', true);
	}

	function delete($id)
	{
		if($this->session->userdata('logged_group') == 0){
			redirect('home', true);
		}

		$id = decode_for_uri($id);

		$this->mwp_users->delete(array('id' => $id));
		
		redirect('users');
	}

	function change_password()
	{
		if($this->input->post("__submit")){
			if($this->input->post('new_password') != $this->input->post('con_password')){
				$this->session->set_flashdata('error', 'new password not match!');
				redirect('users/change_password');
			}

			$result = $this->mwp_users->get($this->session->userdata('logged_id'))->result_array();
			if($result[0]['password'] != md5($this->input->post('cur_password'))){
				$this->session->set_flashdata('error', 'wrong current password!');
				redirect('users/change_password');
			}

			$data['password'] = md5($this->input->post('new_password'));
			$this->mwp_users->update($data, array('id' => $this->session->userdata('logged_id')));
			$this->session->set_flashdata('error', 'successful to change password');
			redirect('users/change_password');
		}

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/users', '', true),
			'page' => 'Change Password',
			'content' => $this->load->view('content/users/change_password', '', true),
			);

		$this->load->view('layout/default', $data);
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */