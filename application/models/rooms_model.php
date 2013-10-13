<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rooms_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();	
		$this->load->database();
	}
	//получение данных из всей таблицы
	//--------------------------------------------------------------------
	
	function getdata_table($page, $from)
	{
		$this->db->select('rooms.id, Num_room, Family');
		$this->db->from('rooms');
		$this->db->join('employee','rooms.Employee_id=employee.id');
		$this->db->order_by('Num_room');
		$this->db->limit($page, $from);
				
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row )
			{
				$result[] = $row;
			}
			return $result;
		}
		else 
		{
			return NULL;
		}
	}
	//получить массив комнат
	//--------------------------------------------------------------------
	
	function getRoom()
	{
		$query = $this->db->query("SELECT * FROM rooms ORDER BY BINARY Num_room");
		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row )
			{
				$result[$row['id']] = $row['Num_room'];
			}
			return $result;
		}
		else 
		{
			return NULL;
		}
		}	
	//вставка нового значения
	//--------------------------------------------------------------------
	
	function insert_table($room, $employee)
	{
		$data = array('Num_room' => $room, 'Employee_id' => $employee);
		$query = $this->db->insert('rooms', $data);
	}
	//копирование строки из базы
	//--------------------------------------------------------------------
	
	function copy_table($id)
	{
		$query = $this->db->get_where('rooms', array('id' => $id));
		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row )
			{
				$result = $row;
			}
			return $result;
		}
	}
	//обновление строки (несколько) из базы
	//--------------------------------------------------------------------
	
	function update_table($id, $room, $select)
	{
		$data = array(
		'Num_room' => $room,
		'Employee_id' => $select);
		$this->db->where_in('id', $id);
		$this->db->update('rooms', $data);
	}
	//удаление строки (несколько) из базы
	//--------------------------------------------------------------------
	
	function delete_table($id)
	{
		$this->db->where_in('id', $id);
		$this->db->delete('rooms');
	}
	//проверка наличия в базе сотрудника
	//--------------------------------------------------------------------	
	
	function check_room($name)
	{
		$query = $this->db->get_where('rooms',array('Num_room' => $name));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return false;
		}
		}	
}
/* End of file room_model.php */
/* Location: ./application/models/room_model.php */