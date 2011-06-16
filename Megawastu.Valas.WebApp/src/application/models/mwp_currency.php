<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mwp_currency extends CI_Model {

	var $table = 'currency';	// nama tabel pada database

	function __construct()
    {
        parent::__construct();	//memanggil konstruktor
    }

	function get_all()	// meretrieve semua record pada tabel
	{
		return $this->db->get($this->table);
	}

	function get_list()	// meretrieve semua record pada tabel
	{
		$this->db->select("name");
		$this->db->order_by("name", "asc"); 
		$result = $this->db->get($this->table)->result_array();

		$arr_list = array('none' => '-----');

		for($i = 0; $i < count($result); $i++){
			$arr_list[$result[$i]['name']] = $result[$i]['name'];
		}

		return $arr_list;
	}

	function get($id)	// meretrieve satu record yang di pilih pada tabel
	{
		return $this->db->get_where($this->table, array('id'=>$id));
	}

	function insert($data)	// menginsert data ke tabel
	{
		return $this->db->insert($this->table, $data);
	}
	
	function update($data, $id)	// mengupdate record $id dengan $data
	{
		return $this->db->update($this->table, $data, $id);
	}

	function delete($criteria = false) {	// menghapus record dengan kriteria tertentu
		if ($criteria != false) {
			$this->db->where($criteria);
			$this->db->delete($this->table);
		}
	}

}
