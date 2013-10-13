<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller {
	/**
	* Контроллер Category обрабатывает заполнение категорий инвентарных средств
	*/
	
	function __construct()
	{
		parent::__construct();	
		//загрузка пользовательской библиотеки
		$this->load->library('users_lib');		
		$data = array();
	}
	//основная функция контроллера
	public function index()
	{
		//загружаем модель и получаем необходимые данные для отображеня в виде
		$this->load->model('Category_model');
		//получить конфигурационные данные для пагинации
		$config_pag = $this->users_lib->get_config_pagination('category');
		$this->pagination->initialize($config_pag);
		$data['pager'] = $this->pagination->create_links();
		$from = intval($this->uri->segment(3));
		$data['from'] = $from;	
		$data['page'] = "category";
		//обрабатываем нажатие кнопки add(Добавление)
			if (isset($_REQUEST['add']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('category') == TRUE)
			{
				$this->Category_model->insert_table($this->input->post('category'));
				//перегружаем страницу чтобы очистить поля
				redirect('category/index/'.$from,'refresh');
			}
		}
		//обрабатываем нажатие кнопки copy(Копирование)
			//------------------------------------------------------------------
		if(isset($_REQUEST['copy']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_category = current($this->input->post('chk_id'));
				$array_cat = $this->Category_model->copy_table($id_category);
				$data['name_category'] = $array_cat['Name_Category'];
			}
		}
		//обрабатываем нажатие кнопки update(Обновление)
			//------------------------------------------------------------------
		if(isset($_REQUEST['update']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checkcategory') == TRUE)
			{
				$id_category = $this->input->post('chk_id');
				$this->Category_model->update_table($id_category,$this->input->post('category'));
				//перегружаем страницу чтобы очистить поля
				redirect('category/index/'.$from,'refresh');
			}
			}		
		//обрабатываем нажатие кнопки delete (Удаление)
			//------------------------------------------------------------------
		if(isset($_REQUEST['delete']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_category = $this->input->post('chk_id');
				$this->Category_model->delete_table($id_category);
			}
		}
		//получаем данные из табл Category
		$data['array_category'] = $this->Category_model->getdata_table($from, $config_pag['per_page']);
		$this->load->view('main_view', $data);
	}
	//проверка на выделение строки 	
	//------------------------------------------------------------------
	public function isset_value_chk($chk_id)
	{
		return $this->users_lib->isset_value_chk($chk_id);
	}
	//проверка на совпадение значений категорий
	//------------------------------------------------------------------
	public function check_category($name)
	{
		if ($this->Category_model->check_category($name) )
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//тестовое отображение значения 	
	//------------------------------------------------------------------	
	public function info($argv)
	{
		print('<pre>');
		print_r($argv);
		print('</pre>');
		exit;
	}
}
/* End of file category.php */
/* Location: ./application/controllers/category.php */