<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mwp_news extends Model {

	var $table = 'mwp_news';	// nama tabel pada database

	function mwp_news()	//konstructor
	{
		parent::Model();
	}

	function get_all()	// meretrieve semua record pada tabel
	{
		return $this->db->get($this->table);
	}

	function get($id)	// meretrieve satu record yang di pilih pada tabel
	{
		return $this->db->getwhere($this->table, array('id'=>$id));
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
