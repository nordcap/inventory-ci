<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee extends CI_Controller {
	/**
	* Контроллер Employee обрабатывает заполнение ответственных сотрудников
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
		$this->load->model('Employee_model');
		//получить конфигурационные данные для пагинации
		$config_pag = $this->users_lib->get_config_pagination('employee');
		$this->pagination->initialize($config_pag);
		$data['pager'] = $this->pagination->create_links();
		$from = intval($this->uri->segment(3));	
		$data['from'] = $from;		
		$data['page'] = "employee";
		//обрабатываем нажатие кнопки add(Добавление)
			if (isset($_REQUEST['add']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('family') == TRUE)
			{
				$this->Employee_model->insert_table($this->input->post('family'));
				//перегружаем страницу чтобы очистить поля
				redirect('employee/index/'.$from,'refresh');
			}
		}
		//обрабатываем нажатие кнопки copy(Копирование)
			//------------------------------------------------------------------
		if(isset($_REQUEST['copy']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_employee = current($this->input->post('chk_id'));
				$array_emp = $this->Employee_model->copy_table($id_employee);
				$data['name_employee'] = $array_emp['Family'];
			}
		}
		//обрабатываем нажатие кнопки update(Обновление)
			//------------------------------------------------------------------
		if(isset($_REQUEST['update']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checkfamily') == TRUE)
			{
				$id_employee = $this->input->post('chk_id');
				$this->Employee_model->update_table($id_employee,$this->input->post('family'));
				//перегружаем страницу чтобы очистить поля
				redirect('employee/index/'.$from,'refresh');
			}
			}		
		//обрабатываем нажатие кнопки delete (Удаление)
			//------------------------------------------------------------------
		if(isset($_REQUEST['delete']))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_employee = $this->input->post('chk_id');
				$this->Employee_model->delete_table($id_employee);
			}
		}
		//получаем данные из табл Employee
		$data['array_employee'] = $this->Employee_model->getdata_table($from, $config_pag['per_page']);
		$this->load->view('main_view', $data);
	}
	//проверка на выделение строки 	
	//------------------------------------------------------------------
	public function isset_value_chk($chk_id)
	{
		return $this->users_lib->isset_value_chk($chk_id);
	}
	//проверка на совпадение значений инвентарных номеров	
	//------------------------------------------------------------------
	public function check_employee($name)
	{
		if ($this->Employee_model->check_employee($name) )
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
/* End of file employee.php */
/* Location: ./application/controllers/employee.php */