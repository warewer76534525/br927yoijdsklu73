<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->check(array(0, 1));
	}

	public function index()
	{
		$this->all();
	}

	public function all()
	{
		$this->load->helper('text');
		$news = new newsfeed();

		$data = array(
				'news' => $news->get_all(),
			);

		$user = $this->auth->user();

		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/news/index', $data, TRUE),
				'page' => 'News',
				'action' => ($user->group == 1)? anchor('news/add', 'Add News') : '',
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
		$this->auth->check(array(1));
		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/news/add', '', TRUE),
				'page' => 'Add News',
				'action' => anchor('news/all', '&larr; Back'),
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function create()
	{
		$this->auth->check(array(1));

		if($this->input->post('__submit'))
		{
			$news = new newsfeed();
			$news->headline = $this->input->post('headline');
			$news->content = nl2br($this->input->post('content'));
			$news->type = $this->input->post('type');
			$news->date = date('Y-m-d H:i:s');
			$news->author = $this->auth->user()->id;

			$news->save();

			redirect('news');
		}
	}

	public function edit($id)
	{
		$this->auth->check(array(1));

		$news = new newsfeed($id);
		$data = array(
				'news' => $news,
			);
		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/news/edit', $data, TRUE),
				'page' => 'Edit News',
				'action' => anchor('news/all', '&larr; Back'),
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function update()
	{
		$this->auth->check(array(1));

		if($this->input->post('__submit'))
		{
			$news = new newsfeed($this->input->post('__id'));
			$news->headline = $this->input->post('headline');
			$news->content = $this->input->post('content');
			$news->type = $this->input->post('type');
			$news->date = date('Y-m-d H:i:s');

			$news->save();

			redirect('news');
		}
	}

	function delete($id)
	{
		$this->auth->check(array(1));
		
		$news = new newsfeed($id);
		$news->delete();

		redirect('news');
	}

}

/* End of file news.php */
/* Location: ./application/controllers/news.php */