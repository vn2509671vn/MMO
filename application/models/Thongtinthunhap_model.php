<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
class Thongtinthunhap_model extends CI_Model
{
	
	function get_income_info($id, $start = 0, $numrow = 15) // have not finished
	{
	$this->db->where(array('iduser' => $id));
	$this->db->limit($numrow, $start);
	$this->db->order_by('id', 'asc');
	$query = $this->db->get('thongtinthunhap');
	return $query->result_array();
	}

	function get_count_income_info($iduser)
	{
	$this->db->from('thongtinthunhap');
	$this->db->where(array('iduser' => $iduser));
	return $this->db->count_all_results();
	}

	//++Duy add tinh tong tien hoa hong
	function get_total_hoahongtructiep($iduser)
	{
	$query = $this->db->select_sum('sotiennhan', 'Total_sotiennhan');
	$query = $this->db->where(array('iduser' => $iduser, 'sotiennhan' => 45));
	$query = $this->db->get('lichsuhoahong');
	$result = $query->result();
	return $result[0]->Total_sotiennhan;
	//--
	}
	
	//++Duy add tinh tong tien hoa hong
	function get_total_hoahong($iduser)
	{
	$query = $this->db->select_sum('sotiennhan', 'Total_sotiennhan');
	$query = $this->db->where(array('iduser' => $iduser));
	$query = $this->db->get('lichsuhoahong');
	$result = $query->result();
	return $result[0]->Total_sotiennhan;
	//--
	}
}