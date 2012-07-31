<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Rates Log Model
 * @license         2012 Megawastu
 * @category        Models
 * @author          Jogi Silalahi
 * @link            http://www.jogisilalahi.com
 */
class Rates_log extends DataMapper {

	// Table name in database
	var $table = 'rates_log';

	/**
	 * Constructor: calls parent constructor
	 */
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    /**
     * Get
     * Get all rates log in specified currency and direction
     */
     function get_rates($currency, $direction)
     {
     	$this->query("SELECT currency, $direction, `timestamp`
                         FROM $this->table
                         WHERE currency = '$currency' AND `timestamp` > DATE_SUB(CURRENT_DATE, INTERVAL 3 MONTH)
                         ORDER BY `timestamp` ASC");
     	return $this;
     }

	
}

/* End of file rates_log.php */
/* Location: ./application/models/rates_log.php */
