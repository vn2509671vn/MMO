<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nguoiduocgioithieu extends Admin {

	public function get_childs($iduser)
	{
		if($this->session->userdata('role') != 1)
		{
			redirect(home_url());
		}
		$this->load->model('Thongtinuser_model');
		$data['list'] = $this->Thongtinuser_model->tim_nguoiduocgioithieu($iduser);
		$this->layout = 'common/nguoiduocgioithieu';
		$this->render($data);
	}
}