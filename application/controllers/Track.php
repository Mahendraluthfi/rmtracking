<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('sess_rm'))) {
			redirect('login','refresh');
		}
		$this->load->library('uuid');
		$this->load->model('Rmodel');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['bin'] = $this->db->query("SELECT * FROM bin ORDER BY bin_name")->result();		
		$data['user'] = $this->db->get('user')->result();		
		$data['so'] = $this->Rmodel->get_so()->result();		
		$data['log'] = $this->Rmodel->log_data()->result();		
		$this->load->view('track', $data);
	}

	public function view_code()
	{
		$data = $this->db->get_where('materialcode', array('id_so' => '0'))->result();
		echo json_encode($data);
	}

	public function view_code_edit($id)
	{
		$data = $this->db->get_where('materialcode', array('id_so' => $id))->result();
		echo json_encode($data);
	}

	public function add_bin()
	{
		$this->db->insert('bin', array(
			'bin_name' => $this->input->post('bin')
		));

		redirect('track','refresh');
	}

	public function get_bin($id)
	{
		$data= $this->db->get_where('bin', array('id_bin' => $id))->row();
		echo json_encode($data);
	}

	public function get_so($id)
	{
		$data= $this->db->get_where('so', array('id_so' => $id))->row();
		echo json_encode($data);
	}

	public function edit_bin($id)
	{
		$this->db->where('id_bin', $id);
		$this->db->update('bin', array(
			'bin_name' => $this->input->post('bin')
		));

		redirect('track','refresh');	
	}

	public function edit_so($id)
	{
		$this->db->where('id_so', $id);
		$this->db->update('so', array(
			'so_number' => $this->input->post('so_number')
		));

		redirect('track','refresh');	
	}

	public function add_so()
	{
		$this->db->insert('so', array(			
			'so_number' => $this->input->post('so_number'),
			'id_bin' => $this->input->post('bin_so'),
			'status' => 1
		));

		$this->db->insert('log', array(
			'id_so' => $this->getuid(),
			'date' => date('Y-m-d H:i:s'),
			'note' => $this->session->userdata('name').' add new #SO '.$this->input->post('so_number')
		));

		$this->db->where('id_so', '0');
		$this->db->update('materialcode', array('id_so' => $this->getuid()));

		redirect('track','refresh');
	}	

	public function getuid()
	{
		$query = $this->db->query("SELECT max(id_so) as idlast FROM so")->row();
		return $query->idlast;
	}

	public function find_so($so)
	{
		// $so = $this->input->post('so');
		$get = $this->Rmodel->find_so($so);
		if ($get->num_rows() > 0) {
			$data = $get->row();
			echo json_encode($data);
		}else{
			echo json_encode(false);			
		}
	}

	public function find_mcode($mcode)
	{
		$get = $this->Rmodel->find_mcode($mcode);
		if ($get->num_rows() > 0) {
			$data = $get->result();
			echo json_encode($data);
		}else{
			echo json_encode(false);			
		}
	}

	public function get_history($so)
	{
		// $so = $this->input->post('so');		
		$data= $this->Rmodel->get_history($so)->result();
		echo json_encode($data);
	}

	public function get_binfree($id)
	{
		$data = $this->Rmodel->get_binfree($id)->result();
		echo json_encode($data);
	}

	public function move_bin($id)
	{
		$get_so = $this->db->query("SELECT * FROM so JOIN bin ON so.id_bin=bin.id_bin WHERE id_so = '$id'")->row();
		$bin = $this->input->post('bin_move');
		$get_bin = $this->db->get_where('bin', array('id_bin'=> $bin))->row();
		$this->db->where('id_so', $id);
		$this->db->update('so', array('id_bin' => $bin));

		$this->db->insert('log', array(
			'id_so' => $id,
			'date' => date('Y-m-d H:i:s'),
			'note' => $this->session->userdata('name').' moved #SO '.$get_so->so_number.' from BIN '.$get_so->bin_name.' to '.$get_bin->bin_name
		));

		echo json_encode(array('status' => true));
	}

	public function sent_bpu($id)
	{
		$get_so = $this->db->query("SELECT * FROM so JOIN bin ON so.id_bin=bin.id_bin WHERE id_so = '$id'")->row();

		$this->db->where('id_so', $id);
		$this->db->update('so', array('status' => '2'));

		$this->db->insert('log', array(
			'id_so' => $id,
			'date' => date('Y-m-d H:i:s'),
			'note' => $this->session->userdata('name').' sent #SO '.$get_so->so_number.' from BIN '.$get_so->bin_name.' to BPU'
		));

		redirect('track','refresh');
	}

	public function get_insidebin($id)
	{
		$data = $this->db->get_where('so', array('id_bin' => $id, 'status' => '1'))->result();
		foreach ($data as $key => $value) {
			$value->material = $this->db->get_where('materialcode',array('id_so' => $value->id_so))->result();
		}
		echo json_encode($data);
	}

	public function add_user()
	{
		$this->db->insert('user', array(
			'epf' => $this->input->post('epf'),
			'name' => $this->input->post('name'),
			'password' => md5($this->input->post('epf')),
			'level' => $this->input->post('level'),
		));

		redirect('track','refresh');
	}

	public function delete_so($id)
	{
		$this->db->where('id_so', $id);
		$this->db->delete('so');

		$this->db->where('id_so', $id);
		$this->db->delete('materialcode');

		$this->db->where('id_so', $id);
		$this->db->delete('log');

		redirect('track','refresh');
	}

	public function delete_user($epf)
	{
		$this->db->where('epf', $epf);
		$this->db->delete('user');

		redirect('track','refresh');
	}

	public function add_code()
	{
		$this->db->insert('materialcode', array(
			'code' => $this->input->post('code')
		));

		echo json_encode(array('status' => true));
	}

	public function add_code_edit($id)
	{
		$this->db->insert('materialcode', array(
			'id_so' => $id,
			'code' => $this->input->post('code')
		));

		echo json_encode(array('status' => true));
	}

	public function del_code($id)
	{
		$this->db->where('id_code', $id);
		$this->db->delete('materialcode');
		echo json_encode(array('status' => true));
	}

	public function mcode_list($id)
	{	
		$get = $this->db->get_where('so', array('so_number' => $id))->row();
		$data = $this->db->get_where('materialcode', array('id_so' => $get->id_so))->result();
		echo json_encode($data);
	}
}

/* End of file Track.php */
/* Location: ./application/controllers/Track.php */