<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Log Model
 * @license         2012 Megawastu
 * @category        Models
 * @author          Jogi Silalahi
 * @link            http://www.jogisilalahi.com
 */
class Log extends DataMapper {

	// Table name in database
	var $table = 'mwp_audit';

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
     	$this->order_by('date', 'desc')
             ->limit(100)
             ->get();

     	return $this;
     }

	
}

/* End of file log.php */
/* Location: ./application/models/log.php */
