<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->check(array(0, 1));
		
		$this->load->helper('file');
	}

	public function rates($currency, $direction)
	{
		date_default_timezone_set('UTC');
		$rates_log = new rates_log();
		$rates_log->get_rates($currency, $direction);

		/*
		echo $this->input->get('callback').'(' . PHP_EOL;
				echo '[' . PHP_EOL;
		
				foreach($rates_log as $rl)
				{
					echo '[' . strtotime($rl->timestamp) * 1000 . ', ' . $rl->{$direction} . '],' . PHP_EOL;
				}
		
				echo ']);';*/
		
		
		echo $this->input->get('callback').'(' . PHP_EOL;
		
		$fileName = "./assets/json/" . $currency . $direction . ".data";
		
		$file_handle = fopen($fileName, "r");
		while (!feof($file_handle)) {
		   $line = fgets($file_handle);
		   echo $line;
		}
		fclose($file_handle);
		
		
		echo ');';
		
	}
	
	public function read() {
		$file_handle = fopen('./assets/json/usd.data', "r");
		while (!feof($file_handle)) {
		   $line = fgets($file_handle);
		   echo $line;
		}
		fclose($file_handle);
	}
	
	public function write() {
		if ( !write_file('./kompor.txt', "write me to file"))
		{
		     echo 'Unable to write the file';
		}
		else
		{
		     echo 'File written!';
		}
	}
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */