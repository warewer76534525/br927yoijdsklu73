<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->check(array(1));
	}

	public function index()
	{
		$this->all();
	}

	public function all()
	{
		$users = new user();
		$users->get_all();

		$data = array(
				'users' => $users,
			);

		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/user/index', $data, TRUE),
				'page' => 'Users',
				'action' => anchor('users/add', 'Add User'),
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function detail($id)
	{
		$news = new newsfeed($id);

		$data = array(
				'news' => $news,
			);

		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/news/detail', $data, TRUE),
				'page' => $news->headline,
				'action' => anchor('news/all', '&larr; Back'),
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function add()
	{
		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/user/add', '', TRUE),
				'page' => 'Add News',
				'action' => anchor('users/all', '&larr; Back'),
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function create()
	{
		if($this->input->post('__submit'))
		{
			$user = new user();
			$user->username = $this->input->post('username');
			$user->password = $this->input->post('password');
			$user->status = $this->input->post('status');
			$user->group = $this->input->post('group');

			$user->save();

			redirect('users');
		}
	}

	public function edit($id)
	{
		$user = new user($id);
		$data = array(
				'user' => $user,
			);
		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/user/edit', $data, TRUE),
				'page' => 'Edit User',
				'action' => anchor('users/all', '&larr; Back'),
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function update()
	{
		if($this->input->post('__submit'))
		{
			$user = new user($this->input->post('__id'));
			$user->username = $this->input->post('username');
			$user->status = $this->input->post('status');
			$user->group = $this->input->post('group');

			$user->save();

			redirect('users');
		}
	}

	function delete($id)
	{
		$user = new user($id);
		$user->delete();

		redirect('users');
	}

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */