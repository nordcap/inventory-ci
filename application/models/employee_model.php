<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();	
		$this->load->database();
	}
	//получение данных из всей таблицы
	//--------------------------------------------------------------------
	
	function getdata_table($from, $page)
	{
		$sql = "SELECT * FROM employee ORDER BY BINARY Family limit ?, ?";
		$query = $this->db->query($sql, array($from, $page));
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
	//получить массив фамилий
	//--------------------------------------------------------------------
	
	function getFamily()
	{
		$query = $this->db->query("SELECT * FROM employee ORDER BY BINARY Family");
		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row )
			{
				$result[$row['id']] = $row['Family'];
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
	
	function insert_table($family)
	{
		$data = array('Family'=>$family);
		$query = $this->db->insert('employee', $data);
	}
	//копирование строки из базы
	//--------------------------------------------------------------------
	
	function copy_table($id)
	{
		$query = $this->db->get_where('employee', array('id' => $id));
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
	
	function update_table($id, $family)
	{
		$data = array('Family' => $family);
		$this->db->where_in('id', $id);
		$this->db->update('employee', $data);
	}
	//удаление строки (несколько) из базы
	//--------------------------------------------------------------------
	
	function delete_table($id)
	{
		$this->db->where_in('id', $id);
		$this->db->delete('employee');
	}
	//проверка наличия в базе сотрудника
	//--------------------------------------------------------------------	
	
	function check_employee($name)
	{
		$query = $this->db->get_where('employee',array('Family' => $name));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		}	
}
/* End of file employee_model.php */
/* Location: ./application/models/employee_model.php */