<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();	
		$this->load->database();
	}
	//получение данных из всей таблицы
	//--------------------------------------------------------------------
	
	function getdata_table($from, $page)
	{
		$sql = "SELECT * FROM category ORDER BY BINARY Name_Category DESC limit ?, ?";
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
	//получить массив категорий
	//--------------------------------------------------------------------
	
	function getCategory()
	{
		$query = $this->db->query("SELECT * FROM category ORDER BY BINARY Name_Category DESC");
		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row )
			{
				$result[$row['id']] = $row['Name_Category'];
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
	
	function insert_table($category)
	{
		$data = array('Name_Category'=>$category);
		$query = $this->db->insert('category', $data);
	}
	//копирование строки из базы
	//--------------------------------------------------------------------
	
	function copy_table($id)
	{
		$query = $this->db->get_where('category', array('id' => $id));
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
	
	function update_table($id, $category)
	{
		$data = array('Name_Category' => $category);
		$this->db->where_in('id', $id);
		$this->db->update('category', $data);
	}
	//удаление строки (несколько) из базы
	//--------------------------------------------------------------------
	
	function delete_table($id)
	{
		$this->db->where_in('id', $id);
		$this->db->delete('category');
	}
	//проверка наличия в базе сотрудника
	//--------------------------------------------------------------------	
	
	function check_category($name)
	{
		$query = $this->db->get_where('category',array('Name_Category' => $name));
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
/* End of file category_model.php */
/* Location: ./application/models/category_model.php */