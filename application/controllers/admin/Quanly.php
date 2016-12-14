<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quanly extends Admin {

	public function index()
	{
		if($this->session->userdata('role') != 1)
		{
			redirect(home_url());
		}
		$this->layout = 'common/dashboard';
		$this->render();
	}
}