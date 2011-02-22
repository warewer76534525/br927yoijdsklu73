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

		//load the model
		$this->load->model('mwp_news');
	}

	function index()
	{ 
		$data = $this->mwp_news->get_all()->result_array();
		$this->load->helper('string');
		
		$content_data = array(
			'data' => $data,
		);

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/news', '', true),
			'page' => "VIew All News",
			'content' => $this->load->view('content/news/view_all', $content_data, true),
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
			'submenu' => $this->load->view('nav/news', '', true),
			'page' => "Add New News",
			'content' => $this->load->view('content/news/add', '', true),
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

			//load the date helper
			$this->load->helper('date');

			$data['author']	= $this->session->userdata('logged_auth');
			$data['date'] = mdate('%Y%m%d%H%i%s', now());
		
			$this->mwp_news->insert($data);
		}

		redirect('news', true);
	}

	function view($id=""){
		if($id == ""){
			redirect('news');
		}

		$result = $this->mwp_news->get(decode_for_uri($id))->result_array();

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/news', '', true),
			'page' => $result[0]['headline'],
			'content' => $this->load->view('content/news/view', $result[0], true),
			);

		$this->load->view('layout/default', $data);
	}

	function update($id="")
	{
		if($this->session->userdata('logged_group') == 0){
			redirect('home', true);
		}

		if($id == ""){
			redirect('news');
		}

		$result = $this->mwp_news->get(decode_for_uri($id))->result_array();

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/news', '', true),
			'page' => 'Update News',
			'content' => $this->load->view('content/news/update', $result[0], true),
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

			$data['author']	= $this->session->userdata('logged_auth');
			$data['date'] = mdate('%Y%m%d%H%i%s', now());
		
			$this->mwp_news->update($data, array('id' => decode_for_uri($id)));
		}

		redirect('news', true);
	}

	function delete($id)
	{
		if($this->session->userdata('logged_group') == 0){
			redirect('home', true);
		}

		$id = decode_for_uri($id);

		$this->mwp_news->delete(array('id' => $id));
		
		redirect('news');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */