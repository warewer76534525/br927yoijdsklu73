<?php

/** Controller untuk area aplikasi news
 */
class monitor extends MY_Controller {	

	var $model = 'mwp_session';	//nama model yang akan di akses oleh controller
	var $application = 'mwp';	// prefiks aplikasi

	function monitor()
	{
		parent::MY_Controller();
		$this->load->model($this->model, '', TRUE);			// load model
		$this->load->model('mwp_users');
	}
	
	/* fungsi untuk melakukan redirect ke index controller */
	function _self_redirect() {
		redirect('monitor');
	}
	
	/* secara default, controller ini menampilkan semua record yang terdapat pada model */
	function index()
	{
		$this->view_all();
	}
	
	/* fungsi ini menampilkan semua record yang terdapat pada model */
	function view_all() {
		$model = $this->model;
		$data = $this->$model->get_all()->result_array();
		
		$content_data = array(
			'data' => $data,
			'users' => $this->mwp_users->get_users(),
		);
		
		$data = array(
			'application' => 'MWP',
			'page' => 'View All Logged User',
			'navigation' => $this->load->view('nav/home', '', true),
			'content' => $this->load->view('content/monitor/view_all', $content_data, true),
			
		);
		$this->load->view('layout/default', $data);
	}
	
}

/* End of file APL_Area.php */
/* Location: ./system/application/controllers/news.php */