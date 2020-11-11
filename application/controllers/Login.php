<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if (!empty($this->session->userdata('sess_rm'))) {
			redirect(base_url(),'refresh');
		}else{
			$this->load->view('login');		
		}
	}

	public function submit()
	{
		$cek = $this->db->get_where('user', array(
			'epf' => $this->input->post('epf'),
			'password' => md5($this->input->post('password'))
		));

		if ($cek->num_rows() > 0) {
			$get = $cek->row();
			$array = array(
				'sess_rm' => md5($this->input->post('password')),
				'name' => $get->name,
				'epf' => $get->epf,
				'level' => $get->level,
			);
			
			$this->session->set_userdata( $array );
			redirect(base_url(),'refresh');
		}else{
			$this->session->set_flashdata('msg', '
				<p></p>
                  <div class="alert alert-danger text-center">
                    <strong>EPF or Password is wrong !</strong>
                  </div>
				');
			redirect('login','refresh');

		}
	}

	public function logout()
	{
		session_destroy();
		redirect('login','refresh');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */