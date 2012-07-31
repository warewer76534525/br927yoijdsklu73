<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Graph extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->check(array(0, 1));
	}

	public function index()
	{
		$currency = new currency();

		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/graph/index', '', TRUE),
				'page' => 'Graph',
				'action' => form_open('graph/redirect', 'class="form-inline"').
								form_dropdown('currency', $currency->get_currency_array()). ' ' .
								form_submit('__go', 'Go', 'class="btn"').
							form_close(),
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function show($curr)
	{
		$currency = new currency();

		$data = array(
				'currency' => $curr,
			);

		$content_data = array(
				'navigation' => $this->load->view('navigations/default', '', TRUE),
				'content' => $this->load->view('contents/graph/show', $data, TRUE),
				'page' => 'Graph',
				'action' => form_open('graph/redirect', 'class="form-inline"').
								form_dropdown('currency', $currency->get_currency_array(), $curr). ' ' .
								form_submit('__go', 'Go', 'class="btn"').
							form_close(),
			);

		$this->load->view('layouts/default', $content_data);
	}

	public function redirect()
	{
		if($this->input->post('__go'))
		{
			$currency = $this->input->post('currency');
			redirect('graph/show/' . $currency);
		}
		redirect('graph/index');
		
	}

}

/* End of file graph.php */
/* Location: ./application/controllers/graph.php */