<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doimatkhau extends Admin {

	public function index()
	{
		if($this->session->userdata('role') != 1)
		{
			redirect(home_url());
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('matkhaucu', 'Old Password', 'required|min_length[3]|trim');
	  	$this->form_validation->set_rules('matkhaumoi', 'Old Password', 'required');
	  	$this->form_validation->set_rules('nhaplaimatkhau', 'Old Password', 'required|matches[matkhaumoi]');
		if( $this->form_validation->run() == TRUE)
		{

			$checkmk =  $this->input->post('matkhaucu');
			$this->load->model('Thongtinuser_model');
			$mkcu = $this->Thongtinuser_model->get_matkhau($this->session->userdata('iduser'));
			if($mkcu == md5(my_encrypt($checkmk)))
			{
			 	$this->get_doimatkhau();
			}
			else
			{
				$this->session->set_flashdata('mess', 'The old password is incorrect');
				redirect(admin_url('change-password'));
			}
		}
		else
		{
			$this->layout = 'common/doimatkhau';
			$this->render();
		}
	}

	private function get_doimatkhau()
	{
	 			
		$mkmoi = $this->input->post('matkhaumoi');
		$params = array("matkhau" => md5(my_encrypt($mkmoi)));
		$this->Thongtinuser_model->update_userlogin($this->session->userdata('iduser'),$params);
		$this->session->set_flashdata('mess','change password successfully'); 
		$this->session->set_flashdata('alert','inf');
		if($this->session->has_userdata('session_login'))
		{
			$this->session->unset_userdata('session_login');
		}
	   redirect(home_url());
	}
}