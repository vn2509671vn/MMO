<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kichhoat extends Site {

	public function index()
	{
		if(!$this->session->has_userdata('session_login'))
		{
			redirect(home_url());
		}
		if($this->session->has_userdata('role'))
		{
			redirect(home_url());
		}
	 	$this->load->model('Thongtinuser_model');
	 	$this->load->model('Lockaccount_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('makichhoat', 'Active code', 'required|min_length[5]|trim');
		$iduser = $this->session->userdata('iduser');
		$user_info = $this->Thongtinuser_model->get_thongtin($iduser);
		
		if( $this->form_validation->run() == TRUE)
		{
			$makichhoat =  $this->input->post('makichhoat');
			
			if ($user_info['trangthaikhoa'] == 0)
			{
			 	$params = array('transactionhash' => $makichhoat);
				$this->Thongtinuser_model->update_userlogin($iduser,$params);
				$this->session->set_flashdata('mess','Your transactionhash has been sent to and watting for approved. Please wait for a moment');
				$this->session->set_flashdata('alert','info');
				
				// Get ngay tham gia = ngay hien tai
				$ngaythamgia  = date('Y-m-d H:i:s');
				// Update lai ngay tham gia trong bang thongtinuser
				$this->Thongtinuser_model->update_ngaythamgia($user_info['iduser'], $ngaythamgia);
				
				//++Duy add inform new account has just registered -> mail to admin
				$recipient_email = 'snowball.us2016@gmail.com';
				$subject = '[Snowballworld] New account has just registered';
				$body = 'There is a new account has just registered in Snowballworld.';
				$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
				//--
			}
			else
			{
				$params = array('hashlock' => $makichhoat);
				$this->Lockaccount_model->update_trangthaikhoa($user_info['iduser'], $params);
				$this->session->set_flashdata('mess','Your transactionhash has been sent to and watting for approve to unlock account. Please wait for a moment');
				$this->session->set_flashdata('alert','info');
				
				//++Duy add inform new account has just registered -> mail to admin
				$recipient_email = 'snowball.us2016@gmail.com';
				$subject = '[Snowballworld] Unlock account';
				$body = 'There is a new account has just sent unlock transaction hash in Snowballworld.';
				$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
				//--
			}
			redirect(home_url('active-acount'));
		}
		else
		{
			$data['check_kichhoat'] = $this->Thongtinuser_model->get_infologin_byid($iduser);
			$data['userinfo'] = $user_info;
			$this->layout = 'common/kichhoat';
			$this->render($data);
		}
	}

}