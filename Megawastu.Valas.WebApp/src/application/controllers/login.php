<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{ 
		$this->load->view('layout/login');
	}

	function verify()
	{
		//if submit from form
		if($this->input->post('__submit')){

			//load the model
			$this->load->model('mwp_users');

			$user = addslashes($this->input->post('username'));
			$pass = md5($this->input->post('password'));

			$result = $this->mwp_users->login($user)->result_array();

			if(count($result) == 0){
				$this->session->set_flashdata('message', 'Username you entered not exist!');
				redirect('login');
			}else{
				if($pass == $result[0]['password']){

					//load all library and model needed
					$this->load->model('mwp_session');
					$log = $this->mwp_session->get_like($result[0]['username'])->result_array();

					//create session
					$this->session->set_userdata('logged_id', $result[0]['id']);
					$this->session->set_userdata('logged_auth', $result[0]['username']);
					$this->session->set_userdata('logged_group', $result[0]['group']);

					if(count($log) != 0){ //jika ternyata login di tempat berbeda
						$this->mwp_session->delete(array('session_id' => $log[0]['session_id']));
					}

					$this->load->library('user_agent');
					if($this->agent->is_mobile()){
						redirect(base_url()."mobile", true);
					}
						
					redirect('home', true);
					
				}else{
					$this->session->set_flashdata('message', 'Invalid password!');
					redirect('login');
				}
			}

		//if access from url
		}else{	
			//redirect to login form
			redirect('login', true);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */