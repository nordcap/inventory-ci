<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Assets_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();	
		$this->load->database();
	}
	//получение данных из всей таблицы
	//--------------------------------------------------------------------
	
	function getdata_table($page, $from)
	{
		$this->db->select('assets.id, Name, Inv_id, Price, Amortization, Name_Category');
		$this->db->select('DATE_FORMAT(Time, "%d.%m.%Y") as Time', FALSE);
		$this->db->from('assets');
		$this->db->join('category','assets.id_Category=category.id');
		$this->db->order_by('Inv_id');
		$this->db->limit($page, $from);

		$query = $this->db->get();
		return $query->result_array();
	}

//найти карточку по его id
  function getdata_search($where)
  {
		$this->db->select('assets.id, Name, Inv_id, Price, Amortization, Name_Category');
		$this->db->select('DATE_FORMAT(Time, "%d.%m.%Y") as Time', FALSE);
		$this->db->from('assets');
		$this->db->join('category','assets.id_Category=category.id');
    	$this->db->where('Inv_id',$where);
		$this->db->order_by('Inv_id');

		$query = $this->db->get();
    return $query->result_array();
  }
	//получить массив инвентарных значений
	//--------------------------------------------------------------------
	
	function getInventory()
	{
		$query = $this->db->query("SELECT * FROM assets ORDER BY BINARY Inv_id");
		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row )
			{
				$result[$row['id']] = $row['Inv_id'];
			}
			return $result;
		}
		else 
		{
			return NULL;
		}
		}	
		
		
	//получить наименование инвентарного средства по его id
	//--------------------------------------------------------------------	
	function getname_is_id($id)
	{
		$this->db->select('Name, Inv_id ');
		$this->db->from('assets');
		$this->db->where('id',$id);		
		$query = $this->db->get();	

		if($query->num_rows() > 0) 
		{
			$row = $query->row_array();
			return $row['Name'];
		}	

		
	}
	
			
	//вставка нового значения
	//--------------------------------------------------------------------
	
	function insert_table($number_assets, $name_assets, $price_assets, $amortization_assets, $date_assets, $cat_select)
	{
		$data = array(
		'Inv_id'=>$number_assets, 
		'Name'=>$name_assets,
		'Price'=>$price_assets,
		'Amortization'=>$amortization_assets,
		'Time'=>$date_assets,
		'id_Category'=>$cat_select);
		$query = $this->db->insert('assets', $data);
	}
	//копирование строки из базы
	//--------------------------------------------------------------------
	
	function copy_table($id)
	{
		$this->db->select('Inv_id, Name, Price, Amortization, id_Category');
		$this->db->select('DATE_FORMAT(Time, "%d.%m.%Y") as Time', FALSE);
		$this->db->from('assets');		
		$this->db->where('id',$id);
		$query = $this->db->get();	
		return $query->row_array();	
	}
	//обновление строки (несколько) из базы
	//--------------------------------------------------------------------
	
	function update_table($id, $number_assets, $name_assets, $price_assets, $amortization_assets, $date_assets, $cat_select)
	{
		$data = array(
		'Inv_id'=>$number_assets, 
		'Name'=>$name_assets,
		'Price'=>$price_assets,
		'Amortization'=>$amortization_assets,
		'Time'=>$date_assets,
		'id_Category'=>$cat_select);		
		$this->db->where_in('id', $id);
		$this->db->update('assets',$data);
	}
	//удаление строки (несколько) из базы
	//--------------------------------------------------------------------
	
	function delete_table($id)
	{
		$this->db->where_in('id', $id);
		$this->db->delete('assets');
	}
	//проверка наличия в базе инв.номера
	//--------------------------------------------------------------------	
	
	function check_number_inv($name)
	{
		$query = $this->db->get_where('assets',array('Inv_id' => $name));
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
/* End of file assets_model.php */
/* Location: ./application/models/assets_model.php */