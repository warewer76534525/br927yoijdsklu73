<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mwp_rates_log extends CI_Model {

	var $table = 'rates_log';	// nama tabel pada database

	function __construct()
    {
        parent::__construct();	//memanggil konstruktor
    }

	function get_all()	// meretrieve semua record pada tabel
	{
		return $this->db->get($this->table);
	}

	function get($id)	// meretrieve satu record yang di pilih pada tabel
	{
		return $this->db->get_where($this->table, array('id'=>$id));
	}

	function get_like($q, $c)
	{
		$this->db->like('timestamp', $q);
		$this->db->order_by("timestamp", "asc");
		return $this->db->get_where($this->table, array('currency' => $c));
		//return $this->db->get();
	}

	function get_between($interval, $curr)
	{
		//return $this->db->query("select * from ".$this->table." where currency = '".$curr."' and timestamp between '".$start."' and '".$end."'");
		if($interval == 'day'){
			return $this->db->query("SELECT * FROM rates_log WHERE currency = '".$curr."' and timestamp > DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY) order by timestamp asc");
		}else if($interval == 'week'){
			return $this->db->query("SELECT * FROM rates_log WHERE currency = '".$curr."' and timestamp > DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK) order by timestamp asc");
		}else if($interval == 'month'){
			return $this->db->query("SELECT * FROM rates_log WHERE currency = '".$curr."' and timestamp > DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) order by timestamp asc");
		}else if($interval == 'three_month'){
			return $this->db->query("SELECT * FROM rates_log WHERE currency = '".$curr."' and timestamp > DATE_SUB(CURRENT_DATE, INTERVAL 3 MONTH) order by timestamp asc");
		}
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
