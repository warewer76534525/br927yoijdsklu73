<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news extends CI_Controller {

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

		$this->db->select('id, date, headline, type');
		$this->db->order_by('date', 'desc');
		$result['news'] = $this->db->get('mwp_news', 10, 0)->result_array();

		$data = array (
			'page' => "News",
			'content' => $this->load->view('content/mobile/news', $result, true),
			);

		$this->load->view('layout/mobile', $data);
	}

	function view($id=""){
		$result = $this->db->get_where('mwp_news', array('id' => decode_for_uri($id)))->result_array();

		$data = array (
			'page' => "View News",
			'content' => $this->load->view('content/mobile/view_news', $result[0], true),
			);

		$this->load->view('layout/mobile', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */