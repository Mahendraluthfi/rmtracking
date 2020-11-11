<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rmodel extends CI_Model {

	public function get_so()
		{
			$this->db->from('so');
			$this->db->join('bin', 'bin.id_bin = so.id_bin');
			$this->db->where('status', 1);
			$db = $this->db->get();
			return $db;
		}

	public function find_so($so)
		{
			$this->db->from('so');
			$this->db->join('bin', 'bin.id_bin = so.id_bin');
			$this->db->where('so_number', $so);
			$db = $this->db->get();
			return $db;
		}	

	public function find_mcode($mcode)
		{
			$this->db->from('materialcode');
			$this->db->join('so', 'so.id_so = materialcode.id_so');
			$this->db->join('bin', 'bin.id_bin = so.id_bin');
			$this->db->where('code', $mcode);
			$db = $this->db->get();
			return $db;
		}		

	public function get_history($so)
	{	
		$this->db->from('log');
		$this->db->join('so', 'so.id_so = log.id_so');
		$this->db->where('so.so_number', $so);
		$db = $this->db->get();
		return $db;		
	}

	public function get_binfree($id)
	{
		$get = $this->db->get_where('so', array('id_so' => $id))->row();

		$this->db->from('bin');
		$this->db->where_not_in('id_bin', $get->id_bin);
		$db = $this->db->get();
		return $db;		
	}

	public function log_data()
	{
		$db = $this->db->query("SELECT * FROM `so`
			JOIN log ON so.id_so=log.id_so
			JOIN bin ON bin.id_bin=so.id_bin
			WHERE so.status = '2'
			AND note LIKE '%sent%'
			ORDER BY log.id DESC");				
		return $db;		
	}

}

/* End of file Rmodel.php */
/* Location: ./application/models/Rmodel.php */