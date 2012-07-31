<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login Controller
 * @author 		Jogi Silalahi <silalahi.jogi@gmail.com>
 * @copyright 	2012 GMYT Trading
 */
class Login extends CI_Controller {

	/**
	 * Index
	 * Homepage controller show
	 */
	public function index()
	{
		$user = $this->auth->user();
		if($user !== FALSE)
		{
			// User already logged in
			redirect('rates');
		}

		// Process login
		$user = new user();
		if($this->input->post('username') !== FALSE)
		{
			$user->username = $_POST['username'];
			$user->password = $_POST['password'];

			$login_redirect = $this->auth->login($user);

			if($login_redirect)
			{
				// If success
				if($login_redirect === TRUE)
				{
					redirect('rates');
				}
				else
				{ 
					// Redirect for last access page
					redirect($login_redirect);
				}
			}
			else
			{
				// Failed to login
				$this->session->set_flashdata('error', 'Invalid username or password.');
				redirect('login');
			}
		}

		$content_data = array(
				'navigation' => '',
				'content' => $this->load->view('contents/auth/login', '', TRUE),
				'page' => 'Login',
				'action' => '',
			);

		$this->load->view('layouts/default', $content_data);
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */