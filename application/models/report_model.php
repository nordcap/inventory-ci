<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();	
		$this->load->database();
	}
	//получение данных из всей таблицы
	//--------------------------------------------------------------------
	
	function getdata_table($page, $from)
	{
		$this->db->select('report.id, Name, Inv_id, Price, Amortization, Number, Num_room, Family, Name_Category, Comment');
		$this->db->select('DATE_FORMAT(Time, "%d.%m.%Y") as Time', FALSE);
		$this->db->from('report');
		$this->db->join('assets','report.id_Assets = assets.id');
		$this->db->join('rooms','report.id_Room = rooms.id');
		$this->db->join('employee','rooms.Employee_id = employee.id');
		$this->db->join('category','assets.id_Category = category.id');
		$this->db->order_by('Inv_id');
		$this->db->limit($page, $from);
				
		$query = $this->db->get();
		return $query->result_array();

	}
	//поиск по введённым данным
	//--------------------------------------------------------------------
	
	function getdata_search($condition)
	{
		$this->db->select('report.id, Name, Inv_id, Price, Amortization, Number, Num_room, Family, Name_Category, Comment');
		$this->db->select('DATE_FORMAT(Time, "%d.%m.%Y") as Time', FALSE);
		$this->db->from('report');
		$this->db->join('assets','report.id_Assets = assets.id');
		$this->db->join('category','assets.id_Category = category.id');
		$this->db->join('rooms','report.id_Room = rooms.id');
		$this->db->join('employee','rooms.Employee_id = employee.id');
		$this->db->where($condition);
		$this->db->order_by('Inv_id');
		$query = $this->db->get();
		return $query->result_array();

	}
	//вставка нового значения
	//--------------------------------------------------------------------
	
	function insert_table($inv_select, $room_select, $amount, $comment)
	{
		$data = array(
					'id_Assets' => $inv_select, 
					'id_Room' 	=> $room_select,
					'Number' 	=> $amount,
					'Comment'	=> $comment);
		$query = $this->db->insert('report', $data);
	}
	//копирование строки из базы
	//--------------------------------------------------------------------
	
	function copy_table($id)
	{
		$query = $this->db->get_where('report',array('id' => $id));
		return $query->row_array();
	/*	if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row )
			{
				$result = $row;
			}
			return $result;
		}*/
	}
	//обновление строки (несколько) из базы
	//--------------------------------------------------------------------
	
	function update_table($id, $inv_select, $room_select, $amount, $comment)
	{
		$data = array(
					'id_Assets' => $inv_select, 
					'id_Room' 	=> $room_select,
					'Number' 	=> $amount,
					'Comment'	=> $comment);
					
		$this->db->where_in('id', $id);
		$this->db->update('report', $data);
	}
	//удаление строки (несколько) из базы
	//--------------------------------------------------------------------
	
	function delete_table($id)
	{
		$this->db->where_in('id', $id);
		$this->db->delete('report');
	}
	

}
/* End of file report_model.php */
/* Location: ./application/models/report_model.php */