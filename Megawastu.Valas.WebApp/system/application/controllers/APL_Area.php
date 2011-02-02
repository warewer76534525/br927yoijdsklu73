<?php

/** Controller untuk area aplikasi
 */
class APL_Area extends MY_Controller {	//TOCHANGE: sesuaikan dengan prefix aplikasi dan nama CSU

	var $model = 'APL_M_Area';	//TOCHANGE: nama model yang diakses oleh controller
	var $application = '';		// prefiks aplikasi (diinit di konstruktor)

	function APL_Area()			//TOCHANGE: sesuaikan dengan nama kelas
	{
		parent::MY_Controller();
		$this->application = substr($this->model, 0, 3);	// ambil prefiks aplikasi dari model
		$this->load->model($this->model, '', TRUE);			// load model
	}
	
	/* fungsi untuk melakukan redirect ke index controller */
	function _self_redirect() {
		$controller = get_class($this);
		redirect($controller);
	}
	
	/* fungsi untuk mengubah pasangan nilai yang dipassing via URI menjadi associative array */
	/* data yang dipassing diencode dengan base64 dan semua karakter = diubah menjadi - agar */
	/* dapat dipassing dengan baik oleh browser. pada fungsi ini, nilai-nilai tersebut di-   */
	/* decode. */
	function _decoded_uri_to_assoc()
	{
		$_data = $this->uri->uri_to_assoc();
			
		$data = array();
		
		foreach ($_data as $key => $value) {
			$key = decode_for_uri($key);
			$value = decode_for_uri($value);
			$data[$key] = $value;
		}
		
		return $data;
	}
	
	/* secara default, controller ini menampilkan semua record yang terdapat pada model */
	function index()
	{
		$this->view_all();
	}
	
	/* fungsi ini menampilkan semua record yang terdapat pada model */
	function view_all() {
		$controller = get_class($this);
		$model = $this->model;
		
		/* mengambil data dari model untuk dipassing ke view */
		$table = $this->$model->get_table_name();
		$data['fields'] = $this->$model->list_fields();	
		$data['field_data'] = $this->$model->field_data();
		$data['result'] = $this->$model->get_all()->result_array();
		
		$content_data = array('controller' => $controller,
			'table' => $table,
			'data' => $data,
		);
		
		$data = array(
			'application' => $this->application,
			'page' => 'Area Aplikasi',			//TOCHANGE: ganti dengan nama halaman yang sesuai
			'navigation' => $this->load->view('nav/'.$controller.'_R_view_all', '', true),
			'content' => $this->load->view('reports/tabular', $content_data, true),
			
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
		$controller = get_class($this);
		$model = $this->model;
		
		$table = $this->$model->get_table_name();
		$data['field_data'] = $this->$model->field_data();
	
		$content_data = array('controller' => $controller,
			'table' => $table,
			'data' => $data,
			'action' => 'add',
		);
	
		$data = array(
			'application' => $this->application,
			'page' => 'Add Area Aplikasi',			//TOCHANGE: ganti dengan nama halaman yang sesuai
			'navigation' => $this->load->view('nav/'.$controller.'_F_add_single', '', true),
			'content' => $this->load->view('forms/columnar', $content_data, true),
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
		
		//XXX: Create a helper for this?
		$data['CREATED_BY']	= 'guest'; //TODO: assign with current user
		$data['TGL_CREATED'] = mdate('%Y%m%d%H%i%s', now());
		$data['IP_ADDRESS'] = $this->input->ip_address();
	
		$model = $this->model;
		$this->$model->insert($data);
		
		$this->_self_redirect();
	}
	
	/* fungsi untuk menampilkan form pengubahan data */
	function update()
	{
		$controller = get_class($this);
		$model = $this->model;
		
		$record = $this->_decoded_uri_to_assoc();
		
		reset($record);
		$key_value = current($record);
		$key = key($record);
		
		$result = $this->$model->get_all()->result_array();
		
		for ($i=0; ($i<count($result)) && ($result[$i][$key]!=$key_value); $i++);
		$index = $i;
				
		$table = $this->$model->get_table_name();
		$data['field_data'] = $this->$model->field_data();
		$data['key'] = $key;
		$data['key_value'] = $key_value;
		$data['record'] = $result[$index];
		
		$content_data = array('controller' => $controller,
			'table' => $table,
			'data' => $data,
			'action' => 'update',
			'id' => $this->uri->assoc_to_uri($this->uri->uri_to_assoc()),
		);
		
		$data = array(
			'application' => $this->application,
			'page' => 'Update Record Aplikasi',		//TOCHANGE: ganti dengan nama halaman yang sesuai
			'navigation' => $this->load->view('nav/'.$controller.'_F_update_single', '', true),
			'content' => $this->load->view('forms/columnar', $content_data, true),
			
		);
		$this->load->view('layout/default', $data);
		
	}
	
	/* fungsi untuk melakukan proses pengubahan data */
	function process_update()
	{	
		$record = $this->_decoded_uri_to_assoc();
		$data = array();
		
		foreach($_POST as $key => $value) {
			if (strcmp(substr($key, 0, 2), "__") != 0) {
				$data[$key] = $value;
			}
		}
		
		//XXX: Create a helper for this?
		$data['UPDATED_BY']	= 'guest'; //TODO: assign with current user
		$data['TGL_UPDATED'] = mdate('%Y%m%d%H%i%s', now());
		$data['IP_ADDRESS'] = $this->input->ip_address();
	
		$model = $this->model;
		$this->$model->update($data, $record);
		
		$this->_self_redirect();
	}
	
	/* fungsi untuk melakukan penghapusan data, hanya memanggil process_delete */
	function delete()
	{
		$this->process_delete();
	}
	
	/* fungsi untuk melakukan proses penghapusan data */
	function process_delete()
	{
		$criteria = $this->_decoded_uri_to_assoc();
			
		$model = $this->model;
		$this->$model->delete($criteria);
		
		$this->_self_redirect();
	}
}

/* End of file APL_Area.php */
/* Location: ./system/application/controllers/APL_Area.php */