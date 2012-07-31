<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Logout
 * @author 		Jogi Silalahi <silalahi.jogi@gmail.com>
 * @copyright 	2012 
 */
class Logout extends CI_Controller {

	/**
	 * Index
	 */
	public function index()
	{
		$this->auth->logout();
		redirect('login');
	}
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */