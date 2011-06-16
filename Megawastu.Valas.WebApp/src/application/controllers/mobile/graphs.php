<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class graphs extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// auth the user
		if(! $this->session->userdata('logged_auth')){
			redirect('login', true);
		}

		if($this->session->userdata('logged_auth')){
			$sess_id = $this->session->userdata('session_id');
			$this->load->model('mwp_session');
			$result = $this->mwp_session->get($sess_id)->result_array();

			if(count($result) == 0){
				$this->mwp_session->delete(array('session_id' => $sess_id));
				redirect('home', true);
			}
		}

		$this->load->library('jpgraph');
		$this->load->model('mwp_currency');
	}

	/*function index()
	{
		$this->load->library('jpgraph');
		$content_data = array(
			'graph' => $this->jpgraph->create_graph(),
			);
		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/graph', '', true),
			'page' => "View Graph Per Day",
			'content' => $this->load->view('content/graph/test', $content_data, true),
			);

		$this->load->view('layout/mobile', $data);
	}*/

	function index()
	{ 
		$content_menu = array(
			'currency' => $this->mwp_currency->get_list(),
			'time' => array('none' => '----', 'day' => 'Day', 'week' => 'Week', 'month' => 'Month', 'three_month' => "Three Month"),
			);

		//$content_data = array(
		//	'graph' => $this->jpgraph->create_graph(),
		//	);

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/m_graph', $content_menu, true),
			'page' => "View Graph",
			'content' => "Choose currency and time first!",
			);

		$this->load->view('layout/mobile', $data);
	}

	function process(){
		$curr = $this->input->post('curr');
		$time = $this->input->post('time');

		if($curr == 'none' || $time == 'none'){
			redirect('mobile/graphs');
		}

		redirect('mobile/graphs/view/'.$time.'/'.$curr);
	}

	function view($time, $curr)
	{
		$this->load->helper('date');
		$this->load->model('mwp_rates_log');

		if($time == "day"){
			$sql_time = mdate("%Y-%m-%d", time());
			$curr_data = $this->mwp_rates_log->get_like($sql_time, $curr)->result_array();
			//$curr_data = $this->mwp_rates_log->get_between('day', $curr)->result_array();
			$timescale = "day";

		}else if($time == "week"){
			//$curr_data = $this->mwp_rates_log->get_between(mdate("%Y-%m-%d", time()), date('Y-m-d', strtotime('-7 days')), $curr)->result_array();
			$curr_data = $this->mwp_rates_log->get_between('week', $curr)->result_array();
			$timescale = "week";

		}else if($time == "month"){
			//$curr_data = $this->mwp_rates_log->get_between(mdate("%Y-%m-%d", time()), date('Y-m-d', strtotime('-7 days')), $curr)->result_array();
			$curr_data = $this->mwp_rates_log->get_between('month', $curr)->result_array();
			$timescale = "month";

		}else if($time == "three_month"){
			//$curr_data = $this->mwp_rates_log->get_between(mdate("%Y-%m-%d", time()), date('Y-m-d', strtotime('-7 days')), $curr)->result_array();
			$curr_data = $this->mwp_rates_log->get_between('three_month', $curr)->result_array();
			$timescale = "three_month";
		}


		if(count($curr_data) != 0){
			$start = $curr_data[0]['timestamp'];
			$end = $curr_data[count($curr_data)-1]['timestamp'];

			$bid = array();
			$ask = array();
			$date = array();

			for($i = 0; $i <  count($curr_data); $i++){
				$bid[$i] = $curr_data[$i]['bid'];
				$ask[$i] = $curr_data[$i]['ask'];
				$date[$i] = strtotime($curr_data[$i]['timestamp']);
			}
		}

		$content_menu = array(
			'currency' => $this->mwp_currency->get_list(),
			'choose_curr' => $curr,
			'time' => array('none' => '----', 'day' => 'Day', 'week' => 'Week', 'month' => 'Month', 'three_month' => "Three Month"),
			'choose_time' => $time,
			);

		if(count($curr_data) != 0){
			$graph_result = $this->jpgraph->create($start, $end, $bid, $ask, $date, $timescale);
		}else{
			$graph_result = "Data not available";
		}

		$content_data = array(
			'graph' => $graph_result,
			);

		$data = array (
			'menu' => $this->load->view('nav/home_menu', '', true),
			'submenu' => $this->load->view('nav/m_graph', $content_menu, true),
			'page' => "View Graph",
			'content' => $this->load->view('content/graph/test', $content_data, true),
			);

		$this->load->view('layout/mobile', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */