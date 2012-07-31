<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->check(array(1));
	}

	public function index()
	{
		$log = new log();
		$log->get_all();

		$data = array(
				'logs' => $log,
			);

		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/logs/index', $data, TRUE),
				'page' => 'Logs',
				'action' => '',
			);

		$this->load->view('layouts/default', $content_data);
	}
}

/* End of file logs.php */
/* Location: ./application/controllers/logs.php */