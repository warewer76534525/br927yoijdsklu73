<?php

/** Controller utama aplikasi APL
 */
class APL_Main extends MY_Controller {

	function APL_Main()
	{
		parent::MY_Controller();	
	}

/** Saat diinvoke menampilkan view APL_Main
 */	
	function index()
	{
		$data = array(
			'application' => 'APL',
			'page' => 'Main',
			'navigation' => $this->load->view('nav/APL_main', '', true),
			'content' => $this->load->view('content/APL_main', '', true),
		);	// data yang akan dipassing ke view
		$this->load->view('layout/default', $data);
	}
}

/* End of file APL_Main.php */
/* Location: ./system/application/controllers/APL_Main.php */