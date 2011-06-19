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

		$this->db->select('id, date, headline, type, content');
		$this->db->order_by('date', 'desc');
		$result['news'] = $this->db->get('mwp_news', 10, 0)->result_array();

		$data = array (
			'page' => "News",
			'title' => "News",
			'content' => $this->load->view('content/mobile/news', $result, true),
			);

		$this->load->view('layout/m', $data);
	}

	function view($id=""){
		$result = $this->db->get_where('mwp_news', array('id' => decode_for_uri($id)))->result_array();

		$this->load->view('layout/mobile/view', $result[0]);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */