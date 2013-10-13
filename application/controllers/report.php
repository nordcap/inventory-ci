<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends CI_Controller {
	/**
	Главный контроллер приложения обрабатывает отображение сводной информации по активам
	*/
	
	function __construct()
	{
		parent::__construct();	
		//загрузка пользовательской библиотеки
		$this->load->library('users_lib');	
		$this->load->library('session');
		$this->load->model('Assets_model');
		$this->load->model('Rooms_model');		
		$this->load->model('Report_model');
		$data = array();
	}

	//основная функция контроллера
	public function index()
	{
		
		$data['page'] = "report";
		//загружаем модель и получаем необходимые данные для отображеня в виде
		//получить конфигурационные данные для пагинации
		$config_pag = $this->users_lib->get_config_pagination('report');
		$this->pagination->initialize($config_pag);
		$data['pager'] = $this->pagination->create_links();
		$from = intval($this->uri->segment(3));
		$data['from'] = $from;
		//обрабатываем нажатие кнопки add(Добавление)
			if ($this->input->post('add'))
		{
			//проверяем входные данные
			if ($this->form_validation->run('report') == TRUE)
			{
				$this->Report_model->insert_table(
				$this->input->post('inv_select'),
				$this->input->post('room_select'),
				$this->input->post('amount'),
				$this->input->post('comment'));
				//перегружаем страницу чтобы очистить поля
				redirect('report/index/'.$from,'refresh');
			}
			}		
		//обрабатываем нажатие кнопки copy(Копирование)
			//------------------------------------------------------------------
		if($this->input->post('copy'))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_report = current($this->input->post('chk_id'));
				$array_report = $this->Report_model->copy_table($id_report);
				$data['inv_id'] = $array_report['id_Assets'];
				$data['room_id'] = $array_report['id_Room'];
				$data['amount'] = $array_report['Number'];
				$data['comment'] = $array_report['Comment'];
			}

		}
		//обрабатываем нажатие кнопки update(Обновление)
			//------------------------------------------------------------------
		if($this->input->post('update'))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checkreport') == TRUE)
			{
				$id_report = $this->input->post('chk_id');
				$this->Report_model->update_table($id_report,
				$this->input->post('inv_select'),
				$this->input->post('room_select'),
				$this->input->post('amount'),
				$this->input->post('comment'));
				//перегружаем страницу чтобы очистить поля
				redirect('report/index/'.$from,'refresh');
			}
			}
		//обрабатываем нажатие кнопки delete (Удаление)
			//------------------------------------------------------------------
		if($this->input->post('delete'))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_report = $this->input->post('chk_id');
				$this->Report_model->delete_table($id_report);
			}
		}
		
		//при нажатии кнопки clear (очистить) очищается сессия
		if($this->input->post('clear'))
		{
			$this->session->unset_userdata('save_query');
		}
		
		
		//если есть сохраненный в сессии запрос, то выводим его результат, иначе выводим общую таблицу
		if($this->session->userdata('save_query'))
		{
			$data['array_report'] = $this->Report_model->getdata_search($this->session->userdata('save_query'));					
		} else
		{
	 		$data['array_report'] = $this->Report_model->getdata_table($config_pag['per_page'], $from);

	
		}
   
	    //обработка нажатия кнопки "Поиск"
		if($this->input->post('search'))
	    {

        //если выбраны переключатели обязательности поиска, то добавляем условия в запрос
        $condition = array();
        if ($this->input->post('chk_inv')) {
          $condition['assets.id'] = $this->input->post('inv_select');
        }
        if ($this->input->post('chk_room')) {
          $condition['rooms.id'] = $this->input->post('room_select');
        }
        //запрос данных
        $data['array_report'] = $this->Report_model->getdata_search($condition);
		$this->session->set_userdata('save_query',$condition); //сохраняем в памяти для вывода результатов, если будет нажата следующая кнопка "copy"
    	}


		//получаем данные из табл Rooms
		$data['array_room'] = $this->Rooms_model->getRoom();
		//получаем данные из табл Assets
		$data['array_inv'] = $this->Assets_model->getInventory();
		$this->load->view('main_view',$data);
	}


	public function in_print()
	{
		//$per_page - сколько позиций выбираем  
		//$from - от какой позиции делаем выборку
		$data['array_report'] = $this->Report_model->getdata_table(100000, 0);
		$this->load->view('tables/table_print',$data);
	}	
	
	//проверка на выделение строки 	
	//------------------------------------------------------------------
	public function isset_value_chk($chk_id)
	{
		return $this->users_lib->isset_value_chk($chk_id);
	}

}
/* End of file main.php */
/* Location: ./application/controllers/main.php */