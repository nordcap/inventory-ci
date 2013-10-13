<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class rooms extends CI_Controller {
	/**
	* Контроллер rooms обрабатывает заполнение комнат
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
		$this->load->model('Rooms_model');
		$this->load->model('Employee_model');
		
		//получить конфигурационные данные для пагинации
		$config_pag = $this->users_lib->get_config_pagination('rooms');
		$this->pagination->initialize($config_pag);
		$data['pager'] = $this->pagination->create_links();
		$from = intval($this->uri->segment(3));
		$data['from'] = $from;	
			
		$data['page'] = "rooms";
		//обрабатываем нажатие кнопки add(Добавление)
			if (isset($_REQUEST['add']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('rooms') == TRUE)
			{
				$this->Rooms_model->insert_table($this->input->post('room'),$this->input->post('emp_select'));
				//перегружаем страницу чтобы очистить поля
				redirect('rooms/index/'.$from,'refresh');
			}
		}
		//обрабатываем нажатие кнопки copy(Копирование)
			//------------------------------------------------------------------
		if(isset($_REQUEST['copy']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_room = current($this->input->post('chk_id'));
				$array_room = $this->Rooms_model->copy_table($id_room);
				$data['num_room'] = $array_room['Num_room'];
				$data['employee_id'] = $array_room['Employee_id'];
			}

		}
		//обрабатываем нажатие кнопки update(Обновление)
			//------------------------------------------------------------------
		if(isset($_REQUEST['update']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checkroom') == TRUE)
			{
				$id_room = $this->input->post('chk_id');
				$this->Rooms_model->update_table($id_room, $this->input->post('room'), $this->input->post('emp_select'));
				//перегружаем страницу чтобы очистить поля
				redirect('rooms/index/'.$from,'refresh');
			}
			}		
		//обрабатываем нажатие кнопки delete (Удаление)
			//------------------------------------------------------------------
		if(isset($_REQUEST['delete']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_room = $this->input->post('chk_id');
				$this->Rooms_model->delete_table($id_room);
			}
		}
		//получаем данные из табл Category
		$data['array_room'] = $this->Rooms_model->getdata_table($config_pag['per_page'], $from);
		//список фамилий
		$data['array_employee'] = $this->Employee_model->getFamily();
		$this->load->view('main_view', $data);
	}
	//проверка на совпадение значений комнат	
	//------------------------------------------------------------------
	public function check_room($name)
	{
		if ($this->Rooms_model->check_room($name) )
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
		}	
	//проверка на выделение строки 	
	//------------------------------------------------------------------
	public function isset_value_chk($chk_id)
	{
		return $this->users_lib->isset_value_chk($chk_id);
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
/* End of file rooms.php */
/* Location: ./application/controllers/rooms.php */