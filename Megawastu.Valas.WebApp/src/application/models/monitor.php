<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Log Model
 * @license         2012 Megawastu
 * @category        Models
 * @author          Jogi Silalahi
 * @link            http://www.jogisilalahi.com
 */
class Monitor extends DataMapper {

	// Table name in database
	var $table = 'mwp_sessions';

	/**
	 * Constructor: calls parent constructor
	 */
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    /**
     * Get All
     */
     function get_all()
     {
     	$this->get();

     	return $this;
     }

	
}

/* End of file log.php */
/* Location: ./application/models/log.php */
