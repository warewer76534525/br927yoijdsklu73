<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kurs extends CI_Controller {

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
		$this->usd();
	}

	function usd()
	{
		$data = array (
			'page' => "Kurs USD",
			'content' => $this->load->view('content/mobile/usd', '', true),
			);
		$this->load->view('layout/mobile', $data);
	}

	function idr()
	{ 
		$data = array (
			'page' => "Kurs IDR",
			'content' => $this->load->view('content/mobile/idr', '', true),
			);
		$this->load->view('layout/mobile', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */