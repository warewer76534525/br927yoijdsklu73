<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Password Controller
 * @author 		Jogi Silalahi <silalahi.jogi@gmail.com>
 * @copyright 	2012 GMYT Trading
 */
class Password extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->check(array(0, 1));
	}
	/**
	 * Index
	 * Homepage controller show
	 */
	public function index()
	{
		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/auth/password', '', TRUE),
				'page' => 'Change Password',
				'action' => '',
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function update()
	{
		if($this->input->post('__submit'))
		{
			$user = new user($this->input->post('__id'));
			if($user->password != md5($this->input->post('current')))
			{
				$this->session->set_flashdata('error', 'Current password wrong');
				redirect('password');
			}

			if($this->input->post('new') != $this->input->post('confirm'))
			{
				$this->session->set_flashdata('error', 'New password and confirm password doesn\'t match');
				redirect('password');
			}

			$user->password = $this->input->post('new');
			$user->save();

			$this->session->set_flashdata('error', 'Success to change password');
			redirect('password');
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */