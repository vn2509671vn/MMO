<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dangky extends Site {

	public function index()
	{
		if($this->session->has_userdata('session_login'))
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
		 $this->form_validation->set_rules('check_captcha', 'The check_captcha', 'callback_check_captcha');
		if ($this->form_validation->run() == true) {
			$this->get_dangky();
		} else {
			$countries = file_get_contents(site_template('json/countries.json'));
			$json = json_decode($countries, true);
			$data['countries'] = $json;
			$this->load->view('site/common/dangky', $data);
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
		);
		
		$this->load->model('Thongtinuser_model');
		$id_user = $this->Thongtinuser_model->add_user($params);
		
		$user_login = array(
			'iduser' => $id_user,
			'username' => $this->input->post('username'),
			'matkhau' => md5(my_encrypt($this->input->post('password'))),
		);
		$this->Thongtinuser_model->add_userlogin($user_login);
		if (!empty($this->input->get('code')))
		{
			$nguoigioithieu = $this->Thongtinuser_model->get_nguoigioithieu($this->input->get('code'));
			if(!empty($nguoigioithieu))
			{
				$idnguoigioithieu = array("nguoigioithieu" => $nguoigioithieu);
				$this->Thongtinuser_model->update_user($id_user,$idnguoigioithieu);
			}
		}
		$this->session->set_flashdata('mess', 'Register successfully');
		redirect(home_url());
	}

	function check_captcha()
	{
		if($this->input->post('captcha_image') != $this->session->userdata('captcha'))
		{
			$this->form_validation->set_message('check_captcha', 'The captcha is wrong');
			return false;
		}
		return true;
	}

	function create_captcha()
	{
		$this->load->helper('captcha');
		$vals = array(
        'word'          => '',
        'img_path'      => './public/captcha/',
        'img_url'       => './public/captcha/',
        'font_path'     => './system/fonts/texb.ttf',
        'img_width'     => '150',
        'img_height'    => 30,
        'expiration'    => 7200,
        'word_length'   => 6,
        'font_size'     => 16,
        'img_id'        => 'captcha',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
		);

		$cap = create_captcha($vals);
	  	$this->session->set_userdata('captcha', $cap['word']);
		echo $cap['image'];
	}
}
