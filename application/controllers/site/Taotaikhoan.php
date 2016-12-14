<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taotaikhoan extends Site {

	public function index()
	{
		

		if(!$this->session->has_userdata('session_login'))
		{
			redirect(home_url());
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('hoten', 'hoten', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[5]|is_unique[userlogin.username]',array('is_unique' => 'This username is registered'));
		$this->form_validation->set_rules('sodienthoai', 'phonenumber', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_emails');
		$this->form_validation->set_rules('diachibitcoin', 'bitcon address', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('quocgia', 'countriess', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'passconf', 'required|matches[password]');
		if ($this->form_validation->run() == true) {

			$this->get_dangky();
		} else {
			$countries = file_get_contents(site_template('json/countries.json'));
			$json = json_decode($countries, true);
			$data['countries'] = $json;
			$this->layout = 'common/taotaikhoan';
			$this->render($data);
		}
	}

	private function get_dangky()
	{
		$params = array(
			'hoten' => $this->input->post('hoten'),
			'sodienthoai' => $this->input->post('sodienthoai'),
			'email' => $this->input->post('email'),
			'diachibitcoin' => $this->input->post('diachibitcoin'),
			'quocgia' => $this->input->post('quocgia'),
			'code' => uniqid(),
			'ngaythamgia' => date('Y-m-d H:i:s'),
			'nguoigioithieu' => $this->session->userdata('iduser'),
		);
		$this->load->model('Thongtinuser_model');
		$id_user = $this->Thongtinuser_model->add_user($params);
		
		$user_login = array(
			'iduser' => $id_user,
			'username' => $this->input->post('username'),
			'matkhau' => md5(my_encrypt($this->input->post('password'))),
		);
		$this->Thongtinuser_model->add_userlogin($user_login);
		
		$this->session->set_flashdata('mess', 'Register successfully');
		redirect(home_url());
	}

	
}
