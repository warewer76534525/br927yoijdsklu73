<?php

/** Controller utama aplikasi 
 *
 *  Pada template versi ini hanya melakukan redirecting ke APL_Main
 *  Pada versi final akan menampilkan daftar semua aplikasi beserta fungsi yang dapat diakses
 */
 
class main extends MY_Controller {

	function main()
	{
		parent::MY_Controller();	
	}
	
	function index()
	{
		$data = array(
			'application' => 'MWP',
			'page' => 'Home',
			'navigation' => $this->load->view('nav/home', '', true),
			'content' => $this->load->view('content/home', '', true),
		);	// data yang akan dipassing ke view
		$this->load->view('layout/default', $data);
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */