<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('encode_for_uri'))
{
	function encode_for_uri($data)
	{
		return str_replace("=", "-", base64_encode($data));
	}
}

if ( ! function_exists('decode_for_uri'))
{
	function decode_for_uri($data)
	{
		return base64_decode(str_replace("-", "=", $data));
	}
}


/* End of file MY_string_helper.php */
/* Location: ./system/application/helpers/MY_string_helper.php */