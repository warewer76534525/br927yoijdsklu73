<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model
 * @license         2012 Megawastu
 * @category        Models
 * @author          Jogi Silalahi
 * @link            http://www.jogisilalahi.com
 */
class user extends DataMapper {

	// Table name in database
	var $table = 'mwp_users';

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

     // ------- Validation --------
    var $validation = array(
            'username' => array(
                    'rules' => array('required', 'trim', 'max_length' => 100),
                ),
            'password' => array(
                    'rules' => array('required', 'trim', 'min_length' => 3, 'max_length' => 40, 'encrypt'),
                    'type' => 'password',
                ),
        );

    /**
     * Login
     * Processing user login
     * @return bool
     */
    public function login()
    {
        $username = $this->username;
        // Validate
        $this->validate()->get();

        if($this->exists())
        {
            // Success to login
            return TRUE;
        }
        else
        {
            $this->username = $username;
            $this->error_message('login', 'User does not exists');

            return FALSE;
        }

    }

    /**
     * Encrypt
     * Encrypting field with salt
     * @access  private
     * @param   string
     * @return  void
     */
    function _encrypt($field)
    {
        if( ! empty($this->{$field}))
        {
            $this->{$field} = md5($this->{$field});
        }
    }

	
}

/* End of file user.php */
/* Location: ./application/models/user.php */
