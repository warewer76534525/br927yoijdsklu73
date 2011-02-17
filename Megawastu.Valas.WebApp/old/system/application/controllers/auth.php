<?php

/** Controller untuk area aplikasi news
 */
class auth extends MY_Controller {	

	var $model = 'mwp_users';	//nama model yang akan di akses oleh controller
	var $application = 'mwp';	// prefiks aplikasi

	function auth()
	{
		parent::MY_Controller();
		$this->load->model($this->model, '', TRUE);			// load model
	}
	
	/* fungsi untuk melakukan redirect ke index controller */
	function _self_redirect() {
		redirect('auth');
	}
	
	/* secara default, controller ini menampilkan semua record yang terdapat pada model */
	function index()
	{
		$this->login();
	}
	
	/* fungsi ini menampilkan semua record yang terdapat pada model */
	function login() {
		$data = array(
			'application' => 'MWP',
			'page' => 'Login Form',
			'navigation' => $this->load->view('nav/auth', '', true),
			'content' => $this->load->view('content/auth/login', '', true),
			
		);
		$this->load->view('layout/default', $data);
	}
	
	/* fungsi untuk melakukan proses penambahan data */
	function process_login()
	{	
		$data = array();		
		
		foreach($_POST as $key => $value) {
			if (strcmp(substr($key, 0, 2), "__") != 0) {
				$data[$key] = $value;
			}
		}
	
		$model = $this->model;
		$result = $this->$model->login($data['username'])->result_array();

		if(count($result) == 0){
			$this->session->set_flashdata('message', 'Username you entered not exist!');
		}else{
			if(md5($data['password']) == $result[0]['password']){

				//load all library and model needed
				$this->load->model('mwp_session');
				$this->load->library('user_agent');
				$log = $this->mwp_session->get_from_auth($result[0]['id'])->result_array();

				if(count($log) == 0){ //jika ternyata belum login

					//insert into session database
					$session['auth'] = $result[0]['id'];
					$session['date'] = mdate('%Y%m%d%H%i%s', now());
					$session['ip_address'] = $this->input->ip_address();
					$session['user_agent'] = $this->agent->agent_string();
					$this->mwp_session->insert($session);

					//create session
					$this->session->set_userdata('logged_id', $result[0]['id']);
					$this->session->set_userdata('logged_auth', $result[0]['username']);

					redirect('main', true);

				}else{ //sudah login
					$this->session->set_flashdata('message', 'You already login from '.$log[0]['ip_address']);
				}
			}else{
				$this->session->set_flashdata('message', 'Invalid password!');
			}
		}
		
		$this->_self_redirect();
	}


	function logout(){
		//cleaning from database
		$this->load->model('mwp_session');
		$this->mwp_session->delete(array('auth' => $this->session->userdata('logged_id')));
		
		//cleaning from session
		$array_items = array('logged_id' => '', 'logged_auth' => '');
		$this->session->unset_userdata($array_items);

		redirect('main', true);
	}
}

/* End of file APL_Area.php */
/* Location: ./system/application/controllers/news.php */