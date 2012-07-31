<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monitors extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->check(array(1));
	}

	public function index()
	{
		$monitor = new monitor();
		$monitor->get_all();

		$data = array(
				'monitors' => $monitor,
			);

		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/monitor/index', $data, TRUE),
				'page' => 'Monitoring User',
				'action' => '',
			);

		$this->load->view('layouts/default', $content_data);
	}
}

/* End of file logs.php */
/* Location: ./application/controllers/logs.php */