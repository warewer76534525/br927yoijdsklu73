<?php

/** Controller untuk area aplikasi news
 */
class news extends MY_Controller {	

	var $model = 'mwp_news';	//nama model yang akan di akses oleh controller
	var $application = 'mwp';	// prefiks aplikasi

	function news()
	{
		parent::MY_Controller();
		$this->load->model($this->model, '', TRUE);			// load model
	}
	
	/* fungsi untuk melakukan redirect ke index controller */
	function _self_redirect() {
		redirect('news');
	}
	
	/* secara default, controller ini menampilkan semua record yang terdapat pada model */
	function index()
	{
		$this->view_all();
	}
	
	/* fungsi ini menampilkan semua record yang terdapat pada model */
	function view_all() {
		$model = $this->model;

		$data = $this->$model->get_all()->result_array();
		
		$content_data = array(
			'data' => $data,
		);
		
		$data = array(
			'application' => 'MWP',
			'page' => 'View All News',
			'navigation' => $this->load->view('nav/news', '', true),
			'content' => $this->load->view('content/news/view_all', $content_data, true),
			
		);
		$this->load->view('layout/default', $data);
	}
	
	/* fungsi ini menampilkan sebuah record yang terdapat pada model */
	/* pasangan KEY-VALUE yang menandakan record yang akan di-view dipassing melalui URI */
	function view() {
		$controller = get_class($this);
		$model = $this->model;
		
		$record = $this->_decoded_uri_to_assoc();
		
		reset($record);
		$key_value = current($record);
		$key = key($record);
				
		$table = $this->$model->get_table_name();
		$data['fields'] = $this->$model->list_fields();	
		$data['field_data'] = $this->$model->field_data();
		$data['result'] = $this->$model->get_all()->result_array();
		$data['key'] = $key;
		$data['key_value'] = $key_value;
		
		$content_data = array('controller' => $controller,
			'table' => $table,
			'data' => $data,
		);
		
		$data = array(
			'application' => $this->application,
			'page' => 'View Record Aplikasi',		//TOCHANGE: ganti dengan nama halaman yang sesuai
			'navigation' => $this->load->view('nav/'.$controller.'_R_view_single', '', true),
			'content' => $this->load->view('reports/columnar', $content_data, true),
			
		);
		$this->load->view('layout/default', $data);
		
	}
	
	/* fungsi untuk menampilkan form penambahan data */
	function add()
	{
		$data = array(
			'application' => 'MWP',
			'page' => 'Add News',			//TOCHANGE: ganti dengan nama halaman yang sesuai
			'navigation' => $this->load->view('nav/news', '', true),
			'content' => $this->load->view('content/news/add', '', true),
		);
		$this->load->view('layout/default', $data);
	}
	
	/* fungsi untuk melakukan proses penambahan data */
	function process_add()
	{	
		$data = array();		
		
		foreach($_POST as $key => $value) {
			if (strcmp(substr($key, 0, 2), "__") != 0) {
				$data[$key] = $value;
			}
		}

		$data['author']	= 'guest';
		$data['date'] = mdate('%Y%m%d%H%i%s', now());
	
		$model = $this->model;
		$this->$model->insert($data);
		
		$this->_self_redirect();
	}
	
	/* fungsi untuk menampilkan form pengubahan data */
	function update($id)
	{
		$model = $this->model;
		$id = decode_for_uri($id);
		$data = $this->$model->get($id)->result_array();
		
		$content_data = array(
			'data' => $data,
			'id' => $id,
		);
		
		$data = array(
			'application' => 'MWP',
			'page' => 'Update News',		//TOCHANGE: ganti dengan nama halaman yang sesuai
			'navigation' => $this->load->view('nav/news', '', true),
			'content' => $this->load->view('content/news/update', $content_data, true),
			
		);
		$this->load->view('layout/default', $data);
		
	}
	
	/* fungsi untuk melakukan proses pengubahan data */
	function process_update()
	{	
		foreach($_POST as $key => $value) {
			if (strcmp(substr($key, 0, 2), "__") != 0) {
				$data[$key] = $value;
			}
		}
		
		$model = $this->model;
		$this->$model->update($data, array('id' => $data['id']));
		
		$this->_self_redirect();
	}
	
	/* fungsi untuk melakukan penghapusan data, hanya memanggil process_delete */
	function delete($id)
	{
		$id = decode_for_uri($id);

		$model = $this->model;
		$this->$model->delete(array('id' => $id));
		
		$this->_self_redirect();
	}
}

/* End of file APL_Area.php */
/* Location: ./system/application/controllers/news.php */