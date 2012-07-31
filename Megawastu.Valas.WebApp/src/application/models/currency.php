<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Currency Model
 * @license         2012 Megawastu
 * @category        Models
 * @author          Jogi Silalahi
 * @link            http://www.jogisilalahi.com
 */
class Currency extends DataMapper {

	// Table name in database
	var $table = 'currency';

	/**
	 * Constructor: calls parent constructor
	 */
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    /**
     * Get Currency
     * Get all currency in array
     * @return array
     */
     function get_currency_array()
     {
     	$this->select("name")
     		 ->get();

          $result = array();
     	foreach ($this as $curr) {
               $result[$curr->name] = $curr->name;
          }

          return $result;
     }

	
}

/* End of file currency.php */
/* Location: ./application/models/currency.php */
