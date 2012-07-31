<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->check(array(0, 1));
	}

	public function rates($currency, $direction)
	{
		$rates_log = new rates_log();
		$rates_log->get_rates($currency, $direction);

		echo $this->input->get('callback').'(' . PHP_EOL;
		echo '[' . PHP_EOL;

		foreach($rates_log as $rl)
		{
			echo '[' . strtotime($rl->timestamp) * 1000 . ', ' . $rl->{$direction} . '],' . PHP_EOL;
		}

		echo ']);';
	}

}

/* End of file api.php */
/* Location: ./application/controllers/api.php */