<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kichhoat extends Admin {

	public function index()
	{
		if($this->session->userdata('role') != 1)
		{
			redirect(home_url());
		}
		$this->load->library('pagination');
		$this->load->model('Thongtinuser_model');
    	$this->config->load('my_config');
    	$config['total_rows'] = $this->Thongtinuser_model->count_list_kichhoat();
    	$config['per_page'] = $this->config->item('per_page');
    	$config['base_url'] = admin_url() .'/approve-register';
    	$this->pagination->initialize($config);
    	$data['pagination'] = $this->pagination->create_links();
     	$start_row = intval($this->input->get('bat-dau'));
		$data['list_kichhoat'] = $this->Thongtinuser_model->get_list_kichhoat($start_row, $config['per_page']);
		$this->nhaybac();
		$this->layout = 'common/kichhoat';
		$this->render($data);
	}

	function remove($iduser)
	{
		$this->load->model('Thongtinuser_model');
		$this->Thongtinuser_model->delete_kichhoat($iduser);
		$this->session->set_flashdata('mess','Delete account successfully'); 
		redirect(admin_url('approve-register'));
	}
	
	function get_kichhoat($iduser)
	{
		if($this->session->userdata('role') != 1)
		{
			redirect(home_url());
		}
		$this->load->model('Thongtinuser_model');
		$this->load->model('Thongtinbac_model');
		$this->load->model('Thongtintien_model');
							
		$iduser_level_0 = $this->Thongtinbac_model->get_nguoidung_level_0();
		if (!empty($iduser_level_0))
		{
			$thongtin_thunhap = array(
				'iduser' => $iduser_level_0,
				'mota'	=> 'Level 0 > Level 1',
				'ngay' => date('Y-m-d H:i:s'),
				'thunhap' => 50
			);
			$this->Thongtintien_model->add_thongtinthunhap($thongtin_thunhap);
	
			//++Duy add : Insert Hoa hong level 0 to History Info
			$info_user_level_0 = $this->Thongtinuser_model->get_thongtin($iduser_level_0);
			
			//++Duy add inform level up -> mail to user
			$recipient_email = $info_user_level_0['email'];
			$subject = "[Snowballworld] Account level up";
			$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
			$body = 'You have just received 50$ from level up : Level 0 > Level 1.
			<br />Check your cash in '.$htmlStr;
			$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
			//--
			$nguoigioithieu_level0 =  $this->Thongtinuser_model->get_thongtin($info_user_level_0['nguoigioithieu']);
			if(!empty($nguoigioithieu_level0) && $nguoigioithieu_level0['trangthaikhoa'] == 0)
			{
			$hoahong_level0 = array(
					'iduser' => $nguoigioithieu_level0['iduser'],
					'sotiennhan' => 5,
					'ngaynhan' => date('Y-m-d H:i:s'),
					'nguoidangky' => $info_user_level_0['hoten'].' Level 0 > Level 1',
				);
			$this->Thongtinbac_model->add_hoahong($hoahong_level0);
			
			//++Duy add inform children account level up -> mail to user
			$recipient_email = $nguoigioithieu_level0['email'];
			$subject = "[Snowballworld] Children's account level up";
			$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
			$body = 'You have just received 5$ from '.$info_user_level_0['hoten'].' : Level 0 > Level 1.<br />Check your cash in '.$htmlStr;
			$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
			//--
			}
			
			$this->Thongtinbac_model->update_bacnguoidung_level_0($iduser);
		}
		//--

		$params = array("kichhoat" => 1);
		$this->Thongtinuser_model->update_userlogin($iduser, $params);
		$info_user = $this->Thongtinuser_model->get_thongtin($iduser);
		
		$thongtinbac = array('iduser' => $info_user['iduser'],
							'ngaynhay' => date('Y-m-d H:i:s'));
		// $this->Thongtinbac_model->update_bacnguoidung_level_0($info_user['iduser']);
		$this->Thongtinbac_model->add_bacnguoidung($thongtinbac);
		$bacnhay = array('iduser' => $info_user['iduser']);
		$this->Thongtinbac_model->add_bacnhay($bacnhay);
		
		//++Duy add inform account has just approved -> mail to user
		$recipient_email = $info_user['email'];
		$subject = '[Snowballworld] Active account';
		$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
		$body = 'Your account has just approved.<br /> Welcome to ' . $htmlStr;
		$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
		//--

		$nguoigioithieu = $this->Thongtinuser_model->get_thongtin($info_user['nguoigioithieu']);
		if(!empty($nguoigioithieu))
		{
			$soconf1 = $this->Thongtinbac_model->get_thongtinbac($nguoigioithieu['iduser'])['soconf1'];
			$bacnguoidung = array(
				'soconf1' => ($soconf1 + 1),
			);
			$this->Thongtinbac_model->update_bacnguoidung($nguoigioithieu['iduser'], $bacnguoidung);
			
			if ($nguoigioithieu['trangthaikhoa'] == 0)
			{
				$sotienhienco = $this->Thongtinbac_model->get_sotienhienco($nguoigioithieu['iduser']);
				unset($params);
				$params = array(
					'sotienhienco' => ($sotienhienco + 45),
				);
				$this->Thongtinbac_model->update_bacnhay($nguoigioithieu['iduser'], $params);
				$hoahong = array(
					'iduser' => $nguoigioithieu['iduser'],
					'sotiennhan' => 45,
					'ngaynhan' => date('Y-m-d H:i:s'),
					'nguoidangky' => $info_user['hoten'].' registered',
				);
				$this->Thongtinbac_model->add_hoahong($hoahong);
				
				//++Duy add inform children account register -> mail to user
				$recipient_email = $nguoigioithieu['email'];
				$subject = "[Snowballworld] Children's account registered";
				$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
				$body = 'You have just received 45$ from '.$info_user['hoten'].' registered.<br />Check your cash in '.$htmlStr;
				$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
				//--
			}
		}
		$this->nhaybac();
		$this->session->set_flashdata('mess','Approve account successfully'); 
		redirect(admin_url('approve-register'));
	}

	private function nhaybac()
	{
		$this->load->model('Thongtinbac_model');
		$list_bacnguoidung = $this->Thongtinbac_model->get_list_bacnguoidung();
		for ($i=0; $i < count($list_bacnguoidung); $i++) { 
			$user_check = $list_bacnguoidung[$i];
			for ($j=0; $j < count($list_bacnguoidung); $j++) { 
				$user = $list_bacnguoidung[$j];
				if($user['iduser'] != $user_check['iduser'])
				{
					$this->dequy_nhaybac($user_check['iduser'], $user_check['levelhientai']);
					break;
				}
			}
		}
	}

	private function congthemtien($iduser, $sotiencong)
	{
		$thongtin_nguoidung = $this->Thongtinuser_model->get_thongtin($iduser);
		$nguoigioithieu = $this->Thongtinuser_model->get_thongtin($thongtin_nguoidung['nguoigioithieu']);
		if(!empty($nguoigioithieu))
		{
			$sotienhienco = $this->Thongtinbac_model->get_sotienhienco($nguoigioithieu['iduser']);
			unset($params);
			$params = array(
				'sotienhienco' => ($sotienhienco + $sotiencong),
			);
			$this->Thongtinbac_model->update_bacnhay($nguoigioithieu['iduser'], $params);
		}
	}

	private function dequy_nhaybac($iduser, $level)
	{
		$this->load->model('Thongtintien_model');
		$this->load->model('Thongtinbac_model');
		$this->load->model('Thongtinuser_model');
		switch ($level) {
			case '1':
			{
				$check = $this->Thongtinbac_model->count_level_1($iduser);
				if($check)
				{
					$sotienhienco = $this->Thongtinbac_model->get_sotienhienco($iduser);
					$update_bacnhay = $this->Thongtinbac_model->get_thongtinbac($iduser);
					$bacnhay = array(
						'sotienhienco' => ($sotienhienco + 100),
						'bac2' => ($update_bacnhay['bac2'] + 1)
					);
					$this->Thongtinbac_model->update_bacnhay($iduser, $bacnhay);
					$list_update = $this->Thongtinbac_model->get_list_level_1($iduser);
						foreach ($list_update as $user_update) {
							$bacnguoidung_update = array(
							'isuser' => 1,
						);
						$this->Thongtinbac_model->update_bacnguoidung($user_update['iduser'], $bacnguoidung_update);
					}
					$bacnguoidung = array(
						'levelhientai' => ($level + 1),
						'ngaynhay' => date('Y-m-d H:i:s'),
						'isuser' => 0,
					);
					$this->Thongtinbac_model->update_bacnguoidung($iduser, $bacnguoidung);
					$thongtin_thunhap = array(
						'iduser' => $iduser,
						'mota'	=> 'Level 1 > Level 2',
						'ngay' => date('Y-m-d H:i:s'),
						'thunhap' => 100
					);
					$this->Thongtintien_model->add_thongtinthunhap($thongtin_thunhap);

					//++Duy add : Insert Hoa hong level 1 to History Info
					$info_user_level_1 = $this->Thongtinuser_model->get_thongtin($iduser);
					//++Duy add inform level up -> mail to user
					$recipient_email = $info_user_level_1['email'];
					$subject = "[Snowballworld] Account level up";
					$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
					$body = 'You have just received 100$ from level up : Level 1 > Level 2.
					<br />Check your cash in '.$htmlStr;
					$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
					//--
					$nguoigioithieu_level1 =  $this->Thongtinuser_model->get_thongtin($info_user_level_1['nguoigioithieu']);
					if(!empty($nguoigioithieu_level1) && $nguoigioithieu_level1['trangthaikhoa'] == 0)
					{
					$hoahong_level1 = array(
							'iduser' => $nguoigioithieu_level1['iduser'],
							'sotiennhan' => 10,
							'ngaynhan' => date('Y-m-d H:i:s'),
							'nguoidangky' => $info_user_level_1['hoten'].' Level 1 > Level 2',
						);
					$this->Thongtinbac_model->add_hoahong($hoahong_level1);
					$this->congthemtien($iduser, 10);
					
					//++Duy add inform children account level up -> mail to user
					$recipient_email = $nguoigioithieu_level1['email'];
					$subject = "[Snowballworld] Children's account level up";
					$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
					$body = 'You have just received 10$ from '.$info_user_level_1['hoten'].' : Level 1 > Level 2.
					<br />Check your cash in '.$htmlStr;
					$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
					//--
					}
					//--
				}
				break;
			}
			
			case '2':
			{
				$check = $this->Thongtinbac_model->count_level_2($iduser);
				if($check)
				{
					$sotienhienco = $this->Thongtinbac_model->get_sotienhienco($iduser);
					$update_bacnhay = $this->Thongtinbac_model->get_thongtinbac($iduser);
					$bacnhay = array(
						'sotienhienco' => ($sotienhienco + 250),
						'bac3' => ($update_bacnhay['bac3'] + 1)
					);
					$this->Thongtinbac_model->update_bacnhay($iduser, $bacnhay);
					$list_update = $this->Thongtinbac_model->get_list_level_2($iduser);
						foreach ($list_update as $user_update) {
							$bacnguoidung_update = array(
							'isuser' => 1,
						);
						$this->Thongtinbac_model->update_bacnguoidung($user_update['iduser'], $bacnguoidung_update);
					}
					$bacnguoidung = array(
						'levelhientai' => ($level + 1),
						'ngaynhay' => date('Y-m-d H:i:s'),
						'isuser' => 0,
					);
					$this->Thongtinbac_model->update_bacnguoidung($iduser, $bacnguoidung);

					$thongtin_thunhap = array(
						'iduser' => $iduser,
						'mota'	=> 'Level 2 > Level 3',
						'ngay' => date('Y-m-d H:i:s'),
						'thunhap' => 250
					);
					$this->Thongtintien_model->add_thongtinthunhap($thongtin_thunhap);

					//++Duy add : Insert Hoa hong level 2 to History Info
					$info_user_level_2 = $this->Thongtinuser_model->get_thongtin($iduser);
					//++Duy add inform level up -> mail to user
					$recipient_email = $info_user_level_2['email'];
					$subject = "[Snowballworld] Account level up";
					$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
					$body = 'You have just received 250$ from level up : Level 2 > Level 3.
					<br />Check your cash in '.$htmlStr;
					$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
					//--
					$nguoigioithieu_level2 =  $this->Thongtinuser_model->get_thongtin($info_user_level_2['nguoigioithieu']);
					if(!empty($nguoigioithieu_level2) && $nguoigioithieu_level2['trangthaikhoa'] == 0)
					{
					$hoahong_level2 = array(
							'iduser' => $nguoigioithieu_level2['iduser'],
							'sotiennhan' => 25,
							'ngaynhan' => date('Y-m-d H:i:s'),
							'nguoidangky' => $info_user_level_2['hoten'].' Level 2 > Level 3',
						);
					$this->Thongtinbac_model->add_hoahong($hoahong_level2);
					$this->congthemtien($iduser, 25);
					
					//++Duy add inform children account level up -> mail to user
					$recipient_email = $nguoigioithieu_level2['email'];
					$subject = "[Snowballworld] Children's account level up";
					$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
					$body = 'You have just received 25$ from '.$info_user_level_2['hoten'].' : Level 2 > Level 3.
					<br />Check your cash in '.$htmlStr;
					$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
					//--
					}
					//--
				}
				break;
			}

			case '3':
			{
				$check = $this->Thongtinbac_model->count_level_3($iduser);
				$check_conf1 = $this->Thongtinbac_model->get_soconf1($iduser);
				$info_user_check = $this->Thongtinuser_model->get_thongtin($iduser);
				
				if($check)
				{
					if ($check_conf1 >= 1)
					{
						if ($info_user_check['trangthaikhoa'] == 0)
						{
							$sotienhienco = $this->Thongtinbac_model->get_sotienhienco($iduser);
							$update_bacnhay = $this->Thongtinbac_model->get_thongtinbac($iduser);
							$lamlai = $this->Thongtinbac_model->get_lamlai($iduser);
							$bacnhay = array(
								'sotienhienco' => ($sotienhienco + 300),
								'lamlai' => ($lamlai + 1)
							);
							$this->Thongtinbac_model->update_bacnhay($iduser, $bacnhay);
							$list_update = $this->Thongtinbac_model->get_list_level_3($iduser);
								foreach ($list_update as $user_update) {
									$bacnguoidung_update = array(
									'isuser' => 1,
								);
								$this->Thongtinbac_model->update_bacnguoidung($user_update['iduser'], $bacnguoidung_update);
							}
							$check_conf1_update = $check_conf1 - 1;
							$this->Thongtinbac_model->update_bacnguoidung_level_0($iduser);
							$bacnguoidung = array(
								'levelhientai' => 0,
								'ngaynhay' => date('Y-m-d H:i:s'),
								'isuser' => 0,
								'soconf1' => $check_conf1_update,
							);
							$this->Thongtinbac_model->update_bacnguoidung($iduser, $bacnguoidung);
							$thongtin_thunhap = array(
								'iduser' => $iduser,
								'mota'	=> 'Level 3 > Level 4',
								'ngay' => date('Y-m-d H:i:s'),
								'thunhap' => 600
							);
							$this->Thongtintien_model->add_thongtinthunhap($thongtin_thunhap);
							
							$thongtin_thunhap = array(
								'iduser' => $iduser,
								'mota'	=> 'Level 4 > Level 0',
								'ngay' => date('Y-m-d H:i:s'),
								'thunhap' => (-300),
							);
							$this->Thongtintien_model->add_thongtinthunhap($thongtin_thunhap);
							
							if(!empty($info_user_check))
							{
								$check_ngt = $this->Thongtinuser_model->get_thongtin($info_user_check['nguoigioithieu']);
								$sotienhienco = $this->Thongtinbac_model->get_sotienhienco($check_ngt['iduser']);
								$params = array(
									'sotienhienco' => ($sotienhienco + 60),
								);
								$this->Thongtinbac_model->update_bacnhay($check_ngt['iduser'], $params);
							}
							
							//++Duy add inform level up -> mail to user
							$recipient_email = $info_user_check['email'];
							$subject = "[Snowballworld] Account level up";
							$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
							$body = 'You have just received 600$ from level up : Level 3 > Level 4.
							<br />Check your cash in '.$htmlStr;
							$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
							//--
							
							//++Duy add inform level up -> mail to user
							$recipient_email = $info_user_check['email'];
							$subject = "[Snowballworld] Account reset";
							$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
							$body = 'You have just lost 300$ from reset level.
							<br />Check your cash in '.$htmlStr;
							$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
							//--
		
							//++Duy add : Insert Hoa hong level 3 to History Info
							$info_user_level_3 = $this->Thongtinuser_model->get_thongtin($iduser);
							$nguoigioithieu_level3 =  $this->Thongtinuser_model->get_thongtin($info_user_level_3['nguoigioithieu']);
							if(!empty($nguoigioithieu_level3) && $nguoigioithieu_level3['trangthaikhoa'] == 0)
							{
								$hoahong_level3 = array(
										'iduser' => $nguoigioithieu_level3['iduser'],
										'sotiennhan' => 60,
										'ngaynhan' => date('Y-m-d H:i:s'),
										'nguoidangky' => $info_user_level_3['hoten'].' Level 3 > Level 4',
									);
								$this->Thongtinbac_model->add_hoahong($hoahong_level3);
								$this->congthemtien($iduser, 60);
								
								//++Duy add inform children account level up -> mail to user
								$recipient_email = $nguoigioithieu_level3['email'];
								$subject = "[Snowballworld] Children's account level up";
								$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
								$body = 'You have just received 60$ from '.$info_user_level_3['hoten'].' : Level 3 > Level 4.
								<br />Check your cash in '.$htmlStr;
								$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
								//--
							}
						}
						//--
						else
						{
							//++Duy add inform Level 3 have child = 0 -> mail to admin
							
							$time = new DateTime();
					        $datetime = $time->modify('+1 day');
					        $datetime = $datetime->format('Y-m-d H:i:s');
					        
					        $timeremain = array("timeremain" => $datetime);
					        $this->load->model('Lockaccount_model');
					        $this->Lockaccount_model->update_timeremain($iduser, $timeremain);
					        
							$recipient_email = 'snowball.us2016@gmail.com';
							$subject = '[Snowballworld] There is an account in level 3 without child';
							
							$body = 'ID : '.$info_user_check['hoten'].'<br />'.
							'Time remain : '.$datetime;
							$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
							//--
						}
					}
				}
				break;
			}
		}
	}
}