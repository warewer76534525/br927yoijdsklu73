<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends Controller {

	function MY_Controller()
	{	
		parent::Controller();
		if($this->session->userdata('logged_auth')){
			$sess_id = $this->session->userdata('session_id');
			$this->load->model('mwp_session');
			$result = $this->mwp_session->get($sess_id)->result_array();

			if(count($result) == 0){
				$this->mwp_session->delete(array('session_id' => $sess_id));
				redirect('home', true);
			}
		}
	}

}
/* End of file MY_Controller.php */
/* Location: ./system/libraries/MY_Controller.php */