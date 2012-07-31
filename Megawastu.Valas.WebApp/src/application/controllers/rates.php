<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rates extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->check(array(0, 1));
	}


	public function index()
	{
		redirect('rates/idr');
	}

	public function idr()
	{
		$this->_log('IDR');
		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/rate/idr', '', TRUE),
				'page' => 'IDR Base Rates',
				'action' => anchor('rates/idr', 'IDR Base Rates') . ' | ' . anchor('rates/usd', 'USD Base Rates'),
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function usd()
	{
		$this->_log('USD');
		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/rate/usd', '', TRUE),
				'page' => 'USD Base Rates',
				'action' => anchor('rates/idr', 'IDR Base Rates') . ' | ' . anchor('rates/usd', 'USD Base Rates'),
			);

		$this->load->view('layouts/default', $content_data);
	}

	function _log($kurs)
	{
		$log = new log();
		$user = $this->auth->user();
		$log->user = $user->username;
		$log->kurs = $kurs;

		$log->save();
	}
}

/* End of file rates.php */
/* Location: ./application/controllers/rates.php */