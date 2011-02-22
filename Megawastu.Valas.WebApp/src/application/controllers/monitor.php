<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class monitor extends CI_Controller {

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

		if($this->session->userdata('logged_group') == 0){
			redirect('home', true);
		}

		//load the model
		$this->load->model('mwp_session');
	}

	function index()
	{ 
		$data = $this->mwp_session->get_all_login()->result_array();
		$this->load->helper('string');
		$this->load->helper('date');
		
		$content_data = array(
			'data' => $data,
		);

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/monitor', '', true),
			'page' => "Monitoring User",
			'content' => $this->load->view('content/monitor/view', $content_data, true),
			);

		$this->load->view('layout/default', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */