<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Site {

	public function index()
	{
		$this->load->library('form_validation');
		if($this->input->post())
		{
			$this->get_dangnhap();
		}
		if($this->session->has_userdata('session_login'))
		{
			if($this->session->userdata('role') == 0)
			{
				$this->layout = 'common/dashboard';
				$this->render();
			}
			else
			{
				redirect(admin_url());
			}
		}
		else
		{
			$this->load->view('site/common/home');
		}
	}

	public function get_dangnhap()
	{
		$this->form_validation->set_rules('username', 'username', 'required|min_length[5]|trim');
	   $this->form_validation->set_rules('matkhau', 'password', 'required|min_length[4]|trim');
		$this->form_validation->set_rules('login', 'login', 'callback_check_login');
		 $this->form_validation->set_rules('check_captcha', 'The check_captcha', 'callback_check_captcha');
		if($this->input->post())
		{
			$username = $this->input->post('username');
			if ($this->form_validation->run() == TRUE) {
				$this->session->set_userdata('session_login', my_encrypt($username . time()));
				$this->session->set_userdata('info_login', $username);
				
				$info_login = $this->Thongtinuser_model->get_infologin($username);
				$info_user = $this->Thongtinuser_model->get_thongtin($info_login['iduser']);
				
				$this->session->set_userdata('name', $info_user['hoten']);
				$this->session->set_userdata('iduser', $info_user['iduser']);
				
				if($info_login['vaitro'] == 1)
				{
					$this->session->set_userdata('role', $info_login['vaitro']); 
				}
				$this->session->set_flashdata('mess', 'Login success');
				if($this->session->userdata('role') == 0)
				{
					redirect(home_url());
				}
				redirect(admin_url());
			}
		}
	}

	function check_login()
	{
		$this->load->model('Thongtinuser_model');
		if($this->input->post())
		{
			$username = $this->input->post('username');
			$password = md5(my_encrypt($this->input->post('matkhau')));

			if(! $this->Thongtinuser_model->check_login($username, $password) && $username && $password)
			{
				$this->form_validation->set_message('check_login', 'User name and password is incorrect');
				return FALSE;
			}

			return TRUE;
		}
	}

		function check_captcha()
	{
		if($this->input->post('captcha_image') != $this->session->userdata('captcha'))
		{
			$this->form_validation->set_message('check_captcha', 'The captcha is incorrect');
			return false;
		}
		return true;
	}
	function	get_dangxuat()
	{
		if($this->session->has_userdata('session_login'))
		{
			$this->session->unset_userdata('session_login');
			$this->session->unset_userdata('info_login');
			$this->session->unset_userdata('role');
			$this->session->unset_userdata('captcha');
			$this->session->set_flashdata('mess', 'Logout success');
		}

		redirect(home_url());
	}
}
