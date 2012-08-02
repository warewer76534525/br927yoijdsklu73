<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth
 * Library for user session manager
 * @author 		Jogi Silalahi <silalahi.jogi@gmail.com>
 * @copyright 	2012 GMYT Trading
 */

class Auth {

	/**
	 * CodeIgniter Core
	 */
	var $CI;

	/**
	 * User Detail
	 */
	var $user = NULL;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	/**
	 * Check
	 * Checking whether user logged in or not
	 * @return mixed
	 */
	public function check($group)
	{
		$u = $this->user();
		if($u === FALSE)
		{
			$this->CI->session->set_userdata('login_redirect', uri_string());
			redirect('login');
		}

		if(is_array($group) AND ! in_array($u->group, $group))
		{
			show_error('You do not have access to this page');
		}
		
	}

	/**
	 * User
	 * Checking if user is login or not
	 * @return 	Mixed
	 */
	public function user()
	{
		if($this->CI->session->userdata('mwp_sess_id'))
		{
			$sess_id = $this->CI->session->userdata('mwp_sess_id');
			$monitor = new monitor();
			$monitor->where('session_id', $sess_id)->get();
			if(! $monitor->exists())
			{
				$this->logout();
				redirect('login');
			}
		}


		if(is_null($this->user))
		{
			$id = $this->CI->session->userdata('mwp_id');
			if(is_numeric($id))
			{
				$u = new user();
				$u->get_by_id($id);

				if($u->exists())
				{
					$this->user = $u;
					return $this->user;
				}
			}

			return FALSE;
		}
		else 
		{
			return $this->user;
		}
	}

	/**
	 * Login
	 * validate that email and password are correct
	 * @param object 	Containing login information
	 * @return FALSE if invalid, TRUE or redirect string if valid
	 */
	public function login($user)
	{
		$success = $user->login();
		
		$sessionId = $this->CI->session->userdata('session_id');
		if($success)
		{
			// Store User ID into session
			$this->CI->session->set_userdata('mwp_id', $user->id);
			$this->CI->session->set_userdata('mwp_sess_id', $sessionId);
			$this->user = $user;

			// Check if any redirect
			$redirect = $this->CI->session->userdata('login_redirect');
			if( ! empty($redirect))
			{
				$success = $redirect;
			}
		}

		$monitor = new monitor();
		$monitor->where('username', $user->username)->get();

		
		if($monitor->exists())
		{
			$result = $monitor->delete_all();
		} else {
		}

		$monitor = new monitor();
		$monitor->where('session_id', $sessionId)->get();

		
		if($monitor->exists())
		{
			$result = $monitor->delete_all();
		} else {
		}
		
		$this->CI->load->library('user_agent');

		$monitor = new monitor();
		$monitor->session_id = $this->CI->session->userdata('session_id');
		$monitor->ip_address = $this->CI->input->ip_address();
		$monitor->user_agent = $this->CI->agent->agent_string();
		$monitor->username = $user->username;

		$monitor->save();

		return $success;
	}

	/**
	 * Logout
	 * Clear all session
	 */
	public function logout()
	{
		$user = $this->user();
		
		$monitor = new monitor();
		$monitor->where('username', $user->username)->get();
		if($monitor->exists())
		{
			$monitor->delete_all();
		}

		$this->CI->session->sess_destroy();
		$this->user = NULL;
	}


}