<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Assets extends CI_Controller {
	/**
	* Контроллер Assets обрабатывает заполнение карточек инвентарных средств
	*/
	
	function __construct()
	{
		parent::__construct();	
		//загрузка пользовательской библиотеки
		$this->load->library('users_lib');
		$this->load->library('session');

		//загружаем модель и получаем необходимые данные для отображеня в виде
		$this->load->model('Assets_model');
		$this->load->model('Category_model');
		//$this->output->enable_profiler(TRUE);
		$data = array();
	}
	//основная функция контроллера
	public function index()
	{
		
		//получить конфигурационные данные для пагинации
		$config_pag = $this->users_lib->get_config_pagination('assets');
		$this->pagination->initialize($config_pag);
		$data['pager'] = $this->pagination->create_links();
		$from = intval($this->uri->segment(3));
		$data['from'] = $from;	
		$data['page'] = "assets";
		//обрабатываем нажатие кнопки add(Добавление)
			if ($this->input->post('add'))
		 {
			//проверяем входные данные
			if ($this->form_validation->run('assets') == TRUE)
			{
				$this->Assets_model->insert_table(
				$this->input->post('number_assets'),
				$this->input->post('name_assets'),
				$this->input->post('price_assets'),
				$this->input->post('amortization_assets'),
				$this->format_date($this->input->post('date_assets')),
				$this->input->post('cat_select')
					);
				//перегружаем страницу чтобы очистить поля
				redirect('assets/index/'.$from,'refresh');
			}
		}
		//обрабатываем нажатие кнопки copy(Копирование)
			//------------------------------------------------------------------
		if($this->input->post('copy'))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_assets = current($this->input->post('chk_id'));
				$array_assets = $this->Assets_model->copy_table($id_assets);
				$data['num_inventory'] = $array_assets['Inv_id'];
				$data['nm_assets'] = $array_assets['Name'];
				$data['price'] = $array_assets['Price'];
				$data['amortization'] = $array_assets['Amortization'];
				$data['date'] = $array_assets['Time'];
				$data['category_id'] = $array_assets['id_Category'];
			}
		}
		//обрабатываем нажатие кнопки update(Обновление)
			//------------------------------------------------------------------
		if($this->input->post('update'))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checkassets') == TRUE)
			{
				$id_assets = $this->input->post('chk_id');
				$this->Assets_model->update_table($id_assets, 
				$this->input->post('number_assets'),
				$this->input->post('name_assets'),
				$this->input->post('price_assets'),
				$this->input->post('amortization_assets'),
				$this->format_date($this->input->post('date_assets')),
				$this->input->post('cat_select')
					);
				//перегружаем страницу чтобы очистить поля
				redirect('assets/index/'.$from,'refresh');
			}
			}		
		//обрабатываем нажатие кнопки delete (Удаление)
			//------------------------------------------------------------------
		if($this->input->post('delete'))
		{
			//проверяем входные данные
			if ($this->form_validation->run('checked') == TRUE)
			{
				$id_assets = $this->input->post('chk_id');
				$this->Assets_model->delete_table($id_assets);
			}
		}

		//при нажатии кнопки clear (очистить) очищается сессия
		if($this->input->post('clear'))
		{
			$this->session->unset_userdata('save_button');
		}
		
		
		
		//если есть сохраненный в сессии запрос, то выводим его результат, иначе выводим общую таблицу
		if($this->session->userdata('save_button'))
		{
           $data['array_assets'] = $this->Assets_model->getdata_search($this->session->userdata('save_button'));					
		} else
		{
		$data['array_assets'] = $this->Assets_model->getdata_table($config_pag['per_page'], $from);
	
		}
		
		    
	if($this->input->post('search'))
    {
        if ($this->input->post('chk_inv')) {
           $data['array_assets'] = $this->Assets_model->getdata_search($this->input->post('number_assets'));
		   $this->session->set_userdata('save_button',$this->input->post('number_assets')); //сохраняем в памяти для вывода результатов, если будет нажата следующая кнопка "copy"
        }
    }


		//получаем список категорий
		$data['array_category'] = $this->Category_model->getCategory();
		$this->load->view('main_view', $data);
	}
	//форматирование строки вводимой даты с хх.хх.хххх на хххх-хх-хх в формат MYSQL 	
	//------------------------------------------------------------------
	public function format_date($str)
	{
		list($day, $month, $year)= explode('.', $str); 
		return $year.'-'.$month.'-'.$day;
	}
	//проверка на выделение строки 	
	//------------------------------------------------------------------
	public function isset_value_chk($chk_id)
	{
		return $this->users_lib->isset_value_chk($chk_id);
	}
	//проверка даты на правильность форматирования
	//------------------------------------------------------------------	
	public function check_date($date)
	{
		if ( preg_match('/[\d]{0,2}\.[\d]{1,2}\.[\d]{2,4}/',$date) )
		{
			list($day, $month, $year)= explode('.', $date); 
			if (checkdate($month, $day, $year) === TRUE)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	//проверка на совпадение значений инвентарных номеров	
	//------------------------------------------------------------------
	public function check_inv($name)
	{
		if ($this->Assets_model->check_number_inv($name) )
		{
			return FALSE;
		}
		else
		{
			return true;
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
	
	//заполнение поля
	//------------------------------------------------------------------
	public function check_empty($data)
	{
		return $this->users_lib->check_empty($data);
	}
	
	//========================
	
		//заполнение начальной даты
	//------------------------------------------------------------------
	public function check_empty_date($date1)
	{
		if (empty($date1))
		{
			return '01.01.1980';
		}
		else
		{
			return TRUE;
		}
	}
		
}
/* End of file assets.php */
/* Location: ./application/controllers/assets.php */