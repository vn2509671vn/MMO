<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
}

class Site extends MY_Controller
{
	protected $CI;
	function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();
	}

	protected $layout = NULL;
	protected $title = 'Trang chủ';
	public function render($data = array())
	{
		$this->CI->load->model('Thongtinuser_model');
		$data['check'] = $this->Thongtinuser_model->get_infologin($this->session->userdata('info_login'))['kichhoat'];
		$data['layout'] = ! empty($this->layout) ? $this->layout : show_404();
		$data['title'] = $this->title;
		$this->load->view('site/template', $data);
	}
}

class Admin extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	protected $layout = NULL;
	protected $title = 'Trang chủ';

	public function render($data = array())
	{
		$data['layout'] = ! empty($this->layout) ? $this->layout : show_404();
		$data['title'] = $this->title;
		$this->load->view('admin/template', $data);
	}
}