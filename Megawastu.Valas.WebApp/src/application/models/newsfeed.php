<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * News Model
 * @license         2012 Megawastu
 * @category        Models
 * @author          Jogi Silalahi
 * @link            http://www.jogisilalahi.com
 */
class Newsfeed extends DataMapper {

	// Table name in database
	var $table = 'mwp_news';

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
               ->get();

     	return $this;
     }

	
}

/* End of file newsfeed.php */
/* Location: ./application/models/newsfeed.php */
