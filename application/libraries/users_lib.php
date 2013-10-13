<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_lib {
	//проверка на выделение строки 	
	//------------------------------------------------------------------
	public function isset_value_chk($chk_id)
	{
		//если хотя бы одна строка будет выбрана, то возвращаем ИСТИНУ
		if($chk_id AND count($chk_id) > 0)
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
		
	}
	//заполнение поля
	//------------------------------------------------------------------
	public function check_empty($data)
	{
		if (empty($data))
		{
			return 0;
		}
		else
		{
			return TRUE;
		}
	}		
		
	//конфигурация пагинации в зависимости от контроллера
	public function get_config_pagination($name_controller)
	{
		$CI = & get_instance();			
		//инициализируем нумерацию страниц
		$config_pag['base_url'] = site_url().'/'.$name_controller.'/index/';
		$config_pag['total_rows'] = $CI->db->count_all($name_controller);
		$config_pag['per_page'] = 30;
		$config_pag['uri_segment'] = 3;
		$config_pag['num_links'] = 10;
		$config_pag['full_tag_open'] = '<div class="pagination">';
		$config_pag['full_tag_close'] = '</div>';
		$config_pag['first_link'] = 'первая';
		$config_pag['last_link'] = 'последняя';
		$config_pag['next_link'] = '&raquo;';
		$config_pag['prev_link'] = '&laquo;';
		$config_pag['cur_tag_open'] = '<b>';
		$config_pag['cur_tag_close'] = '</b>';
		return $config_pag;
	}
	
}
/* End of file users_lib.php */
/* Location: ./libraries/users_lib.php */