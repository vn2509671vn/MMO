<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Thongtinbac_model extends CI_Model
{
	function add_bacnguoidung($params)
	{
		$this->db->insert('bacnguoidung',$params);
    	return $this->db->insert_id();
	}

	function add_bacnhay($params)
	{
		$this->db->insert('bacnhay',$params);
      return $this->db->insert_id();
	}

	function update_bacnhay($iduser, $params)
	{
		$this->db->where('iduser', $iduser);
		return $this->db->update('bacnhay', $params);
	}

	function update_bacnguoidung($iduser, $params)
	{
		$this->db->where('iduser', $iduser);
		return $this->db->update('bacnguoidung', $params);
	}

	function get_thongtinbac($id)
	{
		$this->db->from('bacnhay');
		$this->db->join('bacnguoidung','bacnhay.iduser = bacnguoidung.iduser');
		$this->db->where(array('bacnhay.iduser' => $id));
		$query = $this->db->get();

		return $query->row_array();
	}

	function get_soconf1($iduser)
	{
		$this->db->select('soconf1');
		$this->db->where(array('bacnguoidung.iduser'=> $iduser));
		$query = $this->db->get('bacnguoidung');
		return $query->row()->soconf1;
	}

	function get_lamlai($iduser)
	{
		$this->db->select('lamlai');
		$this->db->where(array('bacnhay.iduser'=> $iduser));
		$query = $this->db->get('bacnhay');
		return $query->row()->lamlai;
	}

	function get_sotienhienco($id)
	{
		$this->db->select('sotienhienco');
		$this->db->where(array('bacnhay.iduser'=> $id));
		$query = $this->db->get('bacnhay');
		return $query->row()->sotienhienco;
	}

	function get_levelhientai($iduser)
	{
		$this->db->select('levelhientai');
		$this->db->where('iduser', $iduser);
		return $this->db->get('bacnguoidung')->row()->levelhientai;
	}

	function get_list_bacnguoidung()
	{
		return $this->db->get('bacnguoidung')->result_array();
	}

	function get_list_level($levelhientai)
	{
		$this->db->select('iduser');
		$this->db->where('levelhientai', $levelhientai);
		// $this->db->order_by('ngaynhay', 'desc');
		return $this->db->get('bacnguoidung')->result_array();
	}

	function get_list_level_isuser($levelhientai)
	{
		$this->db->select('iduser');
		$this->db->where(array('levelhientai' => $levelhientai, 'isuser' => '0'));
		// $this->db->order_by('ngaynhay', 'desc');
		return $this->db->get('bacnguoidung')->result_array();
	}

	function add_hoahong($params)
	{
		$this->db->insert('lichsuhoahong',$params);
      return $this->db->insert_id();
	}


///////////////////////

	function get_nguoidung_level_0()
	{
		$this->db->select('iduser');
		$this->db->where('levelhientai', '0');
		$query = $this->db->get('bacnguoidung');
		$count = count($query->result_array());
		if ($count > 0)
		{
			return $query->row()->iduser;
		}
	}

	function get_thongtin($iduser)
	{
		$this->db->where(array('iduser' => $iduser));
		$query = $this->db->get('thongtinuser', 1);
		return $query->row_array();
	}

	function update_bacnguoidung_level_0($id_check)
	{
		$iduser_level_0 = $this->get_nguoidung_level_0();
		if($iduser_level_0 != $id_check)
		{
			$update_bacnhay = $this->get_thongtinbac($iduser_level_0);
			$sotienhienco = $this->Thongtinbac_model->get_sotienhienco($iduser_level_0);
			$sotienhienco = array(
				'sotienhienco' => ($sotienhienco + 50),
				'bac1' => ($update_bacnhay['bac1'] + 1)
			);
			$this->update_bacnhay($iduser_level_0, $sotienhienco);
			$params = array(
				'levelhientai' => 1,
				'isuser' => 0,
			);
			$this->db->where('levelhientai', '0');
			$this->db->update('bacnguoidung', $params);
			$thongtin_nguoidung = $this->get_thongtin($iduser_level_0);
			$nguoigioithieu = $this->Thongtinuser_model->get_thongtin($thongtin_nguoidung['nguoigioithieu']);
			if(!empty($nguoigioithieu) && $nguoigioithieu['trangthaikhoa'] == 0)
			{
				$sotienhienco = $this->Thongtinbac_model->get_sotienhienco($nguoigioithieu['iduser']);
				unset($params);
				$params = array(
					'sotienhienco' => ($sotienhienco + 5),
				);
				$this->Thongtinbac_model->update_bacnhay($nguoigioithieu['iduser'], $params);
			}
		}

		// $params_kichhoat = array(
		// 	'isuser' => 1,
		// );
		// $this->db->where('iduser', $id_kichhoat);
		// return $this->db->update('bacnguoidung', $params_kichhoat);
	}
	function get_ngaynhay($iduser)
	{
		$this->db->select('ngaynhay');
		$this->db->where('iduser', $iduser);
		return $check_ngaynhay = $this->db->get('bacnguoidung')->row()->ngaynhay;
	}
	function count_level_1($id_check)
	{
		$ngaynhay = $this->get_ngaynhay($id_check);
		$this->db->where(array('levelhientai' => '1', 'iduser !=' => $id_check, 'ngaynhay >=' => $ngaynhay, 'isuser' => '0'));
		// $this->db->order_by('ngaynhay', 'desc');
		$query = $this->db->get('bacnguoidung');
		$count = count($query->result_array());
		if($count > 1)
		{
			return true;
		}
		return false;
	}

	function get_list_level_1($id_check)
	{
		$ngaynhay = $this->get_ngaynhay($id_check);
		$this->db->select('iduser');
		$this->db->where(array('levelhientai' => '1', 'iduser !=' => $id_check, 'ngaynhay >=' => $ngaynhay, 'isuser' => '0'));
		// $this->db->order_by('ngaynhay', 'desc');
		$this->db->limit(2);
		return $this->db->get('bacnguoidung')->result_array();
	}

	function count_level_2($id_check)
	{
		$ngaynhay = $this->get_ngaynhay($id_check);
		$this->db->where(array('levelhientai' => '2', 'iduser !=' => $id_check, 'ngaynhay >=' => $ngaynhay, 'isuser' => '0'));
		// $this->db->order_by('ngaynhay', 'desc');
		$query = $this->db->get('bacnguoidung');
		$count = count($query->result_array());
		if($count >= 2)
		{
			return true;
		}
		return false;
	}

	function get_list_level_2($id_check)
	{
		$ngaynhay = $this->get_ngaynhay($id_check);
		$this->db->select('iduser');
		$this->db->where(array('levelhientai' => '2', 'iduser !=' => $id_check, 'ngaynhay >=' => $ngaynhay, 'isuser' => '0'));
		// $this->db->order_by('ngaynhay', 'desc');
		$this->db->limit(2);
		return $this->db->get('bacnguoidung')->result_array();
	}

	function count_level_3($id_check)
	{
		$ngaynhay = $this->get_ngaynhay($id_check);
		$this->db->where(array('levelhientai' => '3', 'iduser !=' => $id_check, 'ngaynhay >=' => $ngaynhay, 'isuser' => '0'));
		// $this->db->order_by('ngaynhay', 'desc');
		$query = $this->db->get('bacnguoidung');
		$count = count($query->result_array());
		if($count > 2)
		{
			return true;
		}
		return false;
	}

	function get_list_level_3($id_check)
	{
		$ngaynhay = $this->get_ngaynhay($id_check);
		$this->db->select('iduser');
		$this->db->where(array('levelhientai' => '3', 'iduser !=' => $id_check, 'ngaynhay >=' => $ngaynhay, 'isuser' => '0'));
		// $this->db->order_by('ngaynhay', 'desc');
		$this->db->limit(3);
		return $this->db->get('bacnguoidung')->result_array();
	}

	function get_list_levelasc($levelhientai)
	{
		$this->db->select('iduser');
		$this->db->where('levelhientai', $levelhientai);
		$this->db->order_by('ngaynhay', 'asc');
		return $this->db->get('bacnguoidung')->result_array();
	}
}
