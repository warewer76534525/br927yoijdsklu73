<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

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
	}

	function index()
	{ 
		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/home', '', true),
			'page' => "Kurs USD",
			'content' => $this->load->view('content/kurs/kurs_usd', '', true),
			);
		$this->load->view('layout/default', $data);
	}

	function kurs_idr()
	{ 
		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/home', '', true),
			'page' => "Kurs IDR",
			'content' => $this->load->view('content/kurs/kurs_idr', '', true),
			);
		$this->load->view('layout/default', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */