<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class graphs extends CI_Controller {

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
		//$this->load->model('mwp_news');
	}

	function index()
	{ 
		$this->per_day();
	}

	function per_day()
	{ 
		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/graph', '', true),
			'page' => "View Graph Per Day",
			'content' => $this->load->view('content/graph/test', '', true),
			);

		$this->load->view('layout/default', $data);
	}

	function per_week()
	{ 
		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/graph', '', true),
			'page' => "View Graph Per Day",
			'content' => $this->load->view('content/graph/test', '', true),
			);

		$this->load->view('layout/default', $data);
	}

	function per_month()
	{ 
		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/graph', '', true),
			'page' => "View Graph Per Day",
			'content' => $this->load->view('content/graph/test', '', true),
			);

		$this->load->view('layout/default', $data);
	}

	function per_three_month()
	{ 
		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/graph', '', true),
			'page' => "View Graph Per Day",
			'content' => $this->load->view('content/graph/test', '', true),
			);

		$this->load->view('layout/default', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */